<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Produtos para Orçamento</h2>
        <!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl; ?>">Home</a></li>
			<li class="active">Produtos</li>
			<li class="active">Orçamento</li>
		</ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">
    <?php
    if ($_POST) {
        for ($i = 0; $i < (count($_POST) / 3); $i++) {
            if ($pro = $carrinhoSessao->getProduto($_POST['prodid' . $i])) {
                $pro->setQuantidade($_POST['qtde_prod' . $i]);
                $pro->setComplemento($_POST['message' . $i] . "<br/><br/>" . $pro->getComplemento());
            }
        }
    }
    $_SESSION["carrinho"] = serialize($carrinhoSessao);

    if (@$_SESSION['cliente'] != '' && isset($_SESSION['carrinho'])) {

         $sqlCliente = "SELECT c.*
					FROM tbcliente c
					where c.id = ". $_SESSION['cliente'];

        $resultadoCliente = $conecta->selecionar($conecta->conn, $sqlCliente);
        $rs_cliente = mysqli_fetch_array($resultadoCliente);

        $name = $_SESSION['nome_cliente'];
        $email = $_SESSION['email_cliente'];
        $telefone = $_SESSION['telefone_cliente'];


        $dadospedido['tbpedido']['cliente_id'] = $_SESSION['cliente'];
        $dadospedido['tbpedido']['data_pedido'] =  date('Y-m-d');
        $dadospedido['tbpedido']['status_pedido'] = 1;

        $idPedido = $conecta->inserirID($dadospedido);

        $date = date("d/m/Y h:i");

        if (@$_SESSION['cliente'] > 0) {
            $API = new ComunicacaoAPI();

            if (empty($_SESSION['token_api']) || $_SESSION['token_api'] == 'erro') {

                $API->getToken('http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/autenticacao/entrar');

                $_SESSION['token_api'] = $API->token;
            } else {
                $API->token = $_SESSION['token_api'];
            }

            $preco_total_carrinho = 0;

            // FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
            $assunto =  "Pedido de Orçamento";
            $cabecalho_da_mensagem_original = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
            $configuracao_da_mensagem_original = "<strong>Orçamento " . $rs_configuracao['nomeloja'] . ":</strong><br>
                <br>
                De: " . $name . "<br>
                Responder para: " . $email . "<br>
                Telefone: " . $telefone . "<br>
                Assunto: Pedido de Orçamento<br>
                <br>
                <strong>Produtos Solicitados:</strong><br>
                <br>
                <table width='100%' border='1'>
                <tr>
                    <td>Foto</td>
                    <td>Código</td>
                    <td>Nome</td>
                    <td>Quantidade</td>
                    <td>Observação</td>
                    <td>Preço</td>
                    <td>Total</td>
                </tr>";
            $i = 0;
            $itens = array();
            foreach ($carrinhoSessao->getProdutos() as $pro) :

                $preco_total_produto = 0;
                $preco = 0;;
                $preco_promocional = 0;
                $estoque = 0;
                $ativo = 0;
                $unidade = '';

                $sqlProduto1 = "SELECT p.nome, p.codigo, p.id, p.marca, p.referencia, p.modelo, p.preco_promocional, p.preco, p.data_promocional_inicio, p.data_promocional_fim, p.descricao, p.peso, p.altura, p.comprimento, p.largura, c.titulo as categoria, sc.titulo as subcategoria, f.foto, f.legenda
					FROM tbproduto p inner join tbprod_subcategoria sc on sc.id = p.subcategoria_id
					inner join tbprod_categoria c on c.id = sc.categoria_id
					inner JOIN tbprod_foto f ON f.produto_id = p.id
					where p.id = ".$pro->getId()." AND f.destaque = 1";

                $resultadoProduto1 = $conecta->selecionar($conecta->conn, $sqlProduto1);
                $rs_produto1 = mysqli_fetch_array($resultadoProduto1);

                $produtos = $API->getProdutoEstoque($rs_produto1['codigo']);

                $produto = json_decode($produtos);

                $i = 0;

                $preco = $produto->{'produtos'}[$i]->{'preco'};
                $preco_promocional = $produto->{'produtos'}[$i]->{'precoPromocional'};
                $estoque = $produto->{'produtos'}[$i]->{'estoque'};
                $ativo = $produto->{'produtos'}[$i]->{'ativo'};
                $unidade = $produto->{'produtos'}[$i]->{'unidade'};

                $preco = $preco_promocional > 0 ? $preco_promocional : $preco;

                $preco_total_produto = $preco_total_produto + ($preco * $pro->getQuantidade());

                $preco_total_carrinho = $preco_total_carrinho + $preco_total_produto;

                $produto = ["produtoCodigo"=> $rs_produto1['codigo'],
                    "quantidade"=> $pro->getQuantidade(),
                    "valorLiquido"=> ($preco * $pro->getQuantidade()),
                    "valorUnitario"=> $preco,
                    "valorDesconto"=> 0,
                    "unidade"=> $produto->{'produtos'}[$i]->{'unidade'},
                    "unidadeQuantidade"=> $produto->{'produtos'}[$i]->{'unidadeQuantidade'}
                ];

                array_push($itens, $produto);

                $configuracao_da_mensagem_original .= "<tr>
                    <td><img src='" . $siteUrl . "source/Produtos/" . $pro->getFoto() . "' alt='' width='60'/></td>
                    <td>" . $pro->getReferencia() . "</td>
                    <td>" . $pro->getNome() . "</td>
                    <td>" . $pro->getQuantidade() . "</td>
                    <td>" . $pro->getComplemento() . "<br/><br/>" . $_POST['message' . $i] . "</td>
                    <td>" . $preco . "</td>
                    <td>" . $preco_total_produto . "</td>
                </tr>";


                $dadosproduto['tbpedido_produto']['pedido_id'] = $idPedido;
                $dadosproduto['tbpedido_produto']['produto_id'] = substr($pro->getId(), 0, (stripos($pro->getId(), "_") > 0 ? stripos($pro->getId(), "_") : strlen($pro->getId())));
                $dadosproduto['tbpedido_produto']['cor_tamanho'] = substr($pro->getId(), (stripos($pro->getId(), "_") > 0 ? stripos($pro->getId(), "_") + 1 : strlen($pro->getId())), strlen($pro->getId()));
                $dadosproduto['tbpedido_produto']['quantidade'] = $pro->getQuantidade();
                $dadosproduto['tbpedido_produto']['observacao'] = str_replace("<br/>", "", $pro->getComplemento()) . "<br/><br/>" . str_replace("<br/>", "", $_POST['message' . $i]);

                $idPedidoProduto = $conecta->inserirID($dadosproduto);

                $i++;
            endforeach;
            $configuracao_da_mensagem_original .= "<tr>
                    <td colspan='6'>Total do Carrinho</td>
                    <td>" . $preco_total_carrinho . "</td>
                </tr>
                </table><br>
                <br>
                Enviada em $date por:<br>
                <br>
                Industria Sacramento</a>";

        }else {

            // FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
            $assunto =  "Pedido de Orçamento";
            $cabecalho_da_mensagem_original = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
            $configuracao_da_mensagem_original = "<strong>Orçamento " . $rs_configuracao['nomeloja'] . ":</strong><br>
                <br>
                De: " . $name . "<br>
                Responder para: " . $email . "<br>
                Telefone: " . $telefone . "<br>
                Assunto: Pedido de Orçamento<br>
                <br>
                <strong>Produtos Solicitados:</strong><br>
                <br>
                <table width='100%' border='1'>
                <tr>
                    <td>Foto</td>
                    <td>Código</td>
                    <td>Nome</td>
                    <td>Quantidade</td>
                    <td>Observação</td>
                </tr>";
            $i = 0;
            foreach ($carrinhoSessao->getProdutos() as $pro) :

                $configuracao_da_mensagem_original .= "<tr>
                    <td><img src='" . $siteUrl . "source/Produtos/" . $pro->getFoto() . "' alt='' width='60'/></td>
                    <td>" . $pro->getReferencia() . "</td>
                    <td>" . $pro->getNome() . "</td>
                    <td>" . $pro->getQuantidade() . "</td>
                    <td>" . $pro->getComplemento() . "<br/><br/>" . $_POST['message' . $i] . "</td>
                </tr>";


                $dadosproduto['tbpedido_produto']['pedido_id'] = $idPedido;
                $dadosproduto['tbpedido_produto']['produto_id'] = substr($pro->getId(), 0, (stripos($pro->getId(), "_") > 0 ? stripos($pro->getId(), "_") : strlen($pro->getId())));
                $dadosproduto['tbpedido_produto']['cor_tamanho'] = substr($pro->getId(), (stripos($pro->getId(), "_") > 0 ? stripos($pro->getId(), "_") + 1 : strlen($pro->getId())), strlen($pro->getId()));
                $dadosproduto['tbpedido_produto']['quantidade'] = $pro->getQuantidade();
                $dadosproduto['tbpedido_produto']['observacao'] = $pro->getComplemento() . "<br/><br/>" . $_POST['message' . $i];

                $idPedidoProduto = $conecta->inserirID($dadosproduto);

                $i++;
            endforeach;
            $configuracao_da_mensagem_original .= "</table><br>
                <br>
                Enviada em $date por:<br>
                <br>
                Industria Sacramento</a>";
        }

        $data = array();
        
        $enderecoEntrega =  [
            "codigo"=> 0,
            "logradouro"=> $rs_cliente['logradouro'],
            "numero"=> $rs_cliente['numero'],
            "cep"=> str_replace("-","", str_replace(".","",$rs_cliente['cep'])),
            "bairro"=> $rs_cliente['bairro'],
            "cidade"=> $rs_cliente['cidade'],
            "ufSigla"=> $rs_cliente['estado']
        ];
        
        $enderecoCobranca = [
            "codigo"=> 0,
            "logradouro" => $rs_cliente['logradouro'],
            "numero" => $rs_cliente['numero'],
            "cep" => str_replace("-", "", str_replace(".", "", $rs_cliente['cep'])),
            "bairro" => $rs_cliente['bairro'],
            "cidade" => $rs_cliente['cidade'],
            "ufSigla" => $rs_cliente['estado']
        ];

        $enderecosCliente = [
            "codigo" => 0,
            "logradouro" => $rs_cliente['logradouro'],
            "numero" => $rs_cliente['numero'],
            "cep" => str_replace("-", "", str_replace(".", "", $rs_cliente['cep'])),
            "bairro" => $rs_cliente['bairro'],
            "cidade" => $rs_cliente['cidade'],
            "ufSigla" => $rs_cliente['estado']
        ];

        if($rs_cliente['tipodocumento'] == 'cnpj'){
            $cliente = [
                "codigo" => 0,
                "razaoSocial" => $rs_cliente['nome'],
                "cnpj" => $rs_cliente['cnpj'],
                "inscricaoEstadual" => $rs_cliente['inscricaoestadual'],
                "email" => $rs_cliente['email'],
                "tipo" => "J",
                "sexo" => "",
                "telefone" => $rs_cliente['telefone'],
                "telefone2" => $rs_cliente['celular'],
                "celular" => $rs_cliente['celular'],
                "enderecos" => $enderecosCliente
            ];

        } else if ($rs_cliente['tipodocumento'] == 'cpf') {
            $cliente = [
                "codigo" => 0,
                "razaoSocial" => $rs_cliente['nome'],
                "cnpj" => $rs_cliente['cnpj'],
                "email" => $rs_cliente['email'],
                "tipo" => "F",
                "sexo" => "",
                "telefone" => $rs_cliente['telefone'],
                "telefone2" => $rs_cliente['celular'],
                "celular" => $rs_cliente['celular'],
                "enderecos" => $enderecosCliente
            ];
        }

        

        $pagamentos = [
            "formaPagamento" => "boleto",
            "numeroParcelas" => 1,
            "valorPago" => $preco_total_carrinho 
        ];

        $data = [
            "numeroOrigem" => $idPedidoProduto,
            "enderecoEntrega" => $enderecoEntrega,
            "enderecoCobranca" => $enderecoCobranca,
            "cliente" => $cliente,
            "valorLiquido"=> $preco_total_carrinho,
            "valorFrete"=> 0,
            "observacao"=> "",
            "naturezaOperacao"=> "WEB",
            "valorDesconto"=> 0,
            "dataEmissao"=> date('d/m/Y'),
            "horaEmissao"=> date("H:i:s"),
            "observacaoFiscal1"=> "",
            "items" => $itens,
            "pagamentos"=> $pagamentos
        ];

        $data_json = json_encode($data);

        try {
            $response = $API->setPedido($data_json);

            $resposta = json_decode($response);
            $respostas = json_encode($response);

            echo '<pre>';
            print_r($response);
            echo '</pre>';

            var_dump($resposta);
            var_dump($resposta2);

            if (isset($resposta->status) && $resposta->status === 200) {
                echo '<div class="alert alert-success">Pedido enviado com Sucesso!</div>';
            } else {
                echo '<div class="alert alert-danger">Problema ao enviar Orçamento! '.$resposta->mensagemUsuario.'. Entre em contato com o Administrador!</div>';
            }
        } catch (Exception $e) {
            echo $e->getMessage()." ".$e->getCode();
        }
        

        //ENVIO DE MENSAGEM ORIGINAL
        $headers = "$cabecalho_da_mensagem_original";
        $headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $emailcaixa = 'vendas_site@industriasacramento.com.br';

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtps.uhserver.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vendas_site@industriasacramento.com.br';                     //SMTP username
            $mail->Password   = 'G4p2f5D3@2';                               //SMTP password
            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
            //$mail->addAddress($email, $name);     //Add a recipient
            $mail->addAddress($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode($assunto);
            $mail->Body    = utf8_decode($configuracao_da_mensagem_original);
            
            if ($mail->send()) {
                //echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';

                echo '<!-- Pedido recebido com sucesso -->
					<section class="page-section" style="padding-top: 40px">
						<div class="container">
							<h1><b>Sue pedido foi recebido com sucesso!</b><br/><br/>Em breve iremos entrar em contato para lhe enviar a sua Orçamento!</h1>
							<p>Obrigado por escolher a ' . $rs_configuracao['nomeloja'] . '!</p>
						</div>
					</section>

		<!-- /Pedido Recebido com sucesso -->';

                //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
                $assunto_da_mensagem_de_resposta = "Recebemos seu pedido de Orçamento";
                $cabecalho_da_mensagem_de_resposta = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
                $configuracao_da_mensagem_de_resposta = "Prezado(a) " . $name . ",<br>
				Obrigado por entrar em contato, sue pedido de Orçamento foi enviada para " . $rs_configuracao['nomeloja'] . ".<br>
				Em breve lhe responderemos.<br>
				<br>
				Atenciosamente,<br>
				" . $rs_configuracao['nomeloja'] . "<br>
				<br>
				<a href='" . $rs_configuracao['linkloja'] . "'>" . $rs_configuracao['linkloja'] . "</a><br>
                <br>
                Recebido em: $date<br>
				Industria Sacramento";

                //ENVIO DE MENSAGEM RESPOSTA
                $headers = "$cabecalho_da_mensagem_de_resposta";
                $headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                $emailcaixa = 'vendas_site@industriasacramento.com.br';

                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtps.uhserver.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'vendas_site@industriasacramento.com.br';                     //SMTP username
                    $mail->Password   = 'G4p2f5D3@2';                               //SMTP password
                    $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
                    $mail->addAddress($email, $name);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = utf8_decode($assunto_da_mensagem_de_resposta);
                    $mail->Body    = utf8_decode($configuracao_da_mensagem_de_resposta);

                    $mail->send();
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">Problema ao enviar Orçamento 1!</div>';
                }

                //unset($_SESSION['carrinho'], $_SESSION['qtde'], $_SESSION['criar'], $dadospedido, $dadosproduto);
            }
            unset($_SESSION['carrinho'], $_SESSION['qtde'], $_SESSION['criar'], $dadospedido, $dadosproduto);
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Problema ao enviar Orçamento 2!</div>';
        }
        /*
			if(mail($rs_configuracao['emailloja'],$assunto,$configuracao_da_mensagem_original,$headers)){

				echo '<!-- Pedido recebido com sucesso -->
					<section class="page-section" style="padding-top: 40px">
						<div class="container">
							<h1><b>Sue pedido foi recebido com sucesso!</b><br/><br/>Em breve iremos entrar em contato para lhe enviar a sua Orçamento!</h1>
							<p>Obrigado por escolher a '.$rs_configuracao['nomeloja'].'!</p>
						</div>
					</section>

		<!-- /Pedido Recebido com sucesso -->';

				//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
				$assunto_da_mensagem_de_resposta = "Recebemos seu pedido de Orçamento";
				$cabecalho_da_mensagem_de_resposta = "From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
				$configuracao_da_mensagem_de_resposta="Prezado(a) ".$name.",<br>
				Obrigado por entrar em contato, sue pedido de Orçamento foi enviada para ".$rs_configuracao['nomeloja'].".<br>
				Em breve lhe responderemos.<br>
				<br>
				Atenciosamente,<br>
				".$rs_configuracao['nomeloja']."<br>
				<br>
				<a href='".$rs_configuracao['linkloja']."'>".$rs_configuracao['linkloja']."</a><br>
<br>
Recebido em: $date<br>
				Industria Sacramento";

				//ENVIO DE MENSAGEM RESPOSTA
				$headers = "$cabecalho_da_mensagem_de_resposta";
				$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

				mail($mail,$assunto_da_mensagem_de_resposta,$configuracao_da_mensagem_de_resposta,$headers);


				unset($_SESSION['carrinho'], $_SESSION['qtde'],$_SESSION['criar'], $dadospedido, $dadosproduto);


			} else {
				echo '<div class="alert alert-danger">Problema ao enviar Orçamento!</div>';
			}*/
    } else {
    ?>



        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabelL">Identificação</h4>
                </div>
                <div class="modal-body">
                    <div class="secaoE">
                        <p class="titulo_cadastro">Já Sou Cadastrado</p>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Email</label>
                                <input id="txtEmail" class="form-control" name="email" required="required" type="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input id="txtPassword" class="form-control" name="senha" required="required" type="password" placeholder="">
                            </div>
                            <p>Esqueceu a senha? <a href="#" data-toggle="modal" data-target="#ModalLembrar">Recuperar senha.</a></p>
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success pull-right" type="submit" name="entrar" value="Login">Entrar</button>
                                </div>
                            </div>
                    </div><!-- secaoE-->
                    <div class="secaoD">
                        <p class="titulo_cadastro">Ainda Não Sou Cadastrado</p>
                        <p>
                            <strong>Benefícios de ser cadastrado</strong><br>
                            <span> - Receba promoções e ofertas exclusivas</span><br>
                            <span> - Salve seus dados e facilite orçamentos futuros</span><br>
                            <span> - Orçamentos mais ágeis</span>

                        </p>
                        <p><a class="btn btn-success " href="#" data-toggle="modal" data-target="#ModalRegister">Cadastra-se</a></p>
                    </div><!-- secaoD-->

                    </form>
                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>

    <?php
    }
    ?>