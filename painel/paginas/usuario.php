<?php
if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if(isset($_POST['btn_status']) && $_POST['btn_status'] == "Desativar"){
	$sql_desativar = "UPDATE $tabela SET status = 0 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_desativar);
} elseif(isset($_POST['btn_status']) && $_POST['btn_status'] == "Ativar") {
	$sql_ativar = "UPDATE $tabela SET status = 1 WHERE id = ".$_POST['item_id'];
	$conecta->selecionar($conecta->conn,$sql_ativar);
}

if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	//$id = 			strip_tags(trim($dados[$tabela]['id']));
	unset($dados[$tabela]['id']);
	$nome =    	strip_tags(trim($dados[$tabela]['nome']));
	$login2 =    	strip_tags(trim($dados[$tabela]['login']));
	$email =    	strip_tags(trim($dados[$tabela]['email']));
	$perfil2 = strip_tags(trim($dados[$tabela]['perfil_id']));

	$senha = strip_tags(trim($dados[$tabela]['senha']));
	$confirma_senha = strip_tags(trim($_POST['confirma']));

	if(empty($nome)) {
		$retorno = '<div class="alert alert-danger">Informe o nome!</div>';
	}elseif (empty($login2)) {
		$retorno = '<div class="alert alert-danger">Digite o login!</div>';
	} elseif (empty($email)) {
		echo '<div class="alert alert-danger">Informe seu email</div>';
	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<span class='retorno'>Informe um email válido</span><br/>";
	} elseif(empty($senha)){
		$retorno = '<div class="alert alert-danger">Digite a senha!</div>';
	} elseif(empty($confirma_senha)){
		$retorno = '<div class="alert alert-danger">Digite a confirmação da senha!</div>';
	} elseif($senha != $confirma_senha){
		$retorno = '<div class="alert alert-danger">A confirmação da senha não confere!</div>';
	}

	if (empty($retorno)) {

		$dados[$tabela]['senha'] = md5($senha);


		$resultado = $conecta->inserir($dados);
		if (!$resultado){
			echo '<div class="alert alert-danger">Erro ao cadastrar, favor tentar novamente</div>';
		 }else{
			echo '<div class="alert alert-success">Cadastro realizado com sucesso!</div>';

		 }
		$_GET['vw'] = 0;
		echo $resultado;
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){

	//PEGAR OS DADOS
	$dados = $_POST["dados"];
	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$nome =    	strip_tags(trim($dados[$tabela]['nome']));
	$login2 =    	strip_tags(trim($dados[$tabela]['login']));
	$email =    	strip_tags(trim($dados[$tabela]['email']));

	$string = " id = $id";

	if(empty($nome)) {
		$retorno = '<div class="alert alert-danger">Informe o nome!</div>';
	}elseif (empty($login2)) {
		$retorno = '<div class="alert alert-danger">Digite o Login!</div>';
	} elseif (empty($email)) {
		echo '<div class="alert alert-danger">Informe seu email</div>';
	 } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo '<div class="alert alert-danger">Informe um email válido</div>';
	 }

	if (empty($retorno)) {

		$resultado = $conecta->alterar($dados, $string);
		$retorno = '<div class="alert alert-success">Usuário alterado com sucesso.</div>';
		$_GET['vw'] = 0;
		echo $retorno;
	} else {
		echo $retorno;
	}
} else if(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$id = $_GET['apagar'];
	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM $tabela WHERE id = $id");
	if($resultado == 1){
		$resultado = '<div class="alert alert-success">Dados excluídos com sucesso!</div>';
	} else {
		$resultado = '<div class="alert alert-danger">Não foi possível excluir os dados!</div>';
	}
} else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$resultado = $conecta->selecionar($conecta->conn,"SELECT * FROM $tabela WHERE id = $id");
	$rs = mysqli_fetch_array($resultado);
	$id = $rs['id'];
	$titulo = $rs['nome'];
	$perfil2 = $rs['perfil_id'];
	$senha = $rs['senha'];
	$email = $rs['email'];
	$login2 = $rs['login'];
	$nome = $rs['nome'];
	$status = $rs['status'];
}

?>
<a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>&amp;vw=1"><button type="button" class="btn btn-primary btn_direita"><span class="glyphicon glyphicon-plus"></span> Inserir <?php echo $nometela;?></button></a>


