<?php

use Illuminate\Support\Facades\Route;

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

/*
Route::get('obtenerproducto', 'FacturaController@obtenerproducto')
         ->name('facturas.obtenerproductos');//con este llamas en la vista
Route::resource('facturas', 'FacturaController');
*/

Auth::routes();

Route::get('/borraespacio', 'Espacios_c@elimina')->name('datatable.borraespacio');

Route::get('/editespacio', 'Espacios_c@edit')->name('datatable.editespacio');

Route::get('/iespacio', 'Espacios_c@in_espacio')->name('datatable.iespacio');

Route::get('/tespacios', 'Espacios_c@getEspacios')->name('datatable.tespacios');

Route::post('registrare', 'Espacios_c@registrare');

Route::get('v_reg_espacios', 'Espacios_c@muestra_v')->name('v_reg_espacios');

Route::get('reg_espacios_v', function () {

    return view('r_espacios_v');
})->name('reg_espacios_v');

Route::post('/registrar', 'Componente_c@registrar');


Route::get('/', function () {
    return view('welcome');
});

Route::get('vistaCon', function () {
    return view('regis_compo');
});

Route::get('menu', 'Usuario_c@menu');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/Darpermisos","premisosController@darPermisos" );
Route::get("/PermisosEnviar","premisosController@asignar")->name("asignarPermiso");
Route::get("/Permisosmostrar","premisosController@mostrar")->name("mostrarPermisos");
Route::get("/Permisosquitar","premisosController@quitar")->name("quitarPermiso");

Route::get("/apartar","apartarEspaciosController@apartar");

Route::get("/guardarPeticion","apartarEspaciosController@insertar")->name("crearSolicitud");


Route::get("prueba","apartarEspaciosController@pruebas")->name("prueba");

Route::get("EventoComponente","EventoController@MostrarComponentes")->name('eventoComp');

Route::get("BusCategoria","EventoController@MostrarCategoria")->name("BusCategoria");

Route::get("BusCompo","EventoController@MostrarComp")->name("BusCompo");

Route::get("BusCantidad","EventoController@MostrarCantidad")->name("BusCantidad");
