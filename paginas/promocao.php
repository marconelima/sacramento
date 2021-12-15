<?php
	$maximo = 18;
	$inicio = ($pag * $maximo) - $maximo;

	$filtro_busca = "";

	if(isset($_POST['search']) && @$_POST['search'] != ''){
		$filtro_busca = " AND ( p.descricao like '%".strip_tags(trim($_POST['search']))."%'";
		$filtro_busca .= " OR p.nome like '%".strip_tags(trim($_POST['search']))."%')";
	}

	$filtro_categoriab = "";
	if(isset($_POST['categoria']) && @$_POST['categoria'] != ''){
		$filtro_categoriab = " AND c.id = ".$_POST['categoria'];
	}

	$filtro_subcategoriab = "";
	if(isset($_POST['subcategoria']) && @$_POST['subcategoria'] != ''){
		$filtro_subcategoriab = " AND s.id = ".$_POST['subcategoria'];
	}

	$filtro_marcab = "";
	if(isset($_POST['marca']) && @$_POST['marca'] != ''){
		$filtro_marcab = " AND m.id = ".$_POST['marca'];
	}

	$filtro_palavra = "";

	if($palavra){
		$filtro_palavra = " AND p.tag like '%".$palavra."%'";
	}

	$filtro_categoria = "";
	if($categ != '' && $categ != 0){
		$filtro_categoria = " AND c.id = $categ";
	}

	$filtro_subcategoria = "";
	if($subcateg != '' && $subcateg != 0){
		$filtro_subcategoria = " AND s.id = $subcateg";
	}

	$filtro_marca = "";
	if($marca != '' && $marca != 0){
		$filtro_marca = " AND m.id = $marca";
	}

    $filtro_montadora = "";
    if($montadora != '' && $montadora != 0){
        $filtro_montadora = " AND p.montadora_id = $montadora";
    }

    $filtro_modelo = "";
    if($modelo != '' && $modelo != 0){
        $filtro_modelo = " AND p.montadora_id = $modelo";
    }

    $filtro_ano = "";
    if($ano != '' && $ano != 0){
        $filtro_ano = " AND p.montadora_id = $ano";
    }

    $filtro_versao = "";
    if($versao != '' && $versao != 0){
        $filtro_versao = " AND p.montadora_id = $versao";
    }

    $filtro_fornecedor = "";
    if($fornecedor != '' && $fornecedor != 0){
        $filtro_fornecedor = " AND p.fornecedor_id = $fornecedor";
    }

	$ordem_vw = "p.nome ASC";
	if(isset($_POST['ordem']) && @$_POST['ordem'] != ''){
		$ordem_vw = $_POST['ordem'];
	}

	$sql_paginacao = " LIMIT $inicio, $maximo";


	$sql_produto = "SELECT p.*, p.marca as marca_id, f.foto, f.legenda, s.titulo as subcategoria, m.titulo as marca, c.titulo as categoria FROM tbproduto p INNER JOIN tbprod_foto f ON f.produto_id = p.id INNER JOIN tbprod_subcategoria s ON s.id = p.subcategoria_id INNER JOIN tbprod_categoria c ON c.id = s.categoria_id LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.status = 1 AND preco_promocional > 0 AND data_promocional_inicio <= '".date('Y-m_d')."' AND data_promocional_fim >= '".date('Y-m_d')."' AND f.destaque = 1 $filtro_marca $filtro_subcategoria $filtro_categoria $filtro_palavra $filtro_busca $filtro_marcab $filtro_subcategoriab $filtro_categoriab $filtro_modelo $filtro_categoriab $filtro_ano $filtro_versao $filtro_fornecedor ORDER BY $ordem_vw";

	$resultado_produto = $conecta->selecionar($conecta->conn, $sql_produto.$sql_paginacao);
	$resultado_total = $conecta->selecionar($conecta->conn, $sql_produto);

	$qtde_prod_total = mysqli_num_rows($resultado_total);

	if($qtde_prod_total < ($pag * $maximo)){
		$nummostrado = $qtde_prod_total;
	} else {
		$nummostrado = 	($pag * $maximo);
	}

	$tags = "";
	while($rs_tag = mysqli_fetch_array($resultado_total)){
            if(!@substr_count($tags,$rs_tag['tag'])){
		$tags .= $rs_tag['tag'].",";
            }
	}

?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title"><?php echo $rs_tela['nome'];?></h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Produtos</li>
		</ul><!-- /.breadcrumb -->
		<!-- /Breadcrumbs -->
	</div>
</section>
<!-- /Header and Breadcrumbs  -->

<link href="<?php echo $siteUrl2;?>assets/plugins/gallery.css" rel="stylesheet">

