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

    public function remove($id)
    {
        // Temukan resep berdasarkan ID
        $recipe = Resep::find($id);

        if (!$recipe) {
            return response()->json(['message' => 'Resep tidak ditemukan'], 404);
        }

        // Hapus tanda bookmark
        $recipe->is_bookmarked = false;
        $recipe->save();

        return response()->json(['message' => 'Tanda bookmark dihapus']);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $reseps = Resep::where('title', 'like', "%$keyword%")
            ->get();

        return response()->json(['reseps' => $reseps]);
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

    public function bookmark($id)
    {
        // Menandai atau melepas tanda resep sebagai bookmark
        $resep = Resep::findOrFail($id);
        $resep->is_bookmarked = !$resep->is_bookmarked;
        $resep->save();

        return response()->json(['message' => 'Status bookmark diubah']);
    }

    public function approve($id)
    {
        // Menandai atau melepas tanda resep sebagai bookmark
        $resep = Resep::findOrFail($id);
        $resep->is_approve = !$resep->is_approve;
        $resep->save();

        return response()->json(['message' => 'Status approve diubah']);
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
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'ingredients'     => 'required',
            'step'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $post = Resep::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . basename($post->image));

            //update post with new image
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'ingredients'     => $request->ingredients,
                'step'     => $request->step,
            ]);
        } else {

            //update post without image
            $post->update([
                'title'     => $request->title,
                'ingredients'     => $request->ingredients,
                'step'     => $request->step,
            ]);
        }

        //return response
        return response()->json(['message' => 'Image and data updated successfully', $post]);
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
