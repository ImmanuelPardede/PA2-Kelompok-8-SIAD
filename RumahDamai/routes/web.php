<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/logout', [AuthController::class, 'logout']);



Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/admin/home', function () {
        return view('admin.home');
    })->name('admin.home');


    
    Route::resource('admin/accounts', AccountController::class)->parameters([
        'accounts' => 'id',
    ]);
});    

// Staff Routes
Route::group(['middleware' => ['auth:staff']], function () {
    Route::get('/staff/home', function () {
        return view('staff.home');
    })->name('home');
});

// Guru Routes
Route::group(['middleware' => ['auth:guru']], function () {
    Route::get('/guru/home', function () {
        return view('guru.home');
    })->name('home');
});