<?php
if(isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar'){

	 $nome =     strip_tags(trim($_POST['nome']));
	 $email =    strip_tags(trim($_POST['email']));
	 $telefone = strip_tags(trim($_POST['telefone']));
	 $celular = strip_tags(trim($_POST['celular']));
	 $endereco =  strip_tags(trim($_POST['endereco']));
	
	 $assunto =  "Trabalhe Conosco - $nome_do_site ";
	 //$mensagem = strip_tags(trim($_POST['mensagem']));
	 
	 $anexado = $_FILES['arquivo']['name'];
	 $extensao = strtolower(end(explode('.', $anexado)));
	 $extensoes = array ('txt', 'doc', 'docx');
	 $size = $_FILES['arquivo']['size'];
	 $maxsize = 1024 * 1024 * 2;
	  
	 
	$date = date("d/m/Y h:i");
	 
	// ****** ATENÇÃO ********
	// ABAIXO ESTÁ A CONFIGURAÇÃO DO SEU FORMULÁRIO.
	// ****** ATENÇÃO ********
	 
	//CABEÇALHO - ONFIGURAÇÕES SOBRE SEUS DADOS E SEU WEBSITE
	 
	$destino = $emailSite;
	 
	$nome_do_site=$nomeSite;
	$email_para_onde_vai_a_mensagem = "$destino";
	$nome_de_quem_recebe_a_mensagem = "$nome_do_site";
	$exibir_apos_enviar='';
	 
	//MAIS - CONFIGURAÇOES DA MENSAGEM ORIGINAL
	$cabecalho_da_mensagem_original="From: $email\n";
	$assunto_da_mensagem_original="$assunto";
	 
	// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
	// ******** OBS: SE FOR ADICIONAR NOVOS CAMPOS, ADICIONE OS CAMPOS NA VARIÁVEL ABAIXO *************
	$configuracao_da_mensagem_original="
	 
	<strong>ENVIADO POR:</strong><br />
	<strong>Nome:</strong> $nome<br />
	<strong>E-mail:</strong> $email<br />
	<strong>Telefone:</strong> $telefone<br />
	<strong>Celular:</strong> $celular<br />
	<b>Cidade / Estado: </b>$endereco<br /><br />
	
	ENVIADO EM: $date";
	 
	//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
	// CASO $assunto_digitado_pelo_usuario="s" ESSA VARIAVEL RECEBERA AUTOMATICAMENTE A CONFIGURACAO
	// "Re: $assunto"
	$assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Trabalhe Conosco";
	$cabecalho_da_mensagem_de_resposta = "From: $nome_do_site <$email_para_onde_vai_a_mensagem>\n";
	$configuracao_da_mensagem_de_resposta="
	 
	Obrigado por entrar em contato!<br />
	Iremos avaliar seu currículo...<br />
	<strong>Atenciosamente $nome_do_site</strong><br /><br />
	Enviado em: $date";
	 
	// ****** IMPORTANTE ********
	// A PARTIR DE AGORA RECOMENDA-SE QUE NÃO ALTERE O SCRIPT PARA QUE O  SISTEMA FINCIONE CORRETAMENTE
	// ****** IMPORTANTE ********
	 
	//ESSA VARIAVEL DEFINE SE É O USUARIO QUEM DIGITA O ASSUNTO OU SE DEVE ASSUMIR O ASSUNTO DEFINIDO
	//POR VOCÊ CASO O USUARIO DEFINA O ASSUNTO PONHA "s" NO LUGAR DE "n" E CRIE O CAMPO DE NOME
	//'assunto' NO FORMULARIO DE ENVIO
	$assunto_digitado_pelo_usuario="s";
	 
	//ENVIO DA MENSAGEM ORIGINAL
	 
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
	 
	if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
	 
	 $fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
	 $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
	 $anexo = base64_encode($anexo);
	 
	fclose($fp);
	 
	$anexo = chunk_split($anexo);
	 
	$boundary = "XYZ-" . date("dmYis") . "-ZYX";
	 
	 $mens = "--$boundary\n";
	 $mens .= "Content-Transfer-Encoding: 8bits\n";
	 $mens .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
	 $mens .= "$configuracao_da_mensagem_original\n";
	 $mens .= "--$boundary\n";
	 $mens .= "Content-Type: ".$arquivo["type"]."\n";
	 $mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";
	 $mens .= "Content-Transfer-Encoding: base64\n\n";
	 $mens .= "$anexo\n";
	 $mens .= "--$boundary--\r\n";
	 
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "$cabecalho_da_mensagem_original";
	$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
	$headers .= "$boundary\n";
	}else{
	 
	$mens = "$configuracao_da_mensagem_original\n";
	 
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "$cabecalho_da_mensagem_original";
	$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
	}
	 
	if ($assunto_digitado_pelo_usuario=="s")
	{
	$assunto = "$assunto_da_mensagem_original";
	};
	$seuemail = "$email_para_onde_vai_a_mensagem";
	//mail($seuemail,$assunto,$mens,$headers);
	sendMail($seuemail,"Sacramento",utf8_decode($mens),$assunto);
	 
	//ENVIO DE MENSAGEM DE RESPOSTA AUTOMATICA
	 
	$headers = "$cabecalho_da_mensagem_de_resposta";
	$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
	 
	if ($assunto_digitado_pelo_usuario=="s")
	{
	$assunto = "$assunto_da_mensagem_de_resposta";
	}
	else
	{
	$assunto = "Re: $assunto";
	}
	$mensagem = "$configuracao_da_mensagem_de_resposta";
	
	if(sendMail($email,$nome,utf8_decode($mensagem),$assunto)){
		unset($nome, $email, $assunto, $mensagem);
		echo "<font style='color:#CC0000'>Mensagem enviada com sucesso!</font>";
	}else{
		
		unset($nome, $email, $assunto, $mensagem);
		echo "<font style='color:#CC0000'>Não foi possível enviar a mensagem!</font>";
	}
	 
}
?>

