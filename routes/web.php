<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest'],function () {
        Route::get('/login', [AdminAuthController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
        Route::get('/register', [AdminAuthController::class, 'register'])->name('admin.register');
        Route::post('/registeration', [AdminAuthController::class, 'registeration'])->name('admin.registeration');
    });
    Route::group(['middleware' => 'auth'],function () {
        Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout',[DashboardController::class, 'logout'])->name('admin.logout');
    });
});
