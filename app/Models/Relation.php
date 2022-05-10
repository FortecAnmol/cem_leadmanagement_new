<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Relation extends Model
{
	use SoftDeletes;
	
     protected $fillable = [
        'assign_to_cam','assign_to_employee','lead_assigned','created_at','updated_at','assign_to_manager'
    ];
}
