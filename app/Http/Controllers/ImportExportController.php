<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VisiMisi;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportExportController extends Controller
{


    public function importVisiMisiCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        if (!file_exists($path)) {
            Log::error("CSV Import: File tidak ditemukan di path: $path");
            return back()->with('error', 'File tidak valid atau tidak ditemukan.');
        }

        $userId = Auth::id();
        if (!$userId) {
            Log::error("CSV Import: User belum login.");
            return back()->with('error', 'Pengguna belum login.');
        }

        $tahunAktif = \App\Models\TahunAkademik::where('is_active', true)->first();
        if (!$tahunAktif) {
            Log::error("CSV Import: Tahun akademik aktif tidak ditemukan.");
            return back()->with('error', 'Tahun akademik aktif tidak ditemukan.');
        }

        $errors = [];
        $rowNumber = 1;

        $rows = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (count($rows) <= 1) {
            Log::warning("CSV Import: File hanya berisi header atau kosong.");
            return back()->with('error', 'File kosong atau tidak ada data.');
        }

        // Hilangkan header
        unset($rows[0]);

        foreach ($rows as $line) {
            $rowNumber++;

            // Deteksi delimiter
            $delimiter = substr_count($line, ';') >= substr_count($line, ',') ? ';' : ',';
            $data = str_getcsv($line, $delimiter);

            Log::info("CSV Import: Proses baris $rowNumber", ['raw_data' => $data]);

            if (count($data) < 4) {
                $msg = "Baris $rowNumber tidak memiliki cukup kolom.";
                Log::warning("CSV Import: $msg");
                $errors[] = $msg;
                continue;
            }

            list($id, $visi, $misi, $deskripsi) = array_pad($data, 4, null);

            if (empty($visi) || empty($misi) || empty($deskripsi)) {
                $msg = "Baris $rowNumber memiliki kolom kosong.";
                Log::warning("CSV Import: $msg");
                $errors[] = $msg;
                continue;
            }

            try {
                $record = [
                    'visi' => trim($visi),
                    'misi' => trim($misi),
                    'deskripsi' => trim($deskripsi),
                    'user_id' => $userId,
                    'tahun_akademik_id' => $tahunAktif->id,
                ];

                \App\Models\VisiMisi::create($record);
                Log::info("CSV Import: Baris $rowNumber berhasil disimpan.", $record);

            } catch (\Exception $e) {
                $msg = "Baris $rowNumber gagal disimpan: " . $e->getMessage();
                Log::error("CSV Import: $msg");
                $errors[] = $msg;
            }
        }

        if (!empty($errors)) {
            Log::info("CSV Import: Proses selesai dengan error.");
            return back()->with('warning', 'Import selesai dengan beberapa error.')->with('import_errors', $errors);
        }

        Log::info("CSV Import: Semua data berhasil diimpor.");
        return back()->with('success', 'Data berhasil diimpor dari CSV.');
    }



    public function exportVisiMisiCSV(Request $request)
    {
        $sortBy = $request->get('sort_by', 'nama_user');
        $sortOrder = $request->get('sort_order', 'asc');

        $tahunTerpilih = $request->get('tahun') ?? TahunAkademik::where('is_active', true)->value('id');

        // Ambil data sesuai tampilan web
        $records = DB::table('visi_misi')
            ->join('users', 'visi_misi.user_id', '=', 'users.id')
            ->select('visi_misi.visi', 'visi_misi.misi', 'visi_misi.deskripsi', 'users.name as nama_user')
            ->where('visi_misi.tahun_akademik_id', $tahunTerpilih)
            ->orderBy($sortBy, $sortOrder)
            ->get();

        $filename = 'visi_misi_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $columns = ['No', 'Nama User', 'Visi', 'Misi', 'Deskripsi'];

        $callback = function () use ($records, $columns) {
            $handle = fopen('php://output', 'w');
            echo chr(239) . chr(187) . chr(191); // UTF-8 BOM

            fputcsv($handle, $columns, ';', '"');

            foreach ($records as $index => $record) {
                fputcsv($handle, [
                    $index + 1,
                    $record->nama_user,
                    str_replace(["\n", "\r"], ' ', $record->visi),
                    str_replace(["\n", "\r"], ' ', $record->misi),
                    str_replace(["\n", "\r"], ' ', $record->deskripsi),
                ], ';', '"');
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}