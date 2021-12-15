<?php error_reporting(0);
ini_set("display_errors", 0 );
if(isset($_POST['relatorio_geral']) && $_POST['relatorio_geral'] == "Gerar PDF"){

	@include "../../parametros.php";
	@include "../../uteis/bancodados.php";
	//@include "../../funcoes.php";
	@include "../../assets/plugins/bootstrap/css/bootstrap-theme.mim.css";
	
	@include('../../mpdf/mpdf.php');
	
	$conecta = new Recordset;
	$conecta->conexao();
	
	$sql = "SELECT * FROM tbconfiguracao where tela_id = 22";
	$resultado = $conecta->selecionar($conecta->conn,$sql);
	$dados = mysqli_fetch_array($resultado);
	
	$codigo = '';
	$cliente = '';
	$status = '';
	
	
	$id = $_POST['alterar'];
	
	$sql = "SELECT * FROM tbpedido_avulso WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn,$sql);
	$rs = mysqli_fetch_array($resultado);
	
	$sql_cliente = "SELECT * FROM tbcliente WHERE id = ".$rs['cliente_id'];
	$resultado_cliente = $conecta->selecionar($conecta->conn,$sql_cliente);
	$rs_cliente = mysqli_fetch_array($resultado_cliente);
		
	$sql_pedido_produto = "SELECT p.* FROM tbpecas_avulsas p WHERE pedido_avulso_id = ".$rs['id'];
	$resultado_pedido_produto = $conecta->selecionar($conecta->conn,$sql_pedido_produto);
	
	
	$html_pdf = '<div class="table-responsive">
        <table border="0" width="100%" style="font:15px arial;" cellpadding="3" cellspacing="3">
			<tr>
				<td rowspan="2"><img src="../../images/'.$dados['logomarca'].'" class="logo_painel" height="70" /></td>
				<td colspan="5">'.$dados['nomeloja'].'</td>
			</tr>
			<tr>
				
				<td colspan="5">'.str_replace("<br />","",$dados['enderecoloja']).' - '.$dados['emailloja'].' | '.$dados['telefoneloja'].'</td>
			</tr>
			<tr>
				<td style="height:5px; width:100%; float:left;" colspan="6"></td>
			</tr>
			<tr>
				<td style="height:5px; width:100%; float:left; background:#eaeaea;" colspan="6"></td>
			</tr>
            ';
			 $html_pdf .= '</table>
      </div>';	  
		 
		  $html_pdf .= '<div class="table-responsive">
				<table class="table table-hover tabela_ficha" width="100%" style="font:13px arial;" cellpadding="3" cellspacing="3">
					<tr>
						<td colspan="4" align="center"><strong>CLIENTE</strong></td>
					</tr>
					<tr>
						<td colspan="4">'.$rs_cliente['id'].' - '.$rs_cliente['nome'].'</td>
					</tr>
					<tr>
						<td>'.$rs_cliente['email'].'</td>
						<td>'.$rs_cliente['telefone'].'</td>
						<td>'.$rs_cliente['celular'].'</td>
						<td>'.$rs_cliente['cidade'].'</td>
					</tr>
				</table>
				
				</div>
				
				<div class="table-responsive">
				<table class="table table-hover tabela_ficha" width="100%" style="font:13px arial;" cellpadding="3" cellspacing="3">
					<tr>
						<td colspan="3" align="center"><strong>PEDIDO</strong></td>
					</tr>
					<tr>
						<td><strong>Código: '.$rs['id'].'</strong></td>
						<td>'.substr($rs['data_pedido'],8,2).'/'.substr($rs['data_pedido'],5,2).'/'.substr($rs['data_pedido'],0,4).'</td>
						<td colspan="1"><strong>'.$status_pedido[$rs['status_pedido']].'</strong></td>
					</tr>';
					while($rs_pedido_produto = mysqli_fetch_array($resultado_pedido_produto)){ 
					$html_pdf .= '<tr>
						<td width="30%">'.$rs_pedido_produto['nome'].'</td>
						<td width="15%" align="center">'.$rs_pedido_produto['quantidade']."x".'</td>
						<td width="30%">'.(strip_tags(trim($rs_pedido_produto['observacao'])) != '' ? strip_tags(trim($rs_pedido_produto['observacao'])) : "").'</td>
					</tr>';
					} 
					
				$html_pdf .= '</table>
				</div>';
	
		
	$mpdf=new mPDF('pt','A4',3,'',10,10,2,10,9,9,'P');

	$mpdf->WriteHTML($html_pdf);
	$mpdf->Output("pedido_".$rs['id']."_".$rs_cliente['nome'].".pdf","D");
	exit();
	
}  else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE $tabela SET status = 0 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE $tabela SET status = 1 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}

