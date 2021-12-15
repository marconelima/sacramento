<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(@$_GET["apagaanexo"] == 1) {
	$id = $_GET['alterar'];
	$sql_apaga_anexo = "UPDATE $tabela SET documento = '' WHERE id = ".$id;
	$resultado_apaga_anexo = $conecta->selecionar($conecta->conn,$sql_apaga_anexo);
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php?pagina=$paginatela&amp;tela=$idtela&amp;vw=1&amp;alterar=$id\">\n";
	
}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$tag =    	strip_tags(trim($dados[$tabela]['tag']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$documento = 		strip_tags(trim($dados[$tabela]['documento']));
				
	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}elseif (empty($conteudo)) {
		$retorno = '<div class="alert alert-danger">Digite o Conteúdo!</div>';
	}
	
	if (empty($retorno)) {
				
		
			$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
		
			$resultado = $conecta->inserir($dados);
		
		echo $resultado;	
	} else {
		echo $retorno;
	}		
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$tag =    	strip_tags(trim($dados[$tabela]['tag']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$documento = 		strip_tags(trim($dados[$tabela]['documento']));
	
	$string = " id = $id";
	
	$resultado = $conecta->selecionar($conecta->conn,"SELECT documento FROM $tabela WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$nomDoc = $rs['documento'];
	$documento = $nomDoc;
		
	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}elseif (empty($conteudo)) {
		$retorno = '<div class="alert alert-danger">Digite o Conteúdo!</div>';
	}
	if (empty($retorno)) {
		
		
		$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
		$resultado = $conecta->alterar($dados, $string);
		
		$_GET['vw'] = 0;
	} else {
		echo $retorno;
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	
	$id = $_GET['apagar'];
	$sql_busca = "SELECT documento FROM $tabela WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn,$sql_busca);
	$rs = mysqli_fetch_array($resultado);
	
	$nomDoc = $rs['documento'];
	if($nomDoc != '') {
		unlink($nomDoc);
	}
	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM $tabela WHERE id = $id");
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';	
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
} else {

	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM $tabela WHERE tela_id = $idtela");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
	$tag = $rs['tag'];
	$conteudo = $rs['conteudo'];
	$documento = $rs['documento'];
	
}  
?>
	<a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir <?php echo $nometela;?></button></a>
        
    <div class="separa"></div>
    
    
	<form class="form-horizontal" role="form" name="formNoticia" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[<?php echo $tabela; ?>][id]" value="<?php echo @$id; ?>" />     
        <input type="hidden" name="dados[<?php echo $tabela; ?>][data]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][tela_id]" value="<?php echo @$idtela; ?>" />
        
    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][titulo]" value="<?php echo @$titulo; ?>" class="form-control" id="titulo" placeholder="Título">
            </div>
        </div>
        
        <div class="form-group">
            <label for="tag" class="col-sm-2 control-label">Digite o Endereço</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][tag]" value="<?php echo @$tag; ?>" class="form-control" id="tag" placeholder="Ex.: Rua Afonso Pena, 100, Centro, Belo Horizonte, Minas Gerais">
            </div>
        </div>
                
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="dados[<?php echo $tabela;?>][documento]" id="documento" value="<?php echo @$documento;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=0&field_id=documento" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
            </div>
                        
        </div>
                
        <?php if(@$documento != '') {?>
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
            	<a href="home.php?pagina=grupo_noticia&amp;tela=<?php echo $idtela; ?>&amp;vw=1&amp;alterar=<?php $id?>&amp;apagaanexo=1"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Apagar Anexo</button></a>
            	<?php
                	$file = pathinfo($documento);
					$extensao = $file['extension'];
					$extensoes = array('jpg', 'jpeg', 'gif', 'png');
					
					$posicao = substr($file['dirname'],strlen($dados['linkloja'])+1);
					
					if(array_search($extensao, $extensoes) === false){?>
						<a href="<?php echo $documento; ?>" target="_blank" ><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;<?php echo $documento; ?></button></a>
					<?php } else { ?>
						<a href="../download_imagem.php?arquivo=<?php echo $posicao."/".$file['filename'].".".$file['extension']; ?>" target="_blank" ><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;<?php echo $documento; ?></button></a>
					<?php } ?>
                
            </div>
        </div>    
        <?php } ?>
        
        <div class="form-group">
            <label for="conteudo" class="col-sm-2 control-label">Conteúdo</label>
            <div class="col-sm-10">
              <textarea name="dados[<?php echo $tabela;?>][conteudo]" class="form-control" id="conteudo" placeholder="Conteúdo"><?php echo @$conteudo; ?></textarea>
            </div>
        </div>
        
        
        
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(@$id > 0){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>

	</form>
   