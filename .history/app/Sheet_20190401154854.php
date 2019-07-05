<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Sheet extends Model
{
    protected $fillable = ['no','name','date','timetable','on_duty','off_duty','clock_in','clock_out','late','early','absent','created_at','updated_at'];
}