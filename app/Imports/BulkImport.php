<?php
namespace App\Imports;
use App\Bulk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Source;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class BulkImport implements ToModel,WithHeadingRow, SkipsOnError,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsErrors;
    public function model(array $row)
    {
        $data = Source::select("id")->latest()->first();

        return new Bulk([
            'user_id'=> auth()->user()->id,
            'source_id'     => $data->id,
            'company_name' => $row['company_name'],
            'prospect_first_name' => $row['prospect_first_name'],
            'prospect_last_name' => $row['prospect_last_name'],
            'prospect_email' => $row['prospect_email'],
            'contact_number_1'=> $row['contact_number_1'],
            'location'=> $row['location'],
            'timezone'=> $row['timezone'],
            'company_industry'=> $row['company_industry'],
            // 'prospect_name'=> $row['prospect_name'],
            'designation'=> $row['designation'],
            'linkedin_address'=> $row['linkedin_address'],
            'bussiness_function'=> $row['bussiness_function'],
            'contact_number_2'=> $row['contact_number_2'],
            'designation_level'=> $row['designation_level'],
            'date_shared'=> date('Y-m-d', strtotime($row['date_shared'])),
             /*'job_title' => $row['job_title'],
             'web_address'=> $row['web_address'],
            'employee_size'=> $row['employee_size'],
            'revenue_size'=> $row['revenue_size'],
            'company_industry'=> $row['company_industry'],
            'physical_address'=> $row['physical_address'],
            'city'=> $row['city'],
            'state'=> $row['state'],
            'zip_code'=> $row['zip_code'],
            'country'=> $row['country'],
            'linkedin_address'=> $row['linkedin_address'],
            'lead_name'=> $row['job_title'],*/

        ]);
    }
    public function rules(): array
    {
        return [
            'company_name' => 'gte:*.company_name',
        ];
    }
}