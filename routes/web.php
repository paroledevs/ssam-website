<?php

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
*/

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::name('site.')->group(function () {

    // Nueva syntaxis ---> Route::get('user/profile', [UserProfileController::class, 'show'])->name('profile');

    // RUTAS SIMPLES PARA VIEWS EJEMPLO
    // Route::view('/', 'home')->name('home');

    Route::get('/', [SiteController::class, 'home'])->name('home');
    Route::get('/localization/{locale}', [LocalizationController::class, 'index'])->name('localization');
    Route::get('/menu/{category:slug?}', [SiteController::class, 'menu'])->name('menu');
    Route::get('/recetas', [SiteController::class, 'blog'])->name('blog');
    Route::get('/recetas/{post:slug}', [SiteController::class, 'post'])->name('post');
    Route::get('/reserva', [SiteController::class, 'book'])->name('book');
    Route::get('/catering', [SiteController::class, 'catering'])->name('catering');
    Route::view('/nosotros', 'us')->name('us');
    Route::view('/catering/reserva', 'contact')->name('contact');
});

/*
|--------------------------------------------------------------------------
| Vue routing support
|--------------------------------------------------------------------------
|
*/

// Route::any('/{any}', 'SiteController@index')->where('any', '.*');
