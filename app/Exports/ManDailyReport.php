<?php

namespace App\Exports;

use App\Models\Lead;
use App\Models\LhsReport;
use App\Models\Note;
use App\Models\Source;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ManDailyReport implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize, WithMapping
{

    use Exportable;
    protected $camp_id;
    protected $emp_id;
    protected $date_from;
    protected $date_to;
    function __construct($camp_id, $emp_id,$date_from,$date_to)
    {
        $this->camp_id = $camp_id;
        $this->emp_id = $emp_id;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        // dd($date_from);
    }
    public function prepareRows($rows)
    {
        // $rows = Lead::where('status', 3)->get();
        return $rows->transform(function ($user) {
            $user->download_PDF = '';
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
        $data6 =   LhsReport::get();
        foreach ($data6 as $datas6) {
         if ($lead->status == 3 && $datas6['lead_id'] == $lead->id) {
            //  dd('ss');
            $lead->download_word =  $lead->prospect_first_name.$lead->prospect_last_name.date("-d-m-Y").'.doc';
            }
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

        $date = date ( 'd/m/Y' , strtotime($lead->created_at) );
        $time = date ( 'h:i a' , strtotime($lead->created_at) );
        // dd($lead_data);
        $return = [
            $lead->asign_to,
            $lead->source_id,
            $lead->description,
            $lead->prospect_first_name .' '. $lead->prospect_last_name,
            $lead->designation,
            $lead->bussiness_function,
            $lead->company_name,
            $lead->company_industry,
            $lead->linkedin_address,
            $lead->prospect_email,
            $lead->contact_number_1,
            $lead->contact_number_2,
            $lead->location,
            $lead->timezone,
            $lead->feedback,
            $date,
            $time,


            // $lead->id,
            // $lead->user_id,
            // $lead->company_name,
            // $lead->prospect_first_name . $lead->prospect_last_name,
            // // $lead->job_title,
            // // $lead->employee_size,
            // // $lead->web_address,
            // // $lead->revenue_size,
            // $lead->company_industry,
            // // $lead->physical_address,
            // // $lead->city,
            // // $lead->state,
            // // $lead->zip_code,
            // // $lead->country,
            // // $lead->lead_name,
            // // $lead->lead_details,
            // $lead->linkedin_address,
            // $lead->source_id,
            // $lead->prospect_email,
            // $lead->contact_number_1,
            // $lead->contact_number_2,
            // $lead->asign_to,
            // $lead->asign_to_manager,
            // $lead->feedback,
            // $lead->status = $status,
            // // $lead->total_amount,
            // // $lead->no_of_installment,
            // $lead->location,
            // $lead->timezone,
            // $lead->prospect_first_name . $lead->prospect_last_name,
            // $lead->designation,
            // $lead->designation_level,
            // $lead->bussiness_function,
            // $lead->date_shared,
            // $lead->created_at,
            // $lead->updated_at,
            // $lead->download_word
            // // $lead->deleted_at,
        ];


        return $return;
    }
    public function query()
    {
        $date_from_new = date ( 'Y-m-d H:i:s' , strtotime($this->date_from) );
        $date_to_new = date ( 'Y-m-d H:i:s' , strtotime($this->date_to) );
        if ($this->emp_id != "" && $this->camp_id != "" &&  $this->date_from == "" && $this->date_to == "" ) {
           return   Lead::query()
           ->where('asign_to',$this->emp_id)->where('notes.source_id',$this->camp_id)
           ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at');
        } elseif ($this->emp_id != "" && $this->camp_id == "" &&  $this->date_from == "" && $this->date_to == "" )  {
            return  
            Lead::query()
            ->where('asign_to',$this->emp_id)
            ->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at');
        } elseif ($this->emp_id == "" && $this->camp_id != "" &&  $this->date_from == "" && $this->date_to == "" ) {

            return   Lead::query()
            ->where('notes.source_id','=',$this->camp_id)
            ->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at');
        }
         elseif ($this->emp_id == "" && $this->camp_id == "" &&  $this->date_from == "" && $this->date_to == "" ) {
            return Lead::join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at');
            
        } elseif ($this->emp_id != "" && $this->camp_id == "" && $this->date_from != "" && $this->date_to != ""){
            return  Lead::query()->where('asign_to',$this->emp_id)->whereBetween('notes.updated_at', [$date_from_new, $date_to_new])
            ->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at', 'desc');

        } elseif ($this->emp_id != "" && $this->camp_id != "" && $this->date_from != "" && $this->date_to != ""){
            return   Lead::query()
            ->where("notes.source_id", '=', $this->camp_id)
            ->where("asign_to", "=", $this->emp_id)
            ->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at', 'desc')
            ->whereBetween('notes.updated_at', [$date_from_new, $date_to_new]);    
        } elseif ( $this->date_from && $this->date_to){
            return   Lead::query()
            ->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at', 'desc')
            ->whereBetween('notes.updated_at', [$date_from_new, $date_to_new]);    
        }
        // return $data;
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Campaign Name',
            'Sub-Campaign Name',
            'Prospect Name',
            'Designation',
            'Bussiness Function',
            'Organization',
            'Organization Industry',
            'LinkedIn',
            'Email ID',
            'Contact number 1',
            'Contact number 2',
            'Location',
            'Timezone',
            'Feedback',
            'Comment Date',
            'Comment Time',
            // 'S.No.',
            // 'Organization',
            // 'Name',
            // // 'prospect_last_name',
            // // 'job_title',
            // // 'employee_size',
            // // 'web_address',
            // // 'revenue_size',
            // 'Organization Industry',
            // // 'physical_address',
            // // 'city',
            // // 'state',
            // // 'zip_code',
            // // 'country',
            // // 'lead_name',
            // // 'lead_details',
            // 'LinkedIn',
            // 'Campaign Name',
            // 'Email ID',
            // 'Contact number 1',
            // 'Contact number 2',
            // 'Asigned To Employee',
            // 'Asign To Manager',
            // 'Feedback',
            // 'Status',
            // // 'total_amount',
            // // 'no_of_installment',
            // 'Location',
            // 'Timezone',
            // 'Prospect Name',
            // 'Designation',
            // 'Designation Level',
            // 'Bussiness Function',
            // 'Date Shared',
            // 'Created On',
            // 'Updated On',
            // // 'deleted_at',
            // 'Download PDF',
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
