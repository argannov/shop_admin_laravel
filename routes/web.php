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

Route::get('/catalog', 'GoodsController@index');
Route::get('/catalog/{slug}', 'GoodsController@index');
Route::get('/catalog/{slug}/{name}', 'GoodsController@index');
Route::get('/cart', 'CartsController@index');
Route::get('/posts', 'PostsController@index');
Route::get('/favorite', 'LikeGoodsController@index');
Route::post('/search', 'SearchController@index');
Route::get('/stores', 'PagesController@index');


Route::group(['middleware' => 'auth'], function () {

    //Личный кабинет
    Route::get('/personal', 'LKController@index');
    Route::get('/personal/orders', 'LKController@index');
    Route::get('/personal/viewlist', 'LKController@index');
    Route::get('/personal/bonus', 'LKController@index');
    //****************
    Route::get('/order', 'OrdersController@index');
    Route::get('/home', 'HomeController@index');

});
Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin:admin', //тут пока под вопросом, но частично работает
],
    function () {
    Route::get('/',function (){
       return redirect('/dashboard');
    });
        Route::get('/dashboard', 'Admin\DashboardController@index');
        Route::get('/product', 'Admin\NewGoodsController@index');
        Route::get('/product/create', 'Admin\NewGoodsController@formProduct');
        Route::post('/product/create', 'Admin\NewGoodsController@addProduct');
        Route::get('/pages', 'Admin\NewPageController@index');
        Route::get('/orders', 'Admin\OrdersController@index');
        Route::get('/posts', 'Admin\NewPostController@index');
        Route::get('/sale', 'Admin\NewPromocodeController@index');
        Route::get('/users', 'Admin\AllUsersController@index');
        Route::get('/roles', 'Admin\PermissionController@index');
        Route::get('/store', 'Admin\NewStoreController@index');
    }
);
//Route::get('/{slug}', 'PagesController@index');
