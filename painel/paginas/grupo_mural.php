<?php
if(isset($_POST['postar']) && $_POST['postar'] == 'postar'){
	
	$dados = 		$_POST["dados"];
	$id 	=	$dados[$tabela]['id'];
	$mensagem =    	trim($dados[$tabela]['mensagem']);
	
	$string = " id = $id";
	
	$_GET['editar'] = 0;
	
	$resultado = $conecta->alterar($dados, $string);
	
} elseif(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	
	$id = $_GET['apagar'];
	
	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM $tabela WHERE id = $id");
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';	
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
} else if(isset($_GET['aprovar']) && $_GET['aprovar'] != ""){
	$id = $_GET['aprovar'];
	$resultado = $conecta->selecionar($conecta->conn,"UPDATE $tabela SET status = 1 WHERE id = $id");
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Post aprovado com sucesso!</div>';	
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível aprovar os post!</div>';
	}
}   

?>
	<a href="home.php?pagina=grupomural_liberadas&amp;tela=<?php echo $idtela; ?>"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-eye-open"></span> Mensagens de <?php echo $nometela; ?> já liberadas</button></a>
            
    <div class="separa"></div>
    
	<?php
    	if(isset($_GET['editar']) && $_GET['editar'] > 0){
			$id = $_GET['editar'];
			$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM $tabela WHERE tela_id = $tela_id AND id = $id");
			$rs = mysqli_fetch_array($resultado);
			$id = $rs['id'];
			$mensagem = $rs['mensagem'];
			$assunto = $rs['assunto'];
			$email = $rs['email'];
			$de = $rs['nome'];
			$para = $rs['para'];
	?>
    
	<form class="form-horizontal" role="form" name="formNoticia" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[<?php echo $tabela; ?>][id]" value="<?php echo @$id; ?>" />     
        <input type="hidden" name="dados[<?php echo $tabela; ?>][tela_id]" value="<?php echo @$idtela; ?>" />
        
    	<div class="form-group">
            <label for="assunto" class="col-sm-2 control-label">Assunto</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][assunto]" value="<?php echo @$assunto; ?>" class="form-control" id="assunto" placeholder="Assunto" disabled>
            </div>
        </div>
        
        <div class="form-group">
            <label for="de" class="col-sm-2 control-label">De</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][de]" value="<?php echo @$de; ?>" class="form-control" id="de" placeholder="De" disabled>
            </div>
        </div>
        
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
              <input type="email" name="dados[<?php echo $tabela;?>][email]" value="<?php echo @$email; ?>" class="form-control" id="email" placeholder="E-mail" disabled>
            </div>
        </div>
        
        <div class="form-group">
            <label for="para" class="col-sm-2 control-label">Para</label>
            <div class="col-sm-10">
              <input type="text" name="para" value="<?php echo @$para; ?>"  class="form-control" id="para" placeholder="Para" disabled>
            </div>
        </div>
        
        <div class="form-group">
            <label for="conteudo" class="col-sm-2 control-label">Mensagem</label>
            <div class="col-sm-10">
              <textarea name="dados[<?php echo $tabela;?>][conteudo]" class="form-control" id="conteudo" placeholder="Conteúdo"><?php echo @$conteudo; ?></textarea>
            </div>
        </div>
        
        
        
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="postar" class="btn btn-default btn_direita" name="postar" id="postar">Postar</button>
        </div>
        </div>

	</form>
    <?php } else {?>
    	
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Post</th>
              <th class="central">Aprovar</th>
              <th class="central">Alterar</th>
              <th class="central">Excluir</th>
            </tr>
          </thead>
          <tbody>
    	<?php
		
			$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela AND status = 0 LIMIT $inicio, $maximo";
			$sql_paginacao = "SELECT * FROM $tabela WHERE tela_id = $idtela AND status = 0";
		
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		while($rs = mysqli_fetch_array($resultado)){ 
			$data = substr($rs['data'],8,2)."/".substr($rs['data'],5,2)."/".substr($rs['data'],0,4);
	  ?>
		<tr>
		  <td>
		  	<strong><?php echo $data; ?> - <?php echo $rs['assunto']; ?></strong><br /><br />
            <strong>E-mail:</strong> <?php echo $rs['email']; ?><br />
            <strong>De:</strong> <?php echo $rs['nome']; ?><br />
            <strong>Para:</strong> <?php echo $rs['para']; ?><br /><br />
            <em><?php echo $rs['mensagem']; ?></em>
          </td>
		  <td align="center">
		  <a href="home.php?pagina=<?php echo $paginatela;?>&amp;aprovar=<?=$rs['id']?>&amp;tela=<?php echo $idtela; ?>" ><span class="glyphicon glyphicon-ok-sign"></span></a>
		  </td>
          <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;editar=<?=$rs['id']?>&amp;tela=<?php echo $idtela; ?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
		  <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;apagar=<?=$rs['id']?>&amp;tela=<?php echo $idtela; ?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
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