<?php

use App\Http\Controllers\Admin\MasterData\KodeLaporanController;
use App\Http\Controllers\Admin\Pendidikan\FormatLaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataAnak\AnakController;
use App\Http\Controllers\Admin\MasterData\KebutuhanDisabilitasController;
use App\Http\Controllers\Admin\DataOrangTuaWali\OrangTuaWaliController;
use App\Http\Controllers\Admin\MasterData\LokasiTugasController;
use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\DonasiController;
use App\Http\Controllers\Admin\MasterData\DisabilitasController;
use App\Http\Controllers\Admin\TipeAnak\AnakDisabilitasController;
use App\Http\Controllers\Admin\MasterData\JenisKelaminController;
use App\Http\Controllers\Admin\MasterData\GolonganDarahController;
use App\Http\Controllers\Admin\MasterData\PekerjaanController;
use App\Http\Controllers\Admin\MasterData\PendidikanController;
use App\Http\Controllers\Admin\MasterData\PenyakitController;
use App\Http\Controllers\Admin\MasterData\SponsorshipController;
use App\Http\Controllers\Admin\DataAnak\RiwayatMedisController;
use App\Http\Controllers\Admin\MasterData\KategoriBeritaController;
use App\Http\Controllers\Admin\Pendidikan\MingguPembelajaranController;
use App\Http\Controllers\Admin\Pendidikan\SemesterTahunAjaranController;
use App\Http\Controllers\Admin\Pendidikan\TahunKurikulumController;
use App\Http\Controllers\Admin\TipeAnak\AnakNonDisabilitasController;
use App\Http\Controllers\Admin\Pendidikan\KelasController;
use App\Http\Controllers\Admin\Visitor\AboutController;
use App\Http\Controllers\Admin\Visitor\BeritaController;
use App\Http\Controllers\Admin\Visitor\CarouselItemController;
use App\Http\Controllers\Admin\Visitor\FasilitasController;
use App\Http\Controllers\Admin\Visitor\GaleriController;
use App\Http\Controllers\Admin\Visitor\HistoryController;
use App\Http\Controllers\Admin\Visitor\ProgramController;
use App\Http\Controllers\Admin\Pendidikan\TahunAjaranController;
use App\Http\Controllers\Admin\Administrator\AdministratorController;
use App\Http\Controllers\Admin\DataAnak\LatarBelakangController;
use App\Http\Controllers\Admin\Pengumuman\PengumumanController;



