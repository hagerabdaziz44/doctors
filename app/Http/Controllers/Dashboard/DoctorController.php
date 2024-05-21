<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\PatientBooking;
use App\Models\Specialization;
use App\Models\Clinic;
use App\Models\Day;
use App\Models\Time;
use App\Models\DoctorAppointmentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::get();
        return view('dashboard.doctors.index', compact('doctors'));
    }
    public function get_all_booking()
    {
        $booking_list = PatientBooking::with('clinic')->get();
        return view('dashboard.booking.index', compact('booking_list'));
    }

    public function create()
    {
         $times=Time::where('type','am')->get();
         $times_pm=Time::where('type','pm')->get();
        $days = Day::get();
        $clinics = Clinic::get();
        $specializations = Specialization::get();
        return view('dashboard.doctors.create', compact('specializations', 'days', 'clinics','times','times_pm'));
    }
    public function store(Request $request)
    {
       
        
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'cost' => 'required',
            'specialization_id' => 'required|exists:specializations,id',
            'clinic_id' => 'required|exists:clinics,id',

            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        DB::beginTransaction();
        $clinic_get = Clinic::where('id', $request->clinic_id)->first();
        $max_doctors = $clinic_get->max_doctor;
        $doctors_count = Doctor::where('clinic_id', $request->clinic_id)->count();
        if ($doctors_count < $max_doctors) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalName();
            $filename = "doctor-" . uniqid() . ".$ext";
            $file->move(public_path('images/doctors'), $filename);

            $doctor =  Doctor::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'specialization_id' => $request->specialization_id,
                'clinic_id' => $request->clinic_id,
                'cost' => $request->cost,
                'education_en'=>$request->education_en,
                 'education_ar'=>$request->education_ar,
                'photo' =>  $filename,
            ]);
               $days=$request->day_ids;
            foreach ($days as $key => $day) {
                foreach($request->hours as $hour)
                {
                    $list = DoctorAppointmentDetail::create([
                        'clinic_id' => $request->clinic_id,
                        'doctor_id' => $doctor->id,
                        'day_id' =>$day,
                        'hour' =>$hour,
                    ]);

                }
               
            }

            DB::commit();
            return redirect()->route('doctors.index')->with(['success' => 'Doctor Added Successfully']);
        } else {
            return redirect()->route('doctors.index')->with(['error' => 'The Maximum Number Of Doctors That Can Be Added Is ' . $max_doctors]);
        }
    }
    public function edit($id)
    {
         $doctor = Doctor::findOrFail($id);
        $days = Day::get();
        $clinics = Clinic::get();
        $times=Time::where('type','am')->get();
        $times_pm=Time::where('type','pm')->get();
        $specializations = Specialization::get();
         $appointments=DoctorAppointmentDetail::where('doctor_id',$id)->get();
        return view('dashboard.doctors.edit', compact('doctor','specializations', 'days', 'clinics','appointments','times','times_pm'));
       
    }
    public function update(Request $request, $id)
    {
        // return $request;
         $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'cost' => 'required',
            'specialization_id' => 'required|exists:specializations,id',
            'clinic_id' => 'required|exists:clinics,id',

            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        DB::beginTransaction();
        $clinic_get = Clinic::where('id', $request->clinic_id)->first();
        // $filename=;
        $max_doctors = $clinic_get->max_doctor;
        $doctors_count = Doctor::where('clinic_id', $request->clinic_id)->count();
        // if ($doctors_count < $max_doctors) {
        $doctor=Doctor::where('id',$id)->first();
        $filename=$doctor->photo;
        if($request->image)
        {
         $file = $request->file('image');
            $ext = $file->getClientOriginalName();
            $filename = "doctor-" . uniqid() . ".$ext";
            $file->move(public_path('images/doctors'), $filename);   
        }
            

            $doctor =  Doctor::where('id',$id)->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'specialization_id' => $request->specialization_id,
                'clinic_id' => $request->clinic_id,
                'cost' => $request->cost,
                 'education_en'=>$request->education_en,
                 'education_ar'=>$request->education_ar,
                'photo' =>  $filename,
            ]);
            
           
          
           

            DB::commit();
            return redirect()->route('doctors.index')->with(['success' => 'Doctor Updated Successfully']);
        //  } 
        // else {
        //     return redirect()->route('doctors.index')->with(['error' => 'The Maximum Number Of Doctors That Can Be Added Is ' . $max_doctors]);
        // }
    }
    public function delete($id)
    {
        Doctor::findOrFail($id)->delete();
        return redirect()->route('doctors.index')->with(['success' => 'Doctor Deleted Successfully']);
    }
    public function doctor_appointments($id)
    {
        $appointments = DoctorAppointmentDetail::where('doctor_id', $id)->get();
        $doctor_id=$id;
        return view('dashboard.doctors.appointment', compact('appointments','doctor_id'));
    }
    public function delete_appointment($id)
    {
        $appoint= DoctorAppointmentDetail::where('id', $id)->first();
        $doctor_id=$appoint->doctor_id;
        DoctorAppointmentDetail::where('id', $id)->delete();
        return redirect()->route('doctors.appointments',$doctor_id)->with(['success' => 'Deleted Successfully']);
    }
    public function add_appointment($id)
    {
        $times=Time::where('type','am')->get();
        $times_pm=Time::where('type','pm')->get();
        $days = Day::get();
        $doctor_id=$id;
        return view('dashboard.doctors.newappointment', compact('doctor_id','days','times','times_pm'));
    } 
    public function store_appointment($id,Request $request)
    {
        $doctor=Doctor::where('id',$id)->first();
        $clinic=$doctor->clinic_id;
        $days=$request->day_ids;
        foreach ($days as $key => $day) {
            foreach($request->hours as $hour)
            {
                $list = DoctorAppointmentDetail::create([
                    'clinic_id' => $clinic,
                    'doctor_id' => $id,
                    'day_id' =>$day,
                    'hour' =>$hour,
                ]);

            }
           

    }
}
}
