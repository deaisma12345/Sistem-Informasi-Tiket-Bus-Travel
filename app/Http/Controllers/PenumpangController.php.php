<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PenumpangController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $penumpangs = User::where('level', 'Penumpang')->get();
        return view('penumpang.index', compact('penumpangs'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('penumpang.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('penumpang.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = 'Penumpang';
        $user->save();

        return redirect()->route('penumpang.index')
                         ->with('success', 'Penumpang created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $penumpang = User::findOrFail($id);
        return view('penumpang.show', compact('penumpang'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $penumpang = User::findOrFail($id);
        return view('penumpang.edit', compact('penumpang'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $penumpang = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $penumpang->id,
            'password' => 'nullable|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('penumpang.edit', $penumpang->id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $penumpang->name = $request->name;
        $penumpang->username = $request->username;
        if ($request->filled('password')) {
            $penumpang->password = Hash::make($request->password);
        }
        $penumpang->save();

        return redirect()->route('penumpang.index')
                         ->with('success', 'Penumpang updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $penumpang = User::findOrFail($id);
        $penumpang->delete();

        return redirect()->route('penumpang.index')
                         ->with('success', 'Penumpang deleted successfully.');
    }

    // Display data penumpang
    public function dataPenumpang()
    {
        $penumpangs = User::where('level', 'Penumpang')->get();
        return view('client.data_penumpang', compact('penumpangs'));
    }
}
