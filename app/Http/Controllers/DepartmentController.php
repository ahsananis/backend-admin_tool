<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;

class DepartmentController extends Controller
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
        $this->validate($request, [
            'department_name' => 'required|string|max:255|unique:departments'
        ]);

        // $department = new Department;
        // $department->department_name = $request->get('name');
        // $ddepartment->save();
        
         $department = Department::Create($request->all());
        return response()->json(array('message' => 'Successfully created a department','status' => '200'));
    }

    public function getDepartments()
    {
        return response()->json(array('status' => '200','Departments' => Department::all()));
    
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'department_name' => 'required|string|max:255|unique:departments'
        ]);

             if(!$request->has('department_id'))
                 return response()->json(array('status' => '404', 'messagae', 'invalid or empty id'));

            $department = Department::find($request->id);

           if(empty($department)) 
              return response()->json(array('status' => '404', 'message' => 'cannot find the department'));

            $department->department_name = $request->department_name;
            $department->save();

         return response()->json(array('status' => '200', 'Message', 'Department Updated Successfully'));   
    }

    public function dltDepartment($department_id)
    {
        $department = Department::find($department_id);
        $department->delete();
        return response()->json(array('status' => '200','Department Deleted Successfully' => Department::all()));
    }

    
    //
}