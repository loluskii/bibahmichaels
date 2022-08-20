<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
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
    Route::get('/custom',[OrderController::class, 'customOrders'])->name('orders.custom');
    Route::get('/custom/{id}',[OrderController::class, 'viewCustom'])->name('orders.custom.show');

    Route::get('/category/all', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/create',[CategoryController::class,'create'])->name('category.store');
    Route::get('/category/{id}',[CategoryController::class, 'view_products'])->name('category.show');
    Route::post('/category/update/{id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/products',[ProductController::class,'index'])->name('products.index');
    Route::post('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/show',[ProductController::class, 'view_products'])->name('products.show');
    Route::post('/products/{id}/update', [ProductController::class, 'edit'])->name('products.update');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');

    Route::get('/settings/currency', [SettingsController::class, 'currencyIndex'])->name('settings.currency.index');
    Route::post('/settings/create', [SettingsController::class, 'addCurrency'])->name('settings.currency.add');
    Route::post('/settings/currency/{id}/update', [SettingsController::class, 'editCurrency'])->name('settings.currency.edit');
    Route::get('/settings/currency/{id}/delete', [SettingsController::class, 'deleteCurrency'])->name('settings.currency.delete');

    Route::get('/customers/all',[UserController::class, 'index'])->name('user.index');

});
