<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "../uteis/bancodados.php";
include "../parametros.php";
include "../funcoes.php";

include_once("../classes/produto.class.php");
include_once("../classes/carrinho.class.php");

$conecta = new Recordset;
$conecta->conexao();


if (isset($_POST['acao']) && @$_POST['acao'] == 'getQuantidadeProdutoCarrinho') {
    
    $produto = $_POST['id'];
    $quantidade = $_POST['quantidade'];

    $carrinhoSessao = unserialize($_SESSION["carrinho"]);

    $pro = $carrinhoSessao->getProduto($produto);

    $pro->setQuantidade($quantidade);

    $_SESSION["carrinho"] = serialize($carrinhoSessao);

}
