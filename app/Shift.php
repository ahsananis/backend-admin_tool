<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Shift extends Model
{
    protected $fillable = ['shift_name','shift_from_time','shift_to_time','shift_latemark_time','shift_earlymark_time','created_at','updated_at'];
}