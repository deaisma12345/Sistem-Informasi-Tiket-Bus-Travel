<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Validator;

class transportasiController extends Controller
{
    public function index()
    {
        $data = Transportasi::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataTransportasi = new Transportasi;

        $rules = [
            'name'=>'required',
            'kode'=>'required',
            'jumlah'=>'required',
            'category_id'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator-> fails()){
            return response()->json([
            'status' => true,
            'message' => 'Gagal memasukkan data',
            'data' => $validator->errors()
            ]);
        }

        $dataTransportasi->name = $request->name;
        $dataTransportasi->kode = $request->kode;
        $dataTransportasi->jumlah = $request->jumlah;
        $dataTransportasi->category_id = $request->category_id;


        $post = $dataTransportasi->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menambahkan data',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Transportasi::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataTransportasi = Transportasi::find($id);
        if(empty($dataTransportasi)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'name'=>'required',
            'kode'=>'required',
            'jumlah'=>'required',
            'category_id'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator-> fails()){
            return response()->json([
            'status' => true,
            'message' => 'Gagal melakukan update data',
            'data' => $validator->errors()
            ]);
        }

        $dataTransportasi->name = $request->name;
        $dataTransportasi->kode = $request->kode;
        $dataTransportasi->jumlah = $request->jumlah;
        $dataTransportasi->category_id = $request->category_id;


        $post = $dataTransportasi->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data',
        ]);  
    }

    public function destroy(string $id)
    {
        $dataTransportasi = Transportasi::find($id);
        if(empty($dataTransportasi)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $dataTransportasi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}
