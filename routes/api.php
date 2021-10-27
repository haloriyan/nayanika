<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => "portfolio"], function () {
    Route::post('images', "PortfolioController@getImages")->name('api.portfolio.images');
    Route::post('images/upload', "PortfolioController@uploadImage")->name('api.portfolio.images.upload');
    Route::post('images/delete', "PortfolioController@deleteImage")->name('api.portfolio.images.delete');
    Route::post("/", "PortfolioController@load")->name("api.portfolio.load");
});
