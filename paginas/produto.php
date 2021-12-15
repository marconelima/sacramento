<?php
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

$promocional = 0;
if (strtotime($rs_produto['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_produto['data_promocional_fim']) >= strtotime(date('Y-m-d')) && $rs_produto['preco_promocional'] > 0) {
    $promocional = 1;
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

$tabela = 'tbcomentario';

$sql_comentario = "SELECT * FROM tbcomentario WHERE status = 1 AND tabela = '$tabela' AND pai_id = $vw AND comentario_pai = 0 ORDER BY data DESC";
$resultado_comentario = $conecta->selecionar($conecta->conn, $sql_comentario);
$qtde_comentarios = mysqli_num_rows($resultado_comentario);


$sql_relacionado = "SELECT p.*, p.id as produto, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca INNER JOIN tbprod_relacionado r ON r.relacionado_id = p.id WHERE p.status = 1 AND f.destaque = 1 AND r.produto_id = $vw ORDER BY nome ASC";
$resultado_relacionado = $conecta->selecionar($conecta->conn, $sql_relacionado);
$qtde_relacionados = mysqli_num_rows($resultado_relacionado);
$resultado_relacionado = $conecta->selecionar($conecta->conn, $sql_relacionado);

$tags = "";
while ($rs_tag = mysqli_fetch_array($resultado_produto)) {
    $tags .= $rs_tag['tag'] . ",";
}
?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Detalhes do produto</h2>
        <!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl; ?>">Home</a></li>
			<li class="active">Produtos</li>
            <li class="active"><?php echo $rs_produto['subcategoria']; ?></li>
            <li class="active"><?php echo $rs_produto['nome']; ?></li>
		</ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">

    <div class="page-section with-sidebar sidebar-right" style="padding-bottom: 0; background: #f3f8fa; ">
        <div class="container">
            <div class="row">
                <!--   <div class="side_busca col-12 col-sm-12 col-md-3" style="float:left;">
                		<?php //include "sidebar_catalogo.php";
                        ?>
			</div>-->
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
                                <?php //while($rs_prod_img = mysqli_fetch_array($resultado_prod_img)){
                                ?>
                                <!--<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                                                <a class="thumbnail" style="padding:0;" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $rs_prod_img['legenda']; ?>" data-caption="" data-image="<?php echo $siteUrl; ?>source/Produtos/<?php echo $rs_prod_img['foto']; ?>" data-target="#image-gallery">
                                                                        <img class="img-responsive" style="border-radius:0; margin:0;" src="<?php echo $siteUrl; ?>source/Produtos/<?php echo $rs_prod_img['foto']; ?>" alt="<?php echo $rs_prod_img['legenda']; ?>" title="<?php echo $rs_prod_img['legenda']; ?>">
                                                                </a>
                                                        </div>-->
                                <?php //} 
                                ?>

                                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">×</span>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                            </div>
                                            <div class="modal-body">
                                                <img id="image-gallery-image" class="img-responsive" src="">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-2" style="padding-left:0;">
                                                    <button type="button" class="btn btn-default" id="show-previous-image">Anterior</button>
                                                </div>
                                                <div class="col-md-8 text-justify" id="image-gallery-caption"></div>
                                                <div class="col-md-2">
                                                    <button type="button" id="show-next-image" class="btn btn-default">Próxima</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        <?php if ($promocional && $rs_produto['preco'] > 0) { ?>
                                            <font style="font-size: 1.75em;">de</font> <span class="old-price" style="font-size: 1.5em;">R$ <?php echo number_format($rs_produto['preco'], 2, ",", "."); ?></span><br>
                                            <font style="font-size: 1.75em;">por</font> <span class="price" style="font-size: 1.75em; margin-top: 0px !important;">R$ <?php echo number_format($rs_produto['preco_promocional'], 2, ",", "."); ?></span>
                                            <?php } else {
                                            if ($rs_produto['preco'] > 0) { ?>
                                                <span class="price" style="font-size: 1.75em; "">R$ <?php echo number_format($rs_produto['preco'], 2, ",", "."); ?></span>
                                                                        <?php }
                                                                } ?>
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
                                        <option value="kilos">Unidades</option>
                                        <option value="gramas">Dúzias</option>
                                    </select>

                                    <div class="clearfix"></div>
                                    <hr class="page-divider small transparent " />
                                    <a onclick="document.formOrcamento.submit();" class="btn-empresa">
                                        <?php if ($rs_configuracao['loja'] == 1) { ?>
                                            Adicionar ao Carrinho
                                        <?php } else { ?>
                                            Adicionar Orçamento
                                        <?php } ?>
                                    </a>
                                    </div>
                            </div>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product Description -->
                            <?php if ($rs_produto['descricao'] != '' || $rs_produto['aplicacao'] != '' || $rs_produto['especificacao'] != '' || $rs_produto['dadostecnicos'] != '' || $rs_produto['garantia'] != '' || $rs_produto['inclusos'] != '') { ?>
                                <div class="product-description clearfix">
                                    <ul class="nav nav-tabs" style="border-bottom: 1px solid #DBDBDB !important;">
                                        <?php if ($rs_produto['descricao'] != '') { ?>
                                            <li class="active"><a href="#descricao" data-toggle="tab">Descrição</a></li>
                                        <?php } ?>
                                        <?php if ($rs_produto['aplicacao'] != '') { ?>
                                            <li><a href="#aplicacao" data-toggle="tab">Aplicação</a></li>
                                        <?php } ?>
                                        <?php if ($rs_produto['especificacao'] != '') { ?>
                                            <li><a href="#especificacao" data-toggle="tab">Especificação</a></li>
                                        <?php } ?>
                                        <?php if ($rs_produto['dadostecnicos'] != '') { ?>
                                            <li><a href="#dadostecnicos" data-toggle="tab">Dados Ténicos</a></li>
                                        <?php } ?>
                                        <?php if ($rs_produto['garantia'] != '') { ?>
                                            <li><a href="#garantia" data-toggle="tab">Garantia</a></li>
                                        <?php } ?>
                                        <?php if ($rs_produto['inclusos'] != '') { ?>
                                            <li><a href="#inclusos" data-toggle="tab">Itens Inclusos</a></li>
                                        <?php } ?>
                                    </ul>
                                    <?php if ($rs_produto['descricao'] != '' || $rs_produto['aplicacao'] != '' || $rs_produto['especificacao'] != '' || $rs_produto['dadostecnicos'] != '' || $rs_produto['garantia'] != '' || $rs_produto['inclusos'] != '') { ?>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active show" id="descricao">
                                                <?php echo  stripslashes(str_replace("../", $siteUrl, $rs_produto['descricao'])); ?>
                                            </div>
                                            <div class="tab-pane fade in active" id="aplicacao">
                                                <?php echo  stripslashes(str_replace("../", $siteUrl, $rs_produto['aplicacao'])); ?>
                                            </div>
                                            <div class="tab-pane fade" id="especificacao">
                                                <?php echo  stripslashes(str_replace("../", $siteUrl, $rs_produto['especificacao'])); ?>
                                            </div>
                                            <div class="tab-pane fade" id="dadostecnicos">
                                                <?php echo  stripslashes(str_replace("../", $siteUrl, $rs_produto['dadostecnicos'])); ?>
                                            </div>
                                            <div class="tab-pane fade" id="garantia">
                                                <?php echo  stripslashes(str_replace("../", $siteUrl, $rs_produto['garantia'])); ?>
                                            </div>
                                            <div class="tab-pane fade" id="inclusos">
                                                <?php echo  stripslashes(str_replace("../", $siteUrl, $rs_produto['inclusos'])); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <!-- /Product Description -->

                            <!--
                                                <div class="page-section" style="margin-top: 40px; padding-bottom: 0;">
                                                        <div class="container" style="padding:0;">
                                                                <div class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="0">
                                                                        <h5 class="section-title home-title" style="margin-bottom:20px;">AVALIAÇÕES</h5>
                                                                </div>
                                                        </div>
                                                        <?php if ($qtde_comentarios > 0) { ?>
                                                                <div id="comments" class="comments-area">
                                                                        <?php if ($qtde_comentarios == 1) { ?>
                                                                                <h2 class="comments-title" style="color:black !important; font-size:30px; margin: 0;"><?php echo $qtde_comentarios; ?> Avaliação</h2>
                                                                        <?php } else { ?>
                                                                                <h2 class="comments-title" style="color:black !important; font-size:30px; margin: 0;"><?php echo $qtde_comentarios; ?> Avaliações</h2>
                                                                        <?php } ?>
                                                                        <?php $i = 1;
                                                                        $resultado_comentario = $conecta->selecionar($conecta->conn, $sql_comentario);
                                                                        while ($rs_comentario = mysqli_fetch_array($resultado_comentario)) {
                                                                        ?>
                                                                                <ol class="comment-list">
                                                                                    <li class="comment even thread-even depth-1">
                                                                                        <div class="comment-body" style="background:<?php echo $rs_configuracao['fundo_comentario']; ?>">
                                                                                            <div class="comment-author vcard">
                                                                                                <img style="float:left; margin:5px 10px 0 0;" alt='' src='http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=74&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=148&amp;d=mm&amp;r=g 2x' class='avatar avatar-74 photo' />
                                                                                                <cite class="fn"><?php echo $rs_comentario['nome']; ?> <b style="font-weight:normal;">(<?php echo $rs_comentario['cidade']; ?>)</b></cite>
                                                                                                <span class="says">disse:</span>
                                                                                                <div class="comment-meta commentmetadata"><a href="#"><?php echo substr($rs_comentario['data'], 8, 2) . " de " . $meses[(int)substr($rs_comentario['data'], 5, 2)] . ", " . substr($rs_comentario['data'], 0, 4); ?></a></div>
                                                                                                <div class="row lead">
                                                                                                    <div id="stars" class="starrr"></div><!-- Avaliou com <span id="count">0</span> estrela(s) --
                                                                                                </div>
                                                                                            </div>
                                                                                            <p><?php echo $rs_comentario['comentario']; ?></p>
                                                                                            <div class="reply-link"><a class='comment-reply-link' href='javascript:void(0)' aria-label='Responder para Teste'>Responder</a></div>
                                                                                            <div class="reply" style="padding: 10px 0;">
                                                                                                <div class="block-title"><span class="comment-date"><?php echo $rs_configuracao['nomeloja']; ?> <?php echo str_replace("<p>", "", str_replace("</p>", "", $rs_configuracao['texto_comentario'])); ?></span></div>
                                                                                                <div class="block-title"><span class="comment-date">O seu endereço de e-mail não será publicado.</span></div>
                                                                                                <div id="status_comentario<?php echo $i; ?>"></div>

                                                                                                <form method="post" action="#" name="comments-form" id="comments-form">
                                                                                                    <input type="hidden" name="pai<?php echo $i; ?>" id="pai<?php echo $i; ?>" value="<?php echo $rs_comentario['id']; ?>" />
                                                                                                    <input type="hidden" name="tabela<?php echo $i; ?>" id="tabela<?php echo $i; ?>" value="<?php echo $tabela; ?>" />
                                                                                                    <input type="hidden" name="vw<?php echo $i; ?>" id="vw<?php echo $i; ?>" value="<?php echo $vw; ?>" />
                                                                                                    <div class="row">
                                                                                                        <div class="form-group col-sm-6">
                                                                                                            <input type="text" placeholder="Nome" class="form-control" title="comments-form-name" name="nome<?php echo $i; ?>" id="nome<?php echo $i; ?>" required="required" value="" >
                                                                                                        </div>


                                                                                                        <div class="form-group col-sm-6">
                                                                                                            <input type="text" placeholder="E-mail (seu e-mail não será divulgado)" class="form-control" title="comments-form-email" name="email<?php echo $i; ?>" id="email<?php echo $i; ?>" required="required">
                                                                                                        </div>

                                                                                                        <div class="form-group col-sm-12">
                                                                                                            <input type="text" placeholder="Cidade/Estado" class="form-control" title="comments-form-website" name="cidade<?php echo $i; ?>" id="cidade<?php echo $i; ?>" required="required">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <textarea placeholder="Digite Sua Mensagem ..." class="form-control" title="comments-form-comments" name="message<?php echo $i; ?>" id="message<?php echo $i; ?>" rows="6" required="required"></textarea>
                                                                                                    </div>

                                                                                                    <div class="form-group">
                                                                                                        <input type="button" class="btn-empresa" id="comentario_filho<?php echo $i; ?>" value="Enviar Comentário">
                                                                                                    </div>

                                                                                                </form>
                                                                                            </div>
                                                                                        </div>

                                                                                        <?php

                                                                                        $sql_comentario_filho = "SELECT * FROM tbcomentario WHERE status = 1 AND tabela = '$tabela' AND pai_id = $vw AND comentario_pai = " . $rs_comentario['id'] . " ORDER BY data DESC";
                                                                                        $resultado_comentario_filho = $conecta->selecionar($conecta->conn, $sql_comentario_filho);
                                                                                        while ($rs_comentario_filho = mysqli_fetch_array($resultado_comentario_filho)) {
                                                                                        ?>
                                                                                            <ol style=" margin-left: 50px; margin-top: 20px;">
                                                                                                <li>
                                                                                                    <div class="comment-body" style="background:<?php echo $rs_configuracao['fundo_resposta']; ?>">
                                                                                                        <div class="comment-author vcard">
                                                                                                            <img style="float:left; margin:5px 10px 0 0;" alt="" src="http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=74&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=148&amp;d=mm&amp;r=g 2x" class="avatar avatar-74 photo">
                                                                                                            <cite class="fn"><?php echo $rs_comentario_filho['nome']; ?> <b style="font-weight:normal;">(<?php echo $rs_comentario_filho['cidade']; ?>)</b></cite>
                                                                                                            <span class="says">disse:</span>
                                                                                                            <div class="comment-meta commentmetadata"><a href="#"><?php echo substr($rs_comentario_filho['data'], 8, 2) . " de " . $meses[(int)substr($rs_comentario_filho['data'], 5, 2)] . ", " . substr($rs_comentario_filho['data'], 0, 4); ?></a></div>
                                                                                                        </div>
                                                                                                        <p style="padding-bottom: 15px;"><?php echo $rs_comentario_filho['comentario']; ?></p>
                                                                                                        <!--<div class="reply"><a class="comment-reply-link" href="javascript:void(0)" aria-label="Responder para Teste">Responder</a></div>--
                                                                                                    </div>
                                                                                                </li>
                                                                                            </ol>
                                                                                        <?php } ?>
                                                                                    </li><!-- #comment-## --
                                                                                </ol><!-- .comment-list --
                                                                        <?php $i++;
                                                                        } ?>
                                                                </div><!-- #comments --
                                                        <?php } else { ?>
                                                                <div class="block-title"><h4>SEJA O PRIMEIRO A FAZER UMA AVALIAÇÃO DESTE PRODUTO!</h4></div>
                                                        <?php } ?>
                                                </div>

                                                <!-- Comments -
                                                <div class="comments" style="padding-top:0;">
                                                        <!-- /botao deixe aqui seu comentário --
                                                        <a class="btn btn-default btn-lg btn-product" id="deixarComentario">DEIXE AQUI SUA AVALIAÇÃO</a>
                                                </div>
                                                <!-- /Comments --

                                                <!-- Leave a Comment --
                                                <div class="comments-form" id="telaComentario"  style="background: #FFFFFF; padding: 5px;">
                                                        <div id="status_comentario"></div>
                                                        <div class="block-title"><span class="comment-date"><?php echo $rs_configuracao['nomeloja']; ?> <?php echo str_replace("<p>", "", str_replace("</p>", "", $rs_configuracao['texto_comentario'])); ?></span></div>
                                                        <div class="block-title"><span class="comment-date">O seu endereço de e-mail não será publicado.</span></div>
                                                        <form method="post" action="" name="comments-form" id="comments-form">
                                                                <input type="hidden" name="pai" id="pai" value="0" />
                                                                <input type="hidden" name="tabela" id="tabela" value="<?php echo $tabela; ?>" />
                                                                <input type="hidden" name="vw" id="vw" value="<?php echo $vw; ?>" />
                                                                <div class="row">
                                                                        <div class="form-group col-sm-6">
                                                                                <select id="" name="avaliacao" class="form-control">
                                                                                        <option selected="selected" value="avaliar">Como voc&ecirc; classifica este produto?</option>
                                                                                        <option value="5 Estrelas (Otimo)">5 Estrelas(&Oacute;timo)</option>
                                                                                        <option value="4 Estrelas">4 Estrelas</option>
                                                                                        <option value="3 Estrelas(Bom)">3 Estrelas(Bom)</option>
                                                                                        <option value="2 Estrelas">2 Estrelas</option>
                                                                                        <option value="1 Estrela(Ruim)">1 Estrela(Ruim)</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                                <input type="text" placeholder="T&iacute;tulo do coment&aacute;rio" class="form-control" title="comments-form-name" name="titulo" id="titulo" required="required" value="" >
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                                <input type="text" placeholder="Nome" class="form-control" title="comments-form-name" name="nome" id="nome" required="required" value="" >
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                                <input type="text" placeholder="E-mail (seu e-mail não será divulgado)" class="form-control" title="comments-form-email" name="email" id="email" required="required">
                                                                        </div>
                                                                        <div class="form-group col-sm-12">
                                                                                <input type="text" placeholder="Cidade/Estado" class="form-control" title="comments-form-website" name="cidade" id="cidade" required="required">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group">
                                                                        <textarea placeholder="Digite Sua Mensagem ..." class="form-control" title="comments-form-comments" name="message" id="message" rows="6" required></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                        <input type="button" class="btn-empresa" id="comentario_principal" value="Enviar Comentário">
                                                                </div>
                                                        </form>
                                                </div>                <!-- /Leave a Comment -->
                        </div>
                    </div>
                </div>
                <hr class="page-divider half transparent" />
                <div class="clearfix"></div><!-- /Content -->
            </div>
        </div>
        </section>

        <?php if ($qtde_relacionados > 0) { ?>
            <section class="page-section ">
                <div class="container">
                    <div class="col-sm-12">
                        <section class="page-section">

                            <div class="" data-animation="fadeInUp" data-animation-delay="0">
                                <h5 class="section-title home-title" style="width:99%;">Produtos Relacionados</h5>
                            </div>

                            <ul class="row">
                                <?php while ($rs_relacionado = mysqli_fetch_array($resultado_relacionado)) {
                                    $promocional = 0;
                                    if (strtotime($rs_relacionado['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_relacionado['data_promocional_fim']) >= strtotime(date('Y-m-d'))) {
                                        $promocional = 1;
                                    }
                                ?>
                                    <div class="col-12 col-xs-6 col-md-4" style="padding-right:0;">
                                        <div class="view-first box-produtos" style="width:100%;">
                                            <div class="borda-produtos post-wrap" style="border:0; text-align:center;">
                                                <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_relacionado['id']; ?>"><img src="<?php echo $siteUrl . "source/Produtos/" . $rs_relacionado['foto']; ?>" class="img-responsive" alt="<?php echo $rs_relacionado['nome'] . " " . $rs_relacionado['modelo']; ?>" title="<?php echo $rs_relacionado['nome'] . " " . $rs_relacionado['modelo']; ?>" style="max-width:100%; width:100%;" /></a>
                                                <?php if ($promocional == 1 && $rs_relacionado['preco_promocional'] > 0) { ?>
                                                    <img class="cornerimage" src="<?php echo $siteUrl . "source/Produtos/promocao.png" ?>" alt="" style="border: 0;
    		    position: absolute;
    		    top: 10;
    		    right: 167; margin: 0;
    		    width: 100px;">
                                                <?php } ?>
                                                <div class="mask">
                                                    <a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_relacionado['id']; ?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> VER DETALHES</button></a>
                                                </div>
                                                <p class="titulo-produto"><a href="<?php echo $siteUrl ?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_relacionado['marca_id'] ?>"><?php echo $rs_relacionado['marca']; ?></a></p>
                                                <p class="desc-produto"><a href="<?php echo $siteUrl ?>produto/21/0/<?php echo $rs_relacionado['id']; ?>"><?php echo $rs_relacionado['nome'] . " " . $rs_relacionado['modelo']; ?></a></p>
                                                <p class="valor-de-para">
                                                    <?php if ($promocional == 1 && $rs_relacionado['preco_promocional'] > 0) { ?>
                                                        <span class="de" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><?php echo "de R$ " . number_format($rs_relacionado['preco'], 2, ",", "."); ?></span>
                                                        <span class="por"><?php echo "por R$ " . number_format($rs_relacionado['preco_promocional'], 2, ",", "."); ?></span>

                                                    <?php } ?>
                                                </p>
                                                <a class="btn info btn-default add-cotacao btn-catalogo detalheProduto" data-idproduto="<?php echo $rs_relacionado['produto']; ?>" data-toggle="modal" data-target="#ModalDetalhe">Detalhe</a>
                                                <a class="btn info btn-default add-cotacao btn-catalogo colocarCarrinho" data-idproduto="<?php echo $rs_relacionado['produto']; ?>" data-quantidade="1">Adicionar Orçamento</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </ul>

                        </section>
                    <?php } ?>
                    <!-- /Popular Products -->
                    </div>
                </div>
            </section>