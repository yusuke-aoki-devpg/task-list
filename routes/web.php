<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/todos', 'App\Http\Controllers\TodoController');

    // Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home.index');
    
    // Route::get('todos', 'App\Http\Controllers\TodoController@index')->name('todos.index');

    // Route::get('todos/create', 'App\Http\Controllers\TodoController@create')->name('todos.create');

    // Route::put('todos/{id}', 'App\Http\Controllers\TodoController@update')->name('todos.update');

    // Route::delete('todos/{id}', 'App\Http\Controllers\TodoController@destroy')->name('todos.destory');

    // Route::get('todos/{id}/edit', 'App\Http\Controllers\TodoController@edit')->name('todos.edit');

    // Route::post('todos', 'App\Http\Controllers\TodoController@store');
});

Auth::routes();
