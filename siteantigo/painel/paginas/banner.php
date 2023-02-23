<?php
$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$link =    	strip_tags(trim($dados['tbbanner']['link']));
	$posicao =  	strip_tags(trim($dados['tbbanner']['posicao']));
	$tipo =  	strip_tags(trim($dados['tbbanner']['tipo']));
	$situacao = 	strip_tags(trim($dados['tbbanner']['situacao']));
	$data = 		strip_tags(trim($dados['tbbanner']['data']));
			
	if($_FILES['arquivo']['name'] == "") {
		$retorno = '<span class="retorno">Selecione o arquivo!</span>';
	}
	
	if (empty($retorno)) {
		//CONFIGURAÇÃO UPLOAD
		$pasta = "../imagens";
		$permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');
		
		$name = $_FILES['arquivo']['name'];
		$tmp = $_FILES['arquivo']['tmp_name'];
		$type = $_FILES['arquivo']['type'];
		
		require('../uteis/upload_func.php');
		
		if($tipo = 'imagem'){
				$extensao = strtolower(end(explode('.',$name)));
				$nome = 'banner-'.md5(uniqid(rand(), true)).'.'.$extensao;
				$uploadfile = $pasta."/".$nome;
				if(move_uploaded_file($tmp,$uploadfile)){
					$resultadoUpload = '<span class="retorno">Banner Carregado com sucesso!</span>';
					$ok = 1;
				} else{
					$resultadoUpload = '<span class="retorno">Não foi possível enviar o banner!</span>';
				}
			
		} elseif($tipo = 'flash'){
			$nome = 'banner-'.md5(uniqid(rand(), true)).'.swf';
			$uploadfile = $pasta."/".$nome;
			if(move_uploaded_file($tmp,$uploadfile)){
				$resultadoUpload = '<span class="retorno">Banner Carregada com sucesso!</span>';
				$ok = 1;
			} else{
				$resultadoUpload = '<span class="retorno">Não foi possível enviar a banner flash!</span>';
			}
		}
		$dados['tbbanner']['arquivo'] = $nome;
		if($ok == 1){
			$resultado = $conecta->inserir($dados);
		}
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.'<br/>'.$resultadoUpload.'</span>';	
	} else {
		echo $retorno;
	}		
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($_POST['id']));
	$link =    	strip_tags(trim($dados['tbbanner']['link']));
	$posicao =  	strip_tags(trim($dados['tbbanner']['posicao']));
	$tipo =  	strip_tags(trim($dados['tbbanner']['tipo']));
	$situacao = 	strip_tags(trim($dados['tbimagem']['situacao']));
	$data = 		strip_tags(trim($dados['tbbanner']['data']));
	
	$string = " id = $id";
	
	if (empty($retorno)) {
		//CONFIGURAÇÃO UPLOAD
		$pasta = "../imagens";
		$permitido = array('image/jpg', 'image/jpeg', 'image/pjpeg');
		$name = $_FILES['arquivo']['name'];
		$tmp = $_FILES['arquivo']['tmp_name'];
		$type = $_FILES['arquivo']['type'];
		
				
		if(!empty($name)){
			$nome = strip_tags(trim($dados['tbbanner']['arquivo']));
			$uploadfile = $pasta."/".$nome;
			if(move_uploaded_file($tmp,$uploadfile)){
				$resultadoUpload = '<span class="retorno">Imagem Carregada com sucesso!</span>';
				$ok = 1;
			} else{
				$resultadoUpload = '<span class="retorno">Não foi possível enviar a Imagem!</span>';
			}
			$dados['tbbanner']['arquivo'] = $nome;
		}
	
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo '<span id="retorno">'.$resultado.'</span>';
	}
	
	
	
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$pasta = "../imagens/";
	$id = $_GET['apagar'];
	$resultado = $conecta->selecionar("SELECT arquivo FROM tbbanner WHERE id = $id");
	$rs = mysql_fetch_array($resultado);
	$nome = $rs['arquivo'];
	if($nome != '') {
		unlink($pasta.'/'.$nome);
	}
	$resultado = $conecta->selecionar("DELETE FROM tbbanner WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
}  else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar("SELECT * FROM tbbanner WHERE id = $id");
	$rs = mysql_fetch_array($resultado);
	
	$id = $rs['id'];
	$link = $rs['link'];
	$arquivo = $rs['arquivo'];
	$posicao = $rs['posicao'];
	$situacao = $rs['situacao'];
	$tipo = $rs['tipo'];

}  

