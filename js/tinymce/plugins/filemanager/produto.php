<?php
include "../funcoes.php";

//PEGA ONFIGURAÇÕES BÁSICAS DA LOJA
$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
$resultado_configuracao = $conecta->selecionar($conecta->conn,$sql_configuracao);

if($rs_configuracao = mysqli_fetch_array($resultado_configuracao)){	
	$titulo_pagina = $rs_configuracao['titulopagina'];
	$nome_loja = $rs_configuracao['nomeloja'];
	$logomarca = $rs_configuracao['logomarca'];
	$funco_cabecalho = $rs_configuracao['fundocabecalho'];
	$cor_padrao = $rs_configuracao['corpadrao'];
	$cor_secundaria = $rs_configuracao['corsecundaria'];
	$fundo_cabecalho = $rs_configuracao['fundocabecalho'];
	$email_loja = $rs_configuracao['emailloja'];
	$link_loja = $rs_configuracao['linkloja'];
	$endereco_loja = $rs_configuracao['enderecoloja'];
	$qtde_imagem = $rs_configuracao['qtde_imagem'];
	$qtde_produto = $rs_configuracao['qtde_produto'];
}

$sobra = $qtde_imagem;
	
	if(@$_GET['box'] != '') {
		$box_mostra = $_GET['box'];
	}else{
		$box_mostra = "formularioProduto";
	}
	
	if(@$_GET['aba'] != ''){
		$aba_mostra = $_GET['aba'];
	} else {
		$aba_mostra = "aba_dados";
	}
	
	
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_GET['id'])) { $id = $_GET["id"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE tbproduto SET status = 0 WHERE id = ".$_POST['banner_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE tbproduto SET status = 1 WHERE id = ".$_POST['banner_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}


if(@$_GET['f'] != ''){
	$idApagar = $_GET['f'];
	$pasta = '../imagens';
	
	$recupera = $conecta->selecionar($conecta->conn,"SELECT * FROM tbprod_foto WHERE id = $idApagar");
	$rsRecupera = mysqli_fetch_array($recupera);
	
	$id = $rsRecupera['produto_id'];
	$fotoApagar = $rsRecupera['foto'];
	
	if($fotoApagar != '') {
		unlink($pasta."/".$fotoApagar);
	}
	
	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbprod_foto WHERE id = $idApagar");
	if($resultado == 1){
		echo "<div class='alert alert-danger'>Foto apagada!</div>";	
	} else {
		echo "<div class='alert alert-danger'>Problemas ao apagar foto!</div>";
	}
	
	$url_redireciona = substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'&f='))."#".$_GET['box'];
	
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$url_redireciona."\">\n";
} elseif(@$_GET['c'] != ''){
	$idApagar = $_GET['c'];
	
	$resultadoc = $conecta->selecionar($conecta->conn,"DELETE FROM tbprod_subcampo WHERE campo_id = $idApagar");
	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbprod_campo WHERE id = $idApagar");
	if($resultado == 1){
		echo "<div class='alert alert-danger'>Campo apagada!</div>";	
	} else {
		echo "<div class='alert alert-danger'>Problemas ao apagar campo!</div>";
	}
} else if(isset($_POST['acrescentar']) && $_POST['acrescentar'] == 'Acrescentar Legenda'){
	$dados['tbprod_foto']['legenda'] = $_POST['legenda'];
	$string = "id = ".$_POST['legendaid'];
	$conecta->alterar($dados, $string);
} 



if(isset($_POST['novo_campo'])){
	echo '<img src="../images/carregando.gif" >';
	
	$dados = $_POST["dados"];
	
	$nome_campo = strip_tags(trim($_POST['nome']));
	$dados['tbprod_campo']['nome'] = $nome_campo;
	$tipo_campo = strip_tags(trim($dados['tbprod_campo']['tipo']));
	$obrigatorio_campo = strip_tags(trim(@$dados['tbprod_campo']['obrigatorio']));
	$produto_id = strip_tags(trim($dados['tbprod_campo']['produto_id']));
	$ordem_campo = strip_tags(trim($dados['tbprod_campo']['ordem']));
	
	if(empty($nome_campo)) {
		$retorno = "<div class='alert alert-danger'>Informe o nome!</div>";
	}
	
	if (empty($retorno)) {
		$dados['tbprod_campo']['usuario_id'] = $_SESSION['usuario'];
		$dados['tbprod_campo']['criado'] = date('Y-m-d');
		$dados['tbprod_campo']['modificado'] = date('Y-m-d');
		
		if($resultado = $conecta->inserir($dados)){
			unset($nome_campo, $tipo_campo, $obrigatorio_campo, $ordem_campo); 
		}
		echo "<div class='alert alert-danger'>'.$resultado.'</div>";
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."\">\n";
	} else {
		echo $retorno;
	}
	
}else if(isset($_POST['salvar_produto'])){
	$dados = $_POST["dados"];
	
	$nome = strip_tags(trim($dados['tbproduto']['nome']));
	$referencia = strip_tags(trim($dados['tbproduto']['referencia']));
	$modelo = strip_tags(trim($dados['tbproduto']['modelo']));

	$marca = strip_tags(trim($dados['tbproduto']['marca']));
	$idsubcategoria = strip_tags(trim($dados['tbproduto']['subcategoria_id']));
	$estoque = strip_tags(trim($dados['tbproduto']['estoque']));
	$peso = strip_tags(trim($dados['tbproduto']['peso']));
	$altura = strip_tags(trim($dados['tbproduto']['altura']));
	$comprimento = strip_tags(trim($dados['tbproduto']['comprimento']));
	$largura = strip_tags(trim($dados['tbproduto']['largura']));
	
	$preco = strip_tags(trim($dados['tbproduto']['preco']));
	$dados['tbproduto']['preco'] = str_replace(",",".",str_replace(".","",$preco));
	
	$preco_promocional = strip_tags(trim($dados['tbproduto']['preco_promocional']));
	$dados['tbproduto']['preco_promocional'] = str_replace(",",".",str_replace(".","",$preco_promocional));
	
	$preco_promocional_inicio = strip_tags(trim($dados['tbproduto']['data_promocional_inicio']));
	$dados['tbproduto']['data_promocional_inicio'] = substr($preco_promocional_inicio,6,4)."-".substr($preco_promocional_inicio,3,2)."-".substr($preco_promocional_inicio,0,2);
	
	$preco_promocional_fim = strip_tags(trim($dados['tbproduto']['data_promocional_fim']));
	$dados['tbproduto']['data_promocional_fim'] = substr($preco_promocional_fim,6,4)."-".substr($preco_promocional_fim,3,2)."-".substr($preco_promocional_fim,0,2);
	
	$descricao = strip_tags(trim($dados['tbproduto']['descricao']));
	$especificacao = strip_tags(trim($dados['tbproduto']['especificacao']));
	$dadostecnicos = strip_tags(trim($dados['tbproduto']['dadostecnicos']));
	$inclusos = strip_tags(trim($dados['tbproduto']['inclusos']));
	$garantia = strip_tags(trim($dados['tbproduto']['garantia']));
	$status = strip_tags(trim($dados['tbproduto']['status']));
	$destaque_home = strip_tags(trim($dados['tbproduto']['destaque_home']));
	
	if(empty($nome)) {
		$retorno = "<div class='alert alert-danger'>Informe o nome do produto!</div>";
	}elseif (empty($idsubcategoria)) {
		$retorno = "<div class='alert alert-danger'>Selecione uma categoria para o produto!</div>";
	}elseif (empty($preco)) {
		$retorno = "<div class='alert alert-danger'>Informe o preço do produto!</div>";
	}
	
	if (empty($retorno)) {
		
		$dados['tbproduto']['usuario_id'] = $_SESSION['usuario'];
		$dados['tbproduto']['criado'] = date('Y-m-d');
		$dados['tbproduto']['modificado'] = date('Y-m-d');
		
		$resultado = $conecta->inserir($dados);
		$_GET['vw'] = 0;
		echo $resultado;
	} else {
		echo $retorno;
	}
}else if(isset($_POST['salvar_produto_continuar'])){
	echo '<img src="../images/carregando.gif" >';
	
	$dados = $_POST["dados"];
	
	$nome = strip_tags(trim($dados['tbproduto']['nome']));
	$referencia = strip_tags(trim($dados['tbproduto']['referencia']));
	$modelo = strip_tags(trim($dados['tbproduto']['modelo']));
	$marca = strip_tags(trim($dados['tbproduto']['marca']));
	$idsubcategoria = strip_tags(trim($dados['tbproduto']['subcategoria_id']));
	$estoque = strip_tags(trim($dados['tbproduto']['estoque']));
	$peso = strip_tags(trim($dados['tbproduto']['peso']));
	$altura = strip_tags(trim($dados['tbproduto']['altura']));
	$comprimento = strip_tags(trim($dados['tbproduto']['comprimento']));
	$largura = strip_tags(trim($dados['tbproduto']['largura']));
	
	
	$preco = strip_tags(trim($dados['tbproduto']['preco']));
	$dados['tbproduto']['preco'] = str_replace(",",".",str_replace(".","",$preco));
	
	$preco_promocional = strip_tags(trim($dados['tbproduto']['preco_promocional']));
	$dados['tbproduto']['preco_promocional'] = str_replace(",",".",str_replace(".","",$preco_promocional));
	
	$preco_promocional_inicio = strip_tags(trim($dados['tbproduto']['data_promocional_inicio']));
	$dados['tbproduto']['data_promocional_inicio'] = substr($preco_promocional_inicio,6,4)."-".substr($preco_promocional_inicio,3,2)."-".substr($preco_promocional_inicio,0,2);
	
	$preco_promocional_fim = strip_tags(trim($dados['tbproduto']['data_promocional_fim']));
	$dados['tbproduto']['data_promocional_fim'] = substr($preco_promocional_fim,6,4)."-".substr($preco_promocional_fim,3,2)."-".substr($preco_promocional_fim,0,2);
	
	$descricao = strip_tags(trim($dados['tbproduto']['descricao']));
	$especificacao = strip_tags(trim($dados['tbproduto']['especificacao']));
	$dadostecnicos = strip_tags(trim($dados['tbproduto']['dadostecnicos']));
	$inclusos = strip_tags(trim($dados['tbproduto']['inclusos']));
	$garantia = strip_tags(trim($dados['tbproduto']['garantia']));
	$status = strip_tags(trim($dados['tbproduto']['status']));
	$destaque_home = strip_tags(trim($dados['tbproduto']['destaque_home']));
	
	if(empty($nome)) {
		$retorno = "<div class='alert alert-danger'>Informe o nome do produto!</span>";
	}elseif (empty($idsubcategoria)) {
		$retorno = "<div class='alert alert-danger'>Selecione uma categoria para o produto!</div>";
	}elseif (empty($preco)) {
		$retorno = "<div class='alert alert-danger'>Informe o preço do produto!</div>";
	}
	
	if (empty($retorno)) {
		$dados['tbproduto']['usuario_id'] = $_SESSION['usuario'];
		$dados['tbproduto']['criado'] = date('Y-m-d');
		$dados['tbproduto']['modificado'] = date('Y-m-d');
		
		$resultadoID = $conecta->inserirID($dados);
		if($resultadoID == 1){
			echo "<div class='alert alert-success'>Dados salvos com sucesso!</div>";
		} else {
			echo "<div class='alert alert-danger'>Não foi possível salvar os dados!</div>";
		}
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."&amp;id=".$resultadoID."\">\n";
	} else {
		echo $retorno;
	}
	
}else if(isset($_POST['alterar_produto'])){
	$dados = $_POST["dados"];
	
	$id = strip_tags(trim($dados['tbproduto']['id']));
	$nome = strip_tags(trim($dados['tbproduto']['nome']));
	$referencia = strip_tags(trim($dados['tbproduto']['referencia']));
	$modelo = strip_tags(trim($dados['tbproduto']['modelo']));
	$marca = strip_tags(trim($dados['tbproduto']['marca']));
	$idsubcategoria = strip_tags(trim($dados['tbproduto']['subcategoria_id']));
	$estoque = strip_tags(trim($dados['tbproduto']['estoque']));
	$peso = strip_tags(trim($dados['tbproduto']['peso']));
	$altura = strip_tags(trim($dados['tbproduto']['altura']));
	$comprimento = strip_tags(trim($dados['tbproduto']['comprimento']));
	$largura = strip_tags(trim($dados['tbproduto']['largura']));
	$tag = strip_tags(trim($dados['tbproduto']['tag']));
	$description = strip_tags(trim($dados['tbproduto']['description']));
	$keyword = strip_tags(trim($dados['tbproduto']['keyword']));
	
	$preco = strip_tags(trim($dados['tbproduto']['preco']));
	$dados['tbproduto']['preco'] = str_replace(",",".",str_replace(".","",$preco));
	
	$preco_promocional = strip_tags(trim($dados['tbproduto']['preco_promocional']));
	$dados['tbproduto']['preco_promocional'] = str_replace(",",".",str_replace(".","",$preco_promocional));
	
	$preco_promocional_inicio = strip_tags(trim($dados['tbproduto']['data_promocional_inicio']));
	$dados['tbproduto']['data_promocional_inicio'] = substr($preco_promocional_inicio,6,4)."-".substr($preco_promocional_inicio,3,2)."-".substr($preco_promocional_inicio,0,2);
	
	$preco_promocional_fim = strip_tags(trim($dados['tbproduto']['data_promocional_fim']));
	$dados['tbproduto']['data_promocional_fim'] = substr($preco_promocional_fim,6,4)."-".substr($preco_promocional_fim,3,2)."-".substr($preco_promocional_fim,0,2);
	
	$descricao = strip_tags(trim($dados['tbproduto']['descricao']));
	$especificacao = strip_tags(trim($dados['tbproduto']['especificacao']));
	$dadostecnicos = strip_tags(trim($dados['tbproduto']['dadostecnicos']));
	$inclusos = strip_tags(trim($dados['tbproduto']['inclusos']));
	$garantia = strip_tags(trim($dados['tbproduto']['garantia']));
	$status = strip_tags(trim($dados['tbproduto']['status']));
	$destaque_home = strip_tags(trim($dados['tbproduto']['destaque_home']));
	
	$string = " id = $id";
	
	if(empty($nome)) {
		$retorno = "<div class='alert alert-danger'>Informe o nome do produto!</div>";
	}elseif (empty($idsubcategoria)) {
		$retorno = "<div class='alert alert-danger'>Selecione uma categoria para o produto!</div>";
	}elseif (empty($preco)) {
		$retorno = "<div class='alert alert-danger'>Informe o preço do produto!</div>";
	}
	
	if (empty($retorno)) {
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo $resultado;
	} else {
		echo $retorno;
	}
}else if(isset($_POST['alterar_produto_continuar'])){
	echo '<img src="../images/carregando.gif" >';
	
	$dados = $_POST["dados"];
		
	$id = strip_tags(trim($dados['tbproduto']['id']));
	$nome = strip_tags(trim($dados['tbproduto']['nome']));
	$referencia = strip_tags(trim($dados['tbproduto']['referencia']));
	$modelo = strip_tags(trim($dados['tbproduto']['modelo']));
	$marca = strip_tags(trim($dados['tbproduto']['marca']));
	$idsubcategoria = strip_tags(trim($dados['tbproduto']['subcategoria_id']));
	$estoque = strip_tags(trim($dados['tbproduto']['estoque']));
	$peso = strip_tags(trim($dados['tbproduto']['peso']));
	$altura = strip_tags(trim($dados['tbproduto']['altura']));
	$comprimento = strip_tags(trim($dados['tbproduto']['comprimento']));
	$largura = strip_tags(trim($dados['tbproduto']['largura']));
	$tag = strip_tags(trim($dados['tbproduto']['tag']));
	$description = strip_tags(trim($dados['tbproduto']['description']));
	$keyword = strip_tags(trim($dados['tbproduto']['keyword']));
	
	$preco = strip_tags(trim($dados['tbproduto']['preco']));
	$dados['tbproduto']['preco'] = str_replace(",",".",str_replace(".","",$preco));
	
	$preco_promocional = strip_tags(trim($dados['tbproduto']['preco_promocional']));
	$dados['tbproduto']['preco_promocional'] = str_replace(",",".",str_replace(".","",$preco_promocional));
	
	$preco_promocional_inicio = strip_tags(trim($dados['tbproduto']['data_promocional_inicio']));
	$dados['tbproduto']['data_promocional_inicio'] = substr($preco_promocional_inicio,6,4)."-".substr($preco_promocional_inicio,3,2)."-".substr($preco_promocional_inicio,0,2);
	
	$preco_promocional_fim = strip_tags(trim($dados['tbproduto']['data_promocional_fim']));
	$dados['tbproduto']['data_promocional_fim'] = substr($preco_promocional_fim,6,4)."-".substr($preco_promocional_fim,3,2)."-".substr($preco_promocional_fim,0,2);
	
	$descricao = strip_tags(trim($dados['tbproduto']['descricao']));
	$especificacao = strip_tags(trim($dados['tbproduto']['especificacao']));
	$dadostecnicos = strip_tags(trim($dados['tbproduto']['dadostecnicos']));
	$inclusos = strip_tags(trim($dados['tbproduto']['inclusos']));
	$garantia = strip_tags(trim($dados['tbproduto']['garantia']));
	$status = strip_tags(trim($dados['tbproduto']['status']));
	$destaque_home = strip_tags(trim($dados['tbproduto']['destaque_home']));
	
	$string = " id = $id";
	
	if(empty($nome)) {
		$retorno = "<div class='alert alert-danger'>Informe o nome do produto!</div>";
	}elseif (empty($idsubcategoria)) {
		$retorno = "<div class='alert alert-danger'>Selecione uma categoria para o produto!</div>";
	}elseif (empty($preco)) {
		$retorno = "<div class='alert alert-danger'>Informe o preço do produto!</div>";
	}
	
	if (empty($retorno)) {
		$resultado = $conecta->alterar($dados, $string);
		echo $resultado;
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."\">\n";
	} else {
		echo $retorno;
	}
}else if(isset($_POST['alterar_campos'])){
	$campos = $_POST['campo'];
	$ordem_campo2 = $_POST['ordem_campo2'];
	$tipo_preco2 = $_POST['tipo_preco2'];
	$preco_campo = $_POST['preco_campo'];
	$label = $_POST['label'];
	$tipo_cam = $_POST['tipo_validacao'];
	
	$j = 0;
	foreach($campos as $camp){
		$string = " id = ".$camp;	
		
		$dados['tbprod_campo']['preco'] = str_replace(",",".",str_replace(".","",$preco_campo[$j]));;
		$dados['tbprod_campo']['tipo_preco'] = $tipo_preco2[$j];
		$dados['tbprod_campo']['ordem'] = $ordem_campo2[$j];
		
		
		if($tipo_cam[$j] == 'select'){
			$opcoes = $_POST['nome_opcao'];
			$val = $_POST['valor_opcao'];
			$x = 0;
			$sql_limpa = "DELETE FROM tbprod_subcampo WHERE campo_id = ".$camp;
			$conecta->selecionar($conecta->conn,$sql_limpa);
			foreach($opcoes as $op){
				$dados2['tbprod_subcampo']['item'] = $op;
				$dados2['tbprod_subcampo']['value'] = $val[$x];
				$dados2['tbprod_subcampo']['campo_id'] = $camp;
				
				$conecta->inserir($dados2);
				$x++;
			}
		} else {
			$dados['tbprod_campo']['value'] = $_POST[sem_especiais($label[$j])];
		}
		
		$conecta->alterar($dados, $string);
		
		$j++;
	}
	$_GET['vw'] = 0;
}else if(isset($_POST['alterar_campos_continuar'])){
	echo '<img src="../images/carregando.gif" >';
	
	$campos = $_POST['campo'];
	$ordem_campo2 = $_POST['ordem_campo2'];
	$tipo_preco2 = $_POST['tipo_preco2'];
	$preco_campo = $_POST['preco_campo'];
	$label = $_POST['label'];
	$tipo_cam = $_POST['tipo_validacao'];
	
	$j = 0;
	foreach($campos as $camp){
		$string = " id = ".$camp;	
		
		$dados['tbprod_campo']['preco'] = str_replace(",",".",str_replace(".","",$preco_campo[$j]));;
		$dados['tbprod_campo']['tipo_preco'] = $tipo_preco2[$j];
		$dados['tbprod_campo']['ordem'] = $ordem_campo2[$j];
		
		
		if($tipo_cam[$j] == 'select'){
			$opcoes = $_POST['nome_opcao'];
			$val = $_POST['valor_opcao'];
			$x = 0;
			$sql_limpa = "DELETE FROM tbprod_subcampo WHERE campo_id = ".$camp;
			$conecta->selecionar($conecta->conn,$sql_limpa);
			foreach($opcoes as $op){
				$dados2['tbprod_subcampo']['item'] = $op;
				$dados2['tbprod_subcampo']['value'] = $val[$x];
				$dados2['tbprod_subcampo']['campo_id'] = $camp;
				
				$conecta->inserir($dados2);
				$x++;
			}
		} else {
			$dados['tbprod_campo']['value'] = $_POST[sem_especiais($label[$j])];
		}
		
		$conecta->alterar($dados, $string);
		
		$j++;
	}
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."\">\n";
}else if(isset($_POST['alterar_tamanhos'])){
	$produto = $_GET['id'];
	$tamanho = $_POST['tamanho_opcao'];
	$cor = $_POST['cor_opcao'];
	$qtde = $_POST['qtde_opcao'];
	$x = 0;
	$sql_limpa = "DELETE FROM tbprod_tamanhocor WHERE produto_id = ".$produto;
	$conecta->selecionar($conecta->conn,$sql_limpa);
	foreach($tamanho as $ta){
		$dados2['tbprod_tamanhocor']['tamanho'] = $ta;
		$dados2['tbprod_tamanhocor']['cor'] = $cor[$x];
		$dados2['tbprod_tamanhocor']['quantidade'] = $qtde[$x];
		$dados2['tbprod_tamanhocor']['produto_id'] = $produto;
		
		$conecta->inserir($dados2);
		$x++;
	}
	$_GET['vw'] = 0;
}else if(isset($_POST['alterar_tamanhos_continuar'])){
	echo '<img src="../images/carregando.gif" >';
	
	$produto = $_GET['id'];
	$tamanho = $_POST['tamanho_opcao'];
	$cor = $_POST['cor_opcao'];
	$qtde = $_POST['qtde_opcao'];
	$x = 0;
	$sql_limpa = "DELETE FROM tbprod_tamanhocor WHERE produto_id = ".$produto;
	$conecta->selecionar($conecta->conn,$sql_limpa);
	foreach($tamanho as $ta){
		$dados2['tbprod_tamanhocor']['tamanho'] = $ta;
		$dados2['tbprod_tamanhocor']['cor'] = $cor[$x];
		$dados2['tbprod_tamanhocor']['quantidade'] = $qtde[$x];
		$dados2['tbprod_tamanhocor']['produto_id'] = $produto;
		
		$conecta->inserir($dados2);
		$x++;
	}
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."\">\n";
}else if(isset($_POST['alterar_imagem'])){
	$fotos = $_POST['foto'];
	$legenda = $_POST['legenda'];
	$destaque = $_POST['destaque'];
	$banner = $_POST['banner'];
	$ordem = $_POST['ordem'];

	$j = 0;
	foreach($fotos as $fot){
		$string = " id = ".$fot;
		
		$dados['tbprod_foto']['legenda'] = $legenda[$j];
		if($destaque[0] == $fot){
			$dados2['tbprod_foto']['destaque'] = 1;
		} else {
			$dados['tbprod_foto']['destaque'] = 0;
		}
		if($banner[0] == $fot){
			$dados2['tbprod_foto']['banner'] = 1;
		} else {
			$dados['tbprod_foto']['banner'] = 0;
		}
		if($ordem[$j] == '' || $ordem[$j] == 9 || $ordem[$j] == 0){
			$dados2['tbprod_foto']['ordem'] = 9;
		} else {
			$dados2['tbprod_foto']['ordem'] = $ordem[$j];
		}
		if($legenda[$j] == ''){
			$dados2['tbprod_foto']['legenda'] = '';
		} else {
			$dados2['tbprod_foto']['legenda'] = $legenda[$j];
		}
		//print_r($dados);
		$conecta->alterar($dados2, $string);
		
		$j++;
	}
	$_GET['vw'] = 0;
	 
}else if(isset($_POST['alterar_imagem_continuar'])){
	echo '<img src="../images/carregando.gif" >';
	
	$fotos = $_POST['foto'];
	$legenda = $_POST['legenda'];
	$destaque = $_POST['destaque'];
	$banner = $_POST['banner'];
	$ordem = $_POST['ordem'];

	$j = 0;
	foreach($fotos as $fot){
		$string = " id = ".$fot;
		
		$dados['tbprod_foto']['legenda'] = $legenda[$j];
		if($destaque[0] == $fot){
			$dados2['tbprod_foto']['destaque'] = 1;
		} else {
			$dados2['tbprod_foto']['destaque'] = 0;
		}
		if($banner[0] == $fot){
			$dados2['tbprod_foto']['banner'] = 1;
		} else {
			$dados2['tbprod_foto']['banner'] = 0;
		}
		if($ordem[$j] == '' || $ordem[$j] == 9 || $ordem[$j] == 0){
			$dados2['tbprod_foto']['ordem'] = 9;
		} else {
			$dados2['tbprod_foto']['ordem'] = $ordem[$j];
		}
		if($legenda[$j] == ''){
			$dados2['tbprod_foto']['legenda'] = '';
		} else {
			$dados2['tbprod_foto']['legenda'] = $legenda[$j];
		}
		//print_r($dados2);
		$conecta->alterar($dados2, $string);
		
		$j++;
	}
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."\">\n";
}elseif(isset($_POST['alterar_relacionados'])){
	if(@$_POST['rela_exclui']){
		foreach(@$_POST['rela_exclui'] as $coexc){		
			$sql_exclui_rela = "DELETE FROM tbprod_relacionado WHERE produto_id = ".$_POST['produto_id']." AND id = ".$coexc;
			$conecta->selecionar($conecta->conn,$sql_exclui_rela);
		}
	}
	if(@$_POST['relaciona']){
		foreach(@$_POST['relaciona'] as $rela){
			$dados2['tbprod_relacionado']['produto_id'] = $_POST['produto_id'];
			$dados2['tbprod_relacionado']['relacionado_id'] = $rela;
			$conecta->inserir($dados2);
		}
	}
	$_GET['vw'] = 0;
}elseif(isset($_POST['alterar_relacionados_continuar'])){
	print_r($_POST);
	if(@$_POST['rela_exclui']){
		foreach(@$_POST['rela_exclui'] as $coexc){		
			$sql_exclui_rela = "DELETE FROM tbprod_relacionado WHERE produto_id = ".$_POST['produto_id']." AND id = ".$coexc;
			$conecta->selecionar($conecta->conn,$sql_exclui_rela);
		}
	}
	if(@$_POST['relaciona']){
		foreach(@$_POST['relaciona'] as $rela){
			$dados2['tbprod_relacionado']['produto_id'] = $_POST['produto_id'];
			$dados2['tbprod_relacionado']['relacionado_id'] = $rela;
			$conecta->inserir($dados2);
		}
	}
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['REQUEST_URI']."\">\n";
}elseif(isset($_GET['apagar']) && @$_GET['apagar'] != ""){
	$pasta = "../imagens/";
	$apagar = $_GET['apagar'];
	$sql_busca_foto = "SELECT foto FROM tbprod_foto WHERE produto_id = ".$apagar;
	$resultado_busca_foto = $conecta->selecionar($conecta->conn,$sql_busca_foto);
	while($rs_busca_foto = mysqli_fetch_array($resultado_busca_foto)){	
		$foto_busca = $rs_busca_foto['foto'];
	
		if($foto_busca != '') {
			unlink($pasta.'/'.$foto_busca);
		}	
	}
	$sql_busca_sub = "SELECT id FROM tbprod_campo WHERE produto_id = ".$apagar;
	$resultado_busca_sub = $conecta->selecionar($conecta->conn,$sql_busca_sub);
	
	while($rs_campo = mysqli_fetch_array($resultado_busca_sub)){
		$sql_delete_campos = "DELETE FROM tbprod_campo WHERE campo_id = ".$rs_campo['id'];
		$conecta->selecionar($conecta->conn,$sql_delete_campos);
	}
	
	$sql_delete_foto = "DELETE FROM tbprod_foto WHERE produto_id = ".$apagar;
	$sql_delete_campo = "DELETE FROM tbprod_campo WHERE produto_id = ".$apagar;
	$sql_delete_produto = "DELETE FROM tbproduto WHERE id = ".$apagar;
	
	$conecta->selecionar($conecta->conn,$sql_delete_foto);
	$conecta->selecionar($conecta->conn,$sql_delete_campo);
	if($conecta->selecionar($conecta->conn,$sql_delete_produto)){	
		echo "<div class='alert alert-success'>Produto apagado com sucesso!</div>";
	}
	
}elseif(isset($_GET['id']) && @$_GET['id'] != ""){
	
	$sql = "SELECT * FROM tbproduto WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn,$sql);
	$dados['tbproduto'] = mysqli_fetch_array($resultado);
		
	$nome = $dados['tbproduto']['nome'];
	$referencia = $dados['tbproduto']['referencia'];
	$modelo = $dados['tbproduto']['modelo'];
	$marca = $dados['tbproduto']['marca'];
	$idsubcategoria = $dados['tbproduto']['subcategoria_id'];
	$estoque = $dados['tbproduto']['estoque'];
	$peso = $dados['tbproduto']['peso'];
	$altura = $dados['tbproduto']['altura'];
	$comprimento = $dados['tbproduto']['comprimento'];
	$largura = $dados['tbproduto']['largura'];
	$tag = $dados['tbproduto']['tag'];
	$description = $dados['tbproduto']['description'];
	$keyword = $dados['tbproduto']['keyword'];
	
	$preco = $dados['tbproduto']['preco'];
	$dados['tbproduto']['preco'] = str_replace(",",".",str_replace(".","",$preco));
	
	$preco_promocional = $dados['tbproduto']['preco_promocional'];
	$dados['tbproduto']['preco_promocional'] = str_replace(",",".",str_replace(".","",$preco_promocional));
	
	$preco_promocional_inicio = substr($dados['tbproduto']['data_promocional_inicio'],8,2)."/".substr($dados['tbproduto']['data_promocional_inicio'],5,2)."/".substr($dados['tbproduto']['data_promocional_inicio'],0,4);
	$preco_promocional_fim = substr($dados['tbproduto']['data_promocional_fim'],8,2)."/".substr($dados['tbproduto']['data_promocional_fim'],5,2)."/".substr($dados['tbproduto']['data_promocional_fim'],0,4);
	$descricao = $dados['tbproduto']['descricao'];
	$especificacao = $dados['tbproduto']['especificacao'];
	$dadostecnicos = $dados['tbproduto']['dadostecnicos'];
	$inclusos = $dados['tbproduto']['inclusos'];
	$garantia = $dados['tbproduto']['garantia'];
	$destaque_home = $dados['tbproduto']['destaque_home'];
	$status = $dados['tbproduto']['status'];

	$sql_fotos = "SELECT count(*) as qtde FROM tbprod_foto WHERE produto_id = ".$id;
	$resultado_fotos = $conecta->selecionar($conecta->conn,$sql_fotos);
	
	if($qtde_fotos = mysqli_fetch_array($resultado_fotos)){	
		$sobra = $qtde_imagem - $qtde_fotos['qtde'];
	}
	
	if($sobra <= 0){
		$sobra = 0;
	} 
}

?>
	<script src="../uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	
    <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '../uploadify/uploadify.swf',
				'uploader' : '../uploadify/uploadify_produto.php?id=<?php echo @$_GET['id'];?>',
				'cancelImg' : '../uploadify/cancel.png',
				'folder'    : '../imagens',
				'fileExt'     : '*.jpg;*.gif;*.png',
				'uploadLimit' : <?php echo @$sobra; ?>,
				'width' : '200',
				'height' : '30',
				'buttonText'  : 'Selecione Fotos',
				'multi'		: true,
				'onQueueComplete' : function(queueData) {
				  	window.location.reload(true);
				}
			});
		});
		
		
		function adicionar(id , nome){
			var nomeja = document.getElementById('prdrelacionado').innerHTML;
			/*$contInput = new Number(document.getElementById('contador').value);
			$contInput++;
			document.getElementById('contador').value = $contInput;
			if($contInput > 5){
				alert("São permitidos apenas 5 co-autores.");	
			} else {*/
				var soma = nomeja + "<br>" + "- "+nome+"<input type='hidden' value='"+id+"' name='relaciona[]' />";
				document.getElementById('prdrelacionado').innerHTML = soma;
			//}
		}
		function desabilitarCo(idco){
			document.getElementById("re"+idco).disabled = true;	
		}
	</script>
    

    <a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir <?php echo $nometela;?></button></a>
    <a href="home.php?pagina=subcategoriaproduto&amp;tela=21"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Nova Sub-Categoria</button></a>
    <a href="home.php?pagina=categoriaproduto&amp;tela=21"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Nova Categoria</button></a><a href="home.php?pagina=marcaproduto&amp;tela=21"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Nova Marca</button></a>
                
    <div class="separa"></div>
    
	<?php if(@$_GET['vw'] == 1) {?>

	
    
    <ul class="nav nav-tabs separa_bottom">
    	<li <?php if(@$_GET['box'] == 'formularioProduto' || (@$_GET['box'] == '')){ echo 'class="active"'; }?>>
        <a id="aba_dados" href="home.php?pagina=produto&tela=<?php echo $_GET['tela']?>&vw=1&id=<?php echo $id;?>&amp;aba=aba_dados&amp;box=formularioProduto#formularioProduto" >Dados Gerais</a>
        </li>
        <?php if(@$id == "") { ?>
        <li><a><span title="Salvar o produto antes de acessar este aba!">Campos Personalizados</span></a></li>
        <li><a><span title="Salvar o produto antes de acessar este aba!">Imagens</span></a></li>
        <li><a><span title="Salvar o produto antes de acessar este aba!">Tamanhos / Cores</span></a></li>
        <li><a><span title="Salvar o produto antes de acessar este aba!">Produtos Relacionados</span></a></li>
		<?php } else {?>
        <li <?php if(@$_GET['box'] == 'formularioCampos'){ echo 'class="active"'; }?>><a id="aba_campos" href="home.php?pagina=produto&tela=<?php echo $_GET['tela']?>&vw=1&id=<?php echo $id;?>&amp;aba=aba_campos&amp;box=formularioCampos#formularioCampos">Campos Personalizados</a></li>
        <li <?php if(@$_GET['box'] == 'formularioImagem'){ echo 'class="active"'; }?>><a id="aba_imagens" href="home.php?pagina=produto&tela=<?php echo $_GET['tela']?>&vw=1&id=<?php echo $id;?>&amp;aba=aba_imagens&amp;box=formularioImagem#formularioImagem">Imagens</a></li>
        <li <?php if(@$_GET['box'] == 'formularioTamanho'){ echo 'class="active"'; }?>><a id="aba_imagens" href="home.php?pagina=produto&tela=<?php echo $_GET['tela']?>&vw=1&id=<?php echo $id;?>&amp;aba=aba_tamanhos&amp;box=formularioTamanho#formularioTamanho">Tamanhos / Cores</a></li>
        <li <?php if(@$_GET['box'] == 'formularioRelacionado'){ echo 'class="active"'; }?>><a id="aba_imagens" href="home.php?pagina=produto&tela=<?php echo $_GET['tela']?>&vw=1&id=<?php echo $id;?>&amp;aba=aba_relacionados&amp;box=formularioRelacionado#formularioRelacionado">Produtos Relacionados</a></li>
        <?php } ?>
    </ul>
	 
	<div id='formularioProduto' class="abas">
	<form action="" method="post" enctype="multipart/form-data" name="formProduto" class="form-horizontal" role="form">
        <input type="hidden" name="dados[tbproduto][id]" value="<?php echo @$id; ?>"  />
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Nome</label>
        <div class="col-sm-9">
        <input type="text" name="dados[tbproduto][nome]" value="<?php echo @$nome;?>" class="form-control" />
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Código Referência</label>
        <div class="col-sm-9">
        <input type="text" name="dados[tbproduto][referencia]" style="width:200px; display:inline;" value="<?php echo @$referencia;?>" class="form-control" />
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Categoria->SubCategoria</label>
        <div class="col-sm-9">
        <select name="dados[tbproduto][subcategoria_id]" class="form-control">
            <option value="" class="inputCampo" >Selecione...</option>
            <?php
                $resultadoCategoria = $conecta->selecionar($conecta->conn,"SELECT c.titulo as categoria, s.titulo as sub, s.id as id FROM tbprod_categoria c, tbprod_subcategoria s where s.categoria_id = c.id ORDER BY c.titulo, s.titulo ASC");
                while($rsCategoria = mysqli_fetch_array($resultadoCategoria)){
            ?>
            <option <?php if(@$idsubcategoria == @$rsCategoria['id']) { echo "selected"; } ?> value="<?php echo @$rsCategoria['id']; ?>" ><?php echo @$rsCategoria['categoria']."->".@$rsCategoria['sub']; ?></option>
            <?php }
            ?>
        </select>
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Marca</label>
        <div class="col-sm-9">
        <select name="dados[tbproduto][marca]" class="form-control">
            <option value="" class="inputCampo" >Selecione...</option>
            <?php
                $resultadoMarca = $conecta->selecionar($conecta->conn,"SELECT * FROM tbprod_marca ORDER BY titulo ASC");
                while($rsMarca = mysqli_fetch_array($resultadoMarca)){
            ?>
            <option <?php if(@$marca == @$rsMarca['id']) { echo "selected"; } ?> value="<?php echo @$rsMarca['id']; ?>" ><?php echo @$rsMarca['titulo']; ?></option>
            <?php }
            ?>
        </select>
        </div>
        </div>
        
       
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Modelo</label>
        <div class="col-sm-9">
        <input type="text" name="dados[tbproduto][modelo]" value="<?php echo @$modelo; ?>" class="form-control" />
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Estoque</label>
        <div class="col-sm-9">
        <input style="width:200px; display:inline;"  type="text" name="dados[tbproduto][estoque]" value="<?php echo @$estoque; ?>" class="form-control" id="estoque" />
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Preço</label>
        <div class="col-sm-9">
        <input style="width:200px; display:inline;" type="text" name="dados[tbproduto][preco]" value="<?php echo str_replace(".",",",@$preco); ?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" class="form-control" />
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Preço Promocional</label>
        <div class="col-sm-9">
        <input style="width:200px; display:inline;" type="text" name="dados[tbproduto][preco_promocional]" value="<?php echo str_replace(".",",",@$preco_promocional); ?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" class="form-control" />
        </div>
        </div>
        
       
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Período Promocional</label>
        <div class="col-sm-9">
        <input style="width:200px; display:inline;" class="form-control datepicker" id="data1" type="text" name="dados[tbproduto][data_promocional_inicio]" value="<?php echo @$preco_promocional_inicio; ?>" /> à <input style="width:200px; display:inline;" type="text" name="dados[tbproduto][data_promocional_fim]" value="<?php echo @$preco_promocional_fim; ?>"  class="form-control datepicker" id="data2" />
    	</div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Descrição</label>
        <div class="col-sm-9">
        <textarea class="form-control" rows="10" cols="70" name="dados[tbproduto][descricao]" ><?php echo @$descricao;?></textarea>
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Peso</label>
        <div class="col-sm-9">
        <input class="form-control" style="width:200px; display:inline;"  type="text" name="dados[tbproduto][peso]" value="<?php echo @$peso; ?>"  /> kg
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Altura</label>
        <div class="col-sm-9">
        <input class="form-control" style="width:200px; display:inline;"  type="text" name="dados[tbproduto][altura]" value="<?php echo @$altura; ?>"  /> cm
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Largura</label>
        <div class="col-sm-9">
        <input class="form-control" style="width:200px; display:inline;"  type="text" name="dados[tbproduto][largura]" value="<?php echo @$largura; ?>"  /> cm
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Comprimento</label>
        <div class="col-sm-9">
        <input class="form-control" style="width:200px; display:inline;"  type="text" name="dados[tbproduto][comprimento]" value="<?php echo @$comprimento; ?>"  /> cm
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Especificação</label>
        <div class="col-sm-9">
        <textarea class="form-control" rows="10" cols="70" name="dados[tbproduto][especificacao]" ><?php echo @$especificacao;?></textarea>
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Dados Técnicos</label>
        <div class="col-sm-9">
        <textarea class="form-control" rows="10" cols="70" name="dados[tbproduto][dadostecnicos]" ><?php echo @$dadostecnicos;?></textarea>
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Itens Inclusos</label>
        <div class="col-sm-9">
        <textarea class="form-control" rows="10" cols="70" name="dados[tbproduto][inclusos]" ><?php echo @$inclusos;?></textarea>
        </div>
        </div>
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Garantia</label>
        <div class="col-sm-9">
        <textarea class="form-control" rows="10" cols="70" name="dados[tbproduto][garantia]" ><?php echo @$garantia;?></textarea>
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Apresentar na Página Inicial em Populares</label>
        <div class="col-sm-9">
        <input type="radio" name="dados[tbproduto][destaque_home]" <?php if(@$destaque_home == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">&nbsp;Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if(@$destaque_home == 0 ) { echo "checked"; } ?> name="dados[tbproduto][destaque_home]" value="0" /><span class="dados_grid">&nbsp;Não</span>
        </div>
        </div>
        
        <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Disponível</label>
        <div class="col-sm-9">
        <input type="radio" name="dados[tbproduto][status]" <?php if(@$status == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">&nbsp;Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if(@$status == 0 ) { echo "checked"; } ?> name="dados[tbproduto][status]" value="0" /><span class="dados_grid">&nbsp;Não</span>
        </div>
        </div>
        
        <div class="form-group">
            <label for="fonte" class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10">
              <input type="text" name="dados[tbproduto][tag]" value="<?php echo @$tag; ?>" class="form-control" id="tag" placeholder="Tags" style="width:100% !important;" data-role="tagsinput" />
            </div>
        </div>
        
        <div class="form-group">
            <label for="fonte" class="col-sm-2 control-label">Palavras chaves (Meta Keywords)</label>
            <div class="col-sm-10">
              <input type="text" name="dados[tbproduto][keyword]" value="<?php echo @$keyword; ?>" class="form-control" id="fonte" placeholder="Keywords">
            </div>
        </div>
        
        <div class="form-group">
            <label for="fonte" class="col-sm-2 control-label">Descrição (Meta Description)</label>
            <div class="col-sm-10">
              <input type="text" name="dados[tbproduto][description]" value="<?php echo @$description; ?>" class="form-control" id="fonte" placeholder="Description">
            </div>
        </div>
        
        <div class="form-group">
        <input class="btn btn-default btn_direita" type="submit" <?php if(isset($_GET['id']) && $_GET['id'] != ""){ echo 'name="alterar_produto" id="alterar_produto"'; } else{ echo 'name="salvar_produto" id="salvar_produto"'; } ?> value="salvar dados gerais"  />
        <input class="btn btn-default btn_direita" type="submit" <?php if(isset($_GET['id']) && $_GET['id'] != ""){ echo 'name="alterar_produto_continuar" id="alterar_produto_continuar"'; } else{ echo 'name="salvar_produto_continuar" id="salvar_produto_continuar"'; } ?> value="salvar dados gerais e continuar no produto"  /> 
        </div>
        </form>
    </div>
        
    <div id="formularioCampos" class="abas">
        <form action="" method="post" enctype="multipart/form-data" name="formNovoCampo" >
        	<input type="hidden" name="dados[tbprod_campo][produto_id]" value="<?php echo $id;?>" />
        	
            <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Título</th>
                  <th>Tipo</th>
                  <th class="central">Obrigatório</th>
                  <th class="central">Ordem</th>
                  <th class="central"></th>
                </tr>
              </thead>
              <tbody>
         
            <tr>
            	<td align="center"><input type="text" name="nome" value="<?php echo @$nome_campo;?>" class="form-control" /></td>
                <td align="center">
                	<select name="dados[tbprod_campo][tipo]" class="form-control">
                    	<option value="">Selecione o tipo</option>
                        <option value="select" <?php if(@$tipo_campo == 'select') { echo "selected";} ?> >Seleção</option>
                        <option value="text" <?php if(@$tipo_campo == 'text') { echo "selected";} ?> >Texto Curto</option>
                        <option value="textarea" <?php if(@$tipo_campo == 'textarea') { echo "selected";} ?> >Texto Longo</option>
                        <option value="campo" <?php if(@$tipo_campo == 'campo') { echo "selected";} ?> >Campo Texto Editável</option>
                    </select>
                </td>
                <td align="center"><input type="checkbox" value="1" <?php if(@$obrigatorio_campo == '1') { echo "checked";} ?> name="dados[tbprod_campo][obrigatorio]"/></td>
                <td align="center"><input type="text" name="dados[tbprod_campo][ordem]" value="<?php echo @$ordem_campo;?>" class="form-control" maxlength="3" style="width:50px; float:none;" /></td>
                <td align="center"><input type="submit" value="Novo Campo" onclick="return validar_novocampo();" name="novo_campo" class="btn btn-default" /></td>
            </tr>
         </table>
         </form>

         <?php
         	$sql_sub = "SELECT * FROM tbprod_campo WHERE produto_id = ".$id." ORDER BY ordem ASC";
			$resultado_sub = $conecta->selecionar($conecta->conn,$sql_sub);
			
			$existe_campos = mysqli_num_rows($resultado_sub);
			if($existe_campos > 0){
		 ?>
         
         <form action="" method="post" enctype="multipart/form-data" name="formcampos">
         <div class="table-responsive">
         <table cellpadding="5" cellspacing="2" width="100%" border="1" bordercolor="#CCCCCC" class="table table-hover" style="margin-bottom:15px;" >
            <tr bgcolor="#CCCCCC" class="tr_table" style="font-weight:bold;">
                <td width="9%" align="center">&nbsp;</td>
                <td width="30%" align="center">Nome</td>
                <td width="15%" align="center">Tipo</td>
                <td width="10%" align="center">Obrigatório</td>
                <td width="6%" align="center">Ordem</td>
                <td width="14%" align="center">Tipo Preço</td>
                <td width="10%" align="center">Preço</td>
                <td width="6%" align="center">Excluir</td>
            </tr>
            <?php $i = 1;  while($rs_sub = mysqli_fetch_array($resultado_sub)) { 
				
					$cor = '#EFEFEF';
				
			?>
            <input type="hidden" name="campo[]" value="<?php echo $rs_sub['id'];?>" />
            <input type="hidden" name="label[]" value="<?php echo $rs_sub['nome'];?>" />
            <tr bgcolor="<?php echo @$cor;?>" style="font:12px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000;">
                <td width="5%" align="center" valign="middle"><?php echo $i;?></td>
                <td width="25%" align="center" valign="middle"><?php echo $rs_sub['nome'];?></td>
                <td width="10%" align="center" valign="middle"><?php echo ($rs_sub['tipo'] == 'text' ? "Texto curto" : ($rs_sub['tipo'] == 'textarea' ? "Texto longo" : "Seleção"));?></td>
                <td width="10%" align="center"><?php echo ($rs_sub['nome'] == 1 ? "Sim" : "Não");?></td>
                <td width="10%" align="center"><input type="text" class="form-control" name="ordem_campo2[]" value="<?php echo $rs_sub['ordem'];?>" maxlength="3" style="width:50px; float:none;" /></td>
                <td width="10%" align="center">
                	<select name="tipo_preco2[]" class="form-control">
                    	<option value="">Selecione</option>
                        <option value="per" <?php if($rs_sub['tipo_preco'] == 'per') { echo "selected"; }?>>Percentual</option>
                        <option value="fixo" <?php if($rs_sub['tipo_preco'] == 'fixo') { echo "selected"; }?>>Fixo</option>
                    </select>
                </td>
                <td width="10%" align="center"><input type="text" name="preco_campo[]" class="form-control" value="<?php echo str_replace(".",",",@$rs_sub['preco']); ?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" style="width:80px; float:none;" /></td>
                <td width="10%" align="center"><a href="<?php echo $_SERVER ['REQUEST_URI'];?>&amp;c=<?php echo $rs_sub['id'];?>" onClick="return confirm('Deseja realmente apagar o campo!')" ><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <input type="hidden" name="tipo_validacao[]" value="<?php echo $rs_sub['tipo'];?>" />
            <tr style="font:12px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000;">
            	<td align="center">Valor</td>
                <td colspan="7" style="padding:10px;">
                	<?php if($rs_sub['tipo'] == 'text') { echo '<input type="text" value="'.$rs_sub['value'].'" name="'.sem_especiais($rs_sub['nome']).'" class="form-control"  />'; ?>
                    	
                    <?php } elseif($rs_sub['tipo'] == 'campo') { echo '<input type="text" value="" disabled="disabled" name="'.sem_especiais($rs_sub['nome']).'"  />'; ?>
                    	
                    <?php } elseif($rs_sub['tipo'] == 'textarea') {  
						echo '<textarea rows="4" class="form-control" name="'.sem_especiais($rs_sub['nome']).'">'.$rs_sub['value'].'</textarea>';  
					} elseif($rs_sub['tipo'] == 'select'){ 
						$sql_subcampo = "SELECT * FROM tbprod_subcampo WHERE campo_id = ".$rs_sub['id'];
						$resultado_subcampo = $conecta->selecionar($conecta->conn,$sql_subcampo);
						
					?>
                    <table width="60%" cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                        	<td width="55%"><span class="tamanho_titulo">Nome (Opção)</span></td>
                            <td width="45%"><span class="tamanho_titulo">Chave (Value)</span></td>  
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                 		<div class="dados">
                         <p class="campoDados" style="margin-bottom:5px;">  
                        	<input class="campoSub" style="width:200px;" type="text" name="nome_opcao[]" value="" />&nbsp;&nbsp;&nbsp;
                        	<input class="campoSub" style="width:150px;" type="text" name="valor_opcao[]" value="" />
							<a href="#" class="removerCampos" style="text-decoration:none;"><span class="linkCampos">Remover opção</span></a>
                        </p>
                    	<?php while($rs_subcampo = mysqli_fetch_array($resultado_subcampo)){?>
                   		<p class="campoDados" style="margin-bottom:5px;">  
                        	<input class="campoSub" style="width:200px;" type="text" name="nome_opcao[]" value="<?php echo @$rs_subcampo['item']; ?>" />&nbsp;&nbsp;&nbsp;
                        	<input class="campoSub" style="width:150px;" type="text" name="valor_opcao[]" value="<?php echo @$rs_subcampo['value']; ?>" />
                        	<?php  if(!isset($_GET['alterar'])){ ?>
								<a href="#" class="removerCampos" style="text-decoration:none;"><span class="linkCampos">Remover opção</span></a>
						   	<?php } ?>
                        </p>
                        <?php } ?>
                		</div>
                        
                	<p>
                		<?php if(!isset($_GET['alterar'])){ ?>
                    		<span class="linkCampos"><a href="#" class="adicionarCampos">Adicionar opção</a></span>
                    	<?php } ?>
                	</p>
         		
                    <?php } ?>
                </td>
            </tr>
            <tr>
            	<td colspan="8" bgcolor="#CCCCCC" style="height:10px;"><img src="../images/pixel.gif" border="0" /></td>
            </tr>
            <?php $i++; } ?>
         </table>
         </div>
         
         <?php } ?>
         <div class="form-group">
         <input class="btn btn-default btn_direita" type="submit" name="alterar_campos" id="alterar_campos" value="salvar"  />
        <input class="btn btn-default btn_direita" style="width:210px;" type="submit" name="alterar_campos_continuar" id="alterar_campos_continuar" value="salvar e continuar no produto"  /> 
        </div>
        </form>
     </div>
     </div>
     
     <div id="formularioImagem"  class="abas">
        <form action="" method="post" enctype="multipart/form-data" name="formFoto" >
            <input type="hidden" name="galeria_id" value="<?php echo $id; ?>" />
            
            <div class="alert alert-info">Selecione até <?php echo @$qtde_imagem;?> imagens para o produto. Já foram selecionadas <?php echo @$qtde_fotos['qtde'];?> imagens.</div>
            <?php if(@$qtde_fotos['qtde'] < $qtde_imagem){ ?>
            <div class="form-group">
            <div class="col-sm-12">
            	
                <input id="file_upload" name="file_upload" type="file" multiple="true">
                
            </div>
            </div>
            
            <?php } ?>
            <div class="form-group">
        	<div class="col-sm-12">&nbsp;
            </div>
        	</div>
        </form>
        
     <form action="" method="post" enctype="multipart/form-data" name="formcomplemento">
     <div class="table-responsive">
        <table class="table table-hover" border="1" bordercolor="#CCCCCC">
    	<tr bgcolor="#eaeaea" style="font:12px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000; font-weight:bold;">
        	<td width="5%" align="center">&nbsp;</td>
            <td width="20%" align="center">Foto</td>
            <td width="35%" align="center">Legenda</td>
            <td width="10%" align="center">Ordem</td>
            <td width="10%" align="center">Destaque</td>
            <td width="10%" align="center">Banner</td>
            <td width="10%" align="center">Excluir</td>
        </tr>
        <tr>
        <?php
        //$loopH = 5;
    	$resultadoFoto = $conecta->selecionar($conecta->conn,"SELECT * FROM tbprod_foto WHERE produto_id = $id ORDER BY id ASC");
		$i = 1;
		while($rsFoto = mysqli_fetch_array($resultadoFoto)){
			$legenda = $rsFoto['legenda'];
			$ordem = $rsFoto['ordem'];
			
			if($ordem == '' || $ordem == 0 || $ordem == 9){
				$ordem = '';
			}
			$destaque = $rsFoto['destaque'];
			$banner = $rsFoto['banner'];
		?>
        <tr>
        	<td align="center" valign="middle" style="font:10px 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold;"><input type="hidden" name="foto[]" value="<?php echo $rsFoto['id'];?>"><?php echo $i; ?></td>
        	<td align="center" valign="middle" height="130"><img src="../source/Produtos/<?php echo $rsFoto['foto'];?>" width="120" height="100"/></td>
            <td align="center" valign="middle"><input type="text" name="legenda[]" value="<?php echo @$legenda;?>" class="form-control" maxlength="125" style="width:280px; float:none;" /></td>
            <td align="center" valign="middle"><input type="text" name="ordem[]" value="<?php echo @$ordem;?>" class="form-control" maxlength="3" style="width:50px; float:none;" /></td>
            <td align="center" valign="middle"><input type="radio" <?php if($destaque == 1) { echo "checked"; }?> value="<?php echo $rsFoto['id'];?>" name="destaque[]" /></td>
            <td align="center" valign="middle"><input type="radio" <?php if(@$banner == 1) { echo "checked"; }?> value="<?php echo $rsFoto['id'];?>" name="banner[]" /></td>
            <td align="center" valign="middle"><a href="<?php echo $_SERVER ['REQUEST_URI'];?>&amp;f=<?php echo $rsFoto['id'];?>#formularioImagem" onClick="return confirm('Deseja realmente apagar a imagem!')" ><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php
			$i++;
		}
		?>      
        </tr>
    </table>
    </div>
    
    <input class="btn btn-default btn_direita" type="submit" name="alterar_imagem" id="alterar_imagem" value="salvar"  />
    <input class="btn btn-default btn_direita" style="width:210px;" type="submit" name="alterar_imagem_continuar" id="alterar_imagem_continuar" value="salvar e continuar no produto"  />  
        
        </form>
	</div>
    
    <div id="formularioTamanho"  class="abas">
    <form action="" method="post" enctype="multipart/form-data" name="formtamanhos">
    	<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="220"><span class="tamanho_titulo">Tamanho</span></td>
                <td width="215"><span class="tamanho_titulo">Cor</span></td> 
                <td width="100"><span class="tamanho_titulo">Quantidade</span></td>  
                <td>&nbsp;</td>
            </tr>
        </table>
            <div class="dados2">
             
            <?php 
				$sql_tamanhocor= "SELECT * FROM tbprod_tamanhocor WHERE produto_id = ".$_GET['id'];
				$resultado_tamanhocor = $conecta->selecionar($conecta->conn,$sql_tamanhocor);
				$qtde_tamanhocor = mysqli_num_rows($resultado_tamanhocor);
				if(@$qtde_tamanhocor > 0){
                } else { ?>
                <p class="campoDados2" style="margin-bottom:5px;">  
                    <input class="campoSub" style="width:200px;" type="text" name="tamanho_opcao[]" value="" />&nbsp;&nbsp;&nbsp;
                    <input class="campoSub" style="width:200px;" type="text" name="cor_opcao[]" value="" />&nbsp;&nbsp;&nbsp;
                    <input class="campoSub" style="width:100px;" type="text" name="qtde_opcao[]" value="" />
                    <a href="#" class="removerCampos2" style="text-decoration:none;"><span class="linkCampos">Remover opção</span></a>
                </p>
                <?php }
			while($rs_tamanhocor = mysqli_fetch_array($resultado_tamanhocor)){?>
            <p class="campoDados2" style="margin-bottom:5px;">  
                <input class="campoSub" style="width:200px;" type="text" name="tamanho_opcao[]" value="<?php echo @$rs_tamanhocor['tamanho']; ?>" />&nbsp;&nbsp;&nbsp;
                <input class="campoSub" style="width:200px;" type="text" name="cor_opcao[]" value="<?php echo @$rs_tamanhocor['cor']; ?>" />&nbsp;&nbsp;&nbsp;
                <input class="campoSub" style="width:100px;" type="text" name="qtde_opcao[]" value="<?php echo @$rs_tamanhocor['quantidade']; ?>" />
                <?php  if(!isset($_GET['alterar'])){ ?>
                    <a href="#" class="removerCampos2" style="text-decoration:none;"><span class="linkCampos">Remover opção</span></a>
                <?php } ?>
            </p>
            <?php } ?>
            </div>
            
        <p>
            <?php if(!isset($_GET['alterar'])){ ?>
                <span class="linkCampos"><a href="#" class="adicionarCampos2">Adicionar opção</a></span>
            <?php } ?>
        </p>
        <div class="form-group" style="margin-bottom:30px;">
        <input class="btn btn-default btn_direita" type="submit" name="alterar_tamanhos" id="alterar_tamanhos" value="salvar"  />
    <input class="btn btn-default btn_direita" style="width:210px;" type="submit" name="alterar_tamanhos_continuar" id="alterar_tamanhos_continuar" value="salvar e continuar no produto"  />  
        </div>
        </form>
    </div>
    
    <div id="formularioRelacionado"  class="abas">
    	<form action="" method="post" enctype="multipart/form-data" name="formrelacionados">
        	<input type="hidden" name="produto_id" id="produto_id" value="<?php echo $id;?>" />
            <span class="favorito"><strong>Produtos Relacionados</strong></span>
            <span class="titulo_form" style="font-weight:100; width:100%; display:block;">Selecione abaixo o produto relacionado a ser retirado:</span>
            <span class="titulo_form" style="font-weight:100; width:100%; display:block;"><?php $sql_relacionados = "SELECT p.nome, pr.id FROM tbproduto p INNER JOIN tbprod_relacionado pr ON pr.relacionado_id = p.id WHERE pr.produto_id = ".$id; $resultado_relacionados = $conecta->selecionar($conecta->conn,$sql_relacionados); while($rs_relacionados = mysqli_fetch_array($resultado_relacionados)){  echo "<input type='checkbox' name='rela_exclui[]' value='".$rs_relacionados['id']."'/> ".$rs_relacionados['nome']."<br/>"; }?></span>
            <span id="prdrelacionado" style="width:100%; height:auto; background:#FFF; color:#000; margin-bottom:20px; float:left;"></span>
            <script type="text/javascript" src="../js/ajax.js"></script>
            <div id="Container">
                <br/><span class="favorito">Para fazer a busca de produtos você deve clicar em PESQUISAR e não teclar enter:</span>
                <div id="Pesquisar">
                    <span class="favorito" style="width:80px; display:inline;"><strong>Infome o nome do produto:</strong></span>
                    <input type="text" name="txtnome" id="txtnome" style="width:140px;"/>
                    <input type="button" name="btnPesquisar" value="Pesquisar" onclick="getDados();"/>
                </div>
                <div class="form-group" style="margin-bottom:30px;">
                <input class="btn btn-default btn_direita" type="submit" name="alterar_relacionados" id="alterar_relacionados" value="salvar"  />
            	<input class="btn btn-default btn_direita" style="width:210px;" type="submit" name="alterar_relacionados_continuar" id="alterar_relacionados_continuar" value="salvar e continuar no produto"  />  
            </div>
                <span class="favorito">Selecione os produtos relacionados:</span>
                <div id="Resultado" style="height:auto;"></div>
            </div>
            
            
            
        </form>
    	
    </div>
<?php } else {
?>		
	<?php
		$_SESSION['aba_marcada'] = "aba_campos";
        
		$sql = "
			SELECT c.titulo as categoria, sc.titulo as subcategoria, p.nome as produto, m.titulo as marca, p.modelo, p.preco, p.estoque, p.id, p.status
			FROM tbproduto p LEFT JOIN tbprod_subcategoria sc on subcategoria_id = sc.id
			LEFT JOIN tbprod_categoria c on c.id = sc.categoria_id
			 LEFT JOIN tbprod_marca m ON m.id = p.marca
			ORDER BY categoria, subcategoria, produto ASC LIMIT $inicio, $maximo
		";
		$sql_paginacao = "SELECT c.titulo as categoria, sc.titulo as subcategoria, p.nome as produto, m.titulo as marca, p.modelo, p.preco, p.estoque, p.id, p.status
			FROM tbproduto p LEFT JOIN tbprod_subcategoria sc on subcategoria_id = sc.id
			LEFT JOIN tbprod_categoria c on c.id = sc.categoria_id
			 LEFT JOIN tbprod_marca m ON m.id = p.marca
			ORDER BY categoria, subcategoria, produto ASC";
			
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		$qtde_atual = mysqli_num_rows($resultado);
		?>
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
                <th>Categoria<br>
				SubCategoria</th>
                <th>Produto</th>
                <th>Marca<br>
				Modelo</th>
                <th class="central">Status</th>
                <th class="central">Estoque</th>
                <th class="central">Alterar</th>
                <th class="central">Excluir</th>
            </thead>
          	<tbody>
            <?php while($rs = mysqli_fetch_array($resultado)){ ?>
            <tr>
                <td><?php echo $rs['categoria']; ?><br>
				<?php echo $rs['subcategoria']; ?></td>
                <td><?php echo $rs['produto']; ?></td>
                <td><?php echo $rs['marca']; ?><br>
				<?php echo $rs['modelo']; ?></td>
                <form action="" method="post" enctype="multipart/form-data" name="form_ativa">
                <input type="hidden" value="<?php echo $rs['id'];?>" id="banner_id" name="banner_id" />
                <td align="center"><input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" /></td>
                </form>
                <td align="center"><?php echo $rs['estoque']; ?></td>
                <td align="center"><a href="home.php?pagina=produto&amp;tela=<?php echo $_GET['tela']?>&amp;vw=1&amp;id=<?php echo $rs['id'] ?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td align="center"><a href="home.php?pagina=produto&amp;tela=<?php echo $_GET['tela']?>&amp;apagar=<?php echo $rs['id']?>" onClick="return confirm('Deseja realmente apagar o produto <?php echo $rs['produto'];?>!')"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
        <div class="centro">
      	<?php
        	$resultado_total = $conecta->selecionar($conecta->conn,$sql_paginacao);
            include "paginacao.php";
		?>
      </div>
    <?php	
	}
	?>
   
    	
