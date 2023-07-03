<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('deals')->as('deals')->controller(DealController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::delete('/{id}', 'delete');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
    });

    Route::prefix('accounts')->as('accounts')->controller(AccountController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::post('/', 'create');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
    });

    Route::prefix('dashboard')->as('dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
