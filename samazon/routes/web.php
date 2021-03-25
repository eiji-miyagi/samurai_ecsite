<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|LaravelではRoute::resourceを使うことで、CRUD用のURLを一度に定義することができます。
第一引数にベースとなるURLを文字列で渡し、第二引数で使用するコントローラーを指定しています。
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', 'ProductController');
