<?php

namespace App\Http\Controllers\Api\Clinics;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Holiday;
use App\Models\ClinicAppointment;
use App\Models\AddressClinic;
use App\Models\ClinicImage;
use App\Models\Notification;
use App\Models\PatientBooking;
use App\Models\PatientClinicAppointment;
use App\Models\ClinicInsurance;
use App\Models\ClinicSpecialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function all_clinics(){
        $clinics = Clinic::select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate','status','video','whatsapp','instagram','facebook','location_link','max_doctor')->get();
        $clinics->map(function ($clinics){

            $clinics['insurances']=ClinicInsurance::where('clinic_id',$clinics['id'])->with(['insurance' => function ($q) { $q->select('id','body_'.app()->getLocale() .' as body','title_'.app()->getLocale() .' as title','photo');}])->get();
         
    
        });
        $clinics->map(function ($clinics){

            $clinics['specializations']=ClinicSpecialization::where('clinic_id',$clinics['id'])->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['appointments']=ClinicAppointment::where('clinic_id',$clinics['id'])->where('start1','!=',null)->where('start2','!=',null)->where('end2','!=',null)->where('start1','!=',null)->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['images']=ClinicImage::where('clinic_id',$clinics['id'])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['address']=AddressClinic::where('clinic_id',$clinics['id'])->select('id','address_'.app()->getLocale() .' as name')->get();
         
    
        });
        
        $clinics->map(function ($clinics){

            $clinics['doctors']=Doctor::where('clinic_id',$clinics['id'])->select('id','name_'.app()->getLocale() .' as name','specialization_id','photo','rate','education_'.app()->getLocale() .' as education')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
        return response()->json([
            'message' => 'success',
            'clinics'   => $clinics
        ]);
    }
    public function get_clinic_by_id(Request $request)
    {
        $clinics = Clinic::where('id',$request->clinic_id)->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate','status','video','whatsapp','instagram','facebook','location_link','max_doctor')->get();
        $clinics->map(function ($clinics){

            $clinics['insurances']=ClinicInsurance::where('clinic_id',$clinics['id'])->with(['insurance' => function ($q) { $q->select('id','body_'.app()->getLocale() .' as body','title_'.app()->getLocale() .' as title','photo');}])->get();
         
    
        });
        $clinics->map(function ($clinics){

            $clinics['specializations']=ClinicSpecialization::where('clinic_id',$clinics['id'])->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['appointments']=ClinicAppointment::where('clinic_id',$clinics['id'])->where('start1','!=',null)->where('start2','!=',null)->where('end2','!=',null)->where('start1','!=',null)->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['images']=ClinicImage::where('clinic_id',$clinics['id'])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['address']=AddressClinic::where('clinic_id',$clinics['id'])->select('id','address_'.app()->getLocale() .' as name')->get();
         
    
        });
        
        $clinics->map(function ($clinics){

            $clinics['doctors']=Doctor::where('clinic_id',$clinics['id'])->select('id','name_'.app()->getLocale() .' as name','specialization_id','photo','rate','education_'.app()->getLocale() .' as education')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
        return response()->json([
            'message' => 'success',
            'clinics'   => $clinics
        ]);

    }
    public function get_clincics_by_specialization_id(Request $request)
    {
        $all = ClinicSpecialization::where('specialization_id',$request->special_id)->get(['clinic_id']); 
        $clinics = Clinic::whereIn('id',$all)->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate','status','video','whatsapp','instagram','facebook','location_link','max_doctor')->get();
        $clinics->map(function ($clinics){

            $clinics['insurances']=ClinicInsurance::where('clinic_id',$clinics['id'])->with(['insurance' => function ($q) { $q->select('id','body_'.app()->getLocale() .' as body','title_'.app()->getLocale() .' as title','photo');}])->get();
         
    
        });
        $clinics->map(function ($clinics){

            $clinics['specializations']=ClinicSpecialization::where('clinic_id',$clinics['id'])->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['appointments']=ClinicAppointment::where('clinic_id',$clinics['id'])->where('start1','!=',null)->where('start2','!=',null)->where('end2','!=',null)->where('start1','!=',null)->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['images']=ClinicImage::where('clinic_id',$clinics['id'])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['address']=AddressClinic::where('clinic_id',$clinics['id'])->select('id','address_'.app()->getLocale() .' as name')->get();
         
    
        });
        
        $clinics->map(function ($clinics){

            $clinics['doctors']=Doctor::where('clinic_id',$clinics['id'])->select('id','name_'.app()->getLocale() .' as name','specialization_id','photo','rate','education_'.app()->getLocale() .' as education')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
        return response()->json([
            'message' => 'success',
            'clinics'   => $clinics
        ]);
        
    }
    public function get_clincics_by_insurance_id(Request $request)
    {
       $all = ClinicInsurance::where('insurance_id',$request->insurance_id)->get(['clinic_id']); 
        $clinics = Clinic::whereIn('id',$all)->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate','status','video','whatsapp','instagram','facebook','location_link','max_doctor')->get();
        $clinics->map(function ($clinics){

            $clinics['insurances']=ClinicInsurance::where('clinic_id',$clinics['id'])->with(['insurance' => function ($q) { $q->select('id','body_'.app()->getLocale() .' as body','title_'.app()->getLocale() .' as title','photo');}])->get();
         
    
        });
        $clinics->map(function ($clinics){

            $clinics['specializations']=ClinicSpecialization::where('clinic_id',$clinics['id'])->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['appointments']=ClinicAppointment::where('clinic_id',$clinics['id'])->where('start1','!=',null)->where('start2','!=',null)->where('end2','!=',null)->where('start1','!=',null)->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['images']=ClinicImage::where('clinic_id',$clinics['id'])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['address']=AddressClinic::where('clinic_id',$clinics['id'])->select('id','address_'.app()->getLocale() .' as name')->get();
         
    
        });
        
        $clinics->map(function ($clinics){

            $clinics['doctors']=Doctor::where('clinic_id',$clinics['id'])->select('id','name_'.app()->getLocale() .' as name','specialization_id','photo','rate','education_'.app()->getLocale() .' as education')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
        return response()->json([
            'message' => 'success',
            'clinics'   => $clinics
        ]);
        
    }
    public function search (Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
               

            ],
            [

                'name.required' => trans('auth.nameRegister'),
             

            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

      $keyword=$request->name;
        $clinics = Clinic::where('name_'.app()->getLocale(),'LIKE' ,"%$keyword%")->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate','status','video','whatsapp','instagram','facebook','location_link','max_doctor')->get();
        $clinics->map(function ($clinics){

            $clinics['insurances']=ClinicInsurance::where('clinic_id',$clinics['id'])->with(['insurance' => function ($q) { $q->select('id','body_'.app()->getLocale() .' as body','title_'.app()->getLocale() .' as title','photo');}])->get();
         
    
        });
        $clinics->map(function ($clinics){

            $clinics['specializations']=ClinicSpecialization::where('clinic_id',$clinics['id'])->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['appointments']=ClinicAppointment::where('clinic_id',$clinics['id'])->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['images']=ClinicImage::where('clinic_id',$clinics['id'])->get();
         
    
        });
         $clinics->map(function ($clinics){

            $clinics['address']=AddressClinic::where('clinic_id',$clinics['id'])->select('id','address_'.app()->getLocale() .' as name')->get();
         
    
        });
        
        $clinics->map(function ($clinics){

            $clinics['doctors']=Doctor::where('clinic_id',$clinics['id'])->select('id','name_'.app()->getLocale() .' as name','specialization_id','photo','rate','education_'.app()->getLocale() .' as education')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();
         
    
        });
         return response()->json([
            'message' => 'success',
            'clinics'   => $clinics
        ]);
        
    }
     public function get_all_specializetions_of_clinic()
    {
        $all = ClinicSpecialization::where('clinic_id',Auth::guard('clinic-api')->user()->id)->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get(); 
        return response()->json([
            'message' => 'success',
            'all'   => $all
        ]);
    }
    public function accept(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
               'patient_booking_id' => 'required|exists:patient_bookings,id'
            ],
            [
                'patient_booking_id.required' => trans('doctor.clinic_id'),
                'patient_booking_id.exists' => trans('doctor.clinic_id_exists')
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        PatientBooking::where('id',$request->patient_booking_id)->update([
            'status'=>'approved'
        ]);
        $data=PatientBooking::where('id',$request->patient_booking_id)->first();
        $name=Clinic::where('id',$data->clinic_id)->first();
           $notify = new  Notification();
        $notify->sender_id =$data->clinic_id;
        $notify->receiver_id =$data->patient_id ;
        $notify->title = "Appointment booking request";

        $notify->content = "your Appointment booking request approved by".$name->name_en;
         $notify->sender_type='clinic';
        $notify->receiver_type='user';

        $notify->save();
        $res =ClinicController::pushNotification($notify);
        return response()->json([
            'message' => 'success',
            
        ]);
    }
    public function reject(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
               'patient_booking_id' => 'required|exists:patient_bookings,id'
            ],
            [
                'patient_booking_id.required' => trans('doctor.clinic_id'),
                'patient_booking_id.exists' => trans('doctor.clinic_id_exists')
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        
        PatientBooking::where('id',$request->patient_booking_id)->update([
            'status'=>'rejected'
        ]);
        $data=PatientBooking::where('id',$request->patient_booking_id)->first();
        $name=Clinic::where('id',$data->clinic_id)->first();
           $notify = new  Notification();
        $notify->sender_id =$data->clinic_id;
        $notify->receiver_id =$data->patient_id ;
        $notify->title = "Appointment booking request";

        $notify->content = "your Appointment booking request rejected by".$name->name_en;
         $notify->sender_type='clinic';
        $notify->receiver_type='user';

        $notify->save();
        return response()->json([
            'message' => 'success',
            
        ]);
    }
    public function done(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
               'patient_booking_id' => 'required|exists:patient_bookings,id'
            ],
            [
                'patient_booking_id.required' => trans('doctor.clinic_id'),
                'patient_booking_id.exists' => trans('doctor.clinic_id_exists')
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        PatientBooking::where('id',$request->patient_booking_id)->update([
            'status'=>'done'
        ]);
        return response()->json([
            'message' => 'success',
            
        ]);
    }
     public function get_all_requests()
    {
        $all= PatientBooking::where('status','pending')->where('clinic_id',Auth::guard('clinic-api')->user()->id)->with(
            ['patient',
            'doctor' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name','specialization_id')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}]);},
            'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');},'doctorappointment'=> function ($q) { $q->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}]);}])->get();;
           return response()->json([
            'message' => 'success',
            'all'=> $all
        ]);   
    
    }
      public function get_all_approved_requests()
    {
        $all= PatientBooking::where('status','approved')->where('clinic_id',Auth::guard('clinic-api')->user()->id)->with(
            ['patient',
            'doctor' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name','specialization_id')->with(['specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}]);},
            'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');},'doctorappointment'=> function ($q) { $q->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}]);}])->get();;
           return response()->json([
            'message' => 'success',
            'all'=> $all
        ]);   
    
    }
    
    public function get_doctors_clinics_specialization(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'clinic_id' => 'required|exists:clinics,id',
                'specialization_id' => 'required|exists:specializations,id'
            ],

        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $all = Doctor::select('id', 'name_' . app()->getLocale() . ' as name','phone','gender','photo','cost','specialization_id','clinic_id','rate')->where('clinic_id', $request->clinic_id)->where('specialization_id', $request->specialization_id)->with(
            [
                'specialization' => function ($q) {

                    $q->select('id', 'name_' . app()->getLocale() . ' as name');
                },
                'clinic' => function ($q) {
                    $q->select('id', 'name_' . app()->getLocale() . ' as name','logo');
                }
            ]
        )->get();;

        return response()->json([
            'message' => 'success',
            'doctors'   => $all
        ]);
    }
    public function add_holiday(Request $request)
    {
        foreach($request->dates as $date)
        {
            Holiday::create([
                'clinic_id'=>Auth::guard('clinic-api')->user()->id,
                'date'=>$date,
            ]
                
            );
        }
        return response()->json([
            'message' => 'success',
            
        ]);
        
    }
    public function get_all_notifications_of_clinic()
    {
       $notifications= Notification::where('receiver_id',Auth::guard('clinic-api')->user()->id)->where('receiver_type','clinic')->get();
        return response()->json([
            
            'noifications'   => $notifications
        ]);
    }
    public function get_all_booking_list_for_clinic()
    {
       $list= PatientClinicAppointment::where('clinic_id',Auth::guard('clinic-api')->user()->id)->with( [
        'patient',
        'days' => function ($q) {
            $q->select('id', 'name_' . app()->getLocale() . ' as name');
        }
    ])->get();
        return response()->json([
            
            'list'   => $list
        ]);
    }
     public static function pushNotification(Notification $request)
    {

            $data = [
                'title' => $request->title,
                'body' => $request->content,


            ];


            $fields = [
              // 'to' => '/topics/azabAndroid',
                 'to' => Patient::find($request->receiver_id)->ftoken,
                // 'registration_ids'  => $registrationIds,
                    'notification'      => $data,
                // 'data' => $data,
                'sound' => 'activated',
                'content_available' => true,
                'priority' => 'high',
            ];

         $headers = [
                'Authorization: key=AAAAIoYkexs:APA91bEBxBkeb9S51aWOfzGQ6T9aL3ticyFlqNv2MNfSvcx0W7zK4G6ZXiajuq92NAstNggBQf8g7U09O1Nr0ttWg6Zllff-LU_v0wbta5_JweK8JGGVBWYRfPIRxRfx3Bzq8VUGevbe',
                'Content-Type: application/json'
            ];

            // return $fields;
            #Send Response To FireBase Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            #Echo Result Of FireBase Server
            return $result;

    }
    

}
