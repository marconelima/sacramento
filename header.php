<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "uteis/bancodados.php";
include "parametros.php";
include "funcoes.php";

require_once('phpmailer/PHPMailerAutoload.php');

include_once("classes/comunicacao.class.php");

$conecta = new Recordset;
$conecta->conexao();

@$pag = @$numpagina;

if (@$pag >= '1') {
    @$pag = @$pag;
} else {
    @$pag = '1';
}
$maximo = '10';
$inicio = ((int)$pag * (int)$maximo) - (int)$maximo;

$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
$rs_configuracao = mysqli_fetch_array($resultado_configuracao);

$resultadoCadastro = "";

//$siteUrl = $rs_configuracao['linkloja'];
//$siteUrl = "http://www.marconesacramento.com.br/";
$siteUrl = "https://www.industriasacramento.com.br/testenovo/";


if (@$tela != '') {
    $sql_tela = "SELECT * FROM tbtela WHERE id = " . $tela;
    $resultado_tela = $conecta->selecionar($conecta->conn, $sql_tela);
    $rs_tela = mysqli_fetch_array($resultado_tela);
}

$sair = 0;
if (isset($_POST['sair']) && @$_POST['sair'] == "1") {
    $sair = 1;
}

if (isset($sair) && $sair == 1) {
    unset($_SESSION['cliente'], $_SESSION['nome_cliente'], $_SESSION['email_cliente'], $_SESSION['cpf_cliente'], $_SESSION['telefone_cliente']);
}

if (isset($_POST['entrar']) && $_POST['entrar'] == "Login") {
    $email = verificar_dados($conecta->conn, $_POST['email']);
    $senha = verificar_dados($conecta->conn, $_POST['senha']);

    $sql_valida = "SELECT c.id as cliente, c.* FROM tbcliente c WHERE c.email = '" . $email . "' AND c.senha = '" . md5($senha) . "'";
    $resultado_valida = $conecta->selecionar($conecta->conn, $sql_valida);

    if ($rs_valida = mysqli_fetch_array($resultado_valida)) {
        $_SESSION['cliente'] = $rs_valida['cliente'];
        $_SESSION['nome_cliente'] = $rs_valida['nome'];
        $_SESSION['email_cliente'] = $rs_valida['email'];
        $_SESSION['telefone_cliente'] = $rs_valida['celular'];
        $_SESSION['cpf_cliente'] = $rs_valida['cnpj'];


        $API = new ComunicacaoAPI();

        if (empty($_SESSION['token_api']) || $_SESSION['token_api'] == 'erro') {

            $API->getToken('http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/autenticacao/entrar');

            $_SESSION['token_api'] = $API->token;
        } else {
            $API->token = $_SESSION['token_api'];
        }


        echo "<script>alert('Seja bem vindo " . $_SESSION['nome_cliente'] . "!')</script>";

        if(($rs_valida['tipodocumento'] == 'cnpj' && ($rs_valida['inscricaoestadual'] == '' || $rs_valida['cnpj'] == '')) || ($rs_valida['tipodocumento'] == 'cpf' && $rs_valida['cnpj'] == '')){
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=" . $siteUrl . "cadastro/66'>";
        } /*else {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=" . $siteUrl . "catalogo/21'>";
        }*/
    } else {
        echo "<script>alert('Houve um problema no login tente novamente!')</script>";
    }
}

