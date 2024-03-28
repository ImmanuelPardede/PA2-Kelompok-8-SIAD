<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DataAnak\AnakController;
use App\Http\Controllers\Admin\MasterData\KebutuhanDisabilitasController;
use App\Http\Controllers\Admin\DataOrangTuaWali\OrangTuaWaliController;
use App\Http\Controllers\Admin\MasterData\LokasiTugasController;
use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\DonasiController;
use App\Http\Controllers\Admin\MasterData\DisabilitasController;
use App\Http\Controllers\Admin\MasterData\JenisKelaminController;
use App\Http\Controllers\Admin\MasterData\GolonganDarahController;
use App\Http\Controllers\Admin\MasterData\PekerjaanController;
use App\Http\Controllers\Admin\MasterData\PendidikanController;
use App\Http\Controllers\Admin\MasterData\PenyakitController;
use App\Http\Controllers\Admin\MasterData\SponsorshipController;
use App\Http\Controllers\Admin\DataAnak\RiwayatMedisController;
use App\Http\Controllers\Guru\Raport\RaportController;
use App\Http\Controllers\Staff\DataDonatur\DonaturController;
use App\Http\Controllers\Admin\Pengumuman\PengumumanController;
use App\Http\Controllers\Admin\Administrator\AdministratorController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


Route::middleware(['auth', 'user-access:admin'])->group(function () {


    Route::resource('/DataAnak/anak', AnakController::class);
    Route::patch('/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('anak.aktifkan');
    Route::patch('/anak/nonaktifkan/{id}', [AnakController::class, 'nonaktifkan'])->name('anak.nonaktifkan');
    Route::resource('/DataAnak/riwayatMedis', RiwayatMedisController::class);
    Route::resource('/DataOrangTuaWali/orangTuaWali', OrangTuaWaliController::class);
    Route::resource('/masterdata/agama', AgamaController::class);
    Route::resource('/masterdata/jenisKelamin', JenisKelaminController::class);
    Route::resource('/masterdata/golonganDarah', GolonganDarahController::class);
    Route::resource('/masterdata/kebutuhanDisabilitas', KebutuhanDisabilitasController::class);
    Route::resource('/masterdata/lokasiTugas', LokasiTugasController::class);
    Route::resource('/masterdata/pendidikan', PendidikanController::class);
    Route::resource('/masterdata/pekerjaan', PekerjaanController::class);
    Route::resource('/masterdata/sponsorship', SponsorshipController::class);
    Route::resource('/masterdata/donasi', DonasiController::class);
    Route::resource('/masterdata/disabilitas', DisabilitasController::class);
    Route::resource('/masterdata/penyakit', PenyakitController::class);



    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');


    Route::get('/administrator/admin', [AdministratorController::class, 'admin'])->name('admin.administrator.admin');
    Route::get('/administrator/guru', [AdministratorController::class, 'guru'])->name('admin.administrator.guru');
    Route::get('/administrator/staff', [AdministratorController::class, 'staff'])->name('admin.administrator.staff');
    Route::get('/administrator/create', [AdministratorController::class, 'create'])->name('admin.administrator.create');
    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('admin.administrator.show');
    Route::post('/administrator/store', [AdministratorController::class, 'store'])->name('admin.administrator.store');
    Route::get('/administrator/{user}/edit', [AdministratorController::class, 'edit'])->name('admin.administrator.edit');
    Route::put('/administrator/{user}/update', [AdministratorController::class, 'update'])->name('admin.administrator.update');
    Route::delete('/administrator/{user}/destroy', [AdministratorController::class, 'destroy'])->name('admin.administrator.destroy');


    /* Raport Demo */
/*     Route::resource('/raport', RaportController::class);
    Route::get('raport/{id}/pdf', 'App\Http\Controllers\Raport\RaportController@pdf')->name('raport.pdf');
 */

});


Route::middleware(['auth', 'user-access:guru'])->group(function () {

Route::get('/raport', [RaportController::class, 'index'])->name('raport.index');
Route::get('/raport/show/{id}', [RaportController::class, 'show'])->name('raport.show');
Route::get('/raport/create', [RaportController::class, 'create'])->name('raport.create');
Route::post('/raport/store', [RaportController::class, 'store'])->name('raport.store');
Route::get('/raport/edit/{id}', [RaportController::class, 'edit'])->name('raport.edit');
Route::put('/raport/update/{id}', [RaportController::class, 'update'])->name('raport.update');
Route::delete('/raport/destroy/{id}', [RaportController::class, 'destroy'])->name('raport.destroy');
Route::get('/raport/detail/{id}', [RaportController::class, 'detail'])->name('raport.detail');
Route::get('/raport/pdf/{id}', [RaportController::class, 'pdf'])->name('raport.pdf');

Route::get('/guru/DataDiri/edit/{user}', [AdministratorController::class, 'editGuruDataDiri'])->name('guru.DataDiri.edit');
Route::put('/guru/DataDiri/update/{user}', [AdministratorController::class, 'updateGuruDataDiri'])->name('guru.DataDiri.update');
Route::get('/guru/DataDiri/show/{user}', [AdministratorController::class, 'showGuruDataDiri'])->name('guru.DataDiri.show');
Route::get('/guru/DataDiri/password/{user}', [AdministratorController::class, 'showResetPasswordGuru'])->name('guru.DataDiri.password');
Route::post('/guru/DataDiri/password/{user}', [AdministratorController::class, 'resetPasswordGuru'])->name('guru.DataDiri.password');




});

// Staff Routes List
Route::middleware(['auth', 'user-access:staff'])->group(function () {
    Route::resource('/DataDonatur/dataDonatur', DonaturController::class);

Route::get('/staff/DataDiri/edit/{user}', [AdministratorController::class, 'editStaffDataDiri'])->name('staff.DataDiri.edit');
Route::put('/staff/DataDiri/update/{user}', [AdministratorController::class, 'updateStaffDataDiri'])->name('staff.DataDiri.update');
Route::get('/staff/DataDiri/show/{user}', [AdministratorController::class, 'showStaffDataDiri'])->name('staff.DataDiri.show');
Route::get('/staff/DataDiri/password/{user}', [AdministratorController::class, 'showResetPasswordStaff'])->name('staff.DataDiri.password');
Route::post('/staff/DataDiri/password/{user}', [AdministratorController::class, 'resetPasswordStaff'])->name('staff.DataDiri.password');

});


Route::get('pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');


