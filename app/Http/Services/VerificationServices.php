<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\UserVerification;
use App\Models\Verification;

use Illuminate\Support\Facades\Auth;


class VerificationServices
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
        UserVerification ::whereNotNull('patient_id')->where(['patient_id' => $data['patient_id']])->delete();
        return UserVerification::create($data);
    }

    public function getSMSVerifyMessageByAppName( $code)
    {
            $message = " is your verification code for your account";
             return $code;
    }




}
