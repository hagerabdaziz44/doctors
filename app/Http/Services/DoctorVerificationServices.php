<?php

namespace App\Http\Services;

use App\Models\DoctorVerification;
use App\Models\User;
use App\Models\ManagerVerification;

use Illuminate\Support\Facades\Auth;


class DoctorVerificationServices
{
    /** set OTP code for mobile
     * @param $data
     *
     * @return User_verfication
     */
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        DoctorVerification::whereNotNull('doctor_id')->where(['doctor_id' => $data['doctor_id']])->delete();
        return DoctorVerification::create($data);
    }

    public function getSMSVerifyMessageByAppName( $code)
    {
            $message = " is your verification code for your account";
             return $code;
    }




}
