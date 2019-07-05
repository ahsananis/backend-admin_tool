<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employee_id',
                           'count',
                           'next_absent',
                           'created_at',
                           'updated_at'];
}