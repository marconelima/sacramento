<?php
if(isset($_POST['alterar']) && $_POST['alterar'] == "Salvar"){
	
	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados['tbusuario']['id']));
	
	$senha = strip_tags(trim($dados['tbusuario']['senha']));
	$confirma_senha = strip_tags(trim($_POST['confirma']));
	
	$string = " id = $id";
		
	if(empty($senha)){
		$retorno = '<span class="retorno">Digite a senha!</span>';
	} elseif(empty($confirma_senha)){
		$retorno = '<div class="alert alert-danger">Digite a confirmação da senha!</div>';
	} elseif($senha != $confirma_senha){
		$retorno = '<div class="alert alert-danger">A confirmação da senha não confere!</div>';
	} 
	
	if (empty($retorno)) {
		
		$dados['tbusuario']['senha'] = md5($dados['tbusuario']['senha']);
		
		$resultado = $conecta->alterar($dados, $string);
		$retorno = "Senha alterada com sucesso.";
		$_GET['vw'] = 0;
		echo '<div class="alert alert-success">'.$retorno.'</div>';
	} else {
		echo '<div class="alert alert-danger">'.$retorno.'</div>';
	}
	echo '<meta http-equiv="refresh" content="3; url=home.php?pagina=principal">';
} 
?>

        <form class="form-horizontal" role="form" name="formLink" method="post" enctype="multipart/form-data" action="" >    
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Usuários:</label>
                <div class="col-sm-10">
                <select class="form-control" name="dados[tbusuario][id]" >
                    <option value="">Selecione...</option>
                    <?php
                    if($_SESSION['perfil'] == 1){
                        $resultado_usu = $conecta->selecionar($conecta->conn,"SELECT id, nome FROM tbusuario order by nome asc");
                    } else {
                        $resultado_usu = $conecta->selecionar($conecta->conn,"SELECT id, nome FROM tbusuario WHERE id = ".$_SESSION['usuario']." order by nome asc");
                    }
                    while ($rs_usu = mysqli_fetch_array($resultado_usu)){
                        if($_SESSION['perfil'] == 1){
                    ?>
                        <option value="<?php echo $rs_usu['id']; ?>" ><?php echo $rs_usu['nome']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $rs_usu['id']; ?>" <?php if($rs_usu['id'] == $_SESSION['usuario']) { echo "selected";} ?> ><?php echo $rs_usu['nome']; ?></option>
                    <?php
                    }
                    }
                    ?>
                </select>
                </div>
            </div>
           
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Nova Senha:</label>
                <div class="col-sm-10">
                <input class="form-control" type="password" name="dados[tbusuario][senha]" value="" />           
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Confirmação Nova Senha:</label>
                <div class="col-sm-10">
            	<input class="form-control" type="password" name="confirma" />           
                </div>
            </div>
            
           <div class="form-group">
        		<div class="col-sm-offset-2 col-sm-10">
            <input  class="btn btn-default btn_direita" type="submit" name="alterar" id="alterar" value="Salvar" />
            	</div>
           </div>
        
	</form>