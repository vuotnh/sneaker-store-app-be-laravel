<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::group([
    'prefix' => 'auth',
    'middleware' => ['auth:web', 'verified']
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'getCurrentUser']);
    // Route::post('/change-pass', [AuthController::class, 'changePassWord']);
});
Route::group([
    'prefix' => 'user',
    'middleware' => ['auth:web', 'verified']
], function ($router) {
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