<?php
namespace Util;
use PDO;
use PDOException;

/**
 * Conexao.class [ CONEXÃO ]
 * Classe abstrata de conexão. Padrão Singleton.
 * Retorna um objeto PDO pelo método estático getConexao();
 */
class Conexao {


    private static $host = '127.0.0.1';
    private static $usuario = 'root';
    private static $senha = '';
    private static $banco = 'faculdade';



    /** @var PDO */
    private static $conexao = null;

    /**
     * Conecta com o banco de dados com o pattern singleton.
     * Retorna um objeto PDO!
     */
    private static function conectarBanco() {
        try {
            if (self::$conexao == null):
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$banco;
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$conexao = new PDO($dsn, self::$usuario, self::$senha, $options);
            endif;
        } catch (PDOException $e) {
            echo $e->getCode().'<br>' .$e->getMessage(). '<br>' .$e->getFile(). '<br>' .$e->getLine();
            die;
        }

        self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conexao;
    }

    /** Retorna um objeto PDO Singleton. */
    static function getConexao() {
        return self::conectarBanco();
    }
}