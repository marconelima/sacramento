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


$sql_destaque = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND destaque_home = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_destaque = $conecta->selecionar($conecta->conn, $sql_destaque);

$sql_kits = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 AND destaque_home = 1 ORDER BY modificado DESC LIMIT 0,18";
$resultado_kits = $conecta->selecionar($conecta->conn, $sql_kits);

$sql_praceiro = "SELECT DISTINCT m.* FROM tbprod_marca m INNER JOIN tbproduto p ON p.marca = m.id WHERE m.destaque = 1 ORDER BY rand() ASC";
$resultado_parceiro = $conecta->selecionar($conecta->conn,$sql_praceiro);

$sql_categoria = "SELECT DISTINCT c.* FROM tbprod_categoria c INNER JOIN tbprod_subcategoria sc ON sc.categoria_id = c.id INNER JOIN tbproduto p ON p.subcategoria_id = sc.id ORDER BY rand() LIMIT 0,8";
$resultado_categoria = $conecta->selecionar($conecta->conn,$sql_categoria);

$sql_blog = "SELECT t.*, a.titulo as autor, c.titulo as categoria FROM tbgrupo_noticia t INNER JOIN tbautor a ON a.id = t.autor_id INNER JOIN tbcategoria c ON c.id = t.categoria_id WHERE t.status = 1 ORDER BY t.data DESC LIMIT 0,8";
$resultado_blog = $conecta->selecionar($conecta->conn,$sql_blog);

$sql_depoimento = "SELECT * FROM tbdepoimento WHERE status = 1 ORDER BY rand() DESC, id DESC LIMIT 0,3";
$resultado_depoimento = $conecta->selecionar($conecta->conn, $sql_depoimento);

$sql_fotos = "SELECT f.foto, f.legenda, g.titulo, g.conteudo FROM tbgaleria g INNER JOIN tbfoto f ON f.galeria_id = g.id WHERE g.status = 1 ORDER BY rand() DESC LIMIT 0,3";
$resultado_fotos = $conecta->selecionar($conecta->conn, $sql_fotos);


$where_marca = "";
if(@$marca != ''){
    $where_marca = " AND p.marca = ".$marca;
}

$sql_premium = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1 $where_marca ORDER BY modificado DESC LIMIT 0,18";
$resultado_premium = $conecta->selecionar($conecta->conn, $sql_premium);
?>



<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<!-- Content area-->
<div class="content-area content" style="margin-top:162px;" >

