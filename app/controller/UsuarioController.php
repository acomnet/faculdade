<?php
namespace controller;

use dao\UsuarioDAO;

class UsuarioController{

    public $usuariodao;

    public function __construct(){
        $this->usuariodao = new UsuarioDAO();
    }

    public function nivelUsuario($email){
        return $this->usuariodao->checarTipoUsuario($email);
    }

}