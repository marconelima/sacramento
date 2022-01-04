<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "../uteis/bancodados.php";
include "../parametros.php";
include "../funcoes.php";

$conecta = new Recordset;
$conecta->conexao();

$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
$rs_configuracao = mysqli_fetch_array($resultado_configuracao);

include_once("classes/comunicacao.class.php");

$siteUrl = $rs_configuracao['linkloja'];
//$siteUrl = "http://www.marconesacramento.com.br/";

$API = new ComunicacaoAPI();

if (empty($_SESSION['token_api']) || $_SESSION['token_api'] == 'erro') {

    $API->getToken('http://sacprx.poweredbyclear.com:8080/ecommerceapi/v1/autenticacao/entrar');

    $_SESSION['token_api'] = $API->token;
} else {
    $API->token = $_SESSION['token_api'];
}

$vw = @$_GET['produto'];

$sql_produto = "SELECT p.*, f.*, p.id as produto, s.titulo as subcategoria, m.titulo as marca, md.titulo as model, mo.titulo as montadora, fo.titulo as fornecedor, ti.titulo as tipo, ve.titulo as versao, a.ano as ano
FROM  tbproduto p LEFT JOIN tbprod_foto f ON f.produto_id = p.id
INNER JOIN tbprod_subcategoria s ON p.subcategoria_id = s.id
LEFT JOIN tbprod_marca m ON m.id = p.marca
LEFT JOIN tbmontadora mo ON mo.id = p.montadora_id
LEFT JOIN tbmodelo md ON md.id = p.modelo_id
LEFT JOIN tbfornecedor fo ON fo.id = p.fornecedor_id
LEFT JOIN tbtipo ti ON ti.id = p.tipo_id
LEFT JOIN tbversao ve ON ve.id = p.versao_id
LEFT JOIN tbano a ON a.id = p.ano_id
WHERE p.status = 1 AND f.destaque = 1 AND p.id = $vw";

$resultado_produto = $conecta->selecionar($conecta->conn, $sql_produto);
$rs_produto = mysqli_fetch_array($resultado_produto);

