<?php

namespace App\Exports;

use App\Models\Lead;
use App\Models\Note;
use App\Models\Source;
use App\Models\User;
use App\Models\LhsReport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadClosedExport implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize, WithMapping
{

    use Exportable;
    protected $camp_id;
    function __construct($id)
    {
        $this->id = $id;
    }
    public function prepareRows($rows)
    {
        // $rows = Lead::where('status', 3)->get();
        return $rows->transform(function ($user) {
            $user->feedback = '';
            return $user;
        });
    }
    public function map($lead): array
    {
        $data =   Source::where("id", '=', $lead->source_id)->get();
        foreach ($data as $datas2) {
            $lead->source_id = $datas2['source_name'];
            $lead->description = $datas2['description'];
        }
        $data1 = User::where('id', '=', $lead->user_id)->get();
        foreach ($data1 as $datas1) {
            $lead->user_id = $datas1['name'];
        }
        $data3 = User::where('id', '=', $lead->asign_to)->get();
        foreach ($data3 as $datas3) {
            $lead->asign_to = $datas3['name'];
        }
        $data4 = User::where('id', '=', $lead->asign_to_manager)->get();
        foreach ($data4 as $datas4) {
            $lead->asign_to_manager = $datas4['name'];
        }
        // $data5 = Note::where('lead_id', '=', 162)->get();
        // foreach ($data5 as $datas5) {
        // }
        // $notes = $datas5['feedback'];
        if ($lead->status == 1) {
            $status =  'pending';
        } elseif ($lead->status == 3) {
            $status =  'closed';
        } elseif ($lead->status == 2) {
            $status =  'failed';
        } else{
            $status =  'In Progress';
        }
        $data5 = Note::where('lead_id', '=', $lead->id)->get();
        $lead_data = array();
        $i = 1;
        foreach ($data5 as $key =>  $items) {
            $number = $i;

            $lead_data[$key] = $number . ') ' . $items->feedback;

            $lead->lead_data = implode(",\n", $lead_data);
            $i++;
        }
        //                         $data6 =   LhsReport::get();
        // foreach ($data6 as $datas6) {
        //  if ($lead->status == 3 && $datas6['lead_id'] == $lead->id) {
        //     //  dd('ss');
        //         $lead->download_word =  'http://localhost/lead_updated_new/employee/export/'.$lead->id.'/pdf_single_down';
        //     }
        // }
        $data6 =   LhsReport::get();
        foreach ($data6 as $datas6) {
         if ($lead->status == 3 && $datas6['lead_id'] == $lead->id) {
            //  dd('ss');
            $lead->download_word =  $lead->prospect_first_name.$lead->prospect_last_name.date("-d-m-Y").'.doc';
            }
        }
        $created_at = date ( 'd/m/Y h:i a' , strtotime($lead->created_at) );
        $updated_at = date ( 'd/m/Y h:i a' , strtotime($lead->updated_at) );
        // dd($lead->download_word);
        // dd($lead_data);
        $return = [
            $lead->id,
            $lead->user_id,
            $lead->company_name,
            $lead->prospect_first_name . $lead->prospect_last_name,
            // $lead->job_title,
            // $lead->employee_size,
            // $lead->web_address,
            // $lead->revenue_size,
            $lead->company_industry,
            // $lead->physical_address,
            // $lead->city,
            // $lead->state,
            // $lead->zip_code,
            // $lead->country,
            // $lead->lead_name,
            // $lead->lead_details,
            $lead->linkedin_address,
            $lead->source_id,
            $lead->description,
            $lead->prospect_email,
            $lead->contact_number_1,
            $lead->contact_number_2,
            $lead->asign_to,
            $lead->asign_to_manager,
            $lead->lead_data,
            $lead->status = $status,
            // $lead->total_amount,
            // $lead->no_of_installment,
            $lead->location,
            $lead->timezone,
            $lead->prospect_first_name . $lead->prospect_last_name,
            $lead->designation,
            $lead->designation_level,
            $lead->bussiness_function,
            $lead->date_shared,
            $created_at,
            $updated_at,
            $lead->download_word,
            // $lead->deleted_at,
        ];


        return $return;
    }
    public function query()
    {
        //  $data = Lead::orderBy('status')->get();
        // return Lead::orderBy('status')->get();

        $data =   Lead::where("source_id", '=', $this->id)
            ->orderBy('status', 'desc');
        return $data;
    }

    public function headings(): array
    {
        return [
            'S.No.',
            'Lead Added By',
            'Organization',
            'Name',
            // 'prospect_last_name',
            // 'job_title',
            // 'employee_size',
            // 'web_address',
            // 'revenue_size',
            'Organization Industry',
            // 'physical_address',
            // 'city',
            // 'state',
            // 'zip_code',
            // 'country',
            // 'lead_name',
            // 'lead_details',
            'LinkedIn',
            'Campaign Name',
            'Sub-Campaign Name',
            'Email ID',
            'Contact number 1',
            'Contact number 2',
            'Asigned To Employee',
            'Asign To Manager',
            'Feedback',
            'Status',
            // 'total_amount',
            // 'no_of_installment',
            'Location',
            'Timezone',
            'Prospect Name',
            'Designation',
            'Designation Level',
            'Bussiness Function',
            'Date Shared',
            'Created On',
            'Updated On',
            // 'deleted_at',
            'Download Word',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:AZ1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }
}
