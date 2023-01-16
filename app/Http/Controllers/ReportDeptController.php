<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportDeptController extends Controller
{
    //
    public function index(){

        $month = DB::table('requests')
        ->select(DB::raw('MONTH(created_at) as date'), DB::raw('YEAR(created_at) as year'), 
        DB::raw('count(*) as total_request '), DB::raw('count(*) as total_request'))
        ->where('id_department', Auth::user()->id_department)
        ->groupBy('date','year')
        ->orderByDesc('date','year')
        ->get();

        $week = DB::table('requests')
        ->select(DB::raw('WEEK(created_at) as date'), DB::raw('YEAR(created_at) as year'))
        ->groupBy('date','year')
        ->orderByDesc('date','year')
        ->get();

        $elect = DB::table('requests')
        ->select('created_at')
        ->where('id_department', Auth::user()->id_department)
        ->whereMonth('created_at', '=', 5)
        ->get();

        $chart = Requests::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');

        return view('report.department.index', compact('month','week','chart'));
    }
}
