<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index(){
        $clients =  Patient::paginate(20);
        return view('dashboard.patients.index',compact('clients'));
    }


    public function create(){
        return view('dashboard.patients.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email',
            
            'phone' => 'required',
           

        ],[
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.unique' => 'البريد الالكتروني موجود من قبل',

            'gender.required' => 'النوع مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'birth_date.required'=>'تاريخ الميلاد مطلوب',
        ]);

         DB::beginTransaction();
         $fillname="";
        Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            
            'phone' => $request->phone,
            
            'photo'=>$fillname,
            'password' => Hash::make($request->password),
        ]);
         DB::commit();
        return redirect()->route('admin.patients.index')->with(['success' => 'تم اضافة العميل بنجاح']);
    }
    public function edit($id){
        $client = Patient::findOrFail($id);
        return view('dashboard.patients.edit',compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Patient::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email,'.$id,
           
            'phone' => 'required',
        ],[
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.unique' => 'البريد الالكتروني موجود من قبل',
            'status.required' => 'الحالة مطلوبة',
            'gender.required' => 'النوع مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
        ]);

        DB::beginTransaction();
        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            
            'phone' => $request->phone,
           
        ]);
        DB::commit();
        return redirect()->route('admin.patients.index')->with(['success' => 'تم تعديل العميل بنجاح']);
    }

    public  function delete($id){
        Patient::findOrFail($id)->delete();
        return redirect()->route('admin.patients.index')->with(['success' => 'تم مسح العميل بنجاح']);
    }
    public function clinics()
    {
        $response=Http::post('https://clinico.nova4uu.com/api/all/clinics');
        return $response->json();
//         $client = new Client();
// $options = [
//   'multipart' => [
//     [
//       'name' => 'email',
//       'contents' => 'newuser21@gamil.com'
//     ],
//     [
//       'name' => 'password',
//       'contents' => '123456789'
//     ],
//     [
//       'name' => 'password_confirmation',
//       'contents' => '123456789'
//     ],
//     [
//       'name' => 'name',
//       'contents' => 'hagar'
//     ],
//     [
//       'name' => 'phone',
//       'contents' => '01002215412'
//     ]
// ]];
$request = Http::post('https://clinico.nova4uu.com/api/user/register',[
     
        'email' => 'newuser215@gamil.com',
        'password' => '123456789',
        'password_confirmation'=>'123456789',
        'name'=>'hagar',
        'phone'=>'0100661854'
    ]);
$request=Http::withHeaders([
    'auth-token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2NsaW5pY28ubm92YTR1dS5jb20vYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2OTMxNzUxODEsIm5iZiI6MTY5MzE3NTE4MSwianRpIjoiZ3ZpcUpmVTltRFpacXVWMSIsInN1YiI6IjMxIiwicHJ2IjoiNzUyODk1NjcxMGQxYzc1YjY3MTMwZDRlNGM1YzBlZTlhMGFlYjYxNCJ9.eOS8mWVEDGyk5men9TD1Wv7S66jKjXv2-_R_Rq2VyZg',
    
])->get('https://clinico.nova4uu.com/api/user/getUserData');

// $res = $client->sendAsync($request, $options)->wait();
echo $request->getBody();

    }

}
