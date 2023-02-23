<?php
ob_start();

$conecta = new Recordset;
$conecta->conexao();

	
	

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	$dados = $_POST["dados"];
	$permissao = $_POST["permissao"];
	$num = $_POST['j'];
	
	$arrCampos = array_keys($permissao);
	$numCampos = count($arrCampos);	
				
	$id = $dados['tbpermissao']['perfil_id'];
		
	$dados['tbpermissao']['status'] =  1;
	$sql_delete = "delete from tbpermissao where perfil_id = $id";
	
	
	$conecta->selecionar($sql_delete);
	$j = 0;
	while($j<$num){
		if($permissao[$j] != ''){
			$dados['tbpermissao']['tela_id'] = $permissao[$j];
			$resultado = $conecta->inserir($dados);
		}
		$j++;
	}
	
	if($resultado){
		echo '<span class="retorno">Permissões salvas com sucesso!</span>';
	}
	
	//header("Location: home.php?pagina=perfil");
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php?pagina=perfil\">\n";
	
	$sql_perfil = "SELECT * FROM tbperfil WHERE id = $id";
	$resultado_perfil = $conecta->selecionar($sql_perfil);
	$rs_perfil = mysql_fetch_array($resultado_perfil);
	
} else {
	$id = $_GET['id'];
	$sql_perfil = "SELECT * FROM tbperfil WHERE id = $id";
	$resultado_perfil = $conecta->selecionar($sql_perfil);
	$rs_perfil = mysql_fetch_array($resultado_perfil);
}
?>
<div id="conteudodireita">
	<div id="formulario">
	<form name="formPermissao" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[tbpermissao][perfil_id]" value="<?php echo $id; ?>" />
    	<fieldset>
        	<legend>Permissões para o perfil</legend>
            <label>
            <span style="width:100px; text-align:right; font-family:Calibri, Verdana, Geneva, sans-serif; font-size:15px; font-weight:bold; color:#000; background:#999;">Perfil:</span>
            <span style="width:300px; text-align:left; font-family:Calibri, Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold; color:#000; background:#eaeaea;"><?php echo $rs_perfil['nome']; ?></span>
            </label>
            <label>
            <?php
			$sql_permissao = "SELECT tela_id FROM tbpermissao WHERE perfil_id = $id";
								
			$sql = "SELECT t.id, g.nome as grupo, t.nome FROM tbtela t, tbgrupo g WHERE g.id = t.grupo_id ORDER BY grupo, nome ASC";
			$resultado = $conecta->selecionar($sql);
			$i = 0;
			$j = 0;
			while($rs = mysql_fetch_array($resultado)){
				$resultado_permissao = $conecta->selecionar($sql_permissao);
				$ok = 0;
				while($rs_permissao = mysql_fetch_array($resultado_permissao)){
					if($rs['id'] == $rs_permissao['tela_id']){
						$ok = 1;
					}
				}
				$j++;
			?>
            <span class="titulo_texto"><input type="checkbox" name="permissao[<?php echo $i; ?>]"$ <?php if($ok == "1") { echo "checked"; } ?> value="<?php echo $rs['id']; ?>" /><?php echo $rs['grupo']."->".$rs['nome']; ?></span>
            <?php
			$i++;
			}
			?>
            </label>
            <br/>
            <input type="hidden" name="j" value="<?php echo $j; ?>" />
            <input class="botao_form" type="submit" name="gravar" value="Gravar" id="gravar" />
        </fieldset>
	</form>
    </div>
</div><!--conteudodireita-->
<?php ob_flush(); ?>