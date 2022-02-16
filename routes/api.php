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
    Route::get('/documents', 'API\DocumentsController@index');
    Route::post('/documents', 'API\DocumentsController@store');
    Route::get('/document/{docId}', 'API\DocumentsController@show');
    Route::put('/documents', 'API\DocumentsController@update');
    Route::delete('/documents', 'API\DocumentsController@destroy');

    Route::get('/categories', 'API\CategoriesController@index');
    Route::post('/categories', 'API\CategoriesController@store');
    Route::get('/category/{categoryId}', 'API\CategoriesController@show');
    Route::put('/categories', 'API\CategoriesController@update');
    Route::delete('/categories', 'API\CategoriesController@destroy');

    Route::get('/departments', 'API\DepartmentsController@index');
    Route::post('/departments', 'API\DepartmentsController@store');
    Route::get('/department/{departmentId}', 'API\DepartmentsController@show');
    Route::put('/departments', 'API\DepartmentsController@update');
    Route::delete('/departments', 'API\DepartmentsController@destroy');
    Route::get('/department-documents/{departmentId}', 'API\DepartmentsController@fetchDepartmentDocuments');
});
