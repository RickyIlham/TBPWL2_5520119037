<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');

Route::get('admin/products', [ProductController::class, 'index'])
    ->name('admin.products')
    ->middleware('is_admin');

Route::post('admin/products', [ProductController::class, 'store'])
    ->name('admin.product.submit')
    ->middleware('is_admin');
Route::patch('admin/products/update', [ProductController::class, 'update'])
    ->name('admin.product.update')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataProduk/{id}', [ProductController::class, 'getDataProduk']);
Route::delete('admin/products/delete', [ProductController::class, 'destroy'])
    ->name('admin.product.delete')
    ->middleware('is_admin');

//PENGELOLAAN BUKU


//UPDATE BOOK


//PRINT PDF
Route::get('admin/print_books', [AdminController::class, 'print_books'])
->name('admin.print.products')
->middleware('is_admin');
