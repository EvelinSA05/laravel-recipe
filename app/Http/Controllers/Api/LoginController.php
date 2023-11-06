<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        //if auth failed
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        $user = auth()->user();

        if ($user && $user->role === 'user') {
            return response()->json([
                'success' => false,
                'message' => 'User is not allowed to login through this endpoint.'
            ], 403);
        };

        //if auth success
        if ($user->isAdmin()) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
                'role' => 'admin'
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
                'role' => 'user'
            ], 200);
        }
    }

    public function me(Request $request)
    {
        $user = $request->input('role');

        $data = User::where('role', $user)->get();
        // $dataUser = User::where('role', 'user')->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json($data);
        }
    }
}
