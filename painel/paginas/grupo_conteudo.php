<?php

if(@$_GET["apagaanexo"] == 1) {
	$id = $_GET['alterar'];
	$sql_apaga_anexo = "UPDATE $tabela SET documento = '' WHERE id = ".$id;
	$resultado_apaga_anexo = $conecta->selecionar($conecta->conn,$sql_apaga_anexo);

	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php?pagina=$paginatela&amp;tela=$idtela\">\n";

}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$dados[$tabela]['conteudo'] = stripcslashes(str_replace("../source",@$rs_configuracao['linkloja']."/source",$dados[$tabela]['conteudo']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	$documento = 		strip_tags(trim(@$dados[$tabela]['documento']));

	$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];

	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}elseif (empty($conteudo)) {
		$retorno = '<div class="alert alert-danger">Digite o Conteúdo!</div>';
	}

	if (empty($retorno)) {

		$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
		$resultado = $conecta->inserir($dados);

		$_GET['vw'] = 0;
		echo $resultado;
		echo @$retornoDocumento;
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$titulo =    	strip_tags(trim($dados[$tabela]['titulo']));
	$dados[$tabela]['conteudo'] = stripcslashes(str_replace("../source",@$rs_configuracao['linkloja']."/source",$dados[$tabela]['conteudo']));
	$conteudo =  	$dados[$tabela]['conteudo'];
	$data = 		strip_tags(trim($dados[$tabela]['data']));
	$documento = 		strip_tags(trim(@$dados[$tabela]['documento']));

	$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];

	$string = " id = $id";

	if(empty($titulo)) {
		$retorno = '<div class="alert alert-danger">Informe o título!</div>';
	}elseif (empty($conteudo)) {
		$retorno = '<div class="alert alert-danger">Digite o Conteúdo!</div>';
	}
	if (empty($retorno)) {


		$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo $resultado;
		echo @$retornoDocumento;
	} else {
		echo $retorno;
	}
} else {

	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM $tabela WHERE tela_id = $idtela");
	$rs = mysqli_fetch_array($resultado);

	$id = @$rs['id'];
	$titulo = @$rs['titulo'];
	$conteudo = @$rs['conteudo'];
	$documento = @$rs['documento'];
}
?>


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
            <label for="conteudo" class="col-sm-2 control-label">Conteúdo</label>
            <div class="col-sm-10">
              <textarea name="dados[<?php echo $tabela;?>][conteudo]" class="form-control" id="conteudo" placeholder="Conteúdo"><?php echo @stripslashes($conteudo); ?></textarea>
            </div>
        </div>



        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(@$id > 0){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>

	</form>
