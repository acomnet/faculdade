<?php
namespace Conexao;

use Util\Conexao;
use PDO;
use PDOException;

/**
 * <b>Create.class:</b>
 * Classe responsável por cadastros genericos no banco de dados!
 */
class Create extends Conexao {

    private $tabela;
    private $dados;
    private $resultado;

    /** @var PDOStatement */
    private $create;

    /** @var PDO */
    private $conexao;
    private $info;

    /**
     * <b>ExeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor!
     * 
     * @param STRING $tabela = Informe o nome da tabela no banco!
     * @param ARRAY $dados = Informe um array atribuitivo. ( Nome Da Coluna => Valor ).
     */
    public function inserirBanco($tabela, $objeto, $info = null) {
        $this->info = $info;
        $this->tabela = (string) $tabela;
        $this->dados = (array) $objeto;
        $this->getSintaxe();
        $this->executar();
    }

    /**
     * <b>Obter resultado:</b> Retorna o ID do registro inserido ou FALSE caso nem um registro seja inserido! 
     * @return INT $variavel = lastInsertId OR FALSE
     */
    public function getResultado() {
        return $this->resultado;
    }

    //Obtém o PDO e Prepara a query
    private function conectar() {
        $this->conexao = parent::getConexao();
        $this->create = $this->conexao->prepare($this->create);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSintaxe() {
        $campos = implode(', ', array_keys($this->dados));
        $locais = ':' . implode(', :', array_keys($this->dados));
        $this->create = "INSERT INTO {$this->tabela} ({$campos}) VALUES ({$locais})";
    }

    public function sequenceTabela($sequence){
        $this->resultado = $this->conexao->lastInsertId($sequence);
    }

    //Obtém a Conexão e a Sintaxe, executa a query!
    private function executar() {
        $this->conectar();
        try {
            $this->create->execute($this->dados);
            $this->resultado = 'true';
        } catch (PDOException $e) {
            $this->resultado = 'false';
//            $descricao = array('interface' => 'create',
//                               'info' => $this->info,
//                               'mensagem' => $e->getMessage(),
//                               'dados' => $this->dados);
//            $emp_id = isset($this->dados['emp_id']) ? $this->dados['emp_id'] : null ;
//            $log = new LogSuporte($emp_id, $dao->ultimoId()+1, 'WEB VENDA', 'WEB', date("Y-m-d H:i:s"), json_encode($descricao), 'N');


            echo "<b>Erro ao Inserir:</b> {$e->getMessage()} ". $e->getCode();
        }
    }

    public function InsereDiretoBanco($sql, $info = null) {
        try{
            $this->conexao = parent::getConexao();
            $this->conexao->beginTransaction();
            $this->conexao->exec($sql);
            return $this->conexao->commit();
        }catch (Exception $e){
            $this->conexao->rollBack();
            return "Erro".$e;
        }
    }

}