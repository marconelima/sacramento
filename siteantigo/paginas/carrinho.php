<?php include_once("config.php");

	//Recupera objetos da sessão





if(isset($_SESSION['criar'])){

	$carrinhoSessao = unserialize($_SESSION["carrinho"]);

}







if(isset($_GET['id']) && $_GET['acao'] == 'remover'){

	$id = $_GET['id'];

	$carrinhoSessao->removeProduto($id);

} elseif(isset($_POST['atualizar_y'])) {

	$dados = $_POST['dados'];

	$numCampos = count($dados['quantidade']);

	foreach($carrinhoSessao->getProdutos() as $produtos){

		for($i = 0; $i < $numCampos; $i++){ 

			if($produtos->getId() == $dados['subproduto'][$i]){

				$produtos->setQuantidade($dados['quantidade'][$i]);

			}

		}

	}

} elseif(isset($_POST['pedirorcamento_y'])){

	$dados = $_POST['dados'];

	$numCampos = count($dados['quantidade']);

	foreach($carrinhoSessao->getProdutos() as $produtos){

		for($i = 0; $i < $numCampos; $i++){ 

			if($produtos->getId() == $dados['subproduto'][$i]){

				$produtos->setQuantidade($dados['quantidade'][$i]);

			}

		}

	}

} elseif(isset($_POST['enviar'])){

	

	$_POST['pedirorcamento_y'] = 1;

	$nome = $_POST['nome'];

	$email = $_POST['email'];

	$telefone = $_POST['telefone'];

	$celular = $_POST['celular'];

	$endereco = $_POST['endereco'];

	$cnpj = $_POST['cpf'];

	$razao = $_POST['razao'];

	$uf = $_POST['uf']; 

	$pessoa = $_POST['pessoa']; 

	$cpf = $_POST['cpf2']; 

	

	

	if(empty($nome)) {

		$retorno = '<span class="retorno">Informe o nome!</span>';

	}elseif (empty($email)) {

		$retorno = '<span class="retorno">Digite o e-mail!</span>';

	}elseif (empty($telefone)) {

		$retorno = '<span class="retorno">Digite o telefone!</span>';

	}elseif (empty($cpf) && $pessoa == 'fisica') {

		$retorno = '<span class="retorno">Digite o CPF!</span>';

	}elseif (empty($cnpj) && $pessoa == 'juridica') {

		$retorno = '<span class="retorno">Digite o CNPJ!</span>';

	}

	if (empty($retorno)) {

		 

		

		 if($pessoa == "fisica"){

			 $pessoa = "Pessoa Física";

		 }elseif($pessoa == "juridica"){

			 $pessoa = "Pessoa Jurídica";

		 }

		

		 $assunto =  "Pedido de orçamento pelo site".$nomeSite;

		 

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

		$cabecalho_da_mensagem_original="From: $email_para_onde_vai_a_mensagem\n";

		$assunto_da_mensagem_original="$assunto";

		

		

		//MONTAGEM DO ORÇAMENTO COM DADOS DO CARRINHO

		

		$cor = "#eaeaea";

		$estilo_titulo = "font-family:Calibri, Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; color:#FFF";

		$estilo_texto = "font-family:Calibri, Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; color:#000";

				

		$carrinho =  "<table cellpadding=\"2\" cellspacing=\"3\" width=\"740\" border=\"0\">

				<tr bgcolor=\"#333333\"><td width=\"50\"><span style=\"".$estilo_titulo."\">Imagem</span></td>

					<td width=\"350\" align=\"center\"><span style=\"".$estilo_titulo."\">Descrição</span></td>

					<td width=\"90\" align=\"center\"><span style=\"".$estilo_titulo."\">Quantidade</span></td>

				</tr>

		";

		$i = 0;

		foreach($carrinhoSessao->getProdutos() as $pro){

			$valor = ((integer)$pro->getQuantidade())*((float)$pro->getPreco());

			$valorTotal = $valorTotal + $valor;

			$carrinho .= "<input type=\"hidden\" name=\"dados[nome][]\" value=\"{$pro->getCodigo} {$pro->getNome()} {$pro->getMarca()} {$pro->getCaracteristica()}\"  />

					<input type=\"hidden\" name=\"dados[subproduto][]\" value=\"{$pro->getId()}\" />";

					

					

						

			$carrinho .= "<tr bgcolor=\"$cor\"><td><img src=\"".$linkSite."/imagens/".$pro->getFoto()."\" width=\"50\" border=\"0\" /></td>

			<td><span style=\"".$estilo_texto."\">{$pro->getIdProduto()} {$pro->getCodigo} {$pro->getNome()} {$pro->getMarca()} {$pro->getCaracteristica()}</span></td>

			<td align=\"center\"><span style=\"".$estilo_texto."\"> {$pro->getQuantidade()} </span></td>";

			if($cor == '#eaeaea'){

				$cor = '#ffffff';

			}else{

				$cor = '#eaeaea';

			}

			$i++;

		}

		

		$carrinho .= "</table>";

		

		 

		// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)

		// ******** OBS: SE FOR ADICIONAR NOVOS CAMPOS, ADICIONE OS CAMPOS NA VARIÁVEL ABAIXO *************

		$configuracao_da_mensagem_original="

		 

		<strong>ENVIADO POR:</strong><br /><br/>

		

		<b>Nome: </b>$nome<br />

		<b>$pessoa</b>$nome<br />

		<b>Razão Social: </b>$razao<br />

		<b>CNPJ: </b>$cnpj<br />

		<b>CPF: </b>$cpf<br />

		<b>E-mail: </b>$email<br />

		<b>DDD + Telefone: </b>$telefone<br />

		<b>DDD + Celular: </b>$celular<br />

		<b>Endereço: </b>$endereco<br />

		<b>Cidade: </b>$cidade<br />

		<b>UF: </b>$uf<br /><br />

		

		$carrinho<br /><br />

		

		ENVIADO EM: $date";

		 

		//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA

		// CASO $assunto_digitado_pelo_usuario="s" ESSA VARIAVEL RECEBERA AUTOMATICAMENTE A CONFIGURACAO

		// "Re: $assunto"

		$assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Pedido de Orçamento";

		$cabecalho_da_mensagem_de_resposta = "From: $nome_do_site <$email_para_onde_vai_a_mensagem>\n";

		$configuracao_da_mensagem_de_resposta="

		 

		Em breve entraremos em contato para lhe enviar seu orçamento! <br /><br />

		

		$configuracao_da_mensagem_original<br /><br />

		

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

				

		//if(mail($seuemail,$assunto,$mens,$headers)){
		if(sendMail($seuemail,"Sacramento",utf8_decode($mens),$assunto)){
			//mail($seuemail,$assunto,$mens,$headers)
			sendMail('marcone.lima@gmail.com',"Sacramento",utf8_decode($mens),$assunto);
			sendMail('luiz@cianodigital.com.br',"Sacramento",utf8_decode($mens),$assunto);
		
			echo "<font style='color:#CC0000'>Seu orçamento foi enviado com sucesso, em breve retornaremos, obrigado.</font>";

		}else{

			

			echo "<font style='color:#CC0000'>Não foi possível enviar o pedido de orçamento! Tente novamente.</font>";

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

	

		//if(mail($email,$assunto,$mensagem,$headers)){
		if(sendMail($email,$nome,utf8_decode($mensagem),$assunto)){
			sendMail('marcone.lima@gmail.com',$nome,utf8_decode($mensagem),$assunto);
			sendMail('luiz@cianodigital.com.br',$nome,utf8_decode($mensagem),$assunto);
			//mail('luiz@cianodigital.com.br',$assunto,$mensagem,$headers);
			//mail('marcone.lima@gmail.com',$assunto,$mensagem,$headers);

			unset($nome, $email, $assunto, $mensagem,$celular, $endereco, $razao, $carrinhoSessao, $_SESSION['carrinho'], $_SESSION['criar'],$_SESSION['qtde']);

			

			

		}

	} else {

		echo $retorno;

	}

}

?>

<script type="text/javascript">



function menos(i){

	

	qtde = document.getElementById('qtde'+i).value;

	qtde--;

	qtde2 = qtde;

	if(qtde2 <= 0){

		qtde2 = 0;

	}

	document.getElementById('qtde'+i).value = qtde2; 

	

}



function mais(i){

	

	qtde = document.getElementById('qtde'+i).value;

	qtde++;

	qtde2 = qtde;

	

	document.getElementById('qtde'+i).value = qtde2; 

	

}



function ligarcpf(){

	document.getElementById('cpf_div').style.display = 'block';

	document.getElementById('cnpj_div').style.display = 'none';

}

function ligarcnpj(){

	document.getElementById('cpf_div').style.display = 'none';

	document.getElementById('cnpj_div').style.display = 'block';

}

</script>

				

                <div id="corpo">

                	<?php include "busca.php"; ?>

                    <div style="width:100%; height:50px; position:relative; float:left;" >

                    <div id="topo_corpo_interno"><span class="texto_menu">Pedido de orçamento:</span></div>

                    </div>

                

                	<?php if(isset($_POST['pedirorcamento_y'])){ ?>

                    <div style="width:100%; height:15px; position:relative; float:left; margin-left:20px; margin-bottom:10px; font-family:Calibri, Verdana, Geneva, sans-serif; font-size:9pt; color:#C00;">* campo obrigatório</div>

                    <div id="formulario_orcamento"> 

                        <form action="" method="post" enctype="multipart/form-data" name="form_orcamento"> 

                        <input type="hidden" name="enviar" value="enviar" />

                        

                        <span class="texto_contato">Nome *</span>

                        <input class="input_contato" type="text" name="nome" size="75" value="<?php echo $nome;?>" /><br/><br/>

                        

                        <span class="texto_contato"></span>

                        <input  type="radio" name="pessoa" <?php if($pessoa == 'fisica') { echo "checked"; }?> onclick="ligarcpf();" value="fisica" /><span style="width:100px; height:15px; font-family:Calibri, Verdana, Geneva, sans-serif; font-size:9pt; font-weight:bold; color:#000;">&nbsp;Pessoa Física</span>&nbsp;&nbsp;&nbsp;

                        <input  type="radio" name="pessoa" <?php if($pessoa == 'juridica') { echo "checked"; }?> onclick="ligarcnpj();" value="juridica" /><span style="width:100px; height:15px; font-family:Calibri, Verdana, Geneva, sans-serif; font-size:9pt; font-weight:bold; color:#000;">&nbsp;Pessoa Jurídica</span><br/><br/>

                        <div id="cnpj_div" style="display:none">

                        <span class="texto_contato">CNPJ *</span>

                        <input class="input_contato" type="text" name="cpf" id="cpf" size="75" value="<?php echo $cnpj;?>" /><br/><br/>

                        </div>

                        <div id="cpf_div" style="display:none">

                        <span class="texto_contato">CPF *</span>

                        <input class="input_contato" type="text" name="cpf2" id="cpf2" size="75" value="<?php echo $cpf;?>" /><br/><br/>

                        </div>

                        <span class="texto_contato">Razão Social</span>

                        <input class="input_contato" type="text" name="razao" size="75" value="<?php echo $razao;?>" /><br/><br/>

                        

                        <span class="texto_contato">Email *</span>

                        <input class="input_contato" type="text" name="email" size="35"  value="<?php echo $email; ?>" /><br/><br/>

                        

                        <div style="width:50%; height:auto; position:relative; float:left;">

                        <span class="texto_contato" style="width:300px;">DDD + Telefone *</span>

                        <input class="input_contato" style="width:200px;" type="text" name="telefone"  value="<?php echo $telefone;?>" size="35" maxlength="13" onKeyPress="javascript: m_Telefone(this,10); return v_NR(event)" onKeyDown="javascript: return v_NR(event)" onChange="javascript: m_Telefone(this,10)" /><br/><br/>

                        </div>

                        <div style="width:50%; height:auto; position:relative; float:left;">

                        <span class="texto_contato" style="width:300px;">DDD + Celular</span>

                        <input class="input_contato" style="width:200px;" type="text" name="celular" size="75"  value="<?php echo $celular;?>" maxlength="13" onKeyPress="javascript: m_Telefone(this,10); return v_NR(event)" onKeyDown="javascript: return v_NR(event)" onChange="javascript: m_Telefone(this,10)" /><br/><br/>

                        </div>

                        <span class="texto_contato">Endereço</span>

                        <input class="input_contato" type="text" name="endereco" size="75"  vaue="<?php echo $endereco;?>" /><br/><br/>

                        <div style="width:65%; height:auto; position:relative; float:left;">

                        <span class="texto_contato">Cidade</span>

                        <input class="input_contato" style="width:450px;" type="text" name="cidade" size="75"  value="<?php echo $cidade;?>" /><br/><br/>

                        </div>

                        <div style="width:10%; height:auto; position:relative; float:left;">

                        <span class="texto_contato">UF</span>

                        <select name="uf" class="input_contato" style="width:100px;">  

                            <option value="AC" <?php if($uf == 'AC') { echo "selected"; } ?>>AC</option>  

                            <option value="AL" <?php if($uf == 'AL') { echo "selected"; } ?>>AL</option>  

                            <option value="AM" <?php if($uf == 'AM') { echo "selected"; } ?>>AM</option>  

                            <option value="AP" <?php if($uf == 'AP') { echo "selected"; } ?>>AP</option>  

                            <option value="BA" <?php if($uf == 'BA') { echo "selected"; } ?>>BA</option>  

                            <option value="CE" <?php if($uf == 'CE') { echo "selected"; } ?>>CE</option>  

                            <option value="DF" <?php if($uf == 'DF') { echo "selected"; } ?>>DF</option>  

                            <option value="ES" <?php if($uf == 'ES') { echo "selected"; } ?>>ES</option>  

                            <option value="GO" <?php if($uf == 'GO') { echo "selected"; } ?>>GO</option>  

                            <option value="MA" <?php if($uf == 'MA') { echo "selected"; } ?>>MA</option>  

                            <option value="MG" <?php if($uf == 'MG') { echo "selected"; } ?>>MG</option>  

                            <option value="MS" <?php if($uf == 'MS') { echo "selected"; } ?>>MS</option>  

                            <option value="MT" <?php if($uf == 'MT') { echo "selected"; } ?>>MT</option>  

                            <option value="PA" <?php if($uf == 'PA') { echo "selected"; } ?>>PA</option>  

                            <option value="PB" <?php if($uf == 'PB') { echo "selected"; } ?>>PB</option>  

                            <option value="PE" <?php if($uf == 'PE') { echo "selected"; } ?>>PE</option>  

                            <option value="PI" <?php if($uf == 'PI') { echo "selected"; } ?>>PI</option>  

                            <option value="PR" <?php if($uf == 'PR') { echo "selected"; } ?>>PR</option>  

                            <option value="RJ" <?php if($uf == 'RJ') { echo "selected"; } ?>>RJ</option>  

                            <option value="RN" <?php if($uf == 'RN') { echo "selected"; } ?>>RN</option>  

                            <option value="RO" <?php if($uf == 'RO') { echo "selected"; } ?>>RO</option>  

                            <option value="RR" <?php if($uf == 'RR') { echo "selected"; } ?>>RR</option>  

                            <option value="RS" <?php if($uf == 'RS') { echo "selected"; } ?>>RS</option>  

                            <option value="SC" <?php if($uf == 'SC') { echo "selected"; } ?>>SC</option>  

                            <option value="SE" <?php if($uf == 'SE') { echo "selected"; } ?>>SE</option>  

                            <option value="SP" <?php if($uf == 'SP') { echo "selected"; } ?>>SP</option>  

                            <option value="TO" <?php if($uf == 'TO') { echo "selected"; } ?>>TO</option>  

                        </select>

                        </div><br /><br />

                        <div class="botao_formulario"><input type="image" value="enviar" src="images/btn_enviar2.png" name="enviar" onclick="document.form_orcamento.submit();" /></div>



                        

                        </form>

                   </div>

<?php } else { ?>

    <?php	

	if(!isset($_SESSION['criar'])) {

		$Carrinho = new Carrinho();

		//Joga na sessão

		$_SESSION["carrinho"] = serialize($Carrinho);

		$_SESSION['criar'] = 1;

		$carrinhoSessao = unserialize($_SESSION["carrinho"]);

	}	

	if(isset($_POST['idsubproduto']) && $_POST['idsubproduto'] != ''){	

		$subproduto = $_POST['idsubproduto'];

		$quantidade = $_POST['quantidade'];

		

		$sqlProduto = "SELECT p.nome, p.id, p.marca, s.caracteristica, s.preco, s.codigo, min(f.foto) as foto, c.titulo as categoria, sc.titulo as subcategoria

				FROM tbproduto p inner join tbsubproduto s on p.id = s.produto_id

				inner join tbfotoproduto f on p.id = f.produto_id

				inner join tbsubcategoriaproduto sc on sc.id = p.subcategoria_id

				inner join tbcategoriaproduto c on c.id = sc.categoria_id

				inner join tbfornecedor fo on fo.id = p.fornecedor_id

				where s.id = $subproduto

				$where group by p.id";

				

				

		$resultadoProduto = $conecta->selecionar($sqlProduto);

		$rsProduto = mysql_fetch_array($resultadoProduto);		

		$produto = $rsProduto['categoria']." ".$rsProduto['subcategoria']." ".$rsProduto['nome'];

		$produto = new Produto($subproduto,$produto,$rsProduto['marca'],$rsProduto['foto'],$rsProduto['tamanho'],$rsProduto['cor'],$rsProduto['unidade'],$quantidade, $rsProduto['codigo'],$rsProduto['preco'], $rsProduto['id']);

		//Adiciona produto 1

		$carrinhoSessao->addProduto($produto);	

		$_SESSION['qtde'] = $_SESSION['qtde'] + 1;

	}	

	?>	

    <div id="topo_corpo_interno"><span class="texto_menu">Produtos no meu orçamento:</span></div>

	<?php	

	if($_SESSION['qtde'] > 0){

	?>

    <form name="formCarrinho" method="post" enctype="multipart/form-data" action="index.php?pagina=carrinho">

    <?php

		

		$carrinhoSessao->listar();

		echo '<div id="botao_orcamento">

					

		<input type="image" src="images/enviar_orcamento.png" onclick="submit" name="pedirorcamento" />&nbsp;&nbsp;

			<a href="index.php?pagina=produto"><img src="images/continuar_orcamento.png" alt="" border="0" /></a>

			</div>';		

	?>

	</form>

    <?php

	}else{

		echo "<br /><br /><br /><span class='label_informacao_interno_produto'>Não existem produtos no seu carrinho</span>";

	}

	$_SESSION["carrinho"] = serialize($carrinhoSessao);

	?>

<?php } ?>



            	</div>
                
<!-- Google Code for Or&ccedil;amento Conclu&iacute;do Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1043928575;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "M0crCKecn1YQ_6vk8QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" 
src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" 
src="//www.googleadservices.com/pagead/conversion/1043928575/?label=M0crCKecn1YQ_6vk8QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>