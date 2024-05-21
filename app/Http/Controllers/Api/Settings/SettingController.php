<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;

class SettingController extends Controller
{
    public function about_us(){
        $about_us=Setting::where('type','about_us')->select('id','title_'.app()->getLocale() .' as title','description_'.app()->getLocale() .' as description')->get();
        return Response::json(array(
            'brands'=>$about_us,
            'message'=>'success',
            ));

    }
    public function contact_us(){
        $contact_us=Setting::where('type','contact_us')->select('id','title_'.app()->getLocale() .' as title','description_'.app()->getLocale() .' as address','phone','email','icon')->get();
        return Response::json(array(
            'brands'=>$contact_us,
            'message'=>'success',
            ));

    }
       public function faq(){
        $qa=Setting::where('type','qa')->select('id','title_'.app()->getLocale() .' as title','description_'.app()->getLocale() .' as description')->get();
        return Response::json(array(
            'brands'=>$qa,
            'message'=>'success',
            ));
        }

}
