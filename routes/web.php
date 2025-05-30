<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckFormStatus;
use App\Http\Controllers\FormGeneratorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormSettingController;

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KerjasamaPendidikanController;
use App\Http\Controllers\KerjasamaPenelitianController;
use App\Http\Controllers\KerjasamaPengabdianKepadaMasyarakatController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\BebanKinerjaDosenController;
use App\Http\Controllers\EvaluasiPelaksanaanController;
use App\Http\Controllers\ProfilDosenController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\ProfilDosenTidakTetapController;
use App\Http\Controllers\KinerjaDtpsController;
use App\Http\Controllers\PenelitianDosenController;
use App\Http\Controllers\PenelitianMahasiswaController;
use App\Http\Controllers\ProfilTenagaKependidikanController;
use App\Http\Controllers\RekognisiTenagaKependidikanController;
use App\Http\Controllers\KetersediaanDokumenController;
use App\Http\Controllers\LahanPraktekController;
use App\Http\Controllers\PelaksanaanTaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PkmDosenController;
use App\Http\Controllers\PkmMahasiswaController;
use App\Http\Controllers\PublikasiKaryaIlmiahController;
use App\Http\Controllers\PublikasiKaryaIlmiahPkmController;
use App\Http\Controllers\SitasiLuaranPenelitianDosenController;
use App\Http\Controllers\SitasiLuaranPkmDosenController;
use App\Http\Controllers\LuaranKaryaIlmiahController;
use App\Http\Controllers\LuaranKaryaIlmiahPkmController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\KomentarController;

Route::get('/', function () {
    return view('login.index');
});

