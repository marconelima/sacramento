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

if($_GET["apagaanexo"] == 1) {
	$id = $_GET['alterar'];
	$sql_apaga_anexo = "UPDATE $tabela SET documento = '' WHERE id = ".$id;
	$resultado_apaga_anexo = $conecta->selecionar($sql_apaga_anexo);
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php?pagina=catalogo&amp;tela=$idtela&amp;vw=1&amp;alterar=$id\">\n";
	
}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$titulo =    	strip_tags(trim($dados['tbcatalogo']['titulo']));
			
	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o Nome!</span>';
	}
	
	if (empty($retorno)) {
		//CONFIGURAÇÃO UPLOAD
		$pasta = "../imagens";
		$permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');
		
		$name = $_FILES['arquivo']['name'];
		$tmp = $_FILES['arquivo']['tmp_name'];
		$type = $_FILES['arquivo']['type'];
				
		if($_FILES['arquivo']['name'] != ''){
			$extensao = strtolower(end(explode('.',$name)));
			$nome = 'imagem-'.md5(uniqid(rand(), true)).'.'.$extensao;
			$uploadfile = $pasta."/".$nome;
			
			if(move_uploaded_file($tmp,$uploadfile)){
				$resultadoUpload = '<span class="retorno">Imagem Carregada com sucesso!</span>';
				$ok = 1;
			} else{
				$resultadoUpload = '<span class="retorno">Não foi possível enviar a Imagem!</span>';
			}
		}
		$dados[$tabela]['arquivo'] = $nome;
		
		//UPLOAD DO DOCUMENTO
		$pastaDocumento = "../documentos/";
		$permitidoDocumento = array('doc','docx','pdf','xls','xlsx', 'jpg', 'jpeg', 'gif');	
		
		$nameDocumento = $_FILES['documento']['name'];
		$tmpDocumento = $_FILES['documento']['tmp_name'];
		$typeDocumento = $_FILES['documento']['type'];
		$sizeDocumento = $_FILES['documento']['size'];
		
		$extensaoDocumento = strtolower(end(explode('.',$nameDocumento)));
		$maxSizeDocumento = 1024 * 1024 * 5;
		
		$nomeDocumento = date('dmy')."-".$_FILES['documento']['name'];
		
		$uploadDocumento = $pastaDocumento.basename($nomeDocumento);
			
			
			if(array_search($extensaoDocumento, $permitidoDocumento) === false){
				$retornoDocumento = '<span class="retorno">São permitidos documentos apenas com extensões DOCX, DOC, PDF, XLS, XLSX, JPG, GIF!</span>';	
			}elseif($sizeDocumento > $maxSizeDocumento) {
				$retornoDocumento = '<span class="retorno">Tamanho do arquivo maior que o permitido. O máximo é de $maxSizeDocumento MB!</span>';	
			} elseif(move_uploaded_file($tmpDocumento,$uploadDocumento)){
					$retornoDocumento = '<span class="retorno">Documento carregado com sucesso!</span>';	
			} else {
				$retornoDocumento = '<span class="retorno">Não foi possível carregar o Documento!</span>';	
			}
			if(strlen($nomeDocumento)>10){
				$dados[$tabela]['documento'] = $nomeDocumento;
			} else {
				$dados[$tabela]['documento'] = '';
			}
		
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
	$titulo =    	strip_tags(trim($dados['tbcatalogo']['titulo']));
	$string = " id = $id";
		
	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título!</span>';
	}
	if (empty($retorno)) {
		//CONFIGURAÇÃO UPLOAD
		$pasta = "../imagens";
		$permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');
		$name = $_FILES['arquivo']['name'];
		$tmp = $_FILES['arquivo']['tmp_name'];
		$type = $_FILES['arquivo']['type'];
								
		if(strip_tags(trim($_FILES['arquivo']['name'])) != ''){
			$extensao = strtolower(end(explode('.',$name)));
			$dados[$tabela]['arquivo'] = 'imagem-'.md5(uniqid(rand(), true)).'.'.$extensao;
		}
		
		if(!empty($name)){
			$nome = strip_tags(trim($dados[$tabela]['arquivo']));
			$uploadfile = $pasta."/".$nome;
			if(move_uploaded_file($tmp,$uploadfile)){
				$resultadoUpload = '<span class="retorno">Imagem Carregada com sucesso!</span>';
				$ok = 1;
			} else{
				$resultadoUpload = '<span class="retorno">Não foi possível enviar a Imagem!</span>';
			}
		}
		if($_FILES['documento']['name'] != ''){
		//UPLOAD DO DOCUMENTO
		
		$pastaDocumento = "../documentos/";
		$permitidoDocumento = array('doc','docx','pdf','xls','xlsx', 'jpg', 'jpeg', 'gif');	
		
		
		$nameDocumento = $_FILES['documento']['name'];
		$tmpDocumento = $_FILES['documento']['tmp_name'];
		$typeDocumento = $_FILES['documento']['type'];
		$sizeDocumento = $_FILES['documento']['size'];
		
		$extensaoDocumento = strtolower(end(explode('.',$nameDocumento)));
		$maxSizeDocumento = 1024 * 1024 * 5;
		
		
			$nomeDocumento = date('dmy')."-".$_FILES['documento']['name'];
		
		
		$uploadDocumento = $pastaDocumento.basename($nomeDocumento);
			
				
		if(array_search($extensaoDocumento, $permitidoDocumento) === false){
			$retornoDocumento = '<span class="retorno">São permitidos documentos apenas com extensões DOCX, DOC, PDF, XLS, XLSX, JPG, GIF!</span>';	
		}elseif($sizeDocumento > $maxSizeDocumento) {
			$retornoDocumento = '<span class="retorno">Tamanho do arquivo maior que o permitido. O máximo é de $maxSizeDocumento MB!</span>';	
		} elseif(move_uploaded_file($tmpDocumento,$uploadDocumento)){
				$retornoDocumento = '<span class="retorno">Documento carregado com sucesso!</span>';	
				if($nomDoc != '') {
					unlink($pastaDocumento.'/'.$nomDoc);
				}
		} else {
			$retornoDocumento = '<span class="retorno">Não foi possível carregar o Documento!</span>';	
		}
		$dados[$tabela]['documento'] = $nomeDocumento;
		}
		
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo '<span id="retorno">'.$resultado.'</span>';
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$pasta = "../imagens/";
	$pastaDoc = "../documentos";
	$id = $_GET['apagar'];
	$sql_busca = "SELECT arquivo, documento FROM $tabela WHERE id = $id";
	$resultado = $conecta->selecionar($sql_busca);
	$rs = mysql_fetch_array($resultado);
	$nome = $rs['arquivo'];
	$nomDoc = $rs['documento'];
	if($nome != '') {
		unlink($pasta.'/'.$nome);
	}
	if($nomDoc != '') {
		unlink($pastaDoc.'/'.$nomDoc);
	}
	
	$resultado = $conecta->selecionar("DELETE FROM tbcatalogo WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar("SELECT * FROM tbcatalogo WHERE id = $id");
	$rs = mysql_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
	$arquivo = $rs['arquivo'];
	$documento = $rs['documento'];
	
	$link = $rs['link'];
	$status = $rs['status'];
}  

?>
<div id="conteudodireita">
	<?php if($_GET[vw] == 1) {?>
    <div id="formulario">
	<form name="formcatalogo" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
    	<fieldset>
        	<legend>Cadastro de catálogos </legend>
            <label>
            <span class="titulo_form">Nome:</span>
            <input class="input_painel" type="text" name="dados[tbcatalogo][titulo]" value="<?php echo $titulo; ?>" />
            </label>
            <label>
            <span class="titulo_form">Imagem:</span>
            <input class="input_painel" type="file" name="arquivo" value="" />
            <?php if($arquivo != '') {?>
            <img src="../imagens/<?php echo $arquivo; ?>" width="400"  />
            <?php } ?>
            </label>
            <label>
            <span class="titulo_form">Documento:</span>
            <input class="input_painel" type="file" name="documento" value="" />
            <?php
            	$ext = $extensaoDocumento = strtolower(end(explode('.',$documento)));
			?>
            <?php if($documento != '') {?>
            <a href="home.php?pagina=catalogo&amp;tela=<?php echo $idtela; ?>&amp;vw=1&amp;alterar=<?php echo$id?>&amp;apagaanexo=1" style="font-family:Calibri, Verdana, Geneva, sans-serif; font-size:12pt; font-weight:bold; color:#C00;" >Apagar Anexo</a><br />
            <img src="../images/<?php echo $tipDoc[$ext]; ?>" width="32" height="32" border="0" />
            <a href="../documentos/<?php echo $documento; ?>" target="_blank"><?php echo $documento; ?></a>
            <?php } ?>
            
            </label>
            <label>
            <span class="titulo_form">Ativo</span>
            <input type="radio" name="dados[<?php echo $tabela; ?>][status]" <?php if($status == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($status == 0 ) { echo "checked"; } ?> name="dados[<?php echo $tabela; ?>][status]" value="0" /><span class="dados_grid">Não</span>
            </label>
            <br/>
            <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </fieldset>
	</form>
    </div>
    <?php } else {?>
    	<?php
		$sql = "SELECT * FROM tbcatalogo";
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" cellspacing="3" width="100%">
        	<span class="legend">Catálogos</span>
            <tr>
                <td colspan="5" align="right"><span class="link_interno"><a href="home.php?pagina=catalogo&amp;vw=1&amp;tela=<?php echo $tela_id;?>" ><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Catálogo</a></span></td>
            </tr>
            <tr>
                <td width="35%" class="titulo_grid">Nomee</td>
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
                <td class="dados_grid" align="center"><a href="home.php?pagina=catalogo&amp;vw=1&amp;tela=<?php echo $tela_id;?>&amp;alterar=<?php echo$rs['id']?>" ><img src="../images/editar.png" width="16" height="16" border="0" /></a></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=catalogo&amp;tela=<?php echo $tela_id;?>&amp;apagar=<?php echo$rs['id']?>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php } ?>
    	
</div><!--conteudodireita-->