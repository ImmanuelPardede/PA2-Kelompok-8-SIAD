<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
 
Auth::routes();
   
//Normal Users Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
   
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

    Route::post('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.create.user');

});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:staff'])->group(function () {
   
    Route::get('/staff/home', [HomeController::class, 'staffHome'])->name('staff.home');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:guru'])->group(function () {
   
    Route::get('/guru/home', [HomeController::class, 'guruHome'])->name('guru.home');
});