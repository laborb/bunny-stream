<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bunny CP Routes
|--------------------------------------------------------------------------
*/

Route::namespace('\Laborb\BunnyStream\Http\Controllers\Cp')
    ->prefix('bunny/')
    ->name('bunny.')
    ->group(function () {
        Route::get('/', 'BunnyController@index')->name('index');
    });
