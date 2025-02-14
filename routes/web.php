<?php

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerjasamaPendidikanController;
use App\Http\Controllers\KerjasamaPenelitianController;
use App\Http\Controllers\KerjasamaPengabdianKepadaMasyarakatController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\FormSettingController;
use App\Models\KerjasamaPenelitian;
use App\Models\KerjasamaPengabdianKepadaMasyarakat;
use App\Http\Controllers\DiagramController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckFormStatus;

Route::get('/', function () {
    return view('login.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::get('/visimisi', [VisiMisiController::class, 'show'], function() {
    return view('pages.visi_misi');
})->middleware(['auth','verified', 'user', CheckFormStatus::class . ':visi misi'])->name('pages.visi_misi');
Route::post('/visimisi', [VisiMisiController::class, 'add'])->name('pages.visi_misi.add');
Route::put('/visimisi/{id}', [VisiMisiController::class, 'update'])->name('pages.visi_misi.update');

Route::get('/kerjasamapendidikan', [KerjasamaPendidikanController::class, 'show'], function() {
    return view('pages.kerjasama_pendidikan');
})->middleware(['auth','verified','user', CheckFormStatus::class . ':kerjasama pendidikan'])->name('pages.kerjasama_pendidikan');
Route::post('/kerjasamapendidikan', [KerjasamaPendidikanController::class, 'add'])->name('pages.kerjasama_pendidikan.add');
Route::put('/kerjasamapendidikan/{id}', [KerjasamaPendidikanController::class, 'update'])->name('pages.kerjasama_pendidikan.update');

Route::get('/kerjasamapenelitian', [KerjasamaPenelitianController::class, 'show'], function() {
    return view('pages.kerjasama_penelitian');
})->middleware(['auth','verified','user'])->name('pages.kerjasama_penelitian');
Route::post('/kerjasamapenelitian', [KerjasamaPenelitianController::class, 'add'])->name('pages.kerjasama_penelitian.add');
Route::put('/kerjasamapenelitian/{id}', [KerjasamaPenelitianController::class, 'update'])->name('pages.kerjasama_penelitian.update');

Route::get('/kerjasamapengabiankepadamasyarakat', [KerjasamaPengabdianKepadaMasyarakatController::class, 'show'], function() {
    return view('pages.kerjasama_pengabdian_kepada_masyarakat');
})->middleware(['auth','verified','user'])->name('pages.kerjasama_pengabdian_kepada_masyarakat');
Route::post('/kerjasamapengabiankepadamasyarakat', [KerjasamaPengabdianKepadaMasyarakatController::class, 'add'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.add');
Route::put('/kerjasamapengabiankepadamasyarakat/{id}', [KerjasamaPengabdianKepadaMasyarakatController::class, 'update'])->name('pages.kerjasama_pengabdian_kepada_masyarakat.update');

Route::get('/diagram', [DiagramController::class, 'show'], function() {
    return view('pages.diagram_view');
})->middleware(['auth','verified','user'])->name('pages.diagram_view');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/form-off', function () {
    return view('form_off');
})->name('form.off');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/tambah-user', function () {
        return view('admin.tambah-user');
    })->middleware(['verified'])->name('admin.tambah-user');

    Route::get('/show', [HomeController::class, 'show'])->name('admin.show');

    // Route untuk edit user
    Route::get('/edit-user/{id}', [HomeController::class, 'edit'])->name('admin.edit-user');
    Route::put('/update-user/{id}', [HomeController::class, 'update'])->name('admin.update-user');

    // Route untuk delete user
    Route::delete('/delete-user/{id}', [HomeController::class, 'destroy'])->name('admin.delete-user');

    Route::get('/forms', [FormSettingController::class, 'index'])->name('admin.forms');
    Route::post('/forms/update/{id}', [FormSettingController::class, 'update'])->name('admin.forms.update');

    // Route untuk tampilan analisis
    Route::get('/visimisi', [AnalisisController::class, 'visimisi'])->name('visimisi');
    Route::get('/kerjasama-pendidikan', [AnalisisController::class, 'kerjasama_pendidikan'])->name('pendidikan');
    Route::get('/kerjasama-penelitian', [AnalisisController::class, 'kerjasama_penelitian'])->name('penelitian');
    Route::get('/kerjasama-pengabdian', [AnalisisController::class, 'kerjasama_pengabdian'])->name('pengabdian');
    
});