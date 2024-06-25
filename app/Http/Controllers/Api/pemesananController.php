<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User; // Ensure the User model is imported
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index()
    {
        $data = Pemesanan::orderBy('kode', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'kursi' => 'required',
            'waktu' => 'required',
            'total' => 'required',
            'status' => 'required',
            'rute_id' => 'required',
            'penumpang_id' => 'required',
            'petugas_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data',
                'data' => $validator->errors()
            ], 422);
        }

        $dataPemesanan = new Pemesanan();
        $dataPemesanan->kode = $request->kode;
        $dataPemesanan->kursi = $request->kursi;
        $dataPemesanan->waktu = $request->waktu;
        $dataPemesanan->total = $request->total;
        $dataPemesanan->status = $request->status;
        $dataPemesanan->rute_id = $request->rute_id;
        $dataPemesanan->penumpang_id = $request->penumpang_id;
        $dataPemesanan->petugas_id = $request->petugas_id;
        $dataPemesanan->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menambahkan data',
        ], 201);
    }

    public function show(string $id)
    {
        $data = Pemesanan::find($id);
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
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $dataPemesanan = Pemesanan::find($id);
        if (empty($dataPemesanan)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'kode' => 'required',
            'kursi' => 'required',
            'waktu' => 'required',
            'total' => 'required',
            'status' => 'required',
            'rute_id' => 'required',
            'penumpang_id' => 'required',
            'petugas_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ], 422);
        }

        $dataPemesanan->kode = $request->kode;
        $dataPemesanan->kursi = $request->kursi;
        $dataPemesanan->waktu = $request->waktu;
        $dataPemesanan->total = $request->total;
        $dataPemesanan->status = $request->status;
        $dataPemesanan->rute_id = $request->rute_id;
        $dataPemesanan->penumpang_id = $request->penumpang_id;
        $dataPemesanan->petugas_id = $request->petugas_id;
        $dataPemesanan->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data',
        ], 200);
    }

    public function destroy(string $id)
    {
        $dataPemesanan = Pemesanan::find($id);
        if (empty($dataPemesanan)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $dataPemesanan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan delete data',
        ], 200);
    }

    public function dataPenumpang()
    {
        $penumpangs = User::where('level', 'Penumpang')->get(); // Use User model and filter by level
        return view('client.data_penumpang', compact('penumpangs'));
    }
}
