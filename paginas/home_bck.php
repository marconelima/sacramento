<?php
$sql_banner_cabecalho = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 1 ORDER BY rand()";
$resultado_banner_cabecalho = $conecta->selecionar($conecta->conn,$sql_banner_cabecalho);

$sql_banner_meio = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 2 ORDER BY rand()";
$resultado_banner_meio = $conecta->selecionar($conecta->conn,$sql_banner_meio);

$sql_produto_box1 = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box1 = 1 ORDER BY modificado DESC LIMIT 0,3";
$resultado_produto_box1 = $conecta->selecionar($conecta->conn,$sql_produto_box1);

$sql_produto_box2 = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box2 = 1 ORDER BY modificado DESC LIMIT 0,3";
$resultado_produto_box2 = $conecta->selecionar($conecta->conn,$sql_produto_box2);

$sql_produto_box3 = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box3 = 1 ORDER BY modificado DESC LIMIT 0,3";
$resultado_produto_box3 = $conecta->selecionar($conecta->conn,$sql_produto_box3);


$sql_destaque = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND destaque_home = 1 ORDER BY modificado DESC LIMIT 0,20";
$resultado_destaque = $conecta->selecionar($conecta->conn, $sql_destaque);

$sql_kits = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND kit = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_kits = $conecta->selecionar($conecta->conn, $sql_kits);

$sql_praceiro = "SELECT DISTINCT m.* FROM tbprod_marca m INNER JOIN tbproduto p ON p.marca = m.id WHERE m.destaque = 1 ORDER BY rand() ASC";
$resultado_parceiro = $conecta->selecionar($conecta->conn,$sql_praceiro);

$sql_categoria = "SELECT DISTINCT c.* FROM tbprod_categoria c INNER JOIN tbprod_subcategoria sc ON sc.categoria_id = c.id INNER JOIN tbproduto p ON p.subcategoria_id = sc.id ORDER BY rand() LIMIT 0,8";
$resultado_categoria = $conecta->selecionar($conecta->conn,$sql_categoria);

$sql_blog = "SELECT t.*, a.titulo as autor, c.titulo as categoria FROM tbgrupo_noticia t INNER JOIN tbautor a ON a.id = t.autor_id INNER JOIN tbcategoria c ON c.id = t.categoria_id WHERE t.status = 1 ORDER BY t.data DESC LIMIT 0,8";
$resultado_blog = $conecta->selecionar($conecta->conn,$sql_blog);

$sql_depoimento = "SELECT * FROM tbdepoimento WHERE status = 1 ORDER BY rand() DESC, id DESC LIMIT 0,12";
$resultado_depoimento = $conecta->selecionar($conecta->conn, $sql_depoimento);

$sql_fotos = "SELECT f.foto, f.legenda, g.titulo, g.conteudo FROM tbgaleria g INNER JOIN tbfoto f ON f.galeria_id = g.id WHERE g.status = 1 ORDER BY rand() DESC LIMIT 0,12";
$resultado_fotos = $conecta->selecionar($conecta->conn, $sql_fotos);


$where_marca = "";
if(@$marca != ''){
    $where_marca = " AND p.marca = ".$marca;
}

$sql_premium = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_premium = $conecta->selecionar($conecta->conn, $sql_premium);

$sql_ultimos = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND p.box1 = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_ultimos = $conecta->selecionar($conecta->conn, $sql_ultimos);


$sql_banner_esquerda = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 3 ORDER BY rand()";
$resultado_banner_esquerda = $conecta->selecionar($conecta->conn,$sql_banner_esquerda);

$sql_banner_direita = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 4 ORDER BY rand()";
$resultado_banner_direita = $conecta->selecionar($conecta->conn,$sql_banner_direita);

$sql_praceiro2 = "SELECT * FROM tbparceiro WHERE status = 1 ORDER BY rand() ASC";
$resultado_parceiro2 = $conecta->selecionar($conecta->conn,$sql_praceiro2);


$sql_banner_rodape = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 5 ORDER BY rand() LIMIT 0,5";
$resultado_banner_rodape = $conecta->selecionar($conecta->conn,$sql_banner_rodape);



$sql_banner_rodape_logo = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 6 ORDER BY rand() LIMIT 0,5";
$resultado_banner_rodape_logo = $conecta->selecionar($conecta->conn,$sql_banner_rodape_logo);

?>

<link href="<?php echo $siteUrl2;?>assets/plugins/gallery.css" rel="stylesheet">

<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<!-- Content area-->
<div class="content-area content" style="margin-top:162px;" >

