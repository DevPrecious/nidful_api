<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Upload Image test
Route::post('upload', [UploadController::class,'upload']);

//Protected Route
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('user', [UserController::class, 'index'])->name('user.profile');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/product/store',[ProductController::class, 'store'])->name('product.store');
});

//Public Route
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
