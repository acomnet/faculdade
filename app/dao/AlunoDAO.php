<?php

namespace dao;
use Conexao\Create;
use Conexao\Delete;
use Conexao\Read;
use Conexao\Update;
use model\Aluno;
use ArrayObject;
class AlunoDAO{

    private $tabela = "aluno";

    public function inserirAluno(Aluno $aluno){
        $create = new Create();
        $create->inserirBanco($this->tabela, $aluno);
        return $create->getResultado();
    }

    public function deletarAluno($id){
        $delete = new Delete();
        $delete->deletarBanco($this->tabela, "WHERE id = :id", "id={$id}");
        return $delete->getResultado();
    }

    public function listarAluno(){
        $read = new Read();
        $read->pesquisarBanco($this->tabela);
        return $read->getResultado();
    }

    public function listarAlunoId($id){
        $read = new Read();
        $read->pesquisarBanco($this->tabela, "WHERE id = :id", "id={$id}");
        return $read->getResultado()[0];
    }

    public function listarAlunoComCurso($pesquisa){
        $sql = "SELECT a.id, a.nome, a.cpf, a.data_nasc, a.matricula, c.nome AS curso, a.responsavel, a.cpf_responsavel, a.email"
            ." FROM aluno AS a"
            ." INNER JOIN curso AS c"
            ." ON a.curso = c.id";
        if($pesquisa != ''){
            $sql = $sql." WHERE a.nome LIKE '%{$pesquisa}%' ORDER BY nome ASC";
        }
        $read = new Read();
        $read->pesquisarDiretoBanco($sql);
        return $read->getResultado();
    }

    public function atualizarInfo($dados){
        $update = new Update();
        $update->alterarBanco($this->tabela, $dados, "WHERE id = :id", "id={$dados['id']}");
        return $update->getResultado();
    }
}