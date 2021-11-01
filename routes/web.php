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
