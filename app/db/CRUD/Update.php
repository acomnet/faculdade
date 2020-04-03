<?php
namespace Conexao;
use Util\Conexao;
use PDO;
use PDOException;

/**
 * <b>Update.class:</b>
 * Classe responsável por atualizações genéticas no banco de dados!
 */
class Update extends Conexao {

    private $tabela;
    private $dados;
    private $termos;
    private $valores;
    private $resultado;

    /** @var PDOStatement */
    private $Update;

    /** @var PDO */
    private $conexao;

    private $info;

    /**
     * <b>Exe Update:</b> Executa uma atualização simplificada com Prepared Statments. Basta informar o
     * nome da tabela, os dados a serem atualizados em um Attay Atribuitivo, as condições e uma
     * analize em cadeia (ParseString) para executar.
     * @param STRING $tabela = Nome da tabela
     * @param ARRAY $dados = [ NomeDaColuna ] => Valor ( Atribuição )
     * @param STRING $termos = WHERE coluna = :link AND.. OR..
     * @param STRING $valores = link={$link}&link2={$link2}
     */
    public function alterarBanco($tabela, $dados, $termos, $valores, $info = null) {
        $this->info = $info;
        $this->tabela = (string) $tabela;
        $this->dados = (array) $dados;
        $this->termos = (string) $termos;

        parse_str($valores, $this->valores);
        $this->getSintaxe();
        $this->executar();
    }



    public function alterarDiretoBanco($banco, $query) {
        $this->Update = $query;
        $this->conectar();
        try {
            $this->Update->execute();
            $this->resultado = 'true';
        } catch (PDOException $e) {
            $this->resultado = 'false';
            echo "<b>Erro ao Ler:</b> {$e->getMessage()} " . $e->getCode();
        }
    }
    /**
     * <b>Obter resultado:</b> Retorna TRUE se não ocorrer erros, ou FALSE. Mesmo não alterando os dados se uma query
     * for executada com sucesso o retorno será TRUE. Para verificar alterações execute o getRowCount();
     * @return BOOL $Var = True ou False
     */
    public function getResultado() {
        return $this->resultado;
    }

    /**
     * <b>Contar Registros: </b> Retorna o número de linhas alteradas no banco!
     * @return INT $var = Quantidade de linhas alteradas
     */
    public function getQuantidade() {
        return $this->Update->rowCount();
    }

    /**
     * <b>Modificar Links:</b> Método pode ser usado para atualizar com Stored Procedures. Modificando apenas os valores
     * da condição. Use este método para editar múltiplas linhas!
     * @param STRING $valores = id={$id}&..
     */
    public function setValores($valores, $banco) {
        parse_str($valores, $this->valores);
        $this->getSintaxe();
        $this->executar();
    }

    //Obtém o PDO e Prepara a query
    private function conectar() {
        $this->conexao = parent::getConexao();
        $this->Update = $this->conexao->prepare($this->Update);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSintaxe() {
        foreach ($this->dados as $key => $valor):
            $valores[] = $key . ' = :' . $key;
        endforeach;
        $valores = implode(', ', $valores);
        $this->Update = "UPDATE {$this->tabela} SET {$valores} {$this->termos}";
    }

    //Obtém a Conexão e a Sintaxe, executa a query!
    private function executar() {
        $this->conectar();
        try {
            $this->Update->execute(array_merge($this->dados, $this->valores));
            $this->resultado = 'true';
        } catch (PDOException $e) {
            $this->resultado = 'false';
//            var_dump(array_merge($this->dados, $this->valores));
//            var_dump($this->Update);
//            $this->Result = 'false';
//            $descricao = array('interface' => 'update',
//                'info' => $this->info,
//                'mensagem' => $e->getMessage(),
//                'dados' => $this->dados);
//            $dao = LogSuporteDAO::getInstance();
//            $emp_id = isset($this->dados['emp_id']) ? $this->dados['emp_id'] : null;
//            $log = new LogSuporte($emp_id, $dao->ultimoId()+1, 'WEB VENDA', 'WEB', date("Y-m-d H:i:s"), json_encode($descricao), 'N');
//            $dao->inserirLog($log);
            echo "<b>Erro ao Alterar:</b> {$e->getMessage()}", $e->getCode();
        }
    }

    public function AlteraDiretoBanco($banco, $sql) {
        try{
            $this->conexao = parent::getConexao($banco);
            $this->conexao->beginTransaction();
            $this->conexao->exec($sql);
            return $this->conexao->commit();
        }catch (Exception $e){
            $this->conexao->rollBack();
            return "Erro".$e;
        }
    }

}
