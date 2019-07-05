<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    protected $fillable = ['first_name','last_name','employee_no','shift_id','department_id','created_at','updated_at'];
}