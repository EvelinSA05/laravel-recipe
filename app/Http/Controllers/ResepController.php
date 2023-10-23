<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

        // $data = new Resep();
        // $image = $request->file('image')->getClientOriginalName();
        // $request->file('image')->move('foto/' . $image);

        // $data->title = $request->input('title');
        // $data->image = url('foto/' . $image);
        // $data->ingredients = $request->input('ingredients');
        // $data->step = $request->input('step');
        // $data->save();
        // echo "Data berhasil ditambahkan!";

        // return response()->json($data);

        $request->validate([
            'title'=>'required|max:255',
            'image'=>'required|image|max:5040',
            'ingredients'=>'required|max:255',
            'step'=>'required|max:255'
        ]);

        $gambar = $request->image;
        $slug = Str::slug($gambar->getClientOriginalName());
        $new_gambar = time().'_'.$slug;
        $gambar->move('', $new_gambar);

        $resep = new Resep;
        $resep->title = $request->title;
        $resep->image = ''.$new_gambar;
        $resep->ingredients = $request->ingredients;
        $resep->step = $request->step;
        $resep->save();

         return response()->json(['reseps' => $resep], 201);

        // $reseps = Reseps::create([
        //     'title' => $request->input('title'),
        //     'image' => $request->input('image'),
        //     'ingredients' => $request->input('ingredients'),
        //     'step' => $request->input('step'),
        //     // tambahkan kolom lain sesuai kebutuhan
        // ]);

        // return response()->json(['reseps' => $reseps], 201);

        // $response = Http::post('http://127.0.0.1:8000/api/reseps', [
        //     'title' => $request->input('title'),
        //     'image' => $request->input('image'),
        //     'ingredients' => $request->input('ingredients'),
        //     'step' => $request->input('step'),
        // ]);
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
