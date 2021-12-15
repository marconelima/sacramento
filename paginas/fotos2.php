<?php
    $filtro_categoria = "";
    if($categ != ''){
        $filtro_categoria = " AND g.categoria_id = ".$categ;
    }

    $sql = "SELECT f.foto, f.legenda, g.titulo, g.conteudo FROM tbgaleria g INNER JOIN tbfoto f ON f.galeria_id = g.id WHERE g.status = 1 $filtro_categoria ORDER BY g.id DESC";
    $resultado = $conecta->selecionar($conecta->conn, $sql);

    $sql_categoria = "SELECT * FROM tbcategoria WHERE status = 1 AND tela_id = $tela ORDER BY titulo ASC";
    $resultado_categoria = $conecta->selecionar($conecta->conn, $sql_categoria);
?>


<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Fotos</h2>
        <!-- Breadcrumbs 
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl;?>">Home</a></li>
            <li class="active">Galerias</li>
            <li class="active">Fotos</li>
        </ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<span id="top_shadow"></span>

<!-- Content area-->
<div class="content-area content content_corpo">


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

            <?php while($rs = mysqli_fetch_array($resultado)) { ?>
            <div class="grid_4 panties gallery_iten">
                    <div class="box">
                        <a href="<?php echo $siteUrl2."source/Galeria/".$rs['foto'];?>" class="gall_item"><img height="207" src="<?php echo $siteUrl2."source/Galeria/".$rs['foto'];?>" alt="<?php echo $rs['legenda'];?>" title="<?php echo $rs['legenda'];?>"><span></span></a>
                        <div class="box_bot">
                            <div class="box_bot_title"><?php echo $rs['titulo'];?></div>
                            <?php echo $rs['conteudo'];?>
                        </div>
                    </div>
            </div>
            <?php } ?>

        </div>
    </div>
</section>
