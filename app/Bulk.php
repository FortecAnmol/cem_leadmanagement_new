<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Bulk extends Model
{
    protected $table = 'leads';
    protected $fillable = [
        //'user_id','source_id', 'lead_name','lead_details', 'email','contact_number_1',
        
        'user_id',
        'source_id',
        'company_name',
        'prospect_first_name',
        'prospect_last_name',
        'job_title',
        'prospect_email',
        'contact_number_1',
        'web_address',
        'employee_size',
        'revenue_size',
        'company_industry',
        'physical_address',
        'city',
        'state',
        'zip_code',
        'country',
        'linkedin_address',
        'lead_name',
        'location',
        'timezone',
        'prospect_name',
        'asign_to_manager',
        'designation',
        'bussiness_function',
        'contact_number_2',
        'designation_level',
        'date_shared',

    ];
}

