<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\Raport\RaportController;
use App\Http\Controllers\Guru\PPI\PPIModelAController;
use App\Http\Controllers\Guru\Materi\ModulMateriController;
use App\Http\Controllers\Guru\Materi\SilabusController;
use App\Http\Controllers\Admin\Administrator\AdministratorController;
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
});
