<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public Routes
// Route::resource('products', ProductController::class);
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::get('/products', [ProductController::class,'index'])->name('products');
Route::get('/products/{product}', [ProductController::class,'show'])->name('products.show');
Route::get('/products/search/{name}', [ProductController::class,'search'])->name('products.search');

// Protected Routes
Route::group(['middleware'=> ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::post('/products', [ProductController::class,'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class,'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class,'destroy'])->name('products.destroy');
});

// Route::post('/products', [ProductController::class,'store'])->name('products.store');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
