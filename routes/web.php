<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!


Route::get('/', function () {
    return view('welcome');
});
|
*/

//Principal
Route::get('/', function () {
    return view('materialdesign.home');
});

//Blacklist
//Listar
Route::get('/blacklist', 'BlacklistController@index');
//Mostrar formulario de Ingreso de Datos
Route::get('/blacklist_create', 'BlacklistController@create');
//Almacenar los datos
Route::post('/blacklist_create', 'BlacklistController@store');
//Mostrar un único registro
Route::get('/blacklist_show/{rut?}','BlacklistController@show');
//Editar un registro
Route::get('/blacklist_edit/{rut?}/edit','BlacklistController@edit');
//Actualizar un registro
Route::post('/blacklist_edit/{rut?}/edit','BlacklistController@update');
//Eliminar un registro
Route::get('/blacklist_destroy/{rut?}/delete','BlacklistController@destroy');

//Desloguear PIN
Route::post('/desloguear', 'PinController@index');

//DICOM
Route::resource('/dicom','DicomListaController');
//ACLARACIONES
Route::resource('/aclarar','DicomAclararController');
//CONVENIOS
Route::resource('/convenios','ConveniosController');
//PAGOS
Route::resource('/pagos','PagosController');

//Grabaciones Walmart
Route::post('/gra', 'WalmartGrbacion@store');

//Login
Route::post('/log', 'LogController@store');
//Almacenar los datos
Route::get('/log', 'LogController@index');
Route::get('logout','LogController@logout');

//Route::get('/dicom','DicomController@SinAjax');
//Route::post('/dicom','DicomController@Ajax');

//Route::get('/{slug?}','Controller@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
