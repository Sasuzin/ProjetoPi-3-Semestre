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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', 'App\Http\Controllers\Admin\FrontendController@index');

    Route::get('categorias', 'App\Http\Controllers\Admin\CategoriaController@index');

    Route::get('add-categorias', 'App\Http\Controllers\Admin\CategoriaController@add');

    Route::post('insert-categorias' , 'App\Http\Controllers\Admin\CategoriaController@insert');
});

