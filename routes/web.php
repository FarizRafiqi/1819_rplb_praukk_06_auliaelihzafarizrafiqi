<?php

use Illuminate\Support\Facades\Route,
    App\Http\Controllers\HomeController,
    App\Http\Controllers\Auth\LoginController,
    App\Http\Controllers\Auth\RegisterController,
    App\Http\Controllers\Admin\BillController,
    App\Http\Controllers\Admin\DashboardController,
    App\Http\Controllers\Admin\ElectricityUsageController,
    App\Http\Controllers\Admin\PaymentController,
    App\Http\Controllers\Admin\PLNCustomerController,
    App\Http\Controllers\Admin\UserController,
    App\Http\Controllers\Admin\ReportController,
    App\Http\Controllers\Admin\LevelController,
    App\Http\Controllers\Admin\TariffController,
    App\Http\Controllers\Admin\UserProfileController,
    App\Http\Controllers\Admin\ActivityLogController,
    App\Http\Controllers\Admin\PermissionController;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::post('/', [HomeController::class, "checkBill"])->name("tagihan");
Route::get('/about-us', [HomeController::class, "aboutUs"])->name("about-us");
Route::get('/transaction-history', [HomeController::class, "transactionHistory"])->name("transaction-history");

// Auth
Route::get('/login', [LoginController::class, "index"])->name('login');
Route::post('/login', [LoginController::class, "login"])->name('auth.login');
Route::get('/logout', [LoginController::class, "logout"])->name('logout');
Route::get('/register', [RegisterController::class, "index"])->name('register');
Route::post('/register', [RegisterController::class, "register"])->name('auth.register');

// Admin Panel
Route::group(["as" => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
  Route::get('/', [DashboardController::class, "index"])->name('dashboard');
  Route::get('/reports', [ReportController::class, "index"])->name('reports');

  // User Profile
  Route::get('profile', [UserProfileController::class, "index"])->name('profile.index');
  Route::get('profile/edit', [UserProfileController::class, "edit"])->name('profile.edit');
  Route::put('profile/update', [UserProfileController::class, "update"])->name('profile.update');

  // Data Master
  Route::resource('activity-logs', ActivityLogController::class)->except('create', 'store', 'edit', 'update', 'destroy');
  Route::resources([
    'payments' => PaymentController::class,
    'bills' => BillController::class,
    'levels' => LevelController::class,
    'usages' => ElectricityUsageController::class,
    'tariffs' => TariffController::class,
    'pln-customers' => PLNCustomerController::class,
    'users' => UserController::class,
    'permissions' => PermissionController::class,
  ]);
});