<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PositionController;
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
    return view('admin.login');
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

        //Position
        Route::get('/positions',[PositionController::class, 'index'])->name('positions.index');
        Route::get('/positions/create',[PositionController::class, 'create'])->name('positions.create');
        Route::post('/positions',[PositionController::class, 'store'])->name('positions.store');
        Route::get('/positions/{position}/edit',[PositionController::class, 'edit'])->name('positions.edit');
        Route::put('/positions/{position}',[PositionController::class, 'update'])->name('positions.update');
        Route::delete('/positions/{position}',[PositionController::class, 'destroy'])->name('positions.delete');
        //Department
        Route::get('/departments',[DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/departments/create',[DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/departments',[DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/departments/{position}/edit',[DepartmentController::class, 'edit'])->name('departments.edit');
        Route::put('/departments/{position}',[DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('/departments/{position}',[DepartmentController::class, 'destroy'])->name('departments.delete');
    });
});
