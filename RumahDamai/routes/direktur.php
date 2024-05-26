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
use App\Http\Controllers\Direktur\TipeAnak\AnakDisabilitasController;
use App\Http\Controllers\Direktur\TipeAnak\AnakNonDisabilitasController;

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



    Route::get('direktur/anak/create', [AnakController::class, 'create'])->name('direktur.anak.create');
    Route::get('direktur/anak', [AnakController::class, 'index'])->name('direktur.anak.index');
    Route::get('direktur/anak/{id}', [AnakController::class, 'show'])->name('direktur.anak.show');
    Route::get('direktur/anak/{id}/edit', [AnakController::class, 'edit'])->name('direktur.anak.edit');


    Route::get('direktur/latar-belakang', [LatarBelakangController::class, 'index'])->name('direktur.latarBelakang.index');
    Route::get('direktur/latar-belakang/create', [LatarBelakangController::class, 'create'])->name('direktur.latarBelakang.create');
    Route::post('direktur/latar-belakang', [LatarBelakangController::class, 'store'])->name('direktur.latarBelakang.store');
    Route::get('direktur/latar-belakang/{id}', [LatarBelakangController::class, 'show'])->name('direktur.latarBelakang.show');
    Route::get('direktur/latar-belakang/{id}/edit', [LatarBelakangController::class, 'edit'])->name('direktur.latarBelakang.edit');
    Route::delete('direktur/latar-belakang/{id}', [LatarBelakangController::class, 'destroy'])->name('direktur.latarBelakang.destroy');
    Route::put('direktur/latar-belakang/{id}', [LatarBelakangController::class, 'update'])->name('direktur.latarBelakang.update');


    Route::get('/direktur/anak/pdf/{id}', [LatarBelakangController::class, 'generatePDF'])->name('direktur.anak.pdf');

    Route::get('/direktur/anak', [AnakController::class, 'index'])->name('direktur.anak.index');
    Route::get('/direktur/anak/create', [AnakController::class, 'create'])->name('direktur.anak.create');
    Route::get('/direktur/anak/export/excel', [AnakController::class, 'exportExcel'])->name('direktur.anak.export.excel');
    Route::get('/direktur/anak/{id}', [AnakController::class, 'show'])->name('direktur.anak.show');
    Route::get('/direktur/anak/{id}/edit', [AnakController::class, 'edit'])->name('direktur.anak.edit');
    Route::delete('/direktur/anak/{id}', [AnakController::class, 'destroy'])->name('direktur.anak.destroy');
    Route::post('/direktur/anak', [AnakController::class, 'store'])->name('direktur.anak.store');
    Route::post('/direktur/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('direktur.anak.nonaktifkan');


    Route::get('direktur/orangTuaWali/create', [OrangTuaWaliController::class, 'create'])->name('direktur.orangTuaWali.create');
    Route::get('direktur/orang-tua-wali', [OrangTuaWaliController::class, 'index'])->name('direktur.orangTuaWali.index');
    Route::get('direktur/anak-disabilitas', [AnakDisabilitasController::class, 'index'])->name('direktur.anakDisabilitas.index');
    Route::get('direktur/anak-non-disabilitas', [AnakNonDisabilitasController::class, 'index'])->name('direktur.anakNonDisabilitas.index');


    Route::get('/direktur/kelas', [KelasController::class, 'index'])->name('direktur.kelas.index');
    Route::get('direktur/kelas/create', [KelasController::class, 'create'])->name('direktur.kelas.create');
    Route::get('direktur/kelas/{id}/edit', [KelasController::class, 'edit'])->name('direktur.kelas.edit');
    Route::delete('direktur/kelas/{id}', [KelasController::class, 'destroy'])->name('direktur.kelas.destroy');
    Route::post('direktur/kelas', [KelasController::class, 'store'])->name('direktur.kelas.store');
    Route::put('direktur/kelas/{id}', [KelasController::class, 'update'])->name('direktur.kelas.update');


    Route::get('/direktur/tahunKurikulum', [TahunKurikulumController::class, 'index'])->name('direktur.tahunKurikulum.index');
    Route::get('direktur/tahun-kurikulum/create', [TahunKurikulumController::class, 'create'])->name('direktur.tahunKurikulum.create');
    Route::get('direktur/tahun-kurikulum/{id}/edit', [TahunKurikulumController::class, 'edit'])->name('direktur.tahunKurikulum.edit');
    Route::delete('direktur/tahun-kurikulum/{id}', [TahunKurikulumController::class, 'destroy'])->name('direktur.tahunKurikulum.destroy');
    Route::post('direktur/tahun-kurikulum', [TahunKurikulumController::class, 'store'])->name('direktur.tahunKurikulum.store');
    Route::put('direktur/tahun-kurikulum/{id}', [TahunKurikulumController::class, 'update'])->name('direktur.tahunKurikulum.update');


    Route::get('/direktur/tahunAjaran', [TahunAjaranController::class, 'index'])->name('direktur.tahunAjaran.index');
    Route::get('direktur/tahun-ajaran/create', [TahunAjaranController::class, 'create'])->name('direktur.tahunAjaran.create');
    Route::get('direktur/tahun-ajaran/{id}/edit', [TahunAjaranController::class, 'edit'])->name('direktur.tahunAjaran.edit');
    Route::delete('direktur/tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('direktur.tahunAjaran.destroy');
    Route::post('direktur/tahun-ajaran', [TahunAjaranController::class, 'store'])->name('direktur.tahunAjaran.store');
    Route::put('direktur/tahun-ajaran/{id}', [TahunAjaranController::class, 'update'])->name('direktur.tahunAjaran.update');


    Route::get('/direktur/semesterTahunAjaran', [SemesterTahunAjaranController::class, 'index'])->name('direktur.semesterTahunAjaran.index');
    Route::get('direktur/semester-tahun-ajaran/create', [SemesterTahunAjaranController::class, 'create'])->name('direktur.semesterTahunAjaran.create');
    Route::get('direktur/semester-tahun-ajaran/{id}/edit', [SemesterTahunAjaranController::class, 'edit'])->name('direktur.semesterTahunAjaran.edit');
    Route::delete('direktur/semester-tahun-ajaran/{id}', [SemesterTahunAjaranController::class, 'destroy'])->name('direktur.semesterTahunAjaran.destroy');
    Route::post('direktur/semester-tahun-ajaran', [SemesterTahunAjaranController::class, 'store'])->name('direktur.semesterTahunAjaran.store');
    Route::put('direktur/semester-tahun-ajaran/{id}', [SemesterTahunAjaranController::class, 'update'])->name('direktur.semesterTahunAjaran.update');


    Route::get('/direktur/mingguPembelajaran', [MingguPembelajaranController::class, 'index'])->name('direktur.mingguPembelajaran.index');
    Route::get('direktur/minggu-pembelajaran/create', [MingguPembelajaranController::class, 'create'])->name('direktur.mingguPembelajaran.create');
    Route::get('direktur/minggu-pembelajaran/{id}/edit', [MingguPembelajaranController::class, 'edit'])->name('direktur.mingguPembelajaran.edit');
    Route::delete('direktur/minggu-pembelajaran/{id}', [MingguPembelajaranController::class, 'destroy'])->name('direktur.mingguPembelajaran.destroy');
    Route::post('direktur/minggu-pembelajaran', [MingguPembelajaranController::class, 'store'])->name('direktur.mingguPembelajaran.store');


    Route::get('/direktur/formatLaporan', [FormatLaporanController::class, 'index'])->name('direktur.formatLaporan.index');
    Route::get('direktur/format-laporan/create', [FormatLaporanController::class, 'create'])->name('direktur.formatLaporan.create');
    Route::get('direktur/format-laporan/{id}/download', [FormatLaporanController::class, 'download'])->name('direktur.formatLaporan.download');
    Route::get('direktur/format-laporan/{id}/edit', [FormatLaporanController::class, 'edit'])->name('direktur.formatLaporan.edit');
    Route::delete('direktur/format-laporan/{id}', [FormatLaporanController::class, 'destroy'])->name('direktur.formatLaporan.destroy');
    Route::post('direktur/format-laporan', [FormatLaporanController::class, 'store'])->name('direktur.formatLaporan.store');



    Route::get('/direktur/DataOrangTuaWali', [RiwayatMedisController::class, 'index'])->name('direktur.DataOrangTuaWali.index');
    Route::get('/direktur/DataOrangTuaWali/create', [OrangTuaWaliController::class, 'create'])->name('direktur.orangTuaWali.create');
    Route::post('/direktur/DataOrangTuaWali', [OrangTuaWaliController::class, 'store'])->name('direktur.orangTuaWali.store');
    Route::get('/direktur/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'show'])->name('direktur.orangTuaWali.show');
    Route::get('/direktur/DataOrangTuaWali/{id}/edit', [OrangTuaWaliController::class, 'edit'])->name('direktur.orangTuaWali.edit');
    Route::delete('/direktur/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'destroy'])->name('direktur.orangTuaWali.destroy');
    Route::put('/direktur/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'update'])->name('direktur.orangTuaWali.update');



    Route::get('/direktur/riwayatMedis/create', [RiwayatMedisController::class, 'create'])->name('direktur.riwayatMedis.create');
    Route::post('/direktur/riwayatMedis', [RiwayatMedisController::class, 'store'])->name('direktur.riwayatMedis.store');
    Route::get('/direktur/riwayatMedis/{id}', [RiwayatMedisController::class, 'show'])->name('direktur.riwayatMedis.show');
    Route::get('/direktur/riwayatMedis/{id}/edit', [RiwayatMedisController::class, 'edit'])->name('direktur.riwayatMedis.edit');
    Route::delete('/direktur/riwayatMedis/{id}', [RiwayatMedisController::class, 'destroy'])->name('direktur.riwayatMedis.destroy');
    Route::put('/direktur/riwayatMedis/{id}', [RiwayatMedisController::class, 'update'])->name('direktur.riwayatMedis.update');
    Route::get('/direktur/riwayatMedis', [RiwayatMedisController::class, 'index'])->name('direktur.riwayatMedis.index');


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
    | Disabilitas dan Non-Disabilitas
    |--------------------------------------------------------------------------
    */
    Route::resource('/direktur/TipeAnak/anakDisabilitas', AnakDisabilitasController::class);
    Route::resource('/direktur/TipeAnak/anakNonDisabilitas', AnakNonDisabilitasController::class);


    /*
    |--------------------------------------------------------------------------
    | Pendidikan
    |--------------------------------------------------------------------------
    */
    Route::resource('/direktur/pendidikan/tahunKurikulum', TahunKurikulumController::class);
    Route::resource('/direktur/pendidikan/kelas', KelasController::class);
    Route::resource('/direktur/pendidikan/tahunAjaran', TahunAjaranController::class);
    Route::resource('/direktur/pendidikan/semesterTahunAjaran', SemesterTahunAjaranController::class);
    Route::resource('/direktur/pendidikan/mingguPembelajaran', MingguPembelajaranController::class);
    Route::resource('/direktur/pendidikan/formatLaporan', FormatLaporanController::class);
    Route::get('/direktur/formatLaporan/download/{id}', [FormatLaporanController::class, 'download'])->name('direktur.formatLaporan.download');


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


    /*
    |--------------------------------------------------------------------------
    | Status Admin
    |--------------------------------------------------------------------------
    */
    Route::post('/direktur/nonaktifkan/admin/{id}', [AdministratorController::class, 'nonaktifkanAdmin'])->name('direktur.nonaktifkan.admin');
    Route::post('/direktur/aktifkan/admin/{id}', [AdministratorController::class, 'aktifkanAdmin'])->name('direktur.aktifkan.admin');


    /*
    |--------------------------------------------------------------------------
    | Status Guru
    |--------------------------------------------------------------------------
    */
    Route::post('/direktur/nonaktifkan/guru/{id}', [AdministratorController::class, 'nonaktifkanGuru'])->name('direktur.nonaktifkan.guru');
    Route::post('/direktur/aktifkan/guru/{id}', [AdministratorController::class, 'aktifkanGuru'])->name('direktur.aktifkan.guru');


    /*
    |--------------------------------------------------------------------------
    | Status Staff
    |--------------------------------------------------------------------------
    */
    Route::post('/direktur/nonaktifkan/staff/{id}', [AdministratorController::class, 'nonaktifkanStaff'])->name('direktur.nonaktifkan.staff');
    Route::post('/direktur/aktifkan/staff/{id}', [AdministratorController::class, 'aktifkanStaff'])->name('direktur.aktifkan.staff');


    /*
    |--------------------------------------------------------------------------
    | Status Direktur
    |--------------------------------------------------------------------------
    */
    Route::post('/direktur/nonaktifkan/direktur/{id}', [AdministratorController::class, 'nonaktifkanDirektur'])->name('direktur.nonaktifkan.direktur');
    Route::post('/direktur/aktifkan/direktur/{id}', [AdministratorController::class, 'aktifkanDirektur'])->name('direktur.aktifkan.direktur');
});
