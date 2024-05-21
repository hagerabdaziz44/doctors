<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthTrait;
    // change between admin and users
    public function log($type){
        if($type != "admin") {
            return dd($type);
        }
        else {
            return view('dashboard.auth.login', compact('type'));
        }
    }
    public function logs($type = 'admin'){
        return view('dashboard.auth.login',compact('type'));
    }
    public function login(Request $request){
        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        else{
            return redirect()->back()->with('error', 'هناك خطأ في كلمة السر او البريد الالكتروني');
        }

    }

    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
