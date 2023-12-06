<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    //
    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }
            $user = User::where('email',$request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        }catch(Exception $exception){
            return ResponseFormatter::error([
                'message' =>'Something when wrong',
                'error' => $exception
            ],'Authentication error', 500); 
        }
    }

    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function fecth(Request $request){
        return ResponseFormatter::success($request->user(), 'Data Profile User berhasil di ambil');
    }
}
