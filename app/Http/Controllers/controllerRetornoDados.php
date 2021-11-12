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

    public function DadosCategoria ()
    {
        return DB::table('wp_plugin_categoria_users')->orderBy('status','ASC')->orderBy('categoria','ASC')->get();
    }

    public function DadosUser(string $email)
    {
        return DB::table('wp_plugin_usersadm_login')
        ->where('user_email','=',$email)
        ->join('wp_users','wp_users.user_email','=','wp_plugin_usersadm_login.email')
        ->select('wp_plugin_usersadm_login.*','wp_users.display_name as nome')->first();
    }

    public function VerificarEmailCode(string $email)
    {
        return DB::table('wp_plugin_usersadm_login')
        ->where('email','=',$email)->count();
    }

    public function AllCont($funcionario)
    {
        if($funcionario == 0){
            $resposta['users'] = $this->UserCount();
            $resposta['student_certificate']= $this->ActivityCount("student_certificate");
            $resposta['subscribe_course'] = $this->ActivityCount("subscribe_course");
            $resposta['Cursos_ativos'] = $this->DashboardCourseCount("Ativo");
            $resposta['Cursos_desativados'] = $this->DashboardCourseCount("Desativado");
            $resposta['Acessos'] = $this->AcessosTotalCount();
        }else{

            $resposta['users'] = DB::table('wp_users')
            ->join('wp_plugin_tbaux_user_catetoria','users.ID','=','wp_plugin_tbaux_user_catetoria.ID_user')
            ->join('wp_plugin_tbaux_user_catetoria','wp_plugin_tbaux_user_catetoria.ID_categoria','=',$funcionario)->count();

            $resposta['student_certificate']= DB::table('wp_bp_activity')->where('type','=', 'student_certificate')
            ->join('wp_plugin_tbaux_user_catetoria','student_certificate.user_id','=','wp_plugin_tbaux_user_catetoria.ID_user')
            ->join('wp_plugin_tbaux_user_catetoria','wp_plugin_tbaux_user_catetoria.ID_categoria','=',$funcionario)->count();

            $resposta['subscribe_course'] = DB::table('wp_bp_activity')->where('type','=', 'subscribe_course')
            ->join('wp_plugin_tbaux_user_catetoria','student_certificate.user_id','=','wp_plugin_tbaux_user_catetoria.ID_user')
            ->join('wp_plugin_tbaux_user_catetoria','wp_plugin_tbaux_user_catetoria.ID_categoria','=',$funcionario)->count();

            $resposta['Cursos_ativos'] = $this->DashboardCourseCount("Ativo");
            $resposta['Acessos'] = $this->AcessosTotalCount();
        }


        return $resposta;
    }
    public function LikeDateCont($funcionario,$data)
    {
        if($funcionario == 0){
            $resposta['users'] = DB::table('wp_users')->where('user_registered','LIKE','%'.$data.'%')->count();
            $resposta['student_certificate'] = DB::table('wp_bp_activity')->where('type','=', 'student_certificate')->where('date_recorded','LIKE','%'.$data.'%')->count();
            $resposta['subscribe_course'] = DB::table('wp_bp_activity')->where('type','=', 'subscribe_course')->where('date_recorded','LIKE','%'.$data.'%')->count();
            $resposta['Cursos_ativos'] = DB::table('wp_dashboard_course')->where('Status','=', 'Ativo')->where('data_Create','LIKE','%'.$data.'%')->count();
            $resposta['Acessos'] = DB::table('wp_plugin_log_user')->where('DataHora','LIKE','%'.$data.'%')->count();
        }else{

        }

        return $resposta;
    }

    public function BetweenCont($funcionario,$data,$data2)
    {
        if($funcionario == 0){
            $resposta['users'] = DB::table('wp_users')->whereBetween('user_registered',array($data,$data2))->count();
            $resposta['student_certificate']= DB::table('wp_bp_activity')->where('type','=', 'student_certificate')->whereBetween('date_recorded',array($data, $data2))->count();
            $resposta['subscribe_course'] = DB::table('wp_bp_activity')->where('type','=', 'subscribe_course')->whereBetween('date_recorded',array($data, $data2))->count();
            $resposta['Cursos_ativos'] = DB::table('wp_dashboard_course')->where('Status','=', 'Ativo')->whereBetween('data_Create',array($data,$data2))->count();
            $resposta['Acessos'] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($data,$data2))->count();
        }else{

        }
        return $resposta;
    }

}
