<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfileDosenNew;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileDosenNewController extends Controller
{
    public function index()
    {
        $profil_dosen = ProfileDosenNew::with(['prodi', 'dosen'])->get();
        $users = User::all(); // atau filter sesuai kebutuhan, misal hanya yang role-nya prodi

        return view('dosen.profil_dosen', compact('profil_dosen', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asal_prodi' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:11',
            'kualifikasi_pendidikan' => 'required|string|max:255',
            'sertifikasi_pendidik_profesional' => 'nullable|string|max:255',
            'bidang_keahlian' => 'required|string|max:255',
            'bidang_ilmu_prodi' => 'required|string|max:255',
        ]);

        // Ambil dosen_id dari user yang sedang login
        $dosen = Auth::user()->dosen;

        if (!$dosen) {
            return back()->withErrors(['dosen_id' => 'User ini belum memiliki data dosen.']);
        }

        ProfileDosenNew::create([
            'asal_prodi' => $request->asal_prodi,
            'dosen_id' => $dosen->id,
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'kualifikasi_pendidikan' => $request->kualifikasi_pendidikan,
            'sertifikasi_pendidik_profesional' => $request->sertifikasi_pendidik_profesional,
            'bidang_keahlian' => $request->bidang_keahlian,
            'bidang_ilmu_prodi' => $request->bidang_ilmu_prodi,
        ]);

        return redirect()->route('dosen.profil_dosen.index')->with('success', 'Profil dosen berhasil ditambahkan.');
    }

    public function update(Request $request, ProfileDosenNew $profildosen)
    {
        $request->validate([
            'asal_prodi' => 'required|exists:users,id',
            'dosen_id' => 'required|exists:dosen,id',
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:11',
            'kualifikasi_pendidikan' => 'required|string|max:255',
            'sertifikasi_pendidik_profesional' => 'nullable|string|max:255',
            'bidang_keahlian' => 'required|string|max:255',
            'bidang_ilmu_prodi' => 'required|string|max:255',
        ]);

        $profildosen->update($request->all());

        return redirect()->route('dosen.profil_dosen.index')->with('success', 'Profil dosen berhasil diperbarui.');
    }

    public function destroy(ProfileDosenNew $profildosen)
    {
        $profildosen->delete();

        return redirect()->route('dosen.profil_dosen.index')->with('success', 'Profil dosen berhasil dihapus.');
    }
}
