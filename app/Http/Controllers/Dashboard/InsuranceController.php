<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        $all=Insurance::get();
        return view('dashboard.Insurance.index',compact('all'));
    }
    public function create()
    {

         return view('dashboard.Insurance.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'body_ar'=>'required',
            'body_en'=>'required',
            'phone' => 'required|unique:insurances,phone',
            'email' => 'required|unique:insurances,email',
            'photo'=>'required',
        ]);
        DB::beginTransaction();

        $image=$request->file('photo');
        $ext=$image->getClientOriginalExtension();
        $image_title="Insurance-".uniqid().".$ext";
        $image->move(public_path('images/Insurance'),$image_title);
         Insurance::create([
            'title_ar'=>$request->title_ar,
            'title_en'=>$request->title_en,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'body_ar'=>$request->body_ar,
            'body_en'=>$request->body_en,
            'photo'=>$image_title,
        ]);
        DB::commit();
      return redirect()->route('insurance.index')->with(['success' => 'تمت الاضافة بنجاح']);
    }
    public function edit($id)
    {
        // return $insurance->id;
        $insurance=Insurance::find($id);
        return view('dashboard.Insurance.edit',compact('insurance'));

    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'body_ar'=>'required',
            'body_en'=>'required',
            'phone' => 'required|unique:insurances,phone,' . $id,
            'email' => 'required|unique:insurances,email,' . $id,
            'photo'=>'required',
        ]);
        $insurance=Insurance::where('id',$id)->first();
        $filename = $insurance->photo;
        if ($request->photo) {

            if ($filename !== null) {
                unlink(public_path('images/Insurance/') . $filename);
            }
            $file = $request->file('photo');
            $ext = $file->getClientOriginalName();
            $filename = "Insurance-" . uniqid() . ".$ext";
            $file->move(public_path('images/Insurance'), $filename);
        }
        $insurance->title_ar = $request->title_ar;
        $insurance->title_en = $request->title_en;
        $insurance->phone = $request->phone;
        $insurance->email = $request->email;
        $insurance->body_ar = $request->body_ar;
        $insurance->body_en = $request->body_en;
        $insurance->photo = $filename;
        $insurance->save();
        return redirect()->route('insurance.index')->with(['success' => 'تم التعديل بنجاح']);
    }

    public function delete($id)
    {
        $insurance=Insurance::find($id);
        $insurance->delete();

        return redirect()->route('insurance.index')->with(['success' => 'تم الحذف بنجاح']);


    }
}
