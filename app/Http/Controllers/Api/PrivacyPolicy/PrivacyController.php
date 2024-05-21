<?php

namespace App\Http\Controllers\Api\PrivacyPolicy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $Privacys=Privacy::select('id','body_'.app()->getLocale() .' as body','created_at'
        )->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'Privacys'=>$Privacys,
            ));
       
    }
}
