<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
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



Route::group(['middleware'=>'guest'], function(){
    Route::get('sign_up', [UserController::class, 'create'])->name('signUp');
    Route::post('sign_up', [UserController::class, 'store']);

    Route::get('sign_in', [SessionController::class, 'create'])->name('signIn');
    Route::post('sign_in', [SessionController::class, 'store']);
});

Route::group(['middleware'=>'auth'],function(){
    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

    //Products
    Route::get('product_list',[ProductController::class,'list'])->name('product.list');
    Route::get('product_list_deleted', [ProductController::class, 'list_deleted'])->name('product.list.deleted');
    Route::get('product_create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product_create', [ProductController::class, 'store'])->name('product.store');
    Route::get('product_view/{id}', [ProductController::class, 'view'])->name('product.view');
    Route::get('product_edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product_edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product_delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('product_delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    //Stocks
    Route::get('stock_list',[StockController::class,'list'])->name('stock.list');
    Route::get('stock_list_deleted', [StockController::class, 'list_deleted'])->name('stock.list.deleted');
    Route::get('stock_create', [StockController::class, 'create'])->name('stock.create');
    Route::post('stock_create', [StockController::class, 'store'])->name('stock.store');
    Route::get('stock_view/{id}', [StockController::class, 'view'])->name('stock.view');
    Route::get('stock_edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::post('stock_edit/{id}', [StockController::class, 'update'])->name('stock.update');
    Route::get('stock_sold/{id}', [StockController::class, 'edit_sell'])->name('stock.sold');
    Route::post('stock_sold/{id}', [StockController::class, 'update_sell']);
    Route::get('stock_delete/{id}', [StockController::class, 'delete'])->name('stock.delete');
    Route::post('stock_delete/{id}', [StockController::class, 'destroy'])->name('stock.destroy');

    //Customers
    Route::get('customer_list',[CustomerController::class,'list'])->name('customer.list');
    Route::get('customer_list_deleted', [CustomerController::class, 'list_deleted'])->name('customer.list.deleted');
    Route::get('customer_create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('customer_create', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('customer_view/{id}', [CustomerController::class, 'view'])->name('customer.view');
    Route::get('customer_edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('customer_edit/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('customer_delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::post('customer_delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');


});