<?php if(@$_GET['vw'] == 1) { ?>
	<a href="home.php?pagina=<?php echo $_GET['pagina'];?>&amp;tela=<?php echo $_GET['tela'];?>" ><button type="button" class="btn btn-warning btn_direita"><span class="glyphicon glyphicon-repeat"></span> Voltar</button></a>
	<div class="separa"></div>
	<form class="form-horizontal" role="form" name="formBanner" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[<?php echo $tabela;?>][id]" value="<?php echo @$id; ?>" />
        <input type="hidden" name="dados[<?php echo $tabela;?>][datacadastro]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[<?php echo $tabela;?>][tela_id]" value="<?php echo @$idtela; ?>" />

        <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][nome]" value="<?php echo @$nome; ?>" class="form-control" id="nome" placeholder="Nome">
            </div>
        </div>

        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-10">
              <input type="text" name="dados[<?php echo $tabela;?>][login]" value="<?php echo @$login2; ?>" class="form-control" id="login" placeholder="Login">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
              <input type="email" name="dados[<?php echo $tabela;?>][email]" value="<?php echo @$email; ?>" class="form-control" id="email" placeholder="E-mail">
            </div>
        </div>
        <?php if(@$id == '') { ?>
        <div class="form-group">
            <label for="senha" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
              <input type="password" name="dados[<?php echo $tabela;?>][senha]" value="<?php echo @$senha; ?>" class="form-control" id="senha" placeholder="Senha">
            </div>
        </div>

        <div class="form-group">
            <label for="confirma" class="col-sm-2 control-label">Confirmação de Senha</label>
            <div class="col-sm-10">
              <input type="password" name="confirma" value="" class="form-control" id="confirma" placeholder="Confirmação de Senha">
            </div>
        </div>
        <?php } ?>

        <?php if(@$perfil2 != 1) { ?>
        <div class="form-group">
            <label for="perfil" class="col-sm-2 control-label">Perfil</label>
            <div class="col-sm-10">
              <select class="form-control" name="dados[<?php echo $tabela;?>][perfil_id]"  >
                    <option value="" >Selecione..</option>
                    <?php
					$sql_perfil = "SELECT * FROM tbperfil WHERE nome not in ('Administrador') order by nome asc";
					$resultado_perfil = $conecta->selecionar($conecta->conn,$sql_perfil);
					while ($rs_perfil = mysqli_fetch_array($resultado_perfil)){
					?>
                    <option value="<?php echo $rs_perfil['id']; ?>" <?php if($rs_perfil['id'] == @$perfil2) { echo "selected";} ?> ><?php echo $rs_perfil['nome']; ?></option>
                    <?php } ?>
                 </select>
            </div>
        </div>
        <?php } ?>

        <div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Ativo</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][status]" <?php if(@$status == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][status]" <?php if(@$status == 2 ) { echo "checked"; } ?> value="2"> Não
               </div>

            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" value="Gravar" class="btn btn-default btn_direita" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?>>Salvar</button>
        </div>
        </div>
    </form>

<?php } else { ?>

	<div class="separa"></div>
<div class="table-responsive">
<table class="table table-hover">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Login</th>
      <th>E-mail</th>
      <th class="central">Situacao</th>
      <th class="central">Alterar</th>
      <th class="central">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela ORDER BY nome ASC LIMIT $inicio, $maximo";
	$sql_paginacao = "SELECT * FROM $tabela WHERE tela_id = $idtela ORDER BY nome ASC";
	$resultado = $conecta->selecionar($conecta->conn,$sql);
	while($rs = mysqli_fetch_array($resultado)){
  ?>
    <tr>
      <td><?php echo $rs['nome']; ?></td>
      <td><?php echo $rs['login']; ?></td>
      <td><?php echo $rs['email']; ?></td>
      <td align="center">
      <form action="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $tela_id;?>" method="post" enctype="multipart/form-data" name="form_ativa">
            <input type="hidden" value="<?php echo $rs['id'];?>" id="item_id" name="item_id" />
            <input type="submit" class="<?php echo $rs['status'] == 1 ? 'btn_ativar' : 'btn_desativar' ?>" name="btn_status" value="<?php echo $rs['status'] == 1 ? 'Desativar' : 'Ativar'; ?>" />
            </form>
      </td>
      <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;vw=1&amp;tela=<?php echo $idtela;?>&amp;alterar=<?php echo $rs['id']?>&amp;p=<?php echo $p;?>" ><span class="glyphicon glyphicon-pencil"></span></a></td>
      <td align="center"><a href="home.php?pagina=<?php echo $paginatela;?>&amp;tela=<?php echo $idtela;?>&amp;apagar=<?php echo $rs['id']?>&amp;p=<?php echo $p;?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div><!--FIM TABLE RESPONSIVE-->
<div class="centro">
      	<?php
        	$resultado_total = $conecta->selecionar($conecta->conn,$sql_paginacao);
            include "paginacao.php";
		?>
      </div>
<?php  } ?>
