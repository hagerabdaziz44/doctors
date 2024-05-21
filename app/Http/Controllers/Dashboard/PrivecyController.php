<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Privacy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivecyController extends Controller
{
    
    public function index()
    {
        $all= Privacy::get();
        return view('dashboard.privacy.index',compact('all'));
    }

    public function create()
    {
    
        return view('dashboard.privacy.create');

    }
    public function store(Request $request)
    {
       
         $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'body_ar'=>'required',
            'body_en'=>'required',
          
        ]);
       
        try {

             DB::beginTransaction();

       

       Privacy::create([
        
            'body_ar'=>$request->body_ar,
            'body_en'=>$request->body_en,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
           
        
        ]);

        DB::commit();
        return redirect(route('admin.privacy.index'))->with(['success' =>'success']);

    } catch (\Exception $ex) {
        DB::rollback();
        return redirect()->route('admin.privacy.index')->with(['error' => ' Error Please try again']);
    }
    }
       public function edit( Privacy $Privacy)
    {
         
        return view('dashboard.privacy.edit')->with('Privacy', $Privacy);

    }
    public function update(Request $request, Privacy $Privacy)
    {
        $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'body_ar'=>'required',
            'body_en'=>'required',
          
        ],[
            'body_en.required' => 'الاسم مطلوب',
            'body_ar.required' => 'الاسم مطلوب',


        ]);
      
        $Privacy->body_ar = $request->body_ar;
        $Privacy->body_en = $request->body_en;
        $Privacy->name_ar = $request->name_ar;
        $Privacy->name_en = $request->name_en;
       

        $Privacy->save();
        return redirect(route('admin.privacy.index'))->with(['success' => 'success']);

    }
    public function destroy(Privacy $Privacy)
    {
        $Privacy->delete();
        return redirect(route('admin.privacy.index'))->with(['success' => 'suceess']);

    }
}
