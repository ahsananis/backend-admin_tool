<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    protected $fillable = ['first_name','last_name','employee_no','shift_id','department_id','created_at','updated_at'];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function shift()
    {
        return $this->belongsTo('App\Shift');
    }

}