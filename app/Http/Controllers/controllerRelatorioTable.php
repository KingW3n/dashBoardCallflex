<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class controllerRelatorioTable extends Controller
{
    public function index(Request $request,controllerBancoDados $banco)
    {
        if(!$request->session()->get('logado')){
            return redirect()->route('indexLogin');
        }
        $retornoTd = "";
        switch ($request->view) {
            case 'viewUsuarioCadastrados':
                $retornoTd = $banco->viewUsuarioCadastrados($request);
                $tituloTable = ['','Nome','UserName','E-mail','Data do cadastro'];
                $tipo="Usuarios Cadastrados";
            break;
            case 'viewInscricoesEmCurso':
                $retornoTd = $banco->RetornoTabelaActivity($request,'subscribe_course');
                $tituloTable = ['','Nome do Aluno','UserName do Aluno','E-mail','Curso inscrito','Data da inscrição'];
                $tipo="Inscrições em curso";
            break;
            case 'viewCertificadosEmitidos':
                $retornoTd = $banco->RetornoTabelaActivity($request,'student_certificate');
                $tituloTable = ['','Nome do Aluno','UserName do Aluno','E-mail','Curso inscrito','Data da inscrição'];
                $tipo="Certificados Emitidos";
            break;
            case 'viewCursospublicados':
                $retornoTd = $banco->viewCursospublicados($request);
                $tituloTable = ['','Cod do Curso','Nome do Curso','Duração do Curso'];
                $tipo="Cursos Publicados";
            break;
            case 'viewAcessoTotal':
                $retornoTd = $banco->viewAcessoTotal($request);
                $tituloTable = ['','Nome','UserName','E-mail','Data/Hora do Acesso '];
                $tipo="Acessos";
            break;
            case 'viewAcessoHoje':
                $data = Date("Y-m-d");
                $retornoTd = $banco->viewAcessoHoje($request, $data);
                $tituloTable = ['','Nome','UserName','E-mail','Data/Hora do Acesso '];
                $tipo="Acessos Hoje";
            break;
        }
        return view('Table.index')
        ->with('Title',$tituloTable)
        ->with('coteudoTable',$retornoTd)
        ->with('tipo',$tipo)
        ->with('DadosUser', $banco->DadosUser($request->session()->get('email')));
    }

    public function retornaTable(Request $request, controllerBancoDados $banco)
    {
        $arryDadosExibir = [];
        switch ($request->view) {
            case 'viewUsuarioCadastrados':
                foreach ($banco->viewUsuarioCadastrados($request) as $value){
                    $arryDadosExibir[] = array(
                        "display_name"=> $value->display_name,
                        "user_nicename"=>$value->user_nicename,
                        "user_email"=>$value->user_email,
                        "user_registered"=> \Carbon\Carbon::parse($value->user_registered)->format('d/m/Y H:i:s')
                    );
                }
                return json_encode($arryDadosExibir);
            break;
            case 'viewInscricoesEmCurso':
                foreach ($banco->RetornoTabelaActivity($request,'subscribe_course') as $value){
                    $arryDadosExibir[] = array(
                        "display_name"=> $value->display_name,
                        "user_nicename"=>$value->user_nicename,
                        "user_email"=>$value->user_email,
                        "course"=>$value->course,
                        "date_recorded"=> \Carbon\Carbon::parse($value->date_recorded)->format('d/m/Y H:i:s')
                    );
                }
                return json_encode($arryDadosExibir);
            break;
            case 'viewCertificadosEmitidos':
                foreach ($banco->RetornoTabelaActivity($request,'student_certificate') as $value){
                    $arryDadosExibir[] = array(
                        "display_name"=> $value->display_name,
                        "user_nicename"=>$value->user_nicename,
                        "user_email"=>$value->user_email,
                        "course"=>$value->course,
                        "date_recorded"=> \Carbon\Carbon::parse($value->date_recorded)->format('d/m/Y H:i:s')
                    );
                }
                return json_encode($arryDadosExibir);
            break;
            case 'viewCursospublicados':
                return json_encode($banco->viewCursospublicados($request));
            break;
            case 'viewAcessoTotal':
                foreach ($banco->viewAcessoTotal($request) as $value){
                    $arryDadosExibir[] = array(
                        "display_name"=> $value->display_name,
                        "user_nicename"=>$value->user_nicename,
                        "user_email"=>$value->user_email,
                        "DataHora"=> \Carbon\Carbon::parse($value->DataHora)->format('d/m/Y H:i:s')
                    );
                }
                return json_encode($arryDadosExibir);
            break;
            case 'viewAcessoHoje':
                $data = Date("Y-m-d");
                foreach ($banco->viewAcessoHoje($request, $data) as $value){
                    $arryDadosExibir[] = array(
                        "display_name"=> $value->display_name,
                        "user_nicename"=>$value->user_nicename,
                        "user_email"=>$value->user_email,
                        "DataHora"=> \Carbon\Carbon::parse($value->DataHora)->format('d/m/Y H:i:s')
                    );
                }
                return json_encode($arryDadosExibir);
            break;
        }
    }



}
