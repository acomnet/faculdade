<?php
// CONFIGURACOES
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'].'/sistemas');
//define('URL_SUPORTE', 'http://acomnfe.com.br/suporte');
define('DIRETORIO', dirname(dirname(__FILE__)));

////SESSAO
//define('ADMIN', ['1']);                         //TIPO = 1
//define('TECNICO',  ['1', '4']);                 //TIPO = 4
//define('FORNECEDOR', ['1', '5']);               //TIPO = 5
//define('CLIENTE', ['1', '2', '4', '5']);        //TIPO = 2
//define('VENDEDOR',  ['1', '2', '3', '4', '5']); //TIPO = 3


$array = require 'autoload.php';
spl_autoload_register(function ($class) use($array) {
    return include $array[$class];
});



/*------------------------------
      TRATAMENTO DE ERROS
  -----------------------------*/
date_default_timezone_set('America/Recife');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('memory_limit', '-1');