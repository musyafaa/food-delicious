<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minuman;

class MinumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $minuman = Minuman::all();

        if($minuman){
            return response()->json([
                'status' => 'success',
                'message' => "data minuman berhasil ditampilkan",
                'data' => $minuman
            ], 200);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'data tidak ditemukan'
            ], 404);
        }
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
        $user = auth()->user();

        $this->validate($request, [
            'nama_minuman' => 'required',
            'ukuran' => 'required',
            'topping' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'gula' => 'required'
        ]);

        if($user->role == 'admin'){
            $minuman = Minuman::create([
                'nama_minuman' => $request->nama_minuman,
                'ukuran' => $request->ukuran,
                'topping' => $request->topping,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'gula' => $request->gula
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'maaf anda tidak bisa mengakses karena anda bukan admin'
            ], 404);
        }


        return response()->json([
            'status' => 'data minuman berhasil ditambah' ,
            'data' => $minuman
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $minuman = minuman::find($id);
        if($minuman){
            return response()->json([
                'status' => 200,
                'data' => $minuman
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id diatas'. $id . 'tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user = auth()->user();

        $minuman = minuman::find($id);
        if($user->role == 'admin'){
            $minuman->update([
                'nama_minuman' => $request->nama_minuman ?? $makanan->nama_minuman,
                'ukuran' => $request->ukuran ?? $makanan->ukuran,
                'topping' => $request->topping ?? $makanan->topping,
                'deskripsi' => $request->deskripsi ?? $makanan->deskripsi,
                'harga' => $request->harga ?? $makanan->harga,         
                'gula' => $request->gula ?? $makanan->gula            
            ]);
             
        } else {
            return response()->json([
                'status' => 'error',
                'message' =>  'anda sebagai user tidak memiliki hak akses ini'
            ], 404);
        }

        return response()->json([
            'status' => 'data makanan berhasil diubah',
            'data' => $minuman
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $minuman = minuman::where('id', $id)->first();
        if($user->role == 'admin'){
            $minuman->delete();
            return response()->json([
                'status' => 'data berhasil dihapus'                
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'anda tidak memiliki hak akses ini'
            ], 404);
        }
    }
}
