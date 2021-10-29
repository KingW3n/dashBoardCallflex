<?php

namespace App\Http\Controllers;

use App\Models\wp_users;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class controllerdashBoard extends Controller
{
    public function index(controllerRetornoDados $retornoDados)
    {
        //configura data para horario de São paulo;
        date_default_timezone_set('America/Sao_Paulo');
        $dataHoje = Date("Y-m-d");

        //Subtrai menos 1 para o betwenn
        $dataHojeMUm  = date('Y-m-d', strtotime($dataHoje. ' +1 days'));

        //subtrai 7 e 30 dias da data atual
        $dataSemana  = date('Y-m-d', strtotime($dataHoje. ' -8 days'));
        $dataMes  = date('Y-m-d', strtotime($dataHoje. ' -31 days'));

        //puxa o total de acessos em timeLine
        $timelineAcessos = $retornoDados->AcesosTimeLine($dataHojeMUm, $dataSemana, $dataMes,Date("Y") );

        return view('dashBoard.index')
        ->with('user', $retornoDados->UserCount())
        ->with('certificado', $retornoDados->ActivityCount("student_certificate"))
        ->with('inscricao', $retornoDados->ActivityCount("subscribe_course"))
        ->with('cursos', $retornoDados->DashboardCourseCount("Ativo"))
        ->with('acessoTotal', $retornoDados->AcessosTotalCount())
        ->with('acessoHoje', $retornoDados->AcessosHojeCount($dataHoje))
        ->with('cursosPublicados', $retornoDados->CursoCount("Ativo"))
        ->with('cursosDespublicados',  $retornoDados->CursoCount("Desativado"))
        ->with('acessosSemana', $timelineAcessos[0])
        ->with('acessosMes', $timelineAcessos[1])
        ->with('acessosPrimeiroSemestre', $timelineAcessos[2])
        ->with('acessosSegndoSemestre', $timelineAcessos[3])
        ->with('acessosAno', $timelineAcessos[4]);
    }
}
