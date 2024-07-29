<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

// viewファイルを表示するだけなら、Router::viewメソッドを使うと簡潔に書ける
// Route::get('/', function () {
//     return view('index');
// });
Route::view('/', 'index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendmail']);
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');

// ブログ
Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{blog}', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');

// ユーザー管理
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
