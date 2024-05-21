<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        $terms_and_conditions= Term::get();
        return view('dashboard.terms_and_conditions.index',compact('terms_and_conditions'));
    }

    public function create()
    {
    
        return view('dashboard.terms_and_conditions.create',compact('clinics'));

    }
    public function store(Request $request)
    {
       
         $request->validate([
           
            'body_ar'=>'required',
            'body_en'=>'required',
          
        ]);
       
        try {

            DB::beginTransaction();

       

       Term::create([
        
            'body_ar'=>$request->body_ar,
            'body_en'=>$request->body_en,
           
        
        ]);

        DB::commit();
        return redirect(route('admin.terms_and_conditions.index'))->with(['success' =>'تم اضافة العرض بنجاح']);

    } catch (\Exception $ex) {
        DB::rollback();
        return redirect()->route('admin.terms_and_conditions.index')->with(['error' => ' Error Please try again']);
    }
    }
       public function edit( Term $Term)
    {
         $clinics=Clinic::get();
        return view('dashboard.terms_and_conditions.edit',compact('clinics'))->with('Term', $Term);

    }
    public function update(Request $request, Term $Term)
    {
        $request->validate([
            'body_ar'=>'required',
            'body_en'=>'required',
          
        ],[
            'body_en.required' => 'الاسم مطلوب',
            'body_ar.required' => 'الاسم مطلوب',


        ]);
      
        $Term->body_ar = $request->body_ar;
        $Term->body_en = $request->body_en;
       

        $Term->save();
        return redirect(route('admin.terms_and_conditions.index'))->with(['success' => 'تم التعديل بنجاح']);

    }
    public function destroy(Term $Term)
    {
        $Term->delete();
        return redirect(route('admin.terms_and_conditions.index'))->with(['success' => 'تم الحذف بنجاح']);

    }
    //
}