Route::middleware(['auth', 'user-access:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Data Anak
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/DataAnak/anak', AnakController::class);
    Route::patch('/admin/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('anak.aktifkan');
    Route::get('/admin/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('admin.anak.nonaktifkan');
    Route::post('/admin/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('admin.anak.nonaktifkan');
    Route::patch('/admin/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('admin.anak.nonaktifkan');
    Route::put('/admin/anak/{id}', [AnakController::class, 'update'])->name('admin.anak.update');
    Route::post('/admin/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('admin.anak.aktifkan');
    Route::get('/admin/anak/{id}/pdf', [AnakController::class, 'generatePDF'])->name('admin.anak.pdf');
    Route::get('/admin/anak', [AnakController::class, 'index'])->name('admin.anak.index');
    Route::get('/admin/anak/create', [AnakController::class, 'create'])->name('admin.anak.create');
    Route::get('/admin/anak/export/excel', [AnakController::class, 'exportExcel'])->name('admin.anak.export.excel');
    Route::get('/admin/anak/{id}', [AnakController::class, 'show'])->name('admin.anak.show');
    Route::get('/admin/anak/{id}/edit', [AnakController::class, 'edit'])->name('admin.anak.edit');
    Route::delete('/admin/anak/{id}', [AnakController::class, 'destroy'])->name('admin.anak.destroy');
    Route::post('/admin/anak', [AnakController::class, 'store'])->name('admin.anak.store');
    Route::post('/admin/anak/{id}/nonaktifkan', [AnakController::class, 'nonaktifkan'])->name('admin.anak.nonaktifkan');


    /*
    |--------------------------------------------------------------------------
    | Data Anak - Latar Belakang
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/latarBelakang/pdf/{id}', [LatarBelakangController::class, 'generatePDF'])->name('admin.latarBelakang.pdf');
    Route::resource('/admin/latarBelakang', LatarBelakangController::class);
    Route::resource('/admin/DataAnak/latar-belakang', LatarBelakangController::class);
    Route::get('/admin/latarBelakang/{id}/pdf', [LatarBelakangController::class, 'generatePDF'])->name('latarBelakang.pdf');
    Route::get('/admin/latarBelakang/create', [LatarBelakangController::class, 'create'])->name('admin.latarBelakang.create');
    Route::post('/admin/latarBelakang', [LatarBelakangController::class, 'store'])->name('admin.latarBelakang.store');
    Route::get('/admin/latarBelakang/{id}', [LatarBelakangController::class, 'show'])->name('admin.latarBelakang.show');
    Route::get('/admin/latarBelakang/{id}/edit', [LatarBelakangController::class, 'edit'])->name('admin.latarBelakang.edit');
    Route::delete('/admin/latarBelakang/{id}', [LatarBelakangController::class, 'destroy'])->name('admin.latarBelakang.destroy');
    Route::put('/admin/latarBelakang/{id}', [LatarBelakangController::class, 'update'])->name('admin.latarBelakang.update');
    Route::get('/admin/latarBelakang', [LatarBelakangController::class, 'index'])->name('admin.latarBelakang.index');


    /*
    |--------------------------------------------------------------------------
    | Data Anak - Data Orang Tua Wali
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/DataOrangTuaWali/orangTuaWali', OrangTuaWaliController::class);
    Route::get('/admin/DataOrangTuaWali/create', [OrangTuaWaliController::class, 'create'])->name('admin.orangTuaWali.create');
    Route::post('/admin/DataOrangTuaWali', [OrangTuaWaliController::class, 'store'])->name('admin.orangTuaWali.store');
    Route::get('/admin/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'show'])->name('admin.orangTuaWali.show');
    Route::get('/admin/DataOrangTuaWali/{id}/edit', [OrangTuaWaliController::class, 'edit'])->name('admin.orangTuaWali.edit');
    Route::delete('/admin/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'destroy'])->name('admin.orangTuaWali.destroy');
    Route::put('/admin/DataOrangTuaWali/{id}', [OrangTuaWaliController::class, 'update'])->name('admin.orangTuaWali.update');
    Route::get('/admin/orangTuaWali', [OrangTuaWaliController::class, 'index'])->name('admin.orangTuaWali.index');


    /*
    |--------------------------------------------------------------------------
    | Data Anak - Riwayat Medis
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/DataAnak/riwayatMedis', RiwayatMedisController::class);
    Route::get('/admin/DataAnak/riwayatMedis/create', [RiwayatMedisController::class, 'create'])->name('admin.riwayatMedis.create');
    Route::post('/admin/DataAnak/riwayatMedis', [RiwayatMedisController::class, 'store'])->name('admin.riwayatMedis.store');
    Route::get('/admin/DataAnak/riwayatMedis/{id}', [RiwayatMedisController::class, 'show'])->name('admin.riwayatMedis.show');
    Route::get('/admin/DataAnak/riwayatMedis/{id}/edit', [RiwayatMedisController::class, 'edit'])->name('admin.riwayatMedis.edit');
    Route::delete('/admin/DataAnak/riwayatMedis/{id}', [RiwayatMedisController::class, 'destroy'])->name('admin.riwayatMedis.destroy');
    Route::put('/admin/DataAnak/riwayatMedis/{id}', [RiwayatMedisController::class, 'update'])->name('admin.riwayatMedis.update');
    Route::get('/admin/riwayatMedis', [RiwayatMedisController::class, 'index'])->name('admin.riwayatMedis.index');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Agama
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/agama', AgamaController::class);
    Route::get('/admin/agama', [AgamaController::class, 'index'])->name('admin.agama.index');
    Route::get('/admin/agama/create', [AgamaController::class, 'create'])->name('admin.agama.create');
    Route::post('/admin/agama', [AgamaController::class, 'store'])->name('admin.agama.store');
    Route::get('/admin/agama/{id}', [AgamaController::class, 'show'])->name('admin.agama.show');
    Route::get('/admin/agama/{id}/edit', [AgamaController::class, 'edit'])->name('admin.agama.edit');
    Route::put('/admin/agama/{id}', [AgamaController::class, 'update'])->name('admin.agama.update');
    Route::delete('/admin/agama/{id}', [AgamaController::class, 'destroy'])->name('admin.agama.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Jenis Kelamin
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/jenisKelamin', JenisKelaminController::class);
    Route::get('/admin/jenisKelamin', [JenisKelaminController::class, 'index'])->name('admin.jenisKelamin.index');
    Route::get('/admin/jenisKelamin/create', [JenisKelaminController::class, 'create'])->name('admin.jenisKelamin.create');
    Route::post('/admin/jenisKelamin', [JenisKelaminController::class, 'store'])->name('admin.jenisKelamin.store');
    Route::get('/admin/jenisKelamin/{id}', [JenisKelaminController::class, 'show'])->name('admin.jenisKelamin.show');
    Route::get('/admin/jenisKelamin/{id}/edit', [JenisKelaminController::class, 'edit'])->name('admin.jenisKelamin.edit');
    Route::put('/admin/jenisKelamin/{id}', [JenisKelaminController::class, 'update'])->name('admin.jenisKelamin.update');
    Route::delete('/admin/jenisKelamin/{id}', [JenisKelaminController::class, 'destroy'])->name('admin.jenisKelamin.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Golongan Darah
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/golonganDarah', GolonganDarahController::class);
    Route::get('/admin/golonganDarah', [GolonganDarahController::class, 'index'])->name('admin.golonganDarah.index');
    Route::get('/admin/golonganDarah/create', [GolonganDarahController::class, 'create'])->name('admin.golonganDarah.create');
    Route::post('/admin/golonganDarah', [GolonganDarahController::class, 'store'])->name('admin.golonganDarah.store');
    Route::get('/admin/golonganDarah/{id}', [GolonganDarahController::class, 'show'])->name('admin.golonganDarah.show');
    Route::get('/admin/golonganDarah/{id}/edit', [GolonganDarahController::class, 'edit'])->name('admin.golonganDarah.edit');
    Route::put('/admin/golonganDarah/{id}', [GolonganDarahController::class, 'update'])->name('admin.golonganDarah.update');
    Route::delete('/admin/golonganDarah/{id}', [GolonganDarahController::class, 'destroy'])->name('admin.golonganDarah.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Kebutuhan Disabilitas
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/kebutuhanDisabilitas', KebutuhanDisabilitasController::class);
    Route::get('/admin/kebutuhanDisabilitas', [KebutuhanDisabilitasController::class, 'index'])->name('admin.kebutuhanDisabilitas.index');
    Route::get('/admin/kebutuhanDisabilitas/create', [KebutuhanDisabilitasController::class, 'create'])->name('admin.kebutuhanDisabilitas.create');
    Route::post('/admin/kebutuhanDisabilitas', [KebutuhanDisabilitasController::class, 'store'])->name('admin.kebutuhanDisabilitas.store');
    Route::get('/admin/kebutuhanDisabilitas/{id}', [KebutuhanDisabilitasController::class, 'show'])->name('admin.kebutuhanDisabilitas.show');
    Route::get('/admin/kebutuhanDisabilitas/{id}/edit', [KebutuhanDisabilitasController::class, 'edit'])->name('admin.kebutuhanDisabilitas.edit');
    Route::put('/admin/kebutuhanDisabilitas/{id}', [KebutuhanDisabilitasController::class, 'update'])->name('admin.kebutuhanDisabilitas.update');
    Route::delete('/admin/kebutuhanDisabilitas/{id}', [KebutuhanDisabilitasController::class, 'destroy'])->name('admin.kebutuhanDisabilitas.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Lokasi Tugas
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/lokasiTugas', LokasiTugasController::class);
    Route::get('/admin/lokasiTugas', [LokasiTugasController::class, 'index'])->name('admin.lokasiTugas.index');
    Route::get('/admin/lokasiTugas/create', [LokasiTugasController::class, 'create'])->name('admin.lokasiTugas.create');
    Route::post('/admin/lokasiTugas', [LokasiTugasController::class, 'store'])->name('admin.lokasiTugas.store');
    Route::get('/admin/lokasiTugas/{id}', [LokasiTugasController::class, 'show'])->name('admin.lokasiTugas.show');
    Route::get('/admin/lokasiTugas/{id}/edit', [LokasiTugasController::class, 'edit'])->name('admin.lokasiTugas.edit');
    Route::put('/admin/lokasiTugas/{id}', [LokasiTugasController::class, 'update'])->name('admin.lokasiTugas.update');
    Route::delete('/admin/lokasiTugas/{id}', [LokasiTugasController::class, 'destroy'])->name('admin.lokasiTugas.destroy');
    /*
    |--------------------------------------------------------------------------
    | Master Data - Pendidikan
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/pendidikan', PendidikanController::class);
    Route::get('/admin/pendidikan', [PendidikanController::class, 'index'])->name('admin.pendidikan.index');
    Route::get('/admin/pendidikan/create', [PendidikanController::class, 'create'])->name('admin.pendidikan.create');
    Route::post('/admin/pendidikan', [PendidikanController::class, 'store'])->name('admin.pendidikan.store');
    Route::get('/admin/pendidikan/{id}', [PendidikanController::class, 'show'])->name('admin.pendidikan.show');
    Route::get('/admin/pendidikan/{id}/edit', [PendidikanController::class, 'edit'])->name('admin.pendidikan.edit');
    Route::put('/admin/pendidikan/{id}', [PendidikanController::class, 'update'])->name('admin.pendidikan.update');
    Route::delete('/admin/pendidikan/{id}', [PendidikanController::class, 'destroy'])->name('admin.pendidikan.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Pekerjaan
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/pekerjaan', PekerjaanController::class);
    Route::get('/admin/pekerjaan', [PekerjaanController::class, 'index'])->name('admin.pekerjaan.index');
    Route::get('/admin/pekerjaan/create', [PekerjaanController::class, 'create'])->name('admin.pekerjaan.create');
    Route::post('/admin/pekerjaan', [PekerjaanController::class, 'store'])->name('admin.pekerjaan.store');
    Route::get('/admin/pekerjaan/{id}', [PekerjaanController::class, 'show'])->name('admin.pekerjaan.show');
    Route::get('/admin/pekerjaan/{id}/edit', [PekerjaanController::class, 'edit'])->name('admin.pekerjaan.edit');
    Route::put('/admin/pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('admin.pekerjaan.update');
    Route::delete('/admin/pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('admin.pekerjaan.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Sponsorships
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/sponsorship', SponsorshipController::class);
    Route::get('/admin/sponsorship', [SponsorshipController::class, 'index'])->name('admin.sponsorship.index');
    Route::get('/admin/sponsorship/create', [SponsorshipController::class, 'create'])->name('admin.sponsorship.create');
    Route::post('/admin/sponsorship', [SponsorshipController::class, 'store'])->name('admin.sponsorship.store');
    Route::get('/admin/sponsorship/{id}', [SponsorshipController::class, 'show'])->name('admin.sponsorship.show');
    Route::get('/admin/sponsorship/{id}/edit', [SponsorshipController::class, 'edit'])->name('admin.sponsorship.edit');
    Route::put('/admin/sponsorship/{id}', [SponsorshipController::class, 'update'])->name('admin.sponsorship.update');
    Route::delete('/admin/sponsorship/{id}', [SponsorshipController::class, 'destroy'])->name('admin.sponsorship.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Disabillitas
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/disabilitas', DisabilitasController::class);
    Route::get('/admin/disabilitas', [DisabilitasController::class, 'index'])->name('admin.disabilitas.index');
    Route::get('/admin/disabilitas/create', [DisabilitasController::class, 'create'])->name('admin.disabilitas.create');
    Route::post('/admin/disabilitas', [DisabilitasController::class, 'store'])->name('admin.disabilitas.store');
    Route::get('/admin/disabilitas/{id}', [DisabilitasController::class, 'show'])->name('admin.disabilitas.show');
    Route::get('/admin/disabilitas/{id}/edit', [DisabilitasController::class, 'edit'])->name('admin.disabilitas.edit');
    Route::put('/admin/disabilitas/{id}', [DisabilitasController::class, 'update'])->name('admin.disabilitas.update');
    Route::delete('/admin/disabilitas/{id}', [DisabilitasController::class, 'destroy'])->name('admin.disabilitas.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Donasi
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/donasi', DonasiController::class);
    Route::get('/admin/donasi', [DonasiController::class, 'index'])->name('admin.donasi.index');
    Route::get('/admin/donasi/create', [DonasiController::class, 'create'])->name('admin.donasi.create');
    Route::post('/admin/donasi', [DonasiController::class, 'store'])->name('admin.donasi.store');
    Route::get('/admin/donasi/{id}', [DonasiController::class, 'show'])->name('admin.donasi.show');
    Route::get('/admin/donasi/{id}/edit', [DonasiController::class, 'edit'])->name('admin.donasi.edit');
    Route::put('/admin/donasi/{id}', [DonasiController::class, 'update'])->name('admin.donasi.update');
    Route::delete('/admin/donasi/{id}', [DonasiController::class, 'destroy'])->name('admin.donasi.destroy');

    /*
    |--------------------------------------------------------------------------
    | Master Data - Kategori Berita
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/kategoriBerita', KategoriBeritaController::class);
    Route::get('/admin/kategoriBerita', [KategoriBeritaController::class, 'index'])->name('admin.kategoriBerita.index');
    Route::get('/admin/kategoriBerita/create', [KategoriBeritaController::class, 'create'])->name('admin.kategoriBerita.create');
    Route::post('/admin/kategoriBerita', [KategoriBeritaController::class, 'store'])->name('admin.kategoriBerita.store');
    Route::get('/admin/kategoriBerita/{id}', [KategoriBeritaController::class, 'show'])->name('admin.kategoriBerita.show');
    Route::get('/admin/kategoriBerita/{id}/edit', [KategoriBeritaController::class, 'edit'])->name('admin.kategoriBerita.edit');
    Route::put('/admin/kategoriBerita/{id}', [KategoriBeritaController::class, 'update'])->name('admin.kategoriBerita.update');
    Route::delete('/admin/kategoriBerita/{id}', [KategoriBeritaController::class, 'destroy'])->name('admin.kategoriBerita.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Penyakit
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/penyakit', PenyakitController::class);
    Route::get('/admin/penyakit', [PenyakitController::class, 'index'])->name('admin.penyakit.index');
    Route::get('/admin/penyakit/create', [PenyakitController::class, 'create'])->name('admin.penyakit.create');
    Route::post('/admin/penyakit', [PenyakitController::class, 'store'])->name('admin.penyakit.store');
    Route::get('/admin/penyakit/{id}', [PenyakitController::class, 'show'])->name('admin.penyakit.show');
    Route::get('/admin/penyakit/{id}/edit', [PenyakitController::class, 'edit'])->name('admin.penyakit.edit');
    Route::put('/admin/penyakit/{id}', [PenyakitController::class, 'update'])->name('admin.penyakit.update');
    Route::delete('/admin/penyakit/{id}', [PenyakitController::class, 'destroy'])->name('admin.penyakit.destroy');


    /*
    |--------------------------------------------------------------------------
    | Master Data - Kode Laporan
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/masterdata/kodeLaporan', KodeLaporanController::class);
    Route::get('/admin/kodeLaporan', [KodeLaporanController::class, 'index'])->name('admin.kodeLaporan.index');
    Route::get('/admin/kodeLaporan/create', [KodeLaporanController::class, 'create'])->name('admin.kodeLaporan.create');
    Route::post('/admin/kodeLaporan', [KodeLaporanController::class, 'store'])->name('admin.kodeLaporan.store');
    Route::get('/admin/kodeLaporan/{id}', [KodeLaporanController::class, 'show'])->name('admin.kodeLaporan.show');
    Route::get('/admin/kodeLaporan/{id}/edit', [KodeLaporanController::class, 'edit'])->name('admin.kodeLaporan.edit');
    Route::put('/admin/kodeLaporan/{id}', [KodeLaporanController::class, 'update'])->name('admin.kodeLaporan.update');
    Route::delete('/admin/kodeLaporan/{id}', [KodeLaporanController::class, 'destroy'])->name('admin.kodeLaporan.destroy');


    /*
    |--------------------------------------------------------------------------
    | Pendidikan - Tahun Kurikulum
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/pendidikan/tahunKurikulum', TahunKurikulumController::class);
    Route::get('/admin/tahunKurikulum', [TahunKurikulumController::class, 'index'])->name('admin.tahunKurikulum.index');
    Route::get('admin/tahun-kurikulum/create', [TahunKurikulumController::class, 'create'])->name('admin.tahunKurikulum.create');
    Route::get('admin/tahun-kurikulum/{id}/edit', [TahunKurikulumController::class, 'edit'])->name('admin.tahunKurikulum.edit');
    Route::delete('admin/tahun-kurikulum/{id}', [TahunKurikulumController::class, 'destroy'])->name('admin.tahunKurikulum.destroy');
    Route::post('admin/tahun-kurikulum', [TahunKurikulumController::class, 'store'])->name('admin.tahunKurikulum.store');
    Route::put('admin/tahun-kurikulum/{id}', [TahunKurikulumController::class, 'update'])->name('admin.tahunKurikulum.update');


    /*
    |--------------------------------------------------------------------------
    | Pendidikan - Kelas
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/pendidikan/kelas', KelasController::class);
    Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
    Route::get('admin/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::delete('admin/kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');
    Route::post('admin/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::put('admin/kelas/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');


    /*
    |--------------------------------------------------------------------------
    | Pendidikan - Tahun Ajaran
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/pendidikan/tahunAjaran', TahunAjaranController::class);
    Route::get('/admin/tahunAjaran', [TahunAjaranController::class, 'index'])->name('admin.tahunAjaran.index');
    Route::get('admin/tahun-ajaran/create', [TahunAjaranController::class, 'create'])->name('admin.tahunAjaran.create');
    Route::get('admin/tahun-ajaran/{id}/edit', [TahunAjaranController::class, 'edit'])->name('admin.tahunAjaran.edit');
    Route::delete('admin/tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('admin.tahunAjaran.destroy');
    Route::post('admin/tahun-ajaran', [TahunAjaranController::class, 'store'])->name('admin.tahunAjaran.store');
    Route::put('admin/tahun-ajaran/{id}', [TahunAjaranController::class, 'update'])->name('admin.tahunAjaran.update');


    /*
    |--------------------------------------------------------------------------
    | Pendidikan - Semester Tahun Ajaran
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/pendidikan/semesterTahunAjaran', SemesterTahunAjaranController::class);
    Route::get('/admin/semesterTahunAjaran', [SemesterTahunAjaranController::class, 'index'])->name('admin.semesterTahunAjaran.index');
    Route::get('admin/semester-tahun-ajaran/create', [SemesterTahunAjaranController::class, 'create'])->name('admin.semesterTahunAjaran.create');
    Route::get('admin/semester-tahun-ajaran/{id}/edit', [SemesterTahunAjaranController::class, 'edit'])->name('admin.semesterTahunAjaran.edit');
    Route::delete('admin/semester-tahun-ajaran/{id}', [SemesterTahunAjaranController::class, 'destroy'])->name('admin.semesterTahunAjaran.destroy');
    Route::post('admin/semester-tahun-ajaran', [SemesterTahunAjaranController::class, 'store'])->name('admin.semesterTahunAjaran.store');
    Route::put('admin/semester-tahun-ajaran/{id}', [SemesterTahunAjaranController::class, 'update'])->name('admin.semesterTahunAjaran.update');


    /*
    |--------------------------------------------------------------------------
    | Pendidikan - Format Laporan
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/pendidikan/formatLaporan', FormatLaporanController::class);
    Route::get('/admin/formatLaporan/download/{id}', [FormatLaporanController::class, 'download'])->name('formatLaporan.download');
    Route::get('/admin/formatLaporan', [FormatLaporanController::class, 'index'])->name('admin.formatLaporan.index');
    Route::get('admin/format-laporan/create', [FormatLaporanController::class, 'create'])->name('admin.formatLaporan.create');
    Route::get('admin/format-laporan/{id}/download', [FormatLaporanController::class, 'download'])->name('admin.formatLaporan.download');
    Route::get('admin/format-laporan/{id}/edit', [FormatLaporanController::class, 'edit'])->name('admin.formatLaporan.edit');
    Route::delete('admin/format-laporan/{id}', [FormatLaporanController::class, 'destroy'])->name('admin.formatLaporan.destroy');
    Route::post('admin/format-laporan', [FormatLaporanController::class, 'store'])->name('admin.formatLaporan.store');
    Route::put('admin/format-laporan/{id}', [FormatLaporanController::class, 'update'])->name('admin.formatLaporan.update');


    /*
    |--------------------------------------------------------------------------
    | Pendidikan - Minggu Pembelajaran
    |--------------------------------------------------------------------------
    */
    Route::resource('/admin/pendidikan/mingguPembelajaran', MingguPembelajaranController::class);
    Route::get('/admin/minggu-pembelajaran', [MingguPembelajaranController::class, 'index'])->name('admin.mingguPembelajaran.index');
    Route::get('admin/minggu-pembelajaran/create', [MingguPembelajaranController::class, 'create'])->name('admin.mingguPembelajaran.create');
    Route::get('admin/minggu-pembelajaran/edit/{id}', [MingguPembelajaranController::class, 'edit'])->name('admin.mingguPembelajaran.edit');
    Route::delete('admin/minggu-pembelajaran/{id}', [MingguPembelajaranController::class, 'destroy'])->name('admin.mingguPembelajaran.destroy');
    Route::post('admin/minggu-pembelajaran', [MingguPembelajaranController::class, 'store'])->name('admin.mingguPembelajaran.store');
    Route::put('admin/minggu-pembelajaran/{id}', [MingguPembelajaranController::class, 'update'])->name('admin.mingguPembelajaran.update');


    /*
    |--------------------------------------------------------------------------
    | Pengumuman
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
    Route::get('/admin/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
    Route::put('/admin/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('/admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');
    Route::post('admin/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/administrator/all', [AdministratorController::class, 'all'])->name('admin.administrator.all');
    Route::get('/admin/administrator/admin', [AdministratorController::class, 'admin'])->name('admin.administrator.admin');
    Route::get('/admin/administrator/guru', [AdministratorController::class, 'guru'])->name('admin.administrator.guru');
    Route::get('/admin/administrator/staff', [AdministratorController::class, 'staff'])->name('admin.administrator.staff');
    Route::get('/admin/administrator/direktur', [AdministratorController::class, 'direktur'])->name('admin.administrator.direktur');
    Route::get('/admin/administrator/create', [AdministratorController::class, 'create'])->name('admin.administrator.create');
    Route::get('/admin/administrator/{id}', [AdministratorController::class, 'show'])->name('admin.administrator.show');
    Route::post('/admin/administrator/store', [AdministratorController::class, 'store'])->name('admin.administrator.store');
    Route::get('/admin/administrator/{user}/edit', [AdministratorController::class, 'edit'])->name('admin.administrator.edit');
    Route::put('/admin/administrator/{user}/update', [AdministratorController::class, 'update'])->name('admin.administrator.update');
    Route::delete('/admin/administrator/{user}/destroy', [AdministratorController::class, 'destroy'])->name('admin.administrator.destroy');
    Route::get('/admin/administrator/{id}/pdf', [AdministratorController::class, 'generatePDF'])->name('user.pdf');
    Route::get('/admin/administrator/export/excel', [AdministratorController::class, 'export_excel'])->name('export.excel');
    Route::post('/admin/nonaktifkan/admin/{id}', [AdministratorController::class, 'nonaktifkanAdmin'])->name('admin.nonaktifkan.admin');
    Route::post('/admin/aktifkan/admin/{id}', [AdministratorController::class, 'aktifkanAdmin'])->name('admin.aktifkan.admin');
    Route::post('/admin/nonaktifkan/guru/{id}', [AdministratorController::class, 'nonaktifkanGuru'])->name('admin.nonaktifkan.guru');
    Route::post('/admin/aktifkan/guru/{id}', [AdministratorController::class, 'aktifkanGuru'])->name('admin.aktifkan.guru');
    Route::post('/admin/nonaktifkan/staff/{id}', [AdministratorController::class, 'nonaktifkanStaff'])->name('admin.nonaktifkan.staff');
    Route::post('/admin/aktifkan/staff/{id}', [AdministratorController::class, 'aktifkanStaff'])->name('admin.aktifkan.staff');
    Route::post('/admin/nonaktifkan/direktur/{id}', [AdministratorController::class, 'nonaktifkanDirektur'])->name('admin.nonaktifkan.direktur');
    Route::post('/admin/aktifkan/direktur/{id}', [AdministratorController::class, 'aktifkanDirektur'])->name('admin.aktifkan.direktur');


    /*
    |--------------------------------------------------------------------------
    | Raport
    |--------------------------------------------------------------------------
    */
    /* Raport Demo */
    /*     Route::resource('/raport', RaportController::class); Route::get('raport/{id}/pdf', 'App\Http\Controllers\Raport\RaportController@pdf')->name('raport.pdf'); */
    Route::delete('/galeri/delete-image/{id}', [GaleriController::class, 'deleteImage'])->name('galeri.deleteImage');
    Route::delete('/faslitas/delete-image/{id}', [FasilitasController::class, 'deleteImage'])->name('fasilitas.deleteImage');


    /*
    |--------------------------------------------------------------------------
    | Visitor - Carousel
    |--------------------------------------------------------------------------
    */
    Route::resource('carousel', CarouselItemController::class)->except(['create', 'index']);
    Route::get('/admin/carousel', [CarouselItemController::class, 'index'])->name('admin.carousel.index');
    Route::get('admin/carousel/create', [CarouselItemController::class, 'create'])->name('admin.carousel.create');
    Route::post('admin/carousel', [CarouselItemController::class, 'store'])->name('admin.carousel.store');
    Route::get('admin/carousel/{carousel}', [CarouselItemController::class, 'show'])->name('admin.carousel.show');
    Route::get('admin/carousel/{carousel}/edit', [CarouselItemController::class, 'edit'])->name('admin.carousel.edit');
    Route::put('admin/carousel/{carousel}', [CarouselItemController::class, 'update'])->name('admin.carousel.update');
    Route::delete('admin/carousel/{carousel}', [CarouselItemController::class, 'destroy'])->name('admin.carousel.destroy');


    /*
    |--------------------------------------------------------------------------
    | Visitor - History
    |--------------------------------------------------------------------------
    */
    Route::resource('history', HistoryController::class)->except(['create', 'index']);
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
    Route::get('admin/history/create', [HistoryController::class, 'create'])->name('admin.history.create');
    Route::post('admin/history', [HistoryController::class, 'store'])->name('admin.history.store');
    Route::get('admin/history/{history}', [HistoryController::class, 'show'])->name('admin.history.show');
    Route::get('admin/history/{history}/edit', [HistoryController::class, 'edit'])->name('admin.history.edit');
    Route::put('admin/history/{history}', [HistoryController::class, 'update'])->name('admin.history.update');
    Route::delete('admin/history/{history}', [HistoryController::class, 'destroy'])->name('admin.history.destroy');


    /*
    |--------------------------------------------------------------------------
    | Visitor - About
    |--------------------------------------------------------------------------
    */
    Route::resource('about', AboutController::class)->except(['create', 'index']);
    Route::get('/admin/about', [AboutController::class, 'index'])->name('admin.about.index');
    Route::get('admin/about/create', [AboutController::class, 'create'])->name('admin.about.create');
    Route::post('admin/about', [AboutController::class, 'store'])->name('admin.about.store');
    Route::get('admin/about/{about}', [AboutController::class, 'show'])->name('admin.about.show');
    Route::get('admin/about/{about}/edit', [AboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('admin/about/{about}', [AboutController::class, 'update'])->name('admin.about.update');
    Route::delete('admin/about/{about}', [AboutController::class, 'destroy'])->name('admin.about.destroy');


    /*
    |--------------------------------------------------------------------------
    | Visitor - Program
    |--------------------------------------------------------------------------
    */
    Route::resource('program', ProgramController::class)->except(['create', 'index']);
    Route::get('/admin/program', [ProgramController::class, 'index'])->name('admin.program.index');
    Route::get('admin/program/create', [ProgramController::class, 'create'])->name('admin.program.create');
    Route::post('admin/program', [ProgramController::class, 'store'])->name('admin.program.store');
    Route::get('admin/program/{program}', [ProgramController::class, 'show'])->name('admin.program.show');
    Route::get('admin/program/{program}/edit', [ProgramController::class, 'edit'])->name('admin.program.edit');
    Route::put('admin/program/{program}', [ProgramController::class, 'update'])->name('admin.program.update');
    Route::delete('admin/program/{program}', [ProgramController::class, 'destroy'])->name('admin.program.destroy');


    /*
    |--------------------------------------------------------------------------
    | Visitor - Berita
    |--------------------------------------------------------------------------
    */
    Route::resource('berita', BeritaController::class)->except(['create', 'index']);
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('admin/berita/{berita}', [BeritaController::class, 'show'])->name('admin.berita.show');
    Route::get('admin/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('admin/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('admin/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');


    /*
    |--------------------------------------------------------------------------
    | Visitor - Fasilitas
    |--------------------------------------------------------------------------
    */
    Route::resource('fasilitas', FasilitasController::class)->except(['create', 'index']);
    Route::get('/admin/fasilitas', [FasilitasController::class, 'index'])->name('admin.fasilitas.index');
    Route::get('admin/fasilitas/create', [FasilitasController::class, 'create'])->name('admin.fasilitas.create');
    Route::post('admin/fasilitas', [FasilitasController::class, 'store'])->name('admin.fasilitas.store');
    Route::get('admin/fasilitas/{fasilitas}', [FasilitasController::class, 'show'])->name('admin.fasilitas.show');
    Route::get('admin/fasilitas/{fasilitas}/edit', [FasilitasController::class, 'edit'])->name('admin.fasilitas.edit');
    Route::put('admin/fasilitas/{fasilitas}', [FasilitasController::class, 'update'])->name('admin.fasilitas.update');
    Route::delete('admin/fasilitas/{fasilitas}', [FasilitasController::class, 'destroy'])->name('admin.fasilitas.destroy');
    Route::delete('admin/fasilitas/{id}/deleteImage', [FasilitasController::class, 'deleteImage'])->name('admin.fasilitas.deleteImage');


    /*
    |--------------------------------------------------------------------------
    | Visitor - Galery
    |--------------------------------------------------------------------------
    */
    Route::resource('galeri', GaleriController::class)->except(['create', 'index']);
    Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('admin.galeri.index');
    Route::get('admin/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
    Route::post('admin/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
    Route::get('admin/galeri/{id}', [GaleriController::class, 'show'])->name('admin.galeri.show');
    Route::get('admin/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
    Route::get('admin/galeri/{galeri}', [GaleriController::class, 'update'])->name('admin.galeri.update');
    Route::delete('admin/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
    Route::delete('admin/galeri/{id}/deleteImage', [GaleriController::class, 'deleteImage'])->name('admin.galeri.deleteImage');
    Route::put('admin/galeri/{id}', [GaleriController::class, 'update'])->name('admin.galeri.update');
});
