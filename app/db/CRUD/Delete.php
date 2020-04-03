<?php
namespace Conexao;
 use Util\Conexao;
 use PDO;
 use PDOException;

 /**
 * <b>delete.class:</b>
 * Classe responsável por deletar genéricamente no banco de dados!
 */
class Delete extends Conexao {

    private $tabela;
    private $termos;
    private $dados;
    private $resultado;

    /** @var PDOStatement */
    private $delete;

    /** @var PDO */
    private $conexao;


    public function deletarBanco($tabela, $termos, $parse) {
        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;

        parse_str($parse, $this->dados);
        $this->getSintaxe();
        $this->executar();
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function getQuantidade() {
        return $this->delete->rowCount();
    }

    public function setDados($parse) {
        parse_str($parse, $this->dados);
        $this->getSintaxe();
        $this->executar();
    }

    //Obtém o PDO e Prepara a query
    private function conectar() {
        $this->conexao = parent::getConexao();
        $this->delete = $this->conexao->prepare($this->delete);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSintaxe() {
        $this->delete = "DELETE FROM {$this->tabela} {$this->termos}";
    }

    //Obtém a Conexão e a Sintaxe, executa a query!
    private function executar() {
        $this->conectar();
        try {
            $this->delete->execute($this->dados);
            $this->resultado = 'true';
        } catch (PDOException $e) {
            $this->resultado = 'false';
//            $descricao = array('interface' => 'delete',
//                'info' => $this->info,
//                'mensagem' => $e->getMessage(),
//                'dados' => $this->dados);
//            $dao = LogSuporteDAO::getInstance();
//            $emp_id = isset($this->dados['emp_id']) ? $this->dados['emp_id'] : null ;
//            $log = new LogSuporte($emp_id, $dao->ultimoId()+1, 'WEB VENDA', 'WEB', date("Y-m-d H:i:s"), json_encode($descricao), 'N');
//            $dao->inserirLog($log);
            echo "<b>Erro ao Deletar:</b> {$e->getMessage()}", $e->getCode();
        }
    }

}
