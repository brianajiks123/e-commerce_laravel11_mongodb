<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function() {
        Route::match(['get', 'post'], 'dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get', 'post'], 'update-password', [AdminController::class, 'updatePassword']);
        Route::post('check-curr-password', [AdminController::class, 'checkCurrPassword']);
        Route::get('logout', [AdminController::class, 'logout']);
    });
});
