<?php session_start(); 
include "cabecalho.php";
include "menu.php";

foreach ($_REQUEST as $___opt => $___val) {
 $$___opt = $___val;
}
if(empty($pagina)) {
	include("paginas/principal.php");
}elseif(substr($pagina, 0, 4)=='http' or substr($pagina,0, 1)=="/" or substr($pagina, 0, 1)=="."){
	echo '<h1>A página não existe.</b><br>Por favor selecione uma página a partir do Menu Principal.</h1>';
} else {
	include("paginas/$pagina.php");	
}

include "rodape.php";
?>