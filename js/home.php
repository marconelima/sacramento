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

$sql_ultimos = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND f.destaque = 1  ORDER BY modificado DESC LIMIT 0,18";
$resultado_ultimos = $conecta->selecionar($conecta->conn, $sql_ultimos);


$sql_banner_esquerda = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 3 ORDER BY rand()";
$resultado_banner_esquerda = $conecta->selecionar($conecta->conn,$sql_banner_esquerda);

$sql_banner_direita = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 4 ORDER BY rand()";
$resultado_banner_direita = $conecta->selecionar($conecta->conn,$sql_banner_direita);

$sql_praceiro2 = "SELECT DISTINCT m.* FROM tbprod_marca m INNER JOIN tbproduto p ON p.marca = m.id WHERE m.destaque = 1 ORDER BY rand() ASC";
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

<?php if($rs_configuracao['container_produtospremium'] > 0) { ?>
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_premium'];?>;">
    <div class="container">
        <div class="row " >
            <ul id="manufacturers">
                <?php while($rs_parceiro = mysqli_fetch_array($resultado_parceiro)) {?>
                <li style="max-width:180px !important;"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_parceiro['id']?>"><img src="imagens/<?php echo $rs_parceiro['arquivo'];?>" style="max-width:150px !important;" width="150" height="50" title="<?php echo $rs_parceiro['titulo'];?>" alt="<?php echo $rs_parceiro['titulo'];?>" /></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_produtosdestaques'] > 0) { ?>
    <!-- Services  -->
    <section class="page-section" style="padding-top:30px;  background:<?php echo $rs_configuracao['fundo_container_produtosdestaques'];?>">

        <div class="container">
            <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
                <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">NOSSOS PRODUTOS</h1>
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
    					        <img src="<?php echo $siteUrl."source/Produtos/".$rs_destaque['foto'];?>" class="img-responsive" />
    					        <div class="mask">
    					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button></a>
    					        </div>
    					        <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_destaque['marca_id']?>"><?php echo $rs_destaque['marca'];?></a></p>
    					        <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>"><?php echo $rs_destaque['nome']." . ".$rs_destaque['modelo'];?></a></p>
    					        <p class="valor-de-para">
                                    <?php if($promocional == 1 && $rs_destaque['preco_promocional'] > 0){ ?>
        					        <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_destaque['preco'],2,",",".");?></span>
        					        <span class="por"><?php echo "por R$ ".number_format($rs_destaque['preco_promocional'],2,",",".");?></span>
                                    <?php } else { ?>
                                    <span class="de"><?php echo "R$ ".number_format($rs_destaque['preco'],2,",",".");?></span>
                                    <?php } ?>
    					        </p>
    					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
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


<?php if($rs_configuracao['container_banner'] > 0) { ?>
<section class="page-section" id="" style="padding-top:30px; background:<?php echo $rs_configuracao['fundo_container_banner'];?>" >
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
<section class="page-section" id="" style="padding-top:30px; background:<?php echo $rs_configuracao['fundo_container_produtosselecionados'];?>">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">PRODUTOS EM DESTAQUE</h1>
        </div>
        <div class="row " >
            <div style="width:32%; float:left; margin-right:2%; min-height:400px; background: <?php echo $rs_configuracao['cor_fundo_box1']?> !important; font-size:25px;  border: 1px solid <?php echo $rs_configuracao['cor_fundo_box1']?>;">

					<div style="width:100%; float:left; margin-bottom:2%; padding:4% 1% 0% 1%;">
						<div class="" data-animation="fadeInUp" data-animation-delay="0" style="margin:0 0 2% 0;">
		                    <h5 class="section-title home-title box1" style="color:<?php echo $rs_configuracao['cor_titulo_box1']?> !important; font-family: <?php echo $rs_configuracao['nome_fonte2'];?> !important; padding: 0 10px; border-bottom:0;"><?php echo $rs_configuracao['box1']?></h5>
		                </div>




						<ul id="box_rot1" style="float:left; width:100% !important; height:auto; min-height:400px;">
							<?php while($rs_produto = mysqli_fetch_array($resultado_produto_box1)){ ?>
							<li style="width:100% !important; float:left;">
                                <div class="view-first box-produtos">
            				    	<div class="borda-produtos" style="background: <?php echo $rs_configuracao['cor_fundo_box1']?> !important;  border: 1px solid <?php echo $rs_configuracao['cor_fundo_box1']?>; padding-bottom:20px;">
            					        <img src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" class="img-responsive" />
            					        <div class="mask">
            					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button></a>
            					        </div>
            					        <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></p>
            					        <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." . ".$rs_produto['modelo'];?></a></p>
            					        <p class="valor-de-para">
                                            <?php if($promocional == 1 && $rs_produto['preco_promocional'] > 0){ ?>
                					        <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
                					        <span class="por"><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></span>
                                            <?php } else { ?>
                                            <span class="de"><?php echo "R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
                                            <?php } ?>
            					        </p>
            					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
            				        </div>
            				    </div>

						    </li>
							<?php } ?>
						</ul>

					</div>
					<div id="rotacao"></div>
				</div>


				<div style="width:32%; float:left; margin-right:2%; min-height:400px; background: <?php echo $rs_configuracao['cor_fundo_box2']?> !important; font-size:25px; border: 1px solid <?php echo $rs_configuracao['cor_fundo_box2']?>;">

					<div style="width:100%; float:left; margin-bottom:2%; padding:4% 1% 0% 1%;">
					<div class="" data-animation="fadeInUp" data-animation-delay="0" style="margin:0 0 2% 0;">
	                    <h5 class="section-title home-title box2" style="color:<?php echo $rs_configuracao['cor_titulo_box2']?> !important; font-family: <?php echo $rs_configuracao['nome_fonte2'];?> !important; padding: 0 10px; border-bottom:0;"><?php echo $rs_configuracao['box2']?></h5>
	                </div>
					<ul id="box_rot2" style="float:left; width:100% !important; height:auto; min-height:400px;">
						<?php while($rs_produto = mysqli_fetch_array($resultado_produto_box2)){

						?>
						<li style="width:100% !important; float:left;">
                            <div class="view-first box-produtos">
                                <div class="borda-produtos" style="background: <?php echo $rs_configuracao['cor_fundo_box2']?> !important;  border: 1px solid <?php echo $rs_configuracao['cor_fundo_box2']?>; padding-bottom:20px;">
                                    <img src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" class="img-responsive" />
                                    <div class="mask">
                                    <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button></a>
                                    </div>
                                    <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></p>
                                    <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." . ".$rs_produto['modelo'];?></a></p>
                                    <p class="valor-de-para">
                                        <?php if($promocional == 1 && $rs_produto['preco_promocional'] > 0){ ?>
                                        <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
                                        <span class="por"><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></span>
                                        <?php } else { ?>
                                        <span class="de"><?php echo "R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
                                        <?php } ?>
                                    </p>
                                    <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
                                </div>
                            </div>
						</li>
						<?php } ?>
					</ul>

				</div>
				<div id="rotacao2"></div>

				</div>

				<div style="width:32%; float:left; margin-right:0%; min-height:400px; background: <?php echo $rs_configuracao['cor_fundo_box3']?> !important; font-size:25px; border: 1px solid <?php echo $rs_configuracao['cor_fundo_box3']?>;">

					<div style="width:100%; float:left; margin-bottom:2%; padding:4% 1% 0% 1%;">
					<div class="" data-animation="fadeInUp" data-animation-delay="0" style="margin:0 0 2% 0;">
	                    <h5 class="section-title home-title box3" style="color:<?php echo $rs_configuracao['cor_titulo_box3']?> !important; font-family: <?php echo $rs_configuracao['nome_fonte2'];?> !important; padding: 0 10px; border-bottom:0;"><?php echo $rs_configuracao['box3']?></h5>
	                </div>
					<ul id="box_rot3" style="float:left; width:100% !important; height:auto; min-height:400px;">
						<?php while($rs_produto = mysqli_fetch_array($resultado_produto_box3)){

						?>
						<li style="width:100% !important; float:left;">
                            <div class="view-first box-produtos">
                                <div class="borda-produtos" style="background: <?php echo $rs_configuracao['cor_fundo_box3']?> !important;  border: 1px solid <?php echo $rs_configuracao['cor_fundo_box3']?>; padding-bottom:20px;">
                                    <img src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" class="img-responsive" />
                                    <div class="mask">
                                    <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button></a>
                                    </div>
                                    <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></p>
                                    <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." . ".$rs_produto['modelo'];?></a></p>
                                    <p class="valor-de-para">
                                        <?php if($promocional == 1 && $rs_produto['preco_promocional'] > 0){ ?>
                                        <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
                                        <span class="por"><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></span>
                                        <?php } else { ?>
                                        <span class="de"><?php echo "R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
                                        <?php } ?>
                                    </p>
                                    <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
                                </div>
                            </div>
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
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_premium'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">PRODUTOS SELECIONADOS</h1>
        </div>
        <div class="row " >
            <ul id="flexiselDemo3">
                <?php while($rs_premium = mysqli_fetch_array($resultado_premium)){
                    $promocional = 0;
                    if(strtotime($rs_premium['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_premium['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
                        $promocional = 1;
                    }

                ?>
                <li class="col-md-3">
                    <div class="view-first box-produtos">
                        <div class="borda-produtos" style="background: <?php echo $rs_configuracao['fundo_box_premium']?> !important;  border: 1px solid <?php echo $rs_configuracao['fundo_box_premium']?>; padding-bottom:20px;">
                            <img src="<?php echo $siteUrl."source/Produtos/".$rs_premium['foto'];?>" class="img-responsive" />
                            <div class="mask">
                            <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_premium['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button></a>
                            </div>
                            <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_premium['marca_id']?>"><?php echo $rs_premium['marca'];?></a></p>
                            <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_destaque['id'];?>"><?php echo $rs_premium['nome']." . ".$rs_premium['modelo'];?></a></p>
                            <p class="valor-de-para">
                                <?php if($promocional == 1 && $rs_premium['preco_promocional'] > 0){ ?>
                                <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_premium['preco'],2,",",".");?></span>
                                <span class="por"><?php echo "por R$ ".number_format($rs_premium['preco_promocional'],2,",",".");?></span>
                                <?php } else { ?>
                                <span class="de"><?php echo "R$ ".number_format($rs_premium['preco'],2,",",".");?></span>
                                <?php } ?>
                            </p>
                            <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_premium['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
                        </div>
                    </div>
                </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_kits'] > 0) { ?>
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_kits'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">KITS MERCADÃO DA CARNE</h1>
        </div>
        <div class="row " >
            <ul id="flexiselDemo4">
                <?php while($rs_kits = mysqli_fetch_array($resultado_kits)){
                    $promocional = 0;
                    if(strtotime($rs_kits['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_kits['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
                        $promocional = 1;
                    }

                ?>
                <li class="col-md-3">
                    <div class="view-first box-produtos">
                        <div class="borda-produtos" style="background: <?php echo $rs_configuracao['fundo_box_kits']?> !important;  border: 1px solid <?php echo $rs_configuracao['fundo_box_kits']?>; padding-bottom:20px;">
                            <img src="<?php echo $siteUrl."source/Produtos/".$rs_kits['foto'];?>" class="img-responsive" />
                            <div class="mask">
                            <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_kits['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button></a>
                            </div>
                            <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_kits['marca_id']?>"><?php echo $rs_kits['marca'];?></a></p>
                            <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_kits['id'];?>"><?php echo $rs_kits['nome']." . ".$rs_kits['modelo'];?></a></p>
                            <p class="valor-de-para">
                                <?php if($promocional == 1 && $rs_kits['preco_promocional'] > 0){ ?>
                                <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_kits['preco'],2,",",".");?></span>
                                <span class="por"><?php echo "por R$ ".number_format($rs_kits['preco_promocional'],2,",",".");?></span>
                                <?php } else { ?>
                                <span class="de"><?php echo "R$ ".number_format($rs_kits['preco'],2,",",".");?></span>
                                <?php } ?>
                            </p>
                            <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_kits['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>

        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_blog'] > 0) { ?>
<section class="page-section" id="" style="background:<?php echo $rs_configuracao['fundo_container_blog'];?>; padding-bottom:20px;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">BLOG MERCADÃO DA CARNE</h1>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel">
                    <?php $i = 0;
                    while($i < 8){
                    if($rs_blog = mysqli_fetch_array($resultado_blog)){

                        $cor_fundo_box_blog = hex2rgb($rs_configuracao['cor_fundo_box_blog']);
                    ?>
                    <div class="item" style="margin-left: 15px; margin-right:15px;">
                        <div class="thumbnail-caption">
                            <div class="caption" style="background:rgba(<?php echo $cor_fundo_box_blog[0];?>,<?php echo $cor_fundo_box_blog[1];?>,<?php echo $cor_fundo_box_blog[2];?>, 0.75) !important;">
                                <h4 style="width: 80% !important; margin: 0 10%;"><?php echo $rs_blog['titulo'];?></h4>
                                <p style="margin: 10px 0 !important;"><a class="cat" href="<?php echo $siteUrl;?>blog/8/0/0/<?php echo $rs_blog['categoria_id'];?>"><?php echo convertem($rs_blog['categoria'],1);?></a></p>
                                <p style="margin: 15px 0 !important;"><a href="<?php echo $siteUrl;?>post/8/1/<?php echo $rs_blog['id'];?>" class="label label-default" rel="tooltip" title="">Veja</a></p>
                            </div>
                            <img src="<?php echo $rs_blog['arquivo'];?>" alt="" width="260" height="190">
                        </div>
                    </div>
                    <?php }  $i++; } ?>


                </div>


            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_depoimento'] > 0) { ?>
<section class="page-section" id="" style="background:<?php echo $rs_configuracao['fundo_container_depoimento'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">DEPOIMENTOS</h1>
        </div>
        <div class="row " >
            <ul id="flexiselDemo6">
                <?php while($rs_depoimento = mysqli_fetch_array($resultado_depoimento)){?>
                <li class="col-sm-4" style="margin:0 0.1% !important;">
                    <div class=" media testimonial text-center">
                        <div class="testimonial-title">
                            <h4 class="media-heading"><?php echo $rs_depoimento['nome']?>,<small><?php echo $rs_depoimento['cidade']?></small><span><?php echo $mesesx[substr($rs_depoimento['data'],5,2)]." ".substr($rs_depoimento['data'],8,2).", ".substr($rs_depoimento['data'],0,4);?></span></h4>
                        </div>
                        <div class="clearfix"></div>
                        <div class="media-body">
                            <p><?php echo str_replace("<p>","",str_replace("</p>","",$rs_depoimento['conteudo']))?></p>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>

<?php

if($rs_configuracao['container_foto'] > 0) { ?>

    <section id="content" class="gallery page-section" style=" background:<?php echo $rs_configuracao['fundo_container_foto'];?>;">
        <div class="container">
            <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
                <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">GALERIA DE FOTOS</h1>
            </div>
            <div class="row">
                <ul id="flexiselDemo7">

                <?php while($rs_fotos = mysqli_fetch_array($resultado_fotos)) {
                    $cor_fundo_box_galeria = hex2rgb($rs_configuracao['cor_fundo_box_galeria']);
                ?>
                <li class="col-sm-4" style="margin:0 0.1% !important;">
                    <div class="panties gallery_iten">
                        <div class="box">
                            <a href="<?php echo $siteUrl2."source/Galeria/".$rs_fotos['foto'];?>" class="gall_item"><img height="207" src="<?php echo $siteUrl2."source/Galeria/".$rs_fotos['foto'];?>" alt="<?php echo $rs_fotos['legenda'];?>" title="<?php echo $rs_fotos['legenda'];?>"><span></span></a>
                            <div class="box_bot" style="background:rgba(<?php echo $cor_fundo_box_galeria[0];?>,<?php echo $cor_fundo_box_galeria[1];?>,<?php echo $cor_fundo_box_galeria[2];?>, 0.75) !important;">
                                <div class="box_bot_title"><?php echo $rs_fotos['titulo'];?></div>
                                <?php echo $rs_fotos['conteudo'];?>
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



<?php if($rs_configuracao['container_produtosultimos'] > 0) { ?>
    <section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_produtosultimos'];?>;">
        <div class="container">
            <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
                <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">ÚLTIMOS PRODUTOS CADASTRADOS</h1>
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
                        <div class="view-first box-produtos">
                            <div class="borda-produtos" style="background: <?php echo $rs_configuracao['fundo_box_ultimos']?> !important;  border: 1px solid <?php echo $rs_configuracao['fundo_box_ultimos']?>; padding-bottom:20px;">
                                <img src="<?php echo $siteUrl."source/Produtos/".$rs_ultimos['foto'];?>" class="img-responsive" />
                                <div class="mask">
                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_ultimos['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> DAR UMA OLHADINHA</button><a/>
                                </div>
                                <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_ultimos['marca_id']?>"><?php echo $rs_ultimos['marca'];?></a></p>
                                <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_ultimos['id'];?>"><?php echo $rs_ultimos['nome']." . ".$rs_ultimos['modelo'];?></a></p>
                                <p class="valor-de-para">
                                    <?php if($promocional == 1 && $rs_ultimos['preco_promocional'] > 0){ ?>
                                    <span class="de" style="text-decoration: line-through; color:#FF0000;"><?php echo "de R$ ".number_format($rs_ultimos['preco'],2,",",".");?></span>
                                    <span class="por"><?php echo "por R$ ".number_format($rs_ultimos['preco_promocional'],2,",",".");?></span>
                                    <?php } else { ?>
                                    <span class="de"><?php echo "R$ ".number_format($rs_ultimos['preco'],2,",",".");?></span>
                                    <?php } ?>
                                </p>
                                <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_ultimos['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Cotação</a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
<?php } ?>

<?php if($rs_configuracao['container_bannerpequeno'] > 0) { ?>
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_bannerpequeno'];?>;">
    <div class="container">
        <div class="row " >
            <div class="banner-half" style="margin:0 0 0 0px !important;">
                <ul id="banner_esquerda">
                <?php while($rs_banner_esquerda = mysqli_fetch_array($resultado_banner_esquerda)){?>
                <li><a href="<?php echo $rs_banner_esquerda['link'];?>" target="_blank"><img style="height:160px; width:100% !important;" class="rsImg" src="<?php echo $rs_banner_esquerda['arquivo']?>" alt="" border="0" /></a></li>
                <?php } ?>
                </ul>
            </div>
            <div class="banner-half" style="margin:0 0 0 20px !important; padding-left:5px;">
                <ul id="banner_direita">
                <?php while($rs_banner_direita = mysqli_fetch_array($resultado_banner_direita)){ ?>
                <li><a href="<?php echo $rs_banner_direita['link'];?>" target="_blank"><img style="height:160px; width:100% !important;" class="rsImg" src="<?php echo $rs_banner_direita['arquivo']?>" alt="" border="0" /></a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($rs_configuracao['container_parceiros'] > 0) { ?>
<section class="page-section" id="" style="background:<?php echo $rs_configuracao['fundo_container_parceiros'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">NOSSOS PARCEIROS</h1>
        </div>
        <div class="row " >
            <ul id="manufacturers2">
                <?php while($rs_parceiro2 = mysqli_fetch_array($resultado_parceiro2)) {?>
                <li style="width:180px !important;"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_parceiro2['id']?>"><img src="imagens/<?php echo $rs_parceiro2['arquivo'];?>" style="max-width:150px !important;" width="150" height="50" title="<?php echo $rs_parceiro2['titulo'];?>" alt="<?php echo $rs_parceiro2['titulo'];?>" /></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>



<?php if($rs_configuracao['container_categoria'] > 0) { ?>
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_categoria'];?>;">
    <div class="container">
        <div class="text-center" data-animation="fadeInUp" data-animation-delay="0">
            <h1 class="main-title" style="color:<?php echo $rs_configuracao['cor_titulo_home'];?> !important;">ESCOLHA UMA CATEGORIA ABAIXO</h1>
        </div>

        <div class="row " >
            <ul id="flexiselDemo8">
                <?php $resultado_categoria = $conecta->selecionar($conecta->conn,$sql_categoria);
                $cor_fundo_box_categoria = hex2rgb($rs_configuracao['cor_fundo_box_categoria']);
                while($rs_categoria = mysqli_fetch_array($resultado_categoria)){ ?>
                <li class="col-sm-3">
                    <div class="panties gallery_iten">
                        <div class="box">
                            <a href="<?php echo $siteUrl;?>catalogo/21/0/0/<?php echo $rs_categoria['id'];?>/0/0/0" class="gall_item"><img height="207" src="<?php echo $siteUrl2."source/Imagens/".$rs_categoria['arquivo'];?>" alt="<?php echo $rs_categoria['titulo'];?>" title="<?php echo $rs_categoria['titulo'];?>"><span></span></a>
                            <div class="box_bot" style="background:rgba(<?php echo $cor_fundo_box_categoria[0];?>,<?php echo $cor_fundo_box_categoria[1];?>,<?php echo $cor_fundo_box_categoria[2];?>, 0.75) !important;">
                                <div class="box_bot_title"><?php echo $rs_categoria['titulo'];?></div>
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
<section class="page-section" id="" style=" background:<?php echo $rs_configuracao['fundo_container_minibanner'];?>;">
    <div class="container">
        <div class="row " >
            <?php while($rs_banner_rodape = mysqli_fetch_array($resultado_banner_rodape)){ ?>
            <div class="banner_rodape"><a href="<?php echo $rs_banner_rodape['link'];?>" target="_blank"><img style="height:100px; max-width:200px !important;" class="rsImg" src="<?php echo $rs_banner_rodape['arquivo']?>" alt="" border="0" /></a></div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
