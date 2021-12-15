<?php error_reporting(0);
ini_set("display_errors", 0 );


if(isset($_GET['vw']) && $_GET['vw'] != ''){

	@include "../../parametros.php";
	@include "../../uteis/bancodados.php";
	@include "../../css/bootstrap-theme.mim.css";

	$conecta = new Recordset;
	$conecta->conexao();

	$sql_precadastro = "SELECT t.* FROM tbprecadastro t where t.id = ".$_GET['vw']." ORDER BY t.data DESC, t.id DESC";

	$resultado_precadastro = $conecta->selecionar($conecta->conn,$sql_precadastro);
	$rs_precadastro = mysqli_fetch_array($resultado_precadastro);

	$cart = ($rs_precadastro['cartao'] == 'Sim' ? 'Sim' : 'Não');

	$conteudoarquivo = $rs_precadastro['nome']."\n".$rs_precadastro['cpf']."\n".$rs_precadastro['rg']."\n".substr($rs_precadastro['data_nasc'],8,2)."/".substr($rs_precadastro['data_nasc'],5,2)."/".substr($rs_precadastro['data_nasc'],0,4)."\n".$rs_precadastro['endereco']."\n".$rs_precadastro['numero']."\n".$rs_precadastro['cep']."\n".$rs_precadastro['bairro']."\n".$rs_precadastro['cidade']."\n".$rs_precadastro['estado']."\n".$rs_precadastro['phone']."\n".$rs_precadastro['cel']."\n".$rs_precadastro['email']."\n".$cart."\n".$rs_precadastro['oquevende']."\n".$rs_precadastro['quantovende']."\n".$rs_precadastro['referencia1']."\n".$rs_precadastro['parentesco_ref1']."\n".$rs_precadastro['ref1_phone']."\n".$rs_precadastro['ref1_cel']."\n".$rs_precadastro['referencia2']."\n".$rs_precadastro['parentesco_ref2']."\n".$rs_precadastro['ref2_phone']."\n".$rs_precadastro['ref2_cel']."\n".$rs_precadastro['referencia3']."\n".$rs_precadastro['parentesco_ref3']."\n".$rs_precadastro['ref3_phone']."\n".$rs_precadastro['ref3_cel']."\n".stripcslashes($rs_precadastro['mensagem']);


	$conteudoarquivo = preg_replace('/(\\r)?\\n(\\r)?/', "\r\n", $conteudoarquivo);

	$fp = fopen("../../arquivos/precadastro_".$rs_precadastro['cpf'].".txt", "w");

	// Escreve "exemplo de escrita" no bloco1.txt
	$escreve = fwrite($fp, $conteudoarquivo);

	// Fecha o arquivo
	fclose($fp);

	$arquivo = "precadastro_".$rs_precadastro['cpf'].".txt";

	  header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream;");
      header("Content-Length:".filesize("../../arquivos/".$arquivo));
      header("Content-disposition: attachment; filename=".$arquivo);
      header("Pragma: no-cache");
      header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
      header("Expires: 0");
      readfile("../../arquivos/".$arquivo);
      flush();


} else {


	if(isset($_GET['apagar']) && $_GET['apagar'] != ""){

		$id = $_GET['apagar'];
		$sqldeleta = "DELETE FROM tbprecadastro WHERE id = $id";

		$resultado = $conecta->selecionar($conecta->conn,$sqldeleta);
		if($resultado == 1){
			$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';
		} else {
			$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
		}
	}

	$codigo = '';
	$cliente = '';

	if(isset($_POST['codigo']) && $_POST['codigo'] != ''){
		$codigo = " AND t.id = ".$_POST['codigo'];
	}
	if(isset($_POST['cliente']) && $_POST['cliente'] != ''){
		$cliente = " AND c.nome LIKE '%".$_POST['cliente']."%'";
	}
	$data_inicial = '1970-01-01';
	$data_final = date('Y-m-d')." 23:59:59";
	if(isset($_POST['datai']) && $_POST['datai'] != ''){
		$data_inicial = substr($_POST['datai'],6,4)."-".substr($_POST['datai'],3,2)."-".substr($_POST['datai'],0,2);
	}
	if(isset($_POST['dataf']) && $_POST['dataf'] != ''){
		$data_final = substr($_POST['dataf'],6,4)."-".substr($_POST['dataf'],3,2)."-".substr($_POST['dataf'],0,2)." 23:59:59";
	}

	$periodo = " AND t.data BETWEEN '".$data_inicial."' AND '".$data_final."'";


	?>

	<div class="col-sm-12 filtro">

	<form action="" method="post" enctype="multipart/form-data">
		<input name="codigo" value="<?php echo @$_POST['codigo'];?>" class="form-control campo_filtro" style="width:72px;" placeholder="Código" />
		<input name="cliente" value="<?php echo @$_POST['cliente'];?>" class="form-control campo_filtro" placeholder="Cliente" />
	    <input name="datai" value="<?php echo @$_POST['datai'];?>" class="form-control campo_filtro datepicker" placeholder="Data Inicial" />
	    <input name="dataf" value="<?php echo @$_POST['dataf'];?>" class="form-control campo_filtro datepicker" placeholder="Data Final" />

		<button type="submit" value="Filtrar" class="btn btn-default">Filtrar</button>
	</div>
	</form>
	<div class="separa"></div>
	<div class="table-responsive">
	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>Código</th>
	      <th>Cliente</th>
	      <th>Data</th>
		  <th class="central">Gerar TXT</th>
	      <th class="central">Excluir</th>
	    </tr>
	  </thead>
	  <tbody>
	<?php
	$sql = "SELECT DISTINCT t.* FROM $tabela t  WHERE 1 = 1 $codigo $cliente $periodo ORDER BY t.data DESC, t.id DESC LIMIT $inicio, $maximo";
	$sql_paginacao = "SELECT DISTINCT t.* FROM $tabela t WHERE 1 = 1 $codigo $cliente $periodo ORDER BY t.data DESC, t.id DESC";

	$resultado = $conecta->selecionar($conecta->conn,$sql);
	while($rs = mysqli_fetch_array($resultado)){
	?>
	<tr>
	  <td><?php echo $rs['id'];?></td>
	  <td><?php echo $rs['nome'];?></td>
	  <td><?php echo substr($rs['data'],8,2)."/".substr($rs['data'],5,2)."/".substr($rs['data'],0,4);?></td>
	  <td align="center"><a href="paginas/relatorio_precadastro.php?vw=<?php echo $rs['id']?>" target="_blank" ><span class="glyphicon glyphicon-save-file"></span></a></td>
	  <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
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
