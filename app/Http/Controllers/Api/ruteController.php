<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rute;
use Illuminate\Support\Facades\Validator;

class ruteController extends Controller
{
    public function index()
    {
        $data = Rute::orderBy('tujuan', 'asc')->get();
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
        $dataRute = new Rute;

        $rules = [
        'tujuan'=>'required',
        'start'=>'required',
        'end'=>'required',
        'harga'=>'required',
        'jam'=>'required',
        'transportasi_id'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator-> fails()){
            return response()->json([
            'status' => true,
            'message' => 'Gagal memasukkan data',
            'data' => $validator->errors()
            ]);
        }

        $dataRute->tujuan = $request->tujuan;
        $dataRute->start = $request->start;
        $dataRute->end = $request->end;
        $dataRute->harga = $request->harga;
        $dataRute->jam = $request->jam;
        $dataRute->transportasi_id = $request->transportasi_id;


        $post = $dataRute->save();

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
        $data = Rute::find($id);
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
        $dataRute = Rute::find($id);
        if(empty($dataRute)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'tujuan'=>'required',
        'start'=>'required',
        'end'=>'required',
        'harga'=>'required',
        'jam'=>'required',
        'transportasi_id'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator-> fails()){
            return response()->json([
            'status' => true,
            'message' => 'Gagal melakukan update data',
            'data' => $validator->errors()
            ]);
        }

        $dataRute->tujuan = $request->tujuan;
        $dataRute->start = $request->start;
        $dataRute->end = $request->end;
        $dataRute->harga = $request->harga;
        $dataRute->jam = $request->jam;
        $dataRute->transportasi_id = $request->transportasi_id;


        $post = $dataRute->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data',
        ]);  
    }

    public function destroy(string $id)
    {
        $dataRute = Rute::find($id);
        if(empty($dataRute)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $post = $dataRute->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ]);  
    }
}

