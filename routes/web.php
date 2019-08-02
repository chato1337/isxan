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

Route::get('/dian-api', function() {
    return redirect('/api/ubl2.1/documentation');
});

Route::get('/listings', 'ListingController@index');

// por aqui meti la mano

Route::get('/', 'SystemController@index');
Route::get('/departamentos', 'SystemController@deptos');
Route::get('/ciudades', 'SystemController@ciudades');

//metodos del controlador auth y login
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
