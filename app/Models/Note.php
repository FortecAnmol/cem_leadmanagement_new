<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    // public $timestamps = false;
    protected $fillable = [
        'user_id','lead_id','source_id','status','reminder_date','reminder_time','reminder_for','feedback'
    ];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead');
    }
}
