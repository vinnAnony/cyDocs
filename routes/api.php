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


Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('/documents', 'DocumentsController@index');
    Route::post('/documents', 'DocumentsController@store');
    Route::get('/document/{docId}', 'DocumentsController@show');
    Route::put('/documents', 'DocumentsController@update');
    Route::delete('/documents', 'DocumentsController@destroy');

    Route::get('/categories', 'CategoriesController@index');
    Route::post('/categories', 'CategoriesController@store');
    Route::get('/category/{categoryId}', 'CategoriesController@show');
    Route::put('/categories', 'CategoriesController@update');
    Route::delete('/categories', 'CategoriesController@destroy');

    Route::get('/departments', 'DepartmentsController@index');
    Route::post('/departments', 'DepartmentsController@store');
    Route::get('/department/{departmentId}', 'DepartmentsController@show');
    Route::put('/departments', 'DepartmentsController@update');
    Route::delete('/departments', 'DepartmentsController@destroy');
    Route::get('/department-documents/{departmentId}', 'DepartmentsController@fetchDepartmentDocuments');
});
