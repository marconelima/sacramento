<?php
if(isset($_POST['alterar']) && $_POST['alterar'] == 'Gravar'){

	$dados = 		$_POST["dados"];
	$id 	=	$dados[$tabela]['id'];
	$mensagem =    	trim($dados[$tabela]['conteudo']);

	$string = " id = $id";

	$_GET['editar'] = 0;

	$resultado = $conecta->alterar($dados, $string);



} if(isset($_GET['apagar']) && $_GET['apagar'] != ""){

	$id = $_GET['apagar'];

	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbdepoimento WHERE id = $id");
	if($resultado == 1){
		$resultado_com = '<div class="alert alert-success">Depoimento excluído com sucesso!</div>';
	} else {
		$resultado_com = '<div class="alert alert-danger">Não foi possível excluir o depoimento!</div>';
	}
} elseif(isset($_GET['aprovar_todos']) && $_GET['aprovar_todos'] == "todos"){
	$resultado = $conecta->selecionar($conecta->conn,"UPDATE tbdepoimento SET status = 1 WHERE status = 0");
	if($resultado == 1){
		$resultado_com = '<div class="alert alert-success">Todos os depoimentos aprovados com sucesso!</div>';
	} else {
		$resultado_com = '<div class="alert alert-danger">Não foi possível aprovar os depoimentos!</div>';
	}
} 	else if(isset($_GET['aprovar']) && $_GET['aprovar'] != ""){
	$id = $_GET['aprovar'];
	$resultado = $conecta->selecionar($conecta->conn,"UPDATE tbdepoimento SET status = 1 WHERE id = $id");
	if($resultado == 1){
		$resultado_com = '<div class="alert alert-success">Depoimento aprovado com sucesso!</div>';
	} else {
		$resultado_com = '<div class="alert alert-danger">Não foi possível aprovar o depoimento!</div>';
	}
}

?>

	<?php
    	if(isset($_GET['editar']) && $_GET['editar'] > 0){
			$id = $_GET['editar'];
			$sql = "SELECT * FROM tbdepoimento WHERE id = $id";
			$resultado = $conecta->selecionar($conecta->conn,$sql);

			$rs = mysqli_fetch_array($resultado);
			$id = $rs['id'];
			$conteudo = $rs['conteudo'];
			$nome = $rs['nome'];
			$email = $rs['email'];
			$cidade = $rs['cidade'];
	?>

    <form  class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data" name="formPostar">
    	<input type="hidden" name="dados[<?php echo $tabela; ?>][id]" value="<?php echo $id; ?>" />
    	 <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Nome:</label>
            <div class="col-sm-10">
        <input name="nome" size="40" value="<?php echo @$nome;?>" disabled="disabled" class="form-control" id="autor" placeholder="Nome">
            </div>
        </div>
         <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
        <input name="email" size="40" value="<?php echo $email;?>" disabled="disabled"  class="form-control" id="autor" placeholder="E-mail(O e-mail não será mostrado no site)">
            </div>
        </div>
         <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Cidade / Estado:</label>
            <div class="col-sm-10">
        <input name="site" size="40" value="<?php echo @$cidade;?>" disabled="disabled" class="form-control" id="autor" placeholder="Cidade / Estado">
            </div>
        </div>
        <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Depoimento:</label>
            <div class="col-sm-10">
        <textarea class="input_painel" name="dados[<?php echo $tabela; ?>][conteudo]" cols="35" rows="4" placeholder="Depoimento"><?php echo @$conteudo;?></textarea>
        </div>
        </div>
        <div class="form-group">
        <div class="col-sm-12">
         <button type="submit" value="Gravar" class="btn btn-default btn_direita" name="alterar" type="submit" />Salvar</button>
        </div>
       </div>
    </form>


	<?php } else { ?>

    <a href="home.php?pagina=depoimento&amp;tela=25"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Visualizar comentários pendentes</button></a>

        <div class="separa"></div>

    <?php
		$sql = "SELECT * FROM tbdepoimento WHERE status = 1 ORDER BY id DESC";
		$resultado = $conecta->selecionar($conecta->conn,$sql);

		$qtde_comentario = mysqli_num_rows($resultado);

		if(isset($resultado_com) && $resultado_com != ''){
			echo "<div style='width:100%; height:auto; float:left;'>".$resultado_com."</div>";
		}
		if($qtde_comentario > 0 ){
		?>
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="80%">Depoimento</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
          <?php



			while($rs = mysqli_fetch_array($resultado)){
				$data = substr($rs['data'],8,2)."/".substr($rs['data'],5,2)."/".substr($rs['data'],0,4)." ".substr($rs['data'],11,2).":".substr($rs['data'],14,2);

			?>
          	<tr>
            	<td>
				<img src="../images/balaozinho.png" border="0"  title="<?php echo $rs['conteudo']; ?>" />
                <span  title="<?php echo $rs['conteudo']; ?>"><?php echo $rs['nome'];?></span>
                </td>

                <td align="center">
                    <div id="comentario_excluir"><a href="home.php?pagina=depoimento&amp;apagar=<?php echo $rs['id']?>&amp;tela=<?php echo $_GET['tela'];?>" ><span class="glyphicon glyphicon-remove"></span></a></div>
                </td>
       		</tr>
		  	<tr>
                <td colspan="4">

                <div id="comentario_complemento">
                <span class="comentario_titulo">Depoimento:</span><br />
                <span class="comentario_texto"><em><?php echo $rs['conteudo']; ?></em></span><br />
                <span class="comentario_titulo">Nome:</span><span class="comentario_nome"><?php echo $rs['nome']; ?></span>
                <span class="comentario_titulo">E-mail:</span><span class="comentario_email"><?php echo $rs['email']; ?></span>
                <span class="comentario_titulo">Cidade:</span><span class="comentario_cidade"><?php echo $rs['cidade']; ?></span>
                <span class="comentario_titulo">Data:</span><span class="comentario_data"> <?php echo substr($rs['data'],8,2)."/".substr($rs['data'],5,2)."/".substr($rs['data'],0,4)." ".substr($rs['data'],11,5); ?></span>
                </div>
                </td>
            </tr>

    <?php $i++; } ?>
    </tbody>
            </table>
            </div>
	<?php } else { ?>
			<div style="width:100%; height:auto; float:left; margin:20px 0; font:11px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#45747B; text-align:center;">Sem depoimentos liberados</div>
    <?php
		}
	}
	?>
