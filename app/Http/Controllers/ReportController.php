<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Requests;
use App\Models\FinishTask;
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
        ->select('users.name','departments.department as department','requests.description' ,'requests.created_at','requests.updated_at','requests.id')
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

    public function cetak_pdf($id){
        $req = Requests::where('requests.id', $id)
            ->select('requests.*', 'users.name as name_user', 'departments.department as department')
            ->join('users','requests.id_user','users.id')
            ->join('departments','requests.id_department', 'departments.id')
            ->firstOrFail();
        $finish = DB::table('finish_task')
            ->where('id_request', $id)
            ->select('*')
            ->first();

        $pg = DB::table('progress')
            ->where('id_request', $id)
            ->select('*')
            ->first();

        $pdf = PDF::loadView('report.pdf.pdf_request', ['request' => $req, 'finish'=>$finish, 'pg'=> $pg])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function detailReq(Request $request){
        if($request->ajax()){
            $data = Requests::select('requests.*','company_name')
                    ->join('users', 'requests.id_user','users.id')
                    ->orderBy('created_at', 'desc')
                    ->get();

                    $datatables =  datatables()->of($data);
                    return $datatables
                        ->addColumn('tenant_name', function($row){
                            return $row->company_name;
                        })
                        ->addColumn('date_req', function($row){
                            return Carbon::parse($row->created_at)->format('d M Y');
                        })
                        ->addColumn('feedback', function($row){
                            return $row->description;
                        })
                        ->addColumn('date_finish', function($row){
                            $date = '';
                            if($row->progress_request ==4){
                                $f =FinishTask::where('id_request', $row->id)->first();
                                return Carbon::parse($f->created_at)->format('d M Y');
                            }
                            if($row->progress_request ==3){
                                return 'On progress';
                            }
                            if($row->progress_request ==2){
                                return 'On response';
                            }
                            if($row->progress_request ==1){
                                return 'Waiting response';
                            }
                            if($row->progress_request ==5){
                                return 'Cancel';
                            }
                        })
                        // ->rawColumns(['action','name', 'dept'])
                        ->addIndexColumn()
                        ->make(true);
        }
        
    }

}
