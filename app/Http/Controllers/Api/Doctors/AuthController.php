<?php

namespace App\Http\Controllers\Api\Doctors;

use App\Http\Controllers\Controller;
use App\Http\Services\DoctorVerificationServices;
use App\Http\Services\SMSGateways\VictoryLinkSms;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\DoctorInsurance;
use App\Models\DoctorVerification;
use App\Models\Group;
use App\Models\Insurance;
use App\Models\DoctorAppointmentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use App\Models\Clinic;

class AuthController extends Controller
{
    public $sms_services;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DoctorVerificationServices $sms_services)
    {

        $this->sms_services = $sms_services;
    }

    // use GeneralTrait;

    public function add(Request $request)
    {

         $validator = Validator::make(
            $request->all(),
            [

                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'cost' => 'required',
                'photo' => 'required',
                'education_en'=>'required',
                'education_ar'=>'required',
                'specialization_id' => 'required|exists:specializations,id'

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
        DB::beginTransaction();
        $photo = $request->file('photo');
        $ext = $photo->getClientOriginalName();
        $name = "doctor-" . uniqid() . ".$ext";
        $photo->move(public_path('images/doctors'), $name);

        $user = Doctor::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'specialization_id' => $request->specialization_id,
            'cost' => $request->cost,
            'photo' => $name,
            'clinic_id' => Auth::guard('clinic-api')->user()->id,
            'education_en'=>$request->education_en,
            'education_ar'=>$request->education_ar,
        ]);
    
       
         if($request->hours)
         {
            $type = $request->types;

            $clinic = Clinic::where('id', Auth::guard('clinic-api')->user()->id)->first();
            $start_time =  $clinic['start'];
            $end_time =  $clinic['end'];
            foreach ($hours as $key => $hour) {
                // if ($hours[$key] >= $start_time && $hours[$key] < $end_time) {
                    DoctorAppointmentDetail::create([
                        'doctor_id' => $user->id,
                        'clinic_id' => Auth::guard('clinic-api')->user()->id,
                        'hour' => $hour,
                        // 'type' => (isset($type[$key])) ? $type[$key] : null,
                        'day_id' => (isset($day[$key])) ? $day[$key] : null,
                    ]);
                } 

         }
        
        
        DB::commit();
        return response()->json([
            'message' => trans('auth.register.success'),
            'user' => $user,
        ]);
    }
    public function add_appointment(Request $request)
    {
        foreach ($request->appointments as $appointment)
        {
             $times=$appointment['times'];
            foreach($times as $time)
            {
                DoctorAppointmentDetail::create([
                    'doctor_id' => $request->doctor_id,
                    'clinic_id' => Auth::guard('clinic-api')->user()->id,
                    'hour' => $time,
                  
                    'day_id' =>$appointment['dayId'],
                ]);
            }
        }
        return response()->json([
            'message' => trans('auth.register.success'),
           
        ]);
    
       
        
    }
    public function get_all_doctors_of_clinic()
    {
        $doctor = Doctor::where('clinic_id',Auth::guard('clinic-api')->user()->id)->select('id','name_'.app()->getLocale() .' as name','photo','specialization_id','clinic_id')->with(
            [
            'specialization' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');},
        'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])->get();

       
        return response()->json([
            'message' => 'success',
            'doctors'   => $doctor
        ]);
    }
   
    //delete
   
    //login
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:doctors,email',
            'password' => 'required|string|max:50|min:5',
        ], [
            'email.required' => trans('auth.email.register'),
            'email.unique' => trans('auth.email.unique.register'),
            'password.required' => trans('auth.password.register'),
            'password.min' => trans('auth.password.min.register'),
            'password.max' => trans('auth.password.max.register'),
            'email.exists' => trans('auth.login.exists')
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $credentials = request(['email', 'password']);
        if (!$token = Auth::guard('doctor-api')->attempt($credentials)) {

            return response()->json(['message' => trans('auth.login.failed')], 401);
        }

        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'message' => trans('auth.login.success'),
            'user' => Auth::guard('doctor-api')->user(),
        ]);
    }

    //     //logout
    public function logout(Request $request)
    {
        $token = $request->header('auth-token');
        if ($token) {
            // try {

            JWTAuth::setToken($token)->invalidate(); //logout
            // }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            //     return  $this -> returnError('','some thing went wrongs');
            // }
            return response()->json(['message' => trans('auth.logout.success')]);
        } else {
            return response()->json(['message' => trans('auth.logout.failed')]);
        }
    }

    public function getDoctorData(Request $request)
    {

        $doctor = Doctor::where('id',$request->doctor_id)->select('id','name_'.app()->getLocale() .' as name','email','phone','gender','level_'.app()->getLocale() .' as level','university_'.app()->getLocale() .' as university','clinic_id','specialization_id')->with(
            ['specialization' => function ($q) {$q->select('id','name_'.app()->getLocale() .' as name');},
            'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])
            ->get();
            $doctor->map(function ($doctor) {
                $doctor['insurance'] = DoctorInsurance::where('doctor_id', $doctor['id'])->with(
                    [
                    'insurance' => function ($q) { $q->select('id','title_'.app()->getLocale() .' as title','body_'.app()->getLocale() .' as body','photo');}])
                    ->get();

            });

        return Response::json(array(
            'data' => $doctor,
        ));
    }
    public function getDoctorById(Request $request)
    {
        $doctor = Doctor::where('id',$request->doctor_id)->get();
        $doctor->map(function ($doctor) {
            $doctor['insurance'] = DoctorInsurance::where('doctor_id', $doctor['id'])->with(
                'insurance')
                ->get();

        });

        return Response::json(array(
            'data' => $doctor,
        ));
    }


    // public function ftoken(Request $request)
    // {

    //     $user = Client::where('id', Auth::guard('user-api')->user()->id)->update(
    //         ['ftoken' => $request->ftoken]
    //     );
    //     return Response::json(array(
    //         'message' => 'تمت الاضافة بنجاح',
    //     ));
    // }
    // public function removeFCMToken(Request $request)
    // {
    //     $client =  Client::where('id', Auth::guard('user-api')->user()->id)->first();
    //     $client->ftoken = '';
    //     $client->save();
    //     return response()->json([
    //         'message' => 'success',
    //     ]);
    // }

    public function CheckCode(Request $request)
    {

        $doctor = Doctor::where('phone', $request->phone)->first();
        $doctor_id = $doctor->id;
        $doctorcode = DoctorVerification::where('doctor_id', $doctor_id)->first();

        $code = $doctorcode->code;
        if ($code == $request->code) {
            $token = auth()->guard('doctor-api')->login($doctor);
            return $this->respondWithToken($token);
        } else {
            return response()->json(['message' => "هناك خطا في الكود"], 422);
        }
    }

    public function OTPlogin(Request $request)
    {
        $phone = $request->phone;
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:doctors,phone',

        ], [
            'phone.required' => ' رقم الهاتف مطلوب',

            'phone.exists' => 'الرقم غير موجود',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $doctor = Doctor::where('phone', $phone)->first();
        $verification = [];
        $verification['doctor_id'] = $doctor->id;
        $verification_data =  $this->sms_services->setVerificationCode($verification);
        $message = $this->sms_services->getSMSVerifyMessageByAppName($verification_data->code);
        app(VictoryLinkSms::class)->sendSms($doctor->phone, $message);
        $code = DoctorVerification::where('doctor_id', $doctor)->get();
        return response()->json([

            'status' => 200,
            'message' => 'تم ارسال الكود بنجاح',
            'code' => $verification_data['code']

        ]);
    }
}
