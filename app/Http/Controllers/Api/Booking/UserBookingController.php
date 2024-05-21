<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Models\PatientBooking;
use App\Models\Day;
use App\Models\Clinic;
use App\Models\Notification;
use App\Models\DoctorAppointmentDetail;
use App\Models\PatientClinicAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    public function book(Request $request)
    {
        PatientBooking::create([
            'clinic_id'=>$request->clinic_id,
            'patient_id'=>Auth::guard('user-api')->user()->id,
            'doctor_id'=>$request->doctor_id,
            'doctor_appointment_detail_id'=>$request->doctor_appointment_detail_id,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'date'=>$request->date,
            'fee'=>$request->fee,
        ]);
          $notify = new  Notification();
        $notify->sender_id =Auth::guard('user-api')->user()->id;
        $notify->receiver_id =$request->clinic_id;
        $notify->title = "Appointment booking request";

        $notify->content = "Appointment booking request by".Auth::guard('user-api')->user()->name;
         $notify->sender_type='user';
        $notify->receiver_type='clinic';

        $notify->save();
        $res =UserBookingController::pushNotification($notify);
        return response()->json([
            'message' => 'تم الحجز بنجاح',
           
        ]);    
          

    }
    public function clinic_book_appointment(Request $request)
    {
        PatientBooking::create([
            'clinic_id'=>Auth::guard('clinic-api')->user()->id,
            'doctor_id'=>$request->doctor_id,
            'doctor_appointment_detail_id'=>$request->doctor_appointment_detail_id,
          'fee'=>$request->fee,
            'date'=>$request->date,
          
        ]);
        
        return response()->json([
            'message' => 'تم الحجز بنجاح',
           
        ]);    
          
    }
    public function available_times(Request $request)
    {


    //   $all= PatientBooking::where('date',$request->date)->where('doctor_id',$request->doctor_id)->where('clinic_id',$request->clinic_id)->where('status','!=','rejected')->get(['doctor_appointment_detail_id']);
      $available_times=DoctorAppointmentDetail::where('day_id',$request->day_id)->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->where('clinic_id',$request->clinic_id)->where('doctor_id',$request->doctor_id)->get();
     
      $available_times->map(function ( $available_times){
        $today = Carbon::today()->toDateString();
        $all= PatientBooking::where('doctor_appointment_detail_id',$available_times->id)->where('date',$today)->where('doctor_id',$available_times->doctor_id)->where('clinic_id',$available_times->clinic_id)->where('status','!=','rejected')->count();
        if($all==0)
        {
            $available_times['status']=0;
        }
        else
        {
            $available_times['status']=1; 
        }
        
     

    });

      return response()->json([
        'message' => 'success',
        'available_times'=> $available_times
    ]);    
      

    }
    public function get_my_bookinglist(Request $request)
    {
       $all= PatientBooking::where('patient_id',Auth::guard('user-api')->user()->id)->with(
        [
            'doctor' => function ($q) { $q->select('id','photo','name_'.app()->getLocale() .' as name');},
            'clinic' => function ($q) { $q->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','address_'.app()->getLocale() .' as address','lat','long','logo','cover','rate');},'doctorappointment'=> function ($q) { $q->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}]);}])->get();;
       return response()->json([
        'message' => 'success',
        'all'=> $all
    ]);   

    }
     public function get_my_history(Request $request)
    {
       $all= PatientBooking::where('status','done')->where('patient_id',Auth::guard('user-api')->user()->id)->with(
        [
            'doctor' => function ($q) { $q->select('id','photo','name_'.app()->getLocale() .' as name');},
            'clinic' => function ($q) { $q->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','address_'.app()->getLocale() .' as address','lat','long','logo','cover','rate');},'doctorappointment'=> function ($q) { $q->with(['days' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}]);}])->get();;
       return response()->json([
        'message' => 'success',
        'all'=> $all
    ]);   
    }
    public function get_all_days()
    {
        $days=Day::select('id','name_'.app()->getLocale() .' as name')->get();
            return response()->json([
        'message' => 'success',
        'days'=> $days
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
                 'to' => Clinic::find($request->receiver_id)->ftoken,
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
    public function book_with_clinic(Request $request)
    {
        PatientClinicAppointment::create([
            'clinic_id'=>$request->clinic_id,
            'patient_id'=>Auth::guard('user-api')->user()->id,
            'date'=>$request->date,
            'day_id'=>$request->day_id,
            'hour'=>$request->hour,
            'lat'=>$request->lat,
            'long'=>$request->long,
        ]);
        return response()->json([
            'message' => 'success',
          
        ]); 
    }
}