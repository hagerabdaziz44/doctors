<?php

namespace App\Http\Controllers\Api\Clinics;

use App\Http\Controllers\Controller;
use App\Http\Services\ClinicVerificationServices;
use App\Http\Services\DoctorVerificationServices;
use App\Http\Services\SMSGateways\VictoryLinkSms;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\ClinicVerification;
use App\Models\Doctor;
use App\Models\AddressClinic;
use App\Models\DoctorVerification;
use App\Models\Group;
use App\Models\ClinicInsurance;
use App\Models\ClinicSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public $sms_services;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClinicVerificationServices $sms_services)
    {
        $this -> sms_services = $sms_services;
    }

    // use GeneralTrait;

    public function Register(Request $request)
    {

         $validator = Validator::make(
            $request->all(),
            [
                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'phone' => 'required|string',
                'address_en' => 'required',
                'address_ar' => 'required',
                'lat' => 'required',
                'long' => 'required',
                'cover'=>'required',
                'logo'=>'required',
                'email'=>'required|unique:clinics,email',
                'password'=>'required',
                'start'=>'required',
                'end'=>'required',

            ],
            [

                'name_en.required' => trans('auth.nameRegister'),
                'name_en.string' => trans('auth.string.register'),
                'name_ar.required' => trans('auth.nameRegister'),
                'name_ar.string' => trans('auth.string.register'),
                'phone.required' => trans('auth.phone.register'),
                'phone.unique' => trans('auth.phone.unique.register'),
                'address_en.required' => trans('doctor.address_en'),
                'address_ar.required' => trans('doctor.address_ar'),
                'lat.required' => trans('doctor.lat'),
                'long.required' => trans('doctor.long'),

            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $photo = $request->file('cover');
        $ext = $photo->getClientOriginalName();
        $cover = "cover-" . uniqid() . ".$ext";
        $photo->move(public_path('images/clinics'), $cover)
        ;
        $image = $request->file('logo');
        $ext = $image->getClientOriginalName();
        $logo = "logo-" . uniqid() . ".$ext";
        $image->move(public_path('images/clinics'), $logo);



        $clinic = Clinic::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'phone' => $request->phone,
            'address_en' => $request->address_en,
            'address_ar' => $request->address_ar,
            'lat' => $request->lat,
            'long' => $request->long,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'cover'=>$cover,
            'logo'=>$logo,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'rate'=>0,
            'start'=>$request->start,
            'end'=>$request->end,
            'video'=>$request->video,

        ]);

        $insurance=$request->insurance_ids;
        foreach ($insurance as $i)
        {
            ClinicInsurance::create([
            'clinic_id'=>$clinic->id,
            'insurance_id'=>$i,
           ]);
        }
        $specialization=$request->specialization_ids;
        foreach ($specialization as $special)
        {
            ClinicSpecialization::create([
            'clinic_id'=>$clinic->id,
            'specialization_id'=>$special,
           ]);
        }
        // $startDate = Carbon::createFromFormat('H:i',$clinic->start);
        // $endDate = Carbon::createFromFormat('H:i',$clinic->end);

        // $check = Carbon::now()->between($startDate, $endDate, true);

        // if($check){
        //     $clinic->status ="open";

        // }else{
        //     $clinic->status ="closed";
        // }
        // $clinic->save();
        
        return response()->json([
            'message' => trans('auth.register.success'),
            'clinic' => $clinic,

        ]);
    }
    //login
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:clinics,email',
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
        if (!$token = Auth::guard('clinic-api')->attempt($credentials)) {

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
            'user' => Auth::guard('clinic-api')->user(),
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

    public function getClinicData()
    {
        $clinic = Clinic::where('id', Auth::guard('clinic-api')->user()->id)
                ->get();
             $clinic->map(function ($clinic){

            $clinic['address']=AddressClinic::where('clinic_id',$clinic['id'])->select('id','address_'.app()->getLocale() .' as name')->get();
         
    
        });
       
        return Response::json(array(
            'data' => $clinic,
        ));
    }


    public function ftoken(Request $request)
    {

        $user = Clinic::where('id', Auth::guard('clinic-api')->user()->id)->update(
            ['ftoken' => $request->ftoken]
        );
        return Response::json(array(
            'message' => 'تمت الاضافة بنجاح',
        ));
    }
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

        $clinic = Clinic::where('phone', $request->phone)->first();
        $clinic_id = $clinic->id;
        $cliniccode = ClinicVerification::where('clinic_id', $clinic_id)->first();

        $code = $cliniccode->code;
        if ($code == $request->code) {
            $token = auth()->guard('clinic-api')->login($clinic);
            return $this->respondWithToken($token);
        } else {
            return response()->json(['message' => "هناك خطا في الكود"], 422);
        }
    }

    public function OTPlogin(Request $request)
    {
        $phone = $request->phone;
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:clinics,phone',

        ], [
            'phone.required' => ' رقم الهاتف مطلوب',

            'phone.exists' => 'الرقم غير موجود',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $clinic = Clinic::where('phone', $phone)->first();
        $verification = [];
        $verification['clinic_id'] = $clinic->id;
        $verification_data =  $this->sms_services->setVerificationCode($verification);
        $message = $this->sms_services->getSMSVerifyMessageByAppName($verification_data->code);
        app(VictoryLinkSms::class)->sendSms($clinic->phone, $message);
        $code = ClinicVerification::where('clinic_id',$clinic)->get();
        return response()->json([

            'status' => 200,
            'message' => 'تم ارسال الكود بنجاح',
            'code' => $verification_data['code']

        ]);
    }
}
