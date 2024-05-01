<?php

use App\Http\Controllers\Admin\Administrator\AdministratorController;
use App\Http\Controllers\Admin\Visitor\JadwalController;
use App\Http\Controllers\Guru\jadwalPembelajaran\JadwalPembelajaranController;
use App\Http\Controllers\KalenderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Pengumuman\PengumumanController;
use App\Http\Controllers\Admin\Todolist\TodoListController;
use App\Http\Controllers\Admin\Visitor\FasilitasController;
use App\Http\Controllers\Admin\Visitor\GaleriController;
use App\Http\Controllers\Visitor\VisitorsController;



Auth::routes();
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Pengumuman
|--------------------------------------------------------------------------
*/
Route::get('pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
Route::post('/mark-as-read', [PengumumanController::class, 'markAsRead'])->name('mark-as-read');
Route::get('admin/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
Route::post('admin/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
Route::get('admin/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
Route::put('admin/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
Route::delete('admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');


/*
|--------------------------------------------------------------------------
| To-do List
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [TodoListController::class, 'index'])->name('dashboard');
Route::post('/todo/store', [TodoListController::class, 'store'])->name('todo.store');
Route::delete('/todo/{id}', [TodoListController::class, 'destroy'])->name('todo.destroy');
Route::post('/todo/{id}/edit', [TodoListController::class, 'edit'])->name('todo.edit');


/*
|--------------------------------------------------------------------------
| Jadwal Pembelajaran
|--------------------------------------------------------------------------
*/
Route::get('/jadwalPembelajaran', [JadwalPembelajaranController::class, 'index'])->name('jadwalPembelajaran.index');
Route::post('/jadwalPembelajaran', [JadwalPembelajaranController::class, 'store'])->name('jadwalPembelajaran.store');
Route::put('/jadwalPembelajaran/update/{id}', [JadwalPembelajaranController::class, 'update'])->name('jadwalPembelajaran.update');
Route::get('/jadwalPembelajaran/{id}/edit', [JadwalPembelajaranController::class, 'edit'])->name('jadwalPembelajaran.edit');


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


/*
|--------------------------------------------------------------------------
| Visitors
|--------------------------------------------------------------------------
*/
Route::get('/', [VisitorsController::class, 'home'])->name('home');
Route::get('/aboutus', [VisitorsController::class, 'aboutUs'])->name('aboutUs');
Route::get('/programrm', [VisitorsController::class, 'programrm'])->name('programrm');
Route::get('/fasilitasi', [VisitorsController::class, 'fasilitasi'])->name('fasilitasi');
Route::get('/news', [VisitorsController::class, 'news'])->name('news');
Route::get('/news/{id}', [VisitorsController::class, 'show'])->name('news.detail');
Route::get('/gallery', [VisitorsController::class, 'gallery'])->name('gallery');
Route::get('/gallery{id}', [VisitorsController::class, 'detailgallery'])->name('gallery.detail');
Route::get('/contact', [VisitorsController::class, 'contact'])->name('contact');


Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender.index');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('visitor.jadwal');


require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/guru.php';
require __DIR__ . '/direktur.php';


Route::fallback(function () {
    return view('error.404');
});
