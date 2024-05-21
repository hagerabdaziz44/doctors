<?php

namespace App\Http\Controllers\Api\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\DoctorInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorAppointmentDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EditProfileController extends Controller
{
    public function Editprofile(Request $request)
    {

       
        $validator = Validator::make(
            $request->all(),
            [
               
                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'cost'=>'required',
                 'education_en'=>'required',
                'education_ar'=>'required',
                //  'photo' => 'nullable',
                // 'specialization_id' => 'required|exists:specializations,id'

            ],
            [
                
                'name_en.required' => trans('auth.nameRegister'),
                'name_en.string' => trans('auth.string.register'),
                'name_ar.required' => trans('auth.nameRegister'),
                'name_ar.string' => trans('auth.string.register'),
                'photo.required' => trans('auth.image.register'),
                'specialization.required' => trans('doctor.clinic_id'),
                'specialization.exists' => trans('doctor.clinic_id_exists')
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        $doctor = Doctor::where('clinic_id', Auth::guard('clinic-api')->user()->id)->where('id', $request->doctor_id)->first();
        DB::beginTransaction();
        $name = $doctor->photo;
        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalName();
            $name = "doctor-" . uniqid() . ".$ext";
            $photo->move(public_path('images/doctors'), $name);
        }

        $doctor->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            // 'specialization_id'=>$request->specialization_id,
            'cost' => $request->cost,
             'photo' => $name,
            'clinic_id' => Auth::guard('clinic-api')->user()->id,
              'education_en'=>$request->education_en,
            'education_ar'=>$request->education_ar,
        ]);
    
        DB::commit();
        return Response::json(array(
            'message' => trans('msg.updateSuccess'),
        ));
    }


    public function delete_doctor(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_id' => 'required|exists:doctors,id'
            ],
            [
                'doctor_id.required' => trans('doctor.doctor_id'),
                'doctor_id.exists' => trans('doctor.doctor_id_exists'),
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
      Doctor::where('clinic_id', Auth::guard('clinic-api')->user()->id)->where('id', $request->doctor_id)->delete();
        $appointment= DoctorAppointmentDetail::where('id', $request->doctor_id)->delete();
      return Response::json(array(
        'message' => trans('doctor.delete'),
    ));
    }
    public function change_appointment(Request $request)
    {
       
        // $hour =  ltrim($request->hour, $request->hour[0]);
        // $type =  ltrim($request->type, $request->type[0]);
        // $clinic = Clinic::where('id', Auth::guard('clinic-api')->user()->id)->first();
        // $start_time =  $clinic['start'];
        // $end_time =  $clinic['end'];
        // if ($hour > $start_time && $hour < $end_time) {
            DoctorAppointmentDetail::where('id', $request->id)->update([
                'doctor_id' => $request->doctor_id,
                'clinic_id' => Auth::guard('clinic-api')->user()->id,
                'hour' => $request->hour,
                // 'type' =>    $type,
                'day_id' => $request->day_id,
            ]);
            return Response::json(array(
                'message' => trans('msg.updateSuccess'),
            ));
        // } else {
        //     return response()->json([
        //         'message' => trans('Invalid Appointment, The Clinic Appointment From ' . $start_time . ' To ' . $end_time),
        //     ]);
        // }
    }
    public function add_appointment(Request $request)
    {
        //  $clinic = Clinic::where('id', Auth::guard('clinic-api')->user()->id)->first();
        // $start_time =  $clinic['start'];
        // $end_time =  $clinic['end'];
        // if ($request->hour > $start_time && $request->hour < $end_time) {
            DoctorAppointmentDetail::create([
                'doctor_id'=>$request->doctor_id,
                'clinic_id'=>Auth::guard('clinic-api')->user()->id,
                'hour'=>$request->hour,
                // 'type'=>$request->type,
                'day_id'=>$request->day_id,
               ]);
               return Response::json(array(
                'message' => trans('added successfully'),
            ));
        // } else {
        //     return response()->json([
        //         'message' => trans('Invalid Appointment, The Clinic Appointment From ' . $start_time . ' To ' . $end_time),
        //     ]);
        // }

    }
    public function delete_appointment(Request $request)
    {
         $appointment= DoctorAppointmentDetail::find($request->id); 
       $appointment->delete();
        return Response::json(array(
        'message' => trans('doctor.delete'),
    ));
        
    }
     public function get_doctor_appointments(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_id' => 'required|exists:doctors,id'
            ],
            [
                'doctor_id.required' => trans('doctor.doctor_id'),
                'doctor_id.exists' => trans('doctor.doctor_id_exists'),
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
       $appointment= DoctorAppointmentDetail::where('clinic_id',Auth::guard('clinic-api')->user()->id)->where('doctor_id',$request->doctor_id)->get('id'); 
       
        return Response::json(array(
             'status'=>200,
            'message'=>'true',
        '$appointment' =>  $appointment
    ));
    }
    
}
