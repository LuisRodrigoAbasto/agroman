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
Route::group(['middleware'=>['auth']],function(){

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/departamentos', function () {
    return view('departamento/index');
});
Route::get('/sucursal', function () {
    return view('sucursal/index');
});
Route::get('/usuarios', function () {
    return view('usuario/index');
});

Route::get('/departamento_controller', 'DepartamentoController@index');
Route::post('/departamento_controller/registrar', 'DepartamentoController@store');
Route::put('/departamento_controller/actualizar', 'DepartamentoController@update');
Route::delete('/departamento_controller/eliminar_{id}', 'DepartamentoController@destroy');
Route::get('/departamento_controller/select', 'DepartamentoController@select');

Route::get('/sucursal_controller', 'SucursalController@index');
Route::post('/sucursal_controller/registrar', 'SucursalController@store');
Route::put('/sucursal_controller/actualizar', 'SucursalController@update');
Route::delete('/sucursal_controller/eliminar_{id}', 'SucursalController@destroy');
Route::get('/sucursal_controller/select', 'SucursalController@select');

Route::get('/usuario_controller', 'UsuarioController@index');
Route::post('/usuario_controller/registrar', 'UsuarioController@store');
Route::put('/usuario_controller/actualizar', 'UsuarioController@update');
Route::delete('/usuario_controller/eliminar_{id}', 'UsuarioController@destroy');

Route::get('/usuario_controller/orden', 'UsuarioController@orden');

Route::get('/direccion', 'UsuarioController@direccion');

});
