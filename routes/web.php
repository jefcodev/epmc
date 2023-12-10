<?php
//use Illuminate\Support\Facades\Route;
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

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;


/* Route::get('/login','Front@index')->name('home'); */

Route::get('/', function () {
	return view('auth.login');
})->name('home');






/* Nuevas turas para turnero */

Route::get('/turnos/buscar', 'TurnosBuscar@buscar')->name('turnos.buscar');

/* Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('/turnos/buscar', 'TurnosBuscar@buscar')->name('turnos.buscar');
});
 */

Route::get('/requsitos', 'Front@requisitos')->name('requisitos');
Route::get('/formularios', 'Front@formularios')->name('formularios');
Route::get('/consultas', 'Front@consultas')->name('consultas');
Route::get('/solicitudes', 'Front@solicitudes')->name('solicitudes');
Route::get('/directorio', 'Front@directorio')->name('directorio');
Route::get('/administrativos', 'Front@administrativos')->name('administrativos');
Route::get('/quienes-somos', 'Front@quienes_somos')->name('quienes_somos');
Route::get('/lotaip', 'Front@lotaip')->name('lotaip');
Route::get('/testEmail', 'Front@testEmail')->name('testEmail');

//Uso de rate limiter, para las limitaciones de peticones ip
//throttle:Peticiones,minutos
//Route::middleware(['api', 'throttle:5,120'])->group(function () {
Route::get('/turnos', 'Front@seleccionSucursal')->name('turnero.seleccion');
Route::post('/turnos', 'Front@storeSeleccionSucursal')->name('turnero.seleccion.store');
//});


//Route::get('/sistema-turnos','Front@turnero')->name('turnero');

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('/perfil', 'Front@perfilUsuario')->name('perfil');
	Route::get('/turnero/{sucursal}', 'Front@turneroSucursal')->name('turnero');
	Route::get('/sistema-turnos/{id}', 'Front@print')->name('turnos.print');
	Route::get('/turno/{turno}', 'Front@generado')->name('turnos.generado');
	Route::post('/sistema-turnos/{sucursal_id}', 'Front@generar')->name('turnero.generar');
	Route::get('/turnos/reimpresion', 'Front@vistaReimpresion')->name('turnero.vista.reimpresion');
	Route::post('/turnos/reimpresion', 'Front@reimpresion')->name('turnero.reimpresion');
	Route::get('/stats_calendario/{fecha}', 'Front@stats_calendario')->name('turnero.stats');
});

//Route::get('/google_stats','Counters@google_stats')->name('google.stats');




Route::get('/validar_cedula/{cedula}', 'CedulaValidator@validar')->name('cedula');
Route::get('/validar_placa/{placa}', 'CedulaValidator@placa')->name('placa');

Route::get('/noticias', 'Front@noticias')->name('noticias');
Route::get('/noticia/{slug}', 'Front@noticia')->name('noticia');

Route::get('/documentos/{slug}', 'Front@documentos')->name('documentos');

Route::post('/placas', 'Front@placas')->name('placas.consultar');

Auth::routes(['verify' => true]);


//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::get('/', 'Back@index')->name('admin.home');

	Route::resource('/sliders', 'Sliders', ['except' => 'destroy']);
	Route::post('/slides/{id}', 'Sliders@destroy')->name('sliders.destroy');

	Route::resource('/generales', 'Generales');

	Route::resource('/miembros', 'Miembros', ['except' => 'destroy']);
	Route::post('/miembrs/{id}', 'Miembros@destroy')->name('miembros.destroy');

	Route::resource('/noticias', 'Noticias', ['except' => 'destroy']);
	Route::post('/noticis/{id}', 'Noticias@destroy')->name('noticias.destroy');

	Route::resource('/documentos', 'Documentos', ['except' => 'destroy']);
	Route::post('/documents/{id}', 'Documentos@destroy')->name('documentos.destroy');

	Route::resource('/categorias', 'Categorias', ['except' => 'destroy']);
	Route::post('/categoras/{id}', 'Categorias@destroy')->name('categorias.destroy');

	Route::resource('/articulos', 'Articulos', ['except' => 'destroy']);
	Route::post('/articuls/{id}', 'Articulos@destroy')->name('articulos.destroy');

	Route::resource('/periodos', 'Periodos', ['except' => 'destroy']);
	Route::post('/periods/{id}', 'Periodos@destroy')->name('periodos.destroy');

	Route::resource('/placas', 'Placas', ['except' => 'destroy']);
	Route::post('/placs/{id}', 'Placas@destroy')->name('placas.destroy');

	Route::get('/lotaip/{periodo?}', 'LotaipController@index')->name('lotaip.index');
	Route::post('/lotaip/enlazar', 'LotaipController@enlazar')->name('lotaip.enlazar');
	Route::post('/lotaip', 'LotaipController@store')->name('lotaip.store');
	Route::post('/lotaips/{id}', 'LotaipController@destroy')->name('lotaip.destroy');

	Route::get('/docs/dropdown', 'Documentos@dropdownGrouped')->name('documentos.dropdown');

	Route::resource('/consultas', 'Consultas', ['except' => 'destroy']);
	Route::post('/consults/{id}', 'Consultas@destroy')->name('consultas.destroy');

	Route::resource('/requisitos', 'Requisitos', ['except' => 'destroy']);
	Route::post('/requisits/{id}', 'Requisitos@destroy')->name('requisitos.destroy');

	Route::resource('/formularios', 'Formularios', ['except' => 'destroy']);
	Route::post('/formularis/{id}', 'Formularios@destroy')->name('formularios.destroy');

	Route::resource('/digitos', 'Digitos', ['only' => ['index', 'update', 'edit']]);

	Route::resource('/turnos', 'Turnos', ['except' => 'destroy']);
	Route::post('/turno/{id}', 'Turnos@destroy')->name('turnos.destroy');
	Route::get('/calendario/{sucursal_id}', 'Turnos@calendario')->name('turnos.calendario');
	Route::get('/turns/lisatdo/{sucursal_id}', 'Turnos@listado')->name('turnos.listado');
	Route::get('/turnero/config', 'Turnos@configs')->name('turnos.config');
	Route::get('/turnero/reportes', 'Turnos@reportes')->name('turnos.reportes');
	Route::post('/turnero/reportes', 'Turnos@exportar')->name('turnos.exportar');

	Route::resource('/sucursales', 'Sucursales', ['except' => 'destroy']);
	Route::get('/sucursal/{id}/turnero', 'Sucursales@configTurnero')->name('sucursales.turnero');
	Route::post('/sucursal/{id}/turnero', 'Sucursales@storeConfigTurnero')->name('sucursales.turnero.store');
	Route::post('/sucursales/{id}', 'Sucursales@destroy')->name('sucursales.destroy');

	Route::resource('/sucursal/{id}/dias_especiales', 'Dias', ['except' => 'destroy']);
	Route::post('/dias_especials/{id}', 'Dias@destroy')->name('dias_especiales.destroy');
	//Route::post('/sistema-turnos','Turnos@configs')->name('turnos.configurado');

	Route::resource('/usuarios', 'Usuarios', ['except' => 'destroy']);
	Route::post('/usuaris/{id}', 'Usuarios@destroy')->name('usuarios.destroy');

	Route::resource('/roles', 'Roles', ['except' => 'destroy']);
	Route::post('/rols/{id}', 'Roles@destroy')->name('roles.destroy');

	Route::get('/permisos', 'Permisos@index')->name('permisos.index');
});
