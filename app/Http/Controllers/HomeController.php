<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $dataCounts = [
            'tabel1' => DB::table('visi_misi')->count(),
            'tabel2' => DB::table('kerjasama_pendidikan')->count(),
            'tabel3' => DB::table('kerjasama_penelitian')->count(),
            'tabel4' => DB::table('kerjasama_pengabdian_kepada_masyarakat')->count(),
            // Tambahkan tabel lainnya di sini
        ];

        return view('admin.dashboard', compact('dataCounts'));
    }

    public function show()
    {
        $users = User::whereNotIn('usertype', ['admin', 'dosen'])->get();
        return view('admin.show', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('admin.show')->with('success-edit', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.show')->with('delete', 'User berhasil dihapus');
    }

}