<?php if($rs_configuracao['container_topo'] > 0) { ?>
    <!-- Main Slider -->
    <section class="page-section" style="padding:20px 0;">
        <div class="container full-width" style="max-width:100% !important; width:100% !important;">
            <div class="flexslider">
                <ul class="slides">
                    <?php while($rs_banner_cabecalho = mysqli_fetch_array($resultado_banner_cabecalho)){?>
                    <li>
                        <a href="<?php echo $rs_banner_cabecalho['link'];?>" target="_blank"><img class="rsImg" src="<?php echo $rs_banner_cabecalho['arquivo']?>" alt="" border="0" /></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div><!-- /.container -->
    </section>
    <!-- /Main Slider -->
<?php } ?>

<?php if($rs_configuracao['container_produtospremium'] > 0) { ?>
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_logomarcas'];?>; padding:20px 0;">
    <div class="container">
        <div class="row " >
            <ul id="manufacturers">
                <?php while($rs_parceiro = mysqli_fetch_array($resultado_parceiro)) {?>
                <li style="max-width:231px !important;"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_parceiro['id']?>"><img src="imagens/<?php echo $rs_parceiro['arquivo'];?>" style="max-width:200px !important;" width="200" height="80" title="<?php echo $rs_parceiro['titulo'];?>" alt="<?php echo $rs_parceiro['titulo'];?>" /></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_produtosdestaques'] > 0) { ?>
    <!-- Services  -->
    <section class="page-section" style="padding:20px 0;  background:<?php echo $rs_configuracao['fundo_container_produtosdestaques'];?>">

        <div class="container">
            <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
                <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">MAIS VISITADOS</h1>
            </div>
            <div class="row services" >
                <ul id="flexiselDemo2">
                	<?php while($rs_destaque = mysqli_fetch_array($resultado_destaque)){
						$promocional = 0;
						if(strtotime($rs_destaque['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_destaque['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
							$promocional = 1;
						}

					?>
                    <li class="col-md-3">
    				    <div class="view-first box-produtos">
    				    	<div class="borda-produtos" style="background: <?php echo $rs_configuracao['fundo_box_destaque']?> !important;  border: 1px solid <?php echo $rs_configuracao['fundo_box_destaque']?>; padding-bottom:20px;">
    					        <img src="<?php echo $siteUrl."source/Produtos/".$rs_destaque['foto'];?>" class="img-responsive" alt="<?php echo $rs_destaque['nome']." ".$rs_destaque['modelo'];?>" title="<?php echo $rs_destaque['nome']." ".$rs_destaque['modelo'];?>" />
                                <?php if($promocional == 1 && $rs_destaque['preco_promocional'] > 0){ ?>
                                    <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
position: absolute;
top: 10;
right: 167; margin: 0;
width: 100px;">
                                <?php } ?>
    					        <div class="mask">
    					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> VER DETALHES</button></a>
    					        </div>
    					        <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_destaque['marca_id']?>"><?php echo $rs_destaque['marca'];?></a></p>
    					        <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>"><?php echo $rs_destaque['nome']." ".$rs_destaque['modelo'];?></a></p>
    					        <p class="valor-de-para">
                                    <?php if($promocional == 1 && $rs_destaque['preco_promocional'] > 0){ ?>
        					        <span class="de" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><?php echo "de R$ ".number_format($rs_destaque['preco'],2,",",".");?></span>
        					        <span class="por"><?php echo "por R$ ".number_format($rs_destaque['preco_promocional'],2,",",".");?></span>
                                    <?php } else { ?>
                                    <span class="de"><?php echo ($rs_destaque['preco'] > 0 ? "R$ ".number_format($rs_destaque['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></span>
                                    <?php } ?>
    					        </p>
    					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Orçamento</a>
    				        </div>
    				    </div>
    				</li>

                    <?php } ?>
             	</ul>

            </div>
        </div>

    </section>
    <!-- /Services -->

<?php } ?>


<section class="page-section" id="" style="padding:5px 0; background:<?php echo $rs_configuracao['fundo_container_bannerpequeno'];?>;">
    <div class="container">
        <div class="row " >
            <div class="menu_home_barra" >
                <a href="http://industriasacramento.com.br/documentos/catalogo_sacramento.pdf" target="blank" style="color:#FFFFFF;">
                    <i class="fa fa-book menu_home_icone"></i>
                    <span class="menu_home_meio">Catálogo de Produtos</span>
                </a>
            </div>
            <div class="menu_home_barra" >
                <a href="<?php echo $siteUrl2;?>quem-somos/10" style="color:#FFFFFF;">
                    <i class="fa fa-bank menu_home_icone"></i>
                    <span class="menu_home_meio">Indústria Sacramento</span>
                </a>
            </div>
            <div class="menu_home_barra" >
                <a href="<?php echo $siteUrl2;?>trabalhe-conosco/38" style="color:#FFFFFF;">
                    <i class="fa fa-file-text menu_home_icone"></i>
                    <span class="menu_home_meio">Trabalhe Conosco</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php if($rs_configuracao['container_produtosultimos'] > 0) { ?>
    <section class="page-section" id="" style="padding:20px 0; background:<?php echo $rs_configuracao['fundo_container_produtosdestaques'];?>;">
        <div class="container">
            <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
                <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">UTILIDADES DOMÉSTICAS</h1>
            </div>
            <div class="row " >
                <ul id="flexiselDemo5">
                    <?php while($rs_ultimos = mysqli_fetch_array($resultado_ultimos)){
                        $promocional = 0;
                        if(strtotime($rs_ultimos['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_ultimos['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
                            $promocional = 1;
                        }

                    ?>
                    <li class="col-md-3">
                        <div class="view-first box-produtos" style="padding-bottom:1px;">
                            <div class="borda-produtos" style="background: <?php echo $rs_configuracao['fundo_box_ultimos']?> !important;  border: 1px solid <?php echo $rs_configuracao['fundo_box_ultimos']?>; padding-bottom:20px;">
                                <img src="<?php echo $siteUrl."source/Produtos/".$rs_ultimos['foto'];?>" class="img-responsive" alt="<?php echo $rs_ultimos['nome']." ".$rs_ultimos['modelo'];?>" title="<?php echo $rs_ultimos['nome']." ".$rs_ultimos['modelo'];?>"/>
                                <?php if($promocional == 1 && $rs_ultimos['preco_promocional'] > 0){ ?>
                                    <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
    position: absolute;
    top: 0;
    right: 135; margin: 0;
    width: 100px;">
                                <?php } ?>
                                <div class="mask">
                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_ultimos['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> VER DETALHES</button><a/>
                                </div>
                                <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_ultimos['marca_id']?>"><?php echo $rs_ultimos['marca'];?></a></p>
                                <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_ultimos['id'];?>"><?php echo $rs_ultimos['nome']." ".$rs_ultimos['modelo'];?></a></p>
                                <p class="valor-de-para">
                                    <?php if($promocional == 1 && $rs_ultimos['preco_promocional'] > 0){ ?>
                                    <span class="de" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><?php echo "de R$ ".number_format($rs_ultimos['preco'],2,",",".");?></span>
                                    <span class="por"><?php echo "por R$ ".number_format($rs_ultimos['preco_promocional'],2,",",".");?></span>
                                    <?php } else { ?>
                                    <span class="de"><?php echo ($rs_ultimos['preco'] > 0 ? "R$ ".number_format($rs_ultimos['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></span>
                                    <?php } ?>
                                </p>
                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_ultimos['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Orçamento</a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
<?php } ?>





<?php if($rs_configuracao['container_parceiros'] > 0) { ?>
<section class="page-section" id="" style="padding:20px 0; background:<?php echo $rs_configuracao['fundo_container_parceiros'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:#FFF !important;">NOSSOS PARCEIROS</h1>
        </div>
        <div class="row " >
            <ul id="manufacturers2" style="border-radius:3px; border:1px solid #25a8ba; height:70px; overflow:hidden; padding:10px 0; background:#FFFFFF;">
                <?php while($rs_parceiro2 = mysqli_fetch_array($resultado_parceiro2)) {?>
                <li><a href="<?php echo $rs_parceiro2['link']?>" target="_blank"><img src="<?php echo $rs_parceiro2['arquivo'];?>" style="max-width:100px !important;" width="100" height="50" title="<?php echo $rs_parceiro2['titulo'];?>" alt="<?php echo $rs_parceiro2['titulo'];?>" /></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>





<?php if($rs_configuracao['container_categoria'] > 0) { ?>
<section class="page-section" id="" style="padding:20px 0; background:<?php echo $rs_configuracao['fundo_container_categoria'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">ESCOLHA UMA CATEGORIA ABAIXO</h1>
        </div>

        <div class="row " >
            <ul id="flexiselDemo8">
                <?php $resultado_categoria = $conecta->selecionar($conecta->conn,$sql_categoria);
                $cor_fundo_box_categoria = hex2rgb($rs_configuracao['cor_fundo_box_categoria']);
                while($rs_categoria = mysqli_fetch_array($resultado_categoria)){ ?>
                <li class="col-sm-4" style="margin:0px !important;">
                    <div class="panties gallery_iten">
                        <div class="box" style="width:96%;">
                            <a href="<?php echo $siteUrl;?>catalogo/21/0/0/<?php echo $rs_categoria['id'];?>/0/0/0" class="gall_item"><img height="207" src="<?php echo $siteUrl2."source/Imagens/".$rs_categoria['arquivo'];?>" alt="<?php echo $rs_categoria['titulo'];?>" title="<?php echo $rs_categoria['titulo'];?>"><span></span></a>
                            <div class="box_bot" style="background:rgba(<?php echo $cor_fundo_box_categoria[0];?>,<?php echo $cor_fundo_box_categoria[1];?>,<?php echo $cor_fundo_box_categoria[2];?>, 0.75) !important;">
                                <a href="<?php echo $siteUrl;?>catalogo/21/0/0/<?php echo $rs_categoria['id'];?>/0/0/0" style="color:#FFFFFF; text-decoration:none;">
                                    <div class="box_bot_title"><?php echo $rs_categoria['titulo'];?></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_minibanner'] > 0) { ?>
<section class="page-section" id="" style="padding:20px 0; background:<?php echo $rs_configuracao['fundo_container_minibanner'];?>;">
    <div class="container">
        <div class="row " >
            <?php while($rs_banner_rodape = mysqli_fetch_array($resultado_banner_rodape)){ ?>
            <div class="banner_rodape"><a href="<?php echo $rs_banner_rodape['link'];?>" target="_blank"><img style="height:100px; max-width:200px !important;" class="rsImg" src="<?php echo $rs_banner_rodape['arquivo']?>" alt="" border="0" /></a></div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
