<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class controllerCategoria extends Controller
{
    public function index(Request $request, controllerBancoDados $banco)
    {
        if(!$request->session()->get('logado')){
            return redirect()->route('indexLogin');
        }

        return view('categorias.categoria')
        ->with('DadosUser', $banco->DadosUser($request->session()->get('email')))
        ->with('Categoria',$banco->retornaCategorias($request));
    }

    public function salvar(Request $request, controllerBancoDados $banco)
    {
            try{
                foreach($request->data as $value){
                    $banco->UpdateCategorias($value['id'],$value['status']);
                }
                $resposta['status'] = true;
                $resposta['mensagem'] = "Alterado com sucesso";

                return json_encode($resposta);
            }catch(\Illuminate\Database\QueryException $ex){
                $resposta['status'] = false;
                $resposta['mensagem'] = "Error ao salvar, recarregue a pagina e tente novamente";
            }
            return json_encode($resposta);
    }
    public function retornarDados( Request $request ,controllerBancoDados $banco)
    {
        if($request->condOpcao == "all"){
            return $banco->retornaAllUsersCategorias($request);
        }
        return $banco->retornaCategorias($request);
    }

    public function retornarDadosAll( Request $request ,controllerBancoDados $banco)
    {
        return $banco->retornaAllUsersCategorias($request);
    }

    public function retornarPessoasCategorias( Request $request ,controllerBancoDados $banco)
    {
       return $banco->retornarPessoasCategorias($request);
    }




    public function viewIndex(Request $request, controllerBancoDados $banco)
    {
        if(!$request->session()->get('logado')){
            return redirect()->route('indexLogin');
        }

        return view('categorias.categoriaFiltro')
        ->with('DadosUser', $banco->DadosUser($request->session()->get('email')))
        ->with('Categoria',$banco->retornaCategorias($request));
    }

    public function removerUsuarioCategoria(Request $request, controllerBancoDados $banco)
    {
      if($banco->removerUserCategoria($request)){
          $resposta['status'] = true;
          $resposta['Mensagem']= "Usuario removido com sucesso.";
      }else{
        $resposta['status'] = false;
        $resposta['Mensagem']= "Erro ao tentar remover o ususario, favor tente novamente.";
      }
      return json_encode($resposta);
    }

    public function retornarUsuarioAdicionar(Request $request, controllerBancoDados $banco)
    {
        return json_encode($banco->retornarUsuarioAdicionar($request));
    }
    public function salvarUsuarioCategoria(Request $request, controllerBancoDados $banco)
    {
        if($banco->salvarUsuarioCategoria($request)){
            $resposta['status'] = true;
            $resposta['Mensagem'] = "Inserido com sucesso.";
            $resposta['usuarios'] = $banco->retornarPessoasCategorias($request->ctgid);
        }else{
            $resposta['status'] = false;
            $resposta['Mensagem'] = "Não foi possivel inserir, atualize e tente novamente.";
        }
        return $resposta;
    }

    public function salvarCategoria(Request $request, controllerBancoDados $banco)
    {
        $quantidade =  $banco->CategoriasVerifiqueCount($request->categoria);

        if($quantidade>0){
            $resposta['status'] = false;
            $resposta['mensagem'] = "Categoria ja existe em nossa base de dados.";
            return json_encode($resposta);
        }
        try{
            if($banco->InseiriCategoria($request->categoria)){
                $resposta['status'] = true;
                $resposta['mensagem'] = "Salvo com sucesso";
            }else{
                $resposta['status'] = false;
                $resposta['mensagem'] = "Error ao salvar, recarregue a pagina e tente novamente";
            }
        }catch(\Illuminate\Database\QueryException $ex){
            $resposta['status'] = false;
            $resposta['mensagem'] = "Error ao salvar, recarregue a pagina e tente novamente";
        }

        return json_encode($resposta);
    }

    public function alterarStatus(Request $request, controllerBancoDados $banco)
    {
        if($banco->UpdateCategorias($request->id,$request->status)){
            $resposta['status'] = true;
            $resposta['mensagem'] = "Status alterado com sucesso";
        }else{
            $resposta['status'] = false;
            $resposta['mensagem'] = "Erro ao alterar o status";
        }

        return $resposta;
    }

    public function excluirCategoria(Request $request, controllerBancoDados $banco)
    {
        if($banco->deleteCategorias($request->id)){
            $resposta['status'] = true;
            $resposta['mensagem'] = "Categoria deletada com sucesso";
        }else{
            $resposta['status'] = false;
            $resposta['mensagem'] = "Não foi possivel deletar categoria.";
        }

        return $resposta;
    }




}