if (isset($_POST['enviar']) && $_POST['enviar'] == "Lembrar") {
    $email = verificar_dados($conecta->conn, $_POST['email']);

    $sql_valida = "SELECT c.id as cliente, c.* FROM tbcliente c WHERE c.email = '" . $email . "'";
    $resultado_valida = $conecta->selecionar($conecta->conn, $sql_valida);

    if (!$rs_valida = mysqli_fetch_array($resultado_valida)) {
        $retornoNovaSenha =  "<div class='alert alert-danger'>E-mail não cadastrado!</div>";
    } else {

        $nome = $rs_valida['nome'];

        $string = "id = " . $rs_valida['id'];

        $senha = "";
        $caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $tamanho = 6;
        for ($i = 0; $i < $tamanho; $i++) {
            $senha .= $caracteres{
                rand(0, 62)};
        }
        $senhadeacesso = $senha;

        $dados['tbcliente']['senha'] = md5($senha);

        $resultado = $conecta->alterar($dados, $string);


        $para = $rs_configuracao['emailloja'];

        $headers = "From: $para\n";
        $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

        $date = date("d/m/Y h:i");
        $assunto = "Dados de Acesso a " . $rs_configuracao['nomeloja'];
        $corpo_email = "<strong>Dados de Acesso a " . $rs_configuracao['nomeloja'] . "</strong><br />
							$date<br /><br />
							Olá $nome,<br /><br />
							Você está recebendo os dados de acesso a " . $rs_configuracao['nomeloja'] . ".<br/><br />
							Para acessar o " . $rs_configuracao['nomeloja'] . " acesse:<br /><br>
							<a href='" . $rs_configuracao['linkloja'] . "'>" . $rs_configuracao['nomeloja'] . "</a><br />
							<strong>DADOS DE ACESSO:</strong><br />
							<strong>Usuário:</strong> " . $email . "<br />
							<strong>Senha:</strong> $senhadeacesso<br /><br />
							<br>
							Recebido em: $date<br>
							Industria Sacramento
							
							<br><br>
							- Não responda este e-mail, esta é uma mensagem automática enviada pelo sistema. -";

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $emailcaixa = 'vendas_site@industriasacramento.com.br';

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.uhserver.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vendas_site@industriasacramento.com.br';                     //SMTP username
            $mail->Password   = 'G4p2f5D3@2';                               //SMTP password
            $mail->SMTPSecure = '';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
            //$mail->addAddress($email, $name);     //Add a recipient
            $mail->addAddress($email, utf8_decode($nome));

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode($assunto);
            $mail->Body    = utf8_decode($corpo_email);

            if ($mail->send()) {
                echo '<div class="alert alert-success">Senha enviada para o e-mail cadastrado.</div>';
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Não foi possível reenviar a senha, tente novamente!</div>";
        }
        /*
        if (mail($email, $assunto, $corpo_email, $headers)) {
            $retornoNovaSenha =  "Senha enviada para o e-mail cadastrado.";
            echo "<script>alert('" . $retornoNovaSenha . "')</script>";
        } else {
            echo "<script>alert('Não foi possível reenviar a senha, tente novamente!')</script>";
        }
        */
    }
}

