<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ElectricityUsageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PLNCustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\TariffController;

Route::get('/', [HomeController::class, "index"])->name("home");

Route::get('/login', function(){
  return view('auth.login');
})->name('login');

Route::get('/register', function(){
  return view('auth.register');
})->name('register');

Route::group(["as" => 'admin.', 'prefix' => 'admin'], function(){
  Route::get('/', [DashboardController::class, "index"])->name('dashboard');
  Route::get('/reports', [ReportController::class, "index"])->name('reports');
  Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
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