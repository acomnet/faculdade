<?php
require_once '../app/config.php';
use controller\AlunoController;
$alunoController = new AlunoController();
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    if (isset($_GET['buscar'])) {
        $txt_buscar = filter_input(INPUT_GET, 'buscar');
        $lista = $alunoController->listarAluno($txt_buscar);
    } else {
        $lista = $alunoController->listarAluno("");
    }

}else{
    header('Location: index.php?erro=permission');
}

//cabeçalho de todas as paginas
require_once 'template/header.php';

if(isset($_GET['msg'])){
    if($_GET['msg'] == 'success'){
        echo "<div class=\"alert alert-success\" id=\"success-alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
            Cadastro Realizado com sucesso.
            </div>";
    }else{
        echo "<div class=\"alert alert-danger\" id=\"danger-alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
            ERRO ao Cadastrar, contate o administrador do sistema. 
            </div>";
    }
}

?>

<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="tbheader">
            <th>Código:</th>
<!--            <td>Endereço</td>-->
<!--            <td>Telefone</td>-->
            <th>Nome do aluno:</th>
            <th>CPF:</th>
            <th>Data Nasc:</th>
            <th>Matricula:</th>
            <th>Curso:</th>
            <th>Responsável:</th>
            <th>CPF Responsável:</th>
            <th>Email:</th>
            <th>Ações:</th>
        </thead>
        <tbody class="tbbody">
        <?php

            foreach ($lista as $obj) {
                echo "<tr>";
                echo "<td>" . $obj["id"] . "</td>".
                      "<td>" . $obj["nome"] . "</td>".
                      "<td>" . $obj["cpf"] . "</td>".
                      "<td>" . $obj["data_nasc"] . "</td>".
                      "<td>" . $obj["matricula"] . "</td>".
                      "<td>" . $obj["curso"] . "</td>".
                      "<td>" . $obj["responsavel"] . "</td>".
                      "<td>" . $obj["cpf_responsavel"] . "</td>".
                      "<td>" . $obj["email"] . "</td>".
                      "<td> <a class='btn btn-sm btn-outline-primary' href='formulario.php?op=editar&id=".$obj['id']."'>Editar</a> | <a class='btn btn-sm btn-outline-danger' href='formulario.php?op=excluir&id=".$obj['id']."'>Excluir</a> </td>";

                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    <script>


        $(document).ready(function() {
            //$("#success-alert").hide();

        });
    </script>
</div>

<?php require_once 'template/footer.php'; ?>

