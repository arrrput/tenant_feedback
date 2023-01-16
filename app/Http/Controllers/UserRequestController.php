<?php

namespace App\Http\Controllers;

use App\Models\FinishTask;
use App\Models\Progres;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
    //

    public function index(){
        $id_dept = Auth::user()->id_department;
        $req_user = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->where('requests.id_department', $id_dept)
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
            ->get();
        return view('users.index', compact('req_user'));
    }


    public function addResponse(Request $requests){

        $id_req = DB::table('requests')
        ->where('id',$requests->id)
        ->select('id','image','description')
        ->first();
        return view('users.addresponse',compact('requests','id_req'));
    }

    public function addProgress(Request $requests){
        return view('users.addprogress', compact('requests'));
    }

    public function storeProgress(Request $request){
        //validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message'     => 'required',
            'id_request'   => 'required',
            'root_case' => 'required',
            'id'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/img_progress', $image->hashName());

        //create post
        Progres::create([
            'image'     => $image->hashName(),
            'message'     => $request->message,
            'id_request'   => $request->id_request,
            'akar_penyebab' => $request->root_case,
            'id_user'   => $request->id
        ]);
        //update status progress
        DB::table('requests')
              ->where('id', $request->id_request)
              ->update(['progress_request' => 3]);
        return to_route('department.index')->with('status','Progress success add!');
    }

    public function create(Request $request){
        $now = new DateTime();
        $validated = $request->validate(['response' =>'required', 'response_req' => 'required','target_hari' =>'required']);
        $id_user = Auth::user()->id;
        DB::table('response')->insert([
            'response' => $request->response,
            'id_request' => $request->response_req,
            'target_hari' => $request->target_hari,
            'id_user' => $id_user, 
            'created_at'=> $now,
            'updated_at' =>$now
        ]);
        DB::table('requests')
              ->where('id', $request->response_req)
              ->update(['progress_request' => 2]);
        
        
        return to_route('department.index')->with('status','Response success add!');
    }


    public function cancelRequest(Request $request){

        $tgl = new DateTime();

        $request->validate([
            'description' =>'required',
            'id_request' =>'required'
        ]);

        DB::table('requests')
              ->where('id', $request->id_request)
              ->update(['cancel' => $request->description,'progress_request'=>5, 'updated_at' => $tgl]);


        return to_route('department.index')->with('status','Request berhasil dibatalkan'.$request->description.' '.$request->id);
    }

    public function finish(Request $request){
        
        $tgl = new DateTime();
        $id_user = Auth::user()->id;
        
        //validate form
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' =>'required',
            'id_request' => 'required',
            'id_user' =>'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/img_finish', $image->hashName());

        FinishTask::create([
            'image'     => $image->hashName(),
            'description'     => $request->description,
            'id_request'   => $request->id_request,
            'id_user'=> $request->id_user
        ]);

        DB::table('requests')
        ->where('id', $request->id_request)
        ->update(['progress_request' => 4,'updated_at'=>$tgl]);

        return to_route('department.index')->with('status','Finish Request was succussfuly.');
    }
}
