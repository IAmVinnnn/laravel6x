<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $register_data = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        // Encrypt Password
        $register_data['password'] = bcrypt($request->password);

        $user = User::create($register_data);
        $user->sendEmailVerificationNotification();
        $access_token = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'access_token' => $access_token]);
    }
}
