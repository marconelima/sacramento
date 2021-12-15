<?php session_start();

include("../parametros.php");
include "../uteis/bancodados.php";

$conecta = new Recordset;
$conecta->conexao();

if(@$_SESSION["login"] && @$_SESSION["usuario"]){
	// Usuário logada redireciona para a página HOME.PHP
	header("Location: home.php");
    exit;
}

$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
$rs_configuracao = mysqli_fetch_array($resultado_configuracao);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->

    <!-- CSS -->

    <link rel="stylesheet" type="text/css" href="../css/bootstrap2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../css/painel.css">

    <title>Painel | <?php echo $rs_configuracao['titulopagina'];?></title>
</head>

<body>

    <div class="container-fluid">
    	<div class="row">
        	<div class="tamanho_alert_index">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-info">Painel de controle</h4>
                    </div><!--FIM PANEL-HEADING-->
                    <div class="panel-body panel_body_index">
                        <form role="form" action="login.php" method="post" enctype="multipart/form-data" id="frmlogin" name="frmlogin">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Login</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Login">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                          </div>

                          <button type="submit" class="btn btn-default btn_direita" id="entrar" name="entrar" value="entrar" onclick="return validar_login();">Entrar</button>
                        </form>
                    </div><!--FIM PANEL-BODY-->
                </div><!--FIM PANEL PANEL-INFO-->
                <?php if(@$_GET['erro'] == 1 || @$_GET['erro'] == 2) {?>
                	<div class="alert alert-danger">
                    	<h4>Login ou Senha incorretos!</h4>
                    </div>
                <?php } ?>
                <div class="alert alert-info ">
                    <h4>ATENÇÃO:</h4>
                    <h5>01 - UTILIZAÇÃO</h5>
                    <p>Esse gerenciador é o responsável pela gerência on-line do conteúdo do seu site. Inserções, alterações e deleções realizadas no gerenciador de conteúdo, alteram imediatamente os dados e os resultados presentes no web site que está no ar.</p>
                    <h5>02 - CUIDADOS</h5>
                    <p>Operações tais como deleção de registros, imagens e alterações de textos são irreversíveis. Todas as modificações são de total responsabilidade do usuário que as realizou.</p>
                    <h5>03 - PRIVACIDADE</h5>
                    <p>Seja cuidadoso com o uso do gerenciador e mantenha a sua senha em segredo para evitar maiores aborrecimentos. Por questões de segurança, seu IP e a hora do seu acesso ao gerenciador estão sendo gravados.</p>
                </div><!--FIM ALERT INFO-->
            </div>

        </div><!--FIM ROW-->
    </div><!--FIM CONTAINER FLUID-->

	<script language="javascript" src="../js/jquery.min.js"></script>
    <script language="javascript" src="../js/bootstrap2.min.js"></script>
    <script language="javaScript" src="../js/validacoes.js"></script>
</body>
</html>
