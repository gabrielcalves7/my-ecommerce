<?php

use App\Http\Controllers\UserController;
use App\Livewire\Admin;
use App\Livewire\LoginRegister;
use App\Livewire\ProductCategory;
use App\Livewire\User;
use App\Livewire\Product;
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
    Route::controller(UserController::class)->group(function () {
        Route::get('/testa', 'logout')->name('buceta');
    });

    Route::get('/counter', Counter::class);
    Route::get('/create-post', \App\Livewire\CreatePost::class);

    Route::controller(Product::class)->prefix('/products')->group(function () {
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
            Route::controller(Product::class)->prefix('product')->group(function () {
                Route::get('/', 'view')->name('product.view');
                Route::get('/create', 'createProduct')->name('product.create');
                Route::get('/product/{id}', 'editProduct')->name('single_product');
                Route::post('/product/{id?}', 'saveProduct')->name('save_product');
            });
            Route::controller(User::class)->prefix('user')->group(function () {
                Route::get('/', 'view')->name('user.view');
                Route::get('/create', 'createUser')->name('user.create');
                Route::get('/{id}', 'editUser')->name('single_user');
                Route::post('/{id?}', 'saveUser')->name('save_user');
            });
            Route::controller(ProductCategory::class)->prefix('category')->group(function () {
                Route::get('/', 'view')->name('category.view');
                Route::get('/create/{id?}', 'createProductCategory')->name('category.create');
                Route::get('/{id}', 'editProductCategory')->name('single_category');
                Route::post('/{id?}', 'saveProductCategory')->name('save_category');
            });
            Route::get('/', 'index')->name('admin');
        });
    });
});

