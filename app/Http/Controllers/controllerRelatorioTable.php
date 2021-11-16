<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class controllerRelatorioTable extends Controller
{
    public function index(Request $request,controllerRetornoDados $retornoDados)
    {
        if(!$request->session()->get('logado')){
            return redirect()->route('indexLogin');
        }
        $retornoTd = "";
        switch ($request->view) {
            case 'viewUsuarioCadastrados':
                $retornoTd = DB::table('wp_users as u')
                ->when($request->session()->get('categoria') !=0 , function ($query) use ($request){
                    $query->join('wp_plugin_tbaux_user_catetoria as z','u.ID','=','z.ID_user')->join('wp_plugin_tbaux_user_catetoria as z','z.ID_categoria', '=' ,$request->session()->get('categoria'));

                })->when($request->session()->get('filtroTempo') == 'RH',function ($query) use ($request){
                    $data = Date("Y-m-d");
                    $query->where('u.user_registered','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'US',function ($query) use ($request){
                    $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
                    $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
                    $query->whereBetween('u.user_registered',array($data,$data2));

                })->when($request->session()->get('filtroTempo') == 'PM',function ($query) use ($request){
                    $data =$request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
                    $query->where('u.user_registered','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'PA',function ($query) use ($request){
                    $data =$request->session()->get('filtroAno');
                    $query->where('u.user_registered','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'PL',function ($query) use ($request){
                    $data = $request->session()->get('filtrodataInicioBusca');
                    $data2 = $request->session()->get('filtrodataFimBusca');
                    $query->whereBetween('u.user_registered',array($data,$data2));

                })->select('u.display_name','u.user_nicename', 'u.user_email','u.user_registered')->get();
                $tituloTable = ['','Nome','UserName','E-mail','Data do cadastro'];
                $tipo="Usuarios Cadastrados";
            break;
            case 'viewInscricoesEmCurso':
                $retornoTd = $this->RetornoTabelaActivity($request,'subscribe_course');
                $tituloTable = ['','Nome do Aluno','UserName do Aluno','E-mail','Curso inscrito','Data da inscrição'];
                $tipo="Inscrições em curso";
            break;
            case 'viewCertificadosEmitidos':
                $retornoTd = $this->RetornoTabelaActivity($request,'student_certificate');
                $tituloTable = ['','Nome do Aluno','UserName do Aluno','E-mail','Curso inscrito','Data da inscrição'];
                $tipo="Certificados Emitidos";
            break;
            case 'viewCursospublicados':
                $retornoTd = DB::table('wp_dashboard_course')->where('Status','=','Ativo')
                ->when($request->session()->get('filtroTempo') == 'RH',function ($query) use ($request){
                    $data = Date("Y-m-d");
                    $query->where('data_Create','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'US',function ($query) use ($request){
                    $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
                    $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
                    $query->whereBetween('data_Create',array($data,$data2));

                })->when($request->session()->get('filtroTempo') == 'PM',function ($query) use ($request){
                    $data =$request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
                    $query->where('data_Create','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'PA',function ($query) use ($request){
                    $data =$request->session()->get('filtroAno');
                    $query->where('data_Create','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'PL',function ($query) use ($request){
                    $data = $request->session()->get('filtrodataInicioBusca');
                    $data2 = $request->session()->get('filtrodataFimBusca');
                    $query->whereBetween('data_Create',array($data,$data2));

                })->select('id_course','course', 'duracao')->get();
                $tituloTable = ['','Cod do Curso','Nome do Curso','Duração do Curso'];
                $tipo="Cursos Publicados";
            break;
            case 'viewAcessoTotal':
                $retornoTd = DB::table('wp_plugin_log_user as l')->leftJoin('wp_users as u','l.ID_user','=','u.ID' )
                ->when($request->session()->get('categoria') !=0 , function ($query) use ($request){
                    $query->join('wp_plugin_tbaux_user_catetoria as z','l.ID_user','=','z.ID_user')->join('wp_plugin_tbaux_user_catetoria as z','z.ID_categoria', '=' ,$request->session()->get('categoria'));

                })->when($request->session()->get('filtroTempo') == 'RH',function ($query) use ($request){
                    $data = Date("Y-m-d");
                    $query->where('DataHora','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'US',function ($query) use ($request){
                    $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
                    $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
                    $query->whereBetween('DataHora',array($data,$data2));

                })->when($request->session()->get('filtroTempo') == 'PM',function ($query) use ($request){
                    $data =$request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
                    $query->where('DataHora','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'PA',function ($query) use ($request){
                    $data =$request->session()->get('filtroAno');
                    $query->where('DataHora','LIKE','%'.$data.'%');

                })->when($request->session()->get('filtroTempo') == 'PL',function ($query) use ($request){
                    $data = $request->session()->get('filtrodataInicioBusca');
                    $data2 = $request->session()->get('filtrodataFimBusca');
                    $query->whereBetween('DataHora',array($data,$data2));

                })->select('u.display_name','u.user_nicename', 'u.user_email','l.DataHora')->get();
                $tituloTable = ['','Nome','UserName','E-mail','Data/Hora do Acesso '];
                $tipo="Acessos";
            break;
            case 'viewAcessoHoje':
                $data = Date("Y-m-d");
                $retornoTd = DB::table('wp_plugin_log_user as l')->where('DataHora','LIKE','%'.$data.'%')->leftJoin('wp_users as u','l.ID_user','=','u.ID' )
                ->when($request->session()->get('categoria') !=0 , function ($query) use ($request){
                    $query->join('wp_plugin_tbaux_user_catetoria as z','l.ID_user','=','z.ID_user')->join('wp_plugin_tbaux_user_catetoria as z','z.ID_categoria', '=' ,$request->session()->get('categoria'));
                })->select('u.display_name','u.user_nicename', 'u.user_email','l.DataHora')->get();

                $tituloTable = ['','Nome','UserName','E-mail','Data/Hora do Acesso '];
                $tipo="Acessos Hoje";
            break;
        }
        return view('Table.index')
        ->with('Title',$tituloTable)
        ->with('coteudoTable',$retornoTd)
        ->with('tipo',$tipo)
        ->with('DadosUser', $retornoDados->DadosUser($request->session()->get('email')));
    }

    public function RetornoTabelaActivity($request, $tipo)
    {
       return DB::table('wp_bp_activity as a')->where('a.type','=', $tipo)
       ->when($request->session()->get('categoria') !=0 , function ($query) use ($request){
           $query->join('wp_plugin_tbaux_user_catetoria as z','a.user_id','=','z.ID_user')->join('wp_plugin_tbaux_user_catetoria as z','z.ID_categoria', '=' ,$request->session()->get('categoria'));

       })->when($request->session()->get('filtroTempo') == 'RH',function ($query) use ($request){
           $data = Date("Y-m-d");
           $query->where('a.date_recorded','LIKE','%'.$data.'%');

       })->when($request->session()->get('filtroTempo') == 'US',function ($query) use ($request){
           $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
           $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
           $query->whereBetween('a.date_recorded',array($data,$data2));

       })->when($request->session()->get('filtroTempo') == 'PM',function ($query) use ($request){
           $data =$request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
           $query->where('a.date_recorded','LIKE','%'.$data.'%');

       })->when($request->session()->get('filtroTempo') == 'PA',function ($query) use ($request){
           $data =$request->session()->get('filtroAno');
           $query->where('a.date_recorded','LIKE','%'.$data.'%');

       })->when($request->session()->get('filtroTempo') == 'PL',function ($query) use ($request){
           $data = $request->session()->get('filtrodataInicioBusca');
           $data2 = $request->session()->get('filtrodataFimBusca');
           $query->whereBetween('a.date_recorded',array($data,$data2));

       })->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
    }
}
