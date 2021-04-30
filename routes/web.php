<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/brand', [App\Http\Controllers\BrandController::class, 'index'])->name('brand');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');

Route::get('/Admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user')->middleware('is_admin');

Route::get('/Admin/reportin', [App\Http\Controllers\Admin\ReportInController::class, 'index'])->name('admin.reports')->middleware('is_admin');


Route::get('/Admin/ajax/dataUser/{id}', [App\Http\Controllers\Admin\UserController::class, 'getDataUser']);


Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/ajax/dataProduct/{id}', [App\Http\Controllers\ProductController::class, 'getDataProduct']);
Route::post('/product', [App\Http\Controllers\ProductController::class, 'submit_product'])->name('product.submit');
Route::patch('/product/update', [App\Http\Controllers\ProductController::class, 'update_product'])->name('product.update');
Route::delete('/product/delete', [App\Http\Controllers\ProductController::class, 'delete_product'])->name('product.delete');

// pengelolaan user
Route::post('/Admin/user', [App\Http\Controllers\Admin\UserController::class, 'submit_user'])->name('user.submit');
Route::patch('/Admin/user/update', [App\Http\Controllers\Admin\UserController::class, 'update_usesr'])->name('user.update');
Route::delete('/Admin/user/delete', [App\Http\Controllers\Admin\UserController::class, 'delete_user'])->name('user.delete');

Route::get('/ajax/dataBrand/{id}', [App\Http\Controllers\BrandController::class, 'getDataBrand']);

// pengelolaan brand
Route::post('/brand', [App\Http\Controllers\BrandController::class, 'submit_brand'])->name('brand.submit');
Route::patch('/brand/update', [App\Http\Controllers\BrandController::class, 'update_brand'])->name('brand.update');
Route::delete('/brand/delete', [App\Http\Controllers\BrandController::class, 'delete_brand'])->name('brand.delete');


Route::get('/ajax/dataBrand/{id}', [App\Http\Controllers\CategoryController::class, 'getDataBrand']);

// pengelolaan category
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'submit_category'])->name('category.submit');
Route::patch('/category/update', [App\Http\Controllers\CategoryController::class, 'update_category'])->name('category.update');
Route::delete('/category/delete', [App\Http\Controllers\CategoryController::class, 'delete_category'])->name('category.delete');


Route::middleware('is_admin')->prefix('admin')->group(function(){
    Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
});