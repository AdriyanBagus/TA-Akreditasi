<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPengabdianKepadaMasyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjasamaPengabdianKepadaMasyarakatController extends Controller
{
    public function index()
    {
        return view('pages.kerjasama_pengabdian_kepada_masyarakat');
    }

    public function show()
    {
        if (Auth::user()->id) {
            $kerjasama_pengabdian_kepada_masyarakat = KerjasamaPengabdianKepadaMasyarakat::where('user_id', Auth::user()->id)->get();
        }
        return view('pages.kerjasama_pengabdian_kepada_masyarakat', compact('kerjasama_pengabdian_kepada_masyarakat'));
    }

    public function add(Request $request)
    {

        KerjasamaPengabdianKepadaMasyarakat::create([
            'user_id' => Auth::user()->id,
            'lembaga_mitra' => $request->lembaga_mitra,
            'tingkat' => $request->tingkat,
            'judul_kegiatan' => $request->judul_kegiatan,
            'waktu_durasi' => $request->waktu_durasi,
            'realisasi_kerjasama' => $request->realisasi_kerjasama,
            'spk' => $request->spk
        ]);

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {

        $kerjasama_pengabdian_kepada_masyarakat = KerjasamaPengabdianKepadaMasyarakat::find($id);
        $kerjasama_pengabdian_kepada_masyarakat->lembaga_mitra = $request->lembaga_mitra;
        $kerjasama_pengabdian_kepada_masyarakat->tingkat = $request->tingkat;
        $kerjasama_pengabdian_kepada_masyarakat->judul_kegiatan = $request->judul_kegiatan;
        $kerjasama_pengabdian_kepada_masyarakat->waktu_durasi = $request->waktu_durasi;
        $kerjasama_pengabdian_kepada_masyarakat->realisasi_kerjasama = $request->realisasi_kerjasama;
        $kerjasama_pengabdian_kepada_masyarakat->spk = $request->spk;
        $kerjasama_pengabdian_kepada_masyarakat->user_id = Auth::user()->id;
        $kerjasama_pengabdian_kepada_masyarakat->save();

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil diubah!');
    }
}