<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DataAnak\AnakController;
use App\Http\Controllers\Admin\DataOrangTuaWali\OrangTuaWaliController;
use App\Http\Controllers\MasterData\LokasiTugasController;
use App\Http\Controllers\MasterData\AgamaController;
use App\Http\Controllers\MasterData\DonasiController;
use App\Http\Controllers\MasterData\JenisKelaminController;
use App\Http\Controllers\MasterData\GolonganDarahController;
use App\Http\Controllers\MasterData\KebutuhanController;
use App\Http\Controllers\MasterData\PekerjaanController;
use App\Http\Controllers\MasterData\PendidikanController;
use App\Http\Controllers\MasterData\PenyakitController;
use App\Http\Controllers\MasterData\SponsorshipController;
use App\Http\Controllers\Admin\DataAnak\RiwayatMedisController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Normal Users Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/index', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('/DataAnak/anak', AnakController::class);
    Route::resource('/DataAnak/riwayatMedis', RiwayatMedisController::class);
    Route::resource('/DataOrangTuaWali/orangTuaWali', OrangTuaWaliController::class);
    Route::resource('/masterdata/agama', AgamaController::class);
    Route::resource('/masterdata/jenisKelamin', JenisKelaminController::class);
    Route::resource('/masterdata/golonganDarah', GolonganDarahController::class);
    Route::resource('/masterdata/kebutuhan', KebutuhanController::class);
    Route::resource('/masterdata/lokasiTugas', LokasiTugasController::class);
    Route::resource('/masterdata/pendidikan', PendidikanController::class);
    Route::resource('/masterdata/pekerjaan', PekerjaanController::class);
    Route::resource('/masterdata/sponsorship', SponsorshipController::class);
    Route::resource('/masterdata/donasi', DonasiController::class);
    Route::resource('/masterdata/penyakit', PenyakitController::class);
});

// Admin Routes List
Route::middleware(['auth', 'user-access:guru'])->group(function () {
    Route::get('/guru/home', [HomeController::class, 'guruHome'])->name('guru.home');
});

// Staff Routes List
Route::middleware(['auth', 'user-access:staff'])->group(function () {
    Route::get('/staff/home', [HomeController::class, 'staffHome'])->name('staff.home');
});
