<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class controllerRelatorioTable extends Controller
{
    public function index(Request $request,controllerRetornoDados $retornoDados)
    {   switch ($request->view) {
            case 'viewUsuarioCadastrados':
                if($request->session()->get('categoria')==0){
                    switch ($request->session()->get('filtroTempo')) {
                        case 'AL':
                            $tituloTable = ['','Nome','UserName','E-mail','Data do cadastro'];
                            $retornoTd = DB::table('wp_users')->select('display_name','user_nicename', 'user_email','user_registered')->get();
                            $tipo="Usuarios Cadastrados";
                        break;
                        case 'RH':

                        break;
                        case 'US':

                        break;
                        case 'PM':

                        break;
                        case 'PA':

                        break;
                        case 'PL':

                        break;
                    }
                }else{

                }

            break;
            case 'viewInscricoesEmCurso':

            break;
            case 'viewCertificadosEmitidos':

            break;
            case 'viewCursospublicados':

            break;
            case 'viewAcessoTotal':

            break;
            case 'viewAcessoHoje':

            break;
        }
        return view('Table.index')
        ->with('Title',$tituloTable)
        ->with('coteudoTable',$retornoTd)
        ->with('tipo',$tipo)
        ->with('DadosUser', $retornoDados->DadosUser($request->session()->get('email')));
    }
}
