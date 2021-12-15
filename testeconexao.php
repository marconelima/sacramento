<?php

date_default_timezone_set("Brazil/East");
include("parametros.php");
include "uteis/bancodados2.php";


$conecta2 = new Recordset2;
$conecta2->conexao();

$sql_configuracao = "SELECT * FROM cliente_pre_cadastro";
$resultado_configuracao = $conecta2->selecionar($conecta2->conn, $sql_configuracao);

while($rs_configuracao = oci_fetch_array($resultado_configuracao)){
	var_dump($rs_configuracao);
}
