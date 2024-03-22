<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DataAnak\AnakController;
use App\Http\Controllers\Admin\DataOrangTuaWali\OrangTuaWaliController;
use App\Http\Controllers\Admin\MasterData\LokasiTugasController;
use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\DonasiController;
use App\Http\Controllers\Admin\MasterData\JenisKelaminController;
use App\Http\Controllers\Admin\MasterData\GolonganDarahController;
use App\Http\Controllers\Admin\MasterData\KebutuhanController;
use App\Http\Controllers\Admin\MasterData\PekerjaanController;
use App\Http\Controllers\Admin\MasterData\PendidikanController;
use App\Http\Controllers\Admin\MasterData\PenyakitController;
use App\Http\Controllers\Admin\MasterData\SponsorshipController;
use App\Http\Controllers\Admin\DataAnak\RiwayatMedisController;
use App\Http\Controllers\Raport\RaportController;
use App\Http\Controllers\Admin\DataDonatur\DonaturController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Normal Users Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/index', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('/DataAnak/anak', AnakController::class);
    Route::patch('/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('anak.aktifkan');
    Route::patch('/anak/nonaktifkan/{id}', [AnakController::class, 'nonaktifkan'])->name('anak.nonaktifkan');
    Route::resource('/DataAnak/riwayatMedis', RiwayatMedisController::class);
    Route::resource('/DataOrangTuaWali/orangTuaWali', OrangTuaWaliController::class);
    Route::resource('/DataDonatur/dataDonatur', DonaturController::class);
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
    Route::resource('/raport', RaportController::class);
    Route::get('raport/{id}/pdf', 'App\Http\Controllers\Raport\RaportController@pdf')->name('raport.pdf');


});

// Admin Routes List
Route::middleware(['auth', 'user-access:guru'])->group(function () {
    Route::get('/guru/home', [HomeController::class, 'guruHome'])->name('guru.home');
});

// Staff Routes List
Route::middleware(['auth', 'user-access:staff'])->group(function () {
    Route::get('/staff/home', [HomeController::class, 'staffHome'])->name('staff.home');
});
