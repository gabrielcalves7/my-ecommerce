<?php

use App\Livewire\Admin;
use App\Livewire\LoginRegister;
use App\Livewire\User;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'web'], function () {

    Route::get('/counter', Counter::class);
    Route::get('/create-post', \App\Livewire\CreatePost::class);

    Route::controller(Products::class)->prefix('/products')->group(function () {
        Route::get('/', 'index')->name('getProducts');
    });
    Route::controller(LoginRegister::class)->prefix('/')->group(function () {
        Route::get('/login', LoginRegister::class)->name('login');
        Route::get('/register', \App\Livewire\Register::class)->name('register');

    });
    Route::controller(\App\Livewire\App::class)->prefix('/')->group(function () {
        Route::get('/', 'index')->name('home');

    });

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::controller(Admin::class)->group(function () {
            Route::controller(Products::class)->prefix('products')->group(function () {
                Route::get('/view', 'view')->name('products.view');
                Route::get('/product/{id}', 'editProduct')->name('single_product');
                Route::post('/product/{id?}', 'saveProduct')->name('save_product');

            });
            Route::controller(User::class)->prefix('users')->group(function () {
                Route::get('/view', 'view')->name('users.view');
                Route::get('/', 'view')->name('users.view');
                Route::get('/{id}', 'editUser')->name('single_user');
                Route::post('/{id?}', 'saveUser')->name('save_user');

            });
            Route::get('/', 'index')->name('admin');

        });


    });


});

