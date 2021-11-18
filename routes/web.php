<?php

use App\Http\Controllers;
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
Route::get('/', 'App\Http\Controllers\controllerdashBoard@index')->name('home');
Route::post('/', 'App\Http\Controllers\controllerdashBoard@Count5Anos')->name('Count5Anos');
Route::get('/login', 'App\Http\Controllers\controllerLogin@index')->name('indexLogin');
Route::post('/login', 'App\Http\Controllers\controllerLogin@realizarLogin')->name('realizarLogin');
Route::match(['get', 'post'], '/login/deslog','App\Http\Controllers\controllerLogin@Realizarlogout')->name('Realizarlogout');
Route::get('/forgot','App\Http\Controllers\controllerForgot@index')->name('forgot');
Route::post('/forgot','App\Http\Controllers\controllerForgot@enviarCode')->name('enviarCode');
Route::get('/forgot/code','App\Http\Controllers\controllerForgot@enterCode')->name('enterCode');
Route::post('/forgot/code','App\Http\Controllers\controllerForgot@verificarCode')->name('verificarCode');
Route::get('/forgot/code/nova/senha','App\Http\Controllers\controllerForgot@NewSenha')->name('NewSenha');
Route::post('/forgot/code/nova/senha','App\Http\Controllers\controllerForgot@cadastrarNewSenha')->name('cadastrarNewSenha');
Route::post('/filtro','App\Http\Controllers\controllerFiltroDashboard@index')->name('FiltroDashboard');
Route::get('/relatorio/{view}','App\Http\Controllers\controllerRelatorioTable@index')->name('RelatorioTable');
Route::post('/table/{view}','App\Http\Controllers\controllerRelatorioTable@retornaTable')->name('retornaTable');
