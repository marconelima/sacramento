<?
if ($email != "" and $destinatario != "")
{
$cabecalho = "From: $email\nReply-To: $email";
$corpo .= "Raz�o Social = $razao .\n";
$corpo .= "Nome = $nome .\n";
$corpo .= "DDD+Telefone = $ddd .\n";
$corpo .= "Cidade = $cidade .\n";
$corpo .= "E-mail = $email .\n";
$corpo .="\n\n*******************************************************************************\n";
$corpo .= "Or�ar os seguintes produtos = $duvidas .\n\n";
$corpo .= "*******************************************************************************";
mail($destinatario, $assunto, $corpo, $cabecalho);
echo ("&enviado=ok&");
}
?>