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
    App\Http\Controllers\Admin\UserProfileController;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/about-us', [HomeController::class, "aboutUs"])->name("about-us");
Route::get('/riwayat-transaksi', [HomeController::class, "riwayatTransaksi"])->name("riwayat-transaksi");

// Auth
Route::get('/login', [LoginController::class, "index"])->name('login');
Route::post('/login', [LoginController::class, "login"])->name('auth.login');
Route::get('/logout', [LoginController::class, "logout"])->name('logout');
Route::get('/register', [RegisterController::class, "index"])->name('register');
Route::post('/register', [RegisterController::class, "register"])->name('auth.register');

// Admin Panel
Route::group(["as" => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth']], function(){
  Route::get('/', [DashboardController::class, "index"])->name('dashboard');
  Route::get('/reports', [ReportController::class, "index"])->name('reports');

  // User Profile
  Route::get('profile', [UserProfileController::class, "index"])->name('profile.index');
  Route::get('profile/edit', [UserProfileController::class, "edit"])->name('profile.edit');
  Route::put('profile/update', [UserProfileController::class, "update"])->name('profile.update');

  // Master Data
  Route::resources([
    'payment' => PaymentController::class,
    'bill' => BillController::class,
    'level' => LevelController::class,
    'usage' => ElectricityUsageController::class,
    'tariff' => TariffController::class,
    'pln-customers' => PLNCustomerController::class,
    'users' => UserController::class,
  ]);
});