<?php

$tela_id = $_GET['tela'];

$sql_tela = 'SELECT * FROM tbtela WHERE id = '.$tela_id;
$resultado_tela = $conecta->selecionar($conecta->conn,$sql_tela);
$rs_tela = mysqli_fetch_array($resultado_tela);

$tabela = $rs_tela['tabela'];
$idtela = $rs_tela['id'];
$nometela = $rs_tela['nome'];


if(isset($_POST['gravar']) && $_POST['gravar'] == "Gravar"){
	$dados = $_POST["dados"];

	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$linkloja =    strip_tags(trim($dados[$tabela]['linkloja']));
	$nomeloja =  strip_tags(trim($dados[$tabela]['nomeloja']));
	$titulopagina =  strip_tags(trim($dados[$tabela]['titulopagina']));
	$emailloja =  strip_tags(trim($dados[$tabela]['emailloja']));
	$telefoneloja =  strip_tags(trim($dados[$tabela]['telefoneloja']));
    $whatsapp =  strip_tags(trim($dados[$tabela]['whatsapp']));
	$enderecoloja =  $dados[$tabela]['enderecoloja'];
	$endereco_mapa =  $dados[$tabela]['endereco_mapa'];
	$emailloja2 =  strip_tags(trim($dados[$tabela]['emailloja2']));
	$telefoneloja2 =  strip_tags(trim($dados[$tabela]['telefoneloja2']));
    $whatsapp2 =  strip_tags(trim($dados[$tabela]['whatsapp2']));
	$enderecoloja2 =  $dados[$tabela]['enderecoloja2'];
	$endereco_mapa2 =  $dados[$tabela]['endereco_mapa2'];
	$qtdeproduto =  strip_tags(trim($dados[$tabela]['qtde_produto']));
	$qtdeimagem =  strip_tags(trim($dados[$tabela]['qtde_imagem']));
	$keyword =  strip_tags(trim($dados[$tabela]['keyword']));
	$meta =  strip_tags(trim($dados[$tabela]['meta']));
	$loja = strip_tags(trim($dados[$tabela]['loja']));
	$favicon =   strip_tags(trim($dados[$tabela]['favicon']));
	$linkmapa =  strip_tags(trim($dados[$tabela]['linkmapa']));
	$linkmapa2 =  strip_tags(trim($dados[$tabela]['linkmapa2']));
	$copyright = strip_tags(trim($dados[$tabela]['copyright']));

	$cor_box_produto = strip_tags(trim($dados[$tabela]['cor_box_produto']));
	$cor_linha_box = strip_tags(trim($dados[$tabela]['cor_linha_box']));
	$cor_linha_box_hover = strip_tags(trim($dados[$tabela]['cor_linha_box_hover']));

	$cor_icone_rodape  = strip_tags(trim($dados[$tabela]['cor_icone_rodape']));
	$cor_fonte_rodape  = strip_tags(trim($dados[$tabela]['cor_fonte_rodape']));
	$cor_botao_rodape  = strip_tags(trim($dados[$tabela]['cor_botao_rodape']));
	$cor_botao_rodape_hover  = strip_tags(trim($dados[$tabela]['cor_botao_rodape_hover']));
	$cor_fonte_item_rodape  = strip_tags(trim($dados[$tabela]['cor_fonte_item_rodape']));

	$cor_categoria_servico  = strip_tags(trim($dados[$tabela]['cor_categoria_servico']));
	$cor_titulo_blog  = strip_tags(trim($dados[$tabela]['cor_titulo_blog']));
	$fundo_container_tipo  = strip_tags(trim($dados[$tabela]['fundo_container_tipo']));
	$cor_texto_produto  = strip_tags(trim($dados[$tabela]['cor_texto_produto']));
	$cor_texto_produto_hover  = strip_tags(trim($dados[$tabela]['cor_texto_produto_hover']));
	$cor_fundo_imagem  = strip_tags(trim($dados[$tabela]['cor_fundo_imagem']));
	$cor_fundo_icone  = strip_tags(trim($dados[$tabela]['cor_fundo_icone']));

	$cor_hover_menu_lateral = strip_tags(trim($dados[$tabela]['cor_hover_menu_lateral']));
	$cor_fundo_box_blog = strip_tags(trim($dados[$tabela]['cor_fundo_box_blog']));
	$cor_fundo_blog = strip_tags(trim($dados[$tabela]['cor_fundo_blog']));

	$cor_fundo_box_galeria = strip_tags(trim($dados[$tabela]['cor_fundo_box_galeria']));
	$cor_fundo_box_categoria = strip_tags(trim($dados[$tabela]['cor_fundo_box_categoria']));

	$cor_sobconsulta = strip_tags(trim($dados[$tabela]['cor_sobconsulta']));
	$cor_sobconsulta_hover = strip_tags(trim($dados[$tabela]['cor_sobconsulta_hover']));

    $facebook = strip_tags(trim($dados[$tabela]['facebook']));
    $twitter = strip_tags(trim($dados[$tabela]['twitter']));
    $googleplus = strip_tags(trim($dados[$tabela]['googleplus']));
    $linkedin = strip_tags(trim($dados[$tabela]['linkedin']));
    $instagram = strip_tags(trim($dados[$tabela]['instagram']));
    $pinterest = strip_tags(trim($dados[$tabela]['pinterest']));
	$flickr = strip_tags(trim( $dados[$tabela]['flickr']));

	$logomarca =  strip_tags(trim($dados[$tabela]['logomarca']));
	$logorodape =  strip_tags(trim($dados[$tabela]['logorodape']));

	$cor_titulo_home = strip_tags(trim($dados[$tabela]['cor_titulo_home']));

	$sobre_loja = $dados[$tabela]['sobre_loja'];
    $nossa_loja = $dados[$tabela]['nossa_loja'];
	$titulo_contato = strip_tags(trim($dados[$tabela]['titulo_contato']));
	$texto_contato = strip_tags(trim($dados[$tabela]['texto_contato']));
	$titulo_sobre_loja = strip_tags(trim($dados[$tabela]['titulo_sobre_loja']));
	$titulo_nossa_loja = strip_tags(trim($dados[$tabela]['titulo_nossa_loja']));
	$fundo_sobre_loja = strip_tags(trim($dados[$tabela]['fundo_sobre_loja']));
	$fundo_nossa_loja = strip_tags(trim($dados[$tabela]['fundo_nossa_loja']));

    $fundo_site = strip_tags(trim($dados[$tabela]['fundo_site']));
    $barra_cabecalho = strip_tags(trim($dados[$tabela]['barra_cabecalho']));
    $fonte_barra_cabecalho = strip_tags(trim($dados[$tabela]['fonte_barra_cabecalho']));
    $fundo_cabecalho = strip_tags(trim($dados[$tabela]['fundo_cabecalho']));
    $fundo_menu_top = strip_tags(trim($dados[$tabela]['fundo_menu_top']));
    $fonte_menu_top = strip_tags(trim($dados[$tabela]['fonte_menu_top']));
    $fonte_menu_top_hover = strip_tags(trim($dados[$tabela]['fonte_menu_top_hover']));
	$fundo_navegacao = strip_tags(trim($dados[$tabela]['fundo_navegacao']));
	$fonte_navegacao = strip_tags(trim($dados[$tabela]['fonte_navegacao']));
    $fundo_banner = strip_tags(trim($dados[$tabela]['fundo_banner']));
    $fundo_newsletter = strip_tags(trim($dados[$tabela]['fundo_newsletter']));
    $fundo_abas = strip_tags(trim($dados[$tabela]['fundo_abas']));
    $fundo_rodape = strip_tags(trim($dados[$tabela]['fundo_rodape']));
    $barra_rodape = strip_tags(trim($dados[$tabela]['barra_rodape']));
    $fundo_menu_lateral = strip_tags(trim($dados[$tabela]['fundo_menu_lateral']));
	$fundo_menu_lateral_blog = strip_tags(trim($dados[$tabela]['fundo_menu_lateral_blog']));

	$fundo_produtos_destaque = strip_tags(trim($dados[$tabela]['fundo_produtos_destaque']));
	$fundo_produtos_promocao = strip_tags(trim($dados[$tabela]['fundo_produtos_promocao']));
	$fundo_box_diversos = strip_tags(trim($dados[$tabela]['fundo_box_diversos']));
	$fundo_ultimos_produtos = strip_tags(trim($dados[$tabela]['fundo_ultimos_produtos']));
	$fundo_categoria = strip_tags(trim($dados[$tabela]['fundo_categoria']));
	$fundo_carrocel= strip_tags(trim($dados[$tabela]['fundo_carrocel']));

	$fundo_container_logomarcas = strip_tags(trim($dados[$tabela]['fundo_container_logomarcas']));

	$texto_comentario  = str_replace("{Nome do site}","",$dados[$tabela]['texto_comentario']);
	$dados[$tabela]['texto_comentario'] = $texto_comentario;
	$fundo_comentario  = strip_tags(trim($dados[$tabela]['fundo_comentario']));
	$fundo_resposta  = strip_tags(trim($dados[$tabela]['fundo_resposta']));

	$fundo_box_destaque  =  strip_tags(trim($dados[$tabela]['fundo_box_destaque']));
	$fundo_box_selecionados = strip_tags(trim($dados[$tabela]['fundo_box_selecionados']));
	$fundo_box_premium = strip_tags(trim($dados[$tabela]['fundo_box_premium']));
	$fundo_box_kits = strip_tags(trim($dados[$tabela]['fundo_box_kits']));
	$fundo_box_ultimos = strip_tags(trim($dados[$tabela]['fundo_box_ultimos']));

	$cor_botao = strip_tags(trim($dados[$tabela]['cor_botao']));
	$cor_botao_hover = strip_tags(trim($dados[$tabela]['cor_botao_hover']));

	$cor_icone = strip_tags(trim($dados[$tabela]['cor_icone']));

	$container_topo  = strip_tags(trim($dados[$tabela]['container_topo']));
	$container_rodape  = strip_tags(trim($dados[$tabela]['container_rodape']));

	$container_produtosdestaques = strip_tags(trim($dados[$tabela]['container_produtosdestaques']));
	$container_banner = strip_tags(trim($dados[$tabela]['container_banner']));
	$container_produtosselecionados  = strip_tags(trim($dados[$tabela]['container_produtosselecionados']));
	$container_produtospremium  = strip_tags(trim($dados[$tabela]['container_produtospremium']));
	$container_blog  = strip_tags(trim($dados[$tabela]['container_blog']));
	$container_kits  = strip_tags(trim($dados[$tabela]['container_kits']));
	$container_depoimento  = strip_tags(trim($dados[$tabela]['container_depoimento']));
	$container_foto  = strip_tags(trim($dados[$tabela]['container_foto']));
	$container_produtosultimos  = strip_tags(trim($dados[$tabela]['container_produtosultimos']));
	$container_bannerpequeno  = strip_tags(trim($dados[$tabela]['container_bannerpequeno']));
	$container_parceiros  = strip_tags(trim($dados[$tabela]['container_parceiros']));
	$container_newsletter  = strip_tags(trim($dados[$tabela]['container_newsletter']));
	$container_categoria  = strip_tags(trim($dados[$tabela]['container_categoria']));
	$container_minibanner  = strip_tags(trim($dados[$tabela]['container_minibanner']));

	$fundo_container_produtosdestaques  = strip_tags(trim($dados[$tabela]['fundo_container_produtosdestaques']));
	$fundo_container_banner  = strip_tags(trim($dados[$tabela]['fundo_container_banner']));
	$fundo_container_produtosselecionados  = strip_tags(trim($dados[$tabela]['fundo_container_produtosselecionados']));
	$fundo_container_premium  = strip_tags(trim($dados[$tabela]['fundo_container_premium']));
	$fundo_container_kits  = strip_tags(trim($dados[$tabela]['fundo_container_kits']));
	$fundo_container_blog  = strip_tags(trim($dados[$tabela]['fundo_container_blog']));
	$fundo_container_depoimento  = strip_tags(trim($dados[$tabela]['fundo_container_depoimento']));
	$fundo_container_foto  = strip_tags(trim($dados[$tabela]['fundo_container_foto']));
	$fundo_container_produtosultimos  = strip_tags(trim($dados[$tabela]['fundo_container_produtosultimos']));
	$fundo_container_bannerpequeno  = strip_tags(trim($dados[$tabela]['fundo_container_bannerpequeno']));
	$fundo_container_parceiros  = strip_tags(trim($dados[$tabela]['fundo_container_parceiros']));
	$fundo_container_newsletter  = strip_tags(trim($dados[$tabela]['fundo_container_newsletter']));
	$fundo_container_categoria  = strip_tags(trim($dados[$tabela]['fundo_container_categoria']));
	$fundo_container_minibanner  = strip_tags(trim($dados[$tabela]['fundo_container_minibanner']));

	$cor_barra_sidebar_prod = strip_tags(trim($dados[$tabela]['cor_barra_sidebar_prod']));
	$cor_categoria_sidebar_prod = strip_tags(trim($dados[$tabela]['cor_categoria_sidebar_prod']));
	$cor_subcategoria_sidebar_prod = strip_tags(trim($dados[$tabela]['cor_subcategoria_sidebar_prod']));

	$box1  = $dados[$tabela]['box1'];
	$box2  = $dados[$tabela]['box2'];
	$box3  = $dados[$tabela]['box3'];

	$cor_titulo_box1  = strip_tags(trim($dados[$tabela]['cor_titulo_box1']));
	$cor_fundo_box1  = strip_tags(trim($dados[$tabela]['cor_fundo_box1']));
	$cor_titulo_box2  = strip_tags(trim($dados[$tabela]['cor_titulo_box2']));
	$cor_fundo_box2  = strip_tags(trim($dados[$tabela]['cor_fundo_box2']));
	$cor_titulo_box3  = strip_tags(trim($dados[$tabela]['cor_titulo_box3']));
	$cor_fundo_box3  = strip_tags(trim($dados[$tabela]['cor_fundo_box3']));

	$link_fonte = strip_tags(trim($dados[$tabela]['link_fonte']));
	$nome_fonte = strip_tags(trim($dados[$tabela]['nome_fonte']));

	$link_fonte2 = strip_tags(trim($dados[$tabela]['link_fonte2']));
	$nome_fonte2 = strip_tags(trim($dados[$tabela]['nome_fonte2']));

	$link_fonte3 = strip_tags(trim($dados[$tabela]['link_fonte3']));
	$nome_fonte3 = strip_tags(trim($dados[$tabela]['nome_fonte3']));

	$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];

	if(empty($emailloja)) {
		$retorno = '<div class="alert alert-danger">Informe o e-mail da Loja!</div>';
	}elseif (empty($nomeloja)) {
		$retorno = '<div class="alert alert-danger">Selecione o logo da Loja!</div>';
	}

	if (empty($retorno)) {

		$resultado = $conecta->inserir($dados);
		echo '<span class="retorno">'.$resultado.'</span>';
	} else {
		echo $retorno;
	}
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "Gravar"){

	$dados = $_POST["dados"];

	$id = 			strip_tags(trim($dados[$tabela]['id']));
	$linkloja =    strip_tags(trim($dados[$tabela]['linkloja']));
	$nomeloja =  strip_tags(trim($dados[$tabela]['nomeloja']));
	$titulopagina =  strip_tags(trim($dados[$tabela]['titulopagina']));
	$emailloja =  strip_tags(trim($dados[$tabela]['emailloja']));
	$telefoneloja =  strip_tags(trim($dados[$tabela]['telefoneloja']));
    $whatsapp =  strip_tags(trim($dados[$tabela]['whatsapp']));
	$enderecoloja =  $dados[$tabela]['enderecoloja'];
	$endereco_mapa =  $dados[$tabela]['endereco_mapa'];
	$emailloja2 =  strip_tags(trim($dados[$tabela]['emailloja2']));
	$telefoneloja2 =  strip_tags(trim($dados[$tabela]['telefoneloja2']));
    $whatsapp2 =  strip_tags(trim($dados[$tabela]['whatsapp2']));
	$enderecoloja2 =  $dados[$tabela]['enderecoloja2'];
	$endereco_mapa2 =  @$dados[$tabela]['endereco_mapa2'];
	$qtdeproduto =  strip_tags(trim(@$dados[$tabela]['qtde_produto']));
	$qtdeimagem =  strip_tags(trim(@$dados[$tabela]['qtde_imagem']));
	$keyword =  strip_tags(trim($dados[$tabela]['keyword']));
	$meta =  strip_tags(trim($dados[$tabela]['meta']));
	$loja = strip_tags(trim($dados[$tabela]['loja']));
	$favicon =   strip_tags(trim($dados[$tabela]['favicon']));

	if($dados[$tabela]['linkmapa'] != ''){
		$linkmapa =  strip_tags(trim($dados[$tabela]['linkmapa']));
	} else {
		unset($dados[$tabela]['linkmapa']);
	}
	if($dados[$tabela]['linkmapa2'] != ''){
		$linkmapa2 =  strip_tags(trim($dados[$tabela]['linkmapa2']));
	} else {
		unset($dados[$tabela]['linkmapa2']);
	}

	$copyright = strip_tags(trim($dados[$tabela]['copyright']));

	$logomarca =  strip_tags(trim($dados[$tabela]['logomarca']));
	$logorodape =  strip_tags(trim($dados[$tabela]['logorodape']));

    $facebook = strip_tags(trim($dados[$tabela]['facebook']));
    $twitter = strip_tags(trim($dados[$tabela]['twitter']));
    $googleplus = strip_tags(trim($dados[$tabela]['googleplus']));
    $linkedin = strip_tags(trim($dados[$tabela]['linkedin']));
    $instagram = strip_tags(trim($dados[$tabela]['instagram']));
    $pinterest = strip_tags(trim($dados[$tabela]['pinterest']));
	$flickr = strip_tags(trim( $dados[$tabela]['flickr']));

	$sobre_loja = $dados[$tabela]['sobre_loja'];
    $nossa_loja = $dados[$tabela]['nossa_loja'];
	$titulo_contato = strip_tags(trim($dados[$tabela]['titulo_contato']));
	$texto_contato = strip_tags(trim($dados[$tabela]['texto_contato']));
	$titulo_sobre_loja = strip_tags(trim($dados[$tabela]['titulo_sobre_loja']));
	$titulo_nossa_loja = strip_tags(trim($dados[$tabela]['titulo_nossa_loja']));
	$fundo_sobre_loja = strip_tags(trim($dados[$tabela]['fundo_sobre_loja']));
	$fundo_nossa_loja = strip_tags(trim($dados[$tabela]['fundo_nossa_loja']));

	$cor_box_produto = strip_tags(trim($dados[$tabela]['cor_box_produto']));
	$cor_linha_box = strip_tags(trim($dados[$tabela]['cor_linha_box']));
	$cor_linha_box_hover = strip_tags(trim($dados[$tabela]['cor_linha_box_hover']));

	$cor_categoria_servico  = strip_tags(trim($dados[$tabela]['cor_categoria_servico']));
	$cor_titulo_blog  = strip_tags(trim($dados[$tabela]['cor_titulo_blog']));
	$fundo_container_tipo  = strip_tags(trim($dados[$tabela]['fundo_container_tipo']));
	$cor_texto_produto  = strip_tags(trim($dados[$tabela]['cor_texto_produto']));
	$cor_texto_produto_hover  = strip_tags(trim($dados[$tabela]['cor_texto_produto_hover']));
	$cor_fundo_imagem  = strip_tags(trim($dados[$tabela]['cor_fundo_imagem']));
	$cor_fundo_icone  = strip_tags(trim($dados[$tabela]['cor_fundo_icone']));

	$cor_icone_rodape  = strip_tags(trim($dados[$tabela]['cor_icone_rodape']));
	$cor_fonte_rodape  = strip_tags(trim($dados[$tabela]['cor_fonte_rodape']));
	$cor_botao_rodape  = strip_tags(trim($dados[$tabela]['cor_botao_rodape']));
	$cor_botao_rodape_hover  = strip_tags(trim($dados[$tabela]['cor_botao_rodape_hover']));
	$cor_fonte_item_rodape  = strip_tags(trim($dados[$tabela]['cor_fonte_item_rodape']));

	$cor_hover_menu_lateral = strip_tags(trim($dados[$tabela]['cor_hover_menu_lateral']));
	$cor_fundo_box_blog = strip_tags(trim($dados[$tabela]['cor_fundo_box_blog']));

	$cor_sobconsulta = strip_tags(trim($dados[$tabela]['cor_sobconsulta']));
	$cor_sobconsulta_hover = strip_tags(trim($dados[$tabela]['cor_sobconsulta_hover']));

	$cor_fundo_box_galeria = strip_tags(trim($dados[$tabela]['cor_fundo_box_galeria']));
	$cor_fundo_box_categoria = strip_tags(trim($dados[$tabela]['cor_fundo_box_categoria']));
	$cor_fundo_blog = strip_tags(trim($dados[$tabela]['cor_fundo_blog']));
	$cor_titulo_home = strip_tags(trim($dados[$tabela]['cor_titulo_home']));

    $fundo_site = strip_tags(trim($dados[$tabela]['fundo_site']));
    $barra_cabecalho = strip_tags(trim($dados[$tabela]['barra_cabecalho']));
    $fonte_barra_cabecalho = strip_tags(trim($dados[$tabela]['fonte_barra_cabecalho']));
    $fundo_cabecalho = strip_tags(trim($dados[$tabela]['fundo_cabecalho']));
    $fundo_menu_top = strip_tags(trim($dados[$tabela]['fundo_menu_top']));
    $fonte_menu_top = strip_tags(trim($dados[$tabela]['fonte_menu_top']));
    $fonte_menu_top_hover = strip_tags(trim($dados[$tabela]['fonte_menu_top_hover']));
	$fundo_navegacao = strip_tags(trim($dados[$tabela]['fundo_navegacao']));
	$fonte_navegacao = strip_tags(trim($dados[$tabela]['fonte_navegacao']));
    $fundo_banner = strip_tags(trim($dados[$tabela]['fundo_banner']));
    $fundo_newsletter = strip_tags(trim($dados[$tabela]['fundo_newsletter']));
    $fundo_abas = strip_tags(trim($dados[$tabela]['fundo_abas']));
    $fundo_rodape = strip_tags(trim($dados[$tabela]['fundo_rodape']));
    $barra_rodape = strip_tags(trim($dados[$tabela]['barra_rodape']));
    $fundo_menu_lateral = strip_tags(trim($dados[$tabela]['fundo_menu_lateral']));
	$fundo_menu_lateral_blog = strip_tags(trim($dados[$tabela]['fundo_menu_lateral_blog']));

	$fundo_container_logomarcas = strip_tags(trim($dados[$tabela]['fundo_container_logomarcas']));

	$fundo_produtos_destaque = strip_tags(trim($dados[$tabela]['fundo_produtos_destaque']));
	$fundo_produtos_promocao = strip_tags(trim($dados[$tabela]['fundo_produtos_promocao']));
	$fundo_box_diversos = strip_tags(trim($dados[$tabela]['fundo_box_diversos']));
	$fundo_ultimos_produtos = strip_tags(trim($dados[$tabela]['fundo_ultimos_produtos']));
	$fundo_categoria = strip_tags(trim($dados[$tabela]['fundo_categoria']));
	$fundo_carrocel= strip_tags(trim($dados[$tabela]['fundo_carrocel']));

	$texto_comentario  = str_replace("{Nome do site}","",$dados[$tabela]['texto_comentario']);
	$dados[$tabela]['texto_comentario'] = $texto_comentario;
	$fundo_comentario  = strip_tags(trim($dados[$tabela]['fundo_comentario']));
	$fundo_resposta  = strip_tags(trim($dados[$tabela]['fundo_resposta']));

	$fundo_box_destaque  =  strip_tags(trim($dados[$tabela]['fundo_box_destaque']));
	$fundo_box_selecionados = strip_tags(trim($dados[$tabela]['fundo_box_selecionados']));
	$fundo_box_premium = strip_tags(trim($dados[$tabela]['fundo_box_premium']));
	$fundo_box_kits = strip_tags(trim($dados[$tabela]['fundo_box_kits']));
	$fundo_box_ultimos = strip_tags(trim($dados[$tabela]['fundo_box_ultimos']));

	$cor_botao = strip_tags(trim($dados[$tabela]['cor_botao']));
	$cor_botao_hover = strip_tags(trim($dados[$tabela]['cor_botao_hover']));

	$cor_icone = strip_tags(trim($dados[$tabela]['cor_icone']));

	$container_topo  = strip_tags(trim($dados[$tabela]['container_topo']));
	$container_rodape  = strip_tags(trim($dados[$tabela]['container_rodape']));

	$container_produtosdestaques = strip_tags(trim($dados[$tabela]['container_produtosdestaques']));
	$container_banner = strip_tags(trim($dados[$tabela]['container_banner']));
	$container_produtosselecionados  = strip_tags(trim($dados[$tabela]['container_produtosselecionados']));
	$container_produtospremium  = strip_tags(trim($dados[$tabela]['container_produtospremium']));
	$container_blog  = strip_tags(trim($dados[$tabela]['container_blog']));
	$container_kits  = strip_tags(trim($dados[$tabela]['container_kits']));
	$container_depoimento  = strip_tags(trim($dados[$tabela]['container_depoimento']));
	$container_foto  = strip_tags(trim($dados[$tabela]['container_foto']));
	$container_produtosultimos  = strip_tags(trim($dados[$tabela]['container_produtosultimos']));
	$container_bannerpequeno  = strip_tags(trim($dados[$tabela]['container_bannerpequeno']));
	$container_parceiros  = strip_tags(trim($dados[$tabela]['container_parceiros']));
	$container_newsletter  = strip_tags(trim($dados[$tabela]['container_newsletter']));
	$container_categoria  = strip_tags(trim($dados[$tabela]['container_categoria']));
	$container_minibanner  = strip_tags(trim($dados[$tabela]['container_minibanner']));

	$fundo_container_produtosdestaques  = strip_tags(trim($dados[$tabela]['fundo_container_produtosdestaques']));
	$fundo_container_banner  = strip_tags(trim($dados[$tabela]['fundo_container_banner']));
	$fundo_container_produtosselecionados  = strip_tags(trim($dados[$tabela]['fundo_container_produtosselecionados']));
	$fundo_container_premium  = strip_tags(trim($dados[$tabela]['fundo_container_premium']));
	$fundo_container_kits  = strip_tags(trim($dados[$tabela]['fundo_container_kits']));
	$fundo_container_blog  = strip_tags(trim($dados[$tabela]['fundo_container_blog']));
	$fundo_container_depoimento  = strip_tags(trim($dados[$tabela]['fundo_container_depoimento']));
	$fundo_container_foto  = strip_tags(trim($dados[$tabela]['fundo_container_foto']));
	$fundo_container_produtosultimos  = strip_tags(trim($dados[$tabela]['fundo_container_produtosultimos']));
	$fundo_container_bannerpequeno  = strip_tags(trim($dados[$tabela]['fundo_container_bannerpequeno']));
	$fundo_container_parceiros  = strip_tags(trim($dados[$tabela]['fundo_container_parceiros']));
	$fundo_container_newsletter  = strip_tags(trim($dados[$tabela]['fundo_container_newsletter']));
	$fundo_container_categoria  = strip_tags(trim($dados[$tabela]['fundo_container_categoria']));
	$fundo_container_minibanner  = strip_tags(trim($dados[$tabela]['fundo_container_minibanner']));

	$cor_barra_sidebar_prod = strip_tags(trim($dados[$tabela]['cor_barra_sidebar_prod']));
	$cor_categoria_sidebar_prod = strip_tags(trim($dados[$tabela]['cor_categoria_sidebar_prod']));
	$cor_subcategoria_sidebar_prod = strip_tags(trim($dados[$tabela]['cor_subcategoria_sidebar_prod']));

	$box1  = $dados[$tabela]['box1'];
	$box2  = $dados[$tabela]['box2'];
	$box3  = $dados[$tabela]['box3'];

	$cor_titulo_box1  = strip_tags(trim($dados[$tabela]['cor_titulo_box1']));
	$cor_fundo_box1  = strip_tags(trim($dados[$tabela]['cor_fundo_box1']));
	$cor_titulo_box2  = strip_tags(trim($dados[$tabela]['cor_titulo_box2']));
	$cor_fundo_box2  = strip_tags(trim($dados[$tabela]['cor_fundo_box2']));
	$cor_titulo_box3  = strip_tags(trim($dados[$tabela]['cor_titulo_box3']));
	$cor_fundo_box3  = strip_tags(trim($dados[$tabela]['cor_fundo_box3']));

	if(@$_POST['link_fonte'] != ''){
		$dados[$tabela]['link_fonte'] = $_POST['link_fonte'];
		$link_fonte = strip_tags(trim($dados[$tabela]['link_fonte']));
	} else{
		$link_fonte = $dados[$tabela]['link_fonte'];
	}
	$nome_fonte = strip_tags(trim($dados[$tabela]['nome_fonte']));

	if(@$_POST['link_fonte2'] != ''){
		$dados[$tabela]['link_fonte2'] = $_POST['link_fonte2'];
		$link_fonte2 = strip_tags(trim($dados[$tabela]['link_fonte2']));
	} else{
		$link_fonte2 = $dados[$tabela]['link_fonte2'];
	}
	$nome_fonte2 = strip_tags(trim($dados[$tabela]['nome_fonte2']));

	if(@$_POST['link_fonte3'] != ''){
		$dados[$tabela]['link_fonte3'] = $_POST['link_fonte3'];
		$link_fonte3 = strip_tags(trim($dados[$tabela]['link_fonte3']));
	} else{
		$link_fonte3 = $dados[$tabela]['link_fonte3'];
	}
	$nome_fonte3 = strip_tags(trim($dados[$tabela]['nome_fonte3']));

	$dados[$tabela]['usuario_id'] = $_SESSION['usuario'];

	if(empty($emailloja)) {
		$retorno = '<div class="alert alert-danger">Informe o título da Loja!</div>';
	}elseif (empty($nomeloja)) {
		$retorno = '<div class="alert alert-danger">Selecione o logo da Loja!</div>';
	}

	if (empty($retorno)) {
		$string = "id = ".$id;

		$resultado = $conecta->alterar($dados, $string);
		echo '<span class="retorno">'.$resultado.'</span>';
	} else {
		echo $retorno;
	}

} else {
	$sql = "SELECT * FROM $tabela where tela_id = $idtela";

	$resultado = $conecta->selecionar($conecta->conn,$sql);
	$dados[$tabela] = mysqli_fetch_assoc($resultado);

	$id = strip_tags(trim($dados[$tabela]['id']));
	$linkloja =    strip_tags(trim($dados[$tabela]['linkloja']));
	$nomeloja =  $dados[$tabela]['nomeloja'];
	$titulopagina =  $dados[$tabela]['titulopagina'];
	$emailloja =  $dados[$tabela]['emailloja'];
	$telefoneloja = $dados[$tabela]['telefoneloja'];
    $whatsapp =  $dados[$tabela]['whatsapp'];
	$enderecoloja =  $dados[$tabela]['enderecoloja'];
	$endereco_mapa =  $dados[$tabela]['endereco_mapa'];
	$emailloja2 =  $dados[$tabela]['emailloja2'];
	$telefoneloja2 = $dados[$tabela]['telefoneloja2'];
    $whatsapp2 =  $dados[$tabela]['whatsapp2'];
	$enderecoloja2 =  $dados[$tabela]['enderecoloja2'];
	$endereco_mapa2 =  $dados[$tabela]['endereco_mapa2'];
	$corpadrao =  $dados[$tabela]['corpadrao'];
	$fontepadrao =  $dados[$tabela]['fontepadrao'];
	$corsecundaria =  $dados[$tabela]['corsecundaria'];
	$logomarca = $dados[$tabela]['logomarca'];
	$logorodape = $dados[$tabela]['logorodape'];
	$qtdeproduto =  $dados[$tabela]['qtde_produto'];
	$qtdeimagem = $dados[$tabela]['qtde_imagem'];
	$keyword =  $dados[$tabela]['keyword'];
	$meta =  $dados[$tabela]['meta'];
	$loja = $dados[$tabela]['loja'];
	$favicon =  $dados[$tabela]['favicon'];
	$linkmapa = $dados[$tabela]['linkmapa'];
	$linkmapa2 = $dados[$tabela]['linkmapa2'];
	$copyright = $dados[$tabela]['copyright'];

	$cor_box_produto = $dados[$tabela]['cor_box_produto'];
	$cor_linha_box = $dados[$tabela]['cor_linha_box'];
	$cor_linha_box_hover = $dados[$tabela]['cor_linha_box_hover'];

	$cor_icone_rodape  = $dados[$tabela]['cor_icone_rodape'];
	$cor_fonte_rodape  = $dados[$tabela]['cor_fonte_rodape'];
	$cor_botao_rodape  = $dados[$tabela]['cor_botao_rodape'];
	$cor_botao_rodape_hover  = $dados[$tabela]['cor_botao_rodape_hover'];
	$cor_fonte_item_rodape  = $dados[$tabela]['cor_fonte_item_rodape'];

	$cor_hover_menu_lateral = $dados[$tabela]['cor_hover_menu_lateral'];

	$cor_fundo_box_blog = $dados[$tabela]['cor_fundo_box_blog'];
	$cor_fundo_box_galeria = $dados[$tabela]['cor_fundo_box_galeria'];
	$cor_fundo_box_categoria = $dados[$tabela]['cor_fundo_box_categoria'];

	$cor_sobconsulta = $dados[$tabela]['cor_sobconsulta'];
	$cor_sobconsulta_hover = $dados[$tabela]['cor_sobconsulta_hover'];

	$cor_categoria_servico  = $dados[$tabela]['cor_categoria_servico'];
	$cor_titulo_blog  = $dados[$tabela]['cor_titulo_blog'];
	$fundo_container_tipo  = $dados[$tabela]['fundo_container_tipo'];
	$cor_texto_produto  = $dados[$tabela]['cor_texto_produto'];
	$cor_texto_produto_hover  = $dados[$tabela]['cor_texto_produto_hover'];
	$cor_fundo_imagem  = $dados[$tabela]['cor_fundo_imagem'];
	$cor_fundo_icone  = $dados[$tabela]['cor_fundo_icone'];

	$cor_fundo_blog = $dados[$tabela]['cor_fundo_blog'];

    $facebook = $dados[$tabela]['facebook'];
    $twitter = $dados[$tabela]['twitter'];
    $googleplus = $dados[$tabela]['googleplus'];
    $linkedin = $dados[$tabela]['linkedin'];
    $instagram = $dados[$tabela]['instagram'];
    $pinterest = $dados[$tabela]['pinterest'];
	$flickr = $dados[$tabela]['flickr'];

    $sobre_loja = $dados[$tabela]['sobre_loja'];
    $nossa_loja = $dados[$tabela]['nossa_loja'];
	$titulo_contato = $dados[$tabela]['titulo_contato'];
	$texto_contato = $dados[$tabela]['texto_contato'];
	$titulo_sobre_loja = $dados[$tabela]['titulo_sobre_loja'];
	$titulo_nossa_loja = $dados[$tabela]['titulo_nossa_loja'];
	$fundo_sobre_loja = $dados[$tabela]['fundo_sobre_loja'];
	$fundo_nossa_loja = $dados[$tabela]['fundo_nossa_loja'];

    $fundo_site = $dados[$tabela]['fundo_site'];
    $barra_cabecalho = $dados[$tabela]['barra_cabecalho'];
    $fonte_barra_cabecalho =$dados[$tabela]['fonte_barra_cabecalho'];
    $fundo_cabecalho = $dados[$tabela]['fundo_cabecalho'];
    $fundo_menu_top = $dados[$tabela]['fundo_menu_top'];
    $fonte_menu_top = $dados[$tabela]['fonte_menu_top'];
    $fonte_menu_top_hover = $dados[$tabela]['fonte_menu_top_hover'];
	$fundo_navegacao = $dados[$tabela]['fundo_navegacao'];
	$fonte_navegacao = $dados[$tabela]['fonte_navegacao'];
    $fundo_banner = $dados[$tabela]['fundo_banner'];
    $fundo_newsletter = $dados[$tabela]['fundo_newsletter'];
    $fundo_abas = $dados[$tabela]['fundo_abas'];
    $fundo_rodape = $dados[$tabela]['fundo_rodape'];
    $barra_rodape = $dados[$tabela]['barra_rodape'];
    $fundo_menu_lateral = $dados[$tabela]['fundo_menu_lateral'];
	$fundo_menu_lateral_blog = $dados[$tabela]['fundo_menu_lateral_blog'];

	$fundo_container_logomarcas = $dados[$tabela]['fundo_container_logomarcas'];

	$fundo_produtos_destaque = $dados[$tabela]['fundo_produtos_destaque'];
	$fundo_produtos_promocao = $dados[$tabela]['fundo_produtos_promocao'];
	$fundo_box_diversos = $dados[$tabela]['fundo_box_diversos'];
	$fundo_ultimos_produtos = $dados[$tabela]['fundo_ultimos_produtos'];
	$fundo_categoria = $dados[$tabela]['fundo_categoria'];
	$fundo_carrocel = $dados[$tabela]['fundo_carrocel'];

	$texto_comentario  = $dados[$tabela]['texto_comentario'];
	$fundo_comentario  = $dados[$tabela]['fundo_comentario'];
	$fundo_resposta  = $dados[$tabela]['fundo_resposta'];

	$fundo_box_selecionados = $dados[$tabela]['fundo_box_selecionados'];
	$fundo_box_destaque  = $dados[$tabela]['fundo_box_destaque'];
	$fundo_box_premium = $dados[$tabela]['fundo_box_premium'];
	$fundo_box_kits = $dados[$tabela]['fundo_box_kits'];
	$fundo_box_ultimos = $dados[$tabela]['fundo_box_ultimos'];

	$cor_titulo_home = $dados[$tabela]['cor_titulo_home'];

	$cor_botao = $dados[$tabela]['cor_botao'];
	$cor_botao_hover = $dados[$tabela]['cor_botao_hover'];

	$cor_icone = $dados[$tabela]['cor_icone'];

	$container_topo  = $dados[$tabela]['container_topo'];
	$container_rodape  = $dados[$tabela]['container_rodape'];

	$container_produtosdestaques = $dados[$tabela]['container_produtosdestaques'];
	$container_banner = $dados[$tabela]['container_banner'];
	$container_produtosselecionados  = $dados[$tabela]['container_produtosselecionados'];
	$container_produtospremium  = $dados[$tabela]['container_produtospremium'];
	$container_blog  = $dados[$tabela]['container_blog'];
	$container_kits  = $dados[$tabela]['container_kits'];
	$container_depoimento  = $dados[$tabela]['container_depoimento'];
	$container_foto  = $dados[$tabela]['container_foto'];
	$container_produtosultimos  = $dados[$tabela]['container_produtosultimos'];
	$container_bannerpequeno  = $dados[$tabela]['container_bannerpequeno'];
	$container_parceiros  = $dados[$tabela]['container_parceiros'];
	$container_newsletter  = $dados[$tabela]['container_newsletter'];
	$container_categoria  = $dados[$tabela]['container_categoria'];
	$container_minibanner  = $dados[$tabela]['container_minibanner'];

	$fundo_container_produtosdestaques  = $dados[$tabela]['fundo_container_produtosdestaques'];
	$fundo_container_banner  = $dados[$tabela]['fundo_container_banner'];
	$fundo_container_produtosselecionados  = $dados[$tabela]['fundo_container_produtosselecionados'];
	$fundo_container_premium  = $dados[$tabela]['fundo_container_premium'];
	$fundo_container_kits  = $dados[$tabela]['fundo_container_kits'];
	$fundo_container_blog  = $dados[$tabela]['fundo_container_blog'];
	$fundo_container_depoimento  = $dados[$tabela]['fundo_container_depoimento'];
	$fundo_container_foto  = $dados[$tabela]['fundo_container_foto'];
	$fundo_container_produtosultimos  = $dados[$tabela]['fundo_container_produtosultimos'];
	$fundo_container_bannerpequeno  = $dados[$tabela]['fundo_container_bannerpequeno'];
	$fundo_container_parceiros  = $dados[$tabela]['fundo_container_parceiros'];
	$fundo_container_newsletter  = $dados[$tabela]['fundo_container_newsletter'];
	$fundo_container_categoria  = $dados[$tabela]['fundo_container_categoria'];
	$fundo_container_minibanner  = $dados[$tabela]['fundo_container_minibanner'];

	$cor_barra_sidebar_prod = $dados[$tabela]['cor_barra_sidebar_prod'];
	$cor_categoria_sidebar_prod = $dados[$tabela]['cor_categoria_sidebar_prod'];
	$cor_subcategoria_sidebar_prod = $dados[$tabela]['cor_subcategoria_sidebar_prod'];

	$box1  = $dados[$tabela]['box1'];
	$box2  = $dados[$tabela]['box2'];
	$box3  = $dados[$tabela]['box3'];

	$link_fonte = $dados[$tabela]['link_fonte'];
	$nome_fonte = $dados[$tabela]['nome_fonte'];

	$link_fonte2 = $dados[$tabela]['link_fonte2'];
	$nome_fonte2 = $dados[$tabela]['nome_fonte2'];

	$link_fonte3 = $dados[$tabela]['link_fonte3'];
	$nome_fonte3 = $dados[$tabela]['nome_fonte3'];

	$cor_titulo_box1  = $dados[$tabela]['cor_titulo_box1'];
	$cor_fundo_box1  = $dados[$tabela]['cor_fundo_box1'];
	$cor_titulo_box2  = $dados[$tabela]['cor_titulo_box2'];
	$cor_fundo_box2  = $dados[$tabela]['cor_fundo_box2'];
	$cor_titulo_box3  = $dados[$tabela]['cor_titulo_box3'];
	$cor_fundo_box3  = $dados[$tabela]['cor_fundo_box3'];

}

