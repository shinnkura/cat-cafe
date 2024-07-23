<?php

use Illuminate\Support\Facades\Route;

// viewファイルを表示するだけなら、Router::viewメソッドを使うと簡潔に書ける
// Route::get('/', function () {
//     return view('index');
// });
Route::view('/', 'index');
