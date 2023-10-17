<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/admin/user', [HomeController::class, 'indexAdmin']);
Route::get('/admin/user/{id}/edit', [HomeController::class, 'editUserAdmin']);
Route::get('login', [HomeController::class, 'login'])->name("login");

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);

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
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
Route::post('/email/verify/resend', [VerificationController::class, 'resendEmail'])->middleware(['auth:web', 'throttle:6,1'])->name('verification.send');