<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user['token'] = $user->createToken('abc')->accessToken;
        return response()->json($user,200);
    }
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user['token'] = Auth::user()->createToken('abc')->accessToken;
            return response()->json($user, 200);
        }
    }
    public function err(){
        $data['status'] = 'unauthenticate';
        return response($data,200);
    }
}
