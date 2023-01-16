<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\User;
use App\Models\Requests;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\RelevantParts;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $get_role =  Role::whereNotIn('name', ['admin'])->count();


        if(Auth::user()->roles->pluck('name') =='admin'){
            $u = DB::table('requests')
            ->join('departments', 'requests.id_department', '=', 'departments.id')
            ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
            ->select('requests.cancel','requests.id','requests.created_at','requests.progress_request','requests.description', 'departments.department as dept', 'relevant_parts.name_relevant as name')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }else{
            $u = DB::table('requests')
            ->join('departments', 'requests.id_department', '=', 'departments.id')
            ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
            ->where('requests.id_user', $user_id)
            ->select('requests.cancel','requests.id','requests.created_at','requests.progress_request','requests.description', 'departments.department as dept', 'relevant_parts.name_relevant as name')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }
        
        
        $departments =  Departments::all();
        $request = Requests::all();
        return view('request.index', compact('departments','request','u'));
    }

    public function getMyRequest(){
        $user_id = Auth::user()->id;
        $get_role =  Role::whereNotIn('name', ['admin'])->count();

        if(Auth::user()->roles->pluck('name') =='admin'){
            $u = DB::table('requests')
            ->join('departments', 'requests.id_department', '=', 'departments.id')
            ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
            ->select('requests.cancel','requests.id','requests.created_at',
            'requests.progress_request','requests.description', 'departments.department as dept',
            'relevant_parts.name_relevant as name')
            ->orderBy('created_at', 'desc')
            ->get();
        }else{
            $u = DB::table('requests')
            ->join('departments', 'requests.id_department', '=', 'departments.id')
            ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
            ->where('requests.id_user', $user_id)
            ->select('requests.cancel','requests.id','requests.created_at',
            'requests.progress_request','requests.description', 'departments.department as dept', 
            'relevant_parts.name_relevant as name')
            ->orderBy('created_at', 'desc')
            ->get();
        }
        
        
        $departments =  Departments::all();
        $request = Requests::all();
        return view('request.list', compact('departments','request','u'));
    }

    
    public function getRelevant(Request $request){
        $relevant = RelevantParts::where("id_department",$request->id_department)->pluck('id','name_relevant');
        return response()->json($relevant);
    }

    public function storeRating(Request $request){

        //validate form
        $request->validate([
            'id_user' => 'required',
            'id_request' =>'required',
            'star' =>'required',
            'description' => 'required'
        ]);
        Rate::create([
            'id_user' => $request->id_user,
            'id_request' =>$request->id_request,
            'rate_point' =>$request->star,
            'message' => $request->description
        ]);
        return to_route('request.list')->with('message', 'Thank you for your feedback');

    }


    public function store(Request $request){

        //validate form
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' =>'required',
            'id_part' =>'required',
            'id_department' => 'required',
            'location' => 'required',
            'no_unit' => 'required',
            'id_user' => 'required',
            'progress_request' =>'required'
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/img_progress', $image->hashName());

        //Requests::create($request->all());
        Requests::create([
            'image'     => $image->hashName(),
            'description'     => $request->description,
            'id_department'   => $request->id_department,
            'id_user'   => $request->id_user,
            'progress_request'=> $request->progress_request,
            'lokasi' => $request->location,
            'no_unit' => $request->no_unit,
            'id_part' => $request->id_part
        ]);
        return to_route('request.index')->with('message', 'Request successfuly');

    }

    public function userRequest(){
        
        return view('users.index');
    }

    

    public function timeline(Request $request){
        $req = Requests::where('id', $request->id)
            ->select('*')
            ->firstOrFail();
            $u = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->where('requests.id', $request->id)
            ->select('requests.image as image','users.name','requests.progress_request','requests.created_at','requests.updated_at')
            ->first();

            $response = DB::table('response')
            ->join('users','response.id_user','users.id')
            ->where('response.id_request', $request->id)
            ->select('users.name as nama_dept', 'response.response','response.created_at')
            ->first();

            $pg = DB::table('progress')
            ->where('id_request', $request->id)
            ->select('*')
            ->first();

            $finish = DB::table('finish_task')
            ->where('id_request', $request->id)
            ->select('*')
            ->first();

//            $count_response = $response->count();
        
        return view('admin.timeline',compact('request','req','u','response','pg','finish'));
    }

    public function verify(Request $request){

        $update = DB::table('requests')
        ->where('id', $request->id)
        ->update(['status_feedback' => 1]);

        return response()->json(['success'=>$request->id]);
    }

    public function rateUs(Request $request){
        //validate form
        $request->validate([
            'id_user' => 'required',
            'id_req' =>'required',
            'rate' =>'required',
            'message' => 'required'
        ]);
        Rate::create([
            'id_user' => $request->id_user,
            'id_request' =>$request->id_req,
            'rate_point' =>$request->rate,
            'message' => $request->message
        ]);
      
        return to_route('request.list')->with('message','Thank you for your feedback');
        //return response()->json(['message' => 'Thank you for your feedback :)']);
    }
}