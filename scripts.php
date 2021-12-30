<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "uteis/bancodados.php";
include "parametros.php";
include "funcoes.php";

include_once("classes/comunicacao.class.php");

$conecta = new Recordset;
$conecta->conexao();

$API = new ComunicacaoAPI();

if(empty($_SESSION['token_api']))
{

    $API->getToken('http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/autenticacao/entrar');

    $_SESSION['token_api'] = $API->token;
} else {
    $API->token = $_SESSION['token_api'];
}
var_dump($_SESSION['token_api']);

//BUSCAR SITUACAO DO CLIENTE
$email = 'testeIV@teste.com';
//$cliente = $API->getCliente($email);
//var_dump($cliente);

//BUSCAR UM PRODUTO ESPECIFICO NA API
$idproduto = 4022;
$produto = $API->getProduto($idproduto);
var_dump($produto);

//BUSCAR UM PRODUTO E ESTOQUE ESPECIFICO NA API
$idproduto = 4022;
//$produtos = $API->getProdutoEstoque($idproduto);
//var_dump($produtos);

//ENVIAR PEDIDO NA API

//$pedido = $API->setPedido();
//var_dump($pedido);

/*
$sql_configuracao = "SELECT nome, id FROM tbproduto order by nome asc";
$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);

while($rs_configuracao = mysqli_fetch_array($resultado_configuracao)){

    $pos = 0;
    $codigo = '';

    $pos  = strripos($rs_configuracao['nome'], 'ref');

    if($pos !== false){
        $codigo = substr($rs_configuracao['nome'], $pos+3);
        $cod = trim(str_replace(".","",$codigo));

        $sql_update = "UPDATE tbproduto SET codigo = ". $cod . " where id = " . $rs_configuracao['id'];
        $conecta->selecionar($conecta->conn, $sql_update);
    }

}*/

$conecta->desconectar(); 