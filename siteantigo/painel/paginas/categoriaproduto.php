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

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$titulo =    	strip_tags(trim($dados['tbcategoriaproduto']['titulo']));
			
	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título!</span>';
	}
	
	if (empty($retorno)) {
		$resultado = $conecta->inserir($dados);
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.' - '.$resultadoUpload.'</span>';	
	} else {
		echo $retorno;
	}		
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($_POST['id']));
	$titulo =    	strip_tags(trim($dados['tbcategoriaproduto']['titulo']));
	$string = " id = $id";
		
	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título!</span>';
	}
	if (empty($retorno)) {
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo '<span id="retorno">'.$resultado.'</span>';
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];
	$resultado = $conecta->selecionar("DELETE FROM tbcategoriaproduto WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar("SELECT * FROM tbcategoriaproduto WHERE id = $id");
	$rs = mysql_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
}  

?>
<div id="conteudodireita">
	<?php if($_GET[vw] == 1) {?>
    <div id="formulario">
	<form name="formcategoriaproduto" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
    	<fieldset>
        	<legend>Cadastro de categoriaprodutos </legend>
            <label>
            <span class="titulo_form">Título:</span>
            <input class="input_painel" type="text" name="dados[tbcategoriaproduto][titulo]" value="<?php echo $titulo; ?>" />
            </label>
            <br/>
            <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </fieldset>
	</form>
    </div>
    <?php } else {?>
    	<?php
		$sql = "SELECT * FROM tbcategoriaproduto";
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" cellspacing="3" width="100%">
        	<span class="legend">categoriaprodutos</span>
            <tr>
                <td colspan="5" align="right"><span class="link_interno"><a href="home.php?pagina=categoriaproduto&amp;vw=1&amp;tela=<?php echo $tela_id;?>" ><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Categoria de Produtos</a></span></td>
            </tr>
            <tr>
                <td width="35%" class="titulo_grid">Titulo</td>
                <td width="15%" class="titulo_grid">Alterar</td>
                <td width="15%" class="titulo_grid">Excluir</td>
            </tr>
            <?php 
			$cor = '#EFEFEF';
			while($rs = mysql_fetch_array($resultado)){ 
			if($cor == '#EFEFEF'){
				$cor = '#DEDEDE';
			}else{
				$cor = '#EFEFEF';
			}
			?>
            <tr bgcolor="<?php echo $cor;?>">
                <td class="dados_grid"><?php echo $rs['titulo']; ?></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=categoriaproduto&amp;vw=1&amp;tela=<?php echo $tela_id;?>&amp;alterar=<?php echo$rs['id']?>" ><img src="../images/editar.png" width="16" height="16" border="0" /></a></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=categoriaproduto&amp;tela=<?php echo $tela_id;?>&amp;apagar=<?php echo$rs['id']?>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php } ?>
    	
</div><!--conteudodireita-->