<?php
$maximo = 60;
$inicio = ($pag * $maximo) - $maximo;

$filtro_marcaLateral = '';
$filtro_opcoes = '';
$fornecedores = [];

if ($pag > 1) {
    $_POST['filtrox'] = (isset($_SESSION['filtrox']) ? $_SESSION['filtrox'] : '');
    $_POST['ordem'] = (isset($_SESSION['ordem']) ? $_SESSION['ordem'] : '');
} else {
    unset($_SESSION['filtrox'], $_SESSION['ordem']);
}

if (isset($_POST['filtrox']) && @$_POST['filtrox'] != '') {

    $i = 0;

    $_SESSION['filtrox'] = $_POST['filtrox'];

    foreach ($_POST['filtrox'] as $opcoes) {

        $arr = explode("_", $opcoes);

        $fornecedores[$i] = $arr[0];
        // $fornecedoresSub[$i] = $arr[1];
        $i++;
    }

    if (count($fornecedores) > 0) {
        $filtro_opcoes = implode(",", $fornecedores);
        //$filtro_opcoessub = implode(",", $fornecedoresSub);
    }

    $filtro_marcaLateral = ' AND p.marca in (' . $filtro_opcoes . ')';
    //$filtro_marcaLateralSub = ' AND p.subcategoria_id in (' . $filtro_opcoessub . ')';

}

$filtro_busca = "";

if (isset($_POST['search']) && @$_POST['search'] != '') {
    $filtro_busca = " AND ( p.descricao like '%" . strip_tags(trim($_POST['search'])) . "%'";
    $filtro_busca .= " OR p.nome like '%" . strip_tags(trim($_POST['search'])) . "%')";
}

$filtro_categoriab = "";
if (isset($_POST['categoria']) && @$_POST['categoria'] != '') {
    $filtro_categoriab = " AND c.id = " . $_POST['categoria'];
}

$filtro_subcategoriab = "";
if (isset($_POST['subcategoria']) && @$_POST['subcategoria'] != '') {
    $filtro_subcategoriab = " AND s.id = " . $_POST['subcategoria'];
}

$filtro_marcab = "";
if (isset($_POST['marca']) && @$_POST['marca'] != '') {
    $filtro_marcab = " AND m.id = " . $_POST['marca'];
}

$filtro_montadorab = "";
if (isset($_POST['montadora']) != '' && @$_POST['montadora'] != 0) {
    $filtro_montadorab = " AND p.montadora_id = " . $_POST['montadora'];
}

$filtro_modelob = "";
if (isset($_POST['modelo1']) != '' && @$_POST['modelo1'] != 0) {
    $filtro_modelob = " AND p.modelo_id = " . $_POST['modelo1'];
}

$filtro_anob = "";
if (isset($_POST['ano']) != '' && @$_POST['ano'] != 0) {
    $filtro_anob = " AND p.ano_id = " . $_POST['ano'];
}

$filtro_versaob = "";
if (isset($_POST['versao']) != '' && @$_POST['versao'] != 0) {
    $filtro_versaob = " AND p.versao_id = " . $_POST['versao'];
}

$filtro_tipob = "";
if (isset($_POST['tipo']) != '' && @$_POST['tipo'] != 0) {
    $filtro_tipob = " AND p.tipo_id = " . $_POST['tipo'];
}

$filtro_palavra = "";

if ($palavra) {
    $filtro_palavra = " AND p.tag like '%" . $palavra . "%'";
}

$filtro_categoria = "";
if ($categ != '' && $categ != 0) {
    $filtro_categoria = " AND c.id = $categ";
}

$filtro_subcategoria = "";
if ($subcateg != '' && $subcateg != 0) {
    $filtro_subcategoria = " AND s.id = $subcateg";
}

$filtro_marca = "";
if ($marca != '' && $marca != 0) {
    $filtro_marca = " AND m.id = $marca";
}

$filtro_montadora = "";
if ($montadora != '' && $montadora != 0) {
    $filtro_montadora = " AND p.montadora_id = $montadora";
}

$filtro_modelo = "";
if ($modelo != '' && $modelo != 0) {
    $filtro_modelo = " AND p.modelo_id = $modelo";
}

$filtro_ano = "";
if ($ano != '' && $ano != 0) {
    $filtro_ano = " AND p.ano_id = $ano";
}

$filtro_versao = "";
if ($versao != '' && $versao != 0) {
    $filtro_versao = " AND p.versao_id = $versao";
}

$filtro_tipo = "";
if (@$tipo != '' && @$tipo != 0) {
    $filtro_tipo = " AND p.tipo_id = $tipo";
}

$ordem_vw = "p.nome ASC";
if (isset($_POST['ordem']) && @$_POST['ordem'] != '') {
    $ordem_vw = $_POST['ordem'];
    $_SESSION['ordem'] = $_POST['ordem'];
}

