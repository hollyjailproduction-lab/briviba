<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PakaianController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\HistoryController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('login.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user-login', function () {
    return view('auth.user-login');
})->name('user-login');;

Route::get('/user-register', function () {
    return view('auth.user-register');
})->name('user-register');

Route::post('/user-login', [LoginController::class, 'login'])->name('login');
Route::post('/user-register', [RegisterController::class, 'register'])->name('register');

/**
 * route for admin
 */


//group route with prefix "admin"
Route::prefix('admin')->group(function () {


    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {


        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard.index');

        //route resource categories
        Route::resource('/category', CategoryController::class,['as' => 'admin']);


        Route::resource('pakaian', PakaianController::class,['as' => 'admin']);
        
        Route::resource('stock', StockController::class,['as' => 'admin']);
        Route::get('stock/{id}/add-stock', [StockController::class, 'addStockForm'])->name('admin.stock.addStockForm');
        Route::post('stock/{id}/add-stock', [StockController::class, 'addStock'])->name('admin.stock.addStock');

        Route::resource('history', HistoryController::class, ['as' => 'admin']);

    });
});


require __DIR__.'/auth.php';