if (isset($_POST['alterarcadastrar']) && @$_POST['alterarcadastrar'] == "cadastrar") {

    $dados['tbcliente']['nome'] = $_POST['regname'];
    $dados['tbcliente']['email'] = $_POST['regemail'];

    if($_POST['regpassword'] != ''){
        $dados['tbcliente']['senha'] = md5($_POST['regpassword']);
    } else {
        unset($dados['tbcliente']['senha']);
    }

    $dados['tbcliente']['tipodocumento'] = $_POST['tipodocumento2'];

    $dados['tbcliente']['telefone'] = $_POST['regphone'];
    $dados['tbcliente']['celular'] = $_POST['regcellphone'];
    $dados['tbcliente']['cidade'] = $_POST['regcidade'];
    $dados['tbcliente']['cnpj'] = $_POST['cnpj'];

    $dados['tbcliente']['inscricaoestadual'] = $_POST['inscricaoestadual'];

    $dados['tbcliente']['logradouro'] = $_POST['logradouro'];
    $dados['tbcliente']['numero'] = $_POST['numero'];
    $dados['tbcliente']['bairro'] = $_POST['bairro'];
    $dados['tbcliente']['estado'] = $_POST['estado'];
    $dados['tbcliente']['cep'] = $_POST['cep'];

    $string = " id = ".$_SESSION['cliente'];

    $resultadoCadastro = $conecta->alterar($dados, $string);

    if ($_POST['regpassword'] != '') {
        if ($cliente) {

            $date = date('Y-m-d H:i:s');
            //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
            $assunto_da_mensagem_de_resposta = "Recebemos seu cadastro";
            $cabecalho_da_mensagem_de_resposta = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
            $configuracao_da_mensagem_de_resposta = "Prezado(a) " . $_POST['regname'] . ",<br>
                Obrigado por se cadastra em " . $rs_configuracao['nomeloja'] . ".<br><br>
                Seguem os dados de acesso:<br>
                <br>
                Usuário: " . $_POST['regemail'] . "<br>
                Senha: " . $_POST['regpassword'] . "<br>
                <br>
                Atenciosamente,<br>
                " . $rs_configuracao['nomeloja'] . "<br>
                <br>
                <a href='" . $rs_configuracao['linkloja'] . "'>" . $rs_configuracao['linkloja'] . "</a><br>
                <br>
                Recebido em: $date<br>
                Industria Sacramento
                
                ";

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
                $mail->Host       = 'smtp.uhserver.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'vendas_site@industriasacramento.com.br';                     //SMTP username
                $mail->Password   = 'G4p2f5D3@2';                               //SMTP password
                $mail->SMTPSecure = '';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
                //$mail->addAddress($email, $name);     //Add a recipient
                $mail->addAddress($dados['tbcliente']['email'], utf8_decode($_POST['regname']));

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = utf8_decode($assunto_da_mensagem_de_resposta);
                $mail->Body    = utf8_decode($configuracao_da_mensagem_de_resposta);

                if ($mail->send()) {
                    echo '<div class="alert alert-success">Senha enviada para o e-mail cadastrado.</div>';
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>Não foi possível reenviar a senha, tente novamente!</div>";
            }

            //mail($dados['tbcliente']['email'], $assunto_da_mensagem_de_resposta, $configuracao_da_mensagem_de_resposta, $headers);

            $_SESSION['cliente'] = $cliente;
            $_SESSION['nome_cliente'] = $dados['tbcliente']['nome'];
            $_SESSION['email_cliente'] = $dados['tbcliente']['email'];
            $_SESSION['telefone_cliente'] = $dados['tbcliente']['celular'];
        }
    }

    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=" . $siteUrl . "catalogo/21'>";
}

if (isset($_POST['cadastrar']) && @$_POST['cadastrar'] == "cadastrar") {

    $dados['tbcliente']['nome'] = $_POST['regname'];
    $dados['tbcliente']['email'] = $_POST['regemail'];
    $dados['tbcliente']['senha'] = md5($_POST['regpassword']);
    $dados['tbcliente']['telefone'] = $_POST['regphone'];
    $dados['tbcliente']['celular'] = $_POST['regcellphone'];
    $dados['tbcliente']['cidade'] = $_POST['regcidade'];
    $dados['tbcliente']['cnpj'] = $_POST['cnpj'];

    $dados['tbcliente']['inscricaoestadual'] = $_POST['inscricaoestadual'];

    $dados['tbcliente']['tipodocumento'] = $_POST['tipodocumento'];

    $dados['tbcliente']['logradouro'] = $_POST['logradouro'];
    $dados['tbcliente']['numero'] = $_POST['numero'];
    $dados['tbcliente']['bairro'] = $_POST['bairro'];
    $dados['tbcliente']['estado'] = $_POST['estado'];
    $dados['tbcliente']['cep'] = $_POST['cep'];

    $cliente = $conecta->inserirID($dados);
    if ($cliente) {

        $date = date('Y-m-d H:i:s');
        //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
        $assunto_da_mensagem_de_resposta = "Recebemos seu cadastro";
        $cabecalho_da_mensagem_de_resposta = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
        $configuracao_da_mensagem_de_resposta = "Prezado(a) " . $_POST['regname'] . ",<br>
			Obrigado por se cadastra em " . $rs_configuracao['nomeloja'] . ".<br><br>
			Seguem os dados de acesso:<br>
			<br>
			Usuário: " . $_POST['regemail'] . "<br>
			Senha: " . $_POST['regpassword'] . "<br>
			<br>
			Atenciosamente,<br>
			" . $rs_configuracao['nomeloja'] . "<br>
			<br>
			<a href='" . $rs_configuracao['linkloja'] . "'>" . $rs_configuracao['linkloja'] . "</a><br>
			<br>
			Recebido em: $date<br>
			Industria Sacramento
			
			";

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
            $mail->Host       = 'smtp.uhserver.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vendas_site@industriasacramento.com.br';                     //SMTP username
            $mail->Password   = 'G4p2f5D3@2';                               //SMTP password
            $mail->SMTPSecure = '';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
            //$mail->addAddress($email, $name);     //Add a recipient
            $mail->addAddress($dados['tbcliente']['email'], utf8_decode($_POST['regname']));

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode($assunto_da_mensagem_de_resposta);
            $mail->Body    = utf8_decode($configuracao_da_mensagem_de_resposta);

            if ($mail->send()) {
                echo '<div class="alert alert-success">Senha enviada para o e-mail cadastrado.</div>';
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Não foi possível reenviar a senha, tente novamente!</div>";
        }

        //mail($dados['tbcliente']['email'], $assunto_da_mensagem_de_resposta, $configuracao_da_mensagem_de_resposta, $headers);

        $_SESSION['cliente'] = $cliente;
        $_SESSION['nome_cliente'] = $dados['tbcliente']['nome'];
        $_SESSION['email_cliente'] = $dados['tbcliente']['email'];
        $_SESSION['telefone_cliente'] = $dados['tbcliente']['celular'];
    }
}


