<?php
namespace dao;
use Conexao\Create;
use Conexao\Delete;
use Conexao\Read;
use Conexao\Update;
use model\Usuario;

/**
 * Created by PhpStorm.
 * User: Kaio
 * Date: 11/03/2020
 * Time: 10:02
 */
class UsuarioDAO{

    private $tabela = "usuario";

    public function inserirUsuario(Usuario $aluno){
        $create = new Create();
        $create->inserirBanco($this->tabela, $aluno);
        return $create->getResultado();
    }

    public function deletarUsuario($id){
        $delete = new Delete();
        $delete->deletarBanco($this->tabela, "WHERE id = :id", "id={$id}");
        return $delete->getResultado();
    }

    public function deletarUsuarioPorEmail($email){
        $delete = new Delete();
        $delete->deletarBanco($this->tabela, "WHERE email = :email", "email={$email}");
        return $delete->getResultado();
    }

    public function listarUsuario(){
        $read = new Read();
        $read->pesquisarBanco($this->tabela);
        return $read->getResultado();
    }

    public function editarUsuario($aluno){
        $update = new Update();
        $update->alterarBanco($this->tabela, $aluno, "WHERE id = :id", "id={$aluno->id}");
        return $update->getResultado();
    }

    public function autenticaUsuario($email, $senha){
        $read = new Read();
        $read->pesquisarBanco($this->tabela, 'WHERE email = :email and senha = :senha', "email={$email}&senha={$senha}");
        return $read->getResultado();
    }

    public function checarTipoUsuario($email){
        $read = new Read();
        $read->pesquisarDiretoBanco("SELECT tipo FROM usuario WHERE email = '{$email}'");
        return $read->getResultado()[0]['tipo'];
    }

}