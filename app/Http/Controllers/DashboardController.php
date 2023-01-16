<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(){
        
        $departments =  DB::table('departments')->count();
        $tenant = DB::table('users')->where('id_department','=',0)->count();

        if(Auth::user()->roles->pluck('admin')){

          $pending = DB::table('requests')->where('progress_request','=',1)->count();
        $finish = DB::table('requests')->where('progress_request','=',4)->count();
          $recent_req = DB::table('requests')
          ->join('users','users.id', '=','requests.id_user')
          ->select('requests.id','requests.created_at','requests.progress_request',
            'users.name as name')
          ->limit(5)->get();
        }

        if(Auth::user()->roles->pluck('user')){
        
          $pending = DB::table('requests')
          ->where('progress_request','=',1)
          ->where('id_department','=',Auth::user()->id_department)
          ->count();
          $finish = DB::table('requests')
          ->where('progress_request','=',4)
          ->where('id_department','=',Auth::user()->id_department)
          ->count();

          $recent_req = DB::table('requests')
          ->join('users','users.id', '=','requests.id_user')
          ->where('requests.id_department', Auth::user()->id_department)
          ->select('requests.id','requests.created_at','requests.progress_request',
            'users.name as name')
          ->limit(5)->get();
        }

        if(Auth::user()->roles->pluck('tenant')){
          $pending = DB::table('requests')
          ->where('progress_request','=',1)
          ->where('id_user','=',Auth::user()->id)
          ->count();
          $finish = DB::table('requests')
          ->where('progress_request','=',4)
          ->where('id_user','=',Auth::user()->id)
          ->count();

          $req_tenant = DB::table('requests')
          ->join('users', 'requests.id_user', '=', 'users.id')
          ->where('requests.id_user', Auth::user()->id)
          ->select('requests.id','requests.created_at','requests.progress_request',
            'requests.description as description')
          ->limit(5)->get();
        }

        $form_rate = DB::table('requests')
        ->join('users','users.id','=','users.id')
        ->join('rate','rate.id_request','=','requests.id')
        ->where('requests.id_user', Auth::user()->id)
        ->select('requests.id')
        ->first();

        $total_selesai = 0;
        return view('admin.index', compact('tenant','departments','pending','finish', 'recent_req','req_tenant','total_selesai'));
    }
}
