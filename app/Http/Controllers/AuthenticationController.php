<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\http\Requests\JWTAuthRequest;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'message'=> 'wrong validation',
                'errors'=> $validator->errors(),
            ], 422);
        }
        
        $token = null;

        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'token'   => $token,
                'user'   => User::where('email', $credentials['email'])->get()->first(),
            ], 200);
        }else{
            return response()->json([
                'success'=> false,
                'message'=> 'wrong credentials',
                'errors'=> $validator->errors(),
            ], 401);
        }
    }

    public function logout()
    {
        $token = JWTAuth::getToken();

        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed Logout, please try again!'
            ], 422);
        }
    }

    public  function  getAuthUser() {
        $user = Auth::user();
        return response()->json([
            'user' => $user
        ], 200);
    }
}
