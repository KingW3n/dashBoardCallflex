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

//Rotas relacionadas ao login do usuario
Route::get('/login', 'App\Http\Controllers\controllerLogin@index')->name('indexLogin');
Route::post('/login', 'App\Http\Controllers\controllerLogin@realizarLogin')->name('realizarLogin');

//rotas recuperar senha
Route::match(['get', 'post'], '/login/deslog','App\Http\Controllers\controllerLogin@Realizarlogout')->name('Realizarlogout');
Route::get('/forgot','App\Http\Controllers\controllerForgot@index')->name('forgot');
Route::post('/forgot','App\Http\Controllers\controllerForgot@enviarCode')->name('enviarCode');
Route::get('/forgot/code','App\Http\Controllers\controllerForgot@enterCode')->name('enterCode');
Route::post('/forgot/code','App\Http\Controllers\controllerForgot@verificarCode')->name('verificarCode');
Route::get('/forgot/code/nova/senha','App\Http\Controllers\controllerForgot@NewSenha')->name('NewSenha');
Route::post('/forgot/code/nova/senha','App\Http\Controllers\controllerForgot@cadastrarNewSenha')->name('cadastrarNewSenha');

//rota filtro do dashboard
Route::post('/filtro','App\Http\Controllers\controllerFiltroDashboard@index')->name('FiltroDashboard');

//rotas relacionadas a tabela.
Route::get('/relatorio/{view}','App\Http\Controllers\controllerRelatorioTable@index')->name('RelatorioTable');
Route::post('/table/{view}','App\Http\Controllers\controllerRelatorioTable@retornaTable')->name('retornaTable');

//rotas da categoria de usuarios
Route::get('/categoria/cadastro','App\Http\Controllers\controllerCategoriaCadastro@index')->name('viewCadastroCategoria');
Route::post('/categoria/cadastro/salvar','App\Http\Controllers\controllerCategoriaCadastro@salvar');

//rotas de ativar/desativar categorias
Route::get('/categoria','App\Http\Controllers\controllerCategoria@viewIndex')->name('viewIndex');



Route::get('/categoria/view','App\Http\Controllers\controllerCategoria@index')->name('viewCategoria');
Route::Post('/categoria/view','App\Http\Controllers\controllerCategoria@salvar')->name('salvarCategoria');
Route::Post('/categoria/view/atualizar-dados/pessoas','App\Http\Controllers\controllerCategoria@retornarPessoasCategorias');
Route::Post('/categoria/view/atualizar-dados/retornarDadosAll','App\Http\Controllers\controllerCategoria@retornarDadosAll');
Route::Post('/categoria/view/atualizar-dados','App\Http\Controllers\controllerCategoria@retornarDados');
Route::Post('/categoria/grupo-usuario/view','App\Http\Controllers\controllerCategoria@removerUsuarioCategoria');
Route::Post('/categoria/grupo-usuario/view/users','App\Http\Controllers\controllerCategoria@retornarUsuarioAdicionar');
Route::Post('/categoria/grupo-usuario/salvar/usuarioCategoria','App\Http\Controllers\controllerCategoria@salvarUsuarioCategoria');
Route::post('/categoria/grupo-usuario/cadastro/salvar','App\Http\Controllers\controllerCategoria@salvarCategoria');
Route::post('/categoria/grupo-usuario/mudar-status','App\Http\Controllers\controllerCategoria@alterarStatus');
Route::post('/categoria/grupo-usuario/excluir','App\Http\Controllers\controllerCategoria@excluirCategoria');




///Convite

Route::post('/convite','App\Http\Controllers\controllerConvidarUser@eniarConvite');
Route::get('/convite/cadastro/{emailencripty}','App\Http\Controllers\controllerConvidarUser@viewCadastro');
Route::post('/convite/cadastro/salvar','App\Http\Controllers\controllerConvidarUser@salvarNewCadastro')->name('salvarNewCadastro');


//Gestão de usuario
Route::get('/gestao-de-user','App\Http\Controllers\controllerGestaoUser@index')->name('viewGestaodeUser');
Route::post('/gestao-de-user/remover-admin-user','App\Http\Controllers\controllerGestaoUser@removerAdminUser');
Route::post('/gestao-de-user/atribuir-admin-user','App\Http\Controllers\controllerGestaoUser@atribuirAdminUser');
Route::post('/gestao-de-user/remover-acesso-user','App\Http\Controllers\controllerGestaoUser@removerAcessoUser');




