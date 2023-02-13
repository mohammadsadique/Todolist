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
Route::post('/deleteTodoList', [App\Http\Controllers\HomeController::class, 'deleteTodoList'])->name('deleteTodoList');
Route::post('/submitAddTodo', [App\Http\Controllers\HomeController::class, 'submitAddTodo'])->name('submitAddTodo');
Route::post('/completeTodoList', [App\Http\Controllers\HomeController::class, 'completeTodoList'])->name('completeTodoList');
Route::post('/ckeditor/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('ckeditor.upload');

