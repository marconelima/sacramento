<?php session_start(); ob_start();
	date_default_timezone_set("Brazil/East");
	set_time_limit(0);

	include "uteis/bancodados.php";
	include "parametros.php";
	include "funcoes.php";

	$conecta = new Recordset;
	$conecta->conexao();

	@$pag = @$numpagina;

	if(@$pag >= '1'){
		@$pag = @$pag;
	} else {
		@$pag = '1';
	}
	$maximo = '10';
	$inicio = ($pag * $maximo) - $maximo;

	$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
	$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
	$rs_configuracao = mysqli_fetch_array($resultado_configuracao);

	$siteUrl = $rs_configuracao['linkloja'];


	if(@$tela != ''){
		$sql_tela = "SELECT * FROM tbtela WHERE id = ".$tela;
		$resultado_tela = $conecta->selecionar($conecta->conn, $sql_tela);
		$rs_tela = mysqli_fetch_array($resultado_tela);
	}



	if(isset($sair) && $sair == 1){
		unset($_SESSION['cliente'],$_SESSION['nome_cliente'],$_SESSION['email_cliente']);
	}

	if(isset($_POST['entrar']) && $_POST['entrar'] == "Login"){
		$email = verificar_dados($conecta->conn, $_POST['email']);
		$senha = verificar_dados($conecta->conn, $_POST['senha']);

		$sql_valida = "SELECT c.id as cliente, c.* FROM tbcliente c WHERE c.email = '".$email."' AND c.senha = '".md5($senha)."'";
		$resultado_valida = $conecta->selecionar($conecta->conn,$sql_valida);

		if($rs_valida = mysqli_fetch_array($resultado_valida)){
			$_SESSION['cliente'] = $rs_valida['cliente'];
			$_SESSION['nome_cliente'] = $rs_valida['nome'];
			$_SESSION['email_cliente'] = $rs_valida['email'];

			echo "<script>alert('Seja bem vindo ".$_SESSION['nome_cliente']."!')</script>";
		} else {
			echo "<script>alert('Houve um problema no login tente novamente!')</script>";
		}
	}

	if(isset($_POST['enviar']) && $_POST['enviar'] == "Lembrar"){
		$email = verificar_dados($conecta->conn, $_POST['email']);

		$sql_valida = "SELECT c.id as cliente, c.* FROM tbcliente c WHERE c.email = '".$email."'";
		$resultado_valida = $conecta->selecionar($conecta->conn,$sql_valida);

		if(!$rs_valida = mysqli_fetch_array($resultado_valida)){
			$retornoNovaSenha =  "<div class='alert alert-danger'>E-mail não cadastrado!</div>";
		} else {

			$nome = $rs_valida['nome'];

			$string = "id = ".$rs_valida['id'];

			$senha = "";
			$caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
			$tamanho = 6;
			for($i = 0; $i < $tamanho; $i++){
				$senha .= $caracteres{rand(0,62)};
			}
			$senhadeacesso = $senha	;

			$dados['tbcliente']['senha'] = md5($senha);

			$resultado = $conecta->alterar($dados, $string);


			$para = $rs_configuracao['emailloja'];

			$headers = "From: $para\n";
			$headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

			$date = date("d/m/Y h:i");
			$assunto = "Dados de Acesso a ".$rs_configuracao['nomeloja'];
			$corpo_email = "<strong>Dados de Acesso a ".$rs_configuracao['nomeloja']."</strong><br />
							$date<br /><br />
							Olá $nome,<br /><br />
							Você está recebendo os dados de acesso a ".$rs_configuracao['nomeloja'].".<br/><br />
							Para acessar o ".$rs_configuracao['nomeloja']." acesse:<br /><br>
							<a href='".$rs_configuracao['linkloja']."'>".$rs_configuracao['nomeloja']."</a><br />
							<strong>DADOS DE ACESSO:</strong><br />
							<strong>Usuário:</strong> ".$email."<br />
							<strong>Senha:</strong> $senhadeacesso<br /><br />
							<br>
							Recebido em: $date<br>
							Industria Sacramento
							
							<br><br>
							- Não responda este e-mail, esta é uma mensagem automática enviada pelo sistema. -";

			if(mail($email,$assunto,$corpo_email,$headers)){
				$retornoNovaSenha =  "Senha enviada para o e-mail cadastrado.";
				echo "<script>alert('".$retornoNovaSenha."')</script>";
			} else {
				echo "<script>alert('Não foi possível reenviar a senha, tente novamente!')</script>";
			}
		}
	}

	if(isset($_POST['cadastrar']) && @$_POST['cadastrar'] == "cadastrar"){

		$dados['tbcliente']['nome'] = $_POST['regname'];
		$dados['tbcliente']['email'] = $_POST['regemail'];
		$dados['tbcliente']['senha'] = md5($_POST['regpassword']);
		$dados['tbcliente']['telefone'] = $_POST['regphone'];
		$dados['tbcliente']['celular'] = $_POST['regcellphone'];
		$dados['tbcliente']['whatsapp'] = $_POST['whatsapp'];
		$dados['tbcliente']['cidade'] = $_POST['regcidade'];

		$cliente = $conecta->inserirID($dados);
		if($cliente){

			$date = date('Y-m-d H:i:s');
			//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
			$assunto_da_mensagem_de_resposta = "Recebemos seu cadastro";
			$cabecalho_da_mensagem_de_resposta = "From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
			$configuracao_da_mensagem_de_resposta="Prezado(a) ".$_POST['regname'].",<br>
			Obrigado por se cadastra em ".$rs_configuracao['nomeloja'].".<br><br>
			Seguem os dados de acesso:<br>
			<br>
			Usuário: ".$_POST['regemail']."<br>
			Senha: ".$_POST['regpassword']."<br>
			<br>
			Atenciosamente,<br>
			".$rs_configuracao['nomeloja']."<br>
			<br>
			<a href='".$rs_configuracao['linkloja']."'>".$rs_configuracao['linkloja']."</a><br>
			<br>
			Recebido em: $date<br>
			Industria Sacramento
			
			";

			//ENVIO DE MENSAGEM RESPOSTA
			$headers = "$cabecalho_da_mensagem_de_resposta";
			$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

			mail($dados['tbcliente']['email'],$assunto_da_mensagem_de_resposta,$configuracao_da_mensagem_de_resposta,$headers);

			$_SESSION['cliente'] = $cliente;
			$_SESSION['nome_cliente'] = $dados['tbcliente']['nome'];
			$_SESSION['email_cliente'] = $dados['tbcliente']['email'];
		}

	}


	include_once("classes/produto.class.php");
	include_once("classes/carrinho.class.php");

	//Recupera objetos da sessão
	if(isset($_SESSION['criar'])){
		$carrinhoSessao = unserialize($_SESSION["carrinho"]);
	}

	if(isset($remove) && @$remove > 0){
		$carrinhoSessao->removeProduto($remove);
		//$_SESSION["carrinho"] = serialize($carrinhoSessao);
		$remove = "";
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=".$siteUrl."carrinho/48'>";
	}


	if($pagina == "carrinho"){

		if(!isset($_SESSION['criar'])) {
			$Carrinho = new Carrinho();
			//Joga na sessão
			$_SESSION["carrinho"] = serialize($Carrinho);
			$_SESSION['criar'] = 1;
			$carrinhoSessao = unserialize($_SESSION["carrinho"]);
			$_SESSION['qtde'] = 0;
		}
		if(isset($_POST['produto']) && $_POST['produto'] != ''){
			$produto1 = $_POST['produto'];


			$sqlProduto = "SELECT p.nome, p.id, p.marca, p.referencia, p.modelo, p.preco_promocional, p.preco, p.data_promocional_inicio, p.data_promocional_fim, p.descricao, p.peso, p.altura, p.comprimento, p.largura, c.titulo as categoria, sc.titulo as subcategoria, f.foto, f.legenda
					FROM tbproduto p inner join tbprod_subcategoria sc on sc.id = p.subcategoria_id
					inner join tbprod_categoria c on c.id = sc.categoria_id
					inner JOIN tbprod_foto f ON f.produto_id = p.id
					where p.id = $produto1 AND f.destaque = 1";

			$resultadoProduto = $conecta->selecionar($conecta->conn,$sqlProduto);
			$rs_produto = mysqli_fetch_array($resultadoProduto);
			$nome = $rs_produto['categoria']." ".$rs_produto['subcategoria']." ".$rs_produto['nome'];

			if($rs_produto['preco_promocional'] > 0 && $rs_produto['data_promocional_inicio'] <= date('Y-m-d') && $rs_produto['data_promocional_fim'] >= date('Y-m-d')) {
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

			foreach($arryCampos as $campos){

				$sql_prod_tam = "SELECT distinct tamanho FROM tbprod_tamanhocor WHERE produto_id = ".$produto1." ORDER BY tamanho DESC";
				$resultado_prod_tam = $conecta->selecionar($conecta->conn,$sql_prod_tam);
				$qtde_tam = mysqli_num_rows($resultado_prod_tam);

				$descricao = $rs_produto['descricao'];
				$quantidade = 0;


				if($qtde_tam > 0){
					while($rs_tam = mysqli_fetch_array($resultado_prod_tam)){
						$sql_prod_cor = "SELECT distinct id, cor FROM tbprod_tamanhocor WHERE produto_id = ".$produto1." ORDER BY cor ASC";
						$resultado_prod_cor = $conecta->selecionar($conecta->conn,$sql_prod_cor);
						while($rs_cor = mysqli_fetch_array($resultado_prod_cor)){
							$quantidade = 0;
							if($campos == $rs_cor['id']."|".$rs_tam['tamanho']."_".$rs_cor['cor'] && $_POST[$campos] > 0){
								$complemento = "<strong>Tamanho:</strong> ".$rs_tam['tamanho']." <strong>Cor:</strong> ".$rs_cor['cor'];
								$quantidade = $_POST[$campos];

								$kilograma = $_POST['kilo_grama'];


								if($pro = $carrinhoSessao->getProduto($produto1."_".$rs_cor['id'])){
									$qtde = $pro->getQuantidade() + $quantidade;
									$pro->setQuantidade($qtde);
									$pro->setMedida($kilograma);
									$_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
								} else {
									$produto = new Produto($produto1."_".$rs_cor['id'], $nome, $rs_produto['referencia'], $rs_produto['marca'], $rs_produto['modelo'],$preco,$descricao,$rs_produto['foto'],$quantidade,$rs_produto['peso'],$rs_produto['altura'],$rs_produto['comprimento'],$rs_produto['largura'],$complemento, $kilograma);
									//Adiciona produto 1
									$carrinhoSessao->addProduto($produto);

									$_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
								}


							}
						}
					}
				} else {
					if($controle == 0){
						$controle = 1;
						$quantidade = $_POST['qtde_prod'];
						$kilograma = $_POST['kilo_grama'];

						if($pro = $carrinhoSessao->getProduto($produto1)){
							$qtde = $pro->getQuantidade() + $quantidade;
							$pro->setQuantidade($qtde);
							$pro->setMedida($kilograma);
							$_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
						} else {
							$produto = new Produto($produto1, $nome, $rs_produto['referencia'], $rs_produto['marca'], $rs_produto['modelo'],$preco,$descricao,$rs_produto['foto'],$quantidade,$rs_produto['peso'],$rs_produto['altura'],$rs_produto['comprimento'],$rs_produto['largura'],$complemento, $kilograma);
							//Adiciona produto 1
							$carrinhoSessao->addProduto($produto);
							$_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;
						}
					}
				}
			}

			$sql_campo = "SELECT c.*, s.item, s.value as itemid FROM tbprod_campo c left join tbprod_subcampo s ON c.id = s.campo_id WHERE c.produto_id = ".$produto1." AND c.tipo <> 'textarea' ORDER BY c.ordem ASC";
			$resultado_campo = $conecta->selecionar($conecta->conn,$sql_campo);
			$complemento_final = "";
			while($rs_campo = mysqli_fetch_array($resultado_campo)){
				if($rs_campo['tipo'] == 'select' && $rs_campo['itemid'] == $_POST[$rs_campo['nome']]){
					$complemento_final = $complemento_final.$rs_campo['item']." | ";
				} elseif($rs_campo['tipo'] == 'campo'){
					$complemento_final = $complemento_final.$_POST[$rs_campo['nome']]." | ";
				}

			}

			$complemento_final = substr_replace($complemento_final, " ", -2, 1);

			foreach($arryCampos2 as $campos2){
				$sql_prod_tam = "SELECT distinct tamanho FROM tbprod_tamanhocor WHERE produto_id = ".$produto1." ORDER BY tamanho DESC";
				$resultado_prod_tam = $conecta->selecionar($conecta->conn,$sql_prod_tam);
				$qtde_tam = mysqli_num_rows($resultado_prod_tam);

				if($qtde_tam > 0){
					while($rs_tam = mysqli_fetch_array($resultado_prod_tam)){
						$sql_prod_cor = "SELECT distinct id, cor FROM tbprod_tamanhocor WHERE produto_id = ".$produto1." ORDER BY cor ASC";
						$resultado_prod_cor = $conecta->selecionar($conecta->conn,$sql_prod_cor);
						while($rs_cor = mysqli_fetch_array($resultado_prod_cor)){
							if($campos2 == $rs_cor['id']."|".$rs_tam['tamanho']."_".$rs_cor['cor'] && $_POST[$campos2] > 0){
								$pro = $carrinhoSessao->getProduto($produto1."_".$rs_cor['id']);
								$pro->setComplemento($complemento_final);
							}
						}
					}
				}
			}
		}
	}


?>
<?php $siteUrl2 = $siteUrl; ?>



<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <meta name="keywords" content="<?php echo $rs_configuracao['keyword'];?>">
    <meta name="description" content="<?php echo $rs_configuracao['meta'];?>">
	<meta name="google-site-verification" content="a1NwArdNwEY-a1ki2j6I87uncAhqalZIc3DVNvtbmDw" />
    <!-- FIM SEO -->

    <title><?php echo $rs_configuracao['titulopagina'];?></title>

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $siteUrl2;?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="<?php echo $siteUrl2;?>images/favicon.ico">

    <!-- JS Page -->

	<script src="<?php echo $siteUrl2;?>assets/plugins/jquery.min.js"></script>

	<!-- CSS Global -->

	<link rel="stylesheet" href="<?php echo $siteUrl2;?>assets/font-awesome/css/font-awesome.min.css">
	<link href="<?php echo $siteUrl2;?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link href="<?php echo $siteUrl2;?>assets/plugins/superfish/css/superfish.css" rel="stylesheet">
	<link href="<?php echo $siteUrl2;?>assets/plugins/prettyPhoto/css/prettyPhoto.css" rel="stylesheet">
	<link href="<?php echo $siteUrl2;?>assets/plugins/animate.css" rel="stylesheet">

	<!-- CSS Page Level -->
	<link href="<?php echo $siteUrl2;?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo $siteUrl2;?>assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
	<link href="<?php echo $siteUrl2;?>assets/plugins/isotope/jquery.isotope.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $siteUrl2;?>assets/plugins/flexslider/flexslider.css">

	<link href="<?php echo $siteUrl2;?>assets/plugins/flexisel-style.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $siteUrl2;?>assets/plugins/magnific-popup.css">

	<link href="<?php echo $siteUrl2;?>assets/plugins/touchTouch.css" rel="stylesheet">
	<?php if($tela == 10 || $tela == 11){ ?>
	<link href="<?php echo $siteUrl2;?>assets/plugins/gallery.css" rel="stylesheet">
	<?php } ?>

	<?php include "assets/css/theme.css.php"; ?>

	<link rel="stylesheet" href="<?php echo $siteUrl;?>css/main.css">

	<link href="<?php echo $siteUrl2;?>assets/css/custom.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php echo $siteUrl2;?>assets/plugins/box-produtos/style_common.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $siteUrl2;?>assets/plugins/box-produtos/style1.css" />

	<?php echo $rs_configuracao['link_fonte'];?>
	<?php echo $rs_configuracao['link_fonte2'];?>
	<?php echo $rs_configuracao['link_fonte3'];?>
	<?php if($rs_configuracao['link_fonte'] != ''){?>
	<style>
	    html {font-family: <?php echo $rs_configuracao['nome_fonte'];?> !important;}
	    body {font-family: <?php echo $rs_configuracao['nome_fonte'];?> !important;}
	</style>
	<?php } ?>

	<!-- JS Global -->

	<script src="<?php echo $siteUrl2;?>assets/plugins/jquery-migrate.min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/modernizr.custom.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/superfish/js/superfish.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/prettyPhoto/js/jquery.prettyPhoto.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/placeholdem.min.js"></script>

	<script type="text/javascript" src="<?php echo $siteUrl2;?>js/jquery.maskedinput.min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/ajax-mail.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/flexslider/jquery.flexslider-min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/isotope/jquery.isotope.min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/waypoints.min.js"></script>
	<script src="<?php echo $siteUrl2;?>assets/plugins/jquery.stellar.min.js"></script>


	<!-- JS Page Level -->
	<script src="<?php echo $siteUrl2;?>assets/plugins/touchTouch.jquery.js"></script>
	<script type="text/javascript" src="<?php echo $siteUrl2;?>assets/js/theme.js"></script>
	<script type="text/javascript" src="<?php echo $siteUrl2;?>assets/js/pages/index.js"></script>
	<script type="text/javascript" src="<?php echo $siteUrl2;?>assets/plugins/jquery.flexisel.js"></script>

	<script type="text/javascript" src="<?php echo $siteUrl2;?>assets/js/custom.js"></script>

	<script type="text/javascript" src="<?php echo $siteUrl2;?>js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="<?php echo $siteUrl2;?>js/jquery.cycle.all.min.js"></script>

	<script type="text/javascript" src="<?php echo $siteUrl2;?>js/scripts.js"></script>

	<script src="<?php echo $siteUrl2;?>js/main.js"></script>

	<script>

	$(window).load(function() {
	    $("#flexiselDemo2").flexisel();
	    $("#flexiselDemo3").flexisel();
	    $("#flexiselDemo4").flexisel();
	    $("#flexiselDemo5").flexisel();

	    $("#flexiselDemo6").flexisel();
	    $("#flexiselDemo7").flexisel();
	    $("#flexiselDemo8").flexisel();

	    $("#flexiselDemo9").flexisel();

	    $("#manufacturers").flexisel({
	        visibleItems: 5,
	        animationSpeed: 2000,
	        autoPlay: true,
	        autoPlaySpeed: 4000,
	        pauseOnHover: true,
	        enableResponsiveBreakpoints: true,
	        responsiveBreakpoints: {
	            portrait: {
	                changePoint:480,
	                visibleItems: 1
	            },
	            landscape: {
	                changePoint:640,
	                visibleItems: 2
	            },
	            tablet: {
	                changePoint:768,
	                visibleItems: 3
	            }
	        }
	    });

	    $("#manufacturers2").flexisel({
	        visibleItems: 8,
	        animationSpeed: 2000,
	        autoPlay: true,
	        autoPlaySpeed: 3000,
	        pauseOnHover: true,
	        enableResponsiveBreakpoints: true,
	        responsiveBreakpoints: {
	            portrait: {
	                changePoint:480,
	                visibleItems: 2
	            },
	            landscape: {
	                changePoint:640,
	                visibleItems: 4
	            },
	            tablet: {
	                changePoint:768,
	                visibleItems: 6
	            }
	        }
	    });
	});

	jQuery(document).ready(function () {

	    // input
	    $(".input-contact input, .textarea-contact textarea").focus(function () {
	        $(this).next("span").addClass("active");
	    });
	    $(".input-contact input, .textarea-contact textarea").blur(function () {
	        if ($(this).val() === "") {
	            $(this).next("span").removeClass("active");
	        }
	    });

	    $('.thumbnail-caption').hover(
	        function(){
	            $(this).find('.caption').slideDown(250); //.fadeIn(250)
	        },
	        function(){
	            $(this).find('.caption').slideUp(250); //.fadeOut(205)
	        }
	    );

	    $("ul#banner_meio").cycle();
	    $("ul#banner_esquerda").cycle();
	    $("ul#banner_direita").cycle();

	    $('#box_rot1')
	    .after('<div id="nav">')
	    .cycle({
	        pager:'#rotacao',
	        delay: 30000,
	        timeout:30000
	    });

	    $('#box_rot2')
	    .after('<div id="nav">')
	    .cycle({
	        pager:'#rotacao2',
	        delay: 30000,
	        timeout:30000
	    });

	    $('#box_rot3')
	    .after('<div id="nav">')
	    .cycle({
	        pager:'#rotacao3',
	        delay: 30000,
	        timeout:30000
	    });

	    $("#plus").click(function(){
	        $("#qtde_prod").val((1*$("#qtde_prod").val())+1);
	    });

	    $("#minus").click(function(){
	        if($("#qtde_prod").val() > 1){
	            $("#qtde_prod").val((1*$("#qtde_prod").val())-1);
	        }
	    });

	});


	function mascaraData(campoData){
	      var data = campoData.value;
	      if (data.length == 2){
	          data = data + '/';
	          document.forms[0].data.value = data;
	          return true;
	      }
	      if (data.length == 5){
	          data = data + '/';
	          document.forms[0].data.value = data;
	          return true;
	      }
	 }

	 function mascaraHora(campoHora){
	      var hora = campoHora.value;
	      if (hora.length == 2){
	          hora = hora + ':';
	          document.forms[0].hora.value = hora;
	          return true;
	      }
	 }

	 function mascaraHoraInicio(campoHora){
	      var hora = campoHora.value;
	      if (hora.length == 2){
	          hora = hora + ':';
	          document.forms[0].inicio.value = hora;
	          return true;
	      }
	 }

	 function mascaraHoraTermino(campoHora){
	      var hora = campoHora.value;
	      if (hora.length == 2){
	          hora = hora + ':';
	          document.forms[0].termino.value = hora;
	          return true;
	      }
	 }


	function m_Telefone(campo,tammax) {
	    var vr = campo.value;
	    tam = vr.length;

	    if(tam == 1) {
	       vr = "";
	       vr = "(" + campo.value;
	    } else if (tam == 3) {
	       vr =  vr.substr(0,3) + ")" + vr.substr(tam,1) ;
	       } else if (tam == 8) {
	       vr =  vr.substr(0,8) + "-" + vr.substr(tam,1) ;
	       } else {
	       vr = campo.value;
	    }

	    var tam = vr.length;
	    campo.value = vr;
	}

	function v_NR(tecla) {
	    if(typeof(tecla) == 'undefined')
	        var tecla = window.event;

	    var codigo = (tecla.which ? tecla.which : tecla.keyCode ? tecla.keyCode : tecla.charCode);

	    // permite n�meros, 8=backspace, 46=del e 9=tab
	    if ( (codigo >= 48 && codigo <= 57) || (codigo >= 96 && codigo <= 105) || codigo == 8 || codigo == 46 || codigo == 9 ) {
	        return true;
	    } else {
	    alert("Apenas n�meros s�o permitidos !"); return false;
	    }
	}

	if (navigator.appName.indexOf('Microsoft') != -1){
	    clientNavigator = "IE";
	 }else{
	    clientNavigator = "Other";
	 }

	function Bloqueia_Caracteres(evnt){
	 //Fun��o permite digita��o de n�meros
	    if (clientNavigator == "IE"){
	        if (evnt.keyCode < 48 || evnt.keyCode > 57){
	            return false
	        }
	    }else{
	        if ((evnt.charCode < 48 || evnt.charCode > 57) && evnt.keyCode == 0){
	            return false
	        }
	    }
	 }


	function Ajusta_Data(input, evnt){
	 //Ajusta m�scara de Data e s� permite digita��o de n�meros
	    if (input.value.length == 2 || input.value.length == 5){
	        if(clientNavigator == "IE"){
	            input.value += "/";
	        }else{
	            if(evnt.keyCode == 0){
	                input.value += "/";
	            }
	        }
	    }
	 //Chama a fun��o Bloqueia_Caracteres para s� permitir a digita��o de n�meros
	    return Bloqueia_Caracteres(evnt);
	 }

	 function Ajusta_Hora(input, evnt){
	 //Ajusta m�scara de Data e s� permite digita��o de n�meros
	    if (input.value.length == 2){
	        if(clientNavigator == "IE"){
	            input.value += ":";
	        }else{
	            if(evnt.keyCode == 0){
	                input.value += ":";
	            }
	        }
	    }
	 //Chama a fun��o Bloqueia_Caracteres para s� permitir a digita��o de n�meros
	    return Bloqueia_Caracteres(evnt);
	 }


	function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
	    var sep = 0;
	    var key = '';
	    var i = j = 0;
	    var len = len2 = 0;
	    var strCheck = '0123456789';
	    var aux = aux2 = '';
	    var whichCode = (window.Event) ? e.which : e.keyCode;
	    if (whichCode == 13) return true;
	    var t = new String(objTextBox.value);
	    if (whichCode == 8){
	    objTextBox.value = t.substring(0, t.length-1);
	    }
	    key = String.fromCharCode(whichCode); // Valor para o c�digo da Chave
	    if (strCheck.indexOf(key) == -1) return false; // Chave inv�lida
	    len = objTextBox.value.length;
	    for(i = 0; i < len; i++)
	        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
	    aux = '';
	    for(; i < len; i++)
	        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
	    aux += key;
	    len = aux.length;
	    if (len == 0) objTextBox.value = '';
	    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
	    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
	    if (len > 2) {
	        aux2 = '';
	        for (j = 0, i = len - 3; i >= 0; i--) {
	            if (j == 3) {
	                aux2 += SeparadorMilesimo;
	                j = 0;
	            }
	            aux2 += aux.charAt(i);
	            j++;
	        }
	        objTextBox.value = '';
	        len2 = aux2.length;
	        for (i = len2 - 1; i >= 0; i--)
	        objTextBox.value += aux2.charAt(i);
	        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
	    }
	    return false;
	}



	</script>

	<!--[if lt IE 9]>
	<script src="<?php //echo $siteUrl2;?>assets/plugins/html5shiv.js"></script>
	<script src="<?php //echo $siteUrl2;?>assets/plugins/respond.min.js"></script>
	<![endif]-->

	<script src='https://www.google.com/recaptcha/api.js'></script>







