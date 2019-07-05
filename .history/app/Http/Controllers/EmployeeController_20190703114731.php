<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use Excel;

class EmployeeController extends Controller
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

    public function import(Request $request)
    {

         // $request->validation([
        //   'import-file' => 'required'
        // ]);

        $path = $request->file('import-file')->getRealPath();
       

        $data = Excel::selectSheetsByIndex(0)->load($path, function($reader){

        })->get();

        

        if(!empty($data) && $data->count())
        {
          foreach ($data as $employee)
          {

            $emp= new Employee;
            if (trim($employee->full_name) && strpos($employee->full_name, ' ') !== false) 
            {

                $name =$employee->full_name;
                $name=explode(" ",$name);
                $emp->first_name =$name[0];
                $emp->last_name=$name[1];

            }  

            else 
            {
                $name =$employee->full_name;
                
                $emp->first_name =$name;
                $emp->last_name="";
            }
 
           $eid=explode("/",$employee->id);
           $eid=$eid[1];
            $emp->employee_no=$eid;
            $emp->shift_id=0;
            $emp->department_id=0;
            $emp->save();
           
    //  This code only use for add Employees in database

          //   $addemp = Employee::where('employee_no',"=",$value->no)->first();

          //   if($addemp == null) {

          //   $addemp = New Employee();
          //   $addemp->first_name = $value->name;
          //   $addemp->employee_no = $value->no;
          //   $addemp->last_name = $value->name;
          //   $addemp->shift_id=0;
          //   $addemp->department_id=0;
          //   $addemp->save();

          // }

        
                  
            //  $latecount = Sheet::count();
            //  if($latecount->late == )
    

          }
          
          return response()->json(array('message' => 'Successfully Imported a Sheet','status' => '200'));   
  
        }
        else {
            return response()->json(array('message' => 'Data is empty','status' => '403'));   
  
        }
       

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_no' => 'required|string|max:255|unique:employees',
            'shift_id' => 'required',
            'department_id' => 'required'
        ]);
        
        $employee = Employee::Create($request->all());
        return response()->json(array('message' => 'Successfully created a department','status' => '200'));
    }

    public function getEmployees()
    {
        return response()->json(array('status' => '200','All_Employees' => Employee::paginate(15)));
    
    }

    public function update(Request $request)
    {
        $this->validate($request,
        [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_no' => 'required|string|max:255|unique:employees',
            'shift_id' => 'required',
            'department_id' => 'required'
        ]);

        $employee = Employee::find($request->id);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->employee_no = $request->employee_no;
        $employee->shift_id = $request->shift_id;
        $employee->department_id = $request->department_id;
        $employee->save();

        return response()->json(array('message' => 'Shift Created Successfully', 'status' => '200'));
    }

    public function dltEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json(array('status' => '200','Employee Deleted Successfully' => Employee::all()));
    }

   

    //
}