<?php if($rs_configuracao['container_topo'] > 0) { ?>
    <!-- Main Slider -->
    <section class="page-section">
        <div class="container full-width">
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

<?php if($rs_configuracao['container_produtosdestaques'] > 0) { ?>
    <!-- Services  -->
    <section class="page-section" style="padding-top:80px;  background:<?php echo $rs_configuracao['fundo_container_produtosdestaques'];?>">

        <div class="container">
            <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
                <h1 class="main-title">PRODUTOS EM DESTAQUE</h1>
            </div>
            <div class="row services" >
                <ul id="flexiselDemo2">
                	<?php while($rs_destaque = mysqli_fetch_array($resultado_destaque)){
						$promocional = 0;
						if(strtotime($rs_destaque['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_destaque['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
							$promocional = 1;
						}

					?>
                    <li class="col-sm-3">
                        <article class="post-wrap">
                            <div class="post-media">
                                <div class="thumbnail do-hover">
                                    <img class="img-responsive" src="<?php echo $siteUrl."source/Produtos/".$rs_destaque['foto'];?>" alt=""/>
                                    <?php if($promocional == 1 && $rs_destaque['preco_promocional'] > 0){ ?>
                                        <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
  position: absolute;
  top: 0;
  right: 135; margin: 0;
    width: 100px;">
                                    <?php } ?>
                                    <div class="caption">
                                        <div class="caption-wrapper div-table" style="height: 100% !important;">
                                            <div class="caption-inner div-cell">
                                                <p class="caption-buttons">
                                                    <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>" class="btn caption-zoom theone"><i class="fa fa-link"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-header text-center">
                                <div class="shop-category"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_destaque['marca_id']?>"><?php echo $rs_destaque['marca'];?></a></div>
                                <h2 class="post-title"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>"><?php echo $rs_destaque['nome']." . ".$rs_destaque['modelo'];?></a></h2>
                                <?php if($promocional == 1 && $rs_destaque['preco_promocional'] > 0){ ?>
                                    <h3 class="post-title" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><strong><?php echo "de R$ ".number_format($rs_destaque['preco'],2,",",".");?></strong></h3>
                                    <h2 class="post-title"><strong><?php echo "por R$ ".number_format($rs_destaque['preco_promocional'],2,",",".");?></strong></h2>
                                <?php } else { ?>
                                    <h2 class="post-title"><strong><?php echo ($rs_destaque['preco'] > 0 ? "R$ ".number_format($rs_destaque['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></strong></h2>
                                <?php } ?>

                            </div>
                            <div class="post-footer text-center">
                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>" class="btn btn-default add2cart"><i class="fa fa-shopping-cart"></i> Adicionar Orçamento</a>
                            </div>
                        </article><!-- /.post-wrap -->
                    </li>
                    <?php } ?>
             	</ul>

            </div>
        </div>

    </section>
    <!-- /Services -->

<?php } ?>


<?php if($rs_configuracao['container_banner'] > 0) { ?>
<section class="page-section" id="" style="padding-top:80px; background:<?php echo $rs_configuracao['fundo_container_banner'];?>" >
    <div class="container">
        <div class="row " >
            <div class="banner-full">
            	<ul id="banner_meio">
                <?php while($rs_banner_meio = mysqli_fetch_array($resultado_banner_meio)){ ?>
				<li><a href="<?php echo $rs_banner_meio['link'];?>" target="_blank"><img class="rsImg" src="<?php echo $rs_banner_meio['arquivo']?>" alt="" border="0" /></a></li>
                <?php } ?>
                </ul>
			</div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_produtosselecionados'] > 0) { ?>
<section class="page-section" id="" style="padding-top:80px; background:<?php echo $rs_configuracao['fundo_container_produtosselecionados'];?>">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title">PRODUTOS SELECIONADOS</h1>
        </div>
        <div class="row " >
            <div style="width:32%; float:left; margin-right:2%; min-height:600px;">

					<div style="width:100%; float:left; margin-bottom:2%; padding:4% 1% 8% 1%;">
						<div class="" data-animation="fadeInUp" data-animation-delay="0" style="margin:0 0 2% 0;">
		                    <h5 class="section-title home-title"><?php echo $rs_configuracao['box1']?></h5>
		                </div>

						<ul id="box_rot1" style="float:left; width:100% !important; height:auto; min-height:600px;">
							<?php while($rs_produto = mysqli_fetch_array($resultado_produto_box1)){ ?>
							<li style="width:100% !important; float:left;">
						        <article class="post-wrap">
						            <div class="post-media">
						                <div class="thumbnail do-hover">
						                    <img class="img-responsive" src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" style="max-height:380px;" alt=""/>
						                    <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
						position: absolute;
						top: 0;
						left:0; margin: 0;
						width: 100px;">
						                    <div class="caption">
						                        <div class="caption-wrapper div-table" style="height: 100% !important;">
						                            <div class="caption-inner div-cell">
						                                <p class="caption-buttons">
						                                    <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn caption-zoom theone"><i class="fa fa-link"></i></a>
						                                </p>
						                            </div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						            <div class="post-header text-center">
						                <div class="shop-category"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></div>
						                <h2 class="post-title"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." . ".$rs_produto['modelo'];?></a></h2>
						                <?php if($promocional == 1 && $rs_produto['preco'] > 0){ ?>
						                    <h3 class="post-title" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><strong><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></strong></h3>
						                    <h2 class="post-title"><strong><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></strong></h2>
						                <?php } else { ?>
						                    <h2 class="post-title"><strong><?php echo ($rs_produto['preco'] > 0 ? "R$ ".number_format($rs_produto['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></strong></h2>
						                <?php } ?>

						            </div>
						            <div class="post-footer text-center">
						                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn btn-default add2cart"><i class="fa fa-shopping-cart"></i> Adicionar Orçamento</a>
						            </div>
						        </article><!-- /.post-wrap -->
						    </li>
							<?php } ?>
						</ul>

					</div>
					<div id="rotacao"></div>
				</div>


				<div style="width:32%; float:left; margin-right:2%; min-height:600px;">

					<div style="width:100%; float:left; margin-bottom:2%; padding:4% 1% 8% 1%;">
					<div class="" data-animation="fadeInUp" data-animation-delay="0" style="margin:0 0 2% 0;">
	                    <h5 class="section-title home-title"><?php echo $rs_configuracao['box2']?></h5>
	                </div>
					<ul id="box_rot2" style="float:left; width:100% !important; height:auto; min-height:600px;">
						<?php while($rs_produto = mysqli_fetch_array($resultado_produto_box2)){

						?>
						<li style="width:100% !important; float:left;">
							<article class="post-wrap">
								<div class="post-media">
									<div class="thumbnail do-hover">
										<img class="img-responsive" src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" style="max-height:380px;" alt=""/>
										<img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
					position: absolute;
					top: 0;
					left:0; margin: 0;
					width: 100px;">
										<div class="caption">
											<div class="caption-wrapper div-table" style="height: 100% !important;">
												<div class="caption-inner div-cell">
													<p class="caption-buttons">
														<a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn caption-zoom theone"><i class="fa fa-link"></i></a>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="post-header text-center">
									<div class="shop-category"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></div>
									<h2 class="post-title"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." . ".$rs_produto['modelo'];?></a></h2>
									<?php if($promocional == 1 && $rs_produto['preco'] > 0){ ?>
										<h3 class="post-title" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><strong><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></strong></h3>
										<h2 class="post-title"><strong><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></strong></h2>
									<?php } else { ?>
										<h2 class="post-title"><strong><?php echo ($rs_produto['preco'] > 0 ? "R$ ".number_format($rs_produto['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></strong></h2>
									<?php } ?>

								</div>
								<div class="post-footer text-center">
									<a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn btn-default add2cart"><i class="fa fa-shopping-cart"></i> Adicionar Orçamento</a>
								</div>
							</article><!-- /.post-wrap -->
						</li>
						<?php } ?>
					</ul>

				</div>
				<div id="rotacao2"></div>

				</div>

				<div style="width:32%; float:left; margin-right:0%; min-height:600px;">

					<div style="width:100%; float:left; margin-bottom:2%; padding:4% 1% 8% 1%;">
					<div class="" data-animation="fadeInUp" data-animation-delay="0" style="margin:0 0 2% 0;">
	                    <h5 class="section-title home-title"><?php echo $rs_configuracao['box3']?></h5>
	                </div>
					<ul id="box_rot3" style="float:left; width:100% !important; height:auto; min-height:600px;">
						<?php while($rs_produto = mysqli_fetch_array($resultado_produto_box3)){

						?>
						<li style="width:100% !important; float:left;">
							<article class="post-wrap">
								<div class="post-media">
									<div class="thumbnail do-hover">
										<img class="img-responsive" src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" style="max-height:380px;" alt=""/>
										<img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
					position: absolute;
					top: 0;
					left:0; margin: 0;
					width: 100px;">
										<div class="caption">
											<div class="caption-wrapper div-table" style="height: 100% !important;">
												<div class="caption-inner div-cell">
													<p class="caption-buttons">
														<a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn caption-zoom theone"><i class="fa fa-link"></i></a>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="post-header text-center">
									<div class="shop-category"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></div>
									<h2 class="post-title"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." . ".$rs_produto['modelo'];?></a></h2>
									<?php if($promocional == 1 && $rs_produto['preco'] > 0){ ?>
										<h3 class="post-title" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><strong><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></strong></h3>
										<h2 class="post-title"><strong><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></strong></h2>
									<?php } else { ?>
										<h2 class="post-title"><strong><?php echo ($rs_produto['preco'] > 0 ? "R$ ".number_format($rs_produto['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></strong></h2>
									<?php } ?>

								</div>
								<div class="post-footer text-center">
									<a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn btn-default add2cart"><i class="fa fa-shopping-cart"></i> Adicionar Orçamento</a>
								</div>
							</article><!-- /.post-wrap -->
						</li>
						<?php } ?>
					</ul>

				</div>
				<div id="rotacao3"></div>

				</div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_produtospremium'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title">PRODUTOS LINHA PREMIUM</h1>
        </div>
        <div class="row " >
            <ul id="manufacturers">
            	<?php while($rs_parceiro = mysqli_fetch_array($resultado_parceiro)) {?>
				<li><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_parceiro['id']?>"><img src="imagens/<?php echo $rs_parceiro['arquivo'];?>" title="<?php echo $rs_parceiro['titulo'];?>" alt="<?php echo $rs_parceiro['titulo'];?>" /></a></li>
                <?php } ?>
			</ul>
            <ul id="flexiselDemo3">
                <?php while($rs_premium = mysqli_fetch_array($resultado_premium)){
                    $promocional = 0;
                    if(strtotime($rs_premium['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_premium['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
                        $promocional = 1;
                    }

                ?>
                <li class="col-sm-3">
                    <article class="post-wrap">
                        <div class="post-media">
                            <div class="thumbnail do-hover">
                                <img class="img-responsive" src="<?php echo $siteUrl."source/Produtos/".$rs_premium['foto'];?>" alt=""/>
                                <?php if($promocional == 1 && $rs_premium['preco_promocional'] > 0){ ?>
                                    <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
position: absolute;
top: 0;
right: 135; margin: 0;
width: 100px;">
                                <?php } ?>
                                <div class="caption">
                                    <div class="caption-wrapper div-table" style="height: 100% !important;">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_premium['id'];?>" class="btn caption-zoom theone"><i class="fa fa-link"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-header text-center">
                            <div class="shop-category"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_premium['marca_id']?>"><?php echo $rs_premium['marca'];?></a></div>
                            <h2 class="post-title"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_premium['id'];?>"><?php echo $rs_premium['nome']." . ".$rs_premium['modelo'];?></a></h2>
                            <?php if($promocional == 1 && $rs_premium['preco_promocional'] > 0){ ?>
                                <h3 class="post-title" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><strong><?php echo "de R$ ".number_format($rs_premium['preco'],2,",",".");?></strong></h3>
                                <h2 class="post-title"><strong><?php echo "por R$ ".number_format($rs_premium['preco_promocional'],2,",",".");?></strong></h2>
                            <?php } else { ?>
                                <h2 class="post-title"><strong><?php echo ($rs_premium['preco'] > 0 ? "R$ ".number_format($rs_premium['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></strong></h2>
                            <?php } ?>

                        </div>
                        <div class="post-footer text-center">
                            <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_premium['id'];?>" class="btn btn-default add2cart"><i class="fa fa-shopping-cart"></i> Adicionar Orçamento</a>
                        </div>
                    </article><!-- /.post-wrap -->
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_kits'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title">KITS MERCADÃO DA CARNE</h1>
        </div>
        <div class="row " >
            <ul id="flexiselDemo4">
                <?php while($rs_kits = mysqli_fetch_array($resultado_kits)){
                    $promocional = 0;
                    if(strtotime($rs_kits['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_kits['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
                        $promocional = 1;
                    }

                ?>
                <li class="col-sm-3">
                    <article class="post-wrap">
                        <div class="post-media">
                            <div class="thumbnail do-hover">
                                <img class="img-responsive" src="<?php echo $siteUrl."source/Produtos/".$rs_kits['foto'];?>" alt=""/>
                                <?php if($promocional == 1 && $rs_kits['preco_promocional'] > 0){ ?>
                                    <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
position: absolute;
top: 0;
right: 135; margin: 0;
width: 100px;">
                                <?php } ?>
                                <div class="caption">
                                    <div class="caption-wrapper div-table" style="height: 100% !important;">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_kits['id'];?>" class="btn caption-zoom theone"><i class="fa fa-link"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-header text-center">
                            <div class="shop-category"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_kits['marca_id']?>"><?php echo $rs_kits['marca'];?></a></div>
                            <h2 class="post-title"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_kits['id'];?>"><?php echo $rs_kits['nome']." . ".$rs_kits['modelo'];?></a></h2>
                            <?php if($promocional == 1 && $rs_kits['preco_promocional'] > 0){ ?>
                                <h3 class="post-title" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><strong><?php echo "de R$ ".number_format($rs_kits['preco'],2,",",".");?></strong></h3>
                                <h2 class="post-title"><strong><?php echo "por R$ ".number_format($rs_kits['preco_promocional'],2,",",".");?></strong></h2>
                            <?php } else { ?>
                                <h2 class="post-title"><strong><?php echo ($rs_kits['preco'] > 0 ? "R$ ".number_format($rs_kits['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></strong></h2>
                            <?php } ?>

                        </div>
                        <div class="post-footer text-center">
                            <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_kits['id'];?>" class="btn btn-default add2cart"><i class="fa fa-shopping-cart"></i> Adicionar Orçamento</a>
                        </div>
                    </article><!-- /.post-wrap -->
                </li>
                <?php } ?>
            </ul>

        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_blog'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title">BLOG MERCADÃO DA CARNE</h1>
        </div>
        <div class="row " >


            <style type="text/css">
            .carousel-inner .active.left { left: -25%; }
            .carousel-inner .next        { left:  25%; }
            .carousel-control.left,.carousel-control.right {background-image:none;}
            </style>
            <div class="row box todos">
                <div class="col-sm-12">
                    <div class="carousel slide" id="myCarousel1">
                        <div class="carousel-inner">
                          <?php $i = 1; while($rs_blog = mysqli_fetch_array($resultado_blog)){ ?>
                              <div class="item <?php if($i == 1) { echo 'active'; } ?>">
                                  <div class="col-sm-3"><div class="pop-cat cat<?php echo $i;?> text-center" style="background: url('<?php echo $siteUrl;?>source/Imagens/<?php echo $rs_blog['arquivo'];?>') center center no-repeat;"><a href="<?php echo $siteUrl;?>catalogo/21/0/0/<?php echo $rs_blog['id'];?>"><?php echo $rs_blog['titulo'];?></a></div></div>
                              </div>
                          <?php $i++; } ?>
                        </div>
                    <a class="left carousel-control" href="#myCarousel1" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#myCarousel1" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_depoimento'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title">DEPOIMENTOS</h1>
        </div>
        <div class="row " >
            <?php while($rs_depoimento = mysqli_fetch_array($resultado_depoimento)){?>
            <div class="col-sm-4 media testimonial text-center" style="width:31% !important; margin:0 1% !important;">
                <div class="testimonial-title">
                    <h4 class="media-heading"><?php echo $rs_depoimento['nome']?>,<small><?php echo $rs_depoimento['cidade']?></small><span><?php echo $mesesx[substr($rs_depoimento['data'],5,2)]." ".substr($rs_depoimento['data'],8,2).", ".substr($rs_depoimento['data'],0,4);?></span></h4>
                </div>
                <div class="clearfix"></div>
                <div class="media-body">
                    <p><?php echo str_replace("<p>","",str_replace("</p>","",$rs_depoimento['conteudo']))?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_foto'] > 0) { ?>

    <section id="content" class="gallery page-section">
        <div class="container">
            <div class="row">
                <nav id="categories_list">
                    <ul>
                        <a href="<?php echo $siteUrl2?>fotos/10"><li id="all" class="category_iten">todos</li></a>
                        <?php while($rs_categoria = mysqli_fetch_array($resultado_categoria)){ ?>
                        <a href="<?php echo $siteUrl2?>fotos/10/0/0/<?php echo $rs_categoria['id'];?>"><li id="bra" class="category_iten"><?php echo convertem($rs_categoria['titulo'],1);?></li></a>
                        <?php } ?>
                    </ul>
                </nav>

                <?php while($rs_fotos = mysqli_fetch_array($resultado)) { ?>
                <div class="grid_4 panties gallery_iten">
                        <div class="box">
                            <a href="<?php echo $siteUrl2."source/Galeria/".$rs_fotos['foto'];?>" class="gall_item"><img height="207" src="<?php echo $siteUrl2."source/Galeria/".$rs_fotos['foto'];?>" alt="<?php echo $rs_fotos['legenda'];?>" title="<?php echo $rs_fotos['legenda'];?>"><span></span></a>
                            <div class="box_bot">
                                <div class="box_bot_title"><?php echo $rs_fotos['titulo'];?></div>
                                <?php echo $rs_fotos['conteudo'];?>
                            </div>
                        </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>

<?php if($rs_configuracao['container_produtosultimos'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="row " >
            CONTAINER PRODUTOS ULTIMOS
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_bannerpequeno'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="row " >
            CONTAINER BANNER PEQUENO
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_parceiros'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="row " >
            CONTAINER PARCEIROS
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_newsletter'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="row " >
            CONTAINER NEWSLETTER
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_categoria'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title">ESCOLHA UMA CATEGORIA ABAIXO</h1>
        </div>

        <div class="row " >
        <style type="text/css">
        .carousel-inner .active.left { left: -25%; }
        .carousel-inner .next        { left:  25%; }
        .carousel-control.left,.carousel-control.right {background-image:none;}
        </style>
        <div class="row box todos">
            <div class="col-sm-12">
                <div class="carousel slide" id="myCarousel1">
                    <div class="carousel-inner">
                      <?php $i = 1; $resultado_categoria = $conecta->selecionar($conecta->conn,$sql_categoria); while($rs_categoria = mysqli_fetch_array($resultado_categoria)){ ?>
                          <div class="item <?php if($i == 1) { echo 'active'; } ?>">
                              <div class="col-sm-3"><div class="pop-cat cat<?php echo $i;?> text-center" style="background: url('<?php echo $siteUrl;?>source/Imagens/<?php echo $rs_categoria['arquivo'];?>') center center no-repeat;"><a href="<?php echo $siteUrl;?>catalogo/21/0/0/<?php echo $rs_categoria['id'];?>"><?php echo $rs_categoria['titulo'];?></a></div></div>
                          </div>
                      <?php $i++; } ?>
                    </div>
                <a class="left carousel-control" href="#myCarousel1" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#myCarousel1" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
            </div>
        </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_minibanner'] > 0) { ?>
<section class="page-section" id="" style="margin-top:80px;">
    <div class="container">
        <div class="row " >
            CONTAINER MINIBANNER
        </div>
    </div>
</section>
<?php } ?>
