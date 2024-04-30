<?php

use App\Http\Controllers\Admin\Visitor\JadwalController;
use App\Http\Controllers\Guru\jadwalPembelajaran\JadwalPembelajaranController;
use App\Http\Controllers\KalenderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Pengumuman\PengumumanController;
use App\Http\Controllers\Admin\Todolist\TodoListController;
use App\Http\Controllers\Visitor\VisitorsController;



Auth::routes();
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
});


/*
|--------------------------------------------------------------------------
| Pengumuman
|--------------------------------------------------------------------------
*/
Route::get('pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
Route::post('/mark-as-read', [PengumumanController::class, 'markAsRead'])->name('mark-as-read');


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


/*
|--------------------------------------------------------------------------
| Jadwal dan Kalender
|--------------------------------------------------------------------------
*/
Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender.index');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('visitor.jadwal');


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



require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/guru.php';
require __DIR__ . '/direktur.php';
