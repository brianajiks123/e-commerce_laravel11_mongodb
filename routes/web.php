<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function() {
        Route::match(['get', 'post'], 'dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get', 'post'], 'update-password', [AdminController::class, 'updatePassword']);
        Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'updateAdminDetails']);
        Route::post('check-curr-password', [AdminController::class, 'checkCurrPassword']);
        Route::get('logout', [AdminController::class, 'logout']);

        // CMS Pages
        Route::get('cms-pages', [CmsController::class, "index"]);
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', [CmsController::class, 'edit']);
        Route::post('update-cms-page-status', [CmsController::class, "update"]);
        Route::get('delete-cms-page/{id}', [CmsController::class, "destroy"]);
    });
});
