<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLike()
    {
        //get all likes
        $likes = Like::latest()
            ->join('reseps', 'likes.idresep', '=', 'reseps.id')
            ->select([
                'likes.*', 'reseps.image', 'reseps.title',
                'reseps.ingredients', 'reseps.step'
            ])->get();

            
        //return collection of likes as a resource
        // return new UkomResource(true, 'List Data Likes', $likes);
        return response()->json($likes);

        // echo "tes";

        // //get all likes
        // $likes = Like::latest()
        //     ->join('artikels', 'likes.idartikel', '=', 'artikels.id')
        //     ->join('kategoris', 'artikels.idkategori', '=', 'kategoris.id')
        //     ->select([
        //         'likes.*', 'kategoris.kategori', 'artikels.image', 'artikels.judul',
        //         'artikels.tgl', 'artikels.penulis', 'artikels.status', 'artikels.para1', 'artikels.para2', 'artikels.para3', 'artikels.para4'
        //     ])->get();

        // //return collection of likes as a resource
        // return new UkomResource(true, 'List Data Likes', $likes);
    }

    public function tes(){
        echo "halo";
    }

    public function checkLike(Request $request)
    {
        $existingLike = Like::where('iduser', $request->iduser)
            ->where('idresep', $request->idresep)
            ->first();

        if ($existingLike) {
            return response()->json([
                'liked' => true,
            ], 200);
        }

        return response()->json([
            'liked' => false,
        ], 200);

        // echo "evelin";
    }

    public function like(Request $request)
    {

        $existingLike = Like::where('iduser', $request->iduser)
            ->where('idresep', $request->idresep)
            ->first();

        if ($existingLike) {
            return response()->json([
                'success' => false,
                'message' => 'Anda telah memberi like pada resep ini sebelumnya.'
            ], 422);
        }

        $like = new Like();
        $like->iduser = $request->iduser;
        $like->idresep = $request->idresep;
        $like->save();

        return response()->json([
            'success' => true,
            'message' => 'Anda telah memberi like pada resep ini.',
        ],200);

        // echo "bismillah";
    }

    public function unlike(Request $request)
    {

        $like = Like::where('iduser', $request->iduser)
            ->where('idresep', $request->idresep)
            ->first();

        if (!$like) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat unlike resep ini karena Anda belum memberi like.'
            ], 422);
        }

        $like->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anda telah melakukan unlike pada resep ini.'
        ],200);

        // echo 'Bismillaah';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(Like $resep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
