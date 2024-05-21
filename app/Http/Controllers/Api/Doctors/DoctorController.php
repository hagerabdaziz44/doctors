<?php

namespace App\Http\Controllers\Api\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorAppointment;
use App\Models\DoctorAppointmentDetail;
use App\Models\DoctorInsurance;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function all_doctors(){
        $doctor = Doctor::select('id','name_'.app()->getLocale() .' as name','photo','specialization_id','clinic_id','cost','education_'.app()->getLocale() .' as education','rate')->with(
            [
            'specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');},
        'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name','logo');}])->get();

       
        return response()->json([
            'message' => 'success',
            'doctors'   => $doctor
        ]);
    }
    public function get_doctor_by_id(Request $request){
       $doctor = Doctor::where('id', $request->id)->select('id', 'name_' . app()->getLocale() . ' as name','name_en','name_ar', 'photo', 'specialization_id', 'clinic_id', 'cost','education_'.app()->getLocale() .' as education','rate')->with(
            [
                'specialization' => function ($q) {
                    $q->select('id', 'name_' . app()->getLocale() . ' as name');
                },
                'clinic' => function ($q) {
                    $q->select('id', 'name_' . app()->getLocale() . ' as name', 'logo', 'lat', 'long');
                }
            ]
        )->get();
        $doctor->map(function ($doctor) {

            $doctor['appointments'] = DoctorAppointmentDetail::where('doctor_id', $doctor['id'])->select('id','hour','day_id','clinic_id','doctor_id')->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
        });

        return response()->json([
            'message' => 'success',
            'doctors'   => $doctor
        ]);
    }
    public function get_doctor_by_specialization_id(Request $request){
        $doctor = Doctor::where('specialization_id',$request->specialization_id)->select('id','name_'.app()->getLocale() .' as name','photo','specialization_id','clinic_id','cost','education_'.app()->getLocale() .' as education','rate')->with(
            [
            'specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');},
        'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name','logo');}])->get();

       
        return response()->json([
            'message' => 'success',
            'doctors'   => $doctor
        ]);
    }
    public function get_doctor_appointments(Request $request)
    {
       
        $appointments=DoctorAppointmentDetail::where('doctor_id',$request->doctor_id)->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->where('clinic_id',$request->clinic_id)->get();
        
        return response()->json([
            'message' => 'success',
            'appointments'   => $appointments
        ]);
    }
  
    
}

