<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use Illuminate\Support\Facades\Route;

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

//Route::prefix('deals')->as('deals')->controller(DealController::class)->group(function() {
//    Route::get('/', 'getAll');
//    Route::get('/{id}', 'delete');
//    Route::post('/{id}', 'create');
//    Route::patch('/{id}', 'update');
//});

//Route::prefix('accounts')->as('accounts')->controller(AccountController::class)->group(function() {
//    Route::get('/', 'getAll');
//        Route::post('/{id}', 'create');
//        Route::delete('/{id}', 'delete');
//        Route::put('/{id}', 'update');
//});

Route::prefix('dashboard')->as('dashboard')->controller(DashboardController::class)->group(function () {
    Route::get('/', 'index');
});
