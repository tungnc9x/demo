<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes([
    'verify' => true,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

Route::prefix('product')->group(function (){
    Route::get('/',[ProductController::class,'index'])->middleware(['auth','verified'])->name('product.index');
    Route::get('/create',[ProductController::class,'create'])->middleware(['auth','verified'])->name('product.create');
    Route::post('/create',[ProductController::class,'store'])->middleware(['auth','verified'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->middleware(['auth','verified'])->name('product.edit');
    Route::put('/update/{id}',[ProductController::class,'update'])->middleware(['auth','verified'])->name('product.update');
    Route::delete('/destroy/{id}',[ProductController::class,'destroy'])->middleware(['auth','verified'])->name('product.destroy');
});
