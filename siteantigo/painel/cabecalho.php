<?php
include"../parametros_painel.php"; 
include "../uteis/bancodados.php";
require"verificar.php";

ini_set("display_errors","0");

$conecta = new Recordset;
$conecta->conexao();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $tituloPagina; ?></title>

<link href="../css/painel.css" rel="stylesheet" type="text/css" />
<link href="../css/menu.css" type="text/css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="../css/sdmenu.css" />

<script src="../js/jquery.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/querystring-0.9.0.js"></script>
<script type="text/javascript" src="../js/querystring-0.9.0-min.js"></script>
<script type="text/javascript" src="../js/validacoes.js"></script>
<script type="text/javascript" src="../js/mascaras.js"></script>
<script type="text/javascript" src="../js/jquery.MultiFile.js"></script>

<script src="../js/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="../js/jquery.InputDinamico.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/sdmenu.js"></script>

<script type="text/javascript" src="../uteis/tinymce_pt/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../uteis/tinymce_pt/jscripts/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
    language : "pt",
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
theme_advanced_buttons1:
"code,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,cleanup,link,unlink,image,table,formatselect,fontselect,fontsizeselect,forecolor,backcolor,fullscreen",

		// Theme options
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",


		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
	 content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
    file_browser_callback : "tinyBrowser",
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>

</head>
<body>
<div id="main">
<div id="box">
	<div id="cabecalho">
	<img src="../images/cabecalho_painel.png" alt="Topo Painel" /><br/>
    <div class="titulo_top"><strong>Usu&aacute;rio:</strong> <?php echo $_SESSION["login"];?></div>
    <div class="sair_top"><a href="sair.php">Sair</a></div>
    </div><!--cabecalho-->
    <div id="conteudo">