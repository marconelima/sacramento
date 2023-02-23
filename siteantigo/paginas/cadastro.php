<?php



if(isset($_POST['enviar']) && $_POST['enviar'] == 'enviar'){
	
	

	 $nome =     strip_tags(trim($_POST['nome']));
	 $email =    strip_tags(trim($_POST['email']));
	 $telefone = strip_tags(trim($_POST['telefone']));
	 $celular = strip_tags(trim($_POST['celular']));
	 $endereco =  strip_tags(trim($_POST['endereco']));
	 $cidade = strip_tags(trim($_POST['cidade']));
	
	
	if (empty($nome)){
		echo "<span class='retorno'>Informe seu nome</span><br/>";
	 } elseif (empty($email)) {
		echo "<span class='retorno'>Informe seu email</span><br/>";
	 } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<span class='retorno'>Informe um email válido</span><br/>";
	 } else {
 
		 $verifica = $conecta->selecionar("SELECT * FROM tbnewsletter WHERE email = '$email'");
		 $contar = mysql_num_rows($verifica);
		 
		 if ($contar >= '1'){
		 	echo "<span class='retorno'>O email já foi cadastrado em nosso boletim</span>";
		 } else {
		 	
			 $dados['tbnewsletter']['nome'] = $nome;
			 $dados['tbnewsletter']['email'] = $email;
			 $dados['tbnewsletter']['telefone'] = $telefone;
			 $dados['tbnewsletter']['celular'] = $celular;
			 $dados['tbnewsletter']['endereco'] = $endereco;
			 $dados['tbnewsletter']['cidade'] = $cidade;
			 $dados['tbnewsletter']['status'] = 1;
			 $cadastra = $conecta->inserir($dados);
			 
			 if ($cadastra <= '0'){
			 	echo "<span class='retorno'>Erro ao cadastrar, favor tentar novamente</span>";
			 }else{
			 	echo "<span class='retorno'>Cadastro com sucesso!</span>";
			 
				 $data = date('d/m/Y H:i');
				 $msn = "
				 
				 Recebemos um pedido de cadastro do seu email em nosso boletim!
				 <br />
				 Para confirmar seu cadastro, por favor clique no link abaixo.
				 <br />
				 <br />
				 <a href=\"".$linkSite."/confirma.php?email=$email\">Confirmar Cadastro</a>
				 <br />
				 <br />
				 Se você não cadastrou este pedido em nosso site, por favor ignore este email!
				 <br />
				 Atenciosamente ".$nomeSite."
				 <br />
				 <br />
				 Enviado em: $data
				 ";
				 $para = $emailSite;
				 $assunto = 'Cadastro Newsletter '.$nomeSite;
				 
				 $headers = "From: $para\n";
				 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";
				 
				 mail($email,$assunto,$msn,$headers);
			 
			 }
		 }
 	}
}

?>

<div id="corpo">
<?php include "busca.php"; ?>
<div style="width:100%; height:50px; position:relative; float:left;" >
<div id="topo_corpo_interno"><span class="texto_menu">Cadastre-se em nosso boletim e receba notícias e informações:</span></div>
</div>
<div style="width:100%; height:15px; position:relative; float:left; margin-left:20px; margin-bottom:10px; font-family:Calibri, Verdana, Geneva, sans-serif; font-size:9pt; color:#C00;">* campo obrigatório</div>
<div id="formulario_orcamento" style="margin-left:15px;" > 
    <form action="" method="post" enctype="multipart/form-data" name="form_orcamento"> 
    <input type="hidden" name="enviar" value="enviar" />
    <br /><br />
    <span class="texto_contato">Nome *</span>
    <input class="input_contato" type="text" name="nome" size="75" /><br/><br/>
    
    <span class="texto_contato">Email *</span>
    <input class="input_contato" type="text" name="email" size="75" /><br/><br/>
    
    <span class="texto_contato">DDD + Telefone</span>
    <input class="input_contato" type="text" name="telefone" size="75" maxlength="13" onKeyPress="javascript: m_Telefone(this,10); return v_NR(event)" onKeyDown="javascript: return v_NR(event)" onChange="javascript: m_Telefone(this,10)" /><br/><br/>
    
    <span class="texto_contato">DDD + Celular</span>
    <input class="input_contato" type="text" name="celular" size="75" maxlength="13" onKeyPress="javascript: m_Telefone(this,10); return v_NR(event)" onKeyDown="javascript: return v_NR(event)" onChange="javascript: m_Telefone(this,10)" /><br/><br/>
    
    <span class="texto_contato">Endereço</span>
    <input class="input_contato" type="text" name="endereco" size="75" /><br/><br/>
    
    <span class="texto_contato">Cidade / Estado</span>
    <input class="input_contato" type="text" name="cidade" size="75" /><br/><br/>
    
    <div class="botao_formulario"><input type="image" value="enviar" id="enviar" src="images/btn_enviar2.png" name="enviar" onclick="document.form_orcamento.submit();" /></div>

    
    </form>
</div>