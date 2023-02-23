<?php

session_start(); 


include("seguranca.php");

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';


if (validaUsuario($usuario, $senha) == true) {

header("Location: admin.php");  //Direciona para a pagina especificada

} else {


expulsaVisitante();

}

}



?>
