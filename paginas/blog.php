<?php

	$filtro_busca = "";

	$tabela = "tbgrupo_noticia";

	if(isset($_POST['search']) && @$_POST['search'] != ''){
		$filtro_busca = " AND ( t.conteudo like '%".strip_tags(trim($_POST['search']))."%'";
		$filtro_busca .= " OR t.titulo like '%".strip_tags(trim($_POST['search']))."%')";
	}

	$filtro_palavra = "";

	if($palavra != '' && @$palavra != 0){
		$filtro_palavra = " AND t.tag like '%".$palavra."%'";
	}

	$filtro_categoria = "";
	if($categ != '' && $categ != 0){
		$filtro_categoria = " AND c.id = $categ";
	}

	$filtro_autor = "";
	if($aut != '' && $aut != 0){
		$filtro_autor = " AND a.id = $aut";
	}

	$sql_paginacao = " LIMIT $inicio, $maximo";

	$sql_blog = "SELECT t.*, a.titulo as autor, c.titulo as categoria FROM $tabela t INNER JOIN tbautor a ON a.id = t.autor_id INNER JOIN tbcategoria c ON c.id = t.categoria_id WHERE t.status = 1 AND t.tela_id = $tela $filtro_categoria $filtro_autor $filtro_busca $filtro_palavra ORDER BY t.data DESC";

	$resultado_blog = $conecta->selecionar($conecta->conn, $sql_blog.$sql_paginacao);
	$resultado_total = $conecta->selecionar($conecta->conn, $sql_blog);

	$tags = "";
	while($rs_tag = mysqli_fetch_array($resultado_total)){
		$tags .= $rs_tag['tag'].",";
	}
?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Blog</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Blog</li>
		</ul><!-- /.breadcrumb -->
		<!-- /Breadcrumbs -->
	</div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

	<div class="content-area content content_corpo">
        <section class="page-section with-sidebar sidebar-left">
            <div class="container">
                <div class="row">

					<?php include "sidebar.php"; ?>

                    <!-- Content -->
                    <div class="col-sm-8 content">

                        <?php while($rs_blog = mysqli_fetch_array($resultado_blog)){
							$sql_qtde_comentarios = "SELECT COUNT(*) as qtde FROM tbcomentario WHERE pai_id = ".$rs_blog['id']." AND tabela = '$tabela' AND status = 1";
							$resultado_qtde_comentarios = $conecta->selecionar($conecta->conn,$sql_qtde_comentarios);
							$rs_qtde_comentarios = mysqli_fetch_array($resultado_qtde_comentarios);

						?>
                        <article class="post-wrap no-border" style="background:<?php echo $rs_configuracao['cor_fundo_blog'];?> !important;">
                            <div class="post-media">
                                <div class="thumbnail do-hover" style="padding:0;">
                                    <img style="max-width:100%; margin:0; border-radius:0;" src="<?php echo $rs_blog['arquivo'];?>" alt=""/>
                                    <div class="caption">
                                        <div class="caption-wrapper div-table" style="height: 100%;">
                                            <div class="caption-inner div-cell">
                                                <p class="caption-buttons">
                                                    <a href="<?php echo $rs_blog['arquivo'];?>" class="btn caption-zoom" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
                                                    <a href="<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_blog['id'];?>" class="btn caption-link"><i class="fa fa-link"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-header">
                                <div class="post-header">
                                    <div class="post-meta">
                                        <span class="post-date"><i class="fa fa-clock-o"></i> <span class="month"><?php echo $meses[(int)substr($rs_blog['data'],5,2)];?></span> <span class="day"><?php echo (int)substr($rs_blog['data'],8,2);?></span>, <span class="year"><?php echo substr($rs_blog['data'],0,4);?></span></span> <span class="post-author"><i class="fa fa-user"></i> <a href="<?php echo $siteUrl?>/blog/<?php echo $tela;?>/<?php echo $pag;?>/0/<?php echo $categ;?>/<?php echo $rs_blog['autor_id'];?>"><?php echo $rs_blog['autor'];?></a></span> <span class="post-comment"><i class="fa fa-comment"></i> <a><?php echo $rs_qtde_comentarios['qtde'];?> comentários</a></span>
                                    </div>
									<div class="post-meta">
										<span class="post-category"><a href="<?php echo $siteUrl?>/blog/<?php echo $tela;?>/<?php echo $pag;?>/0/<?php echo $rs_blog['categoria_id'];?>/<?php echo $aut;?>"><?php echo $rs_blog['categoria'];?></a></span>
									</div>
                                </div>
                                <h2 class="post-title" style="font-size:30px !important; color:<?php echo $rs_configuracao['cor_titulo_blog'];?> !important;"><a href="<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_blog['id'];?>" style="color:<?php echo $rs_configuracao['cor_titulo_blog'];?> !important;"><?php echo convertem($rs_blog['titulo'],1);?></a></h2>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt"><?php echo limita_caracteres($rs_blog['conteudo'], 500, false);?></div>
                            </div>
                            <div class="post-footer">
                                <span class="post-readmore"><a href="<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_blog['id'];?>" class="btn btn-dark">Continue lendo &rarr;</a></span>
                            </div>
                        </article><!-- /.post-wrap -->
						<?php } ?>


                        <?php include "paginacao.php"; ?>

                    </div><!-- /.content -->
                    <!-- /Content -->


                </div>
            </div>
        </section>
