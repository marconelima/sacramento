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
	$nome =    	strip_tags(trim($dados[$tabela]['nome']));

	$data = 		strip_tags(trim($dados[$tabela]['data']));

	if(empty($nome)) {
		$retorno = '<div class="alert alert-danger">Informe o Nome!</div>';
	}

	if (empty($retorno)) {
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
	$nome =    	strip_tags(trim($dados[$tabela]['nome']));
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	$string = " id = $id";

	if(empty($nome)) {
		$retorno = '<div class="alert alert-danger">Informe o Nome!</div>';
	}
	if (empty($retorno)) {

		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo $resultado;
	}else {
		echo $retorno;
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){

	$id = $_GET['apagar'];

	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbperfil WHERE id = $id");
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
	$nome = $rs['nome'];

	$status = $rs['status'];
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
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][nome]" value="<?php echo @$nome; ?>" class="form-control" id="nome" placeholder="Nome">
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
      <th>Nome</th>
      <th class="central">Situacao</th>
      <th class="central">Dar Permissões</th>
      <th class="central">Alterar</th>
      <th class="central">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela AND nome not in ('Administrador') ORDER BY nome ASC LIMIT $inicio, $maximo";
	$sql_paginacao = "SELECT * FROM $tabela WHERE tela_id = $idtela AND nome not in ('Administrador') ORDER BY nome ASC";
	$resultado = $conecta->selecionar($conecta->conn,$sql);
	while($rs = mysqli_fetch_array($resultado)){
  ?>
    <tr>
      <td><?php echo $rs['nome']; ?></td>
      <td align="center">
      <form action="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>" method="post" enctype="multipart/form-data" name="form_ativa">
            <input type="hidden" value="<?php echo $rs['id'];?>" id="item_id" name="item_id" />
            <input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" />
            </form>
      </td>
      <td align="center"><a href="home.php?pagina=permissao&amp;tela=6&amp;id=<?php echo $rs['id']; ?>" ><span class="glyphicon glyphicon-cog"></span></a></td>
      <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
      <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div><!--FIM TABLE RESPONSIVE-->
<div class="centro">
      	<?php
        	$resultado_total = $conecta->selecionar($conecta->conn,$sql_paginacao);
            include "paginacao.php";
		?>
      </div>
<?php  } ?>
