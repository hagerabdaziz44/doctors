<?php

namespace App\Http\Controllers\Api\CallUs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CallUs;
use Illuminate\Http\Request;
use App\Models\Setting;

class CallUsController extends Controller
{
    public function callus(Request $request)
    {
        CallUs::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'body'=>$request->body,
            'patient_id'=>Auth::guard('user-api')->user()->id,
        ]);
        return response()->json([
            'message' => 'تم الارسال بنجاح',
        ]);    
          

    }
     public function about_app(Request $request)
    {

        $all= Setting::where('type','contact_us')->select('id','title_ar as name', 'title_en as phone','description_ar as email','description_en as address')->get();

           return response()->json([
            'message' => 'success',
            'about_app'=> $all
        ]);


    }
}
