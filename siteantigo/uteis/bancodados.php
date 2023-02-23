<?php
//CRIAR CLASSE PARA BANCO DE DADOS
class recordset{
	
	public $banco 		= "industrias118";
	public $usuario 	= "industrias118";
	public $senha 		= "sacraind*2017";
	public $hostname 	= "dbmy0036.whservidor.com";
	/*
	public $banco 		= "bdsacramento";
	public $usuario 	= "root";
	public $senha 		= "";
	public $hostname 	= "localhost";
	*/
	
	
	public $conn;
	
	//CONEXAO COM O BANCO
	function conexao(){
		$this->conn = mysql_connect($this->hostname, $this->usuario, $this->senha);
		mysql_select_db($this->banco) or die ("Não foi possível conectar ".mysql_error());
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET character_set_connection=utf8");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_results=utf8");
	}//FIM CONEXAO COM O BANCO
	
	function desconectar(){
		
		return mysql_close($this->conn);
		
	}
	
	//RECUPAR DADOS DO BANCO
	function selecionar($sql){
		//print_r($sql);
		$result = mysql_query($sql) or die ("Problemas ao realizar acesso ao banco de dados!");
		return $result;
	}//FIM RECUPAR DADOS DO BANCO
	
	function selecionarID($sql){
		//print_r($sql);
		$result = mysql_query($sql) or die ("Problemas ao realizar acesso ao banco de dados2! ");
		return mysql_insert_id();
	}
	
		
	//INSERIR DADOS 
	function inserir($dados) {
		
		//PEGAR TABELA
		$arrTabela = array_keys($dados);
		$tabela = $arrTabela[0];
		//PEGAR CAMPOS
		$arrCampos = array_keys($dados[$tabela]);
		//PEGAR VALORES
		$arrValores = array_values($dados[$tabela]);	
		//CONTAR CAMPOS
		$numCampos = count($arrCampos);
		//CONTAR VALORES
		$numValores = count($arrValores);
		//VALIDAÇÃO DOS CAMPOS
		if($numCampos == $numValores){
			$sql = "INSERT INTO ".$tabela." (";
			foreach($arrCampos as $campo){
				$sql .= "$campo,";
			}
			$sql = substr_replace($sql, ")", -1, 1);
			$sql .= " VALUES (";
			foreach($arrValores as $valor){
				$sql .= "'".$valor."',";
			}
			$sql = substr_replace($sql, ")", -1, 1);
		} else {
			$resultado = "Erro ao checar dados";	
		}
		//print_r("<br>".$sql);
		$resultado = $this->selecionar($sql);
		//print_r("primeiro");
		if($resultado == 1) {
			$resultado = 'Dados salvos com sucesso!';
		} else {
			$resultado = 'Não foi possível salvar os dados!';
		}
		return $resultado;
	}
	
	
	function inserirID($dados) {
		
		//PEGAR TABELA
		$arrTabela = array_keys($dados);
		$tabela = $arrTabela[0];
		//PEGAR CAMPOS
		$arrCampos = array_keys($dados[$tabela]);
		//PEGAR VALORES
		$arrValores = array_values($dados[$tabela]);	
		//CONTAR CAMPOS
		$numCampos = count($arrCampos);
		//CONTAR VALORES
		$numValores = count($arrValores);
		//VALIDAÇÃO DOS CAMPOS
		if($numCampos == $numValores){
			$sql = "INSERT INTO ".$tabela." (";
			foreach($arrCampos as $campo){
				$sql .= "$campo,";
			}
			$sql = substr_replace($sql, ")", -1, 1);
			$sql .= " VALUES (";
			foreach($arrValores as $valor){
				$sql .= "'".$valor."',";
			}
			$sql = substr_replace($sql, ")", -1, 1);
		} else {
			$resultado = "Erro ao checar dados";	
		}
		print_r("<br>".$sql);
		$resultado = $this->selecionarID($sql);
		return $resultado;
	}
	
	//ALTERAR DADOS
	function alterar($dados, $string){
		//PEGAR TABELA
		$arrTabela = array_keys($dados);
		$tabela = $arrTabela[0];
		//PEGAR CAMPOS
		$arrCampos = array_keys($dados[$tabela]);
		//PEGAR VALORES
		$arrValores = array_values($dados[$tabela]);	
		//CONTAR CAMPOS
		$numCampos = count($arrCampos);
		//CONTAR VALORES
		$numValores = count($arrValores);
		//VALIDAÇÃO DOS CAMPOS
		if($numCampos == $numValores && $numValores > 0){
			$sql = "UPDATE ".$tabela." SET ";
			for($i = 0; $i < $numCampos; $i++){
				$sql .= $arrCampos[$i]." = '".$arrValores[$i]."',";
			}
			$sql = substr_replace($sql, " ", -1, 1);
			$sql .= "WHERE $string";
		} else {
			$resultado = "Erro ao checar dados";	
		}
		
		$resultado = $this->selecionar($sql);
		if($resultado == 1) {
			$resultado = 'Dados alterados com sucesso!';
		} else {
			$resultado = 'Não foi possível salvar os dados!';
		}
		return $resultado;
		
	}
	
	
}//FIM CLASSE
?>