<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "uteis/bancodados.php";
include "parametros.php";
include "funcoes.php";

$conecta = new Recordset;
$conecta->conexao();

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

}

$conecta->desconectar(); 