include_once("classes/produto.class.php");
include_once("classes/carrinho.class.php");

//Recupera objetos da sessão
if (isset($_SESSION['criar'])) {
    $carrinhoSessao = unserialize($_SESSION["carrinho"]);
}

if (isset($remove) && @$remove > 0) {
    $carrinhoSessao->removeProduto($remove);
    //$_SESSION["carrinho"] = serialize($carrinhoSessao);
    $remove = "";
    //echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=".$siteUrl."carrinho/48'>";

    if ($_SESSION['qtde'] == 1) {
        if (isset($_SESSION['criar'])) {
            unset($_SESSION["carrinho"], $_SESSION['qtde'], $_SESSION['criar']);
        }

        header("Location: " . $siteUrl);
        exit;
    }
}


if ($pagina == "carrinho") {

    if (!isset($_SESSION['criar'])) {
        $Carrinho = new Carrinho();
        //Joga na sessão
        $_SESSION["carrinho"] = serialize($Carrinho);
        $_SESSION['criar'] = 1;
        $carrinhoSessao = unserialize($_SESSION["carrinho"]);
        $_SESSION['qtde'] = 0;
    }
    if (isset($_POST['produto']) && $_POST['produto'] != '') {
        $produto1 = $_POST['produto'];


        $sqlProduto = "SELECT p.nome, p.codigo, p.id, p.marca, p.referencia, p.modelo, p.preco_promocional, p.preco, p.data_promocional_inicio, p.data_promocional_fim, p.descricao, p.peso, p.altura, p.comprimento, p.largura, c.titulo as categoria, sc.titulo as subcategoria, f.foto, f.legenda
					FROM tbproduto p inner join tbprod_subcategoria sc on sc.id = p.subcategoria_id
					inner join tbprod_categoria c on c.id = sc.categoria_id
					inner JOIN tbprod_foto f ON f.produto_id = p.id
					where p.id = $produto1 AND f.destaque = 1";

        $resultadoProduto = $conecta->selecionar($conecta->conn, $sqlProduto);
        $rs_produto = mysqli_fetch_array($resultadoProduto);
        $nome = $rs_produto['nome'];
        $codigo = $rs_produto['codigo'];

        if ($rs_produto['preco_promocional'] > 0 && $rs_produto['data_promocional_inicio'] <= date('Y-m-d') && $rs_produto['data_promocional_fim'] >= date('Y-m-d')) {
            $preco = $rs_produto['preco_promocional'];
        } else {
            $preco = $rs_produto['preco'];
        }

        $arryCampos = array_keys($_POST);
        $arryCampos2 = array_keys($_POST);
        $complemento = "";
        $so = 0;
        //Controla para não inserir o produto mais de uma vez em casa de não diferencição de cor.
        $controle = 0;

        foreach ($arryCampos as $campos) {

            $sql_prod_tam = "SELECT distinct tamanho FROM tbprod_tamanhocor WHERE produto_id = " . $produto1 . " ORDER BY tamanho DESC";
            $resultado_prod_tam = $conecta->selecionar($conecta->conn, $sql_prod_tam);
            $qtde_tam = mysqli_num_rows($resultado_prod_tam);

            $descricao = $rs_produto['descricao'];
            $quantidade = 0;


            if ($qtde_tam > 0) {
                while ($rs_tam = mysqli_fetch_array($resultado_prod_tam)) {
                    $sql_prod_cor = "SELECT distinct id, cor FROM tbprod_tamanhocor WHERE produto_id = " . $produto1 . " ORDER BY cor ASC";
                    $resultado_prod_cor = $conecta->selecionar($conecta->conn, $sql_prod_cor);
                    while ($rs_cor = mysqli_fetch_array($resultado_prod_cor)) {
                        $quantidade = 0;
                        if ($campos == $rs_cor['id'] . "|" . $rs_tam['tamanho'] . "_" . $rs_cor['cor'] && $_POST[$campos] > 0) {
                            $complemento = "<strong>Tamanho:</strong> " . $rs_tam['tamanho'] . " <strong>Cor:</strong> " . $rs_cor['cor'];
                            $quantidade = $_POST[$campos];

                            $kilograma = $_POST['kilo_grama'];


                            if ($pro = $carrinhoSessao->getProduto($produto1 . "_" . $rs_cor['id'])) {
                                $qtde = $pro->getQuantidade() + $quantidade;
                                $pro->setQuantidade($qtde);
                                $pro->setMedida($kilograma);
                                $_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
                            } else {
                                $produto = new Produto($produto1 . "_" . $rs_cor['id'], $nome, $rs_produto['referencia'], $rs_produto['marca'], $rs_produto['modelo'], $preco, $descricao, $rs_produto['foto'], $quantidade, $rs_produto['peso'], $rs_produto['altura'], $rs_produto['comprimento'], $rs_produto['largura'], $complemento, $kilograma, $rs_produto['codigo']);

                                //Adiciona produto 1
                                $carrinhoSessao->addProduto($produto);

                                $_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
                            }
                        }
                    }
                }
            } else {
                if ($controle == 0) {
                    $controle = 1;
                    $quantidade = $_POST['qtde_prod'];
                    $kilograma = $_POST['kilo_grama'];

                    if ($pro = $carrinhoSessao->getProduto($produto1)) {
                        $qtde = $pro->getQuantidade() + $quantidade;
                        $pro->setQuantidade($qtde);
                        $pro->setMedida($kilograma);
                        $_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
                    } else {
                        $produto = new Produto($produto1, $nome, $rs_produto['referencia'], $rs_produto['marca'], $rs_produto['modelo'], $preco, $descricao, $rs_produto['foto'], $quantidade, $rs_produto['peso'], $rs_produto['altura'], $rs_produto['comprimento'], $rs_produto['largura'], $complemento, $kilograma, $rs_produto['codigo']);

                        //Adiciona produto 1
                        $carrinhoSessao->addProduto($produto);
                        $_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
                    }
                }
            }
        }

        $sql_campo = "SELECT c.*, s.item, s.value as itemid FROM tbprod_campo c left join tbprod_subcampo s ON c.id = s.campo_id WHERE c.produto_id = " . $produto1 . " AND c.tipo <> 'textarea' ORDER BY c.ordem ASC";
        $resultado_campo = $conecta->selecionar($conecta->conn, $sql_campo);
        $complemento_final = "";
        while ($rs_campo = mysqli_fetch_array($resultado_campo)) {
            if ($rs_campo['tipo'] == 'select' && $rs_campo['itemid'] == $_POST[$rs_campo['nome']]) {
                $complemento_final = $complemento_final . $rs_campo['item'] . " | ";
            } elseif ($rs_campo['tipo'] == 'campo') {
                $complemento_final = $complemento_final . $_POST[$rs_campo['nome']] . " | ";
            }
        }

        $complemento_final = substr_replace($complemento_final, " ", -2, 1);

        foreach ($arryCampos2 as $campos2) {
            $sql_prod_tam = "SELECT distinct tamanho FROM tbprod_tamanhocor WHERE produto_id = " . $produto1 . " ORDER BY tamanho DESC";
            $resultado_prod_tam = $conecta->selecionar($conecta->conn, $sql_prod_tam);
            $qtde_tam = mysqli_num_rows($resultado_prod_tam);

            if ($qtde_tam > 0) {
                while ($rs_tam = mysqli_fetch_array($resultado_prod_tam)) {
                    $sql_prod_cor = "SELECT distinct id, cor FROM tbprod_tamanhocor WHERE produto_id = " . $produto1 . " ORDER BY cor ASC";
                    $resultado_prod_cor = $conecta->selecionar($conecta->conn, $sql_prod_cor);
                    while ($rs_cor = mysqli_fetch_array($resultado_prod_cor)) {
                        if ($campos2 == $rs_cor['id'] . "|" . $rs_tam['tamanho'] . "_" . $rs_cor['cor'] && $_POST[$campos2] > 0) {
                            $pro = $carrinhoSessao->getProduto($produto1 . "_" . $rs_cor['id']);
                            $pro->setComplemento($complemento_final);
                        }
                    }
                }
            }
        }
    }
}

