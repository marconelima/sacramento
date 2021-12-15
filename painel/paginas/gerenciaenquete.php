<?php
if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	
	
	$ativo = $_POST["ativo"];
	$home = $_POST["home"];
	
		
	$arrCampos = array_values($ativo);
	$numCampos = count($arrCampos);		
	$dados['questions']['status'] = 0;
	
	$arrCampos2 = array_values($home);
	$numCampos2 = count($arrCampos2);	
	$dados['questions']['home'] = 0;
	
	$string = '1 = 1';
	$conecta->alterar($dados,$string);
		
	for($j=0;$j<$numCampos;$j++){
		$dados['questions']['status'] = 1;
		$string = " id = ".$arrCampos[$j];
		$resultado = $conecta->alterar($dados,$string);
	}
	
	for($j=0;$j<$numCampos2;$j++){
		$dados['questions']['home'] = 1;
		$string = " id = ".$arrCampos2[$j];
		$resultado = $conecta->alterar($dados,$string);
	}
	
	if($resultado){
		echo '<span class="retorno">Liberação salva com sucesso!</span>';
	}
	
	
		
}

?>
	<a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir <?php echo $nometela;?></button></a>
        <a href="home.php?pagina=categoria&amp;tela=<?php echo $idtela; ?>"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir Nova Categoria</button></a>
        
    <div class="separa"></div>
    
	
    	
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Título</th>
              <th class="central">Ativa</th>
              <th class="central">Visivel Home</th>
              <th class="central">Resultado</th>
            </tr>
          </thead>
          <tbody>
           <form action="" method="post" enctype="multipart/form-data" name="form">
    <?php
		$sql = "SELECT * FROM questions LIMIT $inicio, $maximo";
		$sql_paginacao = "SELECT * FROM questions";
		$resultado = $conecta->selecionar($conecta->conn,$sql);
		while($rs = mysqli_fetch_array($resultado)){ 
	  ?>
		<tr>
		  <td><?php echo $rs['ques']; ?></td>
		  <td align="center">
		  <input type="checkbox" class="form-control pequeno" name="ativo[<?php echo $i; ?>]" <?php if($rs['status'] == 1) { echo "checked"; } ?> value="<?php echo $rs['id']; ?>" />
		  </td>
          <td align="center">
          <input type="checkbox" class="form-control pequeno" name="home[<?php echo $i; ?>]" <?php if($rs['home'] == 1) { echo "checked"; } ?> value="<?php echo $rs['id']; ?>" />
          </td>
		  <td align="center"><a href="#" onclick="window.open('../enquete/poll.php?result=1&amp;id=<?php echo $rs['id']; ?>','Enquete','height=400, width=400');">Resultado</a></td>
		</tr>
		<?php } ?>
        <tr><td colspan="2">
             <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"  />
        </td></tr>
        </form>
	  </tbody>
      </table>
      </div>
      <div class="centro">
      	<?php
        	$resultado_total = $conecta->selecionar($conecta->conn,$sql_paginacao);
            include "paginacao.php";
		?>
      </div>
