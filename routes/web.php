<?php

use App\Http\Controllers\UploadController;
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
    App\Http\Controllers\Admin\PermissionController,
    App\Http\Controllers\Admin\TransactionController,
    App\Http\Controllers\Admin\PaymentMethodController,
    App\Http\Controllers\Admin\PermissionLevelController;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/about-us', [HomeController::class, "aboutUs"])->name("about-us");

//Upload File
Route::post('/', [TransactionController::class, "checkBill"])->name("check-bill");
Route::post('upload', [UploadController::class, "store"])->name('upload.store');
Route::delete('upload', [UploadController::class, "destroy"])->name('upload.destroy');

//Transaksi
Route::group(['middleware' => ['auth']], function(){
  Route::get('/transaction-history', [TransactionController::class, "transactionHistory"])->name("transaction-history");
  Route::get('/transaction-history/details/{payment?}', [TransactionController::class, "transactionHistory"])->name("transaction-history.details");

  Route::group(['prefix' => 'payments', 'as' => 'payment.'], function(){
    Route::get('/{payment_method:slug}/confirm/{payment}', [TransactionController::class, "confirm"])->name('confirm');
    Route::post('/{payment_method:slug}/confirm/{payment}', [TransactionController::class, "process"])->name('process');
    Route::get('/{payment}', [TransactionController::class, "index"])->name('index');
    
    Route::post('create', [TransactionController::class, "create"])->name('create');

    // Midtrans Transaction Notification 
    Route::post('callback', [MidtransController::class, 'notificationHandler'])->name('callback');
    Route::get('finish', [MidtransController::class, 'finish'])->name('finish');
    Route::get('unfinish', [MidtransController::class, 'unfinish'])->name('unfinish');
    Route::get('error', [MidtransController::class, 'error'])->name('error');
  });
});

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
  Route::post('/reports/payment', [ReportController::class, "printPaymentReports"])->name('reports.payment');

  // User Profile
  Route::get('profile', [UserProfileController::class, "index"])->name('profile.index');
  Route::get('profile/edit', [UserProfileController::class, "edit"])->name('profile.edit');
  Route::put('profile/update', [UserProfileController::class, "update"])->name('profile.update');

  // Dashboard setting
  Route::get('settings', [DashboardController::class, "settings"])->name('settings');
  // Data Master
  Route::resource('activity-logs', ActivityLogController::class)->except('create', 'store', 'edit', 'update', 'destroy');
  Route::resource('payment-methods', PaymentMethodController::class)->except('show');
  Route::resource('level-permissions', PermissionLevelController::class)->except('show');
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