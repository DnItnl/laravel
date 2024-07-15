<?php

use Illuminate\Support\Facades\Route;

Route::prefix('laravel')->group(function () {
    Route::get("/", function () {
        return view("welcome");
    });

    Route::get("/welcome", function () {
        return "welcome";
    });

});
