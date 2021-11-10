<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;



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
