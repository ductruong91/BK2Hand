<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('user');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/products', [ProductController::class,'apiManage']);
    // Route::put('user/products/{product}', [ProductController::class,'edit']);
    // Route::delete('user/products/{product}', [ProductController::class,'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/admin/products', [AdminProductController::class,'update']);
    Route::delete('/admin/products/{product}', [AdminProductController::class,'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::post('/authenticate', [AuthController::class,'authenticate'])->name('authenticate');
});

Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');
