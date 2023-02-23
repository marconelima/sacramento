<?php session_start();
include"../uteis/bancodados.php";
include"../funcoes.php";

$conecta = new Recordset;
$conecta->conexao();

if($_POST["login"] != '' && $_POST["senha"] != ''){
	//Recebe dados do formulário
	@$loginAut = $_POST["login"];
	@$senhaAut = $_POST["senha"];
	
	$okLogin = 0;
	$okSenha = 0;
	
	
	//Se não houver sql-injection verifica dados do usuário no banco
	if ($okLogin == 0 && $okSenha == 0) {
		$loginAut = verificar_dados($loginAut);
		$senhaAut = verificar_dados($senhaAut);
		
		$sql_log = "select id, login, perfil_id 
					from tbusuario
					where login = '".$loginAut."' and senha = '".$senhaAut."'";
					
		
		$resultado = $conecta->selecionar($sql_log);
		
		//Se usuário validado entra no sistema
		if ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
			if($row['perfil_id'] != 1){
				$sql_log_per = "SELECT id, login, perfil_id 
								from tbusuario
								where login = '".$loginAut."' and senha = '".$senhaAut."'
								AND perfil_id in (SELECT id FROM tbperfil WHERE nome in ('Ministério','Congregações','Grupo de Estudos','Escola Dominical','Cursos','Colunistas'))";
				
				
				
				$resultado_per = $conecta->selecionar($sql_log_per);
				if($rs_per = mysql_fetch_array($resultado_per)){
					$sql_final = "SELECT u.id, u.login, u.perfil_id 
								from tbusuario u left join tbcolunista c on u.id = c.usuario_id
								left join tbgrupo_ministerio m on u.id = m.usuario_id
								where u.login = '".$loginAut."' and u.senha = '".$senhaAut."'";
										
					$resultado_final = $conecta->selecionar($sql_final);
					if($rs_final = mysql_fetch_array($resultado_final)){
					
						$_SESSION['usuario'] = $rs_final['id'];
						$_SESSION['login'] = $rs_final['login'];
						$_SESSION['perfil'] = $rs_final['perfil_id'];
						echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php\">\n";
					} else {
						$erro = 3;
						echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php?erro=$erro\">\n";
					}
				} else {
					$_SESSION['usuario'] = $row['id'];
					$_SESSION['login'] = $row['login'];
					$_SESSION['perfil'] = $row['perfil_id'];
					echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php\">\n";
				}
			} else {
				$_SESSION['usuario'] = $row['id'];
				$_SESSION['login'] = $row['login'];
				$_SESSION['perfil'] = $row['perfil_id'];
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php\">\n";
			}
			//header("Location: home.php");
		//Usuário não validado
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
?>