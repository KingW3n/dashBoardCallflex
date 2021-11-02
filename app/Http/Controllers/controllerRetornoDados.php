<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerRetornoDados extends Controller
{
    public function UserCount ()
    {
        return DB::table('wp_users')->count();
    }

    public function ActivityCount (string $condicao)
    {
        return DB::table('wp_bp_activity')->where('type','=', $condicao)->count();
    }

    public function DashboardCourseCount(string $condicao)
    {
        return DB::table('wp_dashboard_course')->where('Status','=', $condicao)->count();
    }

    public function AcessosTotalCount()
    {
        return DB::table('wp_plugin_log_user')->count();
    }

    public function AcessosHojeCount(string $dateTime)
    {
        return DB::table('wp_plugin_log_user')->where('DataHora','LIKE', '%' .$dateTime. '%')->count();
    }

    public function CursoCount (string $condicao)
    {
        return DB::table('wp_dashboard_course')->where('Status','=', $condicao)->count();
    }
    public function AcesosTimeLine (string $hoje,string $ultimaSemana, string $ultimoMes ,string $ano )
    {

        //retorna os acessos da ultima semana
        $resultadosArray[] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($ultimaSemana,$hoje))->count();

        //retorna os acessos do ultimo mês
        $resultadosArray[] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($ultimoMes,$hoje))->count();

        //retorna os acessos do primeiro semestre
        $resultadosArray[] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($ano.'-01-01', $ano.'-06-30'))->count();

        //retorna os acessos do segundo semestre
        $resultadosArray[] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($ano.'-07-01', $ano.'-12-31'))->count();

        //retorna os acessos do ano
        $resultadosArray[] = DB::table('wp_plugin_log_user')->where('DataHora','LIKE', '%' .$ano. '%')->count();

        return $resultadosArray;

    }
}
