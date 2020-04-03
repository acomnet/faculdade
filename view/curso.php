<?php
require_once '../app/config.php';
use controller\CursoController;
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    $cursoController = new CursoController();
    if ($_GET['op'] == 'novo') {

    } else if ($_GET['op'] == 'salvar') {
        $cursoController->cadastrarCurso($_POST);
    } else {
        echo "Você não pode acessar essa página";
    }
}else{
    header('Location: index.php?erro=permission');
}

require_once 'template/header.php';
?>
    <div class="container form_guia">
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Cadastrar Novo Curso</h4>
                <form class="needs-validation" novalidate="" method="post" action="curso.php?op=salvar">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nome">Nome do Curso</label>
                            <input type="text" class="form-control" name="nomecurso">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" name="valorcurso">
                        </div>

                        <div class="col-md-4 mb-3">
                            <br>
                            <button class="btn btn-success btn-md btn-block" type="submit">Salvar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
    
<?php require_once 'template/footer.php'; ?>
