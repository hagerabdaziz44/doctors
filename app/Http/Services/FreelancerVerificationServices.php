<?php

namespace App\Http\Services;


use App\Models\VerficationFreelancer;
use Illuminate\Support\Facades\Auth;


class FreelancerVerificationServices
{
    /** set OTP code for mobile
     * @param $data
     *
     * @return VerficationFreelancer
     */
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        VerficationFreelancer::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return VerficationFreelancer::create($data);
    }

    public function getSMSVerifyMessageByAppName( $code)
    {
            //$message = " is your verification code for your account".$code;
             return $code;
    }


    // public function checkOTPCode ($code){

    //     if (Auth::guard()->check()) {
    //         $verificationData = Verfication::where('user_id',Auth::id()) -> first();

    //         if($verificationData -> code == $code){
    //             User::whereId(Auth::id()) -> update(['email_verified_at' => now()]);
    //             return true;
    //         }else{
    //             return false;
    //         }
    //     }
    //     return false ;
    // }


    // public function removeOTPCode($code)
    // {
    //     Verfication::where('code',$code) -> delete();
    // }

}
