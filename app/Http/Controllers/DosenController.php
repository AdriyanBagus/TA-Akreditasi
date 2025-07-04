<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function home()
    {
        return view('dosen.dashboard');
    }

    public function index()
    {
        $data = Dosen::all();
        return view('dosen.index', compact('data'));
    }

    public function create()
    {
        $prodiList = User::where('usertype', 'user')->pluck('name', 'id');

        return view('dosen.create', compact('prodiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asal_prodi' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'nidn' => 'required|string|max:50',
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'asal_prodi' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'nidn' => 'required|string|max:50',
        ]);

        $dosen->update($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }

}
