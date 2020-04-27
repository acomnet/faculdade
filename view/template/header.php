
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista de alunos</title>
    <!--    <link rel="stylesheet" href="css/style.css">-->
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light title-head">

    <a class="navbar-brand" href="lista.php">Escola Marechal Duque de Caxias</a>

</nav>
<br>
<div class="container text-center block-info">
    <br>
    <h2>Imposto de renda - Guia On-line</h2>
    <p class="lead">Ao realizar o cadastro do aluno o mesmo terá acesso ao sistema que lhe permite gerar sua guia de imposto de renda.</p>
    <br>
</div>


<div class="container-fluid">

    <br>

    <div class="container">
        <div class="row">
            <nav class="nav col-6">

                <?php
                    use controller\UsuarioController;
                    $usuarioController = new UsuarioController();
                    $tipo = $usuarioController->nivelUsuario($_SESSION['email']);
                    if($tipo == '0'){
                        require_once 'menu_admin.php';
                    }else{
                        require_once 'menu_usuario.php';
                    }

                ?>


            </nav>
            <div class="search-custom col-6">
                <?php
                  if($tipo == "0"){
                 ?>
                <form class="form-inline my-2 my-lg-0" action="lista.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="buscar" id="txtBusca"  placeholder="" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
                <?php } ?>

            </div>
        </div>

    </div>
</div>