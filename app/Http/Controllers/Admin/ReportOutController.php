<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ReportInController extends Controller
{
    public function index(Request $request)
    {
        $checkFrom = $request->from;
        $checkTo = $request->to;
        $reportIn = Attendance::where('type','in')
        ->when($checkFrom, function ($query) use ($request) {
            $query->whereDate('check_in', '>=', $request->to_date);
        })
        ->when($checkTo, function ($query) use ($request) {
            $query->whereDate('check_in', '<=', $request->to_date);
        })
        ->get();
        return view('admin.report.in.index',compact('reportIn'));
    }
}