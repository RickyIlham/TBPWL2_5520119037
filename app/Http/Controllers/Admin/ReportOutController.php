<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Reportout;


use Illuminate\Support\Facades\Storage;

class ReportOutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $reportouts = reportout::all();
        
        return view('admin.reportout', compact('reportouts'));
    }
}