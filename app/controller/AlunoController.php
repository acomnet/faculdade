<?php
namespace controller;

use dao\AlunoDAO;
use dao\CursoDAO;
use dao\UsuarioDAO;
use model\Aluno;
use model\Usuario;

class AlunoController{

    public $alunodao;
    public $usuariodao;

    public function __construct(){
        $this->alunodao = new AlunoDAO();
    }

    public function cadastrarAluno($dados){
        $aluno = new Aluno();
        $aluno->nome = $dados['nome'];
        $aluno->cpf = $dados['cpf'];
        $aluno->data_nasc = $dados['data_nasc'];
        $aluno->matricula = $dados['matricula'];
        $aluno->curso = $dados['curso'];
        $aluno->responsavel = $dados['responsavel'];
        $aluno->cpf_responsavel = $dados['cpf_responsavel'];
        $aluno->email = $dados['email'];
        $retornoAluno = $this->alunodao->inserirAluno($aluno);

        $usuariodao = new UsuarioDAO();
        $usuario = new Usuario();
        $usuario->email = $dados['email'];
        $usuario->senha = $dados['matricula'];
        $usuario->tipo = 1;
        $retornoUsuario = $usuariodao->inserirUsuario($usuario);

        if($retornoAluno && $retornoUsuario){
            header('Location: lista.php?msg=success');
        }else{
            header('Location: lista.php?msg=error');
        }
    }

    public function listarAluno($pesquisa){
        return $this->alunodao->listarAlunoComCurso($pesquisa);
    }

    public function buscarAlunoCpf($cpf){
        return $this->alunodao->listarAlunoCpfResponsavel($cpf);
    }

    public function EditarAlunoId($id){
        return $this->alunodao->listarAlunoId($id);
    }

    public function AtualizarAluno($dados){
        $retornoAtualiza = $this->alunodao->atualizarInfo($dados);
        if($retornoAtualiza){
            header('Location: lista.php');
            return true;
        }else{
            return false;
        }

    }

    public function excluirAluno($id){
        $usuariodao = new UsuarioDAO();
        $usuariodao->deletarUsuario($id);
        $this->alunodao->deletarAluno($id);
        header('Location: lista.php');
    }


    public function listarCursos(){
        $cursodao = new CursoDAO();
        return $cursodao->listarCursos();

    }




}