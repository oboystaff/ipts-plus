<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\PaymentTempController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\Assembly\AssemblyController;
use App\Http\Controllers\API\Division\DivisionController;


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
});

Route::post('/payment/callback', [PaymentTempController::class, 'paymentCallback'])->name('payments.callback');

Route::post('/login', [LoginController::class, 'index']);
Route::post('/send/otp', [LoginController::class, 'sendOTP']);
Route::post('/change/password', [LoginController::class, 'changePassword']);

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/create', [UserController::class, 'store']);
        Route::get('/show/{id}', [UserController::class, 'show']);
        Route::post('/update/{id}', [UserController::class, 'update']);
        Route::post('/logout', [LoginController::class, 'logout']);
    });
});

Route::group(['prefix' => 'assembly', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AssemblyController::class, 'index']);
    Route::get('/show/{id}', [AssemblyController::class, 'show']);
});

Route::group(['prefix' => 'division', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [DivisionController::class, 'index']);
    Route::get('/show/{id}', [DivisionController::class, 'show']);
    Route::get('/assembly/{code}', [DivisionController::class, 'assemblyDivision']);
});
