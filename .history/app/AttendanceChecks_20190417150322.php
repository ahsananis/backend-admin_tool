<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceCheck extends Model
{
    protected $table = 'attendance_check';
    protected $fillable = ['employee_id',
                           'count',
                           'next_absent',
                           'created_at',
                           'updated_at'];
}