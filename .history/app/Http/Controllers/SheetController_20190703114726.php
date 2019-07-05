<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;
use App\Mail\myemail;
use Excel;
use DB;
use App\Sheet;
use Carbon\Carbon;
use App\Employee;
use App\Attendance;
use App\AttendanceCheck;



class SheetController extends Controller
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

    // index data

    public function index()
  {
      $data = Attendance::all();
      return response()->json(array('status' => '200','Attendance of All Employees' => ($data)));
  }

  //Search Function 

  public function getSearchResults(Request $request) {

    $data = $request->get('attendance');

    $search_attendance = Attendance::where('employee_id', 'like', "%{$data}%")
                    //  ->orWhere('registration_center', 'like', "%{$data}%")
                    //  ->orWhere('registration_id', 'like', "%{$data}%")
                    //  ->orWhere('sponsor_name', 'like', "%{$data}%")
                    //  ->orWhere('event_name', 'like', "%{$data}%")
                    //  ->orWhere('registration_id', 'like', "%{$data}%")
                    //  ->orWhere('profile_photo', 'like', "%{$data}%")
                    //  ->orWhere('first_name', 'like', "%{$data}%")
                    //  ->orWhere('last_name', 'like', "%{$data}%")
                     ->get();

    return Response::json([
        'attendance' => $search_attendance
    ]);     
}

  // Export excel file  

    public function downloadExcel($type)
    {
        $data = Attendance::get()->toArray();
            
       return Excel::create('Attendance', function($excel) use ($data) {
            $excel->sheet('import-file', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('csv');

          // return $data;
    }


// Import excel file

      public function importExcel(Request $request)
      {
       
        ini_set('max_execution_time', '300');
        $path = $request->file('import-file')->getRealPath();
        $data = Excel::load($path, function($reader){
          $reader->ignoreEmpty();

        })->get();

    //return $data;

   
        if(!empty($data) && $data->count())
        {


          foreach ($data as $empatt)
          {

            $day = new Carbon($empatt->date);
            $day=$day->format('l');
          
         
          $eid=$empatt->no;

      
// These condition filter the data , making null column into 0 .

           if(is_null($empatt->late)) {
            $late="0";
           }
           else {
            $late=$empatt->late;
           }
           if(is_null($empatt->early)) {
             $early="0";
          }
          else {
            $early=$empatt->early;
          }
          if(is_null($empatt->absent)) {
             $absent="0";
          }
          else {
             $absent=$empatt->absent;
          }
          if(is_null($empatt->ot_time)) {
             $ot_time="0";
          }
          else {
             $ot_time=$empatt->ot_time;
          }
          if(is_null($empatt->clock_in)) {
             $clock_in="0";
             $absent="True";
             
          }
          else {
             $clock_in=$empatt->clock_in;
           
             
          }
          if(is_null($empatt->clock_out)) {
             $clock_out="0";
          
             $absent="True";
          }
          else {

             $clock_out=$empatt->clock_out;
             
           

          }

//OT calculate-Ahsan

          if($absent=="0" && $clock_out!="0")
          {
            $off_duty = new Carbon($empatt->off_duty);
            $diffot = $off_duty->diffInMinutes(new Carbon($empatt->clock_out));

            if($diffot-30 >= 0)
            {

              $diffot = $diffot/60;
           // return $diffot;


//Round() convert the float value into integer.

              $diffot=round($diffot);  

          if($clock_out==0)
          {
            $diffot = "No Check out";
          }    

              return $diffot;

            //  if($diffot >= 0.5 && $diffot <= 1.49)
            // {
            //   $diffot = 1;
            // }
        
            // if($diffot >= 1.5 && $diffot <= 2.49)
            // {
            //    $diffot = 2;
            // }

            // if($diffot >= 2.5 && $diffot <= 3.49)
            // {
            //    $diffot = 3;
            // }

            // if($diffot >= 3.5 && $diffot <= 4.49)
            // {
            //    $diffot = 4;
            // }

            // if($diffot >= 4.5 && $diffot <= 5.49)
            // {
            //    $diffot = 5;
            // }

            // if($diffot >= 5.5 && $diffot <= 6.49)
            // {
            //    $diffot = 6;
            // }

            // if($diffot >= 6.5 && $diffot <= 7.49)
            // {
            //    $diffot = 7;
            // }

            // if($diffot >= 7.5 && $diffot <= 8.49)
            // {
            //    $diffot = 8;
            // }

            // if($diffot >= 8.5 && $diffot <= 8.49)
            // {
            //    $diffot = 9;
            // }

            // if($diffot >= 8.5 && $diffot <= 9.49)
            // {
            //    $diffot = 10;
            // }

            }

            else
            {
               $diffot = 0;
            }


            }


 //Early Checkout 29/04/2019

 if($early!="0" && $clock_out!="0")
 {
  $off_duty = new Carbon($empatt->off_duty);
  $diffearly = $off_duty->diffInMinutes(new Carbon($empatt->clock_out));

   if($diffearly>=0)
   {

      $diffearly = $diffearly/60;

      $diffearly=round($diffearly);  
   }

   else 
   {
    $diffearly = 0;
   } 

  }

  // No Check In  29/04/2019

if($clock_in!="0" && $clock_out!="0")
 {
  $off_duty = new Carbon($empatt->off_duty);
  $noclock_out = $off_duty->diffInMinutes(new Carbon($empatt->clock_out));

  // $on_duty = new Carbon($empatt->on_duty);
  // $noclock_in = $on_duty->diffInMinutes(new Carbon($empatt->clock_in));

   if($noclock_out==0)
   {
      $noclock_out = "Warning";
      // return $noclock_out;
   }

   else 
   {
    $noclock_out = 0;
   } 

  }
    
// Creating a record in Attendance table for that date and employee .

            $emp_att= Attendance::create([
            'employee_id'=>$eid,
            'date'=>$empatt->date,
            'on_duty'=>$empatt->on_duty,
            'off_duty'=>$empatt->off_duty,
            'clock_in'=>$clock_in,
            'clock_out'=>$clock_out,
            'late'=>$late,
            'early'=>$early,
            'absent'=>$absent,
            'ot_time'=>$diffot,
            ]);

// Exempting Saturday from attendance check . Will not mark early or late on saturday. 

if($day=="Saturday") {
}
else {


  // Checking late count 

              if($absent=="0" && $clock_in!="0"  )
              {

                $on_duty=new Carbon($empatt->on_duty);
                $diffin=$on_duty->diffInMinutes(new Carbon($empatt->clock_in),false);

                if($diffin > 15) {

                  $attcheck=AttendanceCheck::where("employee_id","=",$eid)->first();

                  if($attcheck) {

                    $attcheck->count++;
                    $attcheck->save();
                   
                  }
                  else {

                    $attcheck = new AttendanceCheck;
                    $attcheck->employee_id= $eid;
                    $attcheck->count=1;
                    $attcheck->next_absent="False";
                    $attcheck->save();

                  }


                }
           

              }
            }

            
          }
         
          return response()->json(array('message' => 'Successfully Imported a Sheet','status' => '200'));   
     
        }
        return response()->json(array('message' => 'Successfully Imported a Sheet','status' => '200'));   
      }

//Show all data of excel file.

      public function show($id){
        $attcheck = Sheet::where('id',$id)->get();
        return response ($attcheck);
    }

  

// Mail Function

      public function sendEmail()
    {
        $emp=DB::table('employees')->where('id','>',0)->get();
          // dd($emp);
       
      $mail=DB::table('attendances')
            ->join('attendance_check', 'attendance_check.employee_id', '=', 'attendances.employee_id') 
            // ->join('attendance', 'attendance.')
               ->where('attendance_check.count', '>=', 3 )
            // ->select('attendances.*','employees.*','attendance_check.*')
            ->where('attendances.late', '<',29)
            // ->order by('attendance_check.count','', 'desc');
            ->first();
                // dd($mail);    
              //  print_r($mail);
              //  die();
        Mail::to('support@xoopr.io')->send(new myemail());
         return "Email was Sent";
    }
    
 }

 
  //  $early = new Carbon($empatt->early);
  //  $diffearly = $early->diffInMinutes(new Carbon($empatt->checkout));
    
      