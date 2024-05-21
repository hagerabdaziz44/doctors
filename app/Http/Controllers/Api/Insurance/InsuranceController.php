<?php

namespace App\Http\Controllers\Api\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class InsuranceController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'title_ar' => 'required',
                'title_en' => 'required',
                'body_ar' => 'required',
                'body_en' => 'required',
                'photo' => 'required|image',

            ],
            [
                'title_ar.required' => trans('doctor.title'),
                'title_en.required' => trans('doctor.title'),
                'body_ar.required' => trans('doctor.body'),
                'body_en.required' => trans('doctor.body'),
                'photo.required' => trans('auth.image.register'),

            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $photo = $request->file('photo');
        $ext = $photo->getClientOriginalName();
        $name = "insurance-" . uniqid() . ".$ext";
        $photo->move(public_path('images/insurances'), $name);
        $insurance = Insurance::create([
            'title_ar' => $request->title_ar,
            'title_en'=>$request->title_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
            'clinic_id' => Auth::guard('clinic-api')->user()->id,
            'photo' => $name
        ]);
        return response()->json([
            'message' => trans('auth.register.success'),
            'insurance' => $insurance,
        ]);
    }

    public function edit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'title_ar' => 'required',
                'title_en' => 'required',
                'body_ar' => 'required',
                'body_en' => 'required',
                'photo' => 'nullable',

            ],
            [
                'title_ar.required' => trans('doctor.title'),
                'title_en.required' => trans('doctor.title'),
                'body_ar.required' => trans('doctor.body'),
                'body_en.required' => trans('doctor.body'),

            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        $insurance = Insurance::where('clinic_id', Auth::guard('clinic-api')->user()->id)->where('id', $request->insurance_id)->first();
        DB::beginTransaction();
        $name = $insurance->photo;
        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalName();
            $name = "insurance-" . uniqid() . ".$ext";
            $photo->move(public_path('images/insurances'), $name);
        }

        $insurance->update([
            'title_ar' => $request->title_ar,
            'title_en'=>$request->title_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
            'clinic_id' => Auth::guard('clinic-api')->user()->id,
            'photo' => $name,
        ]);
        DB::commit();
        return Response::json(array(
            'message' => trans('msg.updateSuccess'),
        ));
    }
    public function delete(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'insurance_id' => 'required|exists:insurances,id'
            ],
            [
                'insurance_id.required' => trans('doctor.insurance_id'),
            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }
        Insurance::where('clinic_id', Auth::guard('clinic-api')->user()->id)->where('id', $request->insurance_id)->delete();
        return Response::json(array(
            'message' => trans('doctor.delete'),
        ));
    }

    public function get_all(Request $request)
    {
        $insurances=Insurance::select('id','title_'.app()->getLocale() .' as title','body_'.app()->getLocale() .' as body','photo','phone','email')->get();
        return Response::json(array(
            'message'=>'true',
            'insurances'=>$insurances,
            ));

    }
    public function get_by_id(Request $request)
    {
        // return $request;
        $insurances=Insurance::where('id',$request->insurance_id)->select('title_'.app()->getLocale() .' as title','body_'.app()->getLocale() .' as body','photo','phone','email')->first();
        return Response::json(array(
            'message'=>'true',
            'insurances'=>$insurances,
            ));
    }
    public function get_data(Request $request)
    {
        $insurance=Insurance::where('id',$request->insurance_id)->select('title_'.app()->getLocale() .' as title','body_'.app()->getLocale() .' as body','phone','email')->first();

        return Response::json(array(
            'message'=>'true',
            'insurance'=>$insurance,
            ));
    }
}
