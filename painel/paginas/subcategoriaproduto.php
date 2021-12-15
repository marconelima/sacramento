<?php
$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbprod_subcategoria']['id']));
	unset($dados['tbprod_subcategoria']['id']);
	$titulo =    	strip_tags(trim($dados['tbprod_subcategoria']['titulo']));

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

		if($_FILES['arquivo']['name'] != ''){
			$var1 = explode('.',$name);
			$var2 = end($var1);
			$extensao = strtolower($var2);
			$nome = 'imagem-'.md5(uniqid(rand(), true)).'.'.$extensao;
			$uploadfile = $pasta."/".$nome;

			if(move_uploaded_file($tmp,$uploadfile)){
				$resultadoUpload = '<div class="alert alert-success">Imagem Carregada com sucesso!</div>';
				$ok = 1;
			} else{
				$resultadoUpload = '<div class="alert alert-danger">Não foi possível enviar a Imagem!</div>';
			}
		$dados['tbprod_categoria']['arquivo'] = @$nome;
		}

		$resultado = $conecta->inserir($dados);
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.'</span>';
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbprod_subcategoria']['id']));
	$titulo =    	strip_tags(trim($dados['tbprod_subcategoria']['titulo']));
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


		if(!empty($name)){
			$var1 = explode('.',$name);
			$var2 = end($var1);
			$extensao = strtolower($var2);
			$nome = 'imagem-'.md5(uniqid(rand(), true)).'.'.$extensao;
			$dados['tbprod_subcategoria']['arquivo'] = $nome;
			$uploadfile = $pasta."/".$nome;
			if(move_uploaded_file($tmp,$uploadfile)){
				$resultadoUpload = '<div class="alert alert-success">Imagem Carregada com sucesso!</div>';
				$ok = 1;
			} else{
				$resultadoUpload = '<div class="alert alert-danger">Não foi possível enviar a Imagem!</div>';
			}
		}
	}
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.'</span>';
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];



	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbprod_subcategoria WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM tbprod_subcategoria WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['titulo'];
	$arquivo = $rs['arquivo'];
	$categoria = $rs['categoria_id'];
}

?>
	<a href="home.php?pagina=subcategoriaproduto&amp;vw=1&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Sub-Categoria de <?php echo $nometela;?></button></a>
    <a href="home.php?pagina=produto&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-warning btn_direita"><span class="glyphicon glyphicon-repeat"></span> Voltar a <?php echo $nometela;?></button></a>
    <div class="separa"></div>
	<?php if(@$_GET['vw'] == 1) {?>
	<form class="form-horizontal" role="form" name="formsubcategoriaproduto" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[tbprod_subcategoria][id]" value="<?php echo $id; ?>" />
    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título:</label>
            <div class="col-sm-10">
            <input type="text" name="dados[tbprod_subcategoria][titulo]" value="<?php echo @$titulo; ?>" class="form-control" id="titulo" placeholder="Título"/>
             </div>
        </div>
        <div class="form-group">
            <label for="arquivo" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">
              <input type="file" name="arquivo" class="form-control" id="arquivo" placeholder="Imagem">
            </div>
        </div>
        <div class="form-group">
			<?php if(@$arquivo != '') {?>
            <div class="col-sm-2 "></div>
            <div class="col-sm-10">
            <img src="../imagens/<?php echo $arquivo; ?>" class="img-thumbnail" />
            </div>
            <?php } ?>
        </div>

        <div class="form-group">
        <label for="titulo" class="col-sm-2 control-label">Categoria</label>
        <div class="col-sm-10">
        	<select name="dados[tbprod_subcategoria][categoria_id]" class="form-control">
            <option value="" class="inputCampo" >Selecione...</option>
            <?php
                $resultadoCategoria = $conecta->selecionar($conecta->conn,"SELECT * FROM tbprod_categoria");
                while($rsCategoria = mysqli_fetch_array($resultadoCategoria)){
            ?>
            <option value="<?php echo $rsCategoria['id'];?>"<?php if(@$categoria == $rsCategoria['id']) { echo "selected"; } ?> ><?php echo $rsCategoria['titulo']; ?></option>
            <?php }
            ?>
            </select>
            </div>
        </div>


            <div class="form-group" style="margin-right:0px;">
            <input  class="btn btn-default btn_direita" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </div>
	</form>
    <?php } else {?>
    	<?php
		$sql = "SELECT * FROM tbprod_subcategoria ORDER BY titulo ASC LIMIT $inicio, $maximo";
		$sql_paginacao = "SELECT * FROM tbprod_subcategoria";
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		?>
    	<div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Título</th>
              <th class="central">Alterar</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
    	  <?php while($rs = mysqli_fetch_array($resultado)){ ?>
          <tr>
		  <td><?php echo $rs['titulo'];?></td>
		  <td align="center"><a href="home.php?pagina=subcategoriaproduto&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
		  <td align="center"><a href="home.php?pagina=subcategoriaproduto&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
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
