<?php
$email = $_GET['email'];

$confirma = mysql_query("DELETE FROM tbnewsletter WHERE email = '$email'")
 or die(mysql_error());

if($confirma <= '0'){
 echo "Erro ao remover seu cadastro tente novamente!";
}else{
 echo "Seu email foi removido com sucesso :( ";

 $data = date('d/m/Y H:i');
 $msn = "

 <strong>Recebemos a solicitação de exclusão do seu cadastro!</strong>
 <br />
 <br />
 Estamos informando que a exclusão foi realizada com sucesso. 
 <br />
 <br />
 Removido em: $data

 ";

 $para = $emailSite;
 $assunto = 'Cancelamento de boletim concluido';

 $headers = "From: $para\n";
 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

 mail($email,$assunto,$msn,$headers);

}

?>