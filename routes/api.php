<?php

    use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', App\Http\Controllers\Post\IndexController::class);
        Route::get('/{post}', App\Http\Controllers\Post\ShowController::class);
        Route::post('/', App\Http\Controllers\Post\StoreController::class);
        Route::patch('/{post}', App\Http\Controllers\Post\UpdateController::class);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', App\Http\Controllers\Category\IndexController::class);
        Route::get('/{category}', App\Http\Controllers\Category\ShowController::class);
    });

    Route::group(['prefix' => 'likes'], function () {
        Route::post('/', App\Http\Controllers\Like\StoreController::class);
    });

    Route::group(['prefix' => 'views'], function () {
        Route::post('/', App\Http\Controllers\View\StoreController::class);
    });

