<?php
$dir = DIRETORIO. '/app';

return array(
    /*--- UTIL ---*/
    'Util\\Conexao' => $dir . '/db/Conexao.php',
    /*--- CRUD ---*/
    'Conexao\\Create' => $dir . '/db/CRUD/Create.php',
    'Conexao\\Delete' => $dir . '/db/CRUD/Delete.php',
    'Conexao\\Read' => $dir . '/db/CRUD/Read.php',
    'Conexao\\Update' => $dir . '/db/CRUD/Update.php',
    /*--- MODEL ---*/
    'model\\Curso' => $dir . '/model/Curso.php',
    'model\\Usuario' => $dir . '/model/Usuario.php',
    'model\\Aluno' => $dir . '/model/Aluno.php',

    /*--- DAO ---*/
    'dao\\CursoDAO' => $dir . '/dao/CursoDAO.php',
    'dao\\UsuarioDAO' => $dir . '/dao/UsuarioDAO.php',
    'dao\\AlunoDAO' => $dir . '/dao/AlunoDAO.php',

    /*--- CONTROLLER ---*/
    'controller\\LoginController' => $dir . '/controller/LoginController.php',
    'controller\\AlunoController' => $dir . '/controller/AlunoController.php',
    'controller\\CursoController' => $dir . '/controller/CursoController.php',
    'controller\\UsuarioController' => $dir . '/controller/UsuarioController.php',
);