<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
	use SoftDeletes;
	
     protected $fillable = [
        'user_id','first_name','last_name','name','email','password','orignal_password','phone_no','address','is_admin','last_login','is_active',
    ];
    public function source()
    {
    //    return $this->hasMany('App\Models\Source')->where(['assign_to'=>85]);
    return $this->hasMany('App\Models\Source');
        // return $this->belongsTo('App\Models\Source','85');
    }
}
