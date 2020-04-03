<?php
namespace controller;
use dao\UsuarioDAO;


/**
 * Created by PhpStorm.
 * User: Kaio
 * Date: 11/03/2020
 * Time: 12:00
 */
class LoginController{

    public $usudao;
    public $msg;

    /**
     * LoginController constructor.
     */
    public function __construct(){
        $this->usudao = new UsuarioDAO();
    }


    public function autentica($email, $senha){
        $this->msg = "";
        $ret = $this->usudao->autenticaUsuario($email, $senha);
       if(sizeof($ret) > 0){
           session_start();
           $_SESSION['email'] = $email;
           $_SESSION['senha'] = $senha;
           if($this->usudao->checarTipoUsuario($email) == "0"){
               header('Location: lista.php');
           }else{
               header('Location: guia.php');
           }

            return true;
       }else{
           $this->msg = "Usuário ou Senha incorretos";
           return false;
       }
    }

    public function sair(){
        session_start();
        unset ($_SESSION['email']);
        unset ($_SESSION['senha']);
        session_unset();
        session_destroy();
        header('Location: index.php');

    }


}