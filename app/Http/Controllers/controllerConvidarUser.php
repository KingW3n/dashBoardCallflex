<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class controllerConvidarUser extends Controller
{
    public function eniarConvite(Request $request,controllerBancoDados $banco)
    {

        if($request->session()->get('logado')){
            if(!$banco->DadosUser($request->email)){
                if($banco->VerifiqueUserConvite($request->email)){
                    try {
                        $dadosUser = $banco->DadosUser($request->session()->get('email'));
                        var_dump($dadosUser);
                        $data = ['link' => $_ENV['APP_URL_Local']."/convite/cadastro/".Crypt::encrypt($request->email),'nome'=>$dadosUser->nome];
                        //armazena os dados para envio do email
                        $email = "wendel.junior@callflex.net.br";
                        Mail::send('mail.convite',$data, function ($message) use ($email) {
                            $message->from($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_NAME_ENVIO']);
                            $message->to($email, $email);
                            $message->subject('Convite plataforma Dashboard YOUniversity');
                        });
                        $resposta['status'] = true;
                        $resposta['mensagem'] = 'Convite enviado com sucesso.';
                    } catch (\Exception $e) {
                        $resposta['status'] = false;
                        $resposta['mensagem'] = 'Erro ao enviar o convite, tente novamente.';
                    }
                }else{
                    $resposta['status'] = false;
                    $resposta['mensagem'] = 'usuario não possui acesso na plataforma YOUniversity';
                }
            }else{
                $resposta['status'] = false;
                $resposta['mensagem'] = 'Usuario já cadastrado.';
            }

        }else{
            return redirect()->route('indexLogin');
        }
        return json_encode($resposta);
    }

    public function viewCadastro(Request $request,controllerBancoDados $banco)
    {
        if($banco->DadosUser(Crypt::decrypt($request->emailencripty))){
            return redirect()->route('indexLogin');
        }else{
            return view('convite.cadastrarSenha')->with('email',Crypt::decrypt($request->emailencripty));
        }
    }

    public function salvarNewCadastro(Request $request,controllerBancoDados $banco)
    {
        if( $banco->cadastarUserSistema(Crypt::encrypt($request->senha),$request->email)){
            $resposta['validacao'] = true;
        }else{
            $resposta['validacao'] = false;
            $resposta['mensagem'] = "Erro ao salva senha, tente novamente ";
        }

        return json_encode($resposta);
    }
}
