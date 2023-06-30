<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Website', 'as' => 'website.'], function () {
    Route::get('login', 'AuthController@showLoginPage')->name('auth.login');
    Route::post('login', 'AuthController@authenticate')->name('auth.authenticate');
    Route::get('register', 'RegisterController@showRegisterForm')->name('auth.register');
    Route::post('register', 'RegisterController@register')->name('auth.create');

    Route::middleware('auth.web')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index')->name('auth.home');
        Route::get('logout', 'AuthController@logout')->name('auth.logout');

        Route::get('/izin/create', 'IzinController@create')->name('izin.create');
        Route::post('/izin/store', 'IzinController@store')->name('izin.store');
        Route::get('/izin/show', 'IzinController@show')->name('izin.show');
        Route::get('/izin/ajax_show', 'IzinController@ajax_show')->name('izin.ajax_show');
        Route::get('/izin/show_approval', 'ApprovalController@show_approval')->name('izin.show_approval');
        Route::get('/izin/ajax_show_approval', 'ApprovalController@ajax_show_approval')->name('izin.ajax_show_approval');
        Route::get('/izin/approve_ajax', 'ApprovalController@approve_ajax')->name('izin.approve_ajax');

        Route::get('/izin/show_confirmation', 'ConfirmController@show_confirmation')->name('izin.show_confirmation')->middleware('permission:confirm');
        Route::get('/izin/ajax_show_confirmation', 'ConfirmController@ajax_show_confirmation')->name('izin.ajax_show_confirmation')->middleware('permission:confirm');
        Route::get('/izin/confirm_ajax', 'ConfirmController@confirm_ajax')->name('izin.confirm_ajax')->middleware('permission:confirm');

        Route::get('/izin/show_control', 'AsetController@show_control')->name('izin.show_control');
        Route::get('/izin/ajax_show_control', 'AsetController@ajax_show_control')->name('izin.ajax_show_control');
    });
});