$sql_paginacao = " LIMIT $inicio, $maximo";

$sql_produto = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 $filtro_marcaLateral $filtro_marca $filtro_subcategoria $filtro_categoria $filtro_palavra $filtro_busca $filtro_marcab $filtro_subcategoriab $filtro_categoriab $filtro_categoriab $filtro_montadora $filtro_modelo $filtro_ano $filtro_versao $filtro_tipo $filtro_montadorab $filtro_modelob $filtro_anob $filtro_versaob $filtro_tipob ORDER BY $ordem_vw";

$resultado_produto = $conecta->selecionar($conecta->conn, $sql_produto . $sql_paginacao);
$resultado_total = $conecta->selecionar($conecta->conn, $sql_produto);

$arr_marcas = [];
if ((int)$subcateg > 0) {
    $j = 0;
    while ($rs_marcs = mysqli_fetch_array($resultado_total)) {

        if (!in_array($rs_marcs['marca_id'], $arr_marcas)) {
            if (($rs_marcs['marca_id'] * 1) > 0) {
                $arr_marcas[$j] = $rs_marcs['marca_id'];
                $j++;
            }
        }
    }
    $resultado_total = $conecta->selecionar($conecta->conn, $sql_produto);

    if (count($arr_marcas) == 0) {
        $semmarcas = 1;
    }
} else {
    $sql_marcs = "SELECT DISTINCT marca as marca_id FROM tbproduto";
    $resultado_marcs = $conecta->selecionar($conecta->conn, $sql_marcs);
    $j = 0;
    while ($rs_marcs = mysqli_fetch_array($resultado_marcs)) {
        if ($rs_marcs['marca_id'] != '' && ((int)$rs_marcs['marca_id'] * 1) > 0) {
            $arr_marcas[$j] = $rs_marcs['marca_id'];
            $j++;
        }
    }
}


$qtde_prod_total = mysqli_num_rows($resultado_total);

if ($qtde_prod_total < ($pag * $maximo)) {
    $nummostrado = $qtde_prod_total;
} else {
    $nummostrado =     ($pag * $maximo);
}

$tags = "";
while ($rs_tag = mysqli_fetch_array($resultado_total)) {
    if (!@substr_count($tags, $rs_tag['tag'])) {
        $tags .= $rs_tag['tag'] . ",";
    }
}

?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title"><?php echo $rs_tela['nome']; ?></h2>
        <!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl; ?>">Home</a></li>
			<li class="active">Produtos</li>
		</ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->

