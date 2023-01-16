<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function index(){

        $feedback3 = DB::table('rate')
            ->join('requests', 'requests.id', '=', 'rate.id_request')
            ->join('users','users.id','rate.id_user')
            ->select('rate.message','rate.rate_point','requests.description','users.name','rate.created_at')
            ->where('rate.rate_point','=',3)
            ->orderBy('rate.created_at', 'desc')
            ->limit(1500)
            ->get();

            $feedback2 = DB::table('rate')
            ->join('requests', 'requests.id', '=', 'rate.id_request')
            ->join('users','users.id','rate.id_user')
            ->select('rate.message','rate.rate_point','requests.description','users.name','rate.created_at')
            ->where('rate.rate_point','=',2)
            ->orderBy('rate.created_at', 'desc')
            ->limit(1500)
            ->get();    

            $feedback1 = DB::table('rate')
            ->join('requests', 'requests.id', '=', 'rate.id_request')
            ->join('users','users.id','rate.id_user')
            ->select('rate.message','rate.rate_point','requests.description','users.name','rate.created_at')
            ->where('rate.rate_point','=',1)
            ->orderBy('rate.created_at', 'desc')
            ->limit(1500)
            ->get();
        return view('feedback.index', compact('feedback3','feedback2', 'feedback1'));
    }
}