$sql_banner_cabecalho = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 1 ORDER BY rand()";
$resultado_banner_cabecalho = $conecta->selecionar($conecta->conn, $sql_banner_cabecalho);

if (isset($_SESSION["carrinho"])) {
    $carrinhoSessao2 = unserialize($_SESSION["carrinho"]);
    $qtdenocarrinho = $carrinhoSessao2->getQtdeProdutos();
}

?>
<?php $siteUrl2 = $siteUrl; ?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industria Sacramento</title>

    <!-- SEO -->
    <meta name="keywords" content="<?php echo $rs_configuracao['keyword']; ?>">
    <meta name="description" content="<?php echo $rs_configuracao['meta']; ?>">
    <meta name="google-site-verification" content="a1NwArdNwEY-a1ki2j6I87uncAhqalZIc3DVNvtbmDw" />
    <!-- FIM SEO -->

    <title><?php echo $rs_configuracao['titulopagina']; ?></title>

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $siteUrl2; ?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="<?php echo $siteUrl2; ?>images/favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Global site tag (gtag.js) - Google Ads: 1043928575 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1043928575"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-1043928575');
    </script>


    <script>
        window.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href*="whatsapp"]').forEach(function(el) {
                el.addEventListener('click', function() {
                    console.log('whatsapp conversion')
                    gtag('event', 'conversion', {
                        'send_to': 'AW-1043928575/iTfwCL68rN4CEP-r5PED'
                    });
                });

            })
        })
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href*="instagram.com"]').forEach(function(el) {
                el.addEventListener('click', function() {
                    console.log('instagram conversion')
                    gtag('event', 'conversion', {
                        'send_to': 'AW-1043928575/cYLICMy61t4CEP-r5PED'
                    });
                });

            })
        })
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href*="industriasacramento.com.br/documentos/catalogo"]').forEach(function(el) {
                el.addEventListener('click', function() {
                    console.log('catalogo conversion')
                    gtag('event', 'conversion', {
                        'send_to': 'AW-1043928575/EE0_CLmvrd4CEP-r5PED'
                    });
                });

            })
        })
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function(el) {
            document.querySelectorAll('.texto_rodape').forEach(function(el) {

                el.addEventListener('click', function() {
                    console.log('telefone')

                    gtag('event', 'conversion', {
                        'send_to': 'AW-1043928575/WZDtCMuk0d4CEP-r5PED'
                    });
                })

            })
        })
    </script>
