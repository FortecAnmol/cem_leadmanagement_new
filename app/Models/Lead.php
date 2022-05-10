<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;
    
    protected $fillable = [

        'user_id',
        'source_id',
        'company_name',
        'prospect_first_name',
        'prospect_last_name',
        'location',
        'timezone',
        'company_industry',
        'prospect_name',
        'designation',
        'linkedin_address',
        'asign_to_manager',
        'bussiness_function',
        'prospect_email',
        'contact_number_1',
        'contact_number_2',
        'designation_level',
        'date_shared',
        'is_notify',
        'is_read',
        /*'job_title',
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
        'lead_name',*/

    ];

    public function source()
    {
        return $this->belongsTo('App\Models\Source');
        //return $this->hasMany('App\Models\Source', 'lead_id', 'id');
    }
    public function lhsreport()
    {
        return $this->hasOne('App\Models\LhsReport', 'lead_id', 'id');
    }

    public function installments()
    {
        return $this->hasMany('App\Models\Installment');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\Note')->orderBy('created_at' , 'DESC');
    }
     public function note()
    {
        return $this->hasOne('App\Models\Note');
    }

     public function feedback()
    {
        return $this->hasOne('App\Models\Feedback');
    }

    public function amount_received()
    {
        return $this->hasMany('App\Models\Installment')->where(['status'=>2]);
    }

     public function user()
    {
        return $this->belongsTo('App\Models\User','asign_to')->withTrashed();
    }    
    public function users()
    {
        return $this->belongsTo('App\Models\User','asign_to');
    }
}
