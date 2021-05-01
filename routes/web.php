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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();



Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index']);

Route::middleware('is_admin')->prefix('admin')->group(function(){
    
    Route::get('/user', [App\Http\Controllers\AdminController::class, 'users'])->name('user');
    Route::post('/user', [App\Http\Controllers\AdminController::class, 'submit_user'])->name('user.submit');
    Route::patch('/user/update', [App\Http\Controllers\AdminController::class, 'update_user'])->name('user.update');
    Route::delete('/user/delete', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('user.delete');
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

});
    Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
    Route::get('/ajax/dataUser/{id}', [App\Http\Controllers\AdminController::class, 'getDataUser'])->middleware('is_admin');
    Route::get('/ajax/dataProduct/{id}', [App\Http\Controllers\ProductController::class, 'getDataProduct'])->middleware('is_admin');
       
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'submit_categories'])->name('admin.categories.submit');
    Route::get('/ajaxadmin/dataCategories/{id}', [App\Http\Controllers\CategoryController::class, 'getDataCategories']);
    Route::patch('/categories/update', [App\Http\Controllers\CategoryController::class, 'update_categories'])->name('admin.categories.update');
    Route::delete('/categories/delete', [App\Http\Controllers\CategoryController::class, 'delete_categories'])->name('admin.categories.delete');

    Route::get('/brands', [App\Http\Controllers\BrandController::class, 'brands'])->name('admin.brands');
    Route::post('/brands', [App\Http\Controllers\BrandController::class, 'submit_brands'])->name('admin.brands.submit');
    Route::get('/ajaxadmin/dataBrands/{id}', [App\Http\Controllers\BrandController::class, 'getDataBrands']);
    Route::patch('/brands/update', [App\Http\Controllers\BrandController::class, 'update_brands'])->name('admin.brands.update');
    Route::delete('/brands/delete', [App\Http\Controllers\BrandController::class, 'delete_brands'])->name('admin.brands.delete');

    Route::get('/product', [App\Http\Controllers\ProductController::class, 'products'])->name('product');
    
    Route::post('/product', [App\Http\Controllers\ProductController::class, 'submit_product'])->name('product.submit');
    Route::patch('/product/update', [App\Http\Controllers\ProductController::class, 'update_product'])->name('product.update');
    Route::delete('/product/delete', [App\Http\Controllers\ProductController::class, 'delete_product'])->name('product.delete');

    Route::get('/take', [App\Http\Controllers\TakeController::class, 'index'])->name('take');
    Route::post('/take', [App\Http\Controllers\TakeController::class, 'submit_take'])->name('take.submit');

    Route::get('/Admin/reportin', [App\Http\Controllers\Admin\ReportInController::class, 'index'])->name('admin.reports')->middleware('is_admin');
    Route::get('/Admin/print_reportin', [App\Http\Controllers\Admin\ReportInController::class, 'print_reportin'])->name('admin.print_reportin')->middleware('is_admin');
    Route::get('/Admin/reportout', [App\Http\Controllers\Admin\ReportOutController::class, 'index'])->name('admin.reportouts')->middleware('is_admin');
    Route::get('/Admin/print_reportout', [App\Http\Controllers\Admin\ReportOutController::class, 'print_reportout'])->name('admin.print_reportout')->middleware('is_admin');
