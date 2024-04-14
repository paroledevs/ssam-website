<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

use App\Http\Controllers\CateringController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\DishController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\PromoController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    // Nueva syntaxis ---> Route::get('user/profile', [UserProfileController::class, 'show'])->name('profile');

    // RUTAS SIMPLES PARA VIEWS EJEMPLO
    // Route::view('users', 'admin.users.items')->name('users.index');
    // Route::view('users/create', 'admin.users.create')->name('users.create');
    // Route::view('users/edit', 'admin.users.edit')->name('users.edit');

    // Authentication
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'showLoginForm')->name('admin.login');
        Route::post('/', 'login')->name('admin.login.make');
        Route::post('logout', 'logout')->name('admin.logout');
    });

    Route::middleware('auth')->group(function () {
        Route::middleware('role:super_admin')->group(function () {
            // Monitor
            Route::resource('monitor', ActivityController::class)
                ->parameters(['monitor' => 'activity'])
                ->names('monitor')
                ->only(['index', 'show']);
        });

        // Users
        Route::resource('users', UserController::class)->except(['show']);

        // Promos
        Route::resource('promos', PromoController::class)->except(['show']);

        // Menu
        Route::resource('menu', DishController::class)
            ->parameters(['menu' => 'dish'])
            ->names('menu')
            ->except(['show']);

        // Locations
        Route::resource('locations', LocationController::class)->except(['show']);

        // Recipes
        Route::resource('recipes', PostController::class)
            ->parameters(['recipes' => 'post'])
            ->names('posts')
            ->except('show');

        // Website
        Route::view('website', 'admin.website.items')->name('website.index');
        Route::view('website/home', 'admin.website.home')->name('website.home');
        Route::get('website/catering', [CateringController::class, 'index'])->name('website.catering');
        Route::post('website/catering', [CateringController::class, 'store'])->name('website.catering.store');
        Route::delete('website/catering/{catering}', [CateringController::class, 'destroy'])->name('website.catering.destroy');

        // Need role --> super_admin|admin
        Route::middleware('role:super_admin,admin')->group(function () {
            //
        });
    });
});
