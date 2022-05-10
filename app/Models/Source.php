<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'user_id','source_name','description','start_date','assign_to','end_date','assign_to_manager'
    ];

  /*  public function money()
    {
        return $this->hasMany('App\Models\Money');//->sum('amount');;
    }

    public function averageRating(){
    return round($this->money()->avg('amount'),1);
}*/

    public function user()
    {
        return $this->belongsTo('App\Models\User','assign_to');
    }  
    public function rating(){

        return $this->hasMany('App\Models\Money');

    }

    public function averageRating(){

        return $this->rating()->sum('amount');

    }

    public function total_leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

    public function unassigned_leads()
    {
        return $this->hasMany('App\Models\Lead')->where(['status'=>1])->whereNull('asign_to');
    }

     public function pending_leads()
    {
        return $this->hasMany('App\Models\Lead')->where(['status'=>1])->whereNotNull('asign_to');
    }

     public function closed_leads()
    {
        return $this->hasMany('App\Models\Lead')->where(['status'=>3]);
    }

     public function failed_leads()
    {
        return $this->hasMany('App\Models\Lead')->where(['status'=>2]);
    }

    public function amount_invested()
    {

        return $this->hasMany('App\Models\Money');
    }

    public function amount_received()
    {
        return $this->hasMany('App\Models\Lead')->with('amount_received');
    }
  




}
