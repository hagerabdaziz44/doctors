<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallUs;

class CallUsController extends Controller
{
    public function index()
    {
        $index=CallUs::get();
        return view('dashboard.callus.index',compact('index'));
    }
}
