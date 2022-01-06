<?php
@include('mpdf/mpdf.php');
?>
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

    if (@$_SESSION['cliente'] != '' && isset($_SESSION['carrinho'])) {

        if ($_POST) {
            for ($i = 0; $i <td (count($_POST) / 3); $i++) {
                if ($pro = $carrinhoSessao->getProduto($_POST['prodid' . $i])) {
                    $pro->setQuantidade($_POST['qtde_prod' . $i]);
                    $pro->setComplemento($_POST['message' . $i] . "<br/><br/>" . $pro->getComplemento());
                }
            }
        }
        $_SESSION["carrinho"] = serialize($carrinhoSessao);

        $sqlCliente = "SELECT c.*
					FROM tbcliente c
					where c.id = " . $_SESSION['cliente'];

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
					where p.id = " . $pro->getId() . " AND f.destaque = 1";

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

                $preco = $preco > 0 ? $preco + $preco * 0.2 : 0;
                $preco_promocional = $preco_promocional > 0 ? $preco_promocional + $preco_promocional * 0.2 : 0;

                $preco = $preco_promocional > 0 ? $preco_promocional : $preco;

                $preco_total_produto = $preco_total_produto + ($preco * $pro->getQuantidade());

                $preco_total_carrinho = $preco_total_carrinho + $preco_total_produto;

                $produto = [
                    "produtoCodigo" => $rs_produto1['codigo'],
                    "quantidade" => $pro->getQuantidade(),
                    "valorLiquido" => ($preco * $pro->getQuantidade()),
                    "valorUnitario" => $preco,
                    "valorDesconto" => 0,
                    "unidade" => $produto->{'produtos'}[$i]->{'unidade'},
                    "unidadeQuantidade" => $produto->{'produtos'}[$i]->{'unidadeQuantidade'}
                ];

                array_push($itens, $produto);

                $configuracao_da_mensagem_original .= "<tr>
                    <td><img src='" . $siteUrl . "source/Produtos/" . $pro->getFoto() . "' alt='' width='60'/></td>
                    <td>" . $pro->getReferencia() . "</td>
                    <td>" . $pro->getNome() . "</td>
                    <td>" . $pro->getQuantidade() . "</td>
                    <td>" . number_format($preco, 2, ",", ".") . "</td>
                    <td>" . number_format($preco_total_produto, 2, ",", ".") . "</td>
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
                    <td colspan='5'>Total do Carrinho</td>
                    <td>" . number_format($preco_total_carrinho, 2, ",", ".") . "</td>
                </tr>
                </table><br>
                <br>
                Enviada em $date por:<br>
                <br>
                Industria Sacramento</a>";
        } else {

            // FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
            $assunto =  "Pedido de Orçamento";
            $cabecalho_da_mensagem_original = "From: " . utf8_decode($rs_configuracao['nomeloja']) . " <" . $rs_configuracao['emailloja'] . ">\n";
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

        //#################################################################################################################################################################       
        $preco_total_carrinho = 0;

        $sql = "SELECT * FROM tbpedido WHERE id = $idPedido";
        $resultado = $conecta->selecionar($conecta->conn, $sql);
        $rs = mysqli_fetch_array($resultado);

        $sql_cliente = "SELECT * FROM tbcliente WHERE id = " . $rs['cliente_id'];
        $resultado_cliente = $conecta->selecionar($conecta->conn, $sql_cliente);
        $rs_cliente = mysqli_fetch_array($resultado_cliente);

        $sql_pedido_produto = "SELECT pp.*, p.nome, p.codigo, p.id as produto, pp.cor_tamanho as cte, ptc.cor, ptc.tamanho FROM tbpedido_produto pp INNER JOIN tbproduto p ON p.id = pp.produto_id LEFT JOIN tbprod_tamanhocor ptc ON ptc.id = pp.cor_tamanho WHERE pedido_id = " . $rs['id'];
        $resultado_pedido_produto = $conecta->selecionar($conecta->conn, $sql_pedido_produto);

        $html_pdf = '<div class="table-responsive">
        <table border="0" width="100%" style="font:15px arial;" cellpadding="3" cellspacing="3">
			<tr>
				<td colspan="5" align="center"><img src="images/sacramento_pdf.jpeg" class="logo_painel" height="50" /></td>
			</tr>
			<tr>
				
				<td colspan="5">' . str_replace("<br />", "", $rs_configuracao['enderecoloja']) . ' <br/> ' . $rs_configuracao['emailloja'] . ' | ' . $rs_configuracao['telefoneloja'] . '</td>
			</tr>
			<tr>
				<td style="height:5px; width:100%; float:left;" colspan="6"></td>
			</tr>
			<tr>
				<td style="height:5px; width:100%; float:left; background:#eaeaea;" colspan="6"></td>
			</tr>
            ';
        $html_pdf .= '</table>
      </div>';

        $html_pdf .= '<div class="table-responsive" style="border:2px solid #000;">
				<table class="table table-hover tabela_ficha" width="100%" cellspacing="0" cellpadding="0" style="font:13px arial;">
                    <tr>
						<td colspan="2"><strong>Cliente:</strong> ' . $rs_cliente['nome'] . '</td>
                        <td width="25%"><strong>Telefone:</strong> ' . $rs_cliente['telefone'] . '</td>
                        <td ><strong>Celular:</strong> ' . $rs_cliente['celular'] . '</td>
					</tr>
                    <tr>
						<td colspan="3"><strong>Endereço:</strong> ' . $rs_cliente['logradouro'] . ', ' . $rs_cliente['numero'] . '</td>
                        <td width="25%"><strong>CEP:</strong> ' . $rs_cliente['cep'] . '</td>
					</tr>
                    <tr>
						<td width="25%"> <strong>Bairro:</strong> ' . $rs_cliente['bairro'] . '</td>
                        <td colspan="2"><strong>Cidade:</strong> ' . $rs_cliente['cidade'] . '</td>
                        <td width="25%"><strong>UF:</strong> ' . $rs_cliente['estado'] . '</td>
					</tr>
                    <tr>
						<td colspan="2"><strong>CNPJ:</strong> ' . $rs_cliente['cnpj'] . '</td>
                        <td colspan="2"><strong>Cidade:</strong> ' . ($rs_cliente['inscricaoestadual'] != '' ? $rs_cliente['inscricaoestadual'] : '') . '</td>
					</tr>
					<tr>
						<td colspan="3"><strong>E-mail:</strong> ' . $rs_cliente['email'] . '</td>
                        <td colspan="3"><strong>Whatsapp-mail:</strong> ' . $rs_cliente['whatsapp'] . '</td>						
					</tr>
				</table>
				
				</div>
				
				<div class="table-responsive">
				<table class="table table-hover tabela_ficha" width="100%" border="0" cellpadding="0" cellspacing="0" style="font:13px arial;">
                    <tr>
						<td colspan="6" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="6" align="center"><strong>PEDIDO</strong></td>
					</tr>
                    <tr><td colspan="6"><table class="table table-hover tabela_ficha" width="100%" border="0" cellpadding="0" cellspacing="0" style="font:13px arial;">';

        $html_pdf .= '<tr>
						<td width="30%"><strong>Produto</strong></td>
						<td width="15%" align="center"><strong>Quantidade</strong></td>
                        <td width="10%" align="center"><strong>Unidade</strong></td>
						<td width="15%"></td>
						<td width="15%"><strong>Preço</strong></td>
                        <td width="15%"><strong>Subtotal</strong></td>
					</tr>';

        while ($rs_pedido_produto = mysqli_fetch_array($resultado_pedido_produto)) {

            $preco_total_produto = 0;
            $preco = 0;;
            $preco_promocional = 0;
            $estoque = 0;
            $ativo = 0;
            $unidade = '';
            $unidadeDescricao = '';

            $produtos = $API->getProdutoEstoque($rs_pedido_produto['codigo']);

            $produto = json_decode($produtos);

            $i = 0;

            $preco = $produto->{'produtos'}[$i]->{'preco'};
            $preco_promocional = $produto->{'produtos'}[$i]->{'precoPromocional'};
            $estoque = $produto->{'produtos'}[$i]->{'estoque'};
            $ativo = $produto->{'produtos'}[$i]->{'ativo'};
            $unidade = $produto->{'produtos'}[$i]->{'unidade'};
            $unidadeDescricao = $produto->{'produtos'}[$i]->{'unidadeDescricao'};

            $preco = $preco > 0 ? $preco + $preco * 0.2 : 0;
            $preco_promocional = $preco_promocional > 0 ? $preco_promocional + $preco_promocional * 0.2 : 0;

            $preco = $preco_promocional > 0 ? $preco_promocional : $preco;

            $preco_total_produto = $preco_total_produto + ($preco * $rs_pedido_produto['quantidade']);

            $preco_total_carrinho = $preco_total_carrinho + $preco_total_produto;


            $html_pdf .= '<tr>
						<td width="30%">' . $rs_pedido_produto['nome'] . '</td>
						<td width="15%" align="center">' . $rs_pedido_produto['quantidade'] . "x" . '</td>
                        <td width="10%" align="center">' . $unidadeDescricao . '</td>
						<td width="15%">' . ($rs_pedido_produto['cor'] != '' ? $rs_pedido_produto['cor'] : '') . (($rs_pedido_produto['cor'] != '' && $rs_pedido_produto['tamanho'] != '') ? ' | ' : '') . ($rs_pedido_produto['tamanho'] != '' ? $rs_pedido_produto['tamanho'] :  '') . '</td>
						<td width="15%">' . number_format($preco, 2, ",", ".") . '</td>
                        <td width="15%">' . number_format($preco_total_produto, 2, ",", ".") . '</td>
					</tr>';
        }

        $html_pdf .= '</td>
                    </tr>
                    </table><tr>
						<td colspan="5"><strong>Total pedido</strong></td>						
                        <td><strong>' . number_format($preco_total_carrinho, 2, ",", ".") . '</strong></td>
					</tr>                
                </table>
				</div>';


        $mpdf = new mPDF('pt', 'A4', 3, '', 10, 10, 2, 10, 9, 9, 'P');

        $mpdf->WriteHTML($html_pdf);

        $arquivoOrcamento = $_SERVER['DOCUMENT_ROOT'] . "/testenovo/orcamentos/pedido_" . $rs['id'] . "_" . $rs_cliente['nome'] . ".pdf";

        $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . "/testenovo/orcamentos/pedido_" . $rs['id'] . "_" . $rs_cliente['nome'] . ".pdf", "F");
        //#################################################################################################################################################################       

        $data = array();

        $enderecoEntrega =  [
            "codigo" => 0,
            "logradouro" => $rs_cliente['logradouro'],
            "numero" => $rs_cliente['numero'],
            "cep" => str_replace("-", "", str_replace(".", "", $rs_cliente['cep'])),
            "bairro" => $rs_cliente['bairro'],
            "cidade" => $rs_cliente['cidade'],
            "ufSigla" => $rs_cliente['estado']
        ];

        $enderecoCobranca = [
            "codigo" => 0,
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

        if ($rs_cliente['tipodocumento'] == 'cnpj') {
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
            "valorLiquido" => $preco_total_carrinho,
            "valorFrete" => 0,
            "observacao" => "",
            "naturezaOperacao" => "WEB",
            "valorDesconto" => 0,
            "dataEmissao" => date('d/m/Y'),
            "horaEmissao" => date("H:i:s"),
            "observacaoFiscal1" => "",
            "items" => $itens,
            "pagamentos" => $pagamentos
        ];

        $data_json = json_encode($data);

        try {
            //$response = $API->setPedido($data_json);

            // $resposta33 = json_decode($response, JSON_UNESCAPED_UNICODE);

            //$strposm = strpos($response, "mensagemUsuario");

            // $strpos = strpos($response, "status");
            // $mensagemUsuario = substr($response, $strposm + 18, ($strpos-3)-($strposm+18));
            //$status = substr($response, $strpos+8,3);

            $mensagemUsuario  = "ERROR";
            $status = 200;

            if (isset($status) && $status == 200) {
                //echo '<div class="alert alert-success">Pedido enviado com Sucesso!</div>';

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
                    $mail->Password   = 'G4p2f5D3@sac';                               //SMTP password
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

                    $mail->addAttachment($arquivoOrcamento);

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
				Indústria Sacramento";

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
                            $mail->Password   = 'G4p2f5D3@sac';                               //SMTP password
                            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
                            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                            //Recipients
                            $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
                            $mail->addAddress($email, utf8_decode($name));     //Add a recipient

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = utf8_decode($assunto_da_mensagem_de_resposta);
                            $mail->Body    = utf8_decode($configuracao_da_mensagem_de_resposta);

                            $mail->addAttachment($arquivoOrcamento);

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
            } else {
                echo '<div class="alert alert-danger">Problema ao enviar Orçamento! ' . $mensagemUsuario . ' Entre em contato com o Administrador!</div>';
                //exit;
            }
        } catch (Exception $e) {
            echo $e->getMessage() . " " . $e->getCode();
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
                        <form action="<?php echo $siteUrl;?>/catalogo/21" method="post" enctype="multipart/form-data">
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
                            <span> - Salve seus dados e facilite pedidos futuros</span><br>
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