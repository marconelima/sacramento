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
    
    $produto = $_POST['id'];
    $quantidade = $_POST['quantidade'];

    $carrinhoSessao = unserialize($_SESSION["carrinho"]);

    var_dump($carrinhoSessao, $produto);

    $pro = $carrinhoSessao->getProduto($produto);

    var_dump($pro);

    /*$carrinhoSessao2 = unserialize($_SESSION["carrinho"]);

    var_dump($carrinhoSessao->getQtdeProdutos());
    $carrinhoSessao->setQtdeProdutos($quantidade);
    var_dump($carrinhoSessao->getQtdeProdutos());
*/
    

}
