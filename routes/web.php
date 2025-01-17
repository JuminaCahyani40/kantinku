<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('page');
// })->name('page');

Route::resource('Buyer', BuyerController::class);
Route::resource('seller.produk', ProdukController::class)->shallow();
Route::resource('Transaksi', TransaksiController::class);
Route::resource('Seller', SellerController::class);
Route::resource('Profile', SellerController::class);
Route::resource('User', UserController::class);
Route::resource('User.setting', SettingController::class)->shallow();
Route::resource('User.profile', ProfileController::class)->shallow();

Route::get('dashboard', [DashboardController::class,'index'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/', [PageController::class,'index'])->name('page');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'PageAccess:admin,seller,buyer'])->group(function () {
    Route::get('/profile', function () {   
        return view('profile');
    })->name('profile');
});

Route::middleware(['auth', 'PageAccess:buyer'])->group(function () {
    Route::get('/pembeli', function () {   
        return view('pembeli.dashboard');
    })->name('pembeliDashboard');
});
