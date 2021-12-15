<script type="text/javascript">
 function AddCampo(id){
 el = document.getElementById(id);
 el.innerHTML += '<div class="form-group"><label class="col-sm-2 control-label">Resposta</label><div class="col-sm-10"><input type="text" name="resposta[]" class="form-control" /></div></div>';
 }
</script>

<?php if(isset($_POST['cadastra_pergunta']) && $_POST['cadastra_pergunta'] == 'ok'){
 
 $pergunta = $_POST['pergunta'];
 
 if(empty($pergunta)){
 $retorno = '<div class="alert alert-danger">Você precisa digitar a pergunta!</div>';
 }if(empty($retorno)){
 
 $data = date('Y-m-d H:i:s');
 
 $sql = "INSERT INTO questions (ques, created_on, tela_id) VALUES ('$pergunta', '$data', ".$_GET['tela'].")";
 $cadastrar_pergunta = $conecta->selecionar($conecta->conn,$sql);
 
 if($cadastrar_pergunta == '1'){
 echo '<div class="alert alert-success">A pergunta <strong>'.$pergunta.'</strong>, foi cadastrada com sucesco!</div>';
 }else{
 echo '<div class="alert alert-danger">Erro ao cadastrar a pergunta, tente novamente!</div>';
 }
 
 }
}
?>
 
<?php if(isset($_POST['cadastra_resposta']) && $_POST['cadastra_resposta'] == 'ok'){
 
 $id_resposta = $_POST['id_resposta'];
 $resposta = $_POST['resposta'];
 
 if($id_resposta == '-1'){
 $retorno = '<div class="alert alert-danger">Selecione uma das enquetes</div>';
 }else{
 
 $contar = count($resposta);
 for($i = 0; $i < $contar; $i++){
 
 if(empty($resposta[$i])){
 $retorno = '<div class="alert alert-danger">Existe uma resposta em branco, <strong>a mesma não foi cadastrada!</strong></div>';
 }if(empty($retorno)){
 
 $sql = "INSERT INTO options (ques_id, value) VALUES ('$id_resposta', '$resposta[$i]')";
 $cadastrar_resposta = $conecta->selecionar($conecta->conn,$sql);
 
 if($cadastrar_resposta == '1'){
 echo '<div class="alert alert-success">A resposta <strong>'.$resposta[$i].'</strong>, foi cadastrada com sucesco!</div>';
 }else{
 echo '<div class="alert alert-danger">Erro ao cadastrar a resposta, tente novamente!</div>';
 }
 }
 }
 }
}
?>
 
<?php if(isset($_POST['excluir_enquete']) && $_POST['excluir_enquete'] == 'ok'){
 
 $enquete = $_POST['id_enquete'];
 
 $sql = "SELECT id FROM options WHERE ques_id = '$enquete'";
 $pega_option = $conecta->selecionar($conecta->conn,$sql);
 
 while($option=mysqli_fetch_array($pega_option)){
 
 $id_option = $option[0];
 
 $sql = "DELETE FROM votes WHERE option_id = '$id_option'";
 $deleta = $conecta->selecionar($conecta->conn,$sql);
 
 $sql = "DELETE FROM options WHERE ques_id = '$enquete'";
 $deleta .= $conecta->selecionar($conecta->conn,$sql);
 }
 $sql = "DELETE FROM questions WHERE id = '$enquete'";
 $del_enquete = $conecta->selecionar($conecta->conn,$sql);
 
 if($del_enquete >= '1'){
 echo '<div class="alert alert-success">Enquete totalmente excluida do sistema</div>';
 }else{
 echo '<div class="alert alert-danger">Erro ao excluir enquete!</div>';
 }
 
}
?>
 
<?php
if(isset($retorno)){
 echo $retorno;
}
?>


<div class="panel panel-default">
  <div class="panel-heading">Cadastrar Pergunta</div>
  <div class="panel-body panel-body_copy">
 
        <form method="post" action="" name="pergunta" enctype="multipart/form-data">
             <input type="hidden" name="cadastra_pergunta" value="ok" />
             <div class="form-group">
                <label for="pergunta" class="col-sm-2 control-label">Pergunta</label>
                <div class="col-sm-10">
                  <input type="text" name="pergunta" value="<?php echo @$pergunta; ?>" class="form-control" id="pergunta" placeholder="Cadastre sua pergunta">
                </div>
            </div>
         
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                  <button type="submit" value="Cadastrar" class="btn btn-default btn_direita" name="Cadastrar" >Cadastrar</button>
                </div>
            </div>
        </form>
	</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">Cadastrar Resposta</div>
  <div class="panel-body panel-body_copy">
     <form method="post" action="" name="resposta" enctype="multipart/form-data">
     	<input type="hidden" name="cadastra_resposta" value="ok" />
     <div class="form-group">
        <label for="pergunta" class="col-sm-2 control-label">Pergunta</label>
        <div class="col-sm-10">
        	<select name="id_resposta" id="id_resposta" class="form-control" >
    			<option value="-1">Selecione uma das perguntas</option>
                <?php
				$sql = "SELECT id, ques FROM questions";
				$pegar_pergunta = $conecta->selecionar($conecta->conn,$sql);
				 
				while($res_pergunta=mysqli_fetch_array($pegar_pergunta)){
					 $id_pergunta = $res_pergunta[0];
					 $pergunta = $res_pergunta[1];
     
    			?>
     			<option value="<?php echo $id_pergunta;?>"><?php echo $pergunta; ?></option>
     
    			<?php } ?>
     		</select>
        </div>
     </div>
     <a href="#addstat" onclick="AddCampo('resposta')" class="limpo"><button type="button" class="btn btn-info btn_direita"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Adicionar Novo Campo</button></a>
     <div class="form-group">
        <label for="pergunta" class="col-sm-2 control-label">Resposta</label>
        <div class="col-sm-10">
     		<input type="text" name="resposta[]" class="form-control" />
    	</div>
     </div>
     <div id="resposta"></div>
     
     <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10"> 
          <button type="submit" value="Cadastrar" class="btn btn-default btn_direita" name="Cadastrar" >Cadastrar</button>
        </div>
    </div>
     
     </form>
	</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Excluir Enquete</div>
  <div class="panel-body panel-body_copy">
  	<form method="post" enctype="multipart/form-data" name="exclur" action="">
    	<input type="hidden" name="excluir_enquete" value="ok" />
        
        <div class="form-group">
            <label for="pergunta" class="col-sm-2 control-label">Pergunta</label>
            <div class="col-sm-10">
                <select name="id_enquete" id="id_enquete" class="form-control">
                    <option value="-1">Selecione uma das perguntas</option>
                    <?php
                    $sql = "SELECT id, ques FROM questions";
                    $pegar_pergunta = $conecta->selecionar($conecta->conn,$sql);
                     
                    while($res_pergunta=mysqli_fetch_array($pegar_pergunta)){
                         $id_pergunta = $res_pergunta[0];
                         $pergunta = $res_pergunta[1];
                    ?>
                     <option value="<?php echo $id_pergunta;?>"><?php echo $pergunta; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
 		<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10"> 
              <button type="submit" value="Exluir" class="btn btn-default btn_direita" name="Exluir" >Exluir</button>
            </div>
        </div>
    </form>
  </div>
</div>


 <div class="alert alert-warning"><a href="home.php?pagina=gerenciaenquete&amp;tela=19" class="text-warning"><span class="glyphicon glyphicon-stats text-warning">&nbsp;CLIQUE AQUI para Gerenciar Enquete (Ativar/Desativar - Ver Resultados)</span></a></div>
