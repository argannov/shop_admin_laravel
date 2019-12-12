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

Route::get('/', 'PagesController@index');

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
       return redirect()->route('/dashboard');
    });
        Route::get('/dashboard', 'Admin\DashboardController@index');

        //Создание и редактирование товаров в админке
        Route::get('/product', 'Admin\NewGoodsController@index');
        Route::get('/product/create', 'Admin\NewGoodsController@formProduct');
        Route::post('/product/create', 'Admin\NewGoodsController@addProduct');
        //************************************************************

        //Создание и редактирование страниц в админке
        Route::get('/pages', 'Admin\NewPageController@index');
        Route::get('/pages/edit/{slug}', 'Admin\NewPageController@onePage');
        Route::post('/pages/edit/{slug}', 'Admin\NewPageController@edit');
        Route::post('/pages/create', 'Admin\NewPageController@createPost');
        Route::post('/pages/delete/{slug}', 'Admin\NewPageController@deletePage');
        Route::get('/pages/create', 'Admin\NewPageController@create');
        //************************************************************

        //Создание и редактирование заказов в админке
        Route::get('/orders', 'Admin\OrdersController@index');
        //************************************************************

        //Создание и редактирование записей в админке
        Route::get('/posts', 'Admin\NewPostController@index');
        Route::get('/posts/create', 'Admin\NewPostController@create');
        Route::post('/posts/create', 'Admin\NewPostController@create');
        //************************************************************

        //Создание и редактирование скидок в админке
        Route::get('/sale', 'Admin\NewPromocodeController@index');
        Route::get('/sale/create', 'Admin\NewPromocodeController@create');
        Route::post('/sale/create', 'Admin\NewPromocodeController@index');
        //************************************************************

        //Создание и редактирование пользователей в админке
        Route::get('/users', 'Admin\AllUsersController@index');
        Route::get('/roles', 'Admin\PermissionController@index');
        //************************************************************

        //Создание и редактирование магазинов в админке
        Route::get('/store', 'Admin\NewStoreController@index');
        Route::get('/store/create', 'Admin\NewStoreController@create');
        Route::post('/store/create', 'Admin\NewStoreController@create');
        //************************************************************
    }
);
Route::get('/{slug}', 'PagesController@otherPage');
