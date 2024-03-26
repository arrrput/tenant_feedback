<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Rate;
use App\Models\User;
use App\Models\Progres;
use App\Models\Requests;
use App\Models\FinishTask;
use Illuminate\Http\Request;
use App\Jobs\NotificationJob;
use App\Models\ResponseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class UserRequestController extends Controller
{
    //

    public function index(){
        $id_dept = Auth::user()->id_department;
        if(Auth::user()->hasRole('admin')){
            $req_user = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
            ->get();
        }else{
            $req_user = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->where('requests.id_department', $id_dept)
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
            ->get();
        }
        
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
            'img_progress'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'correction'     => 'required',
            'id_progress'   => 'required',
            'root_cause' => 'required'
        ]);

        //upload image
        $image = $request->file('img_progress');
        $image->storeAs('public/img_progress', $image->hashName());

        //create post
        $fm = Progres::create([
            'image'     => $image->hashName(),
            'message'     => $request->correction,
            'id_request'   => $request->id_progress,
            'akar_penyebab' => $request->root_cause,
            'id_user'   => Auth::user()->id
        ]);
        //update status progress
        $update = DB::table('requests')
              ->where('id', $request->id_progress)
              ->update(['progress_request' => 3]);
        $r = Requests::select('*')->where('id',$request->id_progress)->first();
        $user =  User::select('*')->where('id',$r->id_user)->first();
        $msg_wa = 'Hi '.$user->name.'
Permintaan anda dengan nomor tiket'.$r->tic_number.' sedang dikerjakan.
Untuk lebih lanjut silahkan akses ke https://feedback.bintanindustrial.co.id/request/list';
        $this->sendWa($user->nohp, $msg_wa);
        // return to_route('department.index')->with('status','Progress success add!');
        return response()->json($fm, 200);
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
        
        //validate form
        $request->validate([
            'img_finish' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description_finish' =>'required',
            'id_finish' => 'required'
        ]);

        //upload image
        $image = $request->file('img_finish');
        $image->storeAs('public/img_finish', $image->hashName());

        $fm = FinishTask::create([
            'image'     => $image->hashName(),
            'description'     => $request->description_finish,
            'id_request'   => $request->id_finish,
            'id_user'=> Auth::user()->id
        ]);

        $fm = Requests::where('id', $request->id_finish)
                ->update(['progress_request' => 4]);
        $body_mail = 'Request Anda telah selesai dikerjakan, mohon dicek untuk diverifikasi mengenai pengerjaan';
        $r = Requests::select('*')->where('id', $request->id_finish)->first();
        $user = User::select('*')->where('id',$r->id_user)->first();
        // $user = User::select('*')->where('id', 1)->first();
        $mail_crs = [
                'greeting' => 'Hi '.$user->name.',',
                    'body' => $body_mail,
                    'thanks' => 'Terimakasih (Mohon untuk tidak membalas email ini)',
                    'actionText' => 'View Request',
                    'actionURL' => url('/request/list'),
                    'id' => 57
                ];
        Notification::send($user, new EmailNotification($mail_crs));
        $msg_wa = 'Hi '.$user->name.'
