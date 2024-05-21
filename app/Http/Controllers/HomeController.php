<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index($type = 'admin')
    {
        return view('dashboard.auth.login',compact('type'));
    }
    public function home()
    {
        return view('home');
    }
    public function dashboard()
    {
         $users = Patient::latest()->take(5)->get();


        return view('dashboard.index',compact('users'));
    }

    public function export_pdf()
    {
        $pdf = Pdf::loadView('dashboard.pdf.report');
        return $pdf->download('report.pdf');
    }

}
