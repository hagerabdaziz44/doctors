<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannersController extends Controller
{
    public function index()
    {
        $banners=Banner::paginate(8);
        return view('dashboard.banners.index',compact('banners'));
    }

    public function create()
  {
      $clinics = Clinic::get();
    return view ('dashboard.banners.create',compact('clinics'));

  }

    public function store (Request $request)
 {
    $request->validate([
        'banner'=>'required|image',
        'clinic_id'=>'required|exists:clinics,id',
    ],[
        'banner.required' => 'اللوحة الاعلانية مطلوبة'
     ]);
   try {

        DB::beginTransaction();
        $banner=$request->file('banner');
        $ext=$banner->getClientOriginalExtension();
        $banner_name="banner-".uniqid().".$ext";
        $banner->move(public_path('images/banners'),$banner_name);

       Banner::create([
        'banner' =>  $banner_name,
        'clinic_id' => $request->clinic_id
    ]);

    DB::commit();
    return redirect()->route('admin.banners.index')->with(['success' => 'تمت الاضافة بنجاح']);
}
      catch (\Exception $ex) {
        DB::rollback();
          return redirect()->route('admin.banners.index')->with(['error' => 'error']);
      }


  }

  public function delete($id)
  {
      try {

          $banner = Banner::find($id);

          if (!$banner)

              return redirect()->route('admin.banners.index')->with(['error' => 'غير موجود']);

               DB::beginTransaction();

               $banner->delete();
              DB::commit();

          return redirect()->route('admin.banners.index')->with(['success' => 'تم الحذف بنجاح']);

      } catch (\Exception $ex) {
          return redirect()->route('admin.banners.index')->with(['error' => 'error please try again']);
      }
  }
}
