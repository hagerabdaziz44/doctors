<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Clinic;
use App\Models\ClinicRate;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorRate;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class RateController extends Controller
{ 
    public function rate_clinic(Request $request)
    {
        // ClinicRate::create([
        //     'clinic_id'=>$request->clinic_id,
        //     'patient_id'=>Auth::guard('user-api')->user()->id,
        //     'rate'=>$request->rate,
           
        // ]);
        $count = CLinicRate::where('patient_id', Auth::guard('user-api')->user()->id)->where('clinic_id',$request->clinic_id)->count();
        if ($count==0) {
          ClinicRate::create([
            'clinic_id'=>$request->clinic_id,
            'patient_id'=>Auth::guard('user-api')->user()->id,
            'rate'=>$request->rate,
           
        ]);
        $count=ClinicRate::where('clinic_id',$request->clinic_id)->count();
     $rate=ClinicRate::where('clinic_id',$request->clinic_id)->sum('rate');
        $finalrate=$rate/$count;

        $rate=Clinic::where('id',$request->clinic_id)->update(
            ['rate'=>$finalrate]

        );


            return response()->json([
                
                'message' => trans('msg.message'),
                'updated_rate'=>$finalrate
            ]);
        }
        else
        {
            ClinicRate::where('patient_id',Auth::guard('user-api')->user()->id)->where('clinic_id',$request->clinic_id)->update([
                'rate'=>$request->rate
            ]);
            $count=ClinicRate::where('clinic_id',$request->clinic_id)->count();
      $rate=ClinicRate::where('clinic_id',$request->clinic_id)->sum('rate');
     $finalrate=$rate/$count;

        $rate=Clinic::where('id',$request->clinic_id)->update(
            ['rate'=>$finalrate]

        );

                return Response::json(array(
                    
                    
                    'message'=>trans('msg.message'),
                    'updated_rate'=>$finalrate,
                ));
        }
    }
    public function rate_doctor(Request $request)
    {
       
    $count = DoctorRate::where('patient_id', Auth::guard('user-api')->user()->id)->where('doctor_id',$request->doctor_id)->count();
    if ($count==0) {
      DoctorRate::create([
        'doctor_id'=>$request->doctor_id,
        'patient_id'=>Auth::guard('user-api')->user()->id,
        'rate'=>$request->rate,
       
    ]);
    $count=DoctorRate::where('doctor_id',$request->doctor_id)->count();
 $rate=DoctorRate::where('doctor_id',$request->doctor_id)->sum('rate');
    $finalrate=$rate/$count;

    $rate=Doctor::where('id',$request->doctor_id)->update(
        ['rate'=>$finalrate]

    );


        return response()->json([
            
            'message' => trans('msg.message'),
            'updated_rate'=>$finalrate
        ]);
    }
    else
    {
        DoctorRate::where('patient_id',Auth::guard('user-api')->user()->id)->where('doctor_id',$request->doctor_id)->update([
            'rate'=>$request->rate
        ]);
        $count=DoctorRate::where('doctor_id',$request->doctor_id)->count();
  $rate=DoctorRate::where('doctor_id',$request->doctor_id)->sum('rate');
 $finalrate=$rate/$count;

    $rate=Doctor::where('id',$request->doctor_id)->update(
        ['rate'=>$finalrate]

    );

            return Response::json(array(
                
                
                'message'=>trans('msg.message'),
                'updated_rate'=>$finalrate,
            ));
    }
      
    }
}
