<?php session_start(); ob_start();
include "parametros.php";
include "funcoes.php";
include "uteis/bancodados.php";

$cor = "#FDC410";

ini_set("display_errors","0");

$pag = "";
$pag = "$_GET[pag]";
if($pag >= '1'){
	$pag = $pag;
} else {
	$pag = '1';
}

$maximo = '24';
$inicio = ($pag * $maximo) - $maximo;

$conecta = new Recordset;
$conecta->conexao();

$dataAtual = date('Y-m-d');

if(isset($_GET['tela'])){
	$tela_id = $_GET['tela'];
	$sql_tela = 'SELECT * FROM tbtela WHERE id = '.$tela_id;
	$resultado_tela = $conecta->selecionar($sql_tela);
	$rs_tela = mysql_fetch_array($resultado_tela);
	$tabela = $rs_tela['tabela'];
	$idtela = $rs_tela['id'];
	$nometela = $rs_tela['nome'];
	$grupotela = $rs_tela['grupo_id'];
	$paginatela = $rs_tela['pagina'];
	$usuariotela = $_GET['usuario'];
} else {
	$grupotela = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="shortcut icon" href="images/favicon.ico">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="a1NwArdNwEY-a1ki2j6I87uncAhqalZIc3DVNvtbmDw" />

<meta name="description" content="Industria Sacramento - A vassoura do momento. Atuamos na produção de vassouras, rodos, pás de lixo, esfregões, desentupidores, escovas." />
<meta name="keywords" content="Industria, Sacramento, Vassouras, Rodos, Pás" />
<title>Industria Sacramento</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

<link href="css/jquery.jqzoom.css" type=text/css rel=stylesheet>

</head>

<body>



<div id="main">

	<div id="box">

    	<div id="cabecalho">

            <div id="topo_menu"></div>

            <div id="menu_superior">

            	<span class="item_menu_superior <?php if(@$_GET['pagina'] == 'contato') { echo " menu_ativo"; } ?>"  style="width:auto;"><a href="index.php?pagina=contato">Contato</a></span>
                <span class="item_menu_superior <?php if(@$_GET['pagina'] == 'carrinho') { echo " menu_ativo"; } ?>" style="width:auto;"><a href="index.php?pagina=carrinho">Meu Orçamento</a></span>
                <span class="item_menu_superior <?php if(@$_GET['pagina'] == 'grupo_quem') { echo " menu_ativo"; } ?>" style="width:auto;"><a href="index.php?pagina=grupo_quem&amp;tela=10">Institucional</a></span>
                <span class="item_menu_superior <?php if(@$_GET['pagina'] == 'home' || empty($_GET['pagina'])) { echo " menu_ativo"; } ?>" style="width:auto;"><a href="index.php?pagina=home">Início</a></span>

            </div>

        </div>

        <div id="principal">
