<?php
$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	
	$id = $_GET['apagar'];
	
	$resultado = $conecta->selecionar("DELETE FROM tbnewsletter WHERE email = '$id'");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
	$_GET[vw] = 1;
} elseif(isset($_GET['excel']) && $_GET['excel'] == '1'){

	//Incluir a classe excelwriter
   include("../uteis/excelwriter.php");

   //Você pode colocar aqui o nome do arquivo que você deseja salvar.
    $excel=new ExcelWriter("../documentos/listaemails.xls");

    if($excel==false){
        echo $excel->error;
   }

   //Escreve o nome dos campos de uma tabela
   $myArr=array('NOME','EMAIL');
   $excel->writeLine($myArr);

   $resultado = $conecta->selecionar("select * from tbnewsletter where situacao = '1' order by nome");
   if($resultado==true){
      while($linha = mysql_fetch_array($resultado)){
         $myArr=array($linha['nome'],$linha['email']);
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
		
		$headers = "From: $para\n";
		$headers .= "Content-Type: text/html; charset=\"utf8\"\n\n";
		
		$resultado = $conecta->selecionar("select email, nome from tbnewsletter where situacao = '1' order by nome");
		
		$num = 0;		
	    while($linha = mysql_fetch_array($resultado)){
			$email = $linha['email'];
			$nome = $linha['nome'];
			$num++;
		
		$conteudo = "
			Prezado(a): $nome,
			<br />
			<br />		
		";
		
		$conteudo .= str_replace('../','http://www.cpn.org.br/',str_replace('\"','"',$dados['tbnewsletter']['conteudo']));
		
		
		$conteudo .= "
		
			<br />
			<br />
			<table width=\"500\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" >
				<tr>
					<td style=\"font:14px Georgia, Times, serif; color:#333;\">
					Este e-mail foi enviado pelo sistema de newsletter <strong>$nomeSite</strong><br />
					Se não deseja mais receber nossos e-mails de boletim 
					<a href=\"$linksite/remove.php?email=$email\" target=\"_blank\" >CLIQUE AQUI</a>
					<br />
					<br />
					Enviado em: $data
					</td>
				</tr>
			</table>
			
		";
		
		//print_r($conteudo);
				
		mail($email, $assunto, $conteudo, $headers);
		
	}
	//print_r(str_replace('../','http://www.cpn.org.br/',$dados['tbnewsletter']['conteudo']));
	$_GET['vw'] = 1;
	echo '<span class="retorno">Foram enviado '.$num.' e-mails!</span>';
		 
}

?>
<div id="conteudodireita">
	<?php if($_GET[vw] == 1) {?>
    	<?php
		$sql = "SELECT * FROM tbnewsletter";
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" border="0" cellspacing="3" width="100%">
        	<span class="legend">Newsletters</span>
            <tr>
                <td colspan="4" align="right"><span class="link_interno"><a href='home.php?pagina=newsletter&amp;vw=1&amp;excel=1' ><img src="../images/excel.png" width="16" height="16" border="0"  /> Exportar E-mails</a></span></td>
            </tr>
            <tr>
                <td width="35%" class="titulo_grid">Nome</td>
                <td width="35%" class="titulo_grid">E-mail</td>
                <td width="15%" class="titulo_grid">Situação</td>
                <td width="15%%" class="titulo_grid">Excluir</td>
            </tr>
            <?php 
			$cor = '#EFEFEF';
			while($rs = mysql_fetch_array($resultado)){ 
			if($cor == '#EFEFEF'){
				$cor = '#DEDEDE';
			}else{
				$cor = '#EFEFEF';
			}
			?>
            <tr bgcolor="<?php echo $cor;?>">
                <td class="dados_grid"><?php echo $rs['nome']; ?></td>
                <td class="dados_grid"><?php echo $rs['email']; ?></td>
                <td class="dados_grid"><?php echo $rs['situacao'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=newsletter&amp;apagar=<?php echo$rs['email']?>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php } else if($_GET[vw] == 2) {?>
    <div id="formulario">
	<form name="formNewsletter" method="post" enctype="multipart/form-data" action="">
    	<fieldset>
        	<legend>Envio de Newsletters</legend>
            <label>
            <span class="titulo_form">Assunto:</span>
            <input class="input_painel" type="text" name="dados[tbnewsletter][titulo]"  value="<?php echo $titulo; ?>" />
            </label>
            <label>
            <span class="titulo_form">Conteúdo:</span>
            
            <textarea class="input_painel" rows="20" name="dados[tbnewsletter][conteudo]" ><?php echo $conteudo; ?></textarea>
            
            </label>
            <br/>
            <input class="botao_form" type="submit" name="enviar" id="enviar" value="enviar"  />
        </fieldset>
	</form>
    </div>
    <?php } ?>
    	
    
</div><!--conteudodireita-->