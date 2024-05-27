<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Administrator\AdministratorController;
use App\Http\Controllers\Direktur\DataAnak\AnakController;
use App\Http\Controllers\Direktur\DataAnak\LatarBelakangController;
use App\Http\Controllers\Direktur\DataAnak\RiwayatMedisController;
use App\Http\Controllers\Direktur\DataOrangTuaWali\OrangTuaWaliController;
use App\Http\Controllers\Direktur\Pendidikan\FormatLaporanController;
use App\Http\Controllers\Direktur\Pendidikan\KelasController;
use App\Http\Controllers\Direktur\Pendidikan\MingguPembelajaranController;
use App\Http\Controllers\Direktur\Pendidikan\SemesterTahunAjaranController;
use App\Http\Controllers\Direktur\Pendidikan\TahunAjaranController;
use App\Http\Controllers\Direktur\Pendidikan\TahunKurikulumController;
use App\Http\Controllers\Direktur\Pengumuman\PengumumanController;

Route::middleware(['auth', 'user-access:direktur'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Data Diri Direktur
    |--------------------------------------------------------------------------
    */
    Route::get('/direktur/DataDiri/edit/{user}', [AdministratorController::class, 'editDirekturDataDiri'])->name('direktur.DataDiri.edit');
    Route::put('/direktur/DataDiri/update/{user}', [AdministratorController::class, 'updateDirekturDataDiri'])->name('direktur.DataDiri.update');
    Route::get('/direktur/DataDiri/show/{user}', [AdministratorController::class, 'showDirekturDataDiri'])->name('direktur.DataDiri.show');
    Route::get('/direktur/DataDiri/password/{user}', [AdministratorController::class, 'showResetPasswordStaff'])->name('direktur.DataDiri.password');
    Route::post('/direktur/DataDiri/password/{user}', [AdministratorController::class, 'resetPasswordStaff'])->name('direktur.DataDiri.password');


    /*
    |--------------------------------------------------------------------------
    | Data Latar Belakang
    |--------------------------------------------------------------------------
    */
    Route::get('direktur/latar-belakang', [LatarBelakangController::class, 'index'])->name('direktur.latarBelakang.index');
    Route::get('direktur/latar-belakang/create', [LatarBelakangController::class, 'create'])->name('direktur.latarBelakang.create');
    Route::post('direktur/latar-belakang', [LatarBelakangController::class, 'store'])->name('direktur.latarBelakang.store');
    Route::get('direktur/latar-belakang/{id}', [LatarBelakangController::class, 'show'])->name('direktur.latarBelakang.show');
    Route::get('direktur/latar-belakang/{id}/edit', [LatarBelakangController::class, 'edit'])->name('direktur.latarBelakang.edit');
    Route::delete('direktur/latar-belakang/{id}', [LatarBelakangController::class, 'destroy'])->name('direktur.latarBelakang.destroy');
    Route::put('direktur/latar-belakang/{id}', [LatarBelakangController::class, 'update'])->name('direktur.latarBelakang.update');
    Route::get('/direktur/anak/pdf/{id}', [LatarBelakangController::class, 'generatePDF'])->name('direktur.anak.pdf');


    /*
    |--------------------------------------------------------------------------
    | Data Anak
    |--------------------------------------------------------------------------
    */
    Route::get('/direktur/anak', [AnakController::class, 'index'])->name('direktur.anak.index');
    Route::get('/direktur/anak/create', [AnakController::class, 'create'])->name('direktur.anak.create');
    Route::get('/direktur/anak/export/excel', [AnakController::class, 'exportExcel'])->name('direktur.anak.export.excel');
    Route::get('/direktur/anak/{id}', [AnakController::class, 'show'])->name('direktur.anak.show');
    Route::get('/direktur/anak/{id}/edit', [AnakController::class, 'edit'])->name('direktur.anak.edit');
    Route::delete('/direktur/anak/{id}', [AnakController::class, 'destroy'])->name('direktur.anak.destroy');
    Route::post('/direktur/anak', [AnakController::class, 'store'])->name('direktur.anak.store');
    Route::post('/direktur/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('direktur.anak.nonaktifkan');
    Route::put('/direktur/anak/{id}', [AnakController::class, 'update'])->name('direktur.anak.update');
    Route::get('direktur/anak/create', [AnakController::class, 'create'])->name('direktur.anak.create');
    Route::get('direktur/anak', [AnakController::class, 'index'])->name('direktur.anak.index');
    Route::get('direktur/anak/{id}', [AnakController::class, 'show'])->name('direktur.anak.show');
    Route::get('direktur/anak/{id}/edit', [AnakController::class, 'edit'])->name('direktur.anak.edit');


    /*
    |--------------------------------------------------------------------------
    | Data Anak - Orang Tua Wali
    |--------------------------------------------------------------------------
    */
    Route::get('direktur/orangTuaWali/create', [OrangTuaWaliController::class, 'create'])->name('direktur.orangTuaWali.create');
    Route::get('direktur/orang-tua-wali', [OrangTuaWaliController::class, 'index'])->name('direktur.orangTuaWali.index');
    Route::get('/direktur/DataOrangTuaWali/create', [OrangTuaWaliController::class, 'create'])->name('direktur.orangTuaWali.create');
    Route::post('/direktur/DataOrangTuaWali', [OrangTuaWaliController::class, 'store'])->name('direktur.orangTuaWali.store');
    Route::get('/direktur/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'show'])->name('direktur.orangTuaWali.show');
    Route::get('/direktur/DataOrangTuaWali/{id}/edit', [OrangTuaWaliController::class, 'edit'])->name('direktur.orangTuaWali.edit');
    Route::delete('/direktur/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'destroy'])->name('direktur.orangTuaWali.destroy');
    Route::put('/direktur/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'update'])->name('direktur.orangTuaWali.update');


    /*
    |--------------------------------------------------------------------------
    | Data Anak - Riwayat Medis
    |--------------------------------------------------------------------------
    */
    Route::get('/direktur/riwayatMedis/create', [RiwayatMedisController::class, 'create'])->name('direktur.riwayatMedis.create');
    Route::post('/direktur/riwayatMedis', [RiwayatMedisController::class, 'store'])->name('direktur.riwayatMedis.store');
    Route::get('/direktur/riwayatMedis/{id}', [RiwayatMedisController::class, 'show'])->name('direktur.riwayatMedis.show');
    Route::get('/direktur/riwayatMedis/{id}/edit', [RiwayatMedisController::class, 'edit'])->name('direktur.riwayatMedis.edit');
    Route::delete('/direktur/riwayatMedis/{id}', [RiwayatMedisController::class, 'destroy'])->name('direktur.riwayatMedis.destroy');
    Route::put('/direktur/riwayatMedis/{id}', [RiwayatMedisController::class, 'update'])->name('direktur.riwayatMedis.update');
    Route::get('/direktur/riwayatMedis', [RiwayatMedisController::class, 'index'])->name('direktur.riwayatMedis.index');
    Route::get('/direktur/DataOrangTuaWali', [RiwayatMedisController::class, 'index'])->name('direktur.DataOrangTuaWali.index');


    /*
    |--------------------------------------------------------------------------
    | Data Anak
    |--------------------------------------------------------------------------
    */
    Route::resource('/direktur/DataAnak/anak', AnakController::class);
    Route::patch('/direktur/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('direktur.anak.aktifkan');
    Route::patch('/direktur/anak/nonaktifkan/{id}', [AnakController::class, 'nonaktifkan'])->name('direktur.anak.nonaktifkan');
    Route::resource('/direktur/DataAnak/riwayatMedis', RiwayatMedisController::class);
    Route::get('/direktur/anak/{id}/pdf', [AnakController::class, 'generatePDF'])->name('direktur.anak.pdf');
    Route::resource('/direktur/latarBelakang', LatarBelakangController::class);
    Route::get('/direktur/latarBelakang/{id}/pdf', [LatarBelakangController::class, 'generatePDF'])->name('direktur.latarBelakang.pdf');
    Route::get('/direktur/anak/pdf/{id}', [LatarBelakangController::class, 'generatePDF'])->name('direktur.anak.pdf');
    Route::get('/direktur/anak/export/excel', [AnakController::class, 'exportExcel'])->name('direktur.anak.export.excel');


    /*
    |--------------------------------------------------------------------------
    | Pengumuman
    |--------------------------------------------------------------------------
    */
    Route::get('/direktur/pengumuman/create', [PengumumanController::class, 'create'])->name('direktur.pengumuman.create');
    Route::post('/direktur/pengumuman', [PengumumanController::class, 'store'])->name('direktur.pengumuman.store');
    Route::get('/direktur/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('direktur.pengumuman.edit');
    Route::put('/direktur/pengumuman/{id}', [PengumumanController::class, 'update'])->name('direktur.pengumuman.update');
    Route::delete('/direktur/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('direktur.pengumuman.destroy');
});
