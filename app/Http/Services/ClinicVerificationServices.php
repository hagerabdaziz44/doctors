<?php

namespace App\Http\Services;

use App\Models\ClinicVerification;



class ClinicVerificationServices
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
        ClinicVerification::whereNotNull('clinic_id')->where(['clinic_id' => $data['clinic_id']])->delete();
        return ClinicVerification::create($data);
    }

    public function getSMSVerifyMessageByAppName( $code)
    {
            $message = " is your verification code for your account";
             return $code;
    }




}