<div id="corpo">
<?php include "busca.php"; ?>
	<div id="titulo_principal"><span class="titulo_principal"><?php echo convertem("Trabalhe Conosco",1); ?></span></div>
    <div id="separacao_principal"></div>
<div id="formulario_orcamento">
<form action="" method="post" enctype="multipart/form-data" name="form"> 
    <input type="hidden" name="enviar" value="enviar" />
<span class="texto_contato">Nome</span>
<input class="input_contato" type="text" name="nome" size="75" /><br/><br/>
<span class="texto_contato">Email</span>
<input class="input_contato" type="text" name="email" size="75" /><br/><br/>
<span class="texto_contato">DDD + Telefone</span>
<input class="input_contato" type="text" name="telefone" size="75" maxlength="13" onKeyPress="javascript: m_Telefone(this,10); return v_NR(event)" onKeyDown="javascript: return v_NR(event)" onChange="javascript: m_Telefone(this,10)" /><br/><br/>
<span class="texto_contato">DDD + Celular</span>
<input class="input_contato" type="text" name="celular" size="75" maxlength="13" onKeyPress="javascript: m_Telefone(this,10); return v_NR(event)" onKeyDown="javascript: return v_NR(event)" onChange="javascript: m_Telefone(this,10)" /><br/><br/>
<span class="texto_contato">Cidade / Estado</span>
<input class="input_contato" type="text" name="endereco" size="75" /><br/><br/>
<span class="texto_contato">Currículo</span>
<input class="input_contato" type="file" name="arquivo" size="45" /><br/><br/>
<div class="botao_formulario"><input type="image" value="enviar" src="images/btn_enviar2.png" name="enviar" onclick="document.form.submit();" /></div>
</form>
</div>
</div>