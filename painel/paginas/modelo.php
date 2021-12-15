<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE tbmodelo SET status = 0 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE tbmodelo SET status = 1 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbmodelo']['id']));
	$titulo =    	strip_tags(trim($dados['tbmodelo']['titulo']));
	$categoria = strip_tags(trim($dados['tbmodelo']['montadora_id']));

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
	$id = 			strip_tags(trim($dados['tbmodelo']['id']));
	$titulo =    	strip_tags(trim($dados['tbmodelo']['titulo']));
	$categoria = strip_tags(trim($dados['tbmodelo']['montadora_id']));
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
	$sql_filhocategoria = "SELECT id FROM tbano WHERE modelo_id = $id";
	$resultado_filhocategoria  = $conecta->selecionar($conecta->conn,$sql_filhocategoria);

	if(!$rs_paicategoria = mysqli_fetch_array($resultado_filhocategoria)){
		$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbmodelo WHERE id = $id");
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
	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM tbmodelo WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
	$status = $rs['status'];
	$categoria = $rs['montadora_id'];

}
?>

    <a href="home.php?pagina=modelo&amp;tela=<?php echo $idtela; ?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Modelos</button></a>


	<?php if(@$_GET['vw'] == 1) {?>
		<a href="home.php?pagina=<?php echo @$_GET['pagina']?>&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-warning btn_direita"><span class="glyphicon glyphicon-repeat"></span> Voltar</button></a>

		<div class="separa"></div>

	<form class="form-horizontal" role="form" name="formNoticia" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[tbmodelo][id]" value="<?php echo @$id; ?>" />
        <input type="hidden" name="dados[tbmodelo][tela_id]" value="<?php echo @$idtela; ?>" />

    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input type="text" name="dados[tbmodelo][titulo]" value="<?php echo @$titulo; ?>" class="form-control" id="titulo" placeholder="Título">
            </div>
        </div>

		<div class="form-group">
			<label for="titulo" class="col-sm-2 control-label">Montadora</label>
			<div class="col-sm-10">
				<select name="dados[tbmodelo][montadora_id]" class="form-control">
					<option value="" class="inputCampo" >Selecione...</option>
					<?php
					$resultadoCategoria = $conecta->selecionar($conecta->conn,"SELECT * FROM tbmontadora ORDER BY titulo ASC");
					while($rsCategoria = mysqli_fetch_array($resultadoCategoria)){
						?>
						<option value="<?php echo $rsCategoria['id'];?>"<?php if(@$categoria == $rsCategoria['id']) { echo "selected"; } ?> ><?php echo $rsCategoria['titulo']; ?></option>
					<?php }
					?>
				</select>
			</div>
		</div>

        <div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Ativo</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[tbmodelo][status]" <?php if(@$status == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[tbmodelo][status]" <?php if(@$status == 2 ) { echo "checked"; } ?> value="2"> Não
               </div>

            </div>
        </div>

        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>

	</form>
    <?php } else {
		$filtro_montadora = "";
		if(isset($_POST['montadora']) != '' && @$_POST['montadora'] != 0){
			$filtro_montadora = " AND montadora_id = ".$_POST['montadora'];
		}

		$sql_montadora = "SELECT DISTINCT m.* FROM tbmontadora m ORDER BY titulo ASC";
		$resultado_montadora = $conecta->selecionar($conecta->conn,$sql_montadora);
		?>
		<div class="separa"></div>
    <div style="background: #EAEAEA; float:left; width: 100%; height: auto; padding: 2%;">
			<form name="busca-form" method="post" class="af-form row" id="busca-form" action="">
				<div class="col-sm-3 af-outer af-required fade-search">
					<div class="form-group af-inner">
						<select id="montadora" class="form-control" name="montadora">
							<option value="">-- Montadora --</option>
							<?php while($rs_montadora = mysqli_fetch_array($resultado_montadora)){?>
								<option value="<?php echo $rs_montadora['id'];?>" <?php if(@$_POST['montadora'] == $rs_montadora['id']) { echo "selected";}?>><?php echo $rs_montadora['titulo'];?></option>
							<?php }?>

						</select>
					</div>
				</div>
				<div class="col-sm-12 af-outer af-required fade-search">
					<div class="form-group af-inner">
						<input type="submit" name="buscar" class="form-button btn btn-default" id="submit_btn" value="Buscar" />
					</div>
				</div>
			</form>
		</div>
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Modelo</th>
							<th>Montadora</th>
              <th class="central">Situacao</th>
              <th class="central">Alterar</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
    	<?php
		$sql = "SELECT m.*, mo.titulo as montadora FROM tbmodelo m INNER JOIN tbmontadora mo ON mo.id = m.montadora_id WHERE m.tela_id = $idtela $filtro_montadora ORDER BY m.titulo, montadora ASC";
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		while($rs = mysqli_fetch_array($resultado)){
	  ?>
		<tr>
		  <td><?php echo $rs['titulo'];?></td>
			<td><?php echo $rs['montadora'];?></td>
		  <td align="center">
		  <form action="home.php?pagina=modelo&amp;tela=<?php echo $tela_id;?>" method="post" enctype="multipart/form-data" name="form_ativa">
				<input type="hidden" value="<?php echo $rs['id'];?>" id="item_id" name="item_id" />
				<input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" />
				</form>
		  </td>
		  <td align="center"><a href="home.php?pagina=modelo&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>&amp;p=<?php echo $p;?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
		  <td align="center"><a href="home.php?pagina=modelo&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>&amp;p=<?php echo $p;?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
		<?php } ?>
	  </tbody>
      </table>
      </div>
    <?php } ?>
