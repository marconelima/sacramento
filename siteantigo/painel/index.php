<?php session_start(); ob_start();
include"../parametros.php"; 
include"../uteis/bancodados.php";

ini_set("display_errors","0");

if($_SESSION["login"] && $_SESSION["usuario"])
{
	// Usuário logada redireciona para a página HOME.PHP
	header("Location: home.php");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javaScript" src="../js/validacoes.js"></script>
<title><?php echo $tituloPagina; ?></title>

<style type="text/css">
*{margin:0; padding:0; }
body{background:#eaeaea; margin:100px; text-align:center;}
#login form{width:300px; display:block; margin:0px auto; background:#fff; border:2px solid #ccc; text-align:left; }
#login fieldset {border:0; padding:0 15px 10px 15px; }
#login legend {font:18px Tahoma, Geneva, sans-serif; color:#069; font-weight:bold; padding:10px 0;} 
#login label {display:block; padding:3px 0;}
#login span{display:block; font:16px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#069; font-weight:bold; }
#login input {padding:3px; width:260px; border:1px solid #069; font:16px Tahoma, Geneva, sans-serif; color:#666; font-weight:bold; }
#login input:hover{border: 1px solid #900; }
#login .btn{ width:120px; display:block; margin:0 auto; cursor:pointer; background:#069; color:#fff; text-align:center; }
#login .btn:hover{background:#066;}
#login #erro{display:block; margin:0 auto; padding:10px 0px 10px 0px; text-align:center; font:16px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#F00; font-weight:bold; }
</style>
</head>

<body>
<div id="login">
<form action="login.php" method="post" enctype="multipart/form-data" id="frmlogin" name="frmlogin" target="_parent">
  <fieldset>
    	<legend>Painel</legend>
    	<label>
        <span>Login:</span>
        <input type="text" name="login" id="login" size="40" maxlength="64" />
        </label>
        <label>
        <span>Senha:</span>
        <input type="password" id="senha" name="senha" size="40" maxlength="14" />
        </label>
        <?php if($_GET['erro'] == 1) {?>
        <div id="erro">Login ou Senha incorretos!</div>
        <?php } else if($_GET['erro'] == 2) {?>
        <div id="erro">Login ou Senha incorretos!</div>
        <?php } else if($_GET['erro'] == 3) {?>
        <div id="erro">Login ou Senha incorretos ou Área do Usuário não criada!</div>
        <?php } ?>
        <label>
        <input type="submit" id="entrar" name="entrar" value="entrar" onclick="return validar_login();" class="btn" />
        </label>
  </fieldset>
</form>

</div>
</body>
</html>