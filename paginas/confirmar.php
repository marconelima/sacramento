<div class="container">
<?php

$sql = "SELECT * FROM tbnewsletter WHERE email = '$emailcadastro'";
$resultado = $conecta->selecionar($conecta->conn, $sql);


if($rs = mysqli_fetch_array($resultado)){
	$dados['tbnewsletter']['nome'] = $rs['nome'];
	$dados['tbnewsletter']['email'] = $rs['email'];
	$dados['tbnewsletter']['situacao'] = 1;

	$string = " email = '$emailcadastro'";

	$confirma = $conecta->alterar($dados, $string);

	if($confirma <= '0'){
		echo '<div class="alert alert-danger">Erro ao concluir seu cadastro. por favor entre em nosso site e cadastre-se novamente!</div>';
	}else{

		 $data = date('d/m/Y H:i');
		 $msn = "
		 <strong>Parabéns, seu cadastro foi realizado com sucesso! $emailcadastro</strong>
		 <br />
		 <br />
		 Obrigado por se cadastrar em nosso boletim. A equipe ".$rs_configuracao['nomeloja']." agradece!
		 <br />
		 <br />
		 Enviado em: $data
		 ";

		 $para = $rs_configuracao['emailloja'];
		 $assunto = 'Cadastro no newsletter '.$rs_configuracao['nomeloja'].' concluido';

		 $headers = "From: $para\n";
		 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

		 mail($emailcadastro,$assunto,$msn,$headers);

		 echo $msn."<br/><br/><br/>";

	}
} else {?>
<div id="erro_box">
	<span class="erro_texto">Desculpe e-mail não encontrada.</span>
</div>
<?php } ?>
</div>
