<?php
require_once '../app/config.php';
use controller\LoginController;
if (isset($_GET['op'])) {
    $loginController = new LoginController();
    $loginController->sair();
}else {

    if (filter_input(INPUT_POST, 'email') != '') {
        $txt_email = filter_input(INPUT_POST, 'email');
        $txt_senha = filter_input(INPUT_POST, 'senha');
        $loginController = new LoginController();
        $loginController->autentica($txt_email, $txt_senha);
    }

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="css/style_log.css">

</head>
<body>
        <form method="POST" action="index.php">
            <div class="logo">
                <img src="img/logo_login.png">
            </div>
            
            <input type="email" name="email" placeholder="E-mail">

            <input type="password" name="senha" placeholder="Senha">

            <?php
                if(!empty($loginController->msg)){
                    echo "<p style='color:red'>{$loginController->msg}</p>";
                }
            if(!empty(filter_input(INPUT_GET,'erro'))){
                if(filter_input(INPUT_GET,'erro') == 'permission'){
                    echo "<p style='color:red'>Você não tem permissão para acessar a página solicitada</p>";
                }

            }
            ?>
            
            <a href="">
                <input type="submit" value="logar" class="botao_login">
            </a>
            <a href="">
                <div class="esqueci_senha">
                    Esqueceu sua senha? Clique aqui.
                </div>
            </a>
        </form>
    </div>
</body>
</html>