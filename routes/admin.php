<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/overview/router', function () {
    return view('admin.auth.login');
})->name('login.view');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/orders/all', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}',[OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/update/{id}',[OrderController::class, 'update'])->name('orders.update');
    Route::get('/bespoke',[OrderController::class, 'bespokeOrders'])->name('orders.bespoke');
    Route::get('/bespoke/{id}',[OrderController::class, 'viewBespoke'])->name('orders.bespoke.show');
    Route::get('/bridals',[OrderController::class, 'bridalOrders'])->name('orders.bridal');
    Route::get('/bridals/{id}',[OrderController::class, 'viewBridal'])->name('orders.bridal.show');

    Route::get('/category/all', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/create',[CategoryController::class,'create'])->name('category.store');
    Route::get('/category/{id}',[CategoryController::class, 'view_products'])->name('category.show');
    Route::post('/category/update/{id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/products',[ProductController::class,'index'])->name('products.index');
    Route::post('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/show',[ProductController::class, 'view_products'])->name('products.show');
    Route::get('/products/{id}/update', [ProductController::class, 'edit'])->name('products.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');

    Route::get('/customers/all',[UserController::class, 'index'])->name('user.index');

});
