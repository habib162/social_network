<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    public function login(Request $request){
       
        try {
            if(Auth::attempt($request->only('email','password'))){
                $user =Auth::user();
                $token = $user->createToken('app')->accessToken;
                
                return response([
                    'message' => "successfully login",
                    'token'  => $token,
                    'person' => $user
    
                ],200);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ],401);
        }
        return response([
            'message' => "invalid Email or Password"
        ],401);
    }

    // register method
    public function register(Request $request){
        $validated = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'required',
            'password' => 'required|min:5'

        ]);

        try {
            $user =  User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token=$user->createToken('app')->accessToken;
            return response([
                'message' => "Registration Successfully",
                'token' => $token,
                'person' =>$user
            ],200);
        } 
        catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ],401);
        }

       

    }
}
