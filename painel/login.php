<?php session_start();
date_default_timezone_set("Brazil/East");
include"../uteis/bancodados.php";

$conecta = new Recordset;
$conecta->conexao();

include"../funcoes.php";

if($_POST["login"] != '' && $_POST["senha"] != ''){
	//Recebe dados do formulário
	@$loginAut = $_POST["login"];
	@$senhaAut = $_POST["senha"];

	$okLogin = 0;
	$okSenha = 0;

	//Se não houver sql-injection verifica dados do usuário no banco
	if ($okLogin == 0 && $okSenha == 0) {
		$loginAut = verificar_dados($conecta->conn,$loginAut);
		$senhaAut = verificar_dados($conecta->conn,$senhaAut);

		$sql_log = "select id, login, perfil_id, nome, ultimo_acesso, qtde_acesso
					from tbusuario
					where login = '".$loginAut."' and senha = '".md5($senhaAut)."'";

		$resultado = $conecta->selecionar($conecta->conn,$sql_log);

		//Se usuário validado entra no sistema
		if ($row = mysqli_fetch_array($resultado)) {


				$_SESSION['nome_usuario'] = $row['nome'];
				$_SESSION['usuario'] = $row['id'];
				$_SESSION['login'] = $row['login'];
				$_SESSION['perfil'] = $row['perfil_id'];
				$_SESSION['qtde'] = $row['qtde_acesso'];
				$_SESSION['ultimo'] = substr($row['ultimo_acesso'],8,2)."/".substr($row['ultimo_acesso'],5,2)."/".
substr($row['ultimo_acesso'],0,4).substr($row['ultimo_acesso'],10,9);
				$qtde_atual = $_SESSION['qtde'] + 1;

				$sql_update = "UPDATE tbusuario SET qtde_acesso = ".$qtde_atual.", ultimo_acesso ='".date("Y-m-d H:i:s")."' WHERE id = ".$_SESSION['usuario'];
				$conecta->selecionar($conecta->conn,$sql_update);

				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php\">\n";

		} else {
			$erro = 2;
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php?erro=$erro\">\n";
			//header("Location: index.php?erro=1");
		}
	//Houver sql-injection
	} else {
		$erro = 1;
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php?erro=$erro\">\n";
		//header("Location: index.php?erro=1");
	}
}

$conecta->desconectar();
?>
