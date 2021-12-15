<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class controllerBancoDados extends Controller
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

    public function VerifiqueUserConvite(string $email)
    {
        return DB::table('wp_users')
        ->where('user_email','=',$email)->first();
    }

    public function VerificarEmailCode(string $email)
    {
        return DB::table('wp_plugin_usersadm_login')->where('email','=',$email)->count();
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
            $resposta['AcessosHoje'] = $this->AcessosHojeCount(Date("Y-m-d"));
        }else{
            $resposta['users'] = count(DB::select('select u.ID FROM wp_users u, wp_plugin_tbaux_user_catetoria z where u.ID = z.ID_user and z.ID_categoria = ?', [$funcionario]));
            $resposta['student_certificate']= count(DB::select("SELECT b.id FROM wp_bp_activity b, wp_plugin_tbaux_user_catetoria z  WHERE b.user_id = z.ID_user and z.ID_categoria = ? and  type='student_certificate'", [$funcionario]));
            $resposta['subscribe_course'] = count(DB::select("SELECT b.id FROM wp_bp_activity b, wp_plugin_tbaux_user_catetoria z  WHERE b.user_id = z.ID_user and z.ID_categoria = ? and  type='subscribe_course'", [$funcionario]));
            $resposta['Cursos_ativos'] = $this->DashboardCourseCount("Ativo");
            $resposta['Cursos_desativados'] = $this->DashboardCourseCount("Desativado");
            $resposta['Acessos'] = count(DB::select("SELECT l.ID FROM wp_plugin_log_user l, wp_plugin_tbaux_user_catetoria z  WHERE l.ID_user = z.ID_user and z.ID_categoria = ? ", [$funcionario]));
            $resposta['AcessosHoje'] = count(DB::select("SELECT l.ID FROM wp_plugin_log_user l, wp_plugin_tbaux_user_catetoria z  WHERE l.ID_user = z.ID_user and z.ID_categoria = ? and l.DataHora LIKE '%".Date("Y-m-d")."%' ", [$funcionario]));

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
            $resposta['Cursos_desativados'] = DB::table('wp_dashboard_course')->where('Status','=', 'Desativado')->where('data_Create','LIKE','%'.$data.'%')->count();
            $resposta['Acessos'] = DB::table('wp_plugin_log_user')->where('DataHora','LIKE','%'.$data.'%')->count();
            $resposta['AcessosHoje'] = $this->AcessosHojeCount(Date("Y-m-d"));
        }else{
            $resposta['users'] = count(DB::select('select u.ID FROM wp_users u, wp_plugin_tbaux_user_catetoria z where u.ID = z.ID_user and z.ID_categoria = ? and u.user_registered LIKE "%'.$data.'%" ', [$funcionario]));
            $resposta['student_certificate']= count(DB::select('SELECT b.id FROM wp_bp_activity b, wp_plugin_tbaux_user_catetoria z  WHERE b.user_id = z.ID_user and z.ID_categoria = ? and  type="student_certificate" and b.date_recorded LIKE "%'.$data.'%"', [$funcionario]));
            $resposta['subscribe_course'] = count(DB::select('SELECT b.id FROM wp_bp_activity b, wp_plugin_tbaux_user_catetoria z  WHERE b.user_id = z.ID_user and z.ID_categoria = ? and  type="subscribe_course" and b.date_recorded LIKE "%'.$data.'%"', [$funcionario]));
            $resposta['Cursos_ativos'] = DB::table('wp_dashboard_course')->where('Status','=', 'Ativo')->where('data_Create','LIKE','%'.$data.'%')->count();
            $resposta['Cursos_desativados'] = DB::table('wp_dashboard_course')->where('Status','=', 'Desativado')->where('data_Create','LIKE','%'.$data.'%')->count();
            $resposta['Acessos'] = DB::table('wp_plugin_log_user')->where('DataHora','LIKE','%'.$data.'%')->count();
            $resposta['AcessosHoje'] = count(DB::select("SELECT l.ID FROM wp_plugin_log_user l, wp_plugin_tbaux_user_catetoria z  WHERE l.ID_user = z.ID_user and z.ID_categoria = ? and l.DataHora LIKE '%".Date("Y-m-d")."%' ", [$funcionario]));
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
            $resposta['Cursos_desativados'] = DB::table('wp_dashboard_course')->where('Status','=', 'Desativado')->whereBetween('data_Create',array($data,$data2))->count();
            $resposta['Acessos'] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($data,$data2))->count();
            $resposta['AcessosHoje'] = $this->AcessosHojeCount(Date("Y-m-d"));
        }else{
            $resposta['users'] = count(DB::select('select u.ID FROM wp_users u, wp_plugin_tbaux_user_catetoria z where u.ID = z.ID_user and z.ID_categoria = ? and u.user_registered BETWEEN ? AND ?', [$funcionario,$data,$data2]));
            $resposta['student_certificate']= count(DB::select('SELECT b.id FROM wp_bp_activity b, wp_plugin_tbaux_user_catetoria z  WHERE b.user_id = z.ID_user and z.ID_categoria = ? and  type="student_certificate" and b.date_recorded BETWEEN ? AND ?', [$funcionario,$data,$data2]));
            $resposta['subscribe_course'] = count(DB::select('SELECT b.id FROM wp_bp_activity b, wp_plugin_tbaux_user_catetoria z  WHERE b.user_id = z.ID_user and z.ID_categoria = ? and  type="subscribe_course" and b.date_recorded BETWEEN ? AND ?', [$funcionario,$data,$data2]));
            $resposta['Cursos_ativos'] = DB::table('wp_dashboard_course')->where('Status','=', 'Ativo')->whereBetween('data_Create',array($data,$data2))->count();
            $resposta['Cursos_desativados'] = DB::table('wp_dashboard_course')->where('Status','=', 'Desativado')->whereBetween('data_Create',array($data,$data2))->count();
            $resposta['Acessos'] = DB::table('wp_plugin_log_user')->whereBetween('DataHora',array($data,$data2))->count();
            $resposta['AcessosHoje'] = count(DB::select("SELECT l.ID FROM wp_plugin_log_user l, wp_plugin_tbaux_user_catetoria z  WHERE l.ID_user = z.ID_user and z.ID_categoria = ? and l.DataHora LIKE '%".Date("Y-m-d")."%' ", [$funcionario]));
        }
        return $resposta;
    }

    public function AlterarSenhaUsuario($senha, $email)
    {
        return DB::update('update wp_plugin_usersadm_login set senha = ? where email = ?', [$senha, $email]);
    }

    public function realizarLogin($email)
    {
        return DB::table('wp_plugin_usersadm_login')
        ->where('email',$email)
        ->join('wp_users', 'wp_plugin_usersadm_login.email', '=','wp_users.user_email' )
        ->select('wp_plugin_usersadm_login.*','wp_users.display_name')
        ->first();
    }
    public function viewUsuarioCadastrados($request)
    {
        $sql ='select u.display_name ,u.user_nicename, u.user_email,u.user_registered from wp_users u';

        if($request->session()->get('categoria') !=0){
            $sql = $sql.' ,wp_plugin_tbaux_user_catetoria z WHERE u.ID = z.ID_user and z.ID_categoria = '.$request->session()->get('categoria');
        }
        if($request->session()->get('filtroTempo') == 'RH'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = Date("Y-m-d");
            $sql = $sql.'u.user_registered LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'US'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
            $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
            $sql = $sql.'u.user_registered BETWEEN "'.$data.'" AND "'.$data2.'"';
        }
        if($request->session()->get('filtroTempo') == 'PM'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = $request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
            $sql = $sql.'u.user_registered LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'PA'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data =$request->session()->get('filtroAno');
            $sql = $sql.'u.user_registered LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'PL'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = $request->session()->get('filtrodataInicioBusca');
            $data2 = $request->session()->get('filtrodataFimBusca');
            $sql = $sql.'u.user_registered BETWEEN "'.$data.'" AND "'.$data2.'"';
        }
        return DB::select($sql);
    }

    public function RetornoTabelaActivity($request, $tipo)
    {
        $sql ='SELECT u.display_name, u.user_nicename, u.user_email, c.course, a.date_recorded FROM wp_bp_activity a LEFT JOIN wp_dashboard_course c ON c.id_course = a.item_id LEFT JOIN wp_users u ON u.ID = a.user_id';

        if($request->session()->get('categoria') !=0){
            $sql = $sql.' ,wp_plugin_tbaux_user_catetoria z WHERE a.type ="'.$tipo.'" and u.ID = z.ID_user and z.ID_categoria = '.$request->session()->get('categoria');
        }else{
            $sql = $sql.' WHERE a.type ="'.$tipo.'"';
        }
        if($request->session()->get('filtroTempo') == 'RH'){
            $data = Date("Y-m-d");
            $sql = $sql.' AND a.date_recorded LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'US'){
            $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
            $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
            $sql = $sql.'a.date_recorded BETWEEN "'.$data.'" AND "'.$data2.'"';
        }
        if($request->session()->get('filtroTempo') == 'PM'){
            $data = $request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
            $sql = $sql.'a.date_recorded LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'PA'){
            $data =$request->session()->get('filtroAno');
            $sql = $sql.'a.date_recorded LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'PL'){
            $data = $request->session()->get('filtrodataInicioBusca');
            $data2 = $request->session()->get('filtrodataFimBusca');
            $sql = $sql.'a.date_recorded BETWEEN "'.$data.'" AND "'.$data2.'"';
        }
        return DB::select($sql);
    }

    public function viewCursospublicados($request)
    {
        return DB::table('wp_dashboard_course')->where('Status','=','Ativo')
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
    }

    public function viewAcessoTotal($request)
    {
        $sql ='SELECT u.display_name, u.user_nicename, u.user_email, l.DataHora FROM wp_plugin_log_user l LEFT JOIN wp_users u ON l.ID_user = u.ID ';

        if($request->session()->get('categoria') !=0){
            $sql = $sql.' ,wp_plugin_tbaux_user_catetoria z WHERE l.ID_user = z.ID_user and z.ID_categoria = '.$request->session()->get('categoria');
        }
        if($request->session()->get('filtroTempo') == 'RH'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = Date("Y-m-d");
            $sql = $sql.'l.DataHora LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'US'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
            $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
            $sql = $sql.'l.DataHora BETWEEN "'.$data.'" AND "'.$data2.'"';
        }
        if($request->session()->get('filtroTempo') == 'PM'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = $request->session()->get('filtroMesAno').'-'.$request->session()->get('filtroMes');
            $sql = $sql.'l.DataHora LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'PA'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data =$request->session()->get('filtroAno');
            $sql = $sql.'l.DataHora LIKE "%'.$data.'%"';
        }
        if($request->session()->get('filtroTempo') == 'PL'){
            if (!str_contains($sql, 'WHERE')) { $sql = $sql.' WHERE '; }
            if (str_contains($sql, 'ID_categoria')) { $sql = $sql.' AND '; }
            $data = $request->session()->get('filtrodataInicioBusca');
            $data2 = $request->session()->get('filtrodataFimBusca');
            $sql = $sql.'l.DataHora BETWEEN "'.$data.'" AND "'.$data2.'"';
        }
        return DB::select($sql);



    }

    public function viewAcessoHoje($request, $data)
    {
        $sql ='SELECT u.display_name, u.user_nicename, u.user_email, l.DataHora FROM wp_plugin_log_user l LEFT JOIN wp_users u ON l.ID_user = u.ID ';

        if($request->session()->get('categoria') !=0){
            $sql = $sql.' ,wp_plugin_tbaux_user_catetoria z WHERE l.ID_user = z.ID_user and z.ID_categoria = '.$request->session()->get('categoria');
        }
        if (!str_contains($sql, 'WHERE')) {
             $sql = $sql.' WHERE ';
        }else{
            $sql = $sql.' AND ';
        }
        $sql = $sql.'DataHora LIKE "%'.$data.'%"';

        return DB::select($sql);
    }

    //Remove o ususario da categoria.
    public function removerUserCategoria($request)
    {
        return DB::table('wp_plugin_tbaux_user_catetoria')->where('ID','=',$request->id)->delete();
    }

    public function retornarUsuarioAdicionar($request)
    {
        return DB::table('wp_users as u')->select('u.ID','u.display_name')->orderBy('u.display_name','ASC')->whereNotIn('u.ID',function($query) use ($request){
            $query->select('ID_user')->from('wp_plugin_tbaux_user_catetoria as c')->where('c.ID_categoria','=',$request->id);
        })->get();
    }

    public function salvarUsuarioCategoria($request)
    {
        try{
            DB::beginTransaction();
            foreach ($request->data as $value) {
                DB::table('wp_plugin_tbaux_user_catetoria')->insert(array('ID_user'=>$value,'ID_categoria'=>$request->ctgid));
            }
            DB::commit();

            return true;
        }catch(\Exception $e){

            return false;
        }
    }

    public function retornaCategorias($request)
    {
        return DB::table('wp_plugin_categoria_users')->orderBy('status', 'ASC')->orderBy('categoria', 'ASC')->select('ID','categoria', 'status')->get();
    }
    public function retornarPessoasCategorias($id)
    {
        return DB::table('wp_plugin_tbaux_user_catetoria as c')->where('ID_categoria','=',$id)->join('wp_users as u','u.ID','=','ID_user')->orderBy('u.display_name', 'ASC')->select('c.ID','u.display_name')->get();
    }
    public function retornaAllUsersCategorias($request)
    {
        return DB::table('wp_plugin_tbaux_user_catetoria as c')->join('wp_users as u','u.ID','=','ID_user')->orderBy('u.display_name', 'ASC')->select('c.ID','u.display_name','c.ID_categoria')->get();
    }



    public function CategoriasVerifiqueCount($categoria)
    {
        return DB::table('wp_plugin_categoria_users')->where('categoria','=',$categoria)->count();
    }

    public function InseiriCategoria($categoria)
    {
        return DB::table('wp_plugin_categoria_users')->insert(array('categoria'=>$categoria,'status'=>'Ativo'));
    }
    public function UpdateCategorias($id,$status)
    {
        return DB::table('wp_plugin_categoria_users')->where('ID',$id)->update(array('status'=>$status));
    }

    public function deleteCategorias($id)
    {
        return DB::table('wp_plugin_categoria_users')->where('ID','=',$id)->delete();
    }

    //Cadastro User

    public function cadastarUserSistema($senha, $email)
    {
        return DB::table('wp_plugin_usersadm_login')->insert(array('senha'=>$senha,'email'=>$email));
    }

    //retornar users
    public function selectUsers()
    {
        return DB::table('wp_plugin_usersadm_login as a')->leftJoin('wp_users as u','u.user_email','=','a.email')->select('u.display_name','a.perfil','a.ID')->get();
    }


    //atualizar tabela de cursos
    public function atualizarTabelaCursos()
    {
        $cursos =  DB::select('SELECT wp_posts.post_title, wp_posts.ID, wp_posts.post_excerpt,wp_posts.post_date
        FROM wp_posts
        LEFT JOIN wp_dashboard_course ON wp_posts.ID = wp_dashboard_course.id_course
        where post_type = "course" and post_status = "publish" AND wp_dashboard_course.id_course IS NULL;');

        if( count($cursos) ) {
            DB::beginTransaction();
                foreach($cursos as $row => $value) {
                    DB::table('wp_dashboard_course')->insert(array('course'=>$value->post_title,'id_course'=>$value->ID,'Status'=>"Ativo",'duracao'=>$value->post_excerpt,'data_Create'=>$value->post_date));
                }
            DB::commit();
        }

        $cursos =  DB::select('SELECT ID, course,id_course FROM wp_dashboard_course a where a.id_course not in (SELECT ID FROM wp_posts b where post_type = "course" and post_status = "publish") ');

        if( count($cursos) ) {
            DB::beginTransaction();
                foreach($cursos as $row => $value) {
                    DB::table('wp_dashboard_course')->where('ID',$value->ID)->update(array('Status'=>"Desativado"));
                }
            DB::commit();
        }

    }
    public function criarTabelaBanco()
    {
        if(!count(DB::select("SHOW TABLES LIKE 'wp_plugin_log_user'"))==1){
            DB::select("CREATE TABLE wp_plugin_log_user ( ID INT(11) NOT NULL AUTO_INCREMENT , ID_user INT(11) NOT NULL , DataHora DATETIME NOT NULL , Atividade VARCHAR(250) NOT NULL , PRIMARY KEY (ID)) ENGINE = InnoDB;");
        }

        try{
            DB::select("ALTER TABLE `wp_plugin_usersadm_login`
            ADD COLUMN `photo` LONGBLOB NULL AFTER `senha`,;");
        }catch(\Exception $e){}

        try{
            DB::select("ALTER TABLE `wp_plugin_usersadm_login`
            ADD COLUMN `perfil` VARCHAR(50) NULL AFTER `photo`;");
        }catch(\Exception $e){}


    }
    public function DefinirAdminPadrao()
    {
        DB::table('wp_plugin_usersadm_login')->where('email','wendel.junior@callflex.net.br')->update(array('perfil'=>"Admin"));
        DB::table('wp_plugin_usersadm_login')->where('email','cleide.silva@callflex.net.br')->update(array('perfil'=>"Admin"));
    }

    public function RemoverAdminUser($id)
    {
        return DB::table('wp_plugin_usersadm_login')->where('ID',$id)->update(array('perfil'=>""));
    }

    public function AtribuirAdminUser($id)
    {
        return DB::table('wp_plugin_usersadm_login')->where('ID',$id)->update(array('perfil'=>"Admin"));
    }

    public function RemoverAcessoUser($id)
    {
        return DB::table('wp_plugin_usersadm_login')->where('ID','=',$id)->delete();
    }







}
