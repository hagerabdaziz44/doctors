<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\VerificationServices;
use App\Models\Client;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\SMSGateways\VictoryLinkSms;
use App\Models\UserVerification;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    // use GeneralTrait;
    public $sms_services;

    public function __construct(VerificationServices $sms_services)
    {

        $this -> sms_services = $sms_services;
    }

    public function Register(Request $request)
    {
          $validator = Validator::make($request->all(),[
           'email' => 'required|unique:patients,email' ,
           'password'=>'required',
           'password_confirmation' => 'required|same:password',
           'name'=>'required',
           'phone'=>'required',
       ]
       ,[
           'email.required'=>trans('auth.email.register'),
           'email.unique'=>trans('auth.email.unique.register'),
    
           
        ]);
    if ($validator->fails()) {
        return response()->json(['message'=>$validator->errors()->first()]);


    }
          
       $user =Patient::create([
           'name' => $request->name,
           'phone' => $request->phone,
         'email' => $request->email,
          'password'=>Hash::make($request->password),
          'photo'=>"",
        ]);

     return response()->json([
           'message' =>trans('auth.register.success'),
           'user' => $user,
       ]);
    }
         //logout
    public function logout(Request $request)
{
    $token = $request -> header('auth-token');
        if($token){
            // try {

                JWTAuth::setToken($token)->invalidate(); //logout
            // }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            //     return  $this -> returnError('','some thing went wrongs');
            // }
            return response()->json(['message' =>trans('auth.logout.success')]);
        }else{
            return response()->json(['message' =>trans('auth.logout.failed')]);
        }
}
public function getUserById($id)
{
    $user=Patient::where('id',$id)->first();
    return Response::json(array(
        'data'=>$user,
    ));
}
public function getUserData()
{
    $user=Patient::where('id',Auth::guard('user-api')->user()->id)->first();
    return Response::json(array(
        'data'=>$user,
    ));
}
public function GetAllClients()
{
    $users=Patient::get();
    return Response::json(array(
        'data'=>$users,
    ));
}
public function login(Request $request)
{
    $validator = Validator::make($request->all(),[
        'email' => 'required|exists:patients,email' ,
        'password' => 'required|string' ,
    ] ,[
        'email.required'=>trans('auth.email.register'),
      
       'password.required'=>trans('auth.password.register'),
      
       'email.exists'=>trans('auth.login.exists')
     ]);
     if ($validator->fails()) {
        return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
   
    }
    $credentials = request(['email', 'password']);
    if (! $token = auth::guard('user-api')->attempt($credentials)) {
      
       return response()->json(['message' =>trans('auth.login.failed')], 401);
    }

    return $this->respondWithToken($token);

}
protected function respondWithToken($token)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'status'=>200,
        'message'=>trans('auth.login.success'),
        'user'=>Auth::guard('user-api')->user(),
    ]);
}
public function OTPlogin(Request $request)
{
      $phone=$request->phone;
  $validator = Validator::make($request->all(),[
        'phone' => 'required|exists:patients,phone' ,

    ] ,[
        'phone.required'=>'البريد الالكتروني مطلوب',

        'phone.exists'=>'الرقم غير موجود',
     ]);
     if ($validator->fails()) {

        return response()->json(['message'=>$validator->errors()->first()]);


    }
$patient=Patient::where('phone',$phone)->first();
     $verification = [];
$verification['patient_id'] = $patient->id;
$verification_data =  $this->sms_services->setVerificationCode($verification);
$message = $this->sms_services->getSMSVerifyMessageByAppName($verification_data -> code );
 app(VictoryLinkSms::class) -> sendSms($patient->phone,$message);
 return response()->json([

        'status'=>200,
        'message'=>'تم ارسال الكود بنجاح',
        'code'=>$verification_data -> code,

    ]);


}
public function CheckCode( Request $request )
{

$user=Patient::where('phone',$request->phone)->first();
$user_id=$user->id;
$usercode=UserVerification::where('patient_id',$user_id)->first();

$code=$usercode->code;
if($code ==$request->code)
{
$token= auth()->guard('user-api')->login($user);
                return $this->respondWithToken($token);
}

else {
return response()->json(['message' => "هناك خطا في الكود"], 422);


}
}

    public function ftoken(Request $request)
    {

        $user = Patient::where('id', Auth::guard('user-api')->user()->id)->update(
            ['ftoken' => $request->ftoken]
        );
        return Response::json(array(
            'message' => 'تمت الاضافة بنجاح',
        ));
    }
    public function all_users_notifications()
    {
         $notifications= Notification::where('receiver_id',Auth::guard('user-api')->user()->id)->where('receiver_type','user')->get();
        return response()->json([
            
            'noifications'   => $notifications
        ]);
    }
    public function removeFCMToken(Request $request)
    {
        $client =  Patient::where('id', Auth::guard('user-api')->user()->id)->first();
        $client->ftoken = 0;
        $client->save();
        return response()->json([
            'message' => 'success',
        ]);
    }

}


