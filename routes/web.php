<?php

use App\Http\Controllers\{AdminController, CategoryController, ColorController, HomeController, TagController, ShoesSizeController, UserController, ProductController};
use App\Http\Controllers\Auth\AuthController;
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


Route::get('/', [HomeController::class, 'index']);

Route::delete('/deleteimage/{$id}', [ProductController::class, 'deleteimage']);
// Route::delete('/deletecover/{$id}', [ProductController::class, 'deletecover'])->name('products.deletecover');
Route::middleware('auth')->group(function () {
Route::get('/admin', AdminController::class);
Route::group(['prefix'=>'admin'], function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('shoes', ShoesSizeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::post('products/deletecover/{id}', [ProductController::class, 'deletecover'])->name('products.deletecover');
    Route::post('products/deleteimage/{id}', [ProductController::class, 'deleteimage'])->name('products.deleteimage');
});

});

// Auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
