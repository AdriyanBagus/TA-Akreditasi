<?php

namespace App\Http\Controllers;
use App\Models\TahunAkademik;
use App\Models\Komentar;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisiMisiController extends Controller
{
    public function index()
    {
        return view('pages.visi_misi');
    }

    public function show()
    {
        $tahunAktifId = TahunAkademik::where('is_active', true)->value('id');

        if (Auth::user()->id) {
            $visi_misi = VisiMisi::where('user_id', Auth::user()->id)
                ->where('tahun_akademik_id', $tahunAktifId)
                ->get();
        }

        $tabel = (new VisiMisi())->getTable(); 
        $komentar = Komentar::where('nama_tabel', $tabel)->where('prodi_id', Auth::user()->id)->get();
    
        return view('pages.visi_misi', compact('visi_misi', 'komentar'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // Ambil tahun akademik aktif
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        VisiMisi::create([
            'visi' => $request->visi,
            'misi' => $request->misi,
            'deskripsi' => $request->deskripsi,
            'user_id' => Auth::user()->id,
            'tahun_akademik_id' => $tahunAktif->id, // ✅ Tambahkan ini
        ]);

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $visi_misi = VisiMisi::find($id);
        $visi_misi->visi = $request->visi;
        $visi_misi->misi = $request->misi;
        $visi_misi->deskripsi = $request->deskripsi;
        $visi_misi->user_id = Auth::user()->id;
        $visi_misi->save();

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil diubah!');
    }
}