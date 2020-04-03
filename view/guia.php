<?php
require_once '../app/config.php';
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['senha'])) {

}else{
    header('Location: index.php?erro=permission');
}

require_once 'template/header.php';

?>
    <div class="container form_guia">

    <form>
        <h4>Digite o CPF do aluno:</h4>
        <input type="text" name="cpf"><br><br>
        <a href="">
        <div class="botao_guia">Gerar Guia</div>
        </a>
    </form>
    </div>
    
<?php require_once 'template/footer.php'; ?>