Route::get('/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'verified', 'user'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/visimisi', [VisiMisiController::class, 'show'])->middleware([CheckFormStatus::class . ':visi misi'])->name('pages.visi_misi');
    Route::post('/visimisi', [VisiMisiController::class, 'add'])->name('pages.visi_misi.add');
    Route::put('/visimisi/{id}', [VisiMisiController::class, 'update'])->name('pages.visi_misi.update');
    Route::delete('/visimisi/{id}', [VisiMisiController::class, 'destroy'])->name('pages.visi_misi.destroy');

    Route::get('/kerjasama', [KerjasamaController::class, 'show'])->middleware([CheckFormStatus::class . ':kerjasama'])->name('pages.kerjasama');
    Route::post('/kerjasama', [KerjasamaController::class, 'add'])->name('pages.kerjasama.add');
    Route::put('/kerjasama/{id}', [KerjasamaController::class, 'update'])->name('pages.kerjasama.update');
    Route::delete('/kerjasama/{id}', [KerjasamaController::class, 'destroy'])->name('pages.kerjasama.destroy');

    Route::get('/kerjasamapendidikan', [KerjasamaPendidikanController::class, 'show'])->middleware([CheckFormStatus::class . ':kerjasama pendidikan'])->name('pages.kerjasama_pendidikan');
    Route::post('/kerjasamapendidikan', [KerjasamaPendidikanController::class, 'add'])->name('pages.kerjasama_pendidikan.add');
    Route::put('/kerjasamapendidikan/{id}', [KerjasamaPendidikanController::class, 'update'])->name('pages.kerjasama_pendidikan.update');
    Route::delete('/kerjasamapendidikan/{id}', [KerjasamaPendidikanController::class, 'destroy'])->name('pages.kerjasama_pendidikan.destroy');

    Route::get('/kerjasamapenelitian', [KerjasamaPenelitianController::class, 'show'])->middleware([CheckFormStatus::class . ':kerjasama penelitian'])->name('pages.kerjasama_penelitian');
    Route::post('/kerjasamapenelitian', [KerjasamaPenelitianController::class, 'add'])->name('pages.kerjasama_penelitian.add');
    Route::put('/kerjasamapenelitian/{id}', [KerjasamaPenelitianController::class, 'update'])->name('pages.kerjasama_penelitian.update');
    Route::delete('/kerjasamapenelitian/{id}', [KerjasamaPenelitianController::class, 'destroy'])->name('pages.kerjasama_penelitian.destroy');

    Route::get('/kerjasamapengabiankepadamasyarakat', [KerjasamaPengabdianKepadaMasyarakatController::class, 'show'])->middleware([CheckFormStatus::class . ':kerjasama pengabdian'])->name('pages.kerjasama_pengabdian_kepada_masyarakat');
    Route::post('/kerjasamapengabiankepadamasyarakat', [KerjasamaPengabdianKepadaMasyarakatController::class, 'add'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.add');
    Route::put('/kerjasamapengabiankepadamasyarakat/{id}', [KerjasamaPengabdianKepadaMasyarakatController::class, 'update'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.update');
    Route::delete('/kerjasamapengabiankepadamasyarakat/{id}', [KerjasamaPengabdianKepadaMasyarakatController::class, 'destroy'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.destroy');

    Route::get('/ketersediaandokumen', [KetersediaanDokumenController::class, 'show'])->middleware([CheckFormStatus::class . ':Ketersediaan Dokumen'])->name('pages.ketersediaan_dokumen');
    Route::post('/ketersediaandokumen', [KetersediaanDokumenController::class, 'add'])->name('pages.ketersediaan_dokumen.add');
    Route::put('/ketersediaandokumen/{id}', [KetersediaanDokumenController::class, 'update'])->name('pages.ketersediaan_dokumen.update');
    Route::delete('/ketersediaandokumen/{id}', [KetersediaanDokumenController::class, 'destroy'])->name('pages.ketersediaan_dokumen.destroy');
    
    Route::get('/profildosen', [ProfilDosenController::class, 'show'])->middleware([CheckFormStatus::class . ':Profil Dosen'])->name('pages.profil_dosen');
    Route::post('/profildosen', [ProfilDosenController::class, 'add'])->name('pages.profil_dosen.add');
    Route::put('/profildosen/{id}', [ProfilDosenController::class, 'update'])->name('pages.profil_dosen.update');
    Route::delete('/profildosen/{id}', [ProfilDosenController::class, 'destroy'])->name('pages.profil_dosen.destroy');

    Route::get('/evaluasipelaksanaan', [EvaluasiPelaksanaanController::class, 'show'])->middleware([CheckFormStatus::class . ':Evaluasi Pelaksanaan'])->name('pages.evaluasi_pelaksanaan');
    Route::post('/evaluasipelaksanaan', [EvaluasiPelaksanaanController::class, 'add'])->name('pages.evaluasi_pelaksanaan.add');
    Route::put('/evaluasipelaksanaan/{id}', [EvaluasiPelaksanaanController::class, 'update'])->name('pages.evaluasi_pelaksanaan.update');
    Route::delete('/evaluasipelaksanaan/{id}', [EvaluasiPelaksanaanController::class, 'destroy'])->name('pages.evaluasi_pelaksanaan.destroy');

    Route::get('/bebankinerjadosen', [BebanKinerjaDosenController::class, 'show'])->middleware([CheckFormStatus::class . ':Beban Kinerja Dosen'])->name('pages.beban_kinerja_dosen');
    Route::post('/bebankinerjadosen', [BebanKinerjaDosenController::class, 'add'])->name('pages.beban_kinerja_dosen.add');
    Route::put('/bebankinerjadosen/{id}', [BebanKinerjaDosenController::class, 'update'])->name('pages.beban_kinerja_dosen.update');
    Route::delete('/bebankinerjadosen/{id}', [BebanKinerjaDosenController::class, 'destroy'])->name('pages.beban_kinerja_dosen.destroy');

    Route::get('/profildosentidaktetap', [ProfilDosenTidakTetapController::class, 'show'])->middleware([CheckFormStatus::class . ':Profil Dosen tidak tetap'])->name('pages.profil_dosen_tidak_tetap');
    Route::post('/profildosentidaktetap', [ProfilDosenTidakTetapController::class, 'add'])->name('pages.profil_dosen_tidak_tetap.add');
    Route::put('/profildosentidaktetap/{id}', [ProfilDosenTidakTetapController::class, 'update'])->name('pages.profil_dosen_tidak_tetap.update');
    Route::delete('/profildosentidaktetap/{id}', [ProfilDosenTidakTetapController::class, 'destroy'])->name('pages.profil_dosen_tidak_tetap.destroy');

    Route::get('/pelaksanaanta', [PelaksanaanTaController::class, 'show'])->middleware([CheckFormStatus::class . ':Pelaksanaan TA'])->name('pages.pelaksanaan_ta');
    Route::post('/pelaksanaanta', [PelaksanaanTaController::class, 'add'])->name('pages.pelaksanaan_ta.add');
    Route::put('/pelaksanaanta/{id}', [PelaksanaanTaController::class, 'update'])->name('pages.pelaksanaan_ta.update');
    Route::delete('/pelaksanaanta/{id}', [PelaksanaanTaController::class, 'destroy'])->name('pages.pelaksanaan_ta.destroy');

    Route::get('/lahanpraktek', [LahanPraktekController::class, 'show'])->middleware([CheckFormStatus::class . ':Lahan praktek'])->name('pages.lahan_praktek');
    Route::post('/lahanpraktek', [LahanPraktekController::class, 'add'])->name('pages.lahan_praktek.add');
    Route::put('/lahanpraktek/{id}', [LahanPraktekController::class, 'update'])->name('pages.lahan_praktek.update');
    Route::delete('/lahanpraktek/{id}', [LahanPraktekController::class, 'destroy'])->name('pages.lahan_praktek.destroy');

    Route::get('/kinerjadtps', [KinerjaDtpsController::class, 'show'])->middleware([CheckFormStatus::class . ':Kinerja DTPS'])->name('pages.kinerja_dtps');
    Route::post('/kinerjadtps', [KinerjaDtpsController::class, 'add'])->name('pages.kinerja_dtps.add');
    Route::put('/kinerjadtps/{id}', [KinerjaDtpsController::class, 'update'])->name('pages.kinerja_dtps.update');
    Route::delete('/kinerjadtps/{id}', [KinerjaDtpsController::class, 'destroy'])->name('pages.kinerja_dtps.destroy');

    Route::get('/profiltenagakependidikan', [ProfilTenagaKependidikanController::class, 'show'])->middleware([CheckFormStatus::class . ':Profil Tenaga Kependidikan'])->name('pages.profil_tenaga_kependidikan');
    Route::post('/profiltenagakependidikan', [ProfilTenagaKependidikanController::class, 'add'])->name('pages.profil_tenaga_kependidikan.add');
    Route::put('/profiltenagakependidikan/{id}', [ProfilTenagaKependidikanController::class, 'update'])->name('pages.profil_tenaga_kependidikan.update');
    Route::delete('/profiltenagakependidikan/{id}', [ProfilTenagaKependidikanController::class, 'destroy'])->name('pages.profil_tenaga_kependidikan.destroy');

    Route::get('/rekognisitenagakependidikan', [RekognisiTenagaKependidikanController::class, 'show'])->middleware([CheckFormStatus::class . ':Rekognisi Tenaga Kependidikan'])->name('pages.rekognisi_tenaga_kependidikan');
    Route::post('/rekognisitenagakependidikan', [RekognisiTenagaKependidikanController::class, 'add'])->name('pages.rekognisi_tenaga_kependidikan.add');
    Route::put('/rekognisitenagakependidikan/{id}', [RekognisiTenagaKependidikanController::class, 'update'])->name('pages.rekognisi_tenaga_kependidikan.update');
    Route::delete('/rekognisitenagakependidikan/{id}', [RekognisiTenagaKependidikanController::class, 'destroy'])->name('pages.rekognisi_tenaga_kependidikan.destroy');

    Route::get('/penelitiandosen', [PenelitianDosenController::class, 'show'])->middleware([CheckFormStatus::class . ':Penelitian Dosen'])->name('pages.penelitian_dosen');
    Route::post('/penelitiandosen', [PenelitianDosenController::class, 'add'])->name('pages.penelitian_dosen.add');
    Route::put('/penelitiandosen/{id}', [PenelitianDosenController::class, 'update'])->name('pages.penelitian_dosen.update');
    Route::delete('/penelitiandosen/{id}', [PenelitianDosenController::class, 'destroy'])->name('pages.penelitian_dosen.destroy');

    Route::get('/penelitianmahasiswa', [PenelitianMahasiswaController::class, 'show'])->middleware([CheckFormStatus::class . ':Penelitian Mahasiswa'])->name('pages.penelitian_mahasiswa');
    Route::post('/penelitianmahasiswa', [PenelitianMahasiswaController::class, 'add'])->name('pages.penelitian_mahasiswa.add');
    Route::put('/penelitianmahasiswa/{id}', [PenelitianMahasiswaController::class, 'update'])->name('pages.penelitian_mahasiswa.update');
    Route::delete('/penelitianmahasiswa/{id}', [PenelitianMahasiswaController::class, 'destroy'])->name('pages.penelitian_mahasiswa.destroy');

    Route::get('/publikasikaryailmiah', [PublikasiKaryaIlmiahController::class, 'show'])->middleware([CheckFormStatus::class . ':Publikasi Karya Ilmiah'])->name('pages.publikasi_karya_ilmiah');
    Route::post('/publikasikaryailmiah', [PublikasiKaryaIlmiahController::class, 'add'])->name('pages.publikasi_karya_ilmiah.add');
    Route::put('/publikasikaryailmiah/{id}', [PublikasiKaryaIlmiahController::class, 'update'])->name('pages.publikasi_karya_ilmiah.update');
    Route::delete('/publikasikaryailmiah/{id}', [PublikasiKaryaIlmiahController::class, 'destroy'])->name('pages.publikasi_karya_ilmiah.destroy');

    Route::get('/luarankaryailmiah', [LuaranKaryaIlmiahController::class, 'show'])->middleware([CheckFormStatus::class . ':Luaran Karya Ilmiah'])->name('pages.luaran_karya_ilmiah');
    Route::post('/luarankaryailmiah', [LuaranKaryaIlmiahController::class, 'add'])->name('pages.luaran_karya_ilmiah.add');
    Route::put('/luarankaryailmiah/{id}', [LuaranKaryaIlmiahController::class, 'update'])->name('pages.luaran_karya_ilmiah.update');
    Route::delete('/luarankaryailmiah/{id}', [LuaranKaryaIlmiahController::class, 'destroy'])->name('pages.luaran_karya_ilmiah.destroy');

    Route::get('/sitasiluaranpenelitiandosen', [SitasiLuaranPenelitianDosenController::class, 'show'])->middleware([CheckFormStatus::class . ':Sitasi Luaran Penelitian Dosen'])->name('pages.sitasi_luaran_penelitian_dosen');
    Route::post('/sitasiluaranpenelitiandosen', [SitasiLuaranPenelitianDosenController::class, 'add'])->name('pages.sitasi_luaran_penelitian_dosen.add');
    Route::put('/sitasiluaranpenelitiandosen/{id}', [SitasiLuaranPenelitianDosenController::class, 'update'])->name('pages.sitasi_luaran_penelitian_dosen.update');
    Route::delete('/sitasiluaranpenelitiandosen/{id}', [SitasiLuaranPenelitianDosenController::class, 'destroy'])->name('pages.sitasi_luaran_penelitian_dosen.destroy');

    Route::get('/pkmmahasiswa', [PkmMahasiswaController::class, 'show'])->middleware([CheckFormStatus::class . ':PKM Mahasiswa'])->name('pages.pkm_mahasiswa');
    Route::post('/pkmmahasiswa', [PkmMahasiswaController::class, 'add'])->name('pages.pkm_mahasiswa.add');
    Route::put('/pkmmahasiswa/{id}', [PkmMahasiswaController::class, 'update'])->name('pages.pkm_mahasiswa.update');
    Route::delete('/pkmmahasiswa/{id}', [PkmMahasiswaController::class, 'destroy'])->name('pages.pkm_mahasiswa.destroy');

    Route::get('/pkmdosen', [PkmDosenController::class, 'show'])->middleware([CheckFormStatus::class . ':PKM Dosen'])->name('pages.pkm_dosen');
    Route::post('/pkmdosen', [PkmDosenController::class, 'add'])->name('pages.pkm_dosen.add');
    Route::put('/pkmdosen/{id}', [PkmDosenController::class, 'update'])->name('pages.pkm_dosen.update');
    Route::delete('/pkmdosen/{id}', [PkmDosenController::class, 'destroy'])->name('pages.pkm_dosen.destroy');

    Route::get('/publikasikaryailmiahpkm', [PublikasiKaryaIlmiahPkmController::class, 'show'])->middleware([CheckFormStatus::class . ':Publikasi Karya Ilmiah PKM'])->name('pages.publikasi_karya_ilmiah_pkm');
    Route::post('/publikasikaryailmiahpkm', [PublikasiKaryaIlmiahPkmController::class, 'add'])->name('pages.publikasi_karya_ilmiah_pkm.add');
    Route::put('/publikasikaryailmiahpkm/{id}', [PublikasiKaryaIlmiahPkmController::class, 'update'])->name('pages.publikasi_karya_ilmiah_pkm.update');
    Route::delete('/publikasikaryailmiahpkm/{id}', [PublikasiKaryaIlmiahPkmController::class, 'destroy'])->name('pages.publikasi_karya_ilmiah_pkm.destroy');

    Route::get('/luarankaryailmiahpkm', [LuaranKaryaIlmiahPkmController::class, 'show'])->middleware([CheckFormStatus::class . ':Luaran Karya Ilmiah PKM'])->name('pages.luaran_karya_ilmiah_pkm');
    Route::post('/luarankaryailmiahpkm', [LuaranKaryaIlmiahPkmController::class, 'add'])->name('pages.luaran_karya_ilmiah_pkm.add');
    Route::put('/luarankaryailmiahpkm/{id}', [LuaranKaryaIlmiahPkmController::class, 'update'])->name('pages.luaran_karya_ilmiah_pkm.update');
    Route::delete('/luarankaryailmiahpkm/{id}', [LuaranKaryaIlmiahPkmController::class, 'destroy'])->name('pages.luaran_karya_ilmiah_pkm.destroy');

    Route::get('/sitasiluaranpkmdosen', [SitasiLuaranPkmDosenController::class, 'show'])->middleware([CheckFormStatus::class . ':Sitasi Luaran PKM Dosen'])->name('pages.sitasi_luaran_pkm_dosen');
    Route::post('/sitasiluaranpkmdosen', [SitasiLuaranPkmDosenController::class, 'add'])->name('pages.sitasi_luaran_pkm_dosen.add');
    Route::put('/sitasiluaranpkmdosen/{id}', [SitasiLuaranPkmDosenController::class, 'update'])->name('pages.sitasi_luaran_pkm_dosen.update');
    Route::delete('/sitasiluaranpkmdosen/{id}', [SitasiLuaranPkmDosenController::class, 'destroy'])->name('pages.sitasi_luaran_pkm_dosen.destroy');

});

// Route::get('/diagram', [DiagramController::class, 'show'], function () {
//     return view('pages.diagram_view'})->middleware(['auth', 'verified', 'user'])->name('pages.diagram_view');

Route::get('/form-off', function () {
    return view('form_off');
})->name('form.off');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/tambah-user', function () {return view('admin.tambah-user');
    })->middleware(['verified'])->name('admin.tambah-user');

    Route::get('/show', [HomeController::class, 'show'])->name('admin.show');

    // Route untuk edit user
    Route::get('/edit-user/{id}', [HomeController::class, 'edit'])->name('admin.edit-user');
    Route::put('/update-user/{id}', [HomeController::class, 'update'])->name('admin.update-user');

    // Route untuk delete user
    Route::delete('/delete-user/{id}', [HomeController::class, 'destroy'])->name('admin.delete-user');

    // Route untuk mengatur on/off form
    // Route::get('/forms', [FormSettingController::class, 'index'])->name('admin.forms');
    // Route::post('/forms/update/{id}', [FormSettingController::class, 'update'])->name('admin.forms.update');

    Route::get('/form-settings', [FormSettingController::class, 'index'])->name('form.settings');
    Route::post('/form-settings/{id}', [FormSettingController::class, 'update'])->name('form.settings.update');

    //Route untuk komentar
    Route::post('/komentar', [KomentarController::class, 'store'])->name('admin.komentar');
    Route::delete('/admin/komentar/{id}', [KomentarController::class, 'destroy'])->name('admin.komentar.destroy');


    // Route untuk tampilan analisis
    Route::get('/visimisi', [AnalisisController::class, 'visimisi'])->name('visimisi');
    Route::get('/kerjasamaAdmin', [AnalisisController::class, 'kerjasama'])->name('kerjasama_admin');
    Route::get('/kerjasama-pendidikan', [AnalisisController::class, 'kerjasama_pendidikan'])->name('pendidikan');
    Route::get('/kerjasama-penelitian', [AnalisisController::class, 'kerjasama_penelitian'])->name('penelitian');
    Route::get('/kerjasama-pengabdian', [AnalisisController::class, 'kerjasama_pengabdian'])->name('pengabdian');
    Route::get('/ketersediaan-dokumen', [AnalisisController::class, 'ketersedian_dokumen'])->name('ketersediaan_dokumen');
    Route::get('/evaluasi-pelaksanaan', [AnalisisController::class, 'evaluasi_pelaksanaan'])->name('evaluasi_pelaksanaan');
    Route::get('/profil_dosen', [AnalisisController::class, 'profil_dosen'])->name('profil_dosen');
    Route::get('/beban_kinerja_dosen', [AnalisisController::class, 'beban_kinerja_dosen'])->name('beban_kinerja_dosen');
    Route::get('/dosen-tidak-tetap', [AnalisisController::class, 'profile_dosen_tidak_tetap'])->name('profile_dosen_tidak_tetap');
    Route::get('/pelaksana-ta', [AnalisisController::class, 'pelaksana_ta'])->name('pelaksana_ta');
    Route::get('/lahan-praktek', [AnalisisController::class, 'lahan_praktek'])->name('lahan_praktek');
    Route::get('/kinerja-dtps', [AnalisisController::class, 'kinerjaDTPS'])->name('kinerjaDTPS');
    Route::get('/tenaga-kependidikan', [AnalisisController::class, 'tenaga_kependidikan'])->name('tenaga_kependidikan');
    Route::get('/rekognisi-tenaga-kependidikan', [AnalisisController::class, 'rekognisi_tenaga_kependidikan'])->name('rekognisi_tenaga_kependidikan');
    Route::get('/penelitian-dosen', [AnalisisController::class, 'penelitian_dosen'])->name('penelitian_dosen');
    Route::get('/penelitian-mahasiswa', [AnalisisController::class, 'penelitian_mahasiswa'])->name('penelitian_mahasiswa');
    Route::get('/publikasi-karya-ilmiah', [AnalisisController::class, 'publikasi_karya_ilmiah'])->name('publikasi_karya_ilmiah');
    Route::get('/luaran-karyailmiah', [AnalisisController::class, 'luaran_karya_ilmiah'])->name('luaran_karya_ilmiah');
    Route::get('/sitasi-luaranpd', [AnalisisController::class, 'sitasi_luaran_pd'])->name('sitasi_luaran_pd');
    Route::get('/pkm-dosen', [AnalisisController::class, 'pkm_dosen'])->name('pkm_dosen');
    Route::get('/pkm-mahasiswa', [AnalisisController::class, 'pkm_mahasiswa'])->name('pkm_mahasiswa');
    Route::get('/publikasi-ki-pkm', [AnalisisController::class, 'publikasi_ki_pkm'])->name('publikasi_ki_pkm');
    Route::get('/luaran-ki-pkm', [AnalisisController::class, 'luaran_ki_pkm'])->name('luaran_ki_pkm');
    Route::get('/luaran-pkm-dosen', [AnalisisController::class, 'sitasi_luaran_pkm_dosen'])->name('luaran_pkm_dosen');


    // Route form generator
    Route::get('/form-generator', [FormGeneratorController::class, 'index'])->name('generator');
    Route::post('/form-generator/generate', [FormGeneratorController::class, 'generate'])->name('form-generator.generate');

    // Include dynamically generated routes
    if (file_exists(base_path('routes/generated.php'))) {
        require base_path('routes/generated.php');
    }
});