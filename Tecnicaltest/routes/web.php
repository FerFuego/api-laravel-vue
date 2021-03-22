<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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
Route::view('/', 'auth.login');
     
Auth::routes();

Route::middleware('auth')->group( function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class, ['except' => 'show', 'create', 'edit']);
    Route::resource('categories', CategoryController::class, ['except' => 'show', 'create', 'edit']);
});

return Response::make('Forbidden', 403);