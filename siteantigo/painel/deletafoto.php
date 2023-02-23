<?php
include"../parametros.php"; 
include "../uteis/bancodados.php";
require"verificar.php";

$conecta = new Recordset;
$conecta->conexao();

$id = $_GET['id'];

$sql = "DELETE FROM tbfotoproduto WHERE id = $id";
$conecta->selecionar($sql);

?>