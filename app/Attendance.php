<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employee_id',
                           'date',
                           'on_duty',
                           'off_duty',
                           'clock_in',
                           'clock_out',
                           'late',
                           'early',
                           'absent',
                           'ot_time'];
}