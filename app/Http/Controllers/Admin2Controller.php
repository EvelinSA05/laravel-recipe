<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = admin::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = Admin::create([
            'akunadmin' => $request->input('akunadmin'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        return response()->json(['admin' => $admin], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $admin->update([
            'akunadmin' => $request->input('akunadmin'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        return response()->json(['message' => 'User updated successfully', 'admin' => $admin], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $admin->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
