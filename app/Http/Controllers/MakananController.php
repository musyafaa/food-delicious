<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //admin dan user bisa lihat
    public function index()
    {
        $makanan = Makanan::all();

        if($makanan){
            return response()->json([
                'status' => 'success',
                'message' => "data makanan berhasil ditampilkan",
                'data' => $makanan
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

     //hanya admin yang bisa menambahkan
    public function store(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'nama_makanan' => 'required',
            'pedas' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'tingkat_kematangan' => 'required'
        ]);

        if($user->role == 'admin'){
            $makanan = Makanan::create([
                'nama_makanan' => $request->nama_makanan,
                'pedas' => $request->pedas,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'tingkat_kematangan' => $request->tingkat_kematangan
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'maaf anda tidak bisa mengakses karena anda bukan admin'
            ], 404);
        }


        return response()->json([
            'status' => 'data makanan berhasil ditambah' ,
            'data' => $makanan
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //admin dan customer bisa melihat
    public function show($id)
    {
        $makanan = makanan::find($id);
        if($makanan){
            return response()->json([
                'status' => 200,
                'data' => $makanan
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $id . 'tidak ditemukan'
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

     //hanya admin yang bisa melakukan update
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $makanan = makanan::find($id);
        if($user->role == 'admin'){
            $makanan->update([
                'nama_makanan' => $request->nama_makanan ?? $makanan->nama_makanan,
                'pedas' => $request->pedas ?? $makanan->pedas,
                'deskripsi' => $request->deskripsi ?? $makanan->deskripsi,
                'harga' => $request->harga ?? $makanan->harga,
                'tingkat_kematangan' => $request->tingkat_kematangan ?? $makanan->tingkat_kematangan            
            ]);
             
        } else {
            return response()->json([
                'status' => 'error',
                'message' =>  'anda sebagai user tidak memiliki hak akses ini'
            ], 404);
        }

        return response()->json([
            'status' => 'data makanan berhasil diubah',
            'data' => $makanan
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //hanya admin yang bisa menghapus
    public function destroy($id)
    {
        $user = auth()->user();

        $makanan = makanan::where('id', $id)->first();
        if($user->role == 'admin'){
            $makanan->delete();            
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'anda sebagai customer tidak memiliki hak akses ini'
            ], 404);
        }

        return response()->json([
            'status' => 'Data makanan berhasil dihapus',                
        ], 200);
    }
}
