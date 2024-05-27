<?php

use App\Http\Controllers\Guru\PPI\ModelB\PPIBController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\Raport\RaportController;
use App\Http\Controllers\Guru\PPI\PPIModelAController;
use App\Http\Controllers\Guru\Materi\ModulMateriController;
use App\Http\Controllers\Guru\Materi\SilabusController;
use App\Http\Controllers\Admin\Administrator\AdministratorController;
use App\Http\Controllers\Guru\DataAnak\AnakController;
use App\Http\Controllers\Guru\PPI\ModelA\PPIAController;

Route::middleware(['auth', 'user-access:guru'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Raport
    |--------------------------------------------------------------------------
    */
    Route::get('/raport', [RaportController::class, 'index'])->name('raport.index');
    Route::get('/raport/show/{id}', [RaportController::class, 'show'])->name('raport.show');
    Route::get('/raport/create/{anak_id}', [RaportController::class, 'create'])->name('raport.create');
    Route::post('/raport/store', [RaportController::class, 'store'])->name('raport.store');
    Route::get('/raport/edit/{id}', [RaportController::class, 'edit'])->name('raport.edit');
    Route::put('/raport/{id}', [RaportController::class, 'update'])->name('raport.update');
    Route::delete('/raport/destroy/{id}', [RaportController::class, 'destroy'])->name('raport.destroy');
    Route::get('/raport/detail/{id}', [RaportController::class, 'detail'])->name('raport.detail');
    Route::get('/raport/pdf/{id}', [RaportController::class, 'pdf'])->name('raport.pdf');


    /*
    |--------------------------------------------------------------------------
    | PPI MODEL A
    |--------------------------------------------------------------------------
    */
    Route::get('/ppiA', [PPIAController::class, 'index'])->name('ppiA.index');
    Route::get('/ppiA/show/{id}', [PPIAController::class, 'show'])->name('ppiA.show');
    Route::get('/ppiA/create/{anak_id}', [PPIAController::class, 'create'])->name('ppiA.create');
    Route::post('/ppiA/store', [PPIAController::class, 'store'])->name('ppiA.store');
    Route::get('/ppiA/edit/{id}', [PPIAController::class, 'edit'])->name('ppiA.edit');
    Route::put('/ppiA/{id}', [PPIAController::class, 'update'])->name('ppiA.update');
    Route::delete('/ppiA/destroy/{id}', [PPIAController::class, 'destroy'])->name('ppiA.destroy');
    Route::get('/ppiA/detail/{id}', [PPIAController::class, 'detail'])->name('ppiA.detail');
    Route::get('/ppiA/pdf/{id}', [PPIAController::class, 'pdf'])->name('ppiA.pdf');


    /*
    |--------------------------------------------------------------------------
    | PPI MODEL B
    |--------------------------------------------------------------------------
    */
    Route::get('/ppiB', [PPIBController::class, 'index'])->name('ppiB.index');
    Route::get('/ppiB/show/{id}', [PPIBController::class, 'show'])->name('ppiB.show');
    Route::get('/ppiB/create', [PPIBController::class, 'create'])->name('ppiB.create');
    Route::post('/ppiB/store', [PPIBController::class, 'store'])->name('ppiB.store');
    Route::get('/ppiB/edit/{id}', [PPIBController::class, 'edit'])->name('ppiB.edit');
    Route::put('/ppiB/{id}', [PPIBController::class, 'update'])->name('ppiB.update');
    Route::delete('/ppiB/destroy/{id}', [PPIBController::class, 'destroy'])->name('ppiB.destroy');
    Route::get('/ppiB/detail/{id}', [PPIBController::class, 'detail'])->name('ppiB.detail');
    Route::get('/ppiB/downloadPpiB/{id}', [PPIBController::class, 'downloadPpiB'])->name('ppiB.downloadPpiB');
    Route::get('/get-format-laporan', [PPIBController::class, 'getFormatLaporan'])->name('get-format-laporan');
    Route::get('/download-format-laporan/{id}', [PPIBController::class, 'downloadFormatLaporan'])->name('downloadFormatLaporan');



    /*
    |--------------------------------------------------------------------------
    | Modul Materi
    |--------------------------------------------------------------------------
    */
    Route::resource('/materi/modulMateri', ModulMateriController::class);
    Route::get('/materi/download/{id}', [ModulMateriController::class, 'download'])->name('modulMateri.download');
    Route::resource('/materi/silabus', SilabusController::class);
    Route::post('/modul-materi/{modulMateri}/tambah-jadwal', [ModulMateriController::class, 'tambahJadwalPembelajaran'])->name('modulMateri.tambahJadwal');



    /*
    |--------------------------------------------------------------------------
    | Data Diri Guru
    |--------------------------------------------------------------------------
    */
    Route::get('/guru/DataDiri/edit/{user}', [AdministratorController::class, 'editGuruDataDiri'])->name('guru.DataDiri.edit');
    Route::put('/guru/DataDiri/update/{user}', [AdministratorController::class, 'updateGuruDataDiri'])->name('guru.DataDiri.update');
    Route::get('/guru/DataDiri/show/{user}', [AdministratorController::class, 'showGuruDataDiri'])->name('guru.DataDiri.show');
    Route::get('/guru/DataDiri/password/{user}', [AdministratorController::class, 'showResetPasswordGuru'])->name('guru.DataDiri.password');
    Route::post('/guru/DataDiri/password/{user}', [AdministratorController::class, 'resetPasswordGuru'])->name('guru.DataDiri.password');


    /*
    |--------------------------------------------------------------------------
    | Data Anak
    |--------------------------------------------------------------------------
    */
    Route::get('/guru/anak', [AnakController::class, 'index'])->name('guru.anak.index');
    Route::get('/guru/anak/create', [AnakController::class, 'create'])->name('guru.anak.create');
    Route::get('/guru/anak/export/excel', [AnakController::class, 'exportExcel'])->name('guru.anak.export.excel');
    Route::get('/guru/anak/{id}', [AnakController::class, 'show'])->name('guru.anak.show');
    Route::get('/guru/anak/{id}/edit', [AnakController::class, 'edit'])->name('guru.anak.edit');
    Route::delete('/guru/anak/{id}', [AnakController::class, 'destroy'])->name('guru.anak.destroy');
    Route::post('/guru/anak', [AnakController::class, 'store'])->name('guru.anak.store');
    Route::post('/guru/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('guru.anak.nonaktifkan');
    Route::put('/guru/anak/{id}', [AnakController::class, 'update'])->name('guru.anak.update');
    Route::get('guru/anak/create', [AnakController::class, 'create'])->name('guru.anak.create');
    Route::get('guru/anak', [AnakController::class, 'index'])->name('guru.anak.index');
    Route::get('guru/anak/{id}', [AnakController::class, 'show'])->name('guru.anak.show');
    Route::get('guru/anak/{id}/edit', [AnakController::class, 'edit'])->name('guru.anak.edit');
    Route::resource('/guru/DataAnak/anak', AnakController::class);
    Route::patch('/guru/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('guru.anak.aktifkan');
    Route::patch('/guru/anak/nonaktifkan/{id}', [AnakController::class, 'nonaktifkan'])->name('guru.anak.nonaktifkan');
    Route::get('/guru/anak/{id}/pdf', [AnakController::class, 'generatePDF'])->name('guru.anak.pdf');
    Route::get('/guru/anak/export/excel', [AnakController::class, 'exportExcel'])->name('guru.anak.export.excel');
});
