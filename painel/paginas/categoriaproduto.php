<?php
$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbprod_categoria']['id']));
	unset($dados['tbprod_categoria']['id']);
	$titulo =    	strip_tags(trim($dados['tbprod_categoria']['titulo']));

	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título!</span>';
	}

	if (empty($retorno)) {
		//CONFIGURAÇÃO UPLOAD
		$pasta = "../source/Imagens";
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
	$id = 			strip_tags(trim($dados['tbprod_categoria']['id']));
	$titulo =    	strip_tags(trim($dados['tbprod_categoria']['titulo']));
	$string = " id = $id";

	if(empty($titulo)) {
		$retorno = '<span class="retorno">Informe o título!</span>';
	}
	if (empty($retorno)) {
		//CONFIGURAÇÃO UPLOAD
		$pasta = "../source/Imagens";
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
			$dados['tbprod_categoria']['arquivo'] = $nome;
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
		echo '<span id="retorno">'.$resultado.'</span>';
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];

	$pasta = "../source/Imagens/";

	$sql_busca = "SELECT arquivo FROM tbprod_categoria WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn,$sql_busca);
	$rs = mysqli_fetch_array($resultado);
	$nome = $rs['arquivo'];
	if($nome != '') {
		unlink($pasta.'/'.$nome);
	}

	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbprod_categoria WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM tbprod_categoria WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$arquivo = $rs['arquivo'];
	$titulo = $rs['titulo'];
}

?>
	<a href="home.php?pagina=categoriaproduto&amp;vw=1&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Categoria de <?php echo $nometela;?></button></a>
    <a href="home.php?pagina=produto&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-warning btn_direita"><span class="glyphicon glyphicon-repeat"></span> Voltar a <?php echo $nometela;?></button></a>
    <div class="separa"></div>
	<?php if(@$_GET['vw'] == 1) {?>

	<form class="form-horizontal" role="form"  name="formcategoriaproduto" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[tbprod_categoria][id]" value="<?php echo $id; ?>" />
    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título:</label>
            <div class="col-sm-10">
            <input type="text" name="dados[tbprod_categoria][titulo]" value="<?php echo @$titulo; ?>" class="form-control" id="titulo" placeholder="Título"/>
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
            <img src="../source/Imagens/<?php echo $arquivo; ?>" class="img-thumbnail" />
            </div>
            <?php } ?>
        </div>
        <div class="form-group" style="margin-right:0px;">
            <input  class="btn btn-default btn_direita" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </div>
	</form>

    <?php } else {?>
    	<?php
		$sql = "SELECT * FROM tbprod_categoria ORDER BY titulo ASC LIMIT $inicio, $maximo";
		$sql_paginacao = "SELECT * FROM tbprod_categoria";
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
		  <td align="center"><a href="home.php?pagina=categoriaproduto&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
		  <td align="center"><a href="home.php?pagina=categoriaproduto&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
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
