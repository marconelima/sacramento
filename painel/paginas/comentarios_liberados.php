<?php
if(isset($_POST['alterar']) && $_POST['alterar'] == 'Gravar'){

	$dados = 		$_POST["dados"];
	$id 	=	$dados[$tabela]['id'];
	$mensagem =    	trim($dados[$tabela]['comentario']);

	$string = " id = $id";

	$_GET['editar'] = 0;

	$resultado = $conecta->alterar($dados, $string);



} if(isset($_GET['apagar']) && $_GET['apagar'] != ""){

	$id = $_GET['apagar'];

	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbcomentario WHERE id = $id");
	if($resultado == 1){
		$resultado_com = '<div class="alert alert-success">Comentário excluído com sucesso!</div>';
	} else {
		$resultado_com = '<div class="alert alert-danger">Não foi possível excluir o comentário!</div>';
	}
} elseif(isset($_GET['aprovar_todos']) && $_GET['aprovar_todos'] == "todos"){
	$resultado = $conecta->selecionar($conecta->conn,"UPDATE tbcomentario SET status = 1 WHERE status = 0");
	if($resultado == 1){
		$resultado_com = '<div class="alert alert-success">Todos os comentários aprovados com sucesso!</div>';
	} else {
		$resultado_com = '<div class="alert alert-danger">Não foi possível aprovar os comentários!</div>';
	}
} 	else if(isset($_GET['aprovar']) && $_GET['aprovar'] != ""){
	$id = $_GET['aprovar'];
	$resultado = $conecta->selecionar($conecta->conn,"UPDATE tbcomentario SET status = 1 WHERE id = $id");
	if($resultado == 1){
		$resultado_com = '<div class="alert alert-success">Comentário aprovado com sucesso!</div>';
	} else {
		$resultado_com = '<div class="alert alert-danger">Não foi possível aprovar o comentário!</div>';
	}
}

?>

	<?php
    	if(isset($_GET['editar']) && $_GET['editar'] > 0){
			$id = $_GET['editar'];
			$sql = "SELECT * FROM tbcomentario WHERE id = $id";
			$resultado = $conecta->selecionar($conecta->conn,$sql);

			$rs = mysqli_fetch_array($resultado);
			$id = $rs['id'];
			$comentario = $rs['comentario'];
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
            <label for="autor" class="col-sm-2 control-label">Cidade:</label>
            <div class="col-sm-10">
        <input name="site" size="40" value="<?php echo @$cidade;?>" disabled="disabled" class="form-control" id="autor" placeholder="Cidade">
            </div>
        </div>
        <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Comentário:</label>
            <div class="col-sm-10">
        <textarea class="input_painel" name="dados[<?php echo $tabela; ?>][comentario]" cols="35" rows="4" placeholder="Comentário"><?php echo @$comentario;?></textarea>
        </div>
        </div>
        <div class="form-group">
        <div class="col-sm-12">
         <button type="submit" value="Gravar" class="btn btn-default btn_direita" name="alterar" type="submit" />Salvar</button>
        </div>
       </div>
    </form>


	<?php } else { ?>

    <a href="home.php?pagina=comentario&amp;tela=<?php echo $_GET['tela'];?>"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Visualizar comentários pendentes</button></a>
    <a href="home.php?pagina=comentarios_liberados&amp;tela=<?php echo $_GET['tela'];?>&amp;expandir=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Expandir todos</button></a>

        <div class="separa"></div>

    <?php
		if($_GET['tela'] == 23){
			$tab = 'tbgrupo_noticia';
			$tit = 'titulo';
		}else {
			$tab = 'tbproduto';
			$tit = 'nome';
		}

		$sql = "SELECT * FROM tbcomentario WHERE status = 1 AND tabela = '$tab' ORDER BY pai_id ASC, data ASC";
		$resultado = $conecta->selecionar($conecta->conn,$sql);

		$qtde_comentario = mysqli_num_rows($resultado);

		if(isset($resultado_com) && $resultado_com != ''){
			echo "<div style='width:100%; height:auto; float:left;'>".$resultado_com."</div>";
		}
		?>
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="80%">Notícia</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
          <?php

			if($qtde_comentario > 0 ){
				$pai_atual = "";
			while($rs = mysqli_fetch_array($resultado)){
				$data = substr($rs['data'],8,2)."/".substr($rs['data'],5,2)."/".substr($rs['data'],0,4)." ".substr($rs['data'],11,2).":".substr($rs['data'],14,2);

			$sql_not = "SELECT *, $tit as titulo FROM ".$rs['tabela']." WHERE id = ".$rs['pai_id'];


			$resultado_not = $conecta->selecionar($conecta->conn,$sql_not);
			$rs_not = mysqli_fetch_array($resultado_not);
			$noticia_comentada = $rs_not['titulo'];

			$pai = $rs['pai_id'];
			if($pai_atual != $pai){
				$pai_atual = $pai;
				echo "<tr><td>&nbsp;</td></tr>";
			}

			?>
          	<tr>
            	<td>
				<img src="../images/balaozinho.png" border="0"  title="<?php echo $rs['comentario']; ?>" />
                <span  title="<?php echo $rs['comentario']; ?>"><?php echo $noticia_comentada;?></span>
                </td>

                <td align="center">
                    <div id="comentario_excluir"><a href="home.php?pagina=comentario&amp;apagar=<?php echo $rs['id']?>&amp;tela=<?php echo $_GET['tela'];?>" ><span class="glyphicon glyphicon-remove"></span></a></div>
                </td>
       		</tr>
		  	<tr>
                <td colspan="4">

                <div id="comentario_complemento">
                <span class="comentario_titulo">Comentário:</span>&nbsp;<span class="comentario_ip">IP: <?php echo $rs['ip']; ?></span><br />
                <span class="comentario_texto"><em><?php echo $rs['comentario']; ?></em></span><br />
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
			<div style="width:100%; height:auto; float:left; margin:20px 0; font:11px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#45747B; text-align:center;">Sem comentários pendentes</div>
    <?php
		}
	}
	?>
