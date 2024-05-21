<?php

namespace App\Http\Controllers\Api\Banners;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\AdsBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BannersController extends Controller
{
    public function index()
    {
        $banners=Banner::with(
            [
               
                'clinic' => function ($q) {
                    $q->select('id', 'name_' . app()->getLocale() . ' as name', 'logo', 'lat', 'long');
           } ]   
            )->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'banners'=>$banners,
            ));
    }
    public function ads_banners()
    {
        $banners=AdsBanner::get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'ads_banners'=>$banners,
            ));
    }
}
