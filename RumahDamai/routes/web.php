<?php

use App\Http\Controllers\Admin\MasterData\KategoriBeritaController;
use App\Http\Controllers\Admin\Pendidikan\MingguPembelajaranController;
use App\Http\Controllers\Admin\Pendidikan\SemesterTahunAjaranController;
use App\Http\Controllers\Admin\Pendidikan\TahunKurikulumController;
use App\Http\Controllers\Admin\TipeAnak\AnakNonDisabilitasController;
use App\Http\Controllers\Admin\Pendidikan\KelasController;
use App\Http\Controllers\Guru\jadwalPembelajaran\JadwalPembelajaranController;
use App\Http\Controllers\Guru\Materi\ModulMateriController;
use App\Http\Controllers\Guru\Materi\SilabusController;
use App\Http\Controllers\KalenderController;
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
use App\Http\Controllers\Admin\TipeAnak\AnakDisabilitasController;
use App\Http\Controllers\Admin\MasterData\JenisKelaminController;
use App\Http\Controllers\Admin\MasterData\GolonganDarahController;
use App\Http\Controllers\Admin\MasterData\PekerjaanController;
use App\Http\Controllers\Admin\MasterData\PendidikanController;
use App\Http\Controllers\Admin\MasterData\PenyakitController;
use App\Http\Controllers\Admin\MasterData\SponsorshipController;
use App\Http\Controllers\Admin\DataAnak\RiwayatMedisController;
use App\Http\Controllers\Guru\Raport\RaportController;
use App\Http\Controllers\Guru\PPI\PPIModelAController;
use App\Http\Controllers\Staff\DataDonatur\DonaturController;
use App\Http\Controllers\Admin\Pengumuman\PengumumanController;
use App\Http\Controllers\Admin\Administrator\AdministratorController;
use App\Http\Controllers\Admin\Pendidikan\TahunAjaranController;
use App\Http\Controllers\Admin\Todolist\TodoListController;
use App\Http\Controllers\Admin\Visitor\AboutController;
use App\Http\Controllers\Admin\Visitor\BeritaController;
use App\Http\Controllers\Admin\Visitor\CarouselItemController;
use App\Http\Controllers\Admin\Visitor\FasilitasController;
use App\Http\Controllers\Admin\Visitor\GaleriController;
use App\Http\Controllers\Admin\Visitor\HistoryController;
use App\Http\Controllers\Admin\Visitor\ProgramController;
use App\Http\Controllers\Visitor\VisitorsController;
use App\Models\KategoriBerita;

Auth::routes();
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


