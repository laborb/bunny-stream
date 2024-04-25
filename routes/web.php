<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bunny CP Routes
|--------------------------------------------------------------------------
*/

Route::namespace("\Laborb\BunnyStream\Http\Controllers\Public")
    ->name("bunny.public.")
    ->group(function () {
        Route::get(
            config("statamic.bunny.play_url") . "/{videoId}",
            "PlayController@index"
        )->name("play");

        Route::get(
            config("statamic.bunny.embed_url") . "/{videoId}",
            "PlayController@embed"
        )->name("embed");

        Route::get("/bunny-034871932/links", "PlayController@links")->name(
            "links"
        );
    });
