<?php
$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }
print_r("<br>");

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$nome =    	strip_tags(trim($dados['tbperfil']['nome']));
	
	$data = 		strip_tags(trim($dados['tbperfil']['data']));
			
	if(empty($nome)) {
		$retorno = '<span class="retorno">Informe o Nome!</span>';
	}
	
	if (empty($retorno)) {
		$resultado = $conecta->inserir($dados);
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.'</span>';	
	} else {
		echo $retorno;
	}		
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($_POST['id']));
	$nome =    	strip_tags(trim($dados['tbperfil']['nome']));
	$data = 		strip_tags(trim($dados['tbperfil']['data']));
	$string = " id = $id";
		
	if(empty($nome)) {
		$retorno = '<span class="retorno">Informe o Nome!</span>';
	}
	if (empty($retorno)) {
		
		$resultado = $conecta->alterar($dados, $string);
		$_GET['vw'] = 0;
		echo '<span id="retorno">'.$resultado.'</span>';
	}else {
		echo $retorno;
	}	
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	
	$id = $_GET['apagar'];
	
	$resultado = $conecta->selecionar("DELETE FROM tbperfil WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar("SELECT * FROM tbperfil WHERE id = $id");
	$rs = mysql_fetch_array($resultado);
	$id = $rs['id'];
	$nome = $rs['nome'];
	
	$status = $rs['status'];
}  

?>
<div id="conteudodireita">
	<?php if($_GET[vw] == 1) {?>
    <div id="formulario">
	<form name="formperfil" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="dados[tbperfil][data]" value="<?php echo date("Y-m-d"); ?>" />
    	<fieldset>
        	<legend>Cadastro de perfil </legend>
            <label>
            <span class="titulo_form">Nome:</span>
            <input class="input_painel" type="text" name="dados[tbperfil][nome]" value="<?php echo $nome; ?>" />
            </label>
            
            <label>
            <span class="titulo_form">Ativo</span>
            <input type="radio" name="dados[tbperfil][status]" <?php if($status == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($status == 0 ) { echo "checked"; } ?> name="dados[tbperfil][status]" value="0" /><span class="dados_grid">Não</span>
            </label>
            
            <br/>
            <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </fieldset>
	</form>
    </div>
    <?php } else {?>
    	<?php
		
		$sql = "SELECT * FROM tbperfil WHERE nome not in ('Administrador')";
		
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" cellspacing="3" width="100%">
        	<span class="legend">Perfis</span>
            <tr>
                <td colspan="5" align="right"><span class="link_interno"><a href="home.php?pagina=perfil&amp;vw=1>" ><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Perfil</a></span></td>
            </tr>
            <tr>
                <td width="40%" class="titulo_grid">Nome</td>
                <td width="15%" class="titulo_grid">Situação</td>
                <td width="15%" class="titulo_grid" nowrap="nowrap">Dar Permissões</td>
                <td width="15%" class="titulo_grid">Alterar</td>
                <td width="15%" class="titulo_grid">Excluir</td>
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
                <td class="dados_grid" align="center"><?php if ($rs['status'] == '1') { echo "Ativo"; } else {echo "Inativo"; } ?></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=permissao&amp;id=<?php echo $rs['id']; ?>"><img src="../images/salvarimagem.png" border="0" width="16" alt=""  /></a></td>
                <td class="dados_grid" align="center"><?php if($rs['nome'] == 'Ministério' || $rs['nome'] == 'Escola Dominical' || $rs['nome'] == 'Congregação' || $rs['nome'] == 'Cursos' || $rs['nome'] == 'Grupo de Estudos' || $rs['nome'] == 'Colunistas') { echo "&nbsp;"; } else { ?><a href="home.php?pagina=perfil&amp;vw=1&amp;alterar=<?php echo$rs['id']?>>" ><img src="../images/editar.png" width="16" height="16" border="0" /></a><?php } ?></td>
                <td class="dados_grid" align="center"><?php if($rs['nome'] == 'Ministério' || $rs['nome'] == 'Escola Dominical' || $rs['nome'] == 'Congregação' || $rs['nome'] == 'Cursos' || $rs['nome'] == 'Grupo de Estudos' || $rs['nome'] == 'Colunistas') { echo "&nbsp;"; } else { ?><a href="home.php?pagina=perfil&amp;apagar=<?php echo$rs['id']?>>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a><?php } ?></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php } ?>
    
</div><!--conteudodireita-->