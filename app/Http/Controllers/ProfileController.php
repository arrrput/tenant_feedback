<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   

        return to_route('profile.index')->with('message','Password was successful updated.');
    }

    public function updateProfile(Request $request){
        if($request->ajax()){

            $request->validate([
                'name' => ['required'],
                'nohp' => ['required'],
            ]);

            $user = User::find(Auth::user()->id);
            $name_file = $user->image;
            if($request->has('img_user')){
                //upload photo
                // $img = $request->file('img_user');
                // $img->storeAs('public/profile', $img);
                // $image = $img->hashName();
                $data = $request->file('img_user');
                $name_file = uniqid() . '_' . trim($data->getClientOriginalName()); 
                $data->storeAs('public/profile', $name_file);
                
            }
            
            $user->name = $request->name;
            $user->nohp = $request->nohp;
            $user->image = $name_file;
            $user->save(); 
            $msg = array(
                            'message'=>'Update Successfully', 
                            'status'=>200
                        );
            
            return response()->json($msg, 200);
        }
    }
}
