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
                if($request->session()->get('categoria')==0){
                    switch ($request->session()->get('filtroTempo')) {
                        case 'AL':
                            $retornoTd = DB::table('wp_users')->select('display_name','user_nicename', 'user_email','user_registered')->get();
                        break;
                        case 'RH':
                            $data = Date("Y-m-d");
                            $retornoTd = DB::table('wp_users')->where('user_registered','LIKE','%'.$data.'%')->select('display_name','user_nicename', 'user_email','user_registered')->get();
                        break;
                        case 'US':
                            $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
                            $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
                            $retornoTd = DB::table('wp_users')->whereBetween('user_registered',array($data,$data2))->select('display_name','user_nicename', 'user_email','user_registered')->get();
                        break;
                        case 'PM':
                            $data =$request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
                            $retornoTd = DB::table('wp_users')->where('user_registered','LIKE','%'.$data.'%')->select('display_name','user_nicename', 'user_email','user_registered')->get();
                        break;
                        case 'PA':
                            $data =$request->session()->get('filtroAno');
                            $retornoTd = DB::table('wp_users')->where('user_registered','LIKE','%'.$data.'%')->select('display_name','user_nicename', 'user_email','user_registered')->get();
                        break;
                        case 'PL':
                            $data = $request->session()->get('filtrodataInicioBusca');
                            $data2 = $request->session()->get('filtrodataFimBusca');
                            $retornoTd = DB::table('wp_users')->whereBetween('user_registered',array($data,$data2))->select('display_name','user_nicename', 'user_email','user_registered')->get();
                        break;
                    }
                }else{

                }
                $tituloTable = ['','Nome','UserName','E-mail','Data do cadastro'];
                $tipo="Usuarios Cadastrados";
            break;
            case 'viewInscricoesEmCurso':
                if($request->session()->get('categoria')==0){
                    switch ($request->session()->get('filtroTempo')) {
                        case 'AL':
                            $retornoTd = DB::table('wp_bp_activity as a')->where('a.type','=', 'subscribe_course')->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
                        break;
                        case 'RH':
                            $data = Date("Y-m-d");
                            $retornoTd = DB::table('wp_bp_activity as a')->where('a.type','=', 'subscribe_course')->where('a.date_recorded','LIKE','%'.$data.'%')->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
                        break;
                        case 'US':
                            $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
                            $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
                            $retornoTd = DB::table('wp_bp_activity as a')->where('a.type','=', 'subscribe_course')->whereBetween('a.date_recorded',array($data,$data2))->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
                        break;
                        case 'PM':
                            $data =$request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
                            $retornoTd = DB::table('wp_bp_activity as a')->where('a.type','=', 'subscribe_course')->where('a.date_recorded','LIKE','%'.$data.'%')->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
                        break;
                        case 'PA':
                            $data =$request->session()->get('filtroAno');
                            $retornoTd = DB::table('wp_bp_activity as a')->where('a.type','=', 'subscribe_course')->where('a.date_recorded','LIKE','%'.$data.'%')->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
                        break;
                        case 'PL':
                            $data = $request->session()->get('filtrodataInicioBusca');
                            $data2 = $request->session()->get('filtrodataFimBusca');
                            $retornoTd = DB::table('wp_bp_activity as a')->where('a.type','=', 'subscribe_course')->whereBetween('a.date_recorded',array($data,$data2))->leftJoin('wp_users as b','b.ID','=','a.user_id')->leftJoin('wp_dashboard_course as c','id_course','=','a.item_id')->select('b.display_name','b.user_nicename', 'b.user_email','c.course','a.date_recorded')->get();
                        break;
                    }
                }else{


                    //tentar o when https://www.itsolutionstuff.com/post/laravel-eloquent-when-condition-exampleexample.html para funcionarios
                }
                $tituloTable = ['','Nome do Aluno','UserName do Aluno','E-mail','Curso inscrito','Data da inscrição'];
                $tipo="Inscrições em curso";
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
