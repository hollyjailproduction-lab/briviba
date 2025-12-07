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
use App\Http\Controllers\User\ProfilePageController;
use App\Http\Controllers\User\HomepageController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CollectionController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('login.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::get('/', function () {
    return redirect()->route('user.homepage');
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

Route::get('/user/homepage', [HomepageController::class, 'index'])
    ->middleware('auth')
    ->name('user.homepage');
Route::get('/search', [HomepageController::class, 'search'])->name('user.search');

Route::post('/user/add-to-cart/{slug}', [CartPageController::class, 'addToCart'])
    ->middleware('auth')
    ->name('user.cart.add');

Route::get('/user/profilepage', [ProfilePageController::class, 'index'])
    ->middleware('auth')
    ->name('user.profilepage');

Route::get('/user/itempage/{slug}', [ItemController::class, 'show'])
    ->middleware('auth')
    ->name('user.item');

Route::get('/user/cartpage', [CartPageController::class, 'index'])
    ->middleware('auth')
    ->name('user.cartpage');

Route::delete('/user/cart/delete/{id}', [CartPageController::class, 'delete'])
    ->middleware('auth')
    ->name('user.cart.delete');

Route::patch('/user/cart/update/{id}', [CartPageController::class, 'update'])
    ->middleware('auth')
    ->name('user.cart.update');

Route::middleware('auth')->group(function() {

    Route::get('/user/profilepage', [ProfilePageController::class, 'index'])
        ->name('user.profilepage');

    Route::post('/user/profile/address', [ProfilePageController::class, 'updateAddress'])
        ->name('user.profile.address');

});

Route::get('/user/best-seller', [\App\Http\Controllers\User\CollectionController::class, 'bestSeller'])
    ->middleware('auth')
    ->name('user.bestSeller');

Route::get('/user/collection', [\App\Http\Controllers\User\CollectionController::class, 'collection'])
    ->middleware('auth')
    ->name('user.collection');

Route::post('/user/address/update', [ProfilePageController::class, 'updateAddress'])
    ->middleware('auth')
    ->name('user.address.update');

Route::get('/user/checkout', [CartPageController::class, 'checkoutPage'])
    ->middleware('auth')
    ->name('user.checkout.page');

Route::post('/user/checkout/process', [CartPageController::class, 'checkoutProcess'])
    ->middleware('auth')
    ->name('user.checkout.process');


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

        // Daftar pakaian yg bisa diedit gambarnya
        Route::get('/gambarproduk', [PakaianController::class, 'gambarIndex'])
            ->name('admin.gambarproduk.index');

        // Halaman edit gambar
        Route::get('/gambarproduk/{id}/edit', [PakaianController::class, 'gambarEdit'])
            ->name('admin.gambarproduk.edit');

        // Update gambar
        Route::put('/gambarproduk/{id}', [PakaianController::class, 'gambarUpdate'])
            ->name('admin.gambarproduk.update');

    });
});


require __DIR__.'/auth.php';
