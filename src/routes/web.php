<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::patch('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
