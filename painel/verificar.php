<?php  
// Verifica se existe os dados da sessão de login
if(!$_SESSION["login"] || !$_SESSION["usuario"])
{
	// Usuário não logado! Redireciona para a página de login
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php?erro=1\">\n";
	//header("Location: index.php?erro=1");
    exit;
} 
?>