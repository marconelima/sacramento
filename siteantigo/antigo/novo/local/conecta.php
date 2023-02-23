<?php

$host= "localhost";
$user = "root";
$pass = "";
$db = "sacramento";



$conecta_db = @mysql_connect($host, $user, $pass) or die(mysql_error());
@mysql_select_db($db) or die("Erro ao selecionar o banco de dados");

?>
