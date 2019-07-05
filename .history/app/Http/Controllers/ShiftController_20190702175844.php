<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shift;

class ShiftController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    

    public function store(Request $request)
    {
        $this->validate($request,[
            'shift_name' => 'required|string|max:255',
            'shift_from_time' => 'required',
            'shift_to_time' => 'required',
            'shift_latemark_time' => 'required',
            'shift_earlymark_time' => 'required'
        ]);


        $shift = Shift::Create($request->all());

        return response()->json(array('message' => 'Shift Created Successfully', 'status' => '200'));
    }

    public function getShifts()
    {
        return response()->json(array('status' => '200', 'All Shifts' => Shift::all()));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'shift_name' => 'required|string|max:255',
            'shift_from_time' => 'required',
            'shift_to_time' => 'required',
            'shift_latemark_time' => 'required',
            'shift_earlymark_time' => 'required'
        ]);

         if(!$request->has('shift_id'))
             return response()->json(array('status' => '404', 'messagae', 'invalid or empty id'));

        $shift = Shift::find($request->id);

        if(empty($shift)) 
            return response()->json(array('status' => '404', 'message' => 'cannot find the shift'));


        $shift->shift_name = $request->shift_name;
        $shift->shift_from_time = $request->shift_from_time;
        $shift->shift_to_time = $request->shift_to_time;
        $shift->shift_latemark_time = $request->shift_latemark_time;
        $shift->shift_earlymark_time = $request->shift_earlymark_time;
        $shift->save();


        return response()->json(array('status' => '200','message' => 'Shift Updated Successfully'));
    }

    public function dltShift($shift_id)
    {
        $shift = Shift::find($shift_id);
        $shift->delete();
        return response()->json(array('status' => '200','Shift Deleted Successfully' => Shift::all()));
    }

}    