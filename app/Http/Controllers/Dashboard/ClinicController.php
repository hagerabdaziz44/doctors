<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicInsurance;
use App\Models\ClinicSpecialization;
use App\Models\ClinicAppointment;
use App\Models\AddressClinic;
use App\Models\ClinicImage;
use App\Models\Insurance;
use App\Models\PatientBooking;
use App\Models\Day;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClinicController extends Controller
{
    public function index()
    {
    //     $date = Carbon::now()->timezone('Africa/Cairo');
    //     $all= $date;
    //     $day_name= $all->englishDayOfWeek;
    //     $days=Day::where('name_en', $day_name)->first();
    //     $day=$days->id;
    //   return $appointments=ClinicAppointment::where('day_id',$day)->get();
    //       $date =Carbon::now()->timezone('Africa/Cairo');
    //   return $all= $date->toArray();
    //     return $day_name= $all->englishDayOfWeek;
        // $days=Day::where('name_en', $day_name)->first();
        // $day=$days->id;
        //     return $appoinments=ClinicAppointment::where('day_id',$day)->get();
        $clinics = Clinic::get();
        return view('dashboard.clinics.index', compact('clinics'));
    }
     public function create()
    {
      
        $s = Specialization::get();
        $insurances = Insurance::get();
        $days=Day::get();
      
        // return $spectialization;
        return view('dashboard.clinics.create', compact('s', 'insurances','days','times'));
    }
    public function store(Request $request)
    {
      
    //  return $request;
        // $request->validate([
        //     'name_en' => 'required',
        //     'name_ar' => 'required',
        //     'description_ar' => 'required',
        //     'description_en' => 'required',
        //     'phone' => 'required|unique:clinics,phone',
        //     'address_en' => 'required',
        //     'address_ar' => 'required',
        //     'lat' => 'required',
        //     'long' => 'required',

        //     'cover' => 'required',
        //     'logo' => 'required',
        //     'email' => 'required|unique:clinics,email',
        //     'password' => 'required',
        //     'start' => 'required',
        //     'end' => 'required',
        //     'video' => 'required',
        // ], [
        //     'name_en.required' => 'الاسم مطلوب',
        //     'name_ar.required' => 'الاسم مطلوب',
        //     'phone.required' => 'رقم الهاتف مطلوب',
        //     'phone.unique' => 'رقم الهاتف موجود من قبل',
        //     'address_en.required' => 'الشركة مطلوبة',
        //     'address_ar.required' => 'الشركة مطلوبة',
        //     'lat.required' => 'الشركة مطلوبة',
        //     'long.required' => 'الشركة مطلوبة',

        // ]);
        DB::beginTransaction();

        $image = $request->file('logo');
        $ext = $image->getClientOriginalName();
        $logo = "logo-" . uniqid() . ".$ext";
        $image->move(public_path('images/clinics'), $logo);

        

        $clinic = Clinic::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'phone' => $request->phone,
            'lat' => $request->lat,
            'long' => $request->long,           
            'logo' => $logo,
            'whatsapp'=>$request->whatsapp,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'max_doctor'=>$request->max_doctor,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rate' => 0,
            'location_link'=>$request->location_link,
           
            'video' => $request->video,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalName();
                $name = "clinic-" . uniqid() . ".$ext";
                $image->move(public_path('images/clinics'), $name);
               
                ClinicImage::create([
                    'clinic_id'=>$clinic->id,
                    'image'=>$name,
                ]);
            }
        }

        foreach ($request->specialization as $special) {
            ClinicSpecialization::create([
                'clinic_id' => $clinic->id,
                'specialization_id' => $special,
            ]);
        }
        foreach ($request->day_id as $key => $day) {
            $start1 = $request->start1;
            $start2 = $request->start2;
            $end1 = $request->end1;
            $end2 = $request->end2;
            
            ClinicAppointment::create([
                'clinic_id' => $clinic->id,
                'day_id'=>$day,
                'start1'=>(isset($start1[$key])) ? $start1[$key] : null,
                'end1'=>(isset($end1[$key])) ? $end1[$key] : null,
                'start2'=>(isset($start2[$key])) ? $start2[$key] : null,
                'end2'=>(isset($end2[$key])) ? $end2[$key] : null,
              
            ]);
        }
        foreach ($request->insurances as $insurance) {
            ClinicInsurance::create([
                'clinic_id' => $clinic->id,
                'insurance_id' => $insurance,
            ]);
        }
         foreach ($request->address_ar as $key => $address) {
           
            $address_en = $request->address_en;
            
            AddressClinic::create([
                'clinic_id' => $clinic->id,
                'address_ar'=>$address,
                'address_en'=>(isset($address_en[$key])) ? $address_en[$key] : null,
                
              
            ]);
        }
        
        
        DB::commit();
        return redirect()->route('clinics.index')->with(['success' => 'Clinic Added Successfully']);
    }
    public function edit($id)
    {
       $days=Day::get();
        $s = Specialization::get();
          $m=ClinicSpecialization::where('clinic_id',$id)->pluck('specialization_id')->toArray();
          $I=ClinicInsurance::where('clinic_id',$id)->pluck('insurance_id')->toArray();
        $insurances = Insurance::get();
        $appointments=ClinicAppointment::where('clinic_id',$id)->get();
        $clinic = Clinic::findOrFail($id);
        $address=AddressClinic::where('clinic_id',$id)->get();

        return view('dashboard.clinics.edit', compact('s', 'insurances','clinic','appointments','address','m','I'));
    }
    public function update(Request $request, $id)
    {
    //  return $request;
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'phone' => 'required|unique:clinics,phone,' . $id,
            'description_ar'=>'required',
            'description_en'=>'required',
           'lat' => 'required',
            'long' => 'required',
            'email' => 'required|unique:clinics,email,' . $id,
            
            'video' => 'required',
        ], [
            'name_en.required' => 'الاسم مطلوب',
            'name_ar.required' => 'الاسم مطلوب',

            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف موجود من قبل',

            'address_en.required' => 'الشركة مطلوبة',
            'address_ar.required' => 'الشركة مطلوبة',
            'lat.required' => 'الشركة مطلوبة',
            'long.required' => 'الشركة مطلوبة',

        ]);
        $clinic = Clinic::findOrFail($id);
        DB::beginTransaction();
        $logo = $clinic->logo;
        if ($request->file('logo')) {
           

            $image = $request->file('logo');
            $ext = $image->getClientOriginalName();
            $logo = "logo-" . uniqid() . ".$ext";
            $image->move(public_path('images/clinics'), $logo);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalName();
                $name = "clinic-" . uniqid() . ".$ext";
                $image->move(public_path('images/clinics'), $name);
               
                ClinicImage::create([
                    'clinic_id'=>$clinic->id,
                    'image'=>$name,
                ]);
            }
        }
        if($request->insurances)
        {
            ClinicInsurance::where('clinic_id',$clinic->id)->delete();
            foreach ($request->insurances as $insurance) {
                ClinicInsurance::create([
                    'clinic_id' => $clinic->id,
                    'insurance_id' => $insurance,
                ]);
            }
        }
        if($request->specialization)
        {
            ClinicSpecialization::where('clinic_id',$clinic->id)->delete();
            foreach ($request->specialization as $special) {
                ClinicSpecialization::create([
                    'clinic_id' => $clinic->id,
                    'specialization_id' => $special,
                ]);
            }
        }
        foreach ($request->day_id  as $key => $day) {
             $start1 = $request->start1;
            $start2 = $request->start2;
            $end1 = $request->end1;
            $end2 = $request->end2;
            ClinicAppointment::where('clinic_id',$clinic->id)->where('day_id',$day)->update([
                'clinic_id' => $clinic->id,
                'day_id'=>$day,
                'start1'=>(isset($start1[$key])) ? $start1[$key] : null,
                'end1'=>(isset($end1[$key])) ? $end1[$key] : null,
                'start2'=>(isset($start2[$key])) ? $start2[$key] : null,
                'end2'=>(isset($end2[$key])) ? $end2[$key] : null,
              
            ]);
        }
        if($request->address_ar)
        {
          AddressClinic::where('clinic_id',$clinic->id)->delete();
               foreach ($request->address_ar as $key => $address) {
           
            $address_en = $request->address_en;
            
            AddressClinic::create([
                'clinic_id' => $clinic->id,
                'address_ar'=>$address,
                'address_en'=>(isset($address_en[$key])) ? $address_en[$key] : null,
                
              
            ]);
        }
          
        }
   
        
        $clinic->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'phone' => $request->phone,
            'lat' => $request->lat,
            'long' => $request->long,           
            'logo' => $logo,
            'whatsapp'=>$request->whatsapp,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'max_doctor'=>$request->max_doctor,
            'email' => $request->email,
           
            'location_link'=>$request->location_link,
           
            'video' => $request->video,
          

        ]);
        DB::commit();
        return redirect()->route('clinics.index')->with(['success' => 'Clinic Edited Successfully']);
    }
    public function delete($id)
    {
        Clinic::findOrFail($id)->delete();
        return redirect()->route('clinics.index')->with(['success' => 'Clinic Deleted Successfully']);
    }
    public function images($id)
    {
       $images= ClinicImage::where('clinic_id',$id)->get();
         return view('dashboard.clinics.images', compact('images'));
    }
    public function delete_image($id)
    {
         ClinicImage::where('id',$id)->delete();
         return redirect()->route('clinics.images')->with(['success' => 'Deleted Successfully']);
    }
    public function get_all_appointments($id)
    {
       
        $appointments =PatientBooking::where('clinic_id',$id)->get();
        return view('dashboard.clinics.appointment', compact('appointments'));
    }
}
