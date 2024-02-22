<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Models\Departments;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function index(){
        
        $data = User::orderBy('id','DESC')->get();
        
        return view('admin.user.index',compact('data'));
    }

    public function manageUser(){
        return view('admin.manage_user.index');
    }
    
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $departments =  Departments::all();
        return view('admin.user.create',compact('roles','departments'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'nohp' => 'required',
            'id_department' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.user.index')
                        ->with('success','User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $departments =  Departments::all();
        return view('admin.user.edit',compact('user','roles','userRole','departments'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'nohp' => 'required',
            'id_department' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.user.index')
                        ->with('success','User updated successfully');
    }
}
