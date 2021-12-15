<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE $tabela SET status = 0 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE $tabela SET status = 1 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	unset($dados[$tabela]['id']);
	$link =    	strip_tags(trim($dados[$tabela]['link']));
	$posicao =  	strip_tags(trim($dados[$tabela]['posicao']));
	$status = 	strip_tags(trim($dados[$tabela]['status']));
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	$arquivo = 		strip_tags(trim($dados[$tabela]['arquivo']));

	if($arquivo == "") {
		$retorno = '<div class="alert alert-danger">Selecione o arquivo!</div>';
	}

	if (empty($retorno)) {

		$resultado = $conecta->inserir($dados);

		$_GET['vw'] = 0;
		echo $resultado;
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){

	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$link =    	strip_tags(trim($dados[$tabela]['link']));
	$posicao =  	strip_tags(trim($dados[$tabela]['posicao']));
	@$status = 	strip_tags(trim($dados[$tabela]['status']));
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	$arquivo = 		strip_tags(trim($dados[$tabela]['arquivo']));

	$string = " id = $id";

	if (empty($retorno)) {

		$resultado = $conecta->alterar($dados, $string);

		$_GET['vw'] = 0;
		echo $resultado;
	}



} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];
	$sql = "SELECT arquivo FROM $tabela WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn, $sql);
	$rs = mysqli_fetch_array($resultado);
	$nome = $rs['arquivo'];
	if($nome != '') {
		unlink($nome);
	}
	$sql_deleta = "DELETE FROM $tabela WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn, $sql_deleta);
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
	echo $resultado;

}  else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$sql = "SELECT * FROM $tabela WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn, $sql);
	$rs = mysqli_fetch_array($resultado);

	$id = $rs['id'];
	$link = $rs['link'];
	$arquivo = $rs['arquivo'];
	$posicao = $rs['posicao'];
	$status = $rs['status'];
	$tipo = $rs['tipo'];

}


?>
<a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir <?php echo $nometela;?></button></a>


<?php if(@$_GET['vw'] == 1) { ?>
    <a href="home.php?pagina=<?php echo $_GET['pagina'];?>&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-warning btn_direita"><span class="glyphicon glyphicon-repeat"></span> Voltar</button></a>
    <div class="separa"></div>
	<form class="form-horizontal" role="form" name="formBanner" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[<?php echo $tabela;?>][id]" value="<?php echo @$id; ?>" />
        <input type="hidden" name="dados[<?php echo $tabela;?>][data]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[<?php echo $tabela;?>][tela_id]" value="<?php echo @$idtela; ?>" />

        <div class="form-group">
            <label for="link" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">

              <input class="form-control" type="text" name="dados[<?php echo $tabela;?>][arquivo]" id="arquivo" value="<?php echo @$arquivo;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=arquivo" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
              <div class="alert alert-warning">A Imagem Banner Home Superior deve ter 1900px de largura por 655px de altura.<br />
              A Imagem Banner Médio Grande  deve ter 1160px de largura por 200px de altura.<br />
			  A Imagem Banner Médio Direita  deve ter 545px de largura por 200 de altura.<br />
			  A Imagem Banner Médio Esquerda  deve ter 545px de largura por 200 de altura.<br />
			  A Imagem Banner Acima Rodapé  deve ter 200px de largura por 100 de altura.<br />
			  A Imagem Banner Rodpá Abaixo Logo deve ter 330px de largura por 120 de altura.<br />
			  A Imagem Banner SideBar Produtos deve ter 250px de largura.<br />
              A Imagem Banner SideBar Blog deve ter 250px de largura.
              </div>
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
            <label for="link" class="col-sm-2 control-label">Link</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][link]" value="<?php echo @$link; ?>" class="form-control" id="link" placeholder="Link">
            </div>
        </div>

        <div class="form-group">
            <label for="link" class="col-sm-2 control-label">Posição</label>
            <div class="col-sm-10">
            	<select class="form-control" name="dados[<?php echo $tabela;?>][posicao]">
                    <option value="" >Selecione..</option>
                    <?php
                    	$qtde_tamanhos = count($posicaoBanner);
						for($i=1;$i<=$qtde_tamanhos;$i++){
					?>
                    <option value="<?php echo $i;?>" <?php if($i == @$posicao) { echo "selected";} ?>><?php echo @$posicaoBanner[$i]; ?></option>
                    <?php } ?>
                 </select>
            </div>
        </div>

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
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>
    </form>

<?php } else { ?>
    <div class="separa"></div>
<div class="table-responsive">
<table class="table table-hover">
  <thead>
    <tr>
      <th>Banner</th>
      <th>Link</th>
      <th>Posição</th>
      <th class="central">Situacao</th>
      <th class="central">Alterar</th>
      <th class="central">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela ORDER BY posicao ASC LIMIT $inicio, $maximo";
	$sql_paginacao = "SELECT * FROM $tabela WHERE tela_id = $idtela ORDER BY posicao ASC";
	$resultado = $conecta->selecionar($conecta->conn,$sql);

	while($rs = mysqli_fetch_array($resultado)){
  ?>
    <tr>
      <td><img src="<?php echo $rs['arquivo']; ?>" class="img-responsive" alt="Responsive image" width="100" /></td>
      <td><?php echo $rs['link']; ?></td>
      <td><?php echo @$posicaoBanner[$rs['posicao']]; ?></td>
      <td align="center">
      <form action="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>" method="post" enctype="multipart/form-data" name="form_ativa">
            <input type="hidden" value="<?php echo $rs['id'];?>" id="item_id" name="item_id" />
            <input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" />
            </form>
      </td>
      <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
      <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div><!--FIM TABLE RESPONSIVE-->
<?php  } ?>
