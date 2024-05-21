<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Clinic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {
        $offers= Offer::get();
        return view('dashboard.offers.index',compact('offers'));
    }

    public function create()
    {
       $clinics=Clinic::get();
        return view('dashboard.offers.create',compact('clinics'));

    }
    public function store(Request $request)
    {
       
         $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'body_ar'=>'required',
            'body_en'=>'required',
            'clinic_id'=>'required',
        ]);
       
        // try {

            DB::beginTransaction();

       

       Offer::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'body_ar'=>$request->body_ar,
            'body_en'=>$request->body_en,
            'clinic_id'=>$request->clinic_id,
        
        ]);

        DB::commit();
        return redirect(route('admin.offers.index'))->with(['success' =>'تم اضافة العرض بنجاح']);

    // } catch (\Exception $ex) {
    //     DB::rollback();
    //     return redirect()->route('admin.offers.index')->with(['error' => ' Error Please try again']);
    // }
    }
       public function edit( Offer $offer)
    {
         $clinics=Clinic::get();
        return view('dashboard.offers.edit',compact('clinics'))->with('offer', $offer);

    }
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
            'clinic_id'=>'required',
        ],[
            'name_en.required' => 'الاسم مطلوب',
            'name_ar.required' => 'الاسم مطلوب',


        ]);
        $offer->name_ar = $request->name_ar;
        $offer->name_en = $request->name_en;
        
        $offer->body_ar = $request->body_ar;
        $offer->body_en = $request->body_en;
        $offer->clinic_id = $request->clinic_id;

        $offer->save();
        return redirect(route('admin.offers.index'))->with(['success' => 'تم التعديل بنجاح']);

    }
    public function destroy(offer $offer)
    {
        $offer->delete();
        return redirect(route('admin.offers.index'))->with(['success' => 'تم الحذف بنجاح']);

    }
}
