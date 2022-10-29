<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostByType as AdminPostByType;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Models\Category;

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

Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/author/{author}/category/{category}', [PostController::class, 'authorCategory'])->name('post.author.category');
Route::get('/category/{category}', [PostController::class, 'category'])->name('category.index');
Route::get('/author/{author}', [PostController::class, 'author'])->name('post.author');
Route::get('/tag/{tag}', [TagController::class, 'tag'])->name('tag.index');
Route::get('/author/{author}/category/{category}/tag/{tag}', [TagController::class, 'authorCategoryTag'])->name('author.category.tag');

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'handleLogin'])->name('auth.handle.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/auth/', [AdminHomeController::class, 'index'])->name('admin.panel');

    Route::get('/auth/category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/auth/category/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('/auth/category/{id}/delete', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    Route::post('/auth/category/update', function(Request $request){return (new AdminCategoryController)->save($request);})->can('update', ['App\Models\Category'])->name('admin.category.update');
    Route::get('/auth/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/auth/category/store', [AdminCategoryController::class, 'save'])->middleware(['can:create,App\Models\Category'])->name('admin.category.store');

    Route::get('/auth/tag', [AdminTagController::class, 'index'])->name('admin.tag.index');
    Route::get('/auth/tag/{id}/edit', [AdminTagController::class, 'edit'])->name('admin.tag.edit');
    Route::get('/auth/tag/{id}/delete', [AdminTagController::class, 'delete'])->name('admin.tag.delete');
    Route::post('/auth/tag/update', [AdminTagController::class, 'save'])->name('admin.tag.update');
    Route::get('/auth/tag/create', [AdminTagController::class, 'create'])->name('admin.tag.create');
    Route::post('/auth/tag/store', [AdminTagController::class, 'save'])->name('admin.tag.store');

    Route::get('/auth/post', [AdminPostController::class, 'index'])->name('admin.post.index');
    Route::get('/auth/post/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
    Route::get('/auth/post/{id}/delete', [AdminPostController::class, 'delete'])->name('admin.post.delete');
    Route::post('/auth/post/update', [AdminPostController::class, 'save'])->name('admin.post.update');
    Route::get('/auth/post/create', [AdminPostController::class, 'create'])->name('admin.post.create');
    Route::post('/auth/post/store', [AdminPostController::class, 'save'])->name('admin.post.store');

    Route::get('/auth/user', [AdminUserController::class, 'index'])->name('admin.user.index');

    Route::get('/auth/post-by-type/{id}/{postable_type}', [AdminPostByType::class, 'index'])->name('admin.post_by_type.index');
});
