<?php

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
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('welcome');
});

Route::get('/users', function () {
    return view('welcome');
});
Route::get('/users/{id}', function () {
    return view('welcome');
});
Route::get('/user-roles', function () {
    return view('welcome');
});
Route::get('/user-roles/{id}', function () {
    return view('welcome');
});
Route::get('/expense-cateogries', function () {
    return view('welcome');
});
Route::get('/expense-cateogries/{id}', function () {
    return view('welcome');
});
Route::get('/expenses', function () {
    return view('welcome');
});
Route::get('/expenses/{id}', function () {
    return view('welcome');
});

//Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');