</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">

    <section class="page-section with-sidebar sidebar-right no-top-padding" style="background: #f3f8fa;">
        <div class="container" style="padding:0;">
            <div class="row rowteste">

                <div class="side_busca col-6 col-sm-4 col-md-3 menubusca" style="float:left;">
                    <?php include "sidebar_catalogo.php"; ?>
                </div>

                <!-- Content -->
                <div class="col-12 col-sm-8 col-md-9 content shop catalogo_e" style="margin-top: 1%;">


                    <!-- Results -->
                    <div class="row shop-result">
                        <div class="inner darken clearfix" style="width:100%;">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 offset-6 offset-sm-6 result-count" style="float:left;">
                                Exibindo <strong><?php echo $inicio + 1; ?> - <?php echo $nummostrado; ?></strong> de <strong><?php echo $qtde_prod_total; ?></strong> produtos
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 offset-6 offset-sm-6 cata_peq result-ordering" style="line-height: 5px; float:right;">
                                <div class="pull-right" style="width: 100%; text-align: right;">
                                    <form action="" name="formOrdem" method="post" enctype="multipart/form-data">
                                        <p style="width: 58%; float: left; text-align: right; margin-top: 2.5%; line-height: 15px;">Ordenar por: </p>
                                        <select name="ordem" onchange="javascript: document.formOrdem.submit();" style="width: 40%;">
                                            <option value="">Selecione</option>
                                            <option <?php if ($_POST['ordem'] == "p.modificado DESC") {
                                                        echo "selected";
                                                    } ?> value="p.modificado DESC">Mais Recentes</option>
                                            <option <?php if ($_POST['ordem'] == "p.nome ASC") {
                                                        echo "selected";
                                                    } ?> value="p.nome ASC">De A - Z</option>
                                            <option <?php if ($_POST['ordem'] == "p.nome DESC") {
                                                        echo "selected";
                                                    } ?> value="p.nome DESC">De Z - A</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Results -->

                    <!-- Products -->
                    <div class="row">
                        <?php $i = 0;

                        $API = new ComunicacaoAPI();

                        if (empty($_SESSION['token_api']) || $_SESSION['token_api'] == 'erro') {

                            $API->getToken('http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/autenticacao/entrar');

                            $_SESSION['token_api'] = $API->token;
                        } else {
                            $API->token = $_SESSION['token_api'];
                        }

                        while ($rs_produto = mysqli_fetch_array($resultado_produto)) {

                            if ($i == 0) {
                                $produtos = $API->getProdutoEstoque($rs_produto['codigo']);
                            }

                            if ($i % 3 == 0) {
                                //echo "<div style='width:100%; float:left; height:10px;'></div>";
                            }

                            $preco = 0;;
                            $preco_promocional = 0;
                            $estoque = 0;
                            $ativo = 0;


                            if (@$_SESSION['cliente'] > 0) {
                                $produtos = $API->getProdutoEstoque($rs_produto['codigo']);

                                $produto = json_decode($produtos);

                                $i = 0;

                                $preco = $produto->{'produtos'}[$i]->{'preco'};
                                $preco_promocional = $produto->{'produtos'}[$i]->{'precoPromocional'};
                                $estoque = $produto->{'produtos'}[$i]->{'estoque'};
                                $ativo = $produto->{'produtos'}[$i]->{'ativo'};
                                $unidade = $produto->{'produtos'}[$i]->{'unidade'};
                            }

                            $preco = $preco > 0 ? $preco + $preco * 0.2 : 0;
                            $preco_promocional = $preco_promocional > 0 ? $preco_promocional + $preco_promocional * 0.2 : 0;

                            if ($preco_promocional > 0) {
                                $promocional = 1;

                                $diferenca = ($preco_promocional * 100) / $preco;
                                $desconto = round(100 - $diferenca);
                            } else {
                                $promocional = 0;
                                if (strtotime($rs_produto['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_produto['data_promocional_fim']) >= strtotime(date('Y-m-d'))) {
                                    $promocional = 1;
                                }
                            }
                        ?>

                            <div class="col-md-4 col-sm-6 col-6 <?php if ($i < 4) {
                                                                    echo "offset-6 offset-sm-0 offset-md-0";
                                                                } ?>" style="padding-right:0; margin-top:10px;">
                                <div class="view-first box-produtos" style="width:100%;">
                                    <div class="borda-produtos post-wrap" style="border:0; text-align:center; overflow: hidden;">
                                        <a class="detalheProduto" data-idproduto="<?php echo $rs_produto['id']; ?>" data-toggle="modal" data-target="#ModalDetalhe" style="float: left; width: 100%; position: relative;">
                                            <img src="<?php echo $siteUrl . "/source/Produtos/" . $rs_produto['foto']; ?>" class="img-responsive" style="max-width:100%; width:100%;" alt="<?php echo $rs_produto['nome'] . " " . $rs_produto['modelo']; ?>" title="<?php echo $rs_produto['nome'] . " " . $rs_produto['modelo']; ?>" />
                                            <?php if ($promocional == 1 && $preco_promocional > 0) { ?>
                                                <span style="width:60px; height:60px; float:left; padding:10px 0; position:absolute; top:0; left:0; background:url('../images/tagpromocao.png') no-repeat; opacity:0.8; color:#FFFFFF; font-size:16px; font-weight:bold; "><?php echo $desconto; ?>%</span>
                                            <?php } ?>
                                        </a>



                                        <div class="mask">
                                            <!--<a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_produto['id']; ?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> VER DETALHES</button></a>-->
                                        </div>
                                        <p class="titulo-produto"><a class="detalheProduto" data-idproduto="<?php echo $rs_produto['id']; ?>" data-toggle="modal" data-target="#ModalDetalhe"><?php echo $rs_produto['marca']; ?></a></p>
                                        <p class="desc-produto" style="font-weight: bold;"><a class="detalheProduto" data-idproduto="<?php echo $rs_produto['id']; ?>" data-toggle="modal" data-target="#ModalDetalhe"><?php echo $rs_produto['nome'] . " " . $rs_produto['modelo']; ?></a></p>
                                        <p class="valor-de-para">
                                            <?php if ($promocional == 1 && $preco_promocional > 0) { ?>
                                                <span class="de" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><?php echo "de R$ " . number_format($preco, 2, ",", "."); ?></span>
                                                <span class="por"><?php echo "por R$ " . number_format($preco_promocional, 2, ",", "."); ?></span>
                                            <?php } else if ($preco > 0) { ?>
                                                <span class="por" style="color:##000000; font-size:16px !important; font-weight:bold;"><?php echo "R$ " . number_format($preco, 2, ",", "."); ?></span>
                                            <?php } ?>
                                        </p>
                                        <a class="btn info btn-default add-cotacao btn-catalogo colocarCarrinho" data-idproduto="<?php echo $rs_produto['id']; ?>" data-quantidade="1"><i class="fas fa-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>


                        <?php $i++;
                        } ?>

                        <div class="clearfix"></div>
                    </div>
                    <!-- /Products-->

                    <?php include "paginacao.php"; ?>

                </div><!-- /.content -->
                <!-- /Content -->
            </div>
        </div>
    </section>



    <div class="modal"></div>