Permintaan anda dengan nomor tiket '.$r->tic_number.' telah selesai dikerjakan.
mohon dicek untuk diverifikasi mengenai pengerjaan di https://feedback.bintanindustrial.co.id/request/list';
        $this->sendWa($user->nohp, $msg_wa);
        return response()->json($fm, 200);
        // return to_route('department.index')->with('status','Finish Request was succussfuly.');
    }

    public function newReq(){
        $id_dept = Auth::user()->id_department;
        if(Auth::user()->hasRole('admin')){
            $req_user = DB::table('requests')
            ->where('requests.progress_request',1)
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->join('departments', 'requests.id_department', '=', 'departments.id')
            ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit','users.company_name',
            'relevant_parts.name_relevant','departments.department','requests.status_feedback')
                    ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="responseReq('.$row->id.')">Response</a>
                    <a class="btn btn-sm bg-gradient-danger text-white" href="javascript:void(0);" onClick="rejectReq('.$row->id.')">Reject</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
                })
                ->editColumn('name', function($row){
                    return $row->name.' ('.$row->company_name.')';
                })
                ->addColumn('dept', function($row){
                    return $row->department.' ('.$row->name_relevant.')';
                })
                ->rawColumns(['response'])
                ->addIndexColumn()
                ->make(true);

        }else{
            $req_user = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->join('departments', 'requests.id_department', '=', 'departments.id')
            ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
            ->where('requests.progress_request',1)
            ->where('requests.id_department', $id_dept)
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit',
            'relevant_parts.name_relevant','departments.department','users.company_name')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="responseReq('.$row->id.')">Response</a>
                    <a class="btn btn-sm bg-gradient-danger text-white" href="javascript:void(0);" onClick="rejectReq('.$row->id.')">Reject</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
                })
                ->editColumn('name', function($row){
                    return $row->name.' ('.$row->company_name.')';
                })
                ->addColumn('dept', function($row){
                    return $row->department.' ('.$row->name_relevant.')';
                })
                ->rawColumns(['response'])
                ->addIndexColumn()
                ->make(true);

        }
    }

    // onresponse
    public function respReq(){
        $id_dept = Auth::user()->id_department;
        if(Auth::user()->hasRole('admin')){
            $req_user = DB::table('requests')
            ->where('requests.progress_request',2)
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit',
            'requests.status_feedback')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="progressReq('.$row->id.')">Add Progress</a>
                    <a class="btn btn-sm bg-gradient-danger text-white" href="javascript:void(0);" onClick="rejectReq('.$row->id.')">Reject</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
                })
                ->rawColumns(['response'])
                ->addIndexColumn()
                ->make(true);

        }else{
            $req_user = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->where('requests.progress_request',2)
            ->where('requests.id_department', $id_dept)
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="progressReq('.$row->id.')">Add Progress</a>
                    <a class="btn btn-sm bg-gradient-danger text-white" href="javascript:void(0);" onClick="rejectReq('.$row->id.')">Reject</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
                })
                ->rawColumns(['response'])
                ->addIndexColumn()
                ->make(true);

        }
    }

    public function show($id){
        $show = Requests::select('*')->find($id);
        return response()->json($show, 200);
    }

    public function storeResp(Request $request){
        if($request->ajax()){

            $validated = $request->validate(['id_response' =>'required', 
                    'response' => 'required',
                    'target_hari' =>'required']);
            $id_user = Auth::user()->id;
            $fm = ResponseModel::create([
                'response' => $request->response,
                'id_request' => $request->id_response,
                'target_hari' => $request->target_hari,
                'id_user' => $id_user]);
            
            Requests::where('id', $request->id_response)
                    ->update(['progress_request' => 2]);
            $r = Requests::select('*')->where('id', $request->id_response)->first();
            $update = User::select('*')->where('id',$r->id_user)->first();
            // $user =  User::select('*')->where('id',$update->id_user);
            $msg_wa = 'Hi '.$update->name.'
Permintaan anda dengan nomor tiket '.$r->tic_number.' telah direspon oleh admin department.
Respon : '.$fm->response.' (Estimasi pengerjaan '.$fm->target_hari.' hari)
Untuk lebih lanjut silahkan akses ke https://feedback.bintanindustrial.co.id/request/list';
            $this->sendWa($update->nohp, $msg_wa);
            return response()->json($fm, 200); 
        }
    }

    public function storeCancel(Request $request){
        if($request->ajax()){
            $request->validate([
                'description_reject' =>'required',
                'id_reject' =>'required'
            ]);
    
            $cancel = Requests::where('id', $request->id_reject)
                  ->update(['cancel' => $request->description_reject,
                            'progress_request'=>5,
                            'id_cancel' => Auth::user()->id
                        ]);

            return response()->json($cancel, 200); 
        }
    }

    public function sendWa($no, $message){
        // $apiURL = 'http://localhost:3000/send-message';
        // $message = array(
        //         "message" => $message,
        //         "number" => $no
        // );
       
        // $headers = [
        //     'X-header' => 'value'
        // ];
        // $response = Http::withHeaders($headers)->post($apiURL, $message);
        // $statusCode = $response->status();
        // $responseBody = json_decode($response->getBody(), true);
        dispatch(new NotificationJob($message, $no));
    }


    // onresponse
    public function progressReq(){
        $id_dept = Auth::user()->id_department;
        if(Auth::user()->hasRole('admin')){
            $req_user = DB::table('requests')
            ->where('requests.progress_request',3)
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit',
            'requests.status_feedback')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="finishReq('.$row->id.')">Close Request</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
                })
                ->rawColumns(['response'])
                ->addIndexColumn()
                ->make(true);

        }else{
            $req_user = DB::table('requests')
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->where('requests.progress_request',3)
            ->where('requests.id_department', $id_dept)
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="finishReq('.$row->id.')">Close Request</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
                })
                ->rawColumns(['response'])
                ->addIndexColumn()
                ->make(true);

        }
    }

    // onfinish
    public function finishReq(){
        $id_dept = Auth::user()->id_department;
        if(Auth::user()->hasRole('admin')){
            $req_user = Requests::where('requests.progress_request',4)
            ->join('users', 'requests.id_user', '=', 'users.id')
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit',
            'requests.status_feedback')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="finishReq('.$row->id.')">Close Request</a>';
                })
                ->editColumn('start_end', function($row){
                    $p = Progres::select('*')->where('id_request', $row->id)->first();
                    $f = FinishTask::select('*')->where('id_request', $row->id)->first();
                    $total_days = Carbon::parse($p->created_at)->diffInDays($f->created_at);
                    return $total_days.' Day';
                })
                ->editColumn('created_at', function($row){
                    $p = Progres::select('*')->where('id_request', $row->id)->first();
                    return Carbon::parse($p->created_at)->format('d/m/Y');
                })
                ->editColumn('updated_at', function($row){
                    $f = FinishTask::select('*')->where('id_request', $row->id)->first();
                    return Carbon::parse($f->updated_at)->format('d/m/Y');
                })
                ->editColumn('lokasi', function($row){
                    return $row->lokasi.' Unit '.$row->no_unit;
                })
                ->addColumn('rating', function ($row){
                    $rate = Rate::select('*')->where('id_request', $row->id)->first();
                    if(!empty($rate)){
                        $bintang = '';
                        for($i = 0; $i<5 ; $i++){
                             
                            if($rate->rate_point > $i){
                                $bintang = $bintang. ' <span class="las la-star text-warning"></span>'; 
                            }else{
                                $bintang = $bintang. ' <span class="las la-star"></span>';
                            }
                        }
                        return $bintang;
                    }else{
                        return '<span class="badge badge-warning">Waiting feedback</span>';
                    }
                    
                })
                ->addColumn('action', function($row){
                        return '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle font-20 text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="las la-cog"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);" onClick="showFinish('.$row->id.')">Show Detail</a>
                                        <a class="dropdown-item" href="'.route('admin.admin.cetak_request',$row->id).'" target="_blank">PDF</a>
                                    </div>
                                </div>';
                }) 
                ->rawColumns(['response','rating','action'])
                ->addIndexColumn()
                ->make(true);

        }else{
            $req_user = Requests::join('users', 'requests.id_user', '=', 'users.id')
            ->where('requests.progress_request',4)
            ->where('requests.id_department', $id_dept)
            ->select('requests.id','requests.created_at',
            'requests.progress_request','requests.description', 
            'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
            ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="finishReq('.$row->id.')">Close Request</a>';
                })
                ->editColumn('start_end', function($row){
                    $total_days = Carbon::parse($row->created_at)->diffInDays($row->updated_at);
                    return $total_days.' Day';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y');
                })
                ->editColumn('updated_at', function($row){
                    return Carbon::parse($row->updated_at)->format('d/m/Y');
                })
                ->editColumn('lokasi', function($row){
                    return $row->lokasi.' Unit '.$row->no_unit;
                })
                ->addColumn('rating', function ($row){
                    $rate = Rate::select('*')->where('id_request', $row->id)->first();
                    if(!empty($rate)){
                        $bintang = '';
                        for($i = 0; $i<5 ; $i++){
                             
                            if($rate->rate_point > $i){
                                $bintang = $bintang. ' <span class="las la-star text-warning"></span>'; 
                            }else{
                                $bintang = $bintang. ' <span class="las la-star"></span>';
                            }
                        }
                        return $bintang;
                    }else{
                        return '<span class="badge badge-warning">Waiting feedback</span>';
                    }  
                })
                ->addColumn('action', function($row){
                    return '<div class="dropdown custom-dropdown">
                                <a class="dropdown-toggle font-20 text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="las la-cog"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                    <a class="dropdown-item" href="javascript:void(0);" onClick="showFinish('.$row->id.')">Show Detail</a>
                                    <a class="dropdown-item" href="'.route('admin.admin.cetak_request',$row->id).'" target="_blank">PDF</a>
                                </div>
                            </div>';
                }) 
                ->rawColumns(['response','rating','action'])
                ->addIndexColumn()
                ->make(true);

        }
    }

    // onfinish
    public function rejectReq(){
        $id_dept = Auth::user()->id_department;
        if(Auth::user()->hasRole('admin')){
            $req_user = Requests::where('requests.progress_request',5)
                        ->join('users', 'requests.id_user', '=', 'users.id')
                        ->select('requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 
                        'users.name as name','requests.cancel','requests.lokasi','requests.no_unit',
                        'requests.status_feedback')
                        ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
                ->addColumn('response', function($row){
                    return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="finishReq('.$row->id.')">Close Request</a>';
                })
                ->editColumn('created_at', function($row){
                    return Carbon::parse($row->created_at)->format('d/m/Y');
                })
                ->editColumn('lokasi', function($row){
                    return $row->lokasi.' Unit '.$row->no_unit;
                })
                
                ->addIndexColumn()
                ->make(true);

        }else{
            $req_user = Requests::join('users', 'requests.id_user', '=', 'users.id')
                    ->where('requests.progress_request',5)
                    ->where('requests.id_department', $id_dept)
                    ->select('requests.id','requests.created_at',
                    'requests.progress_request','requests.description', 
                    'users.name as name','requests.cancel','requests.lokasi','requests.no_unit')
                    ->get();

            $datatables =  datatables()->of($req_user);
            return $datatables
            ->addColumn('response', function($row){
                return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="finishReq('.$row->id.')">Close Request</a>';
            })
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->created_at)->format('d/m/Y');
            })
            ->editColumn('lokasi', function($row){
                return $row->lokasi.' Unit '.$row->no_unit;
            })
            
            ->addIndexColumn()
            ->make(true);

        }
    }
}
