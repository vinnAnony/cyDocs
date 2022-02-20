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
    Route::get('/users', 'API\AuthController@fetchAllUsers');
    Route::put('/users/{user}', 'API\AuthController@updateUser');
    Route::delete('/users/{userId}', 'API\AuthController@destroy');

    Route::get('/user-roles', 'API\AuthController@fetchUserRoles');
    Route::post('/user-roles', 'API\AuthController@addUserRole');

    Route::get('/documents', 'API\DocumentsController@index');
    Route::post('/documents', 'API\DocumentsController@store');
    Route::get('/document/{docId}', 'API\DocumentsController@show');
    Route::put('/documents/{document}', 'API\DocumentsController@update');
    Route::delete('/document/{documentId}', 'API\DocumentsController@destroy');
    Route::get('/download-document/{documentId}', 'API\DocumentsController@downloadDocument');

    Route::get('/user-documents', 'API\DocumentsController@fetchUserDocuments');
    Route::get('/department-category-documents', 'API\DocumentsController@fetchDepartmentCategoryDocuments');

    Route::get('/categories', 'API\CategoriesController@index');
    Route::post('/categories', 'API\CategoriesController@store');
    Route::get('/category/{categoryId}', 'API\CategoriesController@show');
    Route::put('/categories/{category}', 'API\CategoriesController@update');
    Route::delete('/categories', 'API\CategoriesController@destroy');
    Route::get('/category-documents/{categoryId}', 'API\CategoriesController@fetchCategoryDocuments');
    Route::get('/department-categories/{departmentId}', 'API\CategoriesController@fetchDepartmentCategories');

    Route::get('/departments', 'API\DepartmentsController@index');
    Route::post('/departments', 'API\DepartmentsController@store');
    Route::get('/department/{departmentId}', 'API\DepartmentsController@show');
    Route::put('/departments/{department}', 'API\DepartmentsController@update');
    Route::delete('/departments', 'API\DepartmentsController@destroy');
    Route::get('/department-documents/{departmentId}', 'API\DepartmentsController@fetchDepartmentDocuments');

    Route::get('/file-requests', 'API\FileRequestsController@index');
    Route::post('/file-requests', 'API\FileRequestsController@store');
    Route::get('/file-request/{fileRequestId}', 'API\FileRequestsController@show');
    Route::put('/file-requests/{fileRequest}', 'API\FileRequestsController@update');
    Route::delete('/file-requests', 'API\FileRequestsController@destroy');

    Route::get('/user-file-requests/{userId}', 'API\FileRequestsController@fetchUserFileRequests');

    Route::get('/department-file-requests/{departmentId}', 'API\FileRequestsController@fetchDepartmentFileRequests');
});
