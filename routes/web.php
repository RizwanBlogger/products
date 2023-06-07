<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


Route::get('/',[ProductController::class,'create'])->name('product.create');
Route::post('/product/submit',[ProductController::class,'submit'])->name('product.submit');
Route::get('/produt/list',[ProductController::class,'index'])->name('proudct.list');
Route::get('/delete/product/{id}',[ProductController::class,'destroy'])->name('product.delete');
Route::get('/product/update/{id}',[ProductController::class,'update'])->name('product.update');
