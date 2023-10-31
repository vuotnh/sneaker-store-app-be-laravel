<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;

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

// UI route
Route::get('/', [HomeController::class, 'index']);
Route::get('login', [HomeController::class, 'login'])->name("login");

Route::get('/admin/user', [HomeController::class, 'indexAdmin']);
Route::get('/admin/user/{id}/edit', [HomeController::class, 'editUserAdmin']);
Route::get('/admin/category', [HomeController::class, 'categoryAdmin']);
Route::get('/admin/category/add', [HomeController::class, 'addEditCategory']);
Route::get('/admin/category/{id}/edit', [HomeController::class, 'addEditCategory']);
Route::get('/admin/product/add', [HomeController::class, 'addEditProduct']);
Route::get('/admin/product', [HomeController::class, 'productAdmin']);


Route::middleware(['allow.cors'])->post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);



// API route
Route::group([
    'prefix' => 'auth',
    'middleware' => ['auth:web', 'verified']
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'getCurrentUser']);
    // Route::post('/change-pass', [AuthController::class, 'changePassWord']);
});
Route::group([
    'prefix' => 'user',
    'middleware' => ['auth:web', 'verified']
], function ($router) {
    Route::GET('/listUser', [UserController::class, 'show']);
    Route::GET('/detailInfo/{id}', [UserController::class, 'detail']);
    Route::PATCH('/updateInfo/{user}', [UserController::class, 'update']);
    Route::DELETE('/deleteUser/{user}', [UserController::class, 'destroy']);
});

Route::group([
    'prefix' => 'file',
], function ($router) {
    Route::post('/upload', [FileController::class, 'uploadSingleFile']);
    Route::post('/uploadMultiple', [FileController::class, 'uploadMultipleFile']);
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
Route::post('/email/verify/resend', [VerificationController::class, 'resendEmail'])->middleware(['auth:web', 'throttle:6,1'])->name('verification.send');


Route::group([
    'prefix' => 'category',
    'middleware' => ['auth:web', 'verified']
], function ($router) {
    Route::get('/list', [CategoryController::class, 'list']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::patch('/update/{category}', [CategoryController::class, 'update']);
    Route::get('/show/{category}', [CategoryController::class, 'show']);
    Route::delete('/delete/{category}', [CategoryController::class, 'destroy']);
});

Route::group([
    'prefix' => 'product',
    'middleware' => ['auth:web', 'verified']
], function ($router) {
    Route::get('/list', [ProductController::class, 'list']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::GET('/productDetail/{id}', [ProductController::class, 'show']);
    Route::delete('/delete/{product}', [ProductController::class, 'destroy']);
    Route::patch('/update/{product}', [ProductController::class, 'update']);
    // Route::get('/show/{category}', [CategoryController::class, 'show']);
});