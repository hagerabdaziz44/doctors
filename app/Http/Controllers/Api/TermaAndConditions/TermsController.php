<?php

namespace App\Http\Controllers\Api\TermaAndConditions;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $Terms=Term::select('id','name_'.app()->getLocale() .' as name','body_'.app()->getLocale() .' as body','clinic_id','created_at'
        )->get();
        return Response::json(array(
            'status'=>200,
            'message'=>'true',
            'Terms'=>$Terms,
            ));
       
    }
}
