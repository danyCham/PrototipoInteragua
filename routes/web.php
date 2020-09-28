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

Route::get('/', function () {
    return view('welcome');
}); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/user', 'UsuarioController@index')->name('usuario.consultar');

Route::get('login/{driver}','Auth\LoginController@redirectToProvider');
Route::get('login/{driver}/callback','Auth\LoginController@handleProviderCallback');

Route::get('reports/reportTemplate/{rep_type}','FileController@ReportPageController');
Route::get('/pdfGenerateFile/{tipo_reporte}','FileController@PDFGenerate')->name('pdfGenerate');
Route::get('/csvGenerateFile/{tipo_reporte}','FileController@CSVGenerate')->name('csvGenerate');

Route::post('reports/reportTemplate/{rep_type}','FileController@ReportPageFilteredController')->name('rutaPrueba');