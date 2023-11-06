<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function index()
    {
        $data = admin::all();
        return response()->json($data);
    }

    public function register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:admins',
        //     'password' => 'required|min:6',
        // ]);

        // $admin = new Admin;
        // $admin->name = $request->name;
        // $admin->email = $request->email;
        // $admin->password = Hash::make($request->password);
        // $admin->save();

        // return response()->json(['message' => 'Admin registered successfully']);


        $data = $request->all();

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::login($admin);

        // return response()->json(['message' => 'Registration successful'], 201);
        if($admin) {
            return response()->json([
                'success' => true,
                'admin'    => $admin,  
            ], 201);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Admin login successful']);
        }

        // return response()->json(['error' => 'Invalid login credentials'], 401);
        return response()->json(['name' => $request->name, 'message' => 'Admin login successful']);


        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     $admin = Auth::user();
        //     return response()->json(['user' => $admin], 200);
        // } else {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
    }

    public function show(Admin $admin, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($admin, 200);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'Admin logout successful']);
    }
}
