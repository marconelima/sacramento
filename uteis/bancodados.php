<?php
//CRIAR CLASSE PARA BANCO DE DADOS
class Recordset{
/*
	private $banco 		= "bdindustriasacramento";
	private $usuario 	= "root";
	private $senha 		= "";
	private $hostname 	= "localhost";

	private $banco 		= "industria2017";
	private $usuario 	= "industria2017";
	private $senha 		= "G4p2f5D3@";
	private $hostname 	= "industria2017.mysql.uhserver.com";
*/
    private $banco         = "industriateste";
    private $usuario     = "industriateste";
    private $senha         = "G4p2f5D3@";
    private $hostname     = "industriateste.mysql.uhserver.com";



	public $conn;

	//CONEXAO COM O BANCO
	function conexao(){
		$this->conn = mysqli_connect($this->hostname, $this->usuario, $this->senha, $this->banco);

		mysqli_query($this->conn,"SET NAMES 'utf8'");
		mysqli_query($this->conn,"SET character_set_connection=utf8");
		mysqli_query($this->conn,"SET character_set_client=utf8");
		mysqli_query($this->conn,"SET character_set_results=utf8");

		if(!$this->conn){
			echo '<div class="alert alert-danger">Erro ao conectar '.mysqli_connect_error().'</div>';
		}

	}//FIM CONEXAO COM O BANCO

	function desconectar(){
		return mysqli_close($this->conn);
	}

	//RECUPAR DADOS DO BANCO
	function selecionar($conecta, $sql){
		//print_r($sql);
		$result = mysqli_query($conecta,$sql);
		if($result):
			return $result;
		else:
			echo '<div class="alert alert-danger">Erro no banco de dados '.$sql.'</div>';
		endif;
	}//FIM RECUPAR DADOS DO BANCO

	function selecionarID($conecta,$sql){
		//print_r($sql);
		$result = mysqli_query($conecta, $sql);
		if($result):
			return mysqli_insert_id($this->conn);
		else:
			echo '<div class="alert alert-danger">Erro no banco de dados '.mysqli_error($this->conn).'#</div>';
		endif;
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
				$sql .= "'".addslashes($valor)."',";
			}
			$sql = substr_replace($sql, ")", -1, 1);
		} else {
			$resultado = '<div class="alert alert-danger">Erro ao checar dados</div>';
		}
		$resultado = $this->selecionar($this->conn,$sql);
		//print_r("primeiro");
		if($resultado == 1) {
			$resultado = '<div class="alert alert-success">Dados salvos com sucesso!</div>';
		} else {
			$resultado = '<div class="alert alert-danger">Não foi possível salvar os dados!</div>';
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
				$sql .= "'".addslashes($valor)."',";
			}
			$sql = substr_replace($sql, ")", -1, 1);
		} else {
			$resultado = '<div class="alert alert-danger">Erro ao checar dados</div>';
		}
		//print_r("<br>".$sql);
		$resultado = $this->selecionarID($this->conn,$sql);
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
				$sql .= $arrCampos[$i]." = '".addslashes($arrValores[$i])."',";
			}
			$sql = substr_replace($sql, " ", -1, 1);
			$sql .= "WHERE $string";
		} else {
			$resultado = "Erro ao checar dados";
		}
		//print_r($sql);
		$resultado = $this->selecionar($this->conn,$sql);
		if($resultado == 1) {
			$resultado = '<div class="alert alert-success">Dados alterados com sucesso!</div>';
		} else {
			$resultado = '<div class="alert alert-danger">Não foi possível salvar os dados!</div>';
		}
		return $resultado;
	}
}//FIM CLASSE
?>
