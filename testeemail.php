<?php

$headers = "From: Sacramento <vendas@industriasacramento.com.br>\n";
$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

mail('marcone.lima@gmail.com', 'teste', 'teste', $headers);

/*apenas dispara o envio da mensagem caso houver/existir $_POST['enviar']*/
if (isset($_POST['enviar'])) {
 
/*digite os destinatarios separados por virgula*/
 
$destinatarios = 'marcone.lima@gmail.com';
/*usuario ou nome completo da conta criada em sua hospedagem, como por exemplo teste@seudominio*/
$usuario = 'vendas@industriasacramento.com.br';
/*senha da conta de email acima*/
$senha = 'G4p2f5d3';
/*nome do destinatario no qual receberá a mensagem*/
$nomeDestinatario = 'mensagem do site';
 
/*abaixo as variaveis principais, que devem conter em seu formulario*/
$nomeRemetente = $_POST['nomeRemetente'];
$resposta = $_POST['email'];
$assunto = $_POST['assunto'];
$_POST['mensagem'] = nl2br($_POST['mensagem']);
 
/***********************************A PARTIR DAQUI NAO ALTERAR************************************/
foreach ($_POST as $dados['me1'] => $dados['me2']) {
$dados['me3'][] = ''.$dados['me1'].': '.$dados['me2'];
}
 
$dados['me3'] = 'Mensagem do site'.implode('', $dados['me3']).'';
$dados['email'] = array('usuario' => $usuario, 'senha' => $senha, 'servidor' => 'smtp.'.substr(strstr($usuario, '@'), 1), 'nomeRemetente' => $nomeRemetente, 'nomeDestinatario' => $nomeDestinatario, 'resposta' => $resposta, 'assunto' => $assunto, 'mensagem' => $dados['me3']);
 
ini_set('php_flag mail_filter', 0);
 
$conexao = fsockopen($dados['email']['servidor'], 587, $errno, $errstr, 10);
fgets($conexao, 512);
 
$dados['destinatarios'] = explode(',', $destinatarios);
 
foreach ($dados['destinatarios'] as $dados['1']) {
$dados['destinatarios']['RCPTTO'][] = '<'.$dados['1'].'>';
$dados['destinatarios']['TO'][] = $dados['1'];
}
 
$dados['cabecalho'] = array('EHLO ' => $dados['email']['servidor'], 'AUTH LOGIN', base64_encode($dados['email']['usuario']), base64_encode($dados['email']['senha']), 'MAIL FROM: ' => '<'.$dados['email']['usuario'].'>', 'RCPT TO:' => $dados['destinatarios']['RCPTTO'], 'DATA', 'MIME-Version: ' => '1.0', 'Content-Type: text/html; charset=iso-8859-1', 'Date: ' => date('r',time()), 'From: ' => array($dados['email']['nomeRemetente'].' ' => '<'.$dados['email']['usuario'].'>'), 'To:' => array($dados['email']['nomeDestinatario'].' ' => $dados['destinatarios']['TO']), 'Reply-To: ' => $dados['email']['resposta'],'Subject: ' => $dados['email']['assunto'], 'mensagem' => $dados['email']['mensagem'], 'QUIT');
 
foreach ($dados['cabecalho'] as $dados['2'] => $dados['3']){
 
if (is_array($dados['3'])) {
foreach ($dados['3'] as $dados['4'] => $dados['5']) {
$dados['4'] = empty($dados['4']) ? '' : $dados['4'];
$dados['5'] = empty($dados['5']) ? '' : $dados['5'];
$dados['4'] = is_numeric($dados['4']) ? '' : $dados['4'];
if (is_array($dados['5'])) {
$dados['5'] = '<'.implode(', ', $dados['5']).'>';
}
fwrite($conexao, $dados['2'].$dados['4'].$dados['5'].'', 512).'';
fgets($conexao, 512);
}
} else {
$dados['2'] = empty($dados['2']) ? '' : $dados['2'];
$dados['3'] = empty($dados['3']) ? '' : $dados['3'];
$dados['2'] = is_numeric($dados['2']) ? '' : $dados['2'];
 
if ($dados['2'] == 'Subject: ') {
fwrite($conexao, $dados['2'].$dados['3'].'', 512).'';
fwrite($conexao, '', 512).'';
fgets($conexao, 512);
} elseif ($dados['2'] == 'mensagem') {
    fwrite($conexao, $dados['3'].'.').'';
fgets($conexao);
} else {
fwrite($conexao, $dados['2'].$dados['3'].'', 512).'';
fgets($conexao, 512);
}
}
}
fclose($conexao);
}
?>
 
<!-- COMEÇA AQUI O FORMULARIO EM HTML -->
<!-- MAIS CAMPOS PODEM SER INSERIDOS NORMALMENTE ENTRE A TAG FORM -->
<form action='' method='post'>
<h1>Formulario de teste</h1>
<h5>(smtp autenticado)</h5>
<?php
if (isset($_POST['enviar'])) {
print '<h4>A mensagem foi enviada!!!</h4>';
}
?>
<table bgcolor='#cccccc' border='1' cellpadding='0' cellspacing='0'>
<tbody>
<tr>
<td nowrap='nowrap'><p>Nome:</p></td>
<td><input name='nomeRemetente' size='34' type='text' /></td>
</tr>
<tr>
<td nowrap='nowrap'><p>E-mail:</p></td>
<td><input name='email' size='34' type='text' /></td>
</tr>
<tr>
<td nowrap='nowrap'><p>Assunto:</p></td>
<td>
<select name='assunto'>
<option selected='selected' value='opnião'>Opnião</option>
<option value='sugestão'>sugestão</option>
<option value='parceria'>Parceria</option>
<option value='outros'>Outros</option>
</select>
</td>
</tr>
<tr>
<td nowrap='nowrap'><p>Mensagem:</p></td>
<td><textarea cols='34' name='mensagem' rows='4'></textarea></td>
</tr>
</tbody>
</table>
<input type="submit" name="enviar" value="enviar" />
</form>