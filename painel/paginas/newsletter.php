<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_GET['apagar']) && $_GET['apagar'] != ""){

	$id = $_GET['apagar'];
	$sql_deleta = "DELETE FROM tbnewsletter WHERE email = '$id'";
	$resultado = $conecta->selecionar($conecta->conn, $sql_deleta);
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
	$_GET['vw'] = 1;
} elseif(isset($_GET['excel']) && $_GET['excel'] == '1'){

	//Incluir a classe excelwriter
   include("../uteis/excelwriter.php");

   //Você pode colocar aqui o nome do arquivo que você deseja salvar.
    $excel=new ExcelWriter("../documentos/listaemails.xls");

    if($excel==false){
        echo $excel->error;
   }

   //Escreve o nome dos campos de uma tabela
   $myArr=array('NOME','EMAIL', 'DATA');
   $excel->writeLine($myArr);

   $resultado = $conecta->selecionar($conecta->conn,"select * from tbnewsletter where situacao = '1' order by nome");
   if($resultado==true){
      while($linha = mysqli_fetch_array($resultado)){
         $myArr=array($linha['nome'],$linha['email'],substr($linha['data'],8,2).'/'.substr($linha['data'],5,2).'/'.substr($linha['data'],0,4));
         $excel->writeLine($myArr);
      }
   }
    $excel->close();

	echo "<META http-equiv=\"refresh\" content=\"0;URL=../documentos/listaemails.xls\" target=\"_blank\">";

} else if(isset($_POST['enviar']) && $_POST['enviar'] == "enviar"){

		$dados = $_POST['dados'];

		$assunto = $dados['tbnewsletter']['titulo'];
		$data = date('d/m/Y H:i');
		$para = $emailSite;

		$headers = "From: $nomeSite <$para>\n";
		$headers .= "Content-Type: text/html; charset=\"utf8\"\n\n";

		$sql_busca = "select email, nome from tbnewsletter where situacao = '1' order by nome";

		$resultado = $conecta->selecionar($conecta->conn,$sql_busca);

		$num = 0;
	    while($linha = mysqli_fetch_array($resultado)){
			$email = $linha['email'];
			$nome = $linha['nome'];


		$conteudo = "
			Prezado(a): $nome,
			<br />
			<br />
		";

		$conteudo_gravar = str_replace('../',$linkSite,$dados['tbnewsletter']['conteudo']);

		$conteudo .= $conteudo_gravar;

		$conteudo .= "

			<br />
			<br />
			<table width=\"500\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" >
				<tr>
					<td style=\"font:14px Georgia, Times, serif; color:#333;\">
					Este e-mail foi enviado pelo sistema de newsletter <strong>$nomeSite</strong><br />
					Se não deseja mais receber nossos e-mails de boletim
					<a href=\"".$linkSite."/remove.php?email=$email\" target=\"_blank\" >CLIQUE AQUI</a>
					<br />
					<br />
					Enviado em: $data
					</td>
				</tr>
			</table>

		";

		if($num == 0){
			$dados2['tbnewsletter_enviado']['assunto'] = $assunto;
			$dados2['tbnewsletter_enviado']['conteudo'] = $conteudo_gravar;
			$dados2['tbnewsletter_enviado']['data'] = date('Y-m-d');

			$id_grava = $conecta->inserirID($dados2);
		}



		$num++;

		//if(mail('marcone.lima@gmail.com', $assunto, $conteudo, $headers)){
		if(mail($email, $assunto, $conteudo, $headers)){
			$dados3['tbnewsletter_email']['email'] = $email;
			$dados3['tbnewsletter_email']['newsletter_id'] = $id_grava;

			$conecta->inserir($dados3);
		}

	}

	$_GET['vw'] = 4;
	echo '<div class="alert alert-warning">Foram enviado '.$num.' e-mails!</div>';

}if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar($conecta->conn,"SELECT t.* FROM tbnewsletter_enviado t WHERE t.id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$assunto = $rs['assunto'];
	$conteudo = $rs['conteudo'];

}

?>
<?php if(@$_GET['vw'] == 1) { ?>
<?php
		$sql = "SELECT * FROM tbnewsletter ORDER BY nome DESC";
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		?>
        <a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1&amp;excel=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-download-alt"></span> Exportar E-mails</button></a>
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
			  <th>Código</th>
              <th>Nome</th>
              <th>E-mail</th>
			  <th>Data</th>
              <th class="central">Situacao</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
          <?php while($rs = mysqli_fetch_array($resultado)){ ?>
            <tr>
				<td><?php echo $rs['id']; ?></td>
                <td><?php echo $rs['nome']; ?></td>
                <td><?php echo $rs['email']; ?></td>
				<td><?php echo substr($rs['data'],8,2)."/".substr($rs['data'],5,2)."/".substr($rs['data'],0,4); ?></td>
                <td align="center"><?php echo $rs['situacao'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;apagar=<?php echo $rs['email']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php } ?>
         </tbody>
        </table>
        </div><!--FIM TABLE RESPONSIVE-->
<?php } else if(@$_GET['vw'] == 2) {?>
	<form class="form-horizontal" role="form" name="formBanner" method="post" enctype="multipart/form-data" action="">

        <div class="form-group">
            <label for="assunto" class="col-sm-2 control-label">Assunto</label>
            <div class="col-sm-10">
              <input type="text" name="dados[tbnewsletter][titulo]"  value="<?php echo @$assunto; ?>" class="form-control" id="assunto" placeholder="Link">
            </div>
        </div>


        <div class="form-group">
            <label for="conteudo" class="col-sm-2 control-label">Conteúdo</label>
            <div class="col-sm-10">
        		<textarea rows="20" name="dados[tbnewsletter][conteudo]" class="form-control" placeholder="Conteúdo"><?php echo @$conteudo; ?></textarea>
        	</div>
        </div>

        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default btn_direita" name="enviar" id="enviar" value="enviar">Enviar</button>
        </div>
        </div>
    </form>



<?php } else { ?>
		 <a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=2"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-envelope"></span> Enviar newsletter</button></a>
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Título</th>
              <th>Enviado</th>
            </tr>
          </thead>
          <tbody>
        <?php
		$sql_enviado = "SELECT * FROM tbnewsletter_enviado";
		$resultado_enviado = $conecta->selecionar($conecta->conn,$sql_enviado);
        while($rs_enviado = mysqli_fetch_array($resultado_enviado)){
        $data_modificado = substr($rs_enviado['data'],8,2).".".substr($rs_enviado['data'],5,2).".".substr($rs_enviado['data'],0,4);
        ?>
        <tr>
            <td><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela; ?>&amp;vw=2&amp;alterar=<?php echo $rs_enviado['id']?>"><?php echo $rs_enviado['assunto']; ?></a></td>
            <td><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela; ?>&amp;vw=2&amp;alterar=<?php echo $rs_enviado['id']?>"><?php echo $data_modificado; ?></a></td>
        </tr>
        <?php } ?>
    </table>
   </div><!--FIM TABLE RESPONSIVE-->
<?php  } ?>
