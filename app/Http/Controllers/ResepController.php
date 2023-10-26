<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ResepStoreRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = resep::all();
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
        // $request->validate([
        //     // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'title' => 'required|string|max:255',
        //     'ingredients' => 'required|string',
        //     'step' => 'required|string',
        //     'namaakun' => 'required|string',
        // ]);

        // if ($request->file('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        // }

        // $imageData = new Resep();
        // $imageData->title = $request->input('title');
        // $imageData->step = $request->input('step');
        // $imageData->ingredients = $request->input('ingredients');
        // $imageData->namaakun = $request->input('namaakun');
        // $imageData->image = $imageName;
        // $imageData->save();

        // return response()->json(['reseps' => $imageData], 201);

        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'ingredients'   => 'required',
            'step' => 'required',
            'namaakun' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        $resep = Resep::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'ingredients'   => $request->ingredients,
            'step'   => $request->step,
            'namaakun'   => $request->namaakun,
        ]);

        return response()->json(['reseps' => $resep], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $reseps
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $resep, $id)
    {
        $resep = Resep::find($id);

        if (!$resep) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($resep, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit(Resep $resep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resep  $reseps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $reseps=Reseps::find($id);
        // $reseps->update($request->all());
        // return $reseps;

        // $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'  // Example validation for image
        // ]);

        // // Handle file upload
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('foto');  // Store the image in the 'images' directory
        //     // Update image information in the database (you'll need to implement this)
        //     // ...
        //     return response()->json(['message' => 'Image updated successfully']);
        // }

        // return response()->json(['message' => 'No image uploaded'], 400);

        // $image = Reseps::find($id);

        // if (!$image) {
        //     return response()->json(['message' => 'Image not found'], 404);
        // }

        // // Validasi request
        // $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);

        // // Handle file upload
        // if ($request->hasFile('image')) {
        //     $data = $request->file('image')->store('foto');
        //     // Update path gambar di database
        //     $image->image = $data;
        //     $image->save();

        //     return response()->json(['message' => 'Image updated successfully']);
        // }

        // return response()->json(['message' => 'No image uploaded'], 400);

        // Cari gambar berdasarkan ID

        $image = Resep::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        // Validasi request
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'string',
            'ingredients' => 'string',
            'step' => 'string',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foto');
            $image->image = $imagePath;
        }

        $image->title = $request->input('title', $image->title);
        $image->ingredients = $request->input('ingredients', $image->ingredients);
        $image->step = $request->input('step', $image->step);

        // Simpan perubahan
        $image->save();

        return response()->json(['message' => 'Image and data updated successfully']);


        // $reseps = Reseps::find($id);

        // if (!$reseps) {
        //     return response()->json(['message' => 'User not found'], 404);
        // }

        // $reseps->update([
        //     'title' => $request->input('title'),
        //     'image' => $request->input('image'),
        //     'ingredients' => $request->input('ingredients'),
        //     'step' => $request->input('step'),
        //     // tambahkan kolom lain sesuai kebutuhan
        // ]);

        // return response()->json(['message' => 'User updated successfully', 'reseps' => $reseps], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resep = Resep::find($id);

        if (!$resep) {
            return response()->json(['message' => 'User not found']);
        }

        $resep->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
