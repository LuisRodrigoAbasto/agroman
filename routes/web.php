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

Route::get('/departamentos', function () {
    return view('departamento/index')->name('departamentos');
});

Route::get('/departamento', 'DepartamentoController@index');
Route::post('/departamento/registrar', 'DepartamentoController@store');
Route::put('/departamento/actualizar', 'DepartamentoController@update');
Route::delete('/departamento/eliminar_{id}', 'DepartamentoController@destroy');

Route::get('/sucursal', 'SucursalController@index');
Route::post('/sucursal/registrar', 'SucursalController@store');
Route::put('/sucursal/actualizar', 'SucursalController@update');
Route::delete('/sucursal/eliminar_{id}', 'SucursalController@destroy');