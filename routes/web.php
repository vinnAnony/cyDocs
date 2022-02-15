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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/documents', 'DocumentsController@index');
Route::post('/documents', 'DocumentsController@store');
Route::get('/document/{docId}', 'DocumentsController@show');
Route::put('/documents', 'DocumentsController@update');
Route::delete('/documents', 'DocumentsController@destroy');

Route::get('/categories', 'CategoriesController@index');
Route::post('/categories', 'CategoriesController@store');
Route::get('/category/{docId}', 'CategoriesController@show');
Route::put('/categories', 'CategoriesController@update');
Route::delete('/categories', 'CategoriesController@destroy');
