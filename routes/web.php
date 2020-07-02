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
Auth::routes(['verify' => true]);

Route::get('/borraespacio', 'Espacios_c@elimina')->name('datatable.borraespacio')->middleware('verified');

Route::get('/editespacio', 'Espacios_c@edit')->name('datatable.editespacio')->middleware('verified');

Route::get('/iespacio', 'Espacios_c@in_espacio')->name('datatable.iespacio')->middleware('verified');

Route::get('/tespacios', 'Espacios_c@getEspacios')->name('datatable.tespacios')->middleware('verified');

Route::post('registrare', 'Espacios_c@registrare')->middleware('verified');

Route::get('v_reg_espacios', 'Espacios_c@muestra_v')->name('v_reg_espacios')->middleware('verified');

Route::get('reg_espacios_v', function () {

    return view('r_espacios_v');
})->name('reg_espacios_v')->middleware('verified');

Route::post('/registrar', 'Componente_c@registrar')->middleware('verified');


Route::get('/', function () {
    return view('welcome');
});

Route::get('vistaCon', function () {
    return view('regis_compo');
})->middleware('verified');

Route::get('menu', 'Usuario_c@menu')->middleware('verified');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get("/Darpermisos","premisosController@darPermisos" )->middleware('verified');
Route::get("/PermisosEnviar","premisosController@asignar")->name("asignarPermiso")->middleware('verified');
Route::get("/Permisosmostrar","premisosController@mostrar")->name("mostrarPermisos")->middleware('verified');
Route::get("/Permisosquitar","premisosController@quitar")->name("quitarPermiso")->middleware('verified');

Route::get("/apartar","apartarEspaciosController@apartar")->middleware('verified');

Route::get("/guardarPeticion","apartarEspaciosController@insertar")->name("crearSolicitud")->middleware('verified');


Route::get("ApartarEspacio","apartarEspaciosController@crearApartandoEspacio")->name("ApartarEspacio")->middleware('verified');

Route::get("EventoComponente","EventoController@MostrarComponentes")->name('eventoComp')->middleware('verified');

Route::get("BusCategoria","EventoController@MostrarCategoria")->name("BusCategoria")->middleware('verified');

Route::get("BusCompo","EventoController@MostrarComp")->name("BusCompo")->middleware('verified');

Route::get("BusCantidad","EventoController@MostrarCantidad")->name("BusCantidad");
Route::get("addComponente","EventoController@addComponente")->name('addComponente')->middleware('verified');

Route::get("quitComponente","EventoController@quitComponente")->name('quitComponente')->middleware('verified');

Route::get("buscarHoras","EventoController@HorasOcupadas")->name('buscarHoras')->middleware('verified');


Route::get("holitas",function () {
    return view('holitas');
});

Route::get("holitasTest","EventoController@test")->name('holitasTest');
