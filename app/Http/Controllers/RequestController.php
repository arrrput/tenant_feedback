<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\User;
use App\Models\Progres;
use Twilio\Rest\Client;
use App\Models\Requests;
use App\Models\FinishTask;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\RelevantParts;
use App\Models\ResponseModel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

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
            $u = Requests::join('departments', 'requests.id_department', '=', 'departments.id')
                    ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
                    ->select('requests.cancel','requests.id','requests.created_at',
                    'requests.progress_request','requests.description', 'departments.department as dept',
                    'relevant_parts.name_relevant as name')
                    ->orderBy('created_at', 'desc')
                    ->get();
        }else{
            $u = Requests::join('departments', 'requests.id_department', '=', 'departments.id')
                        ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
                        ->where('requests.id_user', $user_id)
                        ->select('requests.cancel','requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 'departments.department as dept', 
                        'relevant_parts.name_relevant as name')
                        ->orderBy('created_at', 'desc')
                        ->get();
        }
        
        
        $departments =  Departments::all();
        // $request = Requests::all();
        return view('request.list', compact('departments','u'));
    }

    
    public function getRelevant(Request $request){
        $relevant = RelevantParts::where("id_department",$request->id_department)->pluck('id','name_relevant');
        return response()->json($relevant);
    }

    public function storeRating(Request $request){

        //validate form
        $request->validate([
            'id_req_rated' =>'required',
            'star' =>'required',
            'description_finish' => 'required'
        ]);
        $fm = Rate::create([
            'id_user' => Auth::user()->id,
            'id_request' =>$request->id_req_rated,
            'rate_point' =>$request->star,
            'message' => $request->description_finish
        ]);
        return response()->json($fm, 200);

    }


    public function store(Request $request){

        // dd($request->all());
        //validate form
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' =>'required',
            'id_part' =>'required',
            'id_department' => 'required',
            'location' => 'required',
            'no_unit' => 'required',
            'progress_request' =>'required'
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/img_progress', $image->hashName());

        //Requests::create($request->all());
        $fm = Requests::create([
            'image'     => $image->hashName(),
            'description'     => $request->description,
            'id_department'   => $request->id_department,
            'id_user'   => Auth::user()->id,
            'progress_request'=> $request->progress_request,
            'lokasi' => $request->location,
            'no_unit' => $request->no_unit,
            'id_part' => $request->id_part
        ]);


        $body_mail = 'Ada Request baru dari : '.Auth::user()->name.' <p>'.$fm->description.' yang berlokasi di '.$fm->lokasi.' '.$fm->no_unit.' </p> Untuk lebih lanjut silahkan klik tombol dibawah ini';
        
        $user = User::select('*')->where('id',18)->first();
        $hod_crs = User::select('*')->where('id',21)->first();
        $admin_dept = User::select('*')->where('id_department',$fm->id_department)->get();
        // $user = User::select('*')->where('id', 1)->first();
        
        
        // end email to related department
        foreach ($admin_dept as $u){
            $msg_wa = 'Hi '.$u->name.'
 Ada Request baru dari : '.Auth::user()->name.'. Deskripsi : '.$fm->description.'
 yang berlokasi di '.$fm->lokasi.' '.$fm->no_unit.'
 untuk lebih lanjut silahkan kunjungi https://feedback.bintanindustrial.co.id';
            $mail_dept = [
                'greeting' => 'Hi '.$u->name.',',
                'body' => $body_mail,
                'thanks' => 'Terimakasih (Mohon untuk tidak membalas email ini)',
                'actionText' => 'View Request',
                'actionURL' => url('/department'),
                'id' => 57
            ];
            // if(!empty($u->email)){
            //     Notification::send($admin_dept, new EmailNotification($mail_dept));
            // }
            // $this->sendWa($u->nohp, $msg_wa);
        }
        
        // send request to email
        if(!empty($user)){
            $msg_wa_crs = 'Hi '.$user->name.'
 Ada Request baru dari : '.Auth::user()->name.'. Deskripsi : '.$fm->description.'
 yang berlokasi di '.$fm->lokasi.' '.$fm->no_unit.'
 untuk lebih lanjut silahkan kunjungi https://feedback.bintanindustrial.co.id';
            $mail_crs = [
                'greeting' => 'Hi '.$user->name.',',
                'body' => $body_mail,
                'thanks' => 'Terimakasih (Mohon untuk tidak membalas email ini)',
                'actionText' => 'View Request',
                'actionURL' => url('/department'),
                'id' => 57
            ];
            Notification::send($user, new EmailNotification($mail_crs));
            // $this->sendWa($user->nohp, $msg_wa_crs);

        }
        if(!empty($hod_crs)){
            $msg_wa_hod = 'Hi '.$hod_crs->name.'
 Ada Request baru dari : '.Auth::user()->name.'. 
 Deskripsi : '.$fm->description.'
 yang berlokasi di '.$fm->lokasi.' '.$fm->no_unit.'
 untuk lebih lanjut silahkan kunjungi https://feedback.bintanindustrial.co.id';
            $mail_hod = [
                'greeting' => 'Hi '.$hod_crs->name.',',
                'body' => $body_mail,
                'thanks' => 'Terimakasih (Mohon untuk tidak membalas email ini)',
                'actionText' => 'View Request',
                'actionURL' => url('/department'),
                'id' => 57
            ];
            // $this->sendWa($hod_crs->nohp, $msg_wa_hod);
            Notification::send($hod_crs, new EmailNotification($mail_hod));
        }

        return response()->json($fm, 200);
    }

    public function sendWa($no, $message){
        $apiURL = 'http://localhost:3000/send-message';
        $message = array(
                "message" => $message,
                "number" => $no
        );
       
        $headers = [
            'X-header' => 'value'
        ];
        $response = Http::withHeaders($headers)->post($apiURL, $message);
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
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

    public function myReq(Request $request){
        $user_id = Auth::user()->id;
        $get_role =  Role::whereNotIn('name', ['admin'])->count();

        if(Auth::user()->roles->pluck('name') =='admin'){
            $list = Requests::join('departments', 'requests.id_department', '=', 'departments.id')
                    ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
                    ->select('requests.cancel','requests.id','requests.created_at',
                    'requests.progress_request','requests.description', 'departments.department as dept',
                    'relevant_parts.name_relevant as name', 'requests.lokasi','requests.no_unit','requests.tic_number')
                    ->orderBy('created_at', 'desc');
            if($request->has('status_progress')){
                $list->where('requests.progress_request', $request->status_progress);
                if($request->status_progress == 2){
                    $list->join('response', 'requests.id', 'response.id_request')
                        ->select('response.response','response.target_hari','requests.cancel','requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 'departments.department as dept',
                        'relevant_parts.name_relevant as name', 'requests.tic_number');
                }
                if($request->status_progress == 4){
                    $list->join('progress', 'requests.id', 'progress.id_request')
                    ->select('progress.message','progress.akar_penyebab','requests.cancel','requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 'departments.department as dept',
                        'relevant_parts.name_relevant as name', 'requests.tic_number','requests.lokasi','requests.no_unit');
                }
            }
            
            $datatables =  datatables()->of($list->get());
            return $datatables
                    ->addColumn('root_cause', function($row){
                        if($row->akar_penyebab){
                            return $row->akar_penyebab;
                        }
                    })
                    ->addColumn('correction', function($row){
                        if($row->message){
                            return $row->message;
                        }
                    })
                    ->addColumn('description', function($row){
                        return $row->description;
                    })
                    ->addColumn('show_progress', function($row){
                        return '<a class="btn btn-sm bg-gradient-danger text-white" href="javascript:void(0);" onClick="showProgress('.$row->id.')">Reject</a>';
                    })
                    ->addColumn('verified', function($row){
                        $find = Rate::select('*')->where('id_request',$row->id)->first();
                        if(!empty($find)){
                            $bintang = '';
                            for($i = 0; $i<5 ; $i++){
                                
                                if($find->rate_point >= $i){
                                    $bintang = $bintang. ' <span class="las la-star text-warning"></span>'; 
                                }else{
                                    $bintang = $bintang. ' <span class="las la-star"></span>';
                                }
                            }
                            return $bintang;
                        }else{
                            return '<a class="btn btn-sm bg-gradient-warning text-white" href="javascript:void(0);" onClick="showRating('.$row->id.')"><i class"la la-eye"></i> Verification</a>';
                        }
                         
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at)->format('d/m/Y');
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at)->format('d/m/Y');
                    })
                    ->addColumn('est_day', function($row){
                        if($row->target_hari){
                            return$row->target_hari.' Day';
                        }  
                    })
                    ->editColumn('lokasi', function($row){
                        return $row->lokasi.' No. '.$row->no_unit;
                    })
                    ->rawColumn(['show_progress'])
                    ->addIndexColumn()
                    ->make(true);
        }else{
            $list = Requests::join('departments', 'requests.id_department', '=', 'departments.id')
                        ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
                        ->where('requests.id_user', $user_id)
                        ->select('requests.cancel','requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 'departments.department as dept', 
                        'relevant_parts.name_relevant as name', 'requests.lokasi','requests.no_unit','requests.tic_number')
                        ->orderBy('requests.created_at', 'desc');
            if($request->has('status_progress')){
                $list->where('requests.progress_request', $request->status_progress);
                if($request->status_progress == 2){
                    $list->join('response', 'requests.id', 'response.id_request')
                        ->select('response.response','response.target_hari','response.created_at as time_resp', 'requests.cancel','requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 'departments.department as dept',
                        'relevant_parts.name_relevant as name', 'requests.tic_number');
                }
                if($request->status_progress == 4){
                    $list->join('progress', 'requests.id', 'progress.id_request')
                        ->select('progress.message','progress.akar_penyebab','requests.cancel','requests.id','requests.created_at',
                        'requests.progress_request','requests.description', 'departments.department as dept',
                        'relevant_parts.name_relevant as name', 'requests.tic_number','requests.lokasi','requests.no_unit');
                }
            }

            $datatables =  datatables()->of($list->get());
            return $datatables
                        ->addColumn('show_finish', function($row){
                            return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="showFinish('.$row->id.')"><i class"la la-eye"></i> Show Detail</a>';
                        })
                        ->addColumn('show_progress', function($row){
                            return '<a class="btn btn-sm bg-gradient-success text-white" href="javascript:void(0);" onClick="showProgress('.$row->id.')"><i class"la la-eye"></i> Show Detail</a>';
                        })
                        ->editColumn('created_at', function($row){
                            return Carbon::parse($row->created_at)->format('d/m/Y');
                        })
                        ->editColumn('dept', function($row){
                            return $row->dept.' ('.$row->name.')';
                        })
                        ->editColumn('lokasi', function($row){
                            return $row->lokasi.' No. '.$row->no_unit;
                        })
                        ->addColumn('est_day', function($row){
                            if($row->target_hari){
                                return$row->target_hari.' Day';
                            }  
                        })
                        ->addColumn('verified', function($row){
                            $find = Rate::select('*')->where('id_request',$row->id)->first();
                            if(!empty($find)){
                                $bintang = '';
                                for($i = 0; $i<5 ; $i++){
                                    
                                    if($find->rate_point > $i){
                                        $bintang = $bintang. ' <span class="las la-star text-warning"></span>'; 
                                    }else{
                                        $bintang = $bintang. ' <span class="las la-star"></span>';
                                    }
                                }
                                return $bintang;
                            }else{
                                return '<a class="btn btn-sm bg-gradient-warning text-white" href="javascript:void(0);" onClick="showRating('.$row->id.')"><i class"la la-eye"></i> Verification</a>';
                            }
                             
                        })
                        ->addColumn('resp', function($row){
                            
                            if($row->response){
                                return $row->response.'<span class="badge text-primary">('.Carbon::parse($row->time_resp)->diffForHumans().')</span>';
                            }
                            
                        })
                        ->rawColumns(['resp','show_progress','verified','show_finish'])
                        ->addIndexColumn()
                        ->make(true);
        }
    }

    public function cancelReq(Request $request){
        if($request->ajax()){
            $list = Requests::join('departments', 'requests.id_department', '=', 'departments.id')
                    ->join('relevant_parts', 'requests.id_part', '=', 'relevant_parts.id')
                    ->join('users', 'requests.id_cancel', '=', 'users.id')
                    ->select('requests.cancel','requests.id','requests.created_at',
                            'requests.progress_request','requests.description', 'departments.department as dept',
                            'relevant_parts.name_relevant as name', 'requests.lokasi','requests.no_unit',
                            'requests.tic_number','users.name as cancel_by')
                    ->where('id_user',Auth::user()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            
                    $datatables =  datatables()->of($list);
                    return $datatables
                            ->addColumn('description', function($row){
                                return $row->description;
                            })        
                            ->editColumn('created_at', function($row){
                                return Carbon::parse($row->created_at)->format('d/m/Y');
                            })
                            ->editColumn('date', function($row){
                                return Carbon::parse($row->created_at)->format('d/m/Y');
                            })
                            ->addColumn('cancel_reason', function($row){
                                return $row->cancel;
                            })
                            ->editColumn('lokasi', function($row){
                                return $row->lokasi.' No. '.$row->no_unit;
                            })
                            ->addIndexColumn()
                            ->make(true);

            
        }
    }

    public function show($id){
        $req = Requests::select('*')->where('id', $id)->first();
        $resp = ResponseModel::select('*')->where('id_request',$id)->first();
        $progress = Progres::select('*')->where('id_request', $id)->first();
        $finish = FinishTask::select('*')->where('id_request', $id)->first();
        $feedback_user = Rate::select('*')->where('id_request', $id)->first();

        $data =  array(
            'id' => $req->id,
            'description' => $req->description,
            'image_req' => $req->image,
            'date_req'=> Carbon::parse($req->created_at)->format('d M Y H:i'),
            'location' =>$req->lokasi.' No.'.$req->no_unit,
            'response'=> $resp->response,
            'date_resp' => Carbon::parse($resp->created_at)->format('d M Y H:i'),
            'correction'=> $progress->message,
            'root_cause' => $progress->akar_penyebab,
            'image_progress' => $progress->image,
            'date_progress' => Carbon::parse($progress->created_at)->format('d M Y H:i'),
            
        );

        if(!empty($finish)){
            $data += array(
                'message_finish'=> $finish->description,
                'image_finish'=> $finish->image,
                'date_finish' => Carbon::parse($finish->created_at)->format('d M Y H:i'),
            );
        }
        if(!empty($feedback_user)){
            $data += array(
                'feedback_user'=> $feedback_user->message,
                'rate'=> $feedback_user->rate_point,
                'date_feedback' => Carbon::parse($feedback_user->created_at)->format('d M Y H:i'),
            );
        }

        return response()->json($data, 200);
    }
}