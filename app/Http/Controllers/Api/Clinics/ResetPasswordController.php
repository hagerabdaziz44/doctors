<?php

namespace App\Http\Controllers\Api\Clinics;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\ResetCodePassword;
use App\Models\UserResetCodePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
  public function code(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|exists:reset_code_passwords',
                'password' => 'required|string|max:50|min:5',
                'password_confirmation' => 'required|same:password'
            ],
            [
                'code.required' => trans('auth.code.required'),
                'code.exists' => trans('auth.code.exists'),
                'password.required' => trans('auth.password.register'),
                'password.min' => trans('auth.password.min.register'),
                'password.max' => trans('auth.password.max.register'),
                'confirm_password.same' => trans('editProfile.confirm_passwordSame'),
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);


        // find user's email
        $clinic = Clinic::firstWhere('email', $passwordReset->email);

        // update user password
        $clinic->update(['password' => Hash::make($request->password)]);

        // delete current code
        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }
    
    
    public function user_code(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|exists:user_reset_code_passwords',
                'password' => 'required|string|max:50|min:5',
                'password_confirmation' => 'required|same:password'
            ],
            [
                'code.required' => trans('auth.code.required'),
                'code.exists' => trans('auth.code.exists'),
                'password.required' => trans('auth.password.register'),
                'password.min' => trans('auth.password.min.register'),
                'password.max' => trans('auth.password.max.register'),
                'confirm_password.same' => trans('editProfile.confirm_passwordSame'),
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        // find the code
        $passwordReset = UserResetCodePassword::firstWhere('code', $request->code);


        // find user's email
        $patient = Patient::firstWhere('email', $passwordReset->email);

        // update user password
        $patient->update(['password' => Hash::make($request->password)]);

        // delete current code
        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }
}
