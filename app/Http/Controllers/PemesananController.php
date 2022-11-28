<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan = Pemesanan::all();
        if($pemesanan){
            return response()->json([
                'status' => 'success',
                'message' => "data pemesanan berhasil ditampilkan",
                'data' => $pemesanan
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
            'nama_pemesan' => 'required',
            'makanan_yang_dipesan' => 'required',
            'jumlah' => 'required',
            'alamat' => 'required',
            'metode_pembayaran' => 'required',
            'tambahan_lainnya' => 'required',
            'total_pembayaran' => 'required'
        ]);
        
        if($user->role == 'user'){
            $pemesanan = Pemesanan::create([
                'nama_pemesan' => $request->nama_pemesan,
                'makanan_yang_dipesan' => $request->makanan_yang_dipesan,
                'jumlah' => $request->jumlah,
                'alamat' => $request->alamat,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tambahan_lainnya' => $request->tambahan_lainnya,
                'total_pembayaran' => $request->total_pembayaran
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'pembayaran hanya dilakukan oleh customer'
            ], 404);
        }


        return response()->json([
            'status' => 'data pemesanan berhasil ditambah' ,
            'data' => $pemesanan
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
        $pemesanan = pemesanan::find($id);
        if($pemesanan){
            return response()->json([
                'status' => 200,
                'data' => $pemesanan
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
        // $user = auth()->user();

        // $pemesanan = pemesanan::find($id);
        // if($user->role == 'admin'){
        //     $pemesanan->update([
        //         'nama_pemesan' => $request->nama_pemesan ?? $makanan->nama_pemesan,
        //         'makanan_yang_dipesan' => $request->makanan_yang_dipesan ?? $makanan->makanan_yang_dipesan,
        //         'jumlah' => $request->jumlah ?? $makanan->jumlah,
        //         'alamat' => $request->alamat ?? $makanan->alamat,
        //         'metode_pembayaran' => $request->metode_pembayaran ?? $makanan->metode_pembayaran,            
        //         'tambahan_lainnya' => $request->tambahan_lainnya ?? $makanan->tambahan_lainnya,            
        //         'total_pembayaran' => $request->total_pembayaran ?? $makanan->total_pembayaran            
        //     ]);
             
        // } else {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' =>  'anda sebagai user tidak memiliki hak akses ini'
        //     ], 404);
        // }

        // return response()->json([
        //     'status' => 'data makanan berhasil diubah',
        //     'data' => $pemesanan
        // ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $pemesanan = pemesanan::where('id', $id)->first();
        // if($pemesanan){
        //     $pemesanan->delete();
        //     return response()->json([
        //         'status' => 200,
        //         'data' => $pemesanan
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'id diatas'. $id . 'tidak ditemukan'
        //     ], 404);
        // }
    }
}
