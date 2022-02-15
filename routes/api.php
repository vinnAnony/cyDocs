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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

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
