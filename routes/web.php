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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    //Личный кабинет
    Route::get('/personal', 'LKController@index');
    Route::get('/personal/orders', 'LKController@index');
    Route::get('/personal/viewlist', 'LKController@index');
    Route::get('/personal/bonus', 'LKController@index');
    //****************

    //Избранные товары
    Route::get('/favorite', 'LikeGoodsController@index');
    //****************
    Route::get('/home', 'HomeController@index');

});
Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin:Администратор', //тут пока под вопросом, но частично работает
    'as' => 'admin.',
],
    function () {
        Route::get('/', 'Admin\DashboardController@index');
    }
);

