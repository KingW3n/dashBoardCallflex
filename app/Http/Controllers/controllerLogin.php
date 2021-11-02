<?php

namespace App\Http\Controllers;

use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;


class controllerLogin extends Controller
{
    public function index(Request $request)
    {
        return view('login.index')
        ->with('email', );
    }

    public function realizarLogin(Request $request )
    {
        $this->verificarToken($request->_token);
        $user = DB::table('wp_plugin_usersadm_login')
        ->where('email',$request->email)
        ->join('wp_users', 'wp_plugin_usersadm_login.email', '=','wp_users.user_email' )
        ->select('wp_plugin_usersadm_login.*','wp_users.display_name')
        ->first();

        if($user !== null){
            if(Crypt::decrypt($user->senha) !== $request->senha){
                $resposta['login'] = false;
                $resposta['mensagem'] = "Senha incorreta tente novamente!";

                return json_encode($resposta);
            }else{
                $request->session()->put('logado','Yes');
                $request->session()->put('email',$user->email);
                $resposta['login'] = true;
                $resposta['mensagem'] = "Logado com sucesso";

                return json_encode($resposta);
            }


        }else{
            $resposta['login'] = false;
            $resposta['mensagem'] = "Não foi possivel localizar o E-mail em nosso banco de dados!";

            return json_encode($resposta);
        }
    }

    public function Realizarlogout(Request $request)
    {
        $request->session()->forget('logado');
        return redirect(route('home'));
    }


    private function verificarToken($token)
    {
        if(isset($token) && !empty($token)){
            $secret = env('GOOGLE_RECAPTCHA_PRIVATE_KEY');
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$token);
            $responseData = json_decode($verifyResponse);
            if( !isset($responseData->success) ){
                $resposta['login'] = false;
                $resposta['mensagem'] = "Não foi possivel realizar o login tente novamente!";

                return json_encode($resposta);
            }
        }else{
            $resposta['login'] = false;
            $resposta['mensagem'] = "Não foi possivel realizar o login tente novamente!";

            return json_encode($resposta);
        }
    }

}
