<?php

namespace App\Http\Controllers;

use App\Models\wp_users;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class controllerdashBoard extends Controller
{
    public function index(controllerBancoDados $banco,Request $request)
    {
        if($request->session()->get('logado')){
            $banco->atualizarTabelaCursos();
            $banco->criarTabelaBanco();
            $banco->DefinirAdminPadrao();
            //configura data para horario de São paulo;
            $dataHoje = Date("Y-m-d");

            //Subtrai mais 1 dia para o betwenn
            $dataHojeMUm  = date('Y-m-d', strtotime($dataHoje. ' +1 days'));

            //subtrai 7 e 30 dias da data atual
            $dataSemana  = date('Y-m-d', strtotime($dataHoje. ' -8 days'));
            $dataMes  = date('Y-m-d', strtotime($dataHoje. ' -31 days'));

            //puxa o total de acessos em timeLine
            $timelineAcessos = $banco->AcesosTimeLine($dataHojeMUm, $dataSemana, $dataMes,Date("Y") );
            $request->session()->put('categoria','0');
            $request->session()->put('filtroTempo','AL');
            $request->session()->put('filtroMes','');
            $request->session()->put('filtroMesAno','');
            $request->session()->put('filtroAno','');
            $request->session()->put('filtrodataInicioBusca','');
            $request->session()->put('filtrodataFimBusca','');
            return view('dashBoard.index')
            ->with('DadosUser', $banco->DadosUser($request->session()->get('email')))
            ->with('user', $banco->UserCount())
            ->with('certificado', $banco->ActivityCount("student_certificate"))
            ->with('inscricao', $banco->ActivityCount("subscribe_course"))
            ->with('cursos', $banco->DashboardCourseCount("Ativo"))
            ->with('acessoTotal', $banco->AcessosTotalCount())
            ->with('acessoHoje', $banco->AcessosHojeCount($dataHoje))
            ->with('cursosPublicados', $banco->CursoCount("Ativo"))
            ->with('cursosDespublicados',  $banco->CursoCount("Desativado"))
            ->with('acessosSemana', $timelineAcessos[0])
            ->with('acessosMes', $timelineAcessos[1])
            ->with('acessosPrimeiroSemestre', $timelineAcessos[2])
            ->with('acessosSegndoSemestre', $timelineAcessos[3])
            ->with('acessosAno', $timelineAcessos[4])
            ->with('dadosCategoria', $banco->DadosCategoria())
            ->with('AnosDosAcessos', $this->Count5_Value());

        }else{
            return redirect()->route('indexLogin');
        }
    }

    public function Count5_Value (){
        $banco = new controllerBancoDados ;
        $ArrayAcesosAnos = [];
        $dataHoje = Date("Y-m-d");
        for ($i= date('Y', strtotime($dataHoje. ' -4 year')); $i <= Date("Y"); $i++) {
            $ArrayAcesosAnos[] =array(
                "Ano" =>$i,
                "Acessos"=>$banco->AcessosHojeCount($i)
            );
        }
        return $ArrayAcesosAnos;
    }



}
