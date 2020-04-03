<?php
namespace dao;
use Conexao\Create;
use Conexao\Delete;
use Conexao\Read;
use Conexao\Update;
use model\Curso;

/**
 * Created by PhpStorm.
 * User: Kaio
 * Date: 11/03/2020
 * Time: 10:02
 */
class CursoDAO{

    private $tabela = "curso";

    public function inserirCurso(Curso $curso){
        $create = new Create();
        $create->inserirBanco($this->tabela, $curso);
        return $create->getResultado();
    }

    public function deletarCurso($id){
        $delete = new Delete();
        $delete->deletarBanco($this->tabela, "WHERE id = :id", "id={$id}");
        return $delete->getResultado();
    }

    public function listarCursos(){
        $read = new Read();
        $read->pesquisarBanco($this->tabela);
        return $read->getResultado();
    }

    public function editarCurso(Curso $curso){
        $update = new Update();
        $update->alterarBanco($this->tabela, $curso, "WHERE id = :id", "id={$curso->id}");
        return $update->getResultado();
    }

    public function pesquisarCursos($id){
        $read = new Read();
        $read->pesquisarBanco($this->tabela, 'WHERE id = :id', "id={$id}");
        return $read->getResultado();
    }

}