<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ClientInformation;
use App\Models\Clinic;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ReceptionController extends Controller
{
    //
    public function index()
    {
        $info = ClientInformation::with('clinic', 'patient')->get();
        return view('dashboard.client_information_ Reception.index', compact('info'));
    }
    public function create()
    {
      
        $clinics = Clinic::get();
        $users=Patient::get();
        return view ('dashboard.client_information_ Reception.create', compact('clinics','users'));
    }
     public function store(Request $request)
    {


        // Validate the request data
        $validator=
        Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:patients,email', // Assuming email should be unique in users table
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'description' => 'required|string',
            'clinic_id' => 'required|exists:clinics,id',
            'user_id' => 'nullable|exists:patients,id'
            ],
            [
                'email.required' => trans('auth.email.register'),
                'email.unique' => trans('auth.email.unique.register'),


            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->with(['error' =>$validator->errors()->first()]);
         
        }

        // Create a new info instance and save it to the database
        try {
        if($request->name==null)
        {
            $info = new ClientInformation();
            $info->description = $request->input('description');
            $info->clinic_id = $request->input('clinic_id');
            $info->user_id = $request->input('user_id');
            $info->save();
            return redirect()->route('reception.index')->with('success', 'info created successfully');

  
        }
        else {
            $fillname = "";
            $patient = Patient::create([
                'name' => $request->name,
                'email' => $request->email,

                'phone' => $request->phone,

                'photo' => $fillname,
                'password' => Hash::make($request->password),
            ]);
            $info = new ClientInformation();
            $info->description = $request->input('description');
            $info->clinic_id = $request->input('clinic_id');
            $info->user_id = $patient->id;
            $info->save();
            return redirect()->route('reception.index')->with('success', 'info created successfully');
           
        }
        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
      
    }

    public function edit($id)
    {
        $client = ClientInformation::findOrFail($id);
        $clinics = Clinic::all();
        $users = Patient::all();
        return view('dashboard.client_information_ Reception.edit', compact('client', 'clinics', 'users'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make(
            $request->all(),
            [
               
                'description' => 'required|string',
                'clinic_id' => 'required|exists:clinics,id',
                'user_id' => 'nullable|exists:patients,id'
            ],
            [
                'email.required' => trans('auth.email.register'),
                'email.unique' => trans('auth.email.unique.register'),
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        }

        try {
            $info = ClientInformation::findOrFail($id);
          
                $info->description = $request->input('description');
                $info->clinic_id = $request->input('clinic_id');
                $info->user_id = $request->input('user_id');
                $info->save();
            
            return redirect()->route('reception.index')->with('success', 'Info updated successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function destroy($id)
    {
        try {
            $info = ClientInformation::findOrFail($id);
            $info->delete();
            return redirect()->route('reception.index')->with('success', 'Info deleted successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}


