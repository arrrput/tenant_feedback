<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //

    public function index(){
        
        return view('admin.index', compact('departments'));
    }
    public function manageUser(){
        $data = User::orderBy('id','DESC')->get();
        
        return view('admin.user.index',compact('data'));
    }
}
