<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //

    public function index(){
        
        return view('admin.index', compact('departments'));
    }
    public function manageUser(){
        
        return view('admin.manage_user.index');
    }
}
