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

Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/author/{author}/category/{category}', [\App\Http\Controllers\PostController::class, 'authorCategory'])->name('post.author.category');
Route::get('/category/{category}', [\App\Http\Controllers\PostController::class, 'category'])->name('category.index');
Route::get('/author/{author} ', [\App\Http\Controllers\PostController::class, 'author'])->name('post.author');

/*Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::get('/category/{id}/delete', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/update', [\App\Http\Controllers\CategoryController::class, 'save'])->name('category.update');
Route::get('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [\App\Http\Controllers\CategoryController::class, 'save'])->name('category.store');

Route::get('/tag', [\App\Http\Controllers\TagController::class, 'index'])->name('tag.index');
Route::get('/tag/{id}/edit', [\App\Http\Controllers\TagController::class, 'edit'])->name('tag.edit');
Route::get('/tag/{id}/delete', [\App\Http\Controllers\TagController::class, 'delete'])->name('tag.delete');
Route::post('/tag/update', [\App\Http\Controllers\TagController::class, 'save'])->name('tag.update');
Route::get('/tag/create', [\App\Http\Controllers\TagController::class, 'create'])->name('tag.create');
Route::post('/tag/store', [\App\Http\Controllers\TagController::class, 'save'])->name('tag.store');

Route::get('/post', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/post/{id}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::get('/post/{id}/delete', [\App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
Route::post('/post/update', [\App\Http\Controllers\PostController::class, 'save'])->name('post.update');
Route::get('/post/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [\App\Http\Controllers\PostController::class, 'save'])->name('post.store');*/
