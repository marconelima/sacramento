<?php 


include("seguranca_login.php");


// Verifica se um formulário foi enviados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


$usuario = (isset($_POST['usu_login'])) ? $_POST['usu_login'] : '';
$senha = (isset($_POST['usu_senha'])) ? $_POST['usu_senha'] : '';

                      
if (validaUsuario($usuario, $senha) == true) {
  
  		  header("Location: login/index.php") ;  


} else if (validaUsuario($usuario, $senha) == false ) {

          header("Location: index.php");  
 
  } else

          expulsaVisitante();

}

?>