<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Exploitation\FostController;
use App\Http\Controllers\Exploitation\InstallateurAdresse;
use App\Http\Controllers\Exploitation\InstallateurController;
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
        Route::resource('installateurs', InstallateurController::class)->except('show')->names('installateurs');
        Route::patch('installateurs/{installateur}/desactiver', [InstallateurController::class, 'desactiver'])->name('installateurs.desactiver');
        Route::patch('installateurs/{installateur}/activer', [InstallateurController::class, 'activer'])->name('installateurs.activer');
        Route::resource('installateurs.adresses', InstallateurAdresse::class)->except('index', 'show', 'edit');

    });

    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('todo', [PageController::class, 'todo'])->name('todo');

    /*Route::get('/test', function () {
        $installateurs = Installateur::find(1);
        $adresse = new (Adresse::class);
        $adresse->type = 'livraison';
        $adresse->adresse = '10 rue de la poste';
        $adresse->code_postal = '31000';
        $adresse->ville = 'Toulouse';
        $adresse->pays = 'France';
        $installateurs->adresses()->save($adresse);
    });*/

});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
