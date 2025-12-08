<?php

use App\Http\Controllers\Admin\{ DashboardController, LoginController, UnitController, UserController};
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
//Route::match(['get', 'post'], '/registration', [LoginController::class, 'register'])->name('registration');
Route::get( '/registration', [LoginController::class, 'signUp'])->name('signUp');
Route::post( '/registration', [LoginController::class, 'register'])->name('registration');

Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [DashboardController::class, 'changePasswordSubmit'])->name('change.password.submit');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/units', [UnitController::class, 'index'])->name('units');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units/store', [UnitController::class, 'store'])->name('units.store');
    Route::get('/units/edit/{id}', [UnitController::class, 'edit'])->name('units.edit');
    Route::post('/units/update/{id}', [UnitController::class, 'update'])->name('units.update');
    Route::post('/units/destroy', [UnitController::class, 'destroy'])->name('units.destroy');
});
