<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Requests;
use Illuminate\Http\Request;
use App\Exports\MonthTenantExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function index(){

        $month = DB::table('requests')
        ->select(DB::raw('MONTH(created_at) as date'), DB::raw('YEAR(created_at) as year'), 
        DB::raw('count(*) as total_request'), DB::raw('count(*) as total_request'))
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
        ->whereMonth('created_at', '=', 5)
        ->get();

        $chart = Requests::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        
        return view('report.index', compact('month','week','chart'));
    }

    public function detailWeek(Request $request){

        $week = $request->date;
        $year = $request->year;

        $month = DB::table('requests')
        ->select('created_at')
        ->whereMonth('created_at', '=', 5)
        ->get();


        return view('report.week',compact('week','year'));
    }

    public function detailMonth(Request $request){

        $month = $request->date;
        $year = $request->year;

        $data = DB::table('requests')
        ->select('users.name','departments.department as department','requests.description' ,'requests.created_at','requests.updated_at')
        ->join('departments','departments.id','requests.id_department')
        ->join('users','users.id','requests.id_user')
        ->whereMonth('requests.created_at', '=', $month)
        ->paginate(10);


        return view('report.month',compact('month','year','data'));
    }

    public function chartMonth(){

        

    }

    public function month_export_tenant(){
        return Excel::download(new MonthTenantExport,'tenant_export.xlsx');
    }

}
