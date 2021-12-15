<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class controllerForgot extends Controller
{
    public function index(Request $request)
    {
        return view('forgot.index');
    }

    public function enviarCode(Request $request,controllerBancoDados $banco)
    {
        $dadosUser = $banco->DadosUser($request->email);
        if($dadosUser != null){
            //Gera o codigo randomico para verificação do e-mail
            $Codigo = $this->generateRandomString(6);
            //Criar o array de objetos para enviar no e-mail
            $data = ['code' => $Codigo,'nome'=>$dadosUser->nome,'email'=>$request->email];
            //armazena os dados para envio do email
            $email = $request->email;
            Mail::send('mail.code',$data, function ($message) use ($email,$dadosUser) {
                $message->from($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_NAME_ENVIO']);
                $message->to($email, $dadosUser->nome);
                $message->subject('codigo de verificação');
            });
            $request->session()->put('Codigo',$Codigo);
            $request->session()->put('CodigoEmail',$email);
            $resposta['email'] = true;
            $resposta['mensagem'] = "enviado";

            return json_encode($resposta);
        }else{
            $resposta['email'] = false;
            $resposta['mensagem'] = "E-mail não localizado na base de usuarios do Plugin";

            return json_encode($resposta);
        }

    }

    public function enterCode(Request $request)
    {
        if ($request->session()->get('Codigo')) {
            return view('forgot.code');
        }else{
            return redirect(route('forgot'));
        }
    }

    public function verificarCode(Request $request)
    {
        if($request->codigo === $request->session()->get('Codigo')){
            $resposta['codigo'] = true;
        }else{
            $resposta['codigo'] = false;
            $resposta['mensagem']= "Codigo invalido por gentileza verifique e tente novamente.";
        }
        return json_encode($resposta);

    }

    public function NewSenha(Request $request)
    {
        if ($request->session()->get('Codigo') && $request->session()->get('CodigoEmail')) {
            return view('forgot.novaSenha');
        }else{
            return redirect(route('forgot'));
        }
    }

    public function cadastrarNewSenha(Request $request,controllerBancoDados $banco)
    {
        if( $banco->AlterarSenhaUsuario(Crypt::encrypt($request->senha),$request->session()->get('CodigoEmail'))){
            $resposta['validacao'] = true;
            $request->session()->forget('CodigoEmail');
            $request->session()->forget('Codigo');
        }else{
            $resposta['validacao'] = false;
            $resposta['mensagem'] = "Erro ao salva senha, tente novamente ";
        }


        return json_encode($resposta);

    }

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }




}
