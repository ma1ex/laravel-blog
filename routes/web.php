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

// Главная страница: точка входа
Route::get('/', 'FrontController@index')->name('index');

// Вывод категорий и статей
Route::get('/blog/category/{slug?}', 'BlogController@category')->name('category');
Route::get('/blog/article/{slug?}', 'BlogController@article')->name('article');
// Вывод всех категорий
Route::get('/blog/categories', 'BlogController@categories')->name('categories');

Auth::routes();

// Admin dashboard
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function() {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::resource('/category', 'CategoryController', ['as' => 'admin']);
    Route::resource('/article', 'ArticleController', ['as' => 'admin']);

    // User managment
    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function() {
        Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
    });

});

