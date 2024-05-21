<?php

namespace App\Http\Controllers\Api\Specializations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SpecializationsController extends Controller
{
    public function index()
    {
        $specializations=Specialization::select('id','name_'.app()->getLocale() .' as name','image')->get();;
        return Response::json(array(
            'specializations'=>$specializations,
            'message'=>'success',
            ));
    }
    public function get_doctors_by_specializations_id(Request $request)
    {
        $doctors=Doctor::where('specialization_id',$request->specialization_id)->select('id','name_'.app()->getLocale() .' as name','email','phone','gender','level_'.app()->getLocale() .' as level','university_'.app()->getLocale() .' as university','clinic_id','specialization_id')->with(
        ['specialization' => function ($q) {$q->select('id','name_'.app()->getLocale() .' as name');},
        'clinic' => function ($q) { $q->select('id','name_'.app()->getLocale() .' as name');}])
        ->get();;
        return Response::json(array(
            'doctors'=>$doctors,
            'message'=>'success',
            ));

    }
}