if(@$_GET["apagaanexo"] == 1) {
	$id = $_GET['alterar'];
	$sql_apaga_anexo = "UPDATE $tabela SET documento = '' WHERE id = ".$id;
	$resultado_apaga_anexo = $conecta->selecionar($conecta->conn,$sql_apaga_anexo);
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php?pagina=$paginatela&amp;tela=$idtela&amp;vw=1&amp;alterar=$id\">\n";
	
}


	$id = $_GET['alterar'];
	
	$sql = "SELECT * FROM tbpedido_avulso WHERE id = $id";
	$resultado = $conecta->selecionar($conecta->conn,$sql);
	$rs = mysqli_fetch_array($resultado);
	
	$sql_cliente = "SELECT * FROM tbcliente WHERE id = ".$rs['cliente_id'];
	$resultado_cliente = $conecta->selecionar($conecta->conn,$sql_cliente);
	$rs_cliente = mysqli_fetch_array($resultado_cliente);
		
	$sql_pedido_produto = "SELECT p.* FROM tbpecas_avulsas p WHERE pedido_avulso_id = ".$rs['id'];
	$resultado_pedido_produto = $conecta->selecionar($conecta->conn,$sql_pedido_produto);
	
}  
?>
	
        
    
    
	<?php if(@$_GET['vw'] == 1) {?>
    
    <form action="paginas/pecas_avulsas.php" method="post" enctype="multipart/form-data">
    	<button type="submit" formtarget="_blank" name="relatorio_geral" value="Gerar PDF" class="btn btn-success btn_direita"><span class="glyphicon glyphicon glyphicon-file"></span> Gerar PDF</button>
        <input type="hidden" name="alterar" value="<?php echo $_GET['alterar'];?>" />
    </form>
    
		<div class="table-responsive">
        <table class="table table-hover tabela_ficha">
        	<tr>
            	<td colspan="4" align="center"><strong>CLIENTE</strong></td>
            </tr>
        	<tr>
            	<td colspan="4"><?php echo $rs_cliente['id']." - ".$rs_cliente['nome'];?></td>
            </tr>
            <tr>
            	<td><?php echo $rs_cliente['email'];?></td>
                <td><?php echo $rs_cliente['telefone'];?></td>
                <td><?php echo $rs_cliente['celular'];?></td>
                <td><?php echo $rs_cliente['cidade'];?></td>
            </tr>
        </table>
        
        </div>
        
        <div class="table-responsive">
        <table class="table table-hover tabela_ficha">
        	<tr>
            	<td colspan="4" align="center"><strong>PEDIDO</strong></td>
            </tr>
            <tr>
            	<td><strong>Código: <?php echo $rs['id'];?></strong></td>
                <td><?php echo substr($rs['data_pedido'],8,2)."/".substr($rs['data_pedido'],5,2)."/".substr($rs['data_pedido'],0,4);?></td>
                <td colspan="2"><strong><?php echo $status_pedido[$rs['status_pedido']];?></strong></td>
            </tr>
            <?php while($rs_pedido_produto = mysqli_fetch_array($resultado_pedido_produto)){ ?>
            <tr>
            	<td width="30%"><?php echo $rs_pedido_produto['nome'];?></td>
                <td width="15%" align="center"><?php echo $rs_pedido_produto['quantidade']."x";?></td>
                <td width="30%"><?php echo (strip_tags(trim($rs_pedido_produto['observacao'])) != '' ? strip_tags(trim($rs_pedido_produto['observacao'])) : "")?></td>
            </tr>
            <?php } ?>
            
        </table>
        </div>
    
    <?php } else {

if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	
	$id = $_GET['apagar'];
	$sqldeleta = "DELETE FROM tbpedido_avulso WHERE id = $id";

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
		$data_final = date('Y-m-d');
		if(isset($_POST['datai']) && $_POST['datai'] != ''){
			$data_inicial = substr($_POST['datai'],6,4)."-".substr($_POST['datai'],3,2)."-".substr($_POST['datai'],0,2);
		}
		if(isset($_POST['dataf']) && $_POST['dataf'] != ''){
			$data_final = substr($_POST['dataf'],6,4)."-".substr($_POST['dataf'],3,2)."-".substr($_POST['dataf'],0,2);
		}
		
		$periodo = " AND t.data_pedido BETWEEN '".$data_inicial."' AND '".$data_final."'"; 
		
				
		?><form action="" method="post" enctype="multipart/form-data">
    	
        <div class="col-sm-12 filtro"> 
    	
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
              <th class="central">Visualizar</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
    	<?php
		$sql = "SELECT DISTINCT t.id, t.data_pedido, t.status_pedido, c.nome FROM tbpedido_avulso t INNER JOIN tbcliente c ON c.id = t.cliente_id WHERE 1 = 1 $codigo $cliente $periodo ORDER BY t.data_pedido DESC, t.id DESC LIMIT $inicio, $maximo";
		$sql_paginacao = "SELECT DISTINCT t.id, t.data_pedido, t.status_pedido, c.nome FROM tbpedido_avulso t INNER JOIN tbcliente c ON c.id = t.cliente_id WHERE 1 = 1 $codigo $cliente $periodo ORDER BY t.data_pedido DESC, t.id DESC";
		
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		while($rs = mysqli_fetch_array($resultado)){ 
	  ?>
		<tr>
		  <td><?php echo $rs['id'];?></td>
          <td><?php echo $rs['nome'];?></td>
          <td><?php echo substr($rs['data_pedido'],8,2)."/".substr($rs['data_pedido'],5,2)."/".substr($rs['data_pedido'],0,4);?></td>
		  <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>" ><span class="glyphicon glyphicon-eye-open"></span></a></td>
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