<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sheet extends Model
{
    protected $fillable = ['no','name','date','timetable','on_duty','off_duty','clock_in','clock_out','late','early','absent','ot_time','created_at','updated_at'];
}