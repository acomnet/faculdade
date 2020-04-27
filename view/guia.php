<?php
require_once '../app/config.php';
require_once '../vendor/autoload.php';

use controller\AlunoController;
use controller\UsuarioController;

session_start();
setlocale(LC_ALL, 'pt_BR ');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY, 'pt_BR');

if(isset($_SESSION['email']) && isset($_SESSION['senha'])) {
    $alunoController = new AlunoController();
    $usuarioController = new UsuarioController();
    $usu_tipo = $usuarioController->nivelUsuario($_SESSION['email']);
    if (!empty($_POST)) {
        $aluno = $alunoController->buscarAlunoCpf($_POST['cpf']);
        if($aluno["cpf"] == $_POST['cpf']){
            if($aluno["email"] == $_SESSION["email"] || $usu_tipo == "0"){
                $listaMeses= [];
                $mesatual = intval(date('m'));
                $string_tbl_meses = '';
                $valor_total = 0.00;
                for ($i = 1; $i <= $mesatual; $i++){
                    if($i != 1 && $i != 7){
                        $monthNum  = $i;
                        $mes = utf8_encode(strftime('%B', mktime(0, 0, 0, $monthNum, 10)));
                        $string_tbl_meses .= '<tr><td>'.$mes.'</td><td>R$ '.number_format($aluno['valor'], 2, ',', '.').'</td></tr>';
                        $valor_total += doubleval($aluno['valor']);
                    }
                }
                $declaracao_IRPF = new \Mpdf\Mpdf();
                $file = '<html><head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <title>DecIRPF_01264117_913148</title>
                <style type="text/css">
                    *{font-family: Sans-serif;}
                    body {margin-top: 0px;margin-left: 0px;}
                    p{padding: 0px; margin: 0px;}
                    .clr{
                        clear: both;
                    }
                    .top{ text-align: center; }
                    .top .logo .logo-left{ float: left; width: 35%;}
                    .top .logo .logo-right{ float: right}
                    .top-info{ text-align: center; }
                    .top-info p{ font-weight: bold; }
                    .title {font-size: 44px; text-align: center; font-weight: bold; border-bottom: 2px dotted #333; }
                    .info{ text-align: left; }
                    .info-dados { padding-left: 200px; }
                    .tb-key{ text-align: right; font-weight: bold; }
                    .tb-meses { text-align: center; width: 100%; }
                    .footer{ text-align: center;}
                    .footer p{ padding: 8px;}
                    .emissao { border-bottom: 1px dotted #333;}
                    .controle { border-bottom: 1px dotted #333;}
                    .instuicao{ width: 100%; background-color: #f3f3f3; color: #000066; }
                    .endereco { color: #000066; }
            
            
                </style>
            </head>
            
            <body>
            <div>
                <header class="top">
                    <div class="logo">
            <!--            <img src="img/logo-uninassau.png" alt="" class="logo-left">-->
            <!--            <img src="img/logo-ser.png" alt="" class="logo-right">-->
                        <img src="img/logo.JPG" alt="">
                    </div>
                    <br class="clr">
            
                    <div class="top-info">
                        <p>04.986.320/0005-47</p>
                        <p>FACULDADE UNINASSAU CARUARU</p>
                        <p>Caruaru, '.strftime('%d de %B de %Y', strtotime('today')).'</p>
                    </div>
                </header>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="title">DECLARAÇÃO</p>
                <br>
                <br>
                <div class="info">Disponibilizamos para V.S.a. o valor total pago referente às semestralidades do exercício de 2019, desta Instituição de Ensino Superior, que poderá ser utilizado como comprovante para Declaração de Imposto de Renda de 2020.</div>
                <br>
                <br>
                <div class="info-aluno">
                    <div class="info-dados">
                        <table>
                        <tr><td class="tb-key">Responsável:</td><td>'.$aluno['responsavel'].'</td></tr>
                        <tr><td class="tb-key">CPF:</td><td>'.$aluno['cpf_responsavel'].'</td></tr>
                        <tr><td class="tb-key">Aluno:</td><td>'.$aluno['nome'].'</td></tr>
                        <tr><td class="tb-key">Matrícula:</td><td>'.$aluno['matricula'].'</td></tr>
                        <tr><td class="tb-key">Curso(s):</td><td>'.$aluno['curso'].'</td></tr>
                        <tr><td class="tb-key">Valor total pago:</td><td>R$ '.number_format($valor_total, 2, ',', '.').'</td></tr>
            
                        </table>
                    </div>
                    <br>
            
                    <br>
                    <br>
            
            
                </div>
                <table class="tb-meses" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="tr0 td0"><p><b>MÊS</b></p></td>
                        <td class="tr0 td1"><p><b>VALOR</b></p></td>
                    </tr>
                    '.$string_tbl_meses.'
                    </tbody>
                </table>
                <br>
                <br>
                <footer class="footer">
            
                    <p class="emissao">Comprovante emitido <span>'.strftime('%A, %d de %B de %Y', strtotime('today')).'.</p>
                    <p class="controle">Código de controle do comprovante:<span >B6B0.0F6C.684B.4B1C</span></p>
                    <p class="link">A autenticidade desta declaração poderá ser confirmada no endereço <span >https://autentica.sereduc.com/</span></p>
                    <p class="instuicao">Faculdade UNINASSAU</p>
                    <p class="endereco"><nobr>Caruaru-PE:</nobr> Entroncamento da Br 232 com a Br 104, KM 68, 1.215, (81) <nobr>3413-4660</nobr></p>
                </footer>
            </div>
            
            
            </body></html>';
                $declaracao_IRPF->WriteHTML($file);
                $declaracao_IRPF->Output();


            }else{
                header('Location: guia.php?msg=Você não está autorizado a realizar esse procedimento');
            }
        }else{
            header('Location: guia.php?msg=Informações inválidas');
        }
        //header('Location: guia_pdf.php');
    }else{

    }
}else{
    header('Location: index.php?erro=permission');
}

require_once 'template/header.php';


if(isset($_GET['msg'])){
        echo "<div class=\"alert alert-danger\" id=\"danger-alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
            ".$_GET['msg']."
            </div>";
}

?>


    <div class="container form_guia">

    <form method="post" action="guia.php" target="_blank">
        <div class="input_cpf">
            <h5>CPF do aluno:</h5>
            <input type="text"  onkeypress="$(this).mask('000.000.000-00');" name="cpf"><br><br>
            <button type="submit" tar type="submit" value="">Gerar Guia</button>
        </div>

    </form>
    </div>
    
<?php require_once 'template/footer.php'; ?>
