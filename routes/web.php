<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

        Route::get('/home', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/usermanagement', [UserController::class, 'index'])->name('index');

        // Car-related routes
        Route::prefix('car')->name('car.')->group(function () {
            Route::get('/management', [CarController::class, 'index'])->name('index');
            Route::get('/createcar', [CarController::class, 'create'])->name('create');
            Route::post('/createcar', [CarController::class, 'store'])->name('store');
            Route::get('/editcar/{id}', [CarController::class, 'edit'])->name('edit');
            Route::put('/editcar/{id}', [CarController::class, 'update'])->name('update');
            Route::delete('/deletecar/{id}', [CarController::class, 'destroy'])->name('destroy');
        });

        // User-related routes
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/createuser', [UserController::class, 'create'])->name('create');
            Route::post('/createuser', [UserController::class, 'store'])->name('store');
            Route::get('/edituser/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/edituser/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/deleteuser/{id}', [UserController::class, 'destroy'])->name('destroy');
        });
  
});