<?php
include "parametros.php";
include "uteis/bancodados.php";
$conecta = new Recordset;
$conecta->conexao();

$email = $_GET['email'];

$resultado = $conecta->selecionar("SELECT * FROM tbnewsletter WHERE email = '$email'");
$rs = mysql_fetch_array($resultado);

$dados['tbnewsletter']['nome'] = $rs['nome'];
$dados['tbnewsletter']['email'] = $rs['email'];
$dados['tbnewsletter']['situacao'] = 1;

$string = " email = '$email'";
 
$confirma = $conecta->alterar($dados, $string);
 
if($confirma <= '0'){
 	echo "Erro ao concluir seu cadastro. por favor entre em nosso site e cadastre-se novamente!";
}else{
	 echo "Cadastro realizado com sucesso! Lhe enviamos um e-mail informando a conclusão";
	 
	 $data = date('d/m/Y H:i');
	 $msn = "
	 
	 <strong>Parabéns, seu cadastro foi realizado com sucesso!</strong>
	 <br />
	 <br />
	 Obrigado por se cadastrar em nosso boletim. A equipe ".$nomeSite." agradece!
	 <br />
	 <br />
	 Enviado em: $data
	 ";
	 
	 $para = $emailSite;
	 $assunto = 'Cadastro no newsletter '.$nomeSite.' concluido';
	 
	 $headers = "From: $para\n";
	 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";
	 
	 mail($email,$assunto,$msn,$headers);
	 
}
 
?>