<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// viewファイルを表示するだけなら、Router::viewメソッドを使うと簡潔に書ける
// Route::get('/', function () {
//     return view('index');
// });
Route::view('/', 'index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendmail']);
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');
