<?php

if(isset($_POST['enviar']) && $_POST['enviar'] == 'enviar'){
	 $empresa =  strip_tags(trim($_POST['empresa']));

	 $nome =     strip_tags(trim($_POST['nome']));

	 $email =    strip_tags(trim($_POST['email']));

	 $telefone = strip_tags(trim($_POST['telefone']));

	 $celular = strip_tags(trim($_POST['celular']));

	 $endereco =  strip_tags(trim($_POST['endereco']));

	 $mensag = strip_tags(trim($_POST['mensagem']));

	

	 $assunto =  "Contato - ".strip_tags(trim($_POST['assunto']));

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

	$nome_de_quem_recebe_a_mensagem = $nomeSite;

	$exibir_apos_enviar='';

	 

	//MAIS - CONFIGURAÇOES DA MENSAGEM ORIGINAL

	$cabecalho_da_mensagem_original="From: $email\n";

	$assunto_da_mensagem_original="$assunto";

	

	 

	// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)

	// ******** OBS: SE FOR ADICIONAR NOVOS CAMPOS, ADICIONE OS CAMPOS NA VARIÁVEL ABAIXO *************

	$configuracao_da_mensagem_original="

	 

	<strong>ENVIADO POR:</strong><br /><br/>

	

	<b>Nome: </b>$nome<br />

	<b>E-mail: </b>$email<br />

	<b>DDD + Telefone: </b>$telefone<br />

	<b>DDD + Celular: </b>$celular<br />

	<b>Cidade / Estado: </b>$endereco<br /><br />

	<b>Mensagem: </b><br/>$mensag<br/>

	

	ENVIADO EM: $date";

	 

	//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA

	// CASO $assunto_digitado_pelo_usuario="s" ESSA VARIAVEL RECEBERA AUTOMATICAMENTE A CONFIGURACAO

	// "Re: $assunto"

	$assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Contato";

	$cabecalho_da_mensagem_de_resposta = "From: $nome_do_site <$email_para_onde_vai_a_mensagem>\n";

	$configuracao_da_mensagem_de_resposta="

	 

	Obrigado por entrar em contato!<br />

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


	if(sendMail($seuemail,"Sacramento",utf8_decode($mens),$assunto)){
		//mail($seuemail,$assunto,$mens,$headers)
		sendMail('marcone.lima@gmail.com',"Sacramento",utf8_decode($mens),$assunto);
		sendMail('luiz@cianodigital.com.br',"Sacramento",utf8_decode($mens),$assunto);
	

	}

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

	};

	$mensagem = "$configuracao_da_mensagem_de_resposta";

	

	if($ministerio != ''){

		

	}




	//print_r($email.",".$assunto.",".$mensagem.",".$headers); 

	//if(mail($email,$assunto,$mensagem,$headers)){
	if(sendMail($email,$nome,utf8_decode($mensagem),$assunto)){
		sendMail('marcone.lima@gmail.com',$nome,utf8_decode($mensagem),$assunto);
		sendMail('luiz@cianodigital.com.br',$nome,utf8_decode($mensagem),$assunto);
		//mail('marcone.lima@gmail.com',$assunto,$mensagem,$headers);
		//mail('luiz@cianodigital.com.br',$assunto,$mensagem,$headers);

		unset($nome, $email, $assunto, $mensagem);

		echo "Mensagem enviada com sucesso!";

	}else{

		

		unset($nome, $email, $assunto, $mensagem);

		echo "Não foi possível enviar a mensagem!";

	}

	 

}



?>



<div id="corpo">

<?php include "busca.php"; ?>

	<div id="titulo_principal"><span class="titulo_principal"><?php echo strtoupper("CONTATO"); ?></span></div>

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

<span class="texto_contato">Assunto</span>

<input class="input_contato" type="text" name="assunto" size="75" /><br/><br/>

<span class="texto_contato">Escreva aqui sua mensagem</span>

<textarea class="input_contato" name="mensagem" rows="6" cols="74"></textarea><br/><br/>

<div class="botao_formulario"><input type="image" value="enviar" src="images/btn_enviar2.png" name="enviar" onclick="document.form.submit();" /></div>



</form>

</div>





</div>


