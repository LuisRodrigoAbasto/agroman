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
Route::get('/empresas', function () {
    return view('empresa/index');
});
Route::get('/usuarios', function () {
    return view('usuario/index');
});
Route::get('/equipos', function () {
    return view('equipo/index');
});

Route::get('/cuentas', function () {
    return view('cuenta/index');
});

Route::get('/categorias', function () {
    return view('categoria/index');
});

Route::get('/administradores', function () {
    return view('administradore/index');
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
Route::get('/usuario_controller/select', 'UsuarioController@select');
Route::get('/usuario_controller/orden', 'UsuarioController@orden');

Route::get('/user_controller', 'UserController@index');
Route::post('/user_controller/registrar', 'UserController@store');
Route::put('/user_controller/actualizar', 'UserController@update');
Route::delete('/user_controller/eliminar_{id}', 'UserController@destroy');

Route::get('/equipo_controller', 'EquipoController@index');
Route::post('/equipo_controller/registrar', 'EquipoController@store');
Route::put('/equipo_controller/actualizar', 'EquipoController@update');
Route::delete('/equipo_controller/eliminar_{id}', 'EquipoController@destroy');

Route::get('/categoria_controller', 'CategoriaController@index');
Route::post('/categoria_controller/registrar', 'CategoriaController@store');
Route::put('/categoria_controller/actualizar', 'CategoriaController@update');
Route::delete('/categoria_controller/eliminar_{id}', 'CategoriaController@destroy');
Route::get('/categoria_controller/select', 'CategoriaController@select');

Route::get('/empresa_controller', 'EmpresaController@index');
Route::post('/empresa_controller/registrar', 'EmpresaController@store');
Route::put('/empresa_controller/actualizar', 'EmpresaController@update');
Route::delete('/empresa_controller/eliminar_{id}', 'EmpresaController@destroy');
Route::get('/empresa_controller/select', 'EmpresaController@select');

Route::get('/nota_controller', 'NotaController@index');
Route::post('/nota_controller/registrar', 'NotaController@store');
Route::put('/nota_controller/actualizar', 'NotaController@update');
Route::delete('/nota_controller/eliminar_{id}', 'NotaController@destroy');

// Route::get('/cuenta_controller', 'CuentaController@index');
Route::post('/cuenta_controller/registrar', 'CuentaController@store');
Route::put('/cuenta_controller/actualizar', 'CuentaController@update');
Route::delete('/cuenta_controller/eliminar_{id}', 'CuentaController@destroy');

});
Route::get('/direccion', 'UsuarioController@direccion');
Route::get('/principal_controller', 'UsuarioController@index');
Route::get('/reporte/usuario','ReporteController@index');
