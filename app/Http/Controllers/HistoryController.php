<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = history::all();
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
        // $histories = History::create([
        //     'title' => $request->input('title'),
        //     'namaakun' => $request->input('namaakun'),
        //     'kategori' => $request->input('kategori'),
        //     // tambahkan kolom lain sesuai kebutuhan
        // ]);

        // return response()->json(['histories' => $histories], 201);

        // if ($request->file('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        // }
    
        // $imageData = new History();
        // $imageData->title = $request->input('title');
        // $imageData->namaakun = $request->input('namaakun');
        // $imageData->kategori = $request->input('kategori');
        // $imageData->image = $imageName;
        // $imageData->save();

        //  // $resep = new Resep;
        // // $resep->title = $request->title;
        // // $resep->image = 'foto/'.$new_gambar;
        // // $resep->ingredients = $request->ingredients;
        // // $resep->step = $request->step;
        // // $resep->save();

        // //  return response()->json(['reseps' => $imageData], 201);

    
        // return response()->json([
        //     'message' => 'Data uploaded successfully',
        //     'image_url' => asset('images/' . $imageName),
        //     'title' => $request->input('title'),
        //     'namaakun' => $request->input('namaakun'),
        //     'kategori' => $request->input('kategori'),
        // ]);

        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'namaakun' => 'required',
            'kategori' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        $resep = History::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'namaakun'   => $request->namaakun,
            'kategori'   => $request->kategori,
        ]);

        return response()->json(['histories' => $resep], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $histories = History::find($id);

        if (!$histories) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $histories->update([
            'title' => $request->input('title'),
            'namaakun' => $request->input('namaakun'),
            'kategori' => $request->input('kategori'),
            // tambahkan kolom lain sesuai kebutuhan
        ]);

        return response()->json(['message' => 'User updated successfully', 'history' => $histories], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $histories = History::find($id);

        if (!$histories) {
            return response()->json(['message' => 'User not found']);
        }

        $histories->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