</head>
<body class="wide" style="background:<?php echo $rs_configuracao['fundo_site'];?> !important;">

<!-- Wrap all content -->
<div class="wrapper">
    <!-- Header -->
    <header class="header">
	<?php if($rs_configuracao['container_topo'] > 0) { ?>
		<div class="row barra_superior">
			<div class="container">
		        <div class="col-xs-12 col-sm-4 col-md-4 rede_g" style="padding-left:0; ">
					<ul class="address-ul fa-ul" style="margin-left:0; font-size:20px;">
		                <?php if($rs_configuracao['facebook'] != ''){ ?><li><a href="<?php echo $rs_configuracao['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['twitter'] != ''){ ?><li><a href="<?php echo $rs_configuracao['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['googleplus'] != ''){ ?><li><a href="<?php echo $rs_configuracao['googleplus'];?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['flickr'] != ''){ ?><li><a href="<?php echo $rs_configuracao['flickr'];?>" target="_blank"><i class="fa fa-flickr"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['linkedin'] != ''){ ?><li><a href="<?php echo $rs_configuracao['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['instagram'] != ''){ ?><li><a href="<?php echo $rs_configuracao['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['pinterest'] != ''){ ?><li><a href="<?php echo $rs_configuracao['pinterest'];?>" target="_blank"></a></li><?php } ?>
						<li><a href="#"></a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 conta_g" style="padding-right:0;">
					<ul class="address-ul fa-ul">
						<li style="margin: 0 0 0 5% !important;float: right;"><?php if($rs_configuracao['whatsapp'] != '') { ?><i class="fa-li fa fa-whatsapp"></i><?php echo $rs_configuracao['whatsapp'];?><?php } ?></li>
						<li style="margin: 0 0 0 5% !important;float: right;"><?php if($rs_configuracao['telefoneloja'] != '') { ?><i class="fa-li fa fa-phone"></i><?php echo $rs_configuracao['telefoneloja'];?><?php } ?></li>
						<li style="margin: 0 0 0 5% !important;float: right;"><?php if($rs_configuracao['emailloja'] != '') { ?><i class="fa-li fa fa-envelope"></i><?php echo $rs_configuracao['emailloja'];?><?php } ?></li>
					</ul>
				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 rede_p" style="padding-left:0; ">
					<ul class="address-ul fa-ul" style="margin-left:0; font-size:20px;">
		                <?php if($rs_configuracao['facebook'] != ''){ ?><li><a href="<?php echo $rs_configuracao['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['twitter'] != ''){ ?><li><a href="<?php echo $rs_configuracao['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['googleplus'] != ''){ ?><li><a href="<?php echo $rs_configuracao['googleplus'];?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['flickr'] != ''){ ?><li><a href="<?php echo $rs_configuracao['flickr'];?>" target="_blank"><i class="fa fa-flickr"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['linkedin'] != ''){ ?><li><a href="<?php echo $rs_configuracao['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['instagram'] != ''){ ?><li><a href="<?php echo $rs_configuracao['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
		                <?php if($rs_configuracao['pinterest'] != ''){ ?><li><a href="<?php echo $rs_configuracao['pinterest'];?>" target="_blank"></a></li><?php } ?>
						<li><a href="#"></a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 conta_p1" style="padding-right:0;">
					<ul class="address-ul fa-ul">
						<li style="margin: 0 0 0 5% !important;float: right;"><?php if($rs_configuracao['telefoneloja'] != '') { ?><i class="fa-li fa fa-phone"></i><?php echo $rs_configuracao['telefoneloja'];?><?php } ?></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 conta_p2" style="padding-right:0;">
					<ul class="address-ul fa-ul">
						<li style="margin: 0 0 0 5% !important;float: right;"><?php if($rs_configuracao['emailloja'] != '') { ?><i class="fa-li fa fa-envelope"></i><?php echo $rs_configuracao['emailloja'];?><?php } ?></li>
					</ul>
				</div>
			</div>
		</div>

        <div class="container cont_cab_p" style="padding-left:0;">

            <!-- Logo -->
            <div class="logo pull-left">
                <a id="logo1" href="<?php echo $siteUrl;?>"><img src="<?php echo $rs_configuracao['logomarca'];?>" alt="<?php echo $rs_configuracao['nomeloja'];?>" style="max-width:100%;" height="53"/></a>
            </div>
            <!-- /Logo -->

			<div class="additional pull-right" style="padding-right:0; margin-top:15px;">
                <div class="pull-left">
                	<?php if(@$_SESSION['cliente'] != '') {?>
                    <ul class="ul-top">
                        <li><?php echo $_SESSION['nome_cliente']?></li>
                        <li><a href="<?php echo $siteUrl;?>home/0/0/0/0/0/0/0/0/0/1">Sair</a></li>
                    </ul>
                    <?php } else { ?>
					<ul class="ul-top">
                        <li><a href="#" data-toggle="modal" data-target="#ModalLogin">Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#ModalRegister">Cadastrar</a></li>
                    </ul>

					<?php } ?>
                    <?php if(isset($_SESSION['carrinho'])){ ?>
                    <div class="ul-cart pull-right">
                        <a href="<?php echo $siteUrl;?>carrinho/48"><i class="fa fa-shopping-cart"></i><span><?php echo (isset($carrinhoSessao) ? $carrinhoSessao->getQtdeProdutos() : 0);?> items</span></a>
                    </div>
                    <?php } ?>
                </div>
            </div>

			<?php
			$sql_subcategoria = "SELECT DISTINCT sc.* FROM tbprod_subcategoria sc INNER JOIN tbproduto p ON p.subcategoria_id = sc.id
														WHERE p.status = 1 AND sc.categoria_id = 1 ORDER BY sc.titulo ASC";
			$resultado_subcategoria = $conecta->selecionar($conecta->conn, $sql_subcategoria);

			$sql_marca = "SELECT DISTINCT sc.* FROM tbprod_subcategoria sc INNER JOIN tbproduto p ON p.subcategoria_id = sc.id
														WHERE p.status = 1 AND sc.categoria_id <> 1 ORDER BY sc.titulo ASC";
			$resultado_marca = $conecta->selecionar($conecta->conn,$sql_marca);

			?>

            <!-- Navigation -->
            <!--<div id="mobile-menu"></div>-->
			<div id="menumobile">
				<i class="fa fa-bars" id="menumobile1"></i>
				<div id="menu_mobile">
					<ul>
	                    <li <?php if(empty($tela)) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>">Home</a></li>
						<li <?php if($tela == 17) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>catalogo/21">Produtos</a></li>
	                    <li><a href="<?php echo $siteUrl;?>quem-somos/10">Quem Somos</a></li>
						<li><a href="<?php echo $siteUrl;?>parceiro/15">Parceiros</a></li>
						<li><a href="<?php echo $siteUrl;?>trabalhe-conosco/38">Trabalhe Conosco</a></li>
	                    <li <?php if($tela == 16) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>fale-conosco/16" style="padding: 4px 10px 4px 10px;">Fale Conosco</a></li>
						<li><a href="<?php echo $siteUrl;?>busca/21" style="padding: 4px 10px 4px 10px; font-weight:bold;"><i class="fa fa-search"></i></a></li>
	                </ul><!-- /.sf-menu -->
				</div>
			</div>
            <nav class="navigation clearfix pull-right" style="margin-top:1px; ">
                <ul class="sf-menu">
                    <li <?php if(empty($tela)) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>">Home</a></li>
					<li <?php if($tela == 17) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>catalogo/21">Produtos</a>
						<ul class="sub-menu">
							<?php while($rs_subcategoria = mysqli_fetch_array($resultado_subcategoria)){ ?>
                            <li><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/<?php echo $rs_subcategoria['id'];?>"><?php echo $rs_subcategoria['titulo'];?></a></li>
                            <?php } ?>
                        </ul>
					</li>
					<li <?php if($tela == 17) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>catalogo/21">Utilidades Domésticas</a>
						<ul class="sub-menu">
							<?php while($rs_fornecedor = mysqli_fetch_array($resultado_marca)){ ?>
                            <li><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/<?php echo $rs_fornecedor['id'];?>"><?php echo $rs_fornecedor['titulo'];?></a></li>
                            <?php } ?>
                        </ul>
					</li>
                    <li <?php if($tela == 10 || $tela == 62 || $tela == 14 || $tela == 15 || $tela == 37 || $tela == 18) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>quem-somos/9">Empresa</a>
						<ul class="sub-menu">
                            <li><a href="<?php echo $siteUrl;?>quem-somos/10">Quem Somos</a></li>
							<li><a href="<?php echo $siteUrl;?>parceiro/15">Parceiros</a></li>
							<li><a href="<?php echo $siteUrl;?>trabalhe-conosco/38">Trabalhe Conosco</a></li>
                        </ul>
					</li>
                    <li <?php if($tela == 16) { echo 'class="active"'; } ?>><a href="<?php echo $siteUrl;?>fale-conosco/16" style="padding: 4px 10px 4px 10px;">Fale Conosco</a></li>
					<li><a href="<?php echo $siteUrl;?>busca/21" style="padding: 4px 10px 4px 10px; font-weight:bold;"><i class="fa fa-search"></i></a></li>
                </ul><!-- /.sf-menu -->
            </nav><!-- /.navigation -->
            <!-- /Navigation -->

        </div><!-- /.container -->
	<?php } ?>

	<?php
	if($pagina == 'post'){

		$filtro_vw = "";
		$tabela = "tbgrupo_noticia";
		if($vw != '' && $vw != 0){
			$filtro_vw = " AND t.id = $vw";
		}
		$sql_post = "SELECT t.*, a.titulo as autor, a.arquivo as fotoautor, a.conteudo as dadosautor, c.titulo as categoria, t.documento FROM tbgrupo_noticia t INNER JOIN tbautor a ON a.id = t.autor_id INNER JOIN tbcategoria c ON c.id = t.categoria_id WHERE t.status = 1 AND t.tela_id = $tela $filtro_vw";
		$resultado_post = $conecta->selecionar($conecta->conn,$sql_post);
		$rs_post = mysqli_fetch_array($resultado_post);

		$categ = $rs_post['categoria_id'];

	}
	?>
