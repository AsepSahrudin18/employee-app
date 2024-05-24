<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\ChangePasswordController;

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
Auth::routes();


Route::middleware(['auth', 'checkUserToken'])->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::resource('/employees', EmployeeController::class);
    // Rute yang memerlukan autentikasi dan memeriksa token pengguna
    Route::get('/home', [EmployeeController::class, 'index'])->name('home');

    Route::get('change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change.password');
    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password.post');
});
