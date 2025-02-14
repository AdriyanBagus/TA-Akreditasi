<?php

namespace App\Http\Controllers;
use App\Models\KerjasamaPendidikan;
use App\Models\VisiMisi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisisController extends Controller
{
    public function visimisi(Request $request)
    {
        $sortBy = $request->get('sort_by', 'nama_user'); // Default: Sort by nama_user
        $sortOrder = $request->get('sort_order', 'asc'); // Default: Ascending

        $visimisi = DB::table('visi_misi')
            ->join('users', 'visi_misi.user_id', '=', 'users.id')
            ->select('visi_misi.*', 'users.name as nama_user')
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return view('admin.analisis.visimisi', compact('visimisi', 'sortBy', 'sortOrder'));
    }
    public function kerjasama_pendidikan(Request $request)
    {
        $sortBy = $request->get('sort_by', 'nama_user'); // Default: Sort by nama_user
        $sortOrder = $request->get('sort_order', 'asc'); // Default: Ascending

        $pendidikan = DB::table('kerjasama_pendidikan')
            ->join('users', 'kerjasama_pendidikan.user_id', '=', 'users.id')
            ->select('kerjasama_pendidikan.*', 'users.name as nama_user')
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return view('admin.analisis.kerjasama.pendidikan', compact('pendidikan', 'sortBy', 'sortOrder'));
    }

    public function kerjasama_penelitian(Request $request)
    {
        $sortBy = $request->get('sort_by', 'nama_user'); // Default: Sort by nama_user
        $sortOrder = $request->get('sort_order', 'asc'); // Default: Ascending

        $penelitian = DB::table('kerjasama_penelitian')
        ->join('users', 'kerjasama_penelitian.user_id', '=', 'users.id')
        ->select('kerjasama_penelitian.*', 'users.name as nama_user')
        ->orderBy($sortBy, $sortOrder)
        ->get();

        return view('admin.analisis.kerjasama.penelitian', compact('penelitian','sortBy', 'sortOrder'));
    }

    public function kerjasama_pengabdian(Request $request)
    {
        $sortBy = $request->get('sort_by', 'nama_user'); // Default: Sort by nama_user
        $sortOrder = $request->get('sort_order', 'asc'); // Default: Ascending

        $pengabdian = DB::table('kerjasama_pengabdian_kepada_masyarakat')
        ->join('users', 'kerjasama_pengabdian_kepada_masyarakat.user_id', '=', 'users.id')
        ->select('kerjasama_pengabdian_kepada_masyarakat.*', 'users.name as nama_user')
        ->orderBy($sortBy, $sortOrder)
        ->get();

        return view('admin.analisis.kerjasama.pengabdian',compact('pengabdian','sortBy', 'sortOrder'));
    }
}
