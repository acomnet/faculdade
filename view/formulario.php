<?php
require_once '../app/config.php';
use controller\AlunoController;
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['senha'])) {
$alunoController = new AlunoController();
$listacursos = $alunoController->listarCursos();
$edit = false;
    if ($_GET['op'] == 'novo') {
        // echo "novo";
    } else if ($_GET['op'] == 'editar') {
        $edit = true;
        $idaluno = filter_input(INPUT_GET, 'id');
        $aluno = $alunoController->EditarAlunoId($idaluno);
    } else if ($_GET['op'] == 'excluir') {
        $idapagar = filter_input(INPUT_GET, 'id');
        $alunoController->excluirAluno($idapagar);
    } else if ($_GET['op'] == 'atualizar') {
        $alunoController = new AlunoController();
        $alunoController->AtualizarAluno($_POST);
    } else if ($_GET['op'] == 'salvar') {
        $alunoController->cadastrarAluno($_POST);

    } else {
        echo "Você não pode acessar essa página";
    }
}else{
    header('Location: index.php?erro=permission');
}

require_once 'template/header.php';
?>


<div class="container">


    <div class="row">

        <div class="col-md-8 order-md-1">
            <br>
            <br>
            <h4 class="mb-3">Cadastrar Aluno</h4>
            <form class="needs-validation" novalidate="" method="POST" <?php if($edit){echo 'action="formulario.php?op=atualizar"';}else{echo 'action="formulario.php?op=salvar"';} ?>>

                <div class="mb-3">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" placeholder="" name="nome" <?php if($edit){echo "value='".$aluno['nome']."'";} ?>>
                </div>

                <div class="mb-3">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" placeholder="" name="cpf" <?php if($edit){echo "value=".$aluno['cpf'];} ?>>
                </div>

                <div class="mb-3">
                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="text" class="form-control" placeholder="" name="data_nasc" <?php if($edit){echo "value=".$aluno['data_nasc'];} ?>>
                </div>

                <div class="mb-3">
                    <label for="matricula">Matricula:</label>
                    <input type="text" class="form-control" placeholder="" name="matricula" <?php if($edit){echo "disabled=disabled value=".$aluno['matricula'];} ?>>
                </div>


                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="country">Curso</label>
                        <select class="custom-select d-block w-100" required="" name="curso" id="curso" onchange="escolheucurso()" value="1" >
                            <?php
                            foreach ($listacursos as $key => $value) {
                                $objls = (array) $value;
                                $id = "";
                                $nome = "";
                                $valor = "";
                                foreach ($objls as $k => $v){
                                    if($k == "id"){
                                        $id = $v;
                                    }else if($k == "nome"){
                                        $nome = $v;
                                    }
                                }
                                echo "<option value=\"$id\">$nome</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Valor</label>
                        <select class="custom-select d-block w-100" name="valor" id="valor" class="input-inline" disabled="disabled" value="1">
                            <?php
                            foreach ($listacursos as $key => $value) {
                                $objls = (array) $value;
                                $id = "";
                                $nome = "";
                                $valor = "";
                                foreach ($objls as $k => $v){
                                    if($k == "id"){
                                        $id = $v;
                                    }else if($k == "valor"){
                                        $valor = "R$ ".$v;
                                    }
                                }
                                echo "<option value=\"$id\">$valor</option>";
                            }
                            ?>
                        </select>

                    </div>

                </div>

                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email" <?php if($edit){echo "disabled=disabled value=".$aluno['email'];} ?>>
                    <div class="invalid-feedback">
                        Por favor digite um email válido.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="responsavel">Responsável</label>
                    <input type="text" class="form-control" id="address" name="responsavel" <?php if($edit){echo "value=".$aluno['responsavel'];} ?>>
                </div>

                <div class="mb-3">
                    <label for="cpf_responsavel">CPF Responsável</label>
                    <input type="text" class="form-control" id="address" name="cpf_responsavel" placeholder="CPF do Responsável" <?php if($edit){echo "value=".$aluno['cpf_responsavel'];} ?>>
                </div>

                <?php if($edit){echo "<input type='hidden' name='id' value=".$aluno['id']."> "; /*<input type='hidden' name='atualizar' value='true'>*/ } ?>

                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-danger btn-md btn-block" type="button" onclick="history.back()" >Cancelar</button>
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-success btn-md btn-block" type="submit">Cadastrar Aluno</button>
                    </div>
                </div>



            </form>
        </div>
    </div>


</div>






    <script>
        function escolheucurso() {
            var cursoid = document.getElementById('curso').value;
            document.getElementById('valor').value=cursoid;
        }

    </script>
<?php require_once 'template/footer.php'; ?>