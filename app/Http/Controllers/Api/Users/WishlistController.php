<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\ClinicInsurance;
use App\Models\Doctor;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function wishlist(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'clinic_id' => 'required|exists:clinics,id' ,
        ] ,[
            'clinic_id.required'=>trans('wishlist.clinicRequired'),
            'clinic_id.exists'=> trans('wishlist.clinicExists'),
         ]);
         if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);

        }
        $wishlist = Favorite::where('patient_id', Auth::guard('user-api')->user()->id)->where('clinic_id',$request->clinic_id)->count();
        if ($wishlist==0) {
            Favorite::create([
                'clinic_id' => $request->clinic_id,
                'patient_id' => Auth::guard('user-api')->user()->id
            ]);

            return response()->json([
                'status' => '200',
                'message' => trans('msg.message'),
            ]);
        }else
        {
            Favorite::where('patient_id',Auth::guard('user-api')->user()->id)->where('clinic_id',$request->clinic_id)->delete();
                return Response::json(array(
                    'status'=>200,
                    'message'=>trans('msg.messageRemove'),
                ));
        }
    }
    public function getAllWishlist()
    {
        $allwishlist=Favorite::where('patient_id',Auth::guard('user-api')->user()->id)->with(
            ['clinics' =>
             function ($q) {$q->select('id','description_'.app()->getLocale() .' as description','name_'.app()->getLocale() .' as name','phone','lat','long','logo','rate')->get();}])->get();
        return Response::json(array(
            'status'=>200,
            'message'=>trans('msg.true'),
            'data'=>$allwishlist,
        ));
        
        // $allwishlist = Favorite::where('patient_id', Auth::guard('user-api')->user()->id)->with(
        //     ['clinics' =>
        //     function ($q) {
        //         $q->select('id', 'description_' . app()->getLocale() . ' as description', 'name_' . app()->getLocale() . ' as name', 'phone', 'address_' . app()->getLocale() . ' as address', 'lat', 'long', 'logo', 'cover', 'rate')->get();
        //     }]
        // )->get();
        // $allwishlist->map(function ($allwishlist) {
        //     $allwishlist['insurances'] = ClinicInsurance::where('clinic_id', $allwishlist['clinic_id'])->get();
        //     $insurances = $allwishlist['insurances'];
        //     $insurances->map(function ($insurances) {
        //         $insurances['insurances_data'] = Insurance::where('id', $insurances['insurance_id'])->select('id', 'title_' . app()->getLocale() . ' as title' ,'body_' . app()->getLocale() . ' as body', 'photo')->get();
        //     });
        // });


        // $allwishlist->map(function ($allwishlist) {
        //     $allwishlist['doctors'] = Doctor::where('clinic_id', $allwishlist['clinic_id'])->select('id', 'name_' . app()->getLocale() . ' as name', 'photo', 'specialization_id', 'clinic_id', 'cost')->with(
        //         [
        //             'specialization' => function ($q) {
        //                 $q->select('id', 'name_' . app()->getLocale() . ' as name');
        //             }
        //         ]
        //     )->get();
        // });
        // return Response::json(array(
        //     'status' => 200,
        //     'message' => trans('msg.true'),
        //     'data' => $allwishlist,
        // ));
    }
     public function is_fav(Request $request)
    {
        $count=Favorite::where('patient_id',Auth::guard('user-api')->user()->id)->where('clinic_id',$request->clinic_id)->count();
        return Response::json(array(
            'status'=>200,
            'message'=>trans('msg.true'),
            'is_fav'=>$count,
        ));
    }
}