</head>

<body>
    <header>

        <nav id="nav" class="navbar">
            <div class="container d-flex justify-content-between">

                <a class="navbar-brand" href="/">
                    <img src="/images/Logo Sacramento.png" class="my-1 mx-2 logo_principal" alt="Insdustria Sacramento">
                </a>

                <button class="navbar-toggler d-lg-none btcarrinhotopo" type="button">
                    <a href="#" data-toggle="modal" data-target="<?php if (@$_SESSION['cliente'] > 0) { ?>#ModalArea<?php } else { ?>#ModalLogin<?php } ?>"><img src="/images/user.png" width="25" height="26" alt="Minha área" title="Minha área">
                        <?php if (@$_SESSION['cliente'] > 0) { ?>
                            <span class="numeroProdutos" style="height: 10px; width: 10px; padding: 0; background: #069; top: 10px; left: 20px;"></span>
                        <?php } ?>
                    </a>
                </button>
                <button class="navbar-toggler d-lg-none btcarrinhotopo" type="button">
                    <a href="<?php echo $siteUrl; ?>carrinho/48"><img src="/images/car.png" width="25" height="26" alt="Meu carrinho" title="Meu carrinho">
                        <?php if (@$qtdenocarrinho > 0) { ?>
                            <span class="numeroProdutos"><?php echo $qtdenocarrinho; ?></span>
                        <?php } ?>
                    </a>
                </button>

                <button class="navbar-toggler d-lg-none btmenutopo" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <?php
                $sql_subcategoria = "SELECT DISTINCT sc.* FROM tbprod_subcategoria sc INNER JOIN tbproduto p ON p.subcategoria_id = sc.id
								WHERE p.status = 1 AND sc.categoria_id = 1 ORDER BY sc.titulo ASC";
                $resultado_subcategoria = $conecta->selecionar($conecta->conn, $sql_subcategoria);

                $sql_marca = "SELECT DISTINCT sc.* FROM tbprod_subcategoria sc INNER JOIN tbproduto p ON p.subcategoria_id = sc.id
							WHERE p.status = 1 AND sc.categoria_id <> 1 ORDER BY sc.titulo ASC";
                $resultado_marca = $conecta->selecionar($conecta->conn, $sql_marca);
                ?>



                <ul class="d-flex justify-content-between align-items-center nav menu text-white">

                    <li><a href="/">Home</a></li>
                    <li><a href="<?php echo $siteUrl; ?>catalogo/21">Produtos</a>
                        <ul>
                            <?php while ($rs_subcategoria = mysqli_fetch_array($resultado_subcategoria)) { ?>
                                <li><a href="<?php echo $siteUrl ?>catalogo/21/0/0/0/0/0/0/<?php echo $rs_subcategoria['id']; ?>"><?php echo $rs_subcategoria['titulo']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo $siteUrl; ?>catalogo/21">Utilidades Domésticas&nbsp;<img src="/images/seta.png"></a>
                        <ul>
                            <?php while ($rs_fornecedor = mysqli_fetch_array($resultado_marca)) { ?>
                                <li><a href="<?php echo $siteUrl ?>catalogo/21/0/0/0/0/0/0/<?php echo $rs_fornecedor['id']; ?>"><?php echo $rs_fornecedor['titulo']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo $siteUrl; ?>quem-somos/10">Empresa&nbsp;<img src="/images/seta.png"></a>
                        <ul>
                            <li><a href="<?php echo $siteUrl; ?>quem-somos/10">Quem somos</a></li>
                            <li><a href="<?php echo $siteUrl; ?>parceiro/15">Parceiros</a></li>
                            <!--<li><a href="<?php echo $siteUrl; ?>trabalhe-conosco/38">Trabalhe conosco</a></li>-->
                        </ul>
                    </li>
                    <li><a href="<?php echo $siteUrl; ?>fale-conosco/16">Fale conosco</a></li>
                    <!--<li><a href="<?php echo $siteUrl; ?>busca/21"><img src="/images/lupa.png" width="25" height="26" alt="pesquisar" title="pesquisar"></a></li>-->
                    <li><a href="#" data-toggle="modal" data-target="<?php if (@$_SESSION['cliente'] > 0) { ?>#ModalArea<?php } else { ?>#ModalLogin<?php } ?>"><img src="/images/user.png" width="25" height="26" alt="Minha área" title="Minha área">
                            <?php if (@$_SESSION['cliente'] > 0) { ?>
                                <span class="numeroProdutos" style="height: 10px; width: 10px; padding: 0; background: #069; top: 10px; left: 20px;"></span>
                            <?php } ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo $siteUrl; ?>carrinho/48"><img src="/images/car.png" width="25" height="26" alt="Meu carrinho" title="Meu carrinho">
                            <?php if (@$qtdenocarrinho > 0) { ?>
                                <span class="numeroProdutos"><?php echo $qtdenocarrinho; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled sidebar">
                    <li><a href="/" class="text-reset">Home</a></li>
                    <?php
                    $resultado_subcategoria = $conecta->selecionar($conecta->conn, $sql_subcategoria);
                    $resultado_marca = $conecta->selecionar($conecta->conn, $sql_marca);
                    ?>
                    <li><a href="<?php echo $siteUrl; ?>catalogo/21" class="text-reset">Produtos</a></li>
                    <?php while ($rs_subcategoria = mysqli_fetch_array($resultado_subcategoria)) { ?>
                        <li><a href="<?php echo $siteUrl ?>catalogo/21/0/0/0/0/0/0/<?php echo $rs_subcategoria['id']; ?>" class="text-reset"><?php echo $rs_subcategoria['titulo']; ?></a></li>
                    <?php } ?>
                    <?php while ($rs_fornecedor = mysqli_fetch_array($resultado_marca)) { ?>
                        <li><a href="<?php echo $siteUrl ?>catalogo/21/0/0/0/0/0/0/<?php echo $rs_fornecedor['id']; ?>" class="text-reset"><?php echo $rs_fornecedor['titulo']; ?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $siteUrl; ?>quem-somos/10" class="text-reset">Empresa</a></li>
                    <li><a href="<?php echo $siteUrl; ?>fale-conosco/16" class="text-reset">Fale conosco</a></li>

                    <!--<li><a href="<?php echo $siteUrl; ?>carrinho/48" class="text-reset">Carrinho</a></li>-->

                </ul>
            </div>
            <section class="boxtopsearch">
                <div class="container">
                    <form action="<?php echo $siteUrl; ?>busca/21" method="post" enctype="multipart/form-data" name="formSearch" style="width:100%; margin-bottom: 0;">
                        <input type="search" name="search" id="iptsearch" class="boxSearch" placeholder="Pesquisar" value="" />&nbsp;<button class="submit-lente btnsearchentrar" type="submit">
                            <i class="fa fa-search" style="color:FFFFFF; font-size:1em;"></i>
                        </button>
                    </form>
                </div>
            </section>
        </nav>




        <?php if (@$pagina == '' || @$pagina == 'home') { ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $i = 0;
                    while ($rs_banner_cabecalho = mysqli_fetch_array($resultado_banner_cabecalho)) { ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {
                                                                                                            echo 'class="active"';
                                                                                                        } ?>></li>
                    <?php $i++;
                    } ?>
                </ol>
                <div class="carousel-inner">
                    <?php $resultado_banner_cabecalho = $conecta->selecionar($conecta->conn, $sql_banner_cabecalho);
                    $i = 0;
                    while ($rs_banner_cabecalho = mysqli_fetch_array($resultado_banner_cabecalho)) { ?>
                        <div class="carousel-item <?php if ($i == 0) {
                                                        echo 'active';
                                                    } ?>">
                            <a href="<?php echo $rs_banner_cabecalho['link']; ?>" target="_blank">
                                <img src="<?php echo $rs_banner_cabecalho['arquivo'] ?>" class="d-block w-100">
                            </a>
                        </div>
                    <?php $i++;
                    } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
        <?php } ?>

    </header>

    <main>