?>
<div id="conteudodireita">
	<?php if($_GET['vw'] == 1) {?>
    <div id="formulario">
	<form name="formBanner" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="dados[tbbanner][data]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[tbbanner][arquivo]" value="<?php echo $arquivo; ?>" />
    	<fieldset>
        	<legend>Cadastro de Banners</legend>
            <label>
            <span class="titulo_form">Imagem:</span>
            <input class="input_painel" type="file" name="arquivo" value="" />
            <br/><span class="aviso">A Imagem Banner Topo deve ter 600px de largura por 252px de altura.</span>
            <br/><span class="aviso">A Imagem Patrocínio Lateral deve ter no máximo 160px de largura por 160px de altura.</span>
            <br/><span class="aviso">A Imagem Banner Inferior deve ter no máximo 800px de largura por 180px de altura.</span>
            <?php if($arquivo != '') {?>
            <img src="../imagens/<?php echo $arquivo; ?>" width="600"  />
            <?php } ?>
            </label>
            <label>
            <span class="titulo_form">Link:</span>
            <input class="input_painel" type="text" name="dados[tbbanner][link]" value="<?php echo $link; ?>" />
            </label>
            <label>
            <span class="titulo_form">Posição:</span>
            <select class="input_painel" name="dados[tbbanner][posicao]"> 
            	<option value="" >Selecione..</option>
            	<option value="0" <?php if(0 == $posicao) { echo "selected";} ?>><?php echo $posicaoBanner[0]; ?></option>
                <option value="1" <?php if(1 == $posicao) { echo "selected";} ?>><?php echo $posicaoBanner[1]; ?></option>
                <option value="2" <?php if(2 == $posicao) { echo "selected";} ?>><?php echo $posicaoBanner[2]; ?></option>
             </select>
            </label>
            <label>
            <span class="titulo_form">Tipo:</span>
            <select class="input_painel" name="dados[tbbanner][tipo]"> 
            	<option value="" >Selecione..</option>
                <option value="imagem" <?php if('imagem' == $tipo) { echo "selected";} ?>>Imagem</option>
             </select>
            </label>
            <label>
            <span class="titulo_form">Ativo:</span>
            <input type="radio" name="dados[tbbanner][situacao]" <?php if($situacao == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($situacao == 0 ) { echo "checked"; } ?> name="dados[tbbanner][situacao]" value="0" /><span class="dados_grid">Não</span>
            </label>
            <label>
            
            <br/>
            <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </fieldset>
	</form>
    </div>
    <?php } else {?>
    	<?php
		$sql = "SELECT * FROM tbbanner";
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" cellspacing="3" width="100%">
        	<span class="legend">Banners</span>
            <tr>
                <td colspan="6" align="right"><span class="link_interno"><a href="home.php?pagina=banner&amp;vw=1&amp;p=<?php echo $p;?>" ><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Banner</a></span></td>
            </tr>
            <tr>
                <td width="10%" class="titulo_grid">Banner</td>
                <td width="40%" class="titulo_grid">Link</td>
                <td width="15%" class="titulo_grid">Posição</td>
                <td width="15%" class="titulo_grid">Situacao</td>
                <td width="10%" class="titulo_grid">Alterar</td>
                <td width="10%" class="titulo_grid">Excluir</td>
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
                <td class="dados_grid">
                <?php if($rs['tipo'] == 'imagem') { ?>
                <img src="../imagens/<?php echo $rs['arquivo']; ?>" width="50" alt="" />
                <?php } else { ?>
                <img src="../images/flash.png" width="32" height="32" border="0" alt="" />
                <?php } ?>
                </td>
                <td class="dados_grid"><?php echo $rs['link']; ?></td>
                <td class="dados_grid"><?php echo $posicaoBanner[$rs['posicao']]; ?></td>
                <td class="dados_grid"><?php echo $rs['situacao'] == 1 ? 'Ativa' : 'Inativa'; ?></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=banner&amp;vw=1&amp;alterar=<?php echo$rs['id']?>&amp;p=<?php echo $p;?>" ><img src="../images/editar.png" width="16" height="16" border="0" /></a></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=banner&amp;apagar=<?php echo$rs['id']?>&amp;p=<?php echo $p;?>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php } ?>
  
</div><!--conteudodireita-->