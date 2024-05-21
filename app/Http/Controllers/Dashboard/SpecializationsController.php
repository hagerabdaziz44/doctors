<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecializationsController extends Controller
{
    public function index()
    {
        $all=Specialization::get();
        return view('dashboard.specializations.index',compact('all'));
    }
    public function create()
    {

         return view('dashboard.specializations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'image'=>'required',
        ]);
        DB::beginTransaction();

        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $image_name="specialization-".uniqid().".$ext";
        $image->move(public_path('images/specialization'),$image_name);
         Specialization::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'image'=>$image_name,
        ]);
        DB::commit();
      return redirect()->route('specialization.index')->with(['success' => 'تمت الاضافة بنجاح']);
    }
    public function edit($id)
    {
        // return $special->id;
        $special=Specialization::find($id);
        return view('dashboard.specializations.edit',compact('special'));

    }
    public function update(Request $request,$id)
    {
        
        $special=Specialization::where('id',$id)->first();
        $image_name = $special->image;
        if ($request->file('image')) {
            // if ($image !== null) {
            //     unlink(public_path('images/specialization/') . $image);
            // }

            
             $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $image_name="specialization-".uniqid().".$ext";
        $image->move(public_path('images/specialization'),$image_name);
        }
        $special->name_ar = $request->name_ar;
        $special->name_en = $request->name_en;
        $special->image = $image_name;
        $special->save();
        return redirect()->route('specialization.index')->with(['success' => 'تم التعديل بنجاح']);
    }

    public function delete($id)
    {
        $special=Specialization::find($id);
        $special->delete();

        return redirect()->route('specialization.index')->with(['success' => 'تم الحذف بنجاح']);


    }
}
