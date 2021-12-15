<?php ob_start();
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	$dados = $_POST["dados"];
	$permissao = $_POST["permissao"];
	$num = $_POST['j'];
	
	$arrCampos = array_keys($permissao);
	$numCampos = count($arrCampos);	
				
	$id = $dados['tbpermissao']['perfil_id'];
		
	$dados['tbpermissao']['status'] =  1;
	$sql_delete = "delete from tbpermissao where perfil_id = $id";
	
	
	$conecta->selecionar($conecta->conn,$sql_delete);
	$j = 0;
	while($j<$num){
		if(@$permissao[$j] != ''){
			$dados['tbpermissao']['tela_id'] = $permissao[$j];
			$resultado = $conecta->inserir($dados);
		}
		$j++;
	}
	
	if($resultado){
		echo '<div class="alert alert-success">Permissões salvas com sucesso!</div>';
	}
	
	//header("Location: home.php?pagina=perfil");
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=home.php?pagina=perfil&amp;tela=6\">\n";
	
	$sql_perfil = "SELECT * FROM tbperfil WHERE id = $id";
	$resultado_perfil = $conecta->selecionar($conecta->conn,$sql_perfil);
	$rs_perfil = mysqli_fetch_array($resultado_perfil);
	
} else {
	$id = $_GET['id'];
	$sql_perfil = "SELECT * FROM tbperfil WHERE id = $id";
	$resultado_perfil = $conecta->selecionar($conecta->conn,$sql_perfil);
	$rs_perfil = mysqli_fetch_array($resultado_perfil);
}

?>

	<form class="form-horizontal" role="form" name="formBanner" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[tbpermissao][perfil_id]" value="<?php echo $id; ?>" />
        
        <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Pefil</label>
            <div class="col-sm-10">
              <span class="input-group"><?php echo $rs_perfil['nome']; ?></span>
            </div>
        </div>
       	
        <div class="form-group">
        	<label for="radio" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <div class="input-group">
              	  <?php
					$sql_permissao = "SELECT tela_id FROM tbpermissao WHERE perfil_id = $id";
										
					$sql = "SELECT t.id, g.nome as grupo, t.nome FROM tbtela t, tbgrupo g WHERE g.id = t.grupo_id AND t.status = 1 ORDER BY grupo, nome ASC";
					$resultado = $conecta->selecionar($conecta->conn,$sql);
					$i = 0;
					$j = 0;
					while($rs = mysqli_fetch_array($resultado)){ 
						$resultado_permissao = $conecta->selecionar($conecta->conn,$sql_permissao);
						$ok = 0;
						while($rs_permissao = mysqli_fetch_array($resultado_permissao)){
							if($rs['id'] == $rs_permissao['tela_id']){
								$ok = 1;
							}
						}
						$j++;
					?>
                    <div class="checkbox">
                    	<label>
                    		<input type="checkbox" name="permissao[<?php echo $i; ?>]"$ <?php if($ok == "1") { echo "checked"; } ?> value="<?php echo $rs['id']; ?>" /><?php echo $rs['grupo']."->".$rs['nome']; ?>
                    	</label>
                   </div>
                   <?php $i++; } ?>
               </div>
              
            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="hidden" name="j" value="<?php echo $j; ?>" />	
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>
    </form>


<?php ob_flush(); ?>