<?php

$conecta = new Recordset;
$conecta->conexao();

$tela_id = $_GET['tela'];

$sql_tela = 'SELECT * FROM tbtela WHERE id = '.$tela_id;
$resultado_tela = $conecta->selecionar($sql_tela);
$rs_tela = mysql_fetch_array($resultado_tela);

$tabela = $rs_tela['tabela'];
$idtela = $rs_tela['id'];
$nometela = $rs_tela['nome'];


if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	$dados = $_POST["dados"];
	
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	
	$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
	
	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título da página!</span>';
	}elseif (empty($conteudo)) {
		$retorno = '<span class="retorno">Digite o Conteúdo da página!</span>';
	}
		
	if (empty($retorno)) {
		
		$resultado = $conecta->inserir($dados);
		echo '<span class="retorno">'.$resultado.'</span>';
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	
	$dados = $_POST["dados"];
	
	$id = 			strip_tags(trim($_POST['id']));
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	
	$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
	
	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título da página!</span>';
	}elseif (empty($conteudo)) {
		$retorno = '<span class="retorno">Digite o Conteúdo da página!</span>';
	}
		
	if (empty($retorno)) {
		$string = "id = ".$id;
		$resultado = $conecta->alterar($dados, $string);
		echo '<span class="retorno">'.$resultado.'</span>';
	} else {
		echo $retorno;
	}
		
} else {
	$resultado = $conecta->selecionar("SELECT * FROM $tabela where tela_id = $idtela");
	$dados[$tabela] = mysql_fetch_assoc($resultado);
	
	$id = strip_tags(trim($dados[$tabela]['id']));
	$titulo =    strip_tags(trim($dados[$tabela]['titulo']));
	$conteudo =  $dados[$tabela]['conteudo'];
}

?>
<div id="conteudodireita">
	<div id="formulario">
	<form name="formcontribuicao" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][data]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][tela_id]" value="<?php echo $idtela; ?>" />
    	<fieldset>
        	<legend>Cadastro de <?php echo $nometela; ?></legend>
            <label>
            <span class="titulo_form">Título:</span>
            <input class="input_painel" type="text" name="dados[<?php echo $tabela; ?>][titulo]"  value="<?php echo $titulo; ?>" />
            </label>
            <label>
            <span class="titulo_form">Conteúdo:</span>
            
            <textarea class="input_painel" rows="20" name="dados[<?php echo $tabela; ?>][conteudo]" ><?php echo $conteudo; ?></textarea>
            
            </label>
            <br/>
            <input class="botao_form" type="submit" <?php if($id > 0){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"/>
        </fieldset>
	</form>
    </div>
</div><!--conteudodireita-->