<?php
$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$nome =    	strip_tags(trim($dados['tbusuario']['nome']));
	$login2 =    	strip_tags(trim($dados['tbusuario']['login']));
	$email =    	strip_tags(trim($dados['tbusuario']['email']));
	$data = 		strip_tags(trim($dados['tbusuario']['data']));
	$perfil2 = strip_tags(trim($dados['tbusuario']['perfil_id']));
	
	$senha = strip_tags(trim($dados['tbusuario']['senha']));
	$confirma_senha = strip_tags(trim($_POST['confirma']));
				
	if(empty($nome)) {
		$retorno = '<span class="retorno">Informe o nome!</span>';
	}elseif (empty($login2)) {
		$retorno = '<span class="retorno">Digite o login!</span>';
	} elseif (empty($email)) {
		echo "<span class='retorno'>Informe seu email</span><br/>";
	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<span class='retorno'>Informe um email válido</span><br/>";
	} elseif(empty($senha)){
		$retorno = '<span class="retorno">Digite a senha!</span>';
	} elseif(empty($confirma_senha)){
		$retorno = '<span class="retorno">Digite a confirmação da senha!</span>';
	} elseif($senha != $confirma_senha){
		$retorno = '<span class="retorno">A confirmação da senha não confere!</span>';
	} 
	
	if (empty($retorno)) {
		
		
		
		
		$resultado = $conecta->inserir($dados);
		if (!$resultado){
			echo "<span class='retorno'>Erro ao cadastrar, favor tentar novamente</span>";
		 }else{
			echo "<span class='retorno'>Cadastro com sucesso!</span>";
		 	 
		 }
		$_GET['vw'] = 0;
		echo '<span class="retorno">'.$resultado.'</span>';	
	} else {
		echo $retorno;
	}		
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($_POST['id']));
	$nome =    	strip_tags(trim($dados['tbusuario']['nome']));
	$login2 =    	strip_tags(trim($dados['tbusuario']['login']));
	$email =    	strip_tags(trim($dados['tbusuario']['email']));
	$data = 		strip_tags(trim($dados['tbusuario']['data']));
	
	$senha = strip_tags(trim($dados['tbusuario']['senha']));
	$confirma_senha = strip_tags(trim($_POST['confirma']));
	
	$perfil2 = strip_tags(trim($dados['tbusuario']['perfil_id']));
	$string = " id = $id";
		
	if(empty($nome)) {
		$retorno = '<span class="retorno">Informe o nome!</span>';
	}elseif (empty($login2)) {
		$retorno = '<span class="retorno">Digite o Login!</span>';
	} elseif (empty($email)) {
		echo "<span class='retorno'>Informe seu email</span><br/>";
	 } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<span class='retorno'>Informe um email válido</span><br/>";
	 } elseif(empty($senha)){
		$retorno = '<span class="retorno">Digite a senha!</span>';
	} elseif(empty($confirma_senha)){
		$retorno = '<span class="retorno">Digite a confirmação da senha!</span>';
	} elseif($senha != $confirma_senha){
		$retorno = '<span class="retorno">A confirmação da senha não confere!</span>';
	} 
	
	if (empty($retorno)) {
		$resultado = $conecta->alterar($dados, $string);
		$retorno = "Usuário alterado com sucesso.";
		$_GET['vw'] = 0;
		echo '<span id="retorno">'.$retorno.'</span>';
	} else {
		echo '<span id="retorno">'.$retorno.'</span>';
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];
	$resultado = $conecta->selecionar("DELETE FROM tbusuario WHERE id = $id");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Dados excluídos com sucesso!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Não foi possível excluir os dados!</span>";
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar("SELECT * FROM tbusuario WHERE id = $id");
	$rs = mysql_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['nome'];
	$perfil2 = $rs['perfil_id'];
	$senha = $rs['senha'];
	$email = $rs['email'];
	$login2 = $rs['login'];
	$nome = $rs['nome'];
	$ativo = $rs['ativo'];
}  

?>
<div id="conteudodireita">
	<?php if($_GET['vw'] == 1) {?>
    <div id="formulario">
	<form name="formLink" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="dados[tbusuario][datacadastro]" value="<?php echo date("Y-m-d"); ?>" />
    	<fieldset>
        	<legend>Cadastro de Usuários</legend>
            <label>
            <span class="titulo_form">Nome:</span>
            <input class="input_painel" type="text" name="dados[tbusuario][nome]" value="<?php echo $nome; ?>" />
            </label>
            <label>
            <span class="titulo_form">Login:</span>
            <input class="input_painel" type="text" name="dados[tbusuario][login]" value="<?php echo $login2; ?>" />           
            </label>
            <label>
            <span class="titulo_form">E-mail:</span>
            <input class="input_painel" type="text" name="dados[tbusuario][email]" value="<?php echo $email; ?>" />           
            </label>
            <label>
            <span class="titulo_form">Senha:</span>
            <input class="input_painel" type="text" name="dados[tbusuario][senha]" value="<?php echo $senha; ?>" />           
            </label>
            <label>
            <span class="titulo_form">Confirmação Senha:</span>
            <input class="input_painel" type="text" name="confirma" />           
            </label>
            <label>
            <span class="titulo_form">Perfil:</span>
            <select class="input_painel" name="dados[tbusuario][perfil_id]" >
            	<option value="">Selecione...</option>
            	<?php
				$resultado_perfil = $conecta->selecionar("SELECT * FROM tbperfil order by nome asc");
				while ($rs_perfil = mysql_fetch_array($resultado_perfil)){
                ?>
            	<option value="<?php echo $rs_perfil['id']; ?>" <?php if($rs_perfil['id'] == $perfil2) { echo "selected";} ?> ><?php echo $rs_perfil['nome']; ?></option>
                <?php
				}
				?>
            </select>
            </label>
            <label>
            <span>Ativo:</span>
            <input  type="radio" value="1" name="dados[tbusuario][ativo]" <?php if($ativo == '1') { echo "checked"; }?>/>&nbsp;Sim&nbsp;&nbsp;&nbsp;
            <input  type="radio" value="0" name="dados[tbusuario][ativo]" <?php if($ativo == '0' || $ativo == '') { echo "checked"; }?>/>&nbsp;Não
            </label>
            <br/>
            <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </fieldset>
	</form>
    </div>
    <?php } else {?>
    	<?php
		$sql = "SELECT u.* FROM tbusuario u, tbperfil p WHERE p.id = u.perfil_id ";
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" cellspacing="3" width="100%">
        	<span class="legend">Usuários</span>
            <tr>
                <td colspan="5" align="right"><span class="link_interno"><a href="home.php?pagina=usuario&amp;vw=1&amp;p=<?php echo $p;?>" ><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Usuário</a></span></td>
            </tr>
            <tr>
                <td width="20%" class="titulo_grid">Nome</td>
                <td width="20%" class="titulo_grid">Login</td>
                <td width="30%" class="titulo_grid">E-mail</td>
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
                <td class="dados_grid"><?php echo $rs['login']; ?></td>
                <td class="dados_grid"><?php echo $rs['email']; ?></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=usuario&amp;vw=1&amp;alterar=<?php echo$rs['id']?>&amp;p=<?php echo $p;?>" ><img src="../images/editar.png" width="16" height="16" border="0" /></a></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=usuario&amp;apagar=<?php echo$rs['id']?>&amp;p=<?php echo $p;?>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php } ?>
    	
</div><!--conteudodireita-->