Route::middleware(['auth', 'user-access:admin'])->group(function () {


    Route::resource('/DataAnak/anak', AnakController::class);
    Route::patch('/anak/{id}/aktifkan', [AnakController::class, 'aktifkan'])->name('anak.aktifkan');
    Route::patch('/anak/nonaktifkan/{id}', [AnakController::class, 'nonaktifkan'])->name('anak.nonaktifkan');

    Route::resource('/DataOrangTuaWali/orangTuaWali', OrangTuaWaliController::class);
    Route::resource('/DataAnak/riwayatMedis', RiwayatMedisController::class);

    Route::resource('/masterdata/agama', AgamaController::class);
    Route::resource('/masterdata/jenisKelamin', JenisKelaminController::class);
    Route::resource('/masterdata/golonganDarah', GolonganDarahController::class);
    Route::resource('/masterdata/kebutuhanDisabilitas', KebutuhanDisabilitasController::class);
    Route::resource('/masterdata/lokasiTugas', LokasiTugasController::class);
    Route::resource('/masterdata/pendidikan', PendidikanController::class);
    Route::resource('/masterdata/pekerjaan', PekerjaanController::class);
    Route::resource('/masterdata/sponsorship', SponsorshipController::class);
    Route::resource('/masterdata/disabilitas', DisabilitasController::class);
    Route::resource('/masterdata/donasi', DonasiController::class);
    Route::resource('/masterdata/penyakit', PenyakitController::class);

    Route::resource('/TipeAnak/anakNonDisabilitas', AnakNonDisabilitasController::class);
    Route::resource('/TipeAnak/anakDisabilitas', AnakDisabilitasController::class);

    Route::resource('/masterdata/penyakit', PenyakitController::class);
    Route::resource('/masterdata/kategoriBerita', KategoriBeritaController::class);



    Route::resource('/TipeAnak/anakDisabilitas', AnakDisabilitasController::class);
    Route::resource('/TipeAnak/anakNonDisabilitas', AnakNonDisabilitasController::class);
    Route::resource('/pendidikan/tahunKurikulum', TahunKurikulumController::class);
    Route::resource('/pendidikan/kelas', KelasController::class);
    Route::resource('/pendidikan/tahunAjaran', TahunAjaranController::class);
    Route::resource('/pendidikan/semesterTahunAjaran', SemesterTahunAjaranController::class);
    Route::resource('/pendidikan/mingguPembelajaran', MingguPembelajaranController::class);


    Route::get('/administrator/admin', [AdministratorController::class, 'admin'])->name('admin.administrator.admin');
    Route::get('/administrator/guru', [AdministratorController::class, 'guru'])->name('admin.administrator.guru');
    Route::get('/administrator/staff', [AdministratorController::class, 'staff'])->name('admin.administrator.staff');
    Route::get('/administrator/direktur', [AdministratorController::class, 'direktur'])->name('admin.administrator.direktur');
    Route::get('/administrator/create', [AdministratorController::class, 'create'])->name('admin.administrator.create');
    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('admin.administrator.show');
    Route::post('/administrator/store', [AdministratorController::class, 'store'])->name('admin.administrator.store');
    Route::get('/administrator/{user}/edit', [AdministratorController::class, 'edit'])->name('admin.administrator.edit');
    Route::put('/administrator/{user}/update', [AdministratorController::class, 'update'])->name('admin.administrator.update');
    Route::delete('/administrator/{user}/destroy', [AdministratorController::class, 'destroy'])->name('admin.administrator.destroy');
    Route::get('/administrator/{id}/pdf', [AdministratorController::class, 'generatePDF'])->name('user.pdf');
/*     Route::get('/administrator/{id}/pdf', [AdministratorController::class, 'exportUserProfilePdf'])->name('user.pdf');
 */

    // Admin
    Route::post('/admin/nonaktifkan/admin/{id}', [AdministratorController::class, 'nonaktifkanAdmin'])->name('admin.nonaktifkan.admin');
    Route::post('/admin/aktifkan/admin/{id}', [AdministratorController::class, 'aktifkanAdmin'])->name('admin.aktifkan.admin');

    // Guru
    Route::post('/admin/nonaktifkan/guru/{id}', [AdministratorController::class, 'nonaktifkanGuru'])->name('admin.nonaktifkan.guru');
    Route::post('/admin/aktifkan/guru/{id}', [AdministratorController::class, 'aktifkanGuru'])->name('admin.aktifkan.guru');

    // Pegawai/Staff
    Route::post('/admin/nonaktifkan/staff/{id}', [AdministratorController::class, 'nonaktifkanStaff'])->name('admin.nonaktifkan.staff');
    Route::post('/admin/aktifkan/staff/{id}', [AdministratorController::class, 'aktifkanStaff'])->name('admin.aktifkan.staff');

    /* Raport Demo */
    /*     Route::resource('/raport', RaportController::class);
    Route::get('raport/{id}/pdf', 'App\Http\Controllers\Raport\RaportController@pdf')->name('raport.pdf');
 */
Route::delete('/galeri/delete-image/{id}', [GaleriController::class,'deleteImage'])->name('galeri.deleteImage');
Route::delete('/faslitas/delete-image/{id}', [FasilitasController::class,'deleteImage'])->name('fasilitas.deleteImage');




 /* Visitor */
    Route::resource('carousel', CarouselItemController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('about', AboutController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('galeri', GaleriController::class);
    





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
    Route::resource('/materi/modulMateri', ModulMateriController::class);
    Route::get('/materi/download/{id}', [ModulMateriController::class, 'download'])->name('modulMateri.download');
    Route::resource('/materi/silabus', SilabusController::class);
    Route::post('/modul-materi/{modulMateri}/tambah-jadwal', [ModulMateriController::class, 'tambahJadwalPembelajaran'])->name('modulMateri.tambahJadwal');



    Route::get('/ppiA', [PPIModelAController::class, 'index'])->name('PPI.ModelA.index');
    Route::get('/ppiA/show/{id}', [PPIModelAController::class, 'show'])->name('PPI.ModelA.show');
    Route::get('/ppiA/create', [PPIModelAController::class, 'create'])->name('PPI.ModelA.create');
    Route::post('/ppiA/store', [PPIModelAController::class, 'store'])->name('PPI.ModelA.store');
    Route::get('/ppiA/detail/{id}', [PPIModelAController::class, 'detail'])->name('PPI.ModelA.detail');




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




Route::middleware(['auth', 'user-access:direktur'])->group(function () {

    Route::get('/direktur/DataDiri/edit/{user}', [AdministratorController::class, 'editDirekturDataDiri'])->name('direktur.DataDiri.edit');
    Route::put('/direktur/DataDiri/update/{user}', [AdministratorController::class, 'updateDirekturDataDiri'])->name('direktur.DataDiri.update');
    Route::get('/direktur/DataDiri/show/{user}', [AdministratorController::class, 'showDirekturDataDiri'])->name('direktur.DataDiri.show');
    Route::get('/direktur/DataDiri/password/{user}', [AdministratorController::class, 'showResetPasswordStaff'])->name('direktur.DataDiri.password');
    Route::post('/direktur/DataDiri/password/{user}', [AdministratorController::class, 'resetPasswordStaff'])->name('direktur.DataDiri.password');

});


/* Bisa diakses bersamaan  */
    Route::get('pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::post('/mark-as-read', [PengumumanController::class, 'markAsRead'])->name('mark-as-read');

    Route::get('/dashboard', [TodoListController::class, 'index'])->name('dashboard');
    Route::post('/todo/store', [TodoListController::class, 'store'])->name('todo.store');
    Route::delete('/todo/{id}', [TodoListController::class, 'destroy'])->name('todo.destroy');
    Route::post('/todo/{id}/edit', [TodoListController::class, 'edit'])->name('todo.edit');

    Route::get('/jadwalPembelajaran', [JadwalPembelajaranController::class, 'index'])->name('jadwalPembelajaran.index');
    Route::post('/jadwalPembelajaran', [JadwalPembelajaranController::class, 'store'])->name('jadwalPembelajaran.store');
    Route::put('/jadwalPembelajaran/update/{id}', [JadwalPembelajaranController::class, 'update'])->name('jadwalPembelajaran.update');
    Route::get('/jadwalPembelajaran/{id}/edit', [JadwalPembelajaranController::class, 'edit'])->name('jadwalPembelajaran.edit');

    Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender.index');














//visitors

Route::get('/', [VisitorsController::class, 'home'])->name('home');
Route::get('/aboutus', [VisitorsController::class, 'aboutUs'])->name('aboutUs');
Route::get('/programrm', [VisitorsController::class, 'programrm'])->name('programrm');

Route::get('/fasilitasi', [VisitorsController::class, 'fasilitasi'])->name('fasilitasi');
Route::get('/news', [VisitorsController::class, 'news'])->name('news');
Route::get('/news/{id}', [VisitorsController::class, 'show'])->name('news.detail');
Route::get('/gallery', [VisitorsController::class, 'gallery'])->name('gallery');
Route::get('/gallery{id}', [VisitorsController::class, 'detailgallery'])->name('gallery.detail');

Route::get('/contact', [VisitorsController::class, 'contact'])->name('contact');





Route::fallback(function () {
    return view('error.404');
});





    Route::get('admin/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
    Route::post('admin/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::get('admin/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
    Route::put('admin/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');