</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">

        <section class="page-section with-sidebar sidebar-right no-top-padding">
            <div class="container">
                <div class="row">

                <?php include "sidebar_catalogo.php";?>

                    <!-- Content -->
                    <div class="col-sm-9 content shop" style="max-width:74% !important; margin-left:1%;">


                        <!-- Results -->
                        <div class="row shop-result">
                            <div class="inner darken clearfix">
                                <div class="col-xs-6 result-count">
                                    Exibindo <strong><?php echo $inicio+1;?> - <?php echo $nummostrado;?></strong> de <strong><?php echo $qtde_prod_total;?></strong> produtos
                                </div>
                                <div class="col-xs-6 result-ordering" style="line-height: 5px;">
                                    <div class="pull-right" style="width: 100%; text-align: right;">
                                        <form action="" name="formOrdem" method="post" enctype="multipart/form-data">
                                        <p style="width: 58%; float: left; text-align: right;">Ordenar por: </p>
                                        <select name="ordem" onchange="javascript: document.formOrdem.submit();" style="width: 40%;">
                                            <option value="">Selecione</option>
                                            <option value="p.preco ASC">Menor Preço</option>
                                            <option value="p.preco DESC">Maior Preço</option>
                                            <option value="p.modificado DESC">Mais Recentes</option>
                                            <option value="p.nome ASC">De A - Z</option>
                                            <option value="p.nome DESC">De Z - A</option>
                                         </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Results -->

						<!-- Products -->
                        <div class="row">
                        	<?php $i = 0; while($rs_produto = mysqli_fetch_array($resultado_produto)){

                                if($i%3 == 0){
                                    echo "<div style='width:100%; float:left; height:10px;'></div>";
                                }

								$promocional = 0;
						if(strtotime($rs_produto['data_promocional_inicio']) <= strtotime(date('Y-m-d')) && strtotime($rs_produto['data_promocional_fim']) >= strtotime(date('Y-m-d'))){
							$promocional = 1;
						}
								?>

							<div class="col-md-4" style="padding-right:0;">
		    				    <div class="view-first box-produtos" style="width:100%;">
		    				    	<div class="borda-produtos post-wrap" style="background:<?php echo $rs_configuracao['cor_box_produto'];?>; border:0;">
		    					        <img src="<?php echo $siteUrl."source/Produtos/".$rs_produto['foto'];?>" class="img-responsive" alt="<?php echo $rs_produto['nome']." ".$rs_produto['modelo'];?>" title="<?php echo $rs_produto['nome']." ".$rs_produto['modelo'];?>"/>
										<?php if($promocional == 1 && $rs_produto['preco_promocional'] > 0){ ?>
		                                    <img class="cornerimage" src="<?php echo $siteUrl."source/Produtos/promocao.png" ?>" alt="" style="border: 0;
		    position: absolute;
		    top: 10;
		    right: 167; margin: 0;
		    width: 100px;">
		                                <?php } ?>
		    					        <div class="mask">
		    					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><button type="button" class="btn btn-default olhadinha"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> VER DETALHES</button></a>
		    					        </div>
		    					        <p class="titulo-produto"><a href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/<?php echo $rs_produto['marca_id']?>"><?php echo $rs_produto['marca'];?></a></p>
		    					        <p class="desc-produto"><a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>"><?php echo $rs_produto['nome']." ".$rs_produto['modelo'];?></a></p>
		    					        <p class="valor-de-para">
		                                    <?php if($promocional == 1 && $rs_produto['preco_promocional'] > 0){ ?>
		        					        <span class="de" style="text-decoration: line-through; color:#FF0000; font-size:16px !important; font-weight:normal;"><?php echo "de R$ ".number_format($rs_produto['preco'],2,",",".");?></span>
		        					        <span class="por"><?php echo "por R$ ".number_format($rs_produto['preco_promocional'],2,",",".");?></span>
		                                    <?php } else { ?>
		                                    <span class="de"><?php echo ($rs_produto['preco'] > 0 ? "R$ ".number_format($rs_produto['preco'],2,",",".") : "PREÇO SOB-CONSULTA");?></span>
		                                    <?php } ?>
		    					        </p>
		    					        <a href="<?php echo $siteUrl?>produto/21/0/<?php echo $rs_produto['id'];?>" class="btn info btn-default add-cotacao">Adicionar a Orçamento</a>
		    				        </div>
		    				    </div>
		    				</div>


                            <?php $i++; } ?>

                            <div class="clearfix"></div>
                        </div>
                        <!-- /Products-->

						<?php include "paginacao.php";?>

                    </div><!-- /.content -->
                    <!-- /Content -->
				 </div>
            </div>
        </section>
