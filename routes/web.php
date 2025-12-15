<?php

use App\Http\Controllers\Admin\{ DashboardController, InvoiceController, LoginController, SettingsController, UnitController, UserController, UnitUserController};
use App\Http\Controllers\User\UserDashboardController;
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
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get( '/registration', [LoginController::class, 'signUp'])->name('signUp');
Route::post( '/registration', [LoginController::class, 'register'])->name('registration');

Route::name('admin.')->prefix('admin')->middleware(['auth', 'permission'])->group(function () {
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
    Route::get('/users/search', [UserController::class, 'search']);

    Route::get('/units', [UnitController::class, 'index'])->name('units');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units/store', [UnitController::class, 'store'])->name('units.store');
    Route::get('/units/edit/{id}', [UnitController::class, 'edit'])->name('units.edit');
    Route::post('/units/update/{id}', [UnitController::class, 'update'])->name('units.update');
    Route::post('/units/destroy', [UnitController::class, 'destroy'])->name('units.destroy');

    Route::get('/units/user', [UnitUserController::class, 'index'])->name('units.user');
    Route::get('/units/user/create', [UnitUserController::class, 'create'])->name('units.user.create');
    Route::post('/units/user/store', [UnitUserController::class, 'store'])->name('units.user.store');
    Route::post('/units/user/destroy', [UnitUserController::class, 'destroy'])->name('units.user.destroy');

    Route::get('/user/commission/{id}', [UserController::class, 'commission'])->name('user.commissions');
    Route::get('/user/referral-user/{id}', [UserController::class, 'referralUser'])->name('user.referralUsers');

    Route::get('/user/tree/{id}', [UserController::class, 'showTree'])->name('user.tree');

    Route::get('/user/all-commissions', [InvoiceController::class, 'index'])->name('user.allCommission');
    Route::get('/user/generate-invoice/{id}', [InvoiceController::class, 'invoice'])->name('user.generateInvoice');

    Route::get('/user/invoices', [InvoiceController::class, 'invoiceList'])->name('user.invoices');
    Route::get('/user/invoice/{id}', [InvoiceController::class, 'invoiceView'])->name('user.invoiceView');

    Route::get('/settings/company-details', [SettingsController::class, 'companyDetails'])->name('settings');
    Route::post('/settings/company-details', [SettingsController::class, 'companyDetailsUpdate'])->name('settingsUpdate');

    Route::get('/settings/permission', [SettingsController::class, 'permission'])->name('settings.permission');
    Route::get('/settings/check-permission/{id}', [SettingsController::class, 'checkPermission'])->name('settings.permission.check');
    Route::post('/settings/permission/{id}', [SettingsController::class, 'permissionUpdate'])->name('settings.permission.update');

    Route::get('/invoice/withdraw/{id}', [InvoiceController::class, 'invoiceWithdrawApprove'])->name('invoiceWithdrawApprove');
    Route::get('/invoice/withdraw-reject/{id}', [InvoiceController::class, 'invoiceWithdrawReject'])->name('invoiceWithdrawReject');
});

Route::name('user.')->prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pins', [UserDashboardController::class, 'unit'])->name('units');
    Route::get('/commission', [UserDashboardController::class, 'commission'])->name('commissions');
    Route::get('/sign-up', [UserDashboardController::class, 'signUp'])->name('signUp');
    Route::post('/sign-up', [UserDashboardController::class, 'signupSubmit'])->name('signUp.submit');
    Route::get('/logout', [UserDashboardController::class, 'logout'])->name('logout');

    Route::get('/change-password', [UserDashboardController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [UserDashboardController::class, 'changePasswordSubmit'])->name('change.password.submit');

    Route::get('/user-edit', [UserDashboardController::class, 'edit'])->name('profile.edit');
    Route::post('/user-update', [UserDashboardController::class, 'update'])->name('profile.update');

    Route::get('/invoices', [UserDashboardController::class, 'invoices'])->name('invoices');
    Route::get('/invoice/{id}', [UserDashboardController::class, 'invoiceView'])->name('invoiceView');
    Route::get('/invoice/withdraw/{id}', [UserDashboardController::class, 'invoiceWithdraw'])->name('invoiceWithdraw');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