?>

	<form class="form-horizontal" role="form" name="formcontribuicao" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="dados[<?php echo $tabela; ?>][id]" value="<?php echo $id; ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][modificado]" value="<?php echo date("Y-m-d"); ?>" />
        <input type="hidden" name="dados[<?php echo $tabela; ?>][tela_id]" value="<?php echo $idtela; ?>" />

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Link da Loja:</label>
            <div class="col-sm-10">
            <input class="form-control" id="linkloja" placeholder="Link da Loja" type="text" name="dados[<?php echo $tabela; ?>][linkloja]"  value="<?php echo @$linkloja; ?>" />
            </div>
        </div>

        <div class="form-group" style="display:none;">
        	<label for="radio" class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][loja]" <?php if(@$loja == 1 ) { echo "checked"; } ?> value="1"> Loja
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][loja]" <?php if(@$loja == 2 ) { echo "checked"; } ?> value="2"> Catálogo
               </div>

            </div>
        </div>


		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Google Fonts:</label>
            <div class="col-sm-10">
            <input class="form-control" id="googlefont" placeholder="Google Fonts" type="text" name="link_fonte"  value="" />
			<pre><?php echo htmlentities(@$link_fonte); ?></pre>
			<input type="hidden" name="dados[<?php echo $tabela; ?>][link_fonte]" value='<?php echo @$link_fonte;?>' />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Nome da Fonte (font-family):</label>
            <div class="col-sm-10">
            <input class="form-control" id="nomefonte" placeholder="Nome da Fonte (font-family)" type="text" name="dados[<?php echo $tabela; ?>][nome_fonte]"  value="<?php echo @$nome_fonte; ?>" />
            </div>
        </div>


		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Google Fonts (Títulos):</label>
            <div class="col-sm-10">
            <input class="form-control" id="googlefont2" placeholder="Google Fonts (Títulos)" type="text" name="link_fonte2"  value="" />
			<pre><?php echo htmlentities(@$link_fonte2); ?></pre>
			<input type="hidden" name="dados[<?php echo $tabela; ?>][link_fonte2]" value='<?php echo @$link_fonte2;?>' />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Nome da Fonte (font-family) (Títulos):</label>
            <div class="col-sm-10">
            <input class="form-control" id="nomefonte2" placeholder="Nome da Fonte (font-family) (Títulos)" type="text" name="dados[<?php echo $tabela; ?>][nome_fonte2]"  value="<?php echo @$nome_fonte2; ?>" />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Google Fonts (Títulos Destaque):</label>
            <div class="col-sm-10">
            <input class="form-control" id="googlefont3" placeholder="Google Fonts (Títulos)" type="text" name="link_fonte3"  value="" />
			<pre><?php echo htmlentities(@$link_fonte3); ?></pre>
			<input type="hidden" name="dados[<?php echo $tabela; ?>][link_fonte3]" value='<?php echo @$link_fonte3;?>' />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Nome da Fonte (font-family) (Títulos Destaque):</label>
            <div class="col-sm-10">''
            <input class="form-control" id="nomefonte3" placeholder="Nome da Fonte (font-family) (Títulos)" type="text" name="dados[<?php echo $tabela; ?>][nome_fonte3]"  value="<?php echo @$nome_fonte3; ?>" />
            </div>
        </div>

		<div class="alert alert-info">Containers Disponíveis</div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Topo</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_topo]" <?php if(@$container_topo == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_topo]" <?php if(@$container_topo == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Rodapé</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_rodape]" <?php if(@$container_rodape== 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_rodape]" <?php if(@$container_rodape == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>


		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Nossos Produtos</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtosdestaques]" <?php if(@$container_produtosdestaques == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtosdestaques]" <?php if(@$container_produtosdestaques == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Banners</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_banner]" <?php if(@$container_banner == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_banner]" <?php if(@$container_banner == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Produtos em Destaque</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtosselecionados]" <?php if(@$container_produtosselecionados == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtosselecionados]" <?php if(@$container_produtosselecionados == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Produtos Selecionados</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtospremium]" <?php if(@$container_produtospremium == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtospremium]" <?php if(@$container_produtospremium == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Kits</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_kits]" <?php if(@$container_kits == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_kits]" <?php if(@$container_kits == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Blogs</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_blog]" <?php if(@$container_blog == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_blog]" <?php if(@$container_blog == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Depoimentos</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_depoimento]" <?php if(@$container_depoimento == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_depoimento]" <?php if(@$container_depoimento == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Fotos</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_foto]" <?php if(@$container_foto == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_foto]" <?php if(@$container_foto == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Produtos Últimos</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtosultimos]" <?php if(@$container_produtosultimos == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_produtosultimos]" <?php if(@$container_produtosultimos == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Banner Pequeno</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_bannerpequeno]" <?php if(@$container_bannerpequeno == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_bannerpequeno]" <?php if(@$container_bannerpequeno == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Parceiros</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_parceiros]" <?php if(@$container_parceiros == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_parceiros]" <?php if(@$container_parceiros == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Newsletter</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_newsletter]" <?php if(@$container_newsletter == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_newsletter]" <?php if(@$container_newsletter == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Categorias</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_categoria]" <?php if(@$container_categoria == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_categoria]" <?php if(@$container_categoria == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="form-group">
        	<label for="radio" class="col-sm-2 control-label">Mini Banners</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_minibanner]" <?php if(@$container_minibanner == 1 ) { echo "checked"; } ?> value="1"> Sim
                  <input type="radio" id="radio" name="dados[<?php echo $tabela;?>][container_minibanner]" <?php if(@$container_minibanner == 0 ) { echo "checked"; } ?> value="0"> Não
               </div>

            </div>
        </div>

		<div class="alert alert-info">Informações do Site</div>

		<!-- FIM CONTAINERS -->

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Nome da Loja:</label>
            <div class="col-sm-10">
            <input class="form-control" id="nomeloja" placeholder="Nome da Loja" type="text" name="dados[<?php echo $tabela; ?>][nomeloja]"  value="<?php echo @$nomeloja; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título da Página:</label>
            <div class="col-sm-10">
            <input class="form-control" id="titulopagina" placeholder="Título da Página" type="text" name="dados[<?php echo $tabela; ?>][titulopagina]"  value="<?php echo @$titulopagina; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">E-mail da Loja:</label>
            <div class="col-sm-10">
            <input class="form-control" id="emailloja" placeholder="E-mail da Loja" type="text" name="dados[<?php echo $tabela; ?>][emailloja]"  value="<?php echo @$emailloja; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Telefone da Loja:</label>
            <div class="col-sm-10">
            <input class="form-control" id="telefoneloja" placeholder="Telefone da Loja" type="text" id="telefene" name="dados[<?php echo $tabela; ?>][telefoneloja]"  value="<?php echo @$telefoneloja; ?>" />
             </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Whatsapp:</label>
            <div class="col-sm-10">
                <input class="form-control" id="whatsapp" placeholder="Whatsapp" type="text" name="dados[<?php echo $tabela; ?>][whatsapp]"  value="<?php echo @$whatsapp; ?>" />
            </div>
        </div>


		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">E-mail da Loja 2:</label>
            <div class="col-sm-10">
            <input class="form-control" id="emailloja" placeholder="E-mail da Loja 2" type="text" name="dados[<?php echo $tabela; ?>][emailloja2]"  value="<?php echo @$emailloja2; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Telefone da Loja 2:</label>
            <div class="col-sm-10">
            <input class="form-control" id="telefoneloja" placeholder="Telefone da Loja 2" type="text" id="telefene" name="dados[<?php echo $tabela; ?>][telefoneloja2]"  value="<?php echo @$telefoneloja2; ?>" />
             </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Whatsapp 2:</label>
            <div class="col-sm-10">
                <input class="form-control" id="whatsapp" placeholder="Whatsapp 2" type="text" name="dados[<?php echo $tabela; ?>][whatsapp2]"  value="<?php echo @$whatsapp2; ?>" />
            </div>
        </div>
		<!--
        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Quantidade de Produtos:</label>
            <div class="col-sm-10">
            <input class="form-control" id="qtdeproduto" placeholder="Quantidade de Produtos" type="text" name="dados[<?php echo $tabela; ?>][qtde_produto]"  value="<?php echo @$qtdeproduto; ?>" />
             </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Quantidade de Imagens:</label>
            <div class="col-sm-10">
            <input class="form-control" id="qtdeimagem" placeholder="Quantidade de Imagens" type="text" name="dados[<?php echo $tabela; ?>][qtde_imagem]"  value="<?php echo @$qtdeimagem; ?>" />
            </div>
        </div>
	-->

        <div class="form-group">
            <label for="link" class="col-sm-2 control-label">Favicon:</label>
            <div class="col-sm-10">

              <input class="form-control" type="text" name="dados[<?php echo $tabela;?>][favicon]" id="favicon" value="<?php echo @$favicon;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=favicon" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
            </div>

        </div>

        <?php if(@$favicon != '') {?>
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <img src="<?php echo $favicon; ?>" class="img-responsive" alt="Responsive image" width="10%"  />
            </div>
        </div>
        <?php } ?>

        <div class="form-group">
            <label for="link" class="col-sm-2 control-label">Logomarca:</label>
            <div class="col-sm-10">

              <input class="form-control" type="text" name="dados[<?php echo $tabela;?>][logomarca]" id="logomarca" value="<?php echo @$logomarca;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=logomarca" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
            </div>

        </div>

        <?php if(@$logomarca != '') {?>
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <img src="<?php echo $logomarca; ?>" class="img-responsive" alt="Responsive image" width="50%"  />
            </div>
        </div>
        <?php } ?>

        <div class="form-group">
            <label for="link" class="col-sm-2 control-label">Logomarca Rodapé:</label>
            <div class="col-sm-10">

              <input class="form-control" type="text" name="dados[<?php echo $tabela;?>][logorodape]" id="logorodape" value="<?php echo @$logorodape;?>" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=logorodape" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>
            </div>

        </div>
        <?php if(@$logorodape != '') {?>
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <img src="<?php echo $logorodape; ?>" class="img-responsive" alt="Responsive image" width="30%"  />
            </div>
        </div>
        <?php } ?>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título Formulário de Contato:</label>
            <div class="col-sm-10">
            <input class="form-control" id="copyright" placeholder="Título Formulário de Contato" type="text" name="dados[<?php echo $tabela; ?>][titulo_contato]"  value="<?php echo @$titulo_contato; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Texto Formulário de Contato:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="nossa_loja" placeholder="Texto Formulário de Contato" type="text" name="dados[<?php echo $tabela; ?>][texto_contato]"><?php echo @$texto_contato; ?></textarea>
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título Nossa Loja:</label>
            <div class="col-sm-10">
            <input class="form-control" id="copyright" placeholder="Título Nossa Loja" type="text" name="dados[<?php echo $tabela; ?>][titulo_nossa_loja]"  value="<?php echo @$titulo_nossa_loja; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Nossa Loja:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="nossa_loja" placeholder="Nossa Loja" type="text" name="dados[<?php echo $tabela; ?>][nossa_loja]"><?php echo @$nossa_loja; ?></textarea>
            </div>
        </div>



		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Título Sobre Loja:</label>
            <div class="col-sm-10">
            <input class="form-control" id="copyright" placeholder="Título Sobre Loja" type="text" name="dados[<?php echo $tabela; ?>][titulo_sobre_loja]"  value="<?php echo @$titulo_sobre_loja; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Sobre Loja:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="sobre_loja" placeholder="Nossa Loja" type="text" name="dados[<?php echo $tabela; ?>][sobre_loja]"><?php echo @$sobre_loja; ?></textarea>
            </div>
        </div>



        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Endereço da Loja:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="enderecoloja" placeholder="Endereço da Loja" type="text" name="dados[<?php echo $tabela; ?>][enderecoloja]"><?php echo @$enderecoloja; ?></textarea>
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Iframe de Incorporação do Mapa:</label>
            <div class="col-sm-10">
            <input class="form-control" id="linkmapa" placeholder="Link Mapa" type="text" name="dados[<?php echo $tabela; ?>][linkmapa]"  value="" />
            </div>
			<div class="col-sm-2"></div>
			<div class="col-sm-10"><pre><?php echo htmlentities(@$linkmapa); ?></pre></div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Endereço da Loja 2:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="enderecoloja2" placeholder="Endereço da Loja" type="text" name="dados[<?php echo $tabela; ?>][enderecoloja2]"><?php echo @$enderecoloja2; ?></textarea>
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Iframe de Incorporação do Mapa 2:</label>
            <div class="col-sm-10">
            <input class="form-control" id="linkmapa" placeholder="Link Mapa 2" type="text" name="dados[<?php echo $tabela; ?>][linkmapa2]"  value="" />
            </div>
			<div class="col-sm-2"></div>
			<div class="col-sm-10"><?php echo @$linkmapa2; ?></div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Copyright:</label>
            <div class="col-sm-10">
            <input class="form-control" id="copyright" placeholder="Copyright" type="text" name="dados[<?php echo $tabela; ?>][copyright]"  value="<?php echo @$copyright; ?>" />
            </div>
        </div>



        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Twitter:</label>
            <div class="col-sm-10">
            <input class="form-control" id="twitter" placeholder="Twitter" type="text" name="dados[<?php echo $tabela; ?>][twitter]"  value="<?php echo @$twitter; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Usuário Twitter:</label>
            <div class="col-sm-10">
            <input class="form-control" id="user_twitter" placeholder="Usuário Twitter" type="text" name="dados[<?php echo $tabela; ?>][user_twitter]"  value="<?php echo @$user_twitter; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Facebook:</label>
            <div class="col-sm-10">
            <input class="form-control" id="facebook" placeholder="Facebook" type="text" name="dados[<?php echo $tabela; ?>][facebook]"  value="<?php echo @$facebook; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Google Plus:</label>
            <div class="col-sm-10">
            <input class="form-control" id="googleplus" placeholder="Google Plus" type="text" name="dados[<?php echo $tabela; ?>][googleplus]"  value="<?php echo @$googleplus; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Pinterest:</label>
            <div class="col-sm-10">
            <input class="form-control" id="pinterest" placeholder="Pinterest" type="text" name="dados[<?php echo $tabela; ?>][pinterest]"  value="<?php echo @$pinterest; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Instagram:</label>
            <div class="col-sm-10">
                <input class="form-control" id="instagram" placeholder="Instagram" type="text" name="dados[<?php echo $tabela; ?>][instagram]"  value="<?php echo @$instagram; ?>" />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Flickr:</label>
            <div class="col-sm-10">
                <input class="form-control" id="instagram" placeholder="Flickr" type="text" name="dados[<?php echo $tabela; ?>][flickr]"  value="<?php echo @$flickr; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Linkedin:</label>
            <div class="col-sm-10">
                <input class="form-control" id="linkedin" placeholder="Linkedin" type="text" name="dados[<?php echo $tabela; ?>][linkedin]"  value="<?php echo @$linkedin; ?>" />
            </div>
        </div>



        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Keyword:</label>
            <div class="col-sm-10">
            <input class="form-control" id="keyword" placeholder="Keyword" type="text" name="dados[<?php echo $tabela; ?>][keyword]"  value="<?php echo @$keyword; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Description:</label>
            <div class="col-sm-10">
            <input class="form-control" id="meta" placeholder="Description" type="text" name="dados[<?php echo $tabela; ?>][meta]"  value="<?php echo @$meta; ?>" />
            </div>
        </div>



		<div class="alert alert-info">Títulos Boxes da Home</div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Box 1:</label>
            <div class="col-sm-10">
            <input class="form-control" id="meta" placeholder="Título Box 1" type="text" name="dados[<?php echo $tabela; ?>][box1]"  value="<?php echo @$box1; ?>" />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Box 2:</label>
            <div class="col-sm-10">
            <input class="form-control" id="meta" placeholder="Título Box 2" type="text" name="dados[<?php echo $tabela; ?>][box2]"  value="<?php echo @$box2; ?>" />
            </div>
        </div>

		<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Box 3:</label>
            <div class="col-sm-10">
            <input class="form-control" id="meta" placeholder="Título Box 3" type="text" name="dados[<?php echo $tabela; ?>][box3]"  value="<?php echo @$box3; ?>" />
            </div>
        </div>


		<?php if($_SESSION['perfil'] == 1){ ?>
        <div class="alert alert-info">Cores do Site</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">1 - Fundo Container Logomarcas Carrossel:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_logomarcas]" value="<?php echo $fundo_container_logomarcas;?>" id="fundo_container_logomarcas" />
				<input type="color" class="cores_slc" id="fundo_container_logomarcas_sel" value="<?php echo (@$fundo_container_logomarcas != '' ? $fundo_container_logomarcas : '#FFFFFF');?>" />
			</div>
		</div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">2 - Fundo Container Nossos Produtos:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_produtosdestaques]" value="<?php echo $fundo_container_produtosdestaques;?>" id="fundo_container_produtosdestaques" />
				<input type="color" class="cores_slc" id="fundo_container_produtosdestaques_sel" value="<?php echo (@$fundo_container_produtosdestaques != '' ? $fundo_container_produtosdestaques : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">3 - COR Fundo Box Nossos produtos:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_box_destaque]" value="<?php echo $fundo_box_destaque;?>" id="fundo_box_destaque" />
				<input type="color" class="cores_slc" id="fundo_box_destaque_sel" value="<?php echo (@$fundo_box_destaque != '' ? $fundo_box_destaque : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">4 - Fundo Container Tipo:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_tipo]" value="<?php echo $fundo_container_tipo;?>" id="fundo_container_tipo" />
				<input type="color" class="cores_slc" id="fundo_container_tipo_sel" value="<?php echo (@$fundo_container_tipo != '' ? $fundo_container_tipo : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">5 - Fundo Container Banner Grande Médio:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_banner]" value="<?php echo $fundo_container_banner;?>" id="fundo_container_banner" />
				<input type="color" class="cores_slc" id="fundo_container_banner_sel" value="<?php echo (@$fundo_container_banner != '' ? $fundo_container_banner : '#FFFFFF');?>" />
			</div>
		</div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">6 - Fundo do Site:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_site]" value="<?php echo $fundo_site;?>" id="fundo_site" />
                <input type="color" class="cores_slc" id="fundo_site_sel" value="<?php echo (@$fundo_site != '' ? $fundo_site : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000;border-right:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">7 - Barra Superior Cabeçalho:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][barra_cabecalho]" value="<?php echo $barra_cabecalho;?>" id="barra_cabecalho" />
                <input type="color" class="cores_slc" id="barra_cabecalho_sel" value="<?php echo (@$barra_cabecalho != '' ? $barra_cabecalho : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">8 - Fonte Barra Superior:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fonte_barra_cabecalho]" value="<?php echo $fonte_barra_cabecalho;?>" id="fonte_barra_cabecalho" />
                <input type="color" class="cores_slc" id="fonte_barra_cabecalho_sel" value="<?php echo (@$fonte_barra_cabecalho != '' ? $fonte_barra_cabecalho : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000;border-right:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">9 - Fundo Cabeçalho (logo):</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_cabecalho]" value="<?php echo $fundo_cabecalho;?>" id="fundo_cabecalho" />
                <input type="color" class="cores_slc" id="fundo_cabecalho_sel"  value="<?php echo (@$fundo_cabecalho != '' ? $fundo_cabecalho : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">10 - Fundo Menu:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_menu_top]" value="<?php echo $fundo_menu_top;?>" id="fundo_menu_top" />
                <input type="color" class="cores_slc" id="fundo_menu_top_sel" value="<?php echo (@$fundo_menu_top != '' ? $fundo_menu_top : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000;border-right:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">11 - Fonte Menu:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fonte_menu_top]" value="<?php echo $fonte_menu_top;?>" id="fonte_menu_top" />
                <input type="color" class="cores_slc" id="fonte_menu_top_sel" value="<?php echo (@$fonte_menu_top != '' ? $fonte_menu_top : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">12 - Fonte Menu Marcado:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fonte_menu_top_hover]" value="<?php echo $fonte_menu_top_hover;?>" id="fonte_menu_top_hover" />
                <input type="color" class="cores_slc" id="fonte_menu_top_hover_sel" value="<?php echo (@$fonte_menu_top_hover != '' ? $fonte_menu_top_hover : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">13 - Fundo Navegação:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_navegacao]" value="<?php echo $fundo_navegacao;?>" id="fundo_navegacao" />
                <input type="color" class="cores_slc" id="fundo_navegacao_sel" value="<?php echo (@$fundo_navegacao != '' ? $fundo_navegacao : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">14 - Fonte Navegação:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fonte_navegacao]" value="<?php echo $fonte_navegacao;?>" id="fonte_navegacao" />
                <input type="color" class="cores_slc" id="fonte_navegacao_sel" value="<?php echo (@$fonte_navegacao != '' ? $fonte_navegacao : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">15 - Fundo Container Produtos Selecionados:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_premium]" value="<?php echo $fundo_container_premium;?>" id="fundo_container_premium" />
				<input type="color" class="cores_slc" id="fundo_container_premium_sel" value="<?php echo (@$fundo_container_premium != '' ? $fundo_container_premium : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">16 - Fundo Box Produtos Selecionados:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_box_premium]" value="<?php echo $fundo_box_premium;?>" id="fundo_box_premium" />
				<input type="color" class="cores_slc" id="fundo_box_premium_sel" value="<?php echo (@$fundo_box_premium != '' ? $fundo_box_premium : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">17 - Fundo Container Produtos em Destaque:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_produtosselecionados]" value="<?php echo $fundo_container_produtosselecionados;?>" id="fundo_container_produtosselecionados" />
				<input type="color" class="cores_slc" id="fundo_container_produtosselecionados_sel" value="<?php echo (@$fundo_container_produtosselecionados != '' ? $fundo_container_produtosselecionados : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">18 - Fundo Container Blog:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_blog]" value="<?php echo $fundo_container_blog;?>" id="fundo_container_blog" />
				<input type="color" class="cores_slc" id="fundo_container_blog_sel" value="<?php echo (@$fundo_container_blog != '' ? $fundo_container_blog : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">19 - Fundo Container Depoimento:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_depoimento]" value="<?php echo $fundo_container_depoimento;?>" id="fundo_container_depoimento" />
				<input type="color" class="cores_slc" id="fundo_container_depoimento_sel" value="<?php echo (@$fundo_container_depoimento != '' ? $fundo_container_depoimento : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">20 - Fundo Container Fotos:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_foto]" value="<?php echo $fundo_container_foto;?>" id="fundo_container_foto" />
				<input type="color" class="cores_slc" id="fundo_container_foto_sel" value="<?php echo (@$fundo_container_foto != '' ? $fundo_container_foto : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">21 - Fundo Container 2 Banner Pequeno Médio:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_bannerpequeno]" value="<?php echo $fundo_container_bannerpequeno;?>" id="fundo_container_bannerpequeno" />
				<input type="color" class="cores_slc" id="fundo_container_bannerpequeno_sel" value="<?php echo (@$fundo_container_bannerpequeno != '' ? $fundo_container_bannerpequeno : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">22 - Fundo Container Nossos Parceiros:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_parceiros]" value="<?php echo $fundo_container_parceiros;?>" id="fundo_container_parceiros" />
				<input type="color" class="cores_slc" id="fundo_container_parceiros_sel" value="<?php echo (@$fundo_container_parceiros != '' ? $fundo_container_parceiros : '#FFFFFF');?>" />
			</div>
		</div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">23 - Fundo Container Categoria:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_categoria]" value="<?php echo $fundo_container_categoria;?>" id="fundo_container_categoria" />
				<input type="color" class="cores_slc" id="fundo_container_categoria_sel" value="<?php echo (@$fundo_container_categoria != '' ? $fundo_container_categoria : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">24 - Fundo Container Mini Banner Cartões:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_minibanner]" value="<?php echo $fundo_container_minibanner;?>" id="fundo_container_minibanner" />
				<input type="color" class="cores_slc" id="fundo_container_minibanner_sel" value="<?php echo (@$fundo_container_minibanner != '' ? $fundo_container_minibanner : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">25 - COR Fundo BOX Produtos em Promoção:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_produtos_promocao]" value="<?php echo $fundo_produtos_promocao;?>" id="fundo_produtos_promocao" />
                <input type="color" class="cores_slc" id="fundo_produtos_promocao_sel" value="<?php echo (@$fundo_produtos_promocao != '' ? $fundo_produtos_promocao : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">26 - Fundo Box Diversos:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_box_diversos]" value="<?php echo $fundo_box_diversos;?>" id="fundo_box_diversos" />
                <input type="color" class="cores_slc" id="fundo_box_diversos_sel" value="<?php echo (@$fundo_box_diversos != '' ? $fundo_box_diversos : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">27 - Fundo Container Últimos Produtos Cadastrados:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_ultimos_produtos]" value="<?php echo $fundo_ultimos_produtos;?>" id="fundo_ultimos_produtos" />
                <input type="color" class="cores_slc" id="fundo_ultimos_produtos_sel" value="<?php echo (@$fundo_ultimos_produtos != '' ? $fundo_ultimos_produtos : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">28 - Cor Tarja Menu Lateral Produtos:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_hover_menu_lateral]" value="<?php echo $cor_hover_menu_lateral;?>" id="cor_hover_menu_lateral" />
				<input type="color" class="cores_slc" id="cor_hover_menu_lateral_sel" value="<?php echo (@$cor_hover_menu_lateral != '' ? $cor_hover_menu_lateral : '#FFFFFF');?>" />
			</div>
		</div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">29 - Fundo Container Newsletter:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_newsletter]" value="<?php echo $fundo_newsletter;?>" id="fundo_newsletter" />
                <input type="color" class="cores_slc" id="fundo_newsletter_sel" value="<?php echo (@$fundo_newsletter != '' ? $fundo_newsletter : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">30 - Fundo Box Abas:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_abas]" value="<?php echo $fundo_abas;?>" id="fundo_abas" />
                <input type="color" class="cores_slc" id="fundo_abas_sel" value="<?php echo (@$fundo_abas != '' ? $fundo_abas : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">31 - Fundo Rodapé:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_rodape]" value="<?php echo $fundo_rodape;?>" id="fundo_rodape" />
                <input type="color" class="cores_slc" id="fundo_rodape_sel" value="<?php echo (@$fundo_rodape != '' ? $fundo_rodape : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">32 - Barra Rodapé:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][barra_rodape]" value="<?php echo $barra_rodape;?>" id="barra_rodape" />
                <input type="color" class="cores_slc" id="barra_rodape_sel" value="<?php echo (@$barra_rodape != '' ? $barra_rodape : '#FFFFFF');?>" />
            </div>
        </div>

        <div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">33 - Menu Lateral (Blog):</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_menu_lateral_blog]" value="<?php echo $fundo_menu_lateral_blog;?>" id="fundo_menu_lateral_blog" />
                <input type="color" class="cores_slc" id="fundo_menu_lateral_blog_sel" value="<?php echo (@$fundo_menu_lateral_blog != '' ? $fundo_menu_lateral_blog : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">34 - Menu Lateral (Catálogo):</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_menu_lateral]" value="<?php echo $fundo_menu_lateral;?>" id="fundo_menu_lateral" />
                <input type="color" class="cores_slc" id="fundo_menu_lateral_sel" value="<?php echo (@$fundo_menu_lateral != '' ? $fundo_menu_lateral : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">35 - Fundo Nossa Loja:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_nossa_loja]" value="<?php echo $fundo_nossa_loja;?>" id="fundo_nossa_loja" />
                <input type="color" class="cores_slc" id="fundo_nossa_loja_sel" value="<?php echo (@$fundo_nossa_loja != '' ? $fundo_nossa_loja : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">36 - Fundo Sobre Loja:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_sobre_loja]" value="<?php echo $fundo_sobre_loja;?>" id="fundo_sobre_loja" />
                <input type="color" class="cores_slc" id="fundo_sobre_loja_sel" value="<?php echo (@$fundo_sobre_loja != '' ? $fundo_sobre_loja : '#FFFFFF');?>" />
            </div>
        </div>



		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">37 - Cor Botão:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_botao]" value="<?php echo $cor_botao;?>" id="cor_botao" />
                <input type="color" class="cores_slc" id="cor_botao_sel" value="<?php echo (@$cor_botao != '' ? $cor_botao : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">38 - Cor Botão Hover:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_botao_hover]" value="<?php echo $cor_botao_hover;?>" id="cor_botao_hover" />
                <input type="color" class="cores_slc" id="cor_botao_hover_sel" value="<?php echo (@$cor_botao_hover != '' ? $cor_botao_hover : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">39 - Cor texto produto:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_texto_produto]" value="<?php echo $cor_texto_produto;?>" id="cor_texto_produto" />
                <input type="color" class="cores_slc" id="cor_texto_produto_sel" value="<?php echo (@$cor_texto_produto != '' ? $cor_texto_produto : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">40 - Cor texto produto hover:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_texto_produto_hover]" value="<?php echo $cor_texto_produto_hover;?>" id="cor_texto_produto_hover" />
                <input type="color" class="cores_slc" id="cor_texto_produto_hover_sel" value="<?php echo (@$cor_texto_produto_hover != '' ? $cor_texto_produto_hover : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">41 - Cor Fundo Imagem Box Produto:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_imagem]" value="<?php echo $cor_fundo_imagem;?>" id="cor_fundo_imagem" />
                <input type="color" class="cores_slc" id="cor_fundo_imagem_sel" value="<?php echo (@$cor_fundo_imagem != '' ? $cor_fundo_imagem : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">42 - Cor Fundo Ícone Box Produto:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_icone]" value="<?php echo $cor_fundo_icone;?>" id="cor_fundo_icone" />
                <input type="color" class="cores_slc" id="cor_fundo_icone_sel" value="<?php echo (@$cor_fundo_icone != '' ? $cor_fundo_icone : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">43 - Cor Fundo Box Produto Página Interna:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_box_produto]" value="<?php echo $cor_box_produto;?>" id="cor_box_produto" />
                <input type="color" class="cores_slc" id="cor_box_produto_sel" value="<?php echo (@$cor_box_produto != '' ? $cor_box_produto : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">44 - Cor Linha Contorno Box Produto:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_linha_box]" value="<?php echo $cor_linha_box;?>" id="cor_linha_box" />
                <input type="color" class="cores_slc" id="cor_linha_box_sel" value="<?php echo (@$cor_linha_box != '' ? $cor_linha_box : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">45 - Cor Linha Contorno Box Produto Hover:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_linha_box_hover]" value="<?php echo $cor_linha_box_hover;?>" id="cor_linha_box_hover" />
                <input type="color" class="cores_slc" id="cor_linha_box_hover_sel" value="<?php echo (@$cor_linha_box_hover != '' ? $cor_linha_box_hover : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">46 - Cor Barra Site Bar:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_barra_sidebar_prod]" value="<?php echo $cor_barra_sidebar_prod;?>" id="cor_barra_sidebar_prod" />
                <input type="color" class="cores_slc" id="cor_barra_sidebar_prod_sel" value="<?php echo (@$cor_barra_sidebar_prod != '' ? $cor_barra_sidebar_prod : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">47 - Cor Categoria Site Bar:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_categoria_sidebar_prod]" value="<?php echo $cor_categoria_sidebar_prod;?>" id="cor_categoria_sidebar_prod" />
                <input type="color" class="cores_slc" id="cor_categoria_sidebar_prod_sel" value="<?php echo (@$cor_categoria_sidebar_prod != '' ? $cor_categoria_sidebar_prod : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">48 - Cor Sub-Categoria Site Bar:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_subcategoria_sidebar_prod]" value="<?php echo $cor_subcategoria_sidebar_prod;?>" id="cor_subcategoria_sidebar_prod" />
                <input type="color" class="cores_slc" id="cor_subcategoria_sidebar_prod_sel" value="<?php echo (@$cor_subcategoria_sidebar_prod != '' ? $cor_subcategoria_sidebar_prod : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">49 - Cor Mascara Box Blog Home:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_box_blog]" value="<?php echo $cor_fundo_box_blog;?>" id="cor_fundo_box_blog" />
                <input type="color" class="cores_slc" id="cor_fundo_box_blog_sel" value="<?php echo (@$cor_fundo_box_blog != '' ? $cor_fundo_box_blog : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">50 - Cor Mascara Box Galeria Fotos:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_box_galeria]" value="<?php echo $cor_fundo_box_galeria;?>" id="cor_fundo_box_galeria" />
                <input type="color" class="cores_slc" id="cor_fundo_box_galeria_sel" value="<?php echo (@$cor_fundo_box_galeria != '' ? $cor_fundo_box_galeria : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">51 - Cor Mascara Box Categoria:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_box_categoria]" value="<?php echo $cor_fundo_box_categoria;?>" id="cor_fundo_box_categoria" />
                <input type="color" class="cores_slc" id="cor_fundo_box_categoria_sel" value="<?php echo (@$cor_fundo_box_categoria != '' ? $cor_fundo_box_categoria : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">52 - Cor Título Box1:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_titulo_box1]" value="<?php echo $cor_titulo_box1;?>" id="cor_titulo_box1" />
				<input type="color" class="cores_slc" id="cor_titulo_box1_sel" value="<?php echo (@$cor_titulo_box1 != '' ? $cor_titulo_box1 : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">53 - Fundo Box1:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_box1]" value="<?php echo $cor_fundo_box1;?>" id="cor_fundo_box1" />
				<input type="color" class="cores_slc" id="cor_fundo_box1_sel" value="<?php echo (@$cor_fundo_box1 != '' ? $cor_fundo_box1 : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">54 - Cor Título Box2:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_titulo_box2]" value="<?php echo $cor_titulo_box2;?>" id="cor_titulo_box2" />
				<input type="color" class="cores_slc" id="cor_titulo_box2_sel" value="<?php echo (@$cor_titulo_box2 != '' ? $cor_titulo_box2 : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">55 - Fundo Box2:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_box2]" value="<?php echo $cor_fundo_box2;?>" id="cor_fundo_box2" />
				<input type="color" class="cores_slc" id="cor_fundo_box2_sel" value="<?php echo (@$cor_fundo_box2 != '' ? $cor_fundo_box2 : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">56 - Cor Título Box3:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_titulo_box3]" value="<?php echo $cor_titulo_box3;?>" id="cor_titulo_box3" />
				<input type="color" class="cores_slc" id="cor_titulo_box3_sel" value="<?php echo (@$cor_titulo_box3 != '' ? $cor_titulo_box3 : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">57 - Fundo Box3:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_box3]" value="<?php echo $cor_fundo_box3;?>" id="cor_fundo_box3" />
				<input type="color" class="cores_slc" id="cor_fundo_box3_sel" value="<?php echo (@$cor_fundo_box3 != '' ? $cor_fundo_box3 : '#FFFFFF');?>" />
			</div>
		</div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">58 - Cor ícones rodapé:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_icone_rodape]" value="<?php echo $cor_icone_rodape;?>" id="cor_icone_rodape" />
				<input type="color" class="cores_slc" id="cor_icone_rodape_sel" value="<?php echo (@$cor_icone_rodape != '' ? $cor_icone_rodape : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">59 - Cor fonte rodapé:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fonte_rodape]" value="<?php echo $cor_fonte_rodape;?>" id="cor_fonte_rodape" />
				<input type="color" class="cores_slc" id="cor_fonte_rodape_sel" value="<?php echo (@$cor_fonte_rodape != '' ? $cor_fonte_rodape : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">60 - Cor botões rodapé:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_botao_rodape]" value="<?php echo $cor_botao_rodape;?>" id="cor_botao_rodape" />
				<input type="color" class="cores_slc" id="cor_botao_rodape_sel" value="<?php echo (@$cor_botao_rodape != '' ? $cor_botao_rodape : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">61 - Cor Hover botões rodapé :</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_botao_rodape_hover]" value="<?php echo $cor_botao_rodape_hover;?>" id="cor_botao_rodape_hover" />
				<input type="color" class="cores_slc" id="cor_botao_rodape_hover_sel" value="<?php echo (@$cor_botao_rodape_hover != '' ? $cor_botao_rodape_hover : '#FFFFFF');?>" />
			</div>
		</div>



		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">62 - Fundo Box Comentário:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_comentario]" value="<?php echo $fundo_comentario;?>" id="fundo_comentario" />
                <input type="color" class="cores_slc" id="fundo_comentario_sel" value="<?php echo (@$fundo_comentario != '' ? $fundo_comentario : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">63 - Fundo Box Resposta Comentário:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_resposta]" value="<?php echo $fundo_resposta;?>" id="fundo_resposta" />
                <input type="color" class="cores_slc" id="fundo_resposta_sel" value="<?php echo (@$fundo_resposta != '' ? $fundo_resposta : '#FFFFFF');?>" />
            </div>
        </div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">64 - Cor Categorias de Serviços:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_categoria_servico]" value="<?php echo $cor_categoria_servico;?>" id="cor_categoria_servico" />
                <input type="color" class="cores_slc" id="cor_categoria_servico_sel" value="<?php echo (@$cor_categoria_servico != '' ? $cor_categoria_servico : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">65 - Cor Títulos da Home:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_titulo_home]" value="<?php echo $cor_titulo_home;?>" id="cor_titulo_home" />
				<input type="color" class="cores_slc" id="cor_titulo_home_sel" value="<?php echo (@$cor_titulo_home != '' ? $cor_titulo_home : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; margin:0; padding:10px;">

            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">66 - Cor Título Blog:</label>
            <div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_titulo_blog]" value="<?php echo $cor_titulo_blog;?>" id="cor_titulo_blog" />
                <input type="color" class="cores_slc" id="cor_titulo_blog_sel" value="<?php echo (@$cor_titulo_blog != '' ? $cor_titulo_blog : '#FFFFFF');?>" />
            </div>
        </div>


		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">67 - Cor Fundo Blog:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fundo_blog]" value="<?php echo $cor_fundo_blog;?>" id="cor_fundo_blog" />
				<input type="color" class="cores_slc" id="cor_fundo_blog_sel" value="<?php echo (@$cor_fundo_blog != '' ? $cor_fundo_blog : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
            <label for="titulo" class="col-sm-12 control-label" style="text-align:left;">68 - Fundo Container Kits:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_container_kits]" value="<?php echo $fundo_container_kits;?>" id="fundo_container_kits" />
				<input type="color" class="cores_slc" id="fundo_container_kits_sel" value="<?php echo (@$fundo_container_kits != '' ? $fundo_container_kits : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">69 - Cor textos rodapé:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_fonte_item_rodape]" value="<?php echo $cor_fonte_item_rodape;?>" id="cor_fonte_item_rodape" />
				<input type="color" class="cores_slc" id="cor_fonte_item_rodape_sel" value="<?php echo (@$cor_fonte_item_rodape != '' ? $cor_fonte_item_rodape : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">70 - Fundo box kits:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_box_kits]" value="<?php echo $fundo_box_kits;?>" id="fundo_box_kits" />
				<input type="color" class="cores_slc" id="fundo_box_kits_sel" value="<?php echo (@$fundo_box_kits != '' ? $fundo_box_kits : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">71 - Fundo box últimos:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][fundo_box_ultimos]" value="<?php echo $fundo_box_ultimos;?>" id="fundo_box_ultimos" />
				<input type="color" class="cores_slc" id="fundo_box_ultimos_sel" value="<?php echo (@$fundo_box_ultimos != '' ? $fundo_box_ultimos : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:0px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">72 - Cor Preço sob consulta:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_sobconsulta]" value="<?php echo $cor_sobconsulta;?>" id="cor_sobconsulta" />
				<input type="color" class="cores_slc" id="cor_sobconsulta_sel" value="<?php echo (@$cor_sobconsulta != '' ? $cor_sobconsulta : '#FFFFFF');?>" />
			</div>
		</div>

		<div class="form-group" style="width:50%; float:left; border-bottom:2px solid #000; border-right:2px solid #000; margin:0; padding:10px;">
			<label for="titulo" class="col-sm-12 control-label" style="text-align:left;">73 - Cor Hover Preço sob consulta:</label>
			<div class="col-sm-12">
				<input type="text" class="form-control campo_cor" name="dados[<?php echo $tabela; ?>][cor_sobconsulta_hover]" value="<?php echo $cor_sobconsulta_hover;?>" id="cor_sobconsulta_hover" />
				<input type="color" class="cores_slc" id="cor_sobconsulta_hover_sel" value="<?php echo (@$cor_sobconsulta_hover != '' ? $cor_sobconsulta_hover : '#FFFFFF');?>" />
			</div>
		</div>

		<?php } ?>

        <div class="form-group">
        	<div class="col-sm-12">
            <input class="btn btn-default btn_direita" type="submit" <?php if($id > 0){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="Gravar"/>
            </div>
        </div>
	</form>
