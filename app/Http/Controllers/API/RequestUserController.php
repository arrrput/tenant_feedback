<?php

namespace App\Http\Controllers\API;

use App\Models\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestUserController extends Controller
{
    //
    public function index(){

        $request = Requests::select('*')
                    ->where('id_user', Auth::user()->id)
                    ->get();
        return response()->json($request, 200);
    }

    public function store(Request $request){
        dd($request->all());
    }
}
