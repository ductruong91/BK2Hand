<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function() {
    Route::get('/', [ProductController::class, 'index'])->middleware(['user'])->name('homepage');
    Route::get('/search', [ProductController::class,'search'])->middleware(['user'])->name('product.search');
    Route::get('/products/create', [ProductController::class, 'create'])->middleware(['user'])->name('product.create');
    Route::get('/products/{id}', [ProductController::class,'show'])->middleware(['user'])->name('product.show');
    Route::get('/user/products', [ProductController::class, 'manage'])->middleware(['user'])->name('user.product');
    Route::post('/products', [ProductController::class,'store'])->name('product.store');
    Route::put('/user/products/{product}', [ProductController::class,'update'])->name('product.update');
    Route::delete('/user/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::middleware(['auth', 'admin'])->get('/admin', [AdminProductController::class, 'index'])->name('admin.index');
Route::put('/admin/products/{product}', [AdminProductController::class,'confirm'])->name('admin.product.update');
Route::delete('/admin/products/{product}', [AdminProductController::class,'destroy'])->name('admin.product.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/authenticate/confirm', [AuthController::class,'confirm'])->name('auth.confirm');

require __DIR__.'/auth.php';
