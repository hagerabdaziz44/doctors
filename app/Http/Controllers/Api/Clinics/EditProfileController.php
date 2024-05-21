<?php

namespace App\Http\Controllers\Api\Clinics;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\ClinicImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EditProfileController extends Controller
{

    public function Editprofile(Request $request)
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
                // 'start' => 'required',
                // 'end' => 'required',
                'cover' => 'nullable',
                'logo' => 'nullable',
                'email' => 'required|unique:clinics,email,' . Auth::guard('clinic-api')->user()->id,


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



        $clinic = Clinic::where('id', Auth::guard('clinic-api')->user()->id)->first();
        $cover = $clinic->cover;
        $logo = $clinic->logo;
       if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalName();
                $name = "clinic-" . uniqid() . ".$ext";
                $image->move(public_path('images/clinics'), $name);
               
                ClinicImage::create([
                    'clinic_id'=>$clinic->id,
                    'image'=>$name,
                ]);
            }
        }
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $ext = $image->getClientOriginalName();
            $logo = "logo-" . uniqid() . ".$ext";
            $image->move(public_path('images/clinics'), $logo);
        }

      
        DB::beginTransaction();


        $clinic->update([

            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'phone' => $request->phone,
           
            'lat' => $request->lat,
            'long' => $request->long,
            //  'start' => $request->start,
            // 'end' => $request->end,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
           
            'logo' => $logo,
            
            'email' => $request->email,
            'video' => $request->video,
        ]);
        DB::commit();
        return Response::json(array(
            'message' => trans('msg.updateSuccess'),
        ));
    }
    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password'
        ], [

            'password.required' => trans('editProfile.passwordRequired'),
            'confirm_password.required' => trans('editProfile.confirm_passwordRequired'),
            'confirm_password.same' => trans('editProfile.confirm_passwordSame'),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(), 'status' => 422
            ]);
        }
        $user = Auth::guard('clinic-api')->user();
        if (Hash::check($request->old_password, $user->password)) {
            Clinic::findOrfail(Auth::guard('clinic-api')->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => trans('msg.pwSuccess'),
            ], 200);
        } else {
            return response()->json([
                'message' => trans('msg.pwError'),
            ], 400);
        }
    }
    public function delete_image(Request $request)
    {
       ClinicImage::where('id',$request->id)->delete();
       return Response::json(array(
            'message' => trans('msg.delete'),
        ));
    }
 
}
