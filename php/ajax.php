<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "../uteis/bancodados.php";
include "../parametros.php";
include "../funcoes.php";

$conecta = new Recordset;
$conecta->conexao();


if (isset($_POST['acao']) && @$_POST['acao'] == 'getQuantidadeProdutoCarrinho') {
    
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    var_dump($_SESSION['carrinho']);

}
