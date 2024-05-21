<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::get();
        return view('web.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $patient = Patient::where('email',$request->email)->first();
        $check =  $patient['password'];
        if(password_verify($request->password, $check)) {

            if(Patient::where('email',$request->email)->exists()){
                return view('web.index',compact('patient'));
            }
        }else{
            return 'sorry';
        }
    //   return  $patient = Patient::where('email',$request->email)->where('password',$request->password)->first();


    //   if(password_verify('$request->password', $request->password)) {
        // in case if "$crypt_password_string" actually hides "1234567"



    //         return 'gdjhghj';

        // else{
        //     return 'x';
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return redirect()->route('web.index')->with(['success' => 'تم مسح العميل بنجاح']);
    }
}
