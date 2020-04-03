<?php

namespace controller;

use dao\CursoDAO;
use model\Curso;




class CursoController{

    public $cursodao;

    public function __construct(){
        $this->cursodao = new CursoDAO();
    }

    public function cadastrarCurso($dados){
        $curso = new Curso();
        $curso->nome = $dados['nomecurso'];
        $curso->valor = $dados['valorcurso'];

        $retornoCurso = $this->cursodao->inserirCurso($curso);

        if($retornoCurso){
            header('Location: lista.php?msg=success');
        }else{
            header('Location: lista.php?msg=error');
        }
    }


}