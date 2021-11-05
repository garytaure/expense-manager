<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'UserController@login');
Route::middleware(['apitokenauth'])->group(function () {
    Route::get('/users', 'UserController@index');
    Route::post('/users', 'UserController@store');
    Route::get('/users/{id}', 'UserController@show');
    Route::put('/users/{id}', 'UserController@update');
    Route::delete('/users/{id}', 'UserController@delete');

    Route::get('/user-roles', 'UserRoleController@index');
    Route::post('/user-roles', 'UserRoleController@store');
    Route::get('/user-roles/{id}', 'UserRoleController@show');
    Route::put('/user-roles/{id}', 'UserRoleController@update');
    Route::delete('/user-roles/{id}', 'UserRoleController@delete');

    Route::get('/expense-cateogries', 'ExpenseCategoryController@index');
    Route::post('/expense-cateogries', 'ExpenseCategoryController@store');
    Route::get('/expense-cateogries/{id}', 'ExpenseCategoryController@show');
    Route::put('/expense-cateogries/{id}', 'ExpenseCategoryController@update');
    Route::delete('/expense-cateogries/{id}', 'ExpenseCategoryController@delete');

    Route::get('/expenses', 'ExpenseController@index');
    Route::post('/expenses', 'ExpenseController@store');
    Route::get('/expenses/{id}', 'ExpenseController@show');
    Route::put('/expenses/{id}', 'ExpenseController@update');
    Route::delete('/expenses/{id}', 'ExpenseController@delete');
});