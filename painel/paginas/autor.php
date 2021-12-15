<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE tbautor SET status = 0 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE tbautor SET status = 1 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbautor']['id']));
	$titulo =    	strip_tags(trim($dados['tbautor']['titulo']));
	$conteudo =  	$dados['tbautor']['conteudo'];
	$arquivo = 		strip_tags(trim($dados['tbautor']['arquivo']));
			
	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}
	
	if (empty($retorno)) {
		$resultado = $conecta->inserir($dados);
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.'</span>';	
	} else {
		echo $retorno;
	}		
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbautor']['id']));
	$titulo =    	strip_tags(trim($dados['tbautor']['titulo']));
	$conteudo =  	$dados['tbautor']['conteudo'];
	$arquivo = 		strip_tags(trim($dados['tbautor']['arquivo']));
	$string = " id = $id";
		
	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}
	if (empty($retorno)) {
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo $resultado;
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];
	$sql_filhocategoria = "SELECT id FROM $tabela WHERE autor_id = $id";
	$resultado_filhocategoria  = $conecta->selecionar($conecta->conn,$sql_filhocategoria);
	
	if(!$rs_paicategoria = mysqli_fetch_array($resultado_filhocategoria)){
		$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbautor WHERE id = $id");
	} else {
		$resultado = 0;
	}
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';	
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
	echo $resultado;
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM tbautor WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
	$conteudo = $rs['conteudo'];
	$arquivo = $rs['arquivo'];
	$status = $rs['status'];
	
}   
?>
	
    <a href="home.php?pagina=autor&amp;tela=<?php echo $idtela; ?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Autor para <?php echo $nometela;?></button></a>
    <a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela; ?>"><button type="button" class="btn btn-warning btn_direita"><span class="glyphicon glyphicon-repeat"></span> Voltar a <?php echo $nometela;?></button></a>
    
    <div class="separa"></div>
    
	<?php if(@$_GET['vw'] == 1) {?>
    
	<form class="form-horizontal" role="form" name="formNoticia" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[tbautor][id]" value="<?php echo @$id; ?>" />     
        <input type="hidden" name="dados[tbautor][tela_id]" value="<?php echo @$idtela; ?>" />
        
    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" name="dados[tbautor][titulo]" value="<?php echo @$titulo; ?>" class="form-control" id="titulo" placeholder="Autor">
            </div>
        </div>
        
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="dados[tbautor][arquivo]" id="arquivo" value="<?php echo @$arquivo;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=arquivo" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
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
        	<label for="radio" class="col-sm-2 control-label">Ativo</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[tbautor][status]" <?php if(@$status == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[tbautor][status]" <?php if(@$status == 2 ) { echo "checked"; } ?> value="2"> Não
               </div>
              
            </div>
        </div>
        
        <div class="form-group">
            <label for="conteudo" class="col-sm-2 control-label">Conteúdo</label>
            <div class="col-sm-10">
              <textarea name="dados[tbautor][conteudo]" class="form-control" id="conteudo" placeholder="Conteúdo"><?php echo @$conteudo; ?></textarea>
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
              <th class="central">Alterar</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
    	<?php
		$sql = "SELECT * FROM tbautor WHERE tela_id = $idtela";
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		while($rs = mysqli_fetch_array($resultado)){ 
	  ?>
		<tr>
		  <td><?php echo $rs['titulo'];?></td>
		  <td align="center">
		  <form action="home.php?pagina=autor&amp;tela=<?php echo $tela_id;?>" method="post" enctype="multipart/form-data" name="form_ativa">
				<input type="hidden" value="<?php echo $rs['id'];?>" id="item_id" name="item_id" />
				<input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" />
				</form>
		  </td>
		  <td align="center"><a href="home.php?pagina=autor&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>&amp;p=<?php echo $p;?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
		  <td align="center"><a href="home.php?pagina=autor&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>&amp;p=<?php echo $p;?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
		<?php } ?>
	  </tbody>
      </table>
      </div>
    <?php } ?>
    	