<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Exploitation\FostController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    //Admin Routes Group
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::resource('permissions', PermissionController::class)->except('show')->names('permissions');
        Route::resource('roles', RoleController::class)->except('show')->names('roles');
        Route::resource('users', UserController::class)->except('show')->names('users');
    });
    //Exploitation Routes Group
    Route::group(['prefix' => 'exploitation', 'as' => 'exploitation.'], function () {

        Route::resource('fosts', FostController::class)->except('show')->names('fosts');
    });

    Route::get('admin', [PageController::class, 'admin'])->name('admin');
    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('exploitation', [PageController::class, 'dashboard'])->name('exploitation');

});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