if ($i == 0) {
    $produtos = $API->getProdutoEstoque($rs_produto['codigo']);
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
} else {
    $promocional = 0;
    if (strtotime($rs_produto['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_produto['data_promocional_fim']) >= strtotime(date('Y-m-d'))) {
        $promocional = 1;
    }
}

$sql_prod_img = "SELECT * FROM tbprod_foto WHERE produto_id = " . $rs_produto['produto'] . " ORDER BY ordem ASC";
$resultado_prod_img = $conecta->selecionar($conecta->conn, $sql_prod_img);

$sql_prod_tam = "SELECT distinct tamanho FROM tbprod_tamanhocor WHERE produto_id = " . $rs_produto['produto'] . " ORDER BY tamanho ASC";
$resultado_prod_tam = $conecta->selecionar($conecta->conn, $sql_prod_tam);

$qtde_cor_tam = mysqli_num_rows($resultado_prod_tam);

$sql_prod_cor = "SELECT distinct cor FROM tbprod_tamanhocor WHERE produto_id = " . $rs_produto['produto'] . " ORDER BY cor ASC";
$resultado_prod_cor = $conecta->selecionar($conecta->conn, $sql_prod_cor);

$sql_campo = "SELECT * FROM tbprod_campo WHERE produto_id = " . $rs_produto['produto'] . " AND tipo <> 'textarea' ORDER BY ordem ASC";
$resultado_campo = $conecta->selecionar($conecta->conn, $sql_campo);

$sql_campo_longo = "SELECT * FROM tbprod_campo WHERE produto_id = " . $rs_produto['produto'] . " AND tipo = 'textarea' ORDER BY ordem ASC";
$resultado_campo_longo = $conecta->selecionar($conecta->conn, $sql_campo_longo);
?>
<div class="content-area content content_corpo" style="margin-top:0;">
    <div class="page-section with-sidebar sidebar-right" style="padding-bottom: 0; background: #f3f8fa; ">
        <div class="container">
            <div class="row">

                <!-- Content -->
                <div class="col-sm-12 content">
                    <form name="formOrcamento" enctype="multipart/form-data" method="post" action="<?php echo $siteUrl; ?>carrinho/48">
                        <input type="hidden" name="produto" value="<?php echo $vw; ?>" />
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="col-lg-12 col-md-12 col-xs-12 thumb">
                                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Produto 1" data-caption="" data-image="<?php echo $siteUrl; ?>source/Produtos/<?php echo $rs_produto['foto']; ?>" data-target="#image-gallery">
                                        <img style="max-width:100%; margin:0; border-radius:0; width: 100%;" src="<?php echo $siteUrl; ?>source/Produtos/<?php echo $rs_produto['foto']; ?>" alt="<?php echo $rs_produto['nome']; ?>" title="<?php echo $rs_produto['nome']; ?>">
                                    </a>
                                </div>
                                <?php while ($rs_prod_img = mysqli_fetch_array($resultado_prod_img)) { ?>
                                    <div class="col-lg-3 col-md-4 col-xs-6 col-4 thumb">
                                        <a class="thumbnail" style="padding:0;" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $rs_prod_img['legenda']; ?>" data-caption="" data-image="<?php echo $siteUrl; ?>source/Produtos/<?php echo $rs_prod_img['foto']; ?>" data-target="#image-gallery">
                                            <img class="img-responsive" style="border-radius:0; margin:0; max-width:100%;" src="<?php echo $siteUrl; ?>source/Produtos/<?php echo $rs_prod_img['foto']; ?>" alt="<?php echo $rs_prod_img['legenda']; ?>" title="<?php echo $rs_prod_img['legenda']; ?>">
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-7">
                                <!--<h3 class="post-title product-title"><?php //echo $rs_produto['nome'];
                                                                            ?></h3>-->
                                <font style="font-size: 18px; font-weight: bold; color:#000000;"><?php echo $rs_produto['nome']; ?></font>
                                <div class="extra-info" style="margin-top: 20px;">
                                    <?php if ($rs_produto['numero_original'] != '') { ?>
                                        <div class="extra-info-iten">
                                            <h4>Número Original do Produto</h4>
                                            <p><?php echo $rs_produto['numero_original']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if ($rs_produto['referencia'] != '') { ?>
                                        <div class="extra-info-iten">
                                            <h4>Código do Produto</h4>
                                            <p><?php echo $rs_produto['referencia']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <p style="margin-top:20px;">
                                        <?php if ($promocional == 1 && $preco_promocional > 0) { ?>
                                            <span class="de" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><?php echo "de R$ " . number_format($preco, 2, ",", "."); ?></span>
                                            <span class="por"><?php echo "por R$ " . number_format($preco_promocional, 2, ",", "."); ?></span>
                                        <?php } else if ($preco > 0) { ?>
                                            <span class="por" style="color:##000000; font-size:16px !important; font-weight:bold;"><?php echo "R$ " . number_format($preco, 2, ",", "."); ?></span>
                                        <?php } ?>
                                    </p>

                                    <?php while ($rs_campo = mysqli_fetch_array($resultado_campo)) {
                                        if ($rs_campo['tipo'] == 'select') {
                                            $sql_subcampo = "SELECT * FROM tbprod_subcampo WHERE campo_id = " . $rs_campo['id'] . " ORDER BY id ASC";
                                            $resultado_subcampo = $conecta->selecionar($conecta->conn, $sql_subcampo);
                                    ?>
                                            <div class=" extra-info-iten">
                                                <h4><?php echo $rs_campo['nome']; ?></h4>
                                                <p>
                                                    <select name="<?php echo sem_especiais($rs_campo['nome']); ?>" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php while ($rs_subcampo = mysqli_fetch_array($resultado_subcampo)) { ?>
                                                            <option value="<?php echo $rs_subcampo['value']; ?>"><?php echo $rs_subcampo['item']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <p>
                                            </div>
                                        <?php } else if ($rs_campo['tipo'] == 'text') { ?>
                                            <div class="extra-info-iten">
                                                <h4><?php echo $rs_campo['nome']; ?></h4>
                                                <p><?php echo $rs_campo['value']; ?>
                                                <p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="extra-info-iten">
                                                <h4><?php echo $rs_campo['nome']; ?></h4>
                                                <p><input type="text" value="" name="<?php echo sem_especiais($rs_campo['nome']); ?>" class="form-control" /></p>
                                            </div>
                                    <?php  }
                                    } ?>

                                </div>
                                <div class="extra-info">
                                    <?php if ($qtde_cor_tam > 0) { ?>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <?php $i = 0;
                                                            $j = "";
                                                            while ($rs_prod_tam = mysqli_fetch_array($resultado_prod_tam)) { ?>
                                                                <th class="centralizado" style="margin:5px 0 !important;">
                                                                    <div class="cubo"><?php echo $rs_prod_tam['tamanho']; ?></div>
                                                                </th>
                                                            <?php $j[$i] = $rs_prod_tam['tamanho'];
                                                                $i++;
                                                            } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($rs_prod_cor = mysqli_fetch_array($resultado_prod_cor)) { ?>
                                                            <tr>
                                                                <td width="100" style="padding:8px 0 !important;"><?php echo $rs_prod_cor['cor']; ?></td>
                                                                <?php for ($x = 0; $x < $i; $x++) {
                                                                    $sql_prod_qtde = "SELECT id, quantidade FROM tbprod_tamanhocor WHERE produto_id = " . $rs_produto['produto'] . " AND tamanho = '" . $j[$x] . "' AND cor = '" . $rs_prod_cor['cor'] . "'";
                                                                    $resultado_prod_qtde = $conecta->selecionar($conecta->conn, $sql_prod_qtde);

                                                                ?>
                                                                    <td style="padding:8px 0  !important;"><?php if ($rs_prod_qtde = mysqli_fetch_array($resultado_prod_qtde)) { ?>
                                                                            <select name="<?php echo $rs_prod_qtde['id'] . "|" . $j[$x] . "_" . $rs_prod_cor['cor']; ?>" class="form-control" style="width:50px; height:30px !important; padding:5px !important; font-size:12px; margin-left:5px; float:none;">
                                                                                <option value=""> - </option>
                                                                                <?php $z = 1;
                                                                                                                while ($z <= 30) { ?>
                                                                                    <option value="<?php echo $z; ?>"><?php echo $z; ?></option>
                                                                                <?php $z++;
                                                                                                                } ?>
                                                                            </select>
                                                                        <?php } else {
                                                                                                                echo "<span class='glyphicon glyphicon-remove' style='margin-left:20px;'></span>";
                                                                                                            } ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="product-quantity">
                                                <h5>Quantidade:</h5>
                                                <div class="form-group" style="width:50%; background:#FFFFFF; border-radius:10px; padding:2%; height: 60px;">
                                                    <input class="qty-minus" type="button" id="minus" value="-" style="float:left; width:20%;background:#FFFFFF; font-weight:bold; border: 0; font-weight: bold; font-size: 1.5em;">
                                                    <input class="form-control" type="text" name="qtde_prod" id="qtde_prod" value="1" placeholder="1" style="float:left; width:40%; border-left:1px solid #eaeaea; margin:0 10%; border-right:1px solid #eaeaea; border-top: 0; border-bottom: 0; border-radius: 0; text-align: center;">
                                                    <input class="qty-plus" type="button" id="plus" value="+" style="float:left; width:20%; background:#FFFFFF; font-weight:bold; border: 0; font-weight: bold; font-size: 1.5em;">
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="clearfix"></div>

                                        <select name="kilo_grama" class="form-control" style="width:50%; margin-top:10px; border:0; padding:1%;">
                                            <option value="">Unidade</option>
                                            <?php foreach ($produto as $prod) { ?>
                                                <option value="<?php echo $prod->{'unidade'}; ?>"><?php echo $prod->{'unidadeDescricao'}; ?></option>
                                            <?php } ?>
                                        </select>

                                        <div class="clearfix"></div>
                                        <hr class="page-divider small transparent " />
                                        <a class="btn info btn-default add-cotacao btn-catalogo colocarCarrinho btncolocamodal" data-idproduto="<?php echo $rs_produto['produto']; ?>" data-quantidade="1">Adicionar Orçamento</a>
                                        </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $siteUrl; ?>js/jquery.min.js"></script>
    <script src="<?php echo $siteUrl; ?>js/script.js"></script>
    <script>
        $(function() {

            if (document.querySelector("#plus")) {

                let mais = document.querySelector("#plus");

                mais.addEventListener('click', function(e) {

                    let qtde = document.querySelector("#qtde_prod");

                    document.querySelector("#qtde_prod").value = parseInt(qtde.value) + 1;

                    let botao = document.querySelector(".btncolocamodal");
                    console.log(qtde.value, botao);

                    botao.setAttribute('data-quantidade', qtde.value);

                });


            }

            if (document.querySelector("#minus")) {

                let menos = document.querySelector("#minus");

                menos.addEventListener('click', function(e) {

                    let qtde = document.querySelector("#qtde_prod");

                    if (parseInt(qtde.value) > 0) {
                        document.querySelector("#qtde_prod").value = parseInt(qtde.value) - 1;
                    }

                    let botao = document.querySelector(".btncolocamodal");
                    botao.setAttribute('data-quantidade', qtde);

                });

            }
        });
    </script>