<?php

namespace App\Http\Controllers\Api\Offers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {
        $offers=Offer::select('id','name_'.app()->getLocale() .' as name','body_'.app()->getLocale() .' as body','clinic_id','created_at'
        )->with(
            [
               
                'clinic' => function ($q) { $q->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','address_'.app()->getLocale() .' as address','lat','long','logo','cover','rate');}])->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'offers'=>$offers,
            ));
       
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make(
            $request->all(),
            [
               
                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'body_en'=>'required',
                 'body_ar' => 'required',
               

            ],
            [
                
                'name_en.required' => trans('auth.nameRegister'),
                'name_en.string' => trans('auth.string.register'),
                'name_ar.required' => trans('auth.nameRegister'),
                'name_ar.string' => trans('auth.string.register'),
                'photo.required' => trans('auth.image.register'),
                'specialization.required' => trans('doctor.clinic_id'),
                'specialization.exists' => trans('doctor.clinic_id_exists')
            ]
        );
       
        // try {

            // DB::beginTransaction();

       

       Offer::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'body_ar'=>$request->body_ar,
            'body_en'=>$request->body_en,
             'clinic_id' => Auth::guard('clinic-api')->user()->id,
        
        ]);

        // DB::commit();
        return Response::json(array(
                        'status'=>200,
                        'message'=>'Added Sucessfully',
                        ));
                }

       public function get_offer_by_id(Request $request)
    {
        $offers=Offer::where('id',$request->id)->select('id','name_'.app()->getLocale() .' as name','body_'.app()->getLocale() .' as body','clinic_id','created_at'
        )->with(
            [
               
                'clinic' => function ($q) { $q->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate');}])->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'offers'=>$offers,
            ));
       
       

    }
    public function edit(Request $request)
    {
         
        $validator = Validator::make(
            $request->all(),
            [
               
                'name_en' => 'required|string',
                'name_ar' => 'required|string',
                'body_en'=>'required',
                 'body_ar' => 'required',
               

            ],
            [
                
                'name_en.required' => trans('auth.nameRegister'),
                'name_en.string' => trans('auth.string.register'),
                'name_ar.required' => trans('auth.nameRegister'),
                'name_ar.string' => trans('auth.string.register'),
                'photo.required' => trans('auth.image.register'),
                'specialization.required' => trans('doctor.clinic_id'),
                'specialization.exists' => trans('doctor.clinic_id_exists')
            ]
        );
       
        // try {

            // DB::beginTransaction();

       

       Offer::where('id',$request->id)->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'body_ar'=>$request->body_ar,
            'body_en'=>$request->body_en,
             'clinic_id' => Auth::guard('clinic-api')->user()->id,
        
        ]);

        // DB::commit();
        return Response::json(array(
                        'status'=>200,
                        'message'=>'Updated Sucessfully',
                        ));
        

    }
    public function destroy(Request $request)
    {
        $offer=Offer::where('id',$request->id)->first();
        $offer->delete();
         return Response::json(array(
            'status'=>200,
            'message'=>'تم الحذف',
           
            ));
  

    }
    public function get_clinic_offers(Request $request)
    {
          $offers=Offer::where('clinic_id', $request->id)->select('id','name_'.app()->getLocale() .' as name','body_'.app()->getLocale() .' as body','clinic_id','created_at'
        )->with(
            [
               
                'clinic' => function ($q) { $q->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate');}])->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'offers'=>$offers,
            ));
    
        
    }
}
