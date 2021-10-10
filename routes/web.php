<?php

use Illuminate\Support\Facades\Route;

Route::get('pwd', function () {
    return bcrypt("sandinepodo");
});
Route::get('/', "UserController@index")->name("user.index");
Route::get('about-us', "UserController@about")->name("user.about");
Route::get('portfolio', "UserController@portfolio")->name("user.portfolio");
Route::get('portfolio/{id}', "UserController@portfolioDetail")->name("user.portfolio.detail");
Route::get('service', "UserController@service")->name("user.service");
Route::post('service/send-message', "UserController@sendMessage")->name("user.service.sendMessage");
Route::get('contact', "UserController@contact")->name("user.contact");

Route::group(['prefix' => "admin"], function () {
    Route::get('login', "AdminController@loginPage")->name('admin.loginPage');
    Route::post('login', "AdminController@login")->name('admin.login');
    Route::get('logout', "AdminController@logout")->name('admin.logout');

    Route::get('dashboard', "AdminController@dashboard")->name('admin.dashboard')->middleware('Admin');
    Route::get('copywriting', "AdminController@copywriting")->name('admin.copywriting')->middleware('Admin');
    Route::get('profile', "AdminController@profile")->name('admin.profile');
    Route::post('profile/update', "AdminController@updateProfile")->name('admin.profile.update');
    Route::post('profile/update/password', "AdminController@updatePassword")->name('admin.profile.updatePassword');

    Route::group(['prefix' => "copywriting"], function () {
        Route::post('update', "CopywritingController@update")->name('admin.copywriting.update')->middleware('Admin');
        Route::get('{code}', "CopywritingController@edit")->name('admin.copywriting.edit')->middleware('Admin');
        Route::get('/', "AdminController@copywriting")->name('admin.copywriting')->middleware('Admin');
    });

    Route::group(['prefix' => "master"], function () {
        Route::group(['prefix' => "service"], function() {
            Route::post('store', "ServiceController@store")->name('admin.service.store')->middleware('Admin');
            Route::post('update', "ServiceController@update")->name('admin.service.update')->middleware('Admin');
            Route::post('delete', "ServiceController@delete")->name('admin.service.delete')->middleware('Admin');
            Route::get('/', "AdminController@service")->name('admin.service')->middleware('Admin');
        });

        Route::group(['prefix' => "admin"], function() {
            Route::post('store', "AdminController@store")->name('admin.admin.store')->middleware('Admin');
            Route::post('update', "AdminController@update")->name('admin.admin.update')->middleware('Admin');
            Route::post('delete', "AdminController@delete")->name('admin.admin.delete')->middleware('Admin');
            Route::get('/', "AdminController@admin")->name('admin.admin')->middleware('Admin');
        });

        Route::group(['prefix' => "portfolio"], function() {
            Route::post('store', "PortfolioController@store")->name('admin.portfolio.store')->middleware('Admin');
            Route::post('update', "PortfolioController@update")->name('admin.portfolio.update')->middleware('Admin');
            Route::post('delete', "PortfolioController@delete")->name('admin.portfolio.delete')->middleware('Admin');
            Route::get('{id}/images', "PortfolioController@images")->name('admin.portfolio.images')->middleware('Admin');
            Route::get('images/delete', "PortfolioController@deleteImage")->name('admin.portfolio.images.delete')->middleware('Admin');
            Route::get('/', "AdminController@portfolio")->name('admin.portfolio')->middleware('Admin');
        });

        Route::group(['prefix' => "category"], function() {
            Route::post('store', "CategoryController@store")->name('admin.category.store')->middleware('Admin');
            Route::post('update', "CategoryController@update")->name('admin.category.update')->middleware('Admin');
            Route::post('delete', "CategoryController@delete")->name('admin.category.delete')->middleware('Admin');
            Route::get('/', "AdminController@category")->name('admin.category')->middleware('Admin');
        });
    });

    Route::get('/', function () {
        return redirect()->route('admin.loginPage');
    });
});