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

// пара контроллер/и экшн (метод)
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/history', 'App\Http\Controllers\HistoryController@index');

Route::post('/addForm', 'App\Http\Controllers\HomeController@addForm')->name('addForm');
