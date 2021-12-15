<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE $tabela SET status = 0 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE $tabela SET status = 1 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}

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
	$link =    	strip_tags(trim($dados[$tabela]['link']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$destaque = 	strip_tags(trim(@$dados[$tabela]['destaque']));
	$arquivo = 		strip_tags(trim($dados[$tabela]['arquivo']));
	$documento = 		strip_tags(trim(@$dados[$tabela]['documento']));

	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}elseif (empty($link)) {
		$retorno = '<div class="alert alert-danger">Digite o link!</div>';
	}

	if (empty($retorno)) {

			$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];

			$resultado = $conecta->inserir($dados);

		$_GET['vw'] = 0;
		echo $resultado;
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$link =    	strip_tags(trim($dados[$tabela]['link']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$destaque = 	strip_tags(trim(@$dados[$tabela]['destaque']));
	$arquivo = 		strip_tags(trim($dados[$tabela]['arquivo']));
	$documento = 		strip_tags(trim($dados[$tabela]['documento']));

	$string = " id = $id";

	$resultado = $conecta->selecionar($conecta->conn,"SELECT documento FROM $tabela WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$nomDoc = $rs['documento'];

	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}elseif (empty($link)) {
		$retorno = '<div class="alert alert-danger">Digite o link!</div>';
	}
	if (empty($retorno)) {

		$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
		$resultado = $conecta->alterar($dados, $string);

		$_GET['vw'] = 0;
		echo $resultado;
	} else {
		echo $retorno;
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];
	$sql_busca = "SELECT arquivo, documento FROM $tabela WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn,$sql_busca);
	$rs = mysqli_fetch_array($resultado);
	$nome = $rs['arquivo'];
	$nomDoc = $rs['documento'];
	if($nome != '') {
		unlink($nome);
	}
	if($nomDoc != '') {
		unlink($nomDoc);
	}
	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM $tabela WHERE id = $id");
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM $tabela WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
	$link = $rs['link'];
	$conteudo = $rs['conteudo'];
	$arquivo = $rs['arquivo'];
	$documento = $rs['documento'];
	$categoria = $rs['categoria_id'];
	$status = $rs['status'];
	$destaque = $rs['destaque'];
}
?>
	<a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir <?php echo $nometela;?></button></a>
        <a href="home.php?pagina=categoria&amp;tela=<?php echo $idtela; ?>"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Nova Categoria</button></a>

    <div class="separa"></div>

	<?php if(@$_GET['vw'] == 1) {?>

	<form class="form-horizontal" role="form" name="formNoticia" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[<?php echo $tabela; ?>][id]" value="<?php echo @$id; ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][arquivo]" value="<?php echo @$arquivo; ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][data]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][tela_id]" value="<?php echo @$idtela; ?>" />

    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][titulo]" value="<?php echo @$titulo; ?>" class="form-control" id="titulo" placeholder="Título">
            </div>
        </div>

        <div class="form-group">
            <label for="link" class="col-sm-2 control-label">Link do Vídeo</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][link]" value="<?php echo @$link; ?>" class="form-control" id="link" placeholder="Link do Vídeo (Copiar link da barra de endereço do youtube)">
            </div>
        </div>

        <div class="form-group">
            <label for="categoria" class="col-sm-2 control-label">Categoria</label>
            <div class="col-sm-10">
            	<select class="form-control" name="dados[<?php echo $tabela; ?>][categoria_id]" id="categoria" >
            		<option value="">Selecione...</option>
					<?php
                    $sql_categoria = "SELECT * FROM tbcategoria WHERE tela_id = $idtela order by titulo asc";
                    $resultado_categoria = $conecta->selecionar($conecta->conn,$sql_categoria);
                    while($rs_categoria = mysqli_fetch_array($resultado_categoria)){
                    ?>
            		<option value="<?php echo $rs_categoria['id']; ?>" <?php if($rs_categoria['id'] == @$categoria) { echo "selected";} ?> ><?php echo $rs_categoria['titulo']; ?></option>
                	<?php } ?>
            </select>
            </div>
        </div>
        <!--
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="dados[<?php echo $tabela;?>][arquivo]" id="arquivo" value="<?php echo @$arquivo;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=arquivo" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
            	<div class="alert alert-warning">A imagem do banner deve ter 900px de largura por 200px de altura.</div>
            </div>

        </div>
        <?php if(@$arquivo != '') {?>
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <img src="<?php echo $arquivo; ?>" class="img-responsive" alt="Responsive image" width="50%"  />
            </div>
        </div>
        <?php } ?>

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
        	<label for="destaque" class="col-sm-2 control-label">Destaque Home</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="destaque" name="dados[<?php echo $tabela;?>][destaque]" <?php if(@$destaque == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="destaque" name="dados[<?php echo $tabela;?>][destaque]" <?php if(@$destaque == 2 ) { echo "checked"; } ?> value="2"> Não
               </div>

            </div>
        </div>
	-->
        <div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Ativo</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][status]" <?php if(@$status == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][status]" <?php if(@$status == 2 ) { echo "checked"; } ?> value="2"> Não
               </div>

            </div>
        </div>

        <div class="form-group">
            <label for="conteudo" class="col-sm-2 control-label">Conteúdo</label>
            <div class="col-sm-10">
              <textarea name="dados[<?php echo $tabela;?>][conteudo]" class="form-control" id="conteudo" placeholder="Conteúdo"><?php echo @$conteudo; ?></textarea>
            </div>
        </div>



        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>

	</form>
    <?php } else {?>

        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Título</th>
              <th class="central">Situacao</th>
              <th class="central">Visualizar</th>
              <th class="central">Alterar</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
    	<?php
		if($_SESSION['perfil'] == 1){
			$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela LIMIT $inicio, $maximo";
			$sql_paginacao = "SELECT * FROM $tabela WHERE tela_id = $idtela";
		} else {
			$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela  LIMIT $inicio, $maximo";
			$sql_paginacao = "SELECT * FROM $tabela WHERE tela_id = $idtela";
		}
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		while($rs = mysqli_fetch_array($resultado)){
	  ?>
		<tr>
		  <td><?php echo $rs['titulo'];?></td>
		  <td align="center">
		  <form action="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>" method="post" enctype="multipart/form-data" name="form_ativa">
				<input type="hidden" value="<?php echo $rs['id'];?>" id="item_id" name="item_id" />
				<input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" />
				</form>
		  </td>
          <td align="center"><a href="<?php echo $rs['link'];?>" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a></td>
		  <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
		  <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
		<?php } ?>
	  </tbody>
      </table>
      </div>
      <div class="centro">
      	<?php
        	$resultado_total = $conecta->selecionar($conecta->conn,$sql_paginacao);
            include "paginacao.php";
		?>
      </div>
   <?php } ?>
