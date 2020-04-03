<?php
namespace Conexao;
use Util\Conexao;
use PDO;
use PDOException;

/**
 * <b>Read.class:</b>
 * Classe responsável por leituras genéticas no banco de dados!
 */
class Read extends Conexao {

    private $selecionar;
    private $dados;
    private $resultado;

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $conexao;

    private $info;

    /**
     * <b>Exe Read:</b> Executa uma leitura simplificada com Prepared Statments. Basta informar o nome da tabela,
     * os termos da seleção e uma analize em cadeia ($valor) para executar.
     * @param STRING $tabela = Nome da tabela
     * @param STRING $termos = WHERE | ORDER | LIMIT :limit | OFFSET :offset
     * @param STRING $valores = link={$link}&link2={$link2}
     */
    public function pesquisarBanco($tabela, $termos = null, $valores = null, $info = null) {
        $this->info = $info;
        if (!empty($valores)):
            parse_str($valores, $this->dados);
        endif;

        $this->selecionar = "SELECT * FROM {$tabela} {$termos}";
        $this->executar();

    }
    /**
     * <b>Ler Completo:</b> Executa leitura de dados via query que deve ser montada manualmente para possibilitar
     * seleção de multiplas tabelas em uma única query!
     * @param STRING $query = Query selecionar Sintaxe
     * @param STRING $valores = link={$link}&link2={$link2}
     */
    public function pesquisarDiretoBanco($query, $info = null) {
        $this->info = $info;
        $this->selecionar = (string) $query;
        $this->executar();
    }

    public function setDados($valores) {
        parse_str($valores, $this->dados);
        $this->executar();
    }

    /**
     * <b>Obter resultado:</b> Retorna um array com todos os resultados obtidos. Envelope primário númérico. Para obter
     * um resultado chame o índice getResult()[0]!
     * @return ARRAY $this = Array ResultSet
     */
    public function getResultado() {
        return $this->resultado;
    }

    /**
     * <b>Contar Registros: </b> Retorna o número de registros encontrados pelo selecionar!
     * @return INT $Var = Quantidade de registros encontrados
     */
    public function getQuantidade() {
        return $this->Read->rowCount();
    }

    //Obtém o PDO e Prepara a query
    private function conectar() {
        $this->conexao = parent::getConexao();
        $this->Read = $this->conexao->prepare($this->selecionar);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSintaxe() {
        if ($this->dados):
            foreach ($this->dados as $vinculo => $valor):
                if ($vinculo == 'limit' || $vinculo == 'offset'):
                    $valor = (int) $valor;
                endif;
                $this->Read->bindValue(":{$vinculo}", $valor, ( is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    //Obtém a Conexão e a Sintaxe, executa a query!
    private function executar() {
        $this->conectar();
        try {
            $this->getSintaxe();
            $this->Read->execute();
            $this->resultado = $this->Read->fetchAll();
        } catch (PDOException $e) {

            $this->resultado = null;
//            $descricao = array('interface' => 'read',
//                                'info' => $this->info,
//                                'mensagem' => $e->getMessage(),
//                                'dados' => $this->dados);
//            $dao = LogSuporteDAO::getInstance();
//            $emp_id = isset($this->dados['emp_id']) ? $this->dados['emp_id'] : null ;
//            $log = new LogSuporte($emp_id, $dao->ultimoId()+1, 'WEB VENDA', 'WEB', date("Y-m-d H:i:s"), json_encode($descricao), 'N');
//            $dao->inserirLog($log);
            echo "<b>Erro ao Ler:</b> {$e->getMessage()}", $e->getCode();
        }
    }

}
