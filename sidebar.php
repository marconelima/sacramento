<?php

	$sql_categoria = "SELECT DISTINCT c.* FROM tbcategoria c INNER JOIN tbgrupo_noticia n ON n.categoria_id = c.id WHERE n.status = 1";
	$resultado_categoria = $conecta->selecionar($conecta->conn, $sql_categoria);
?>

<!-- Sidebar -->
<div class="col-sm-4 sidebar" id="sidebar" style="background:<?php echo $rs_configuracao['fundo_menu_lateral_blog'];?> !important;">

    <div class="widget">
        <form method="post" action="<?php echo $siteUrl;?>blog/<?php echo $tela?>">
            <div class="form-group">
                <input type="text" placeholder="Pesquise no blog... " class="form-control" name="search" title="search">
                <button class="btn bg-light-blue btn-search" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div><!-- /.widget -->

    <div class="widget">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#categories" data-toggle="tab">Categorias</a></li>
            <li><a href="#tweets" data-toggle="tab">Twees recentes</a></li>
        </ul>
        <div class="tab-content" style="background-color:white;">
            <div class="tab-pane fade in active" id="categories">
                <ul class="categories">
                	<?php while($rs_categoria = mysqli_fetch_array($resultado_categoria)){?>
                    <li><a href="<?php echo $siteUrl;?>blog/<?php echo $tela?>/0/0/<?php echo $rs_categoria['id'];?>" <?php if($rs_categoria['id'] == @$categ) { echo "style='padding-left: 10px !important; background-color: ".$rs_configuracao['cor_hover_menu_lateral']." !important; color: ".$rs_configuracao['cor_subcategoria_sidebar_prod']." !important; text-decoration: none !important; float:left; width:100%;'"; } ?>><?php echo $rs_categoria['titulo'];?></a></li>
                    <?php } ?>
                </ul>

            </div>
            <div class="tab-pane fade" id="tweets">
                <div class="recent-tweets">

<a class="twitter-timeline" href="https://twitter.com/@mercadaodacarnebh" data-widget-id="" width="318"
  height="350">Tweets de @mercadaodacarnebh</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                </div>
            </div>
        </div>
    </div><!-- /.widget -->

    <div class="widget">
        <div class="block-title"><h4>Tags</h4></div>
        <ul class="tagcloud">
        	<!--title="12 topics"-->
            <li></li>
                    </ul>
    </div><!-- /.widget -->

    <div class="widget">
        <div class="block-title"><h4>Publicações recentes</h4></div>
        <?php $i = 0;
		$sql_recente = "SELECT t.* FROM $tabela t WHERE t.status = 1 AND t.tela_id = $tela ORDER BY t.data DESC LIMIT 0,4";
		$resultado_recente = $conecta->selecionar($conecta->conn,$sql_recente);
		while($rs_recente = mysqli_fetch_array($resultado_recente)){?>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="<?php echo $rs_recente['arquivo'];?>" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="<?php echo $siteUrl;?>post/<?php echo $tela;?>/0/<?php echo $rs_recente['id'];?>"><?php echo convertem($rs_recente['titulo'],1);?></a></h4>
                <p class="post-date"><i class="fa fa-calendar"></i> a cerca de <?php echo calculatempo($rs_recente['data']);?> atrás</p>
            </div>
        </div>
		<?php $i++; } ?>

    </div><!-- /.widget -->

    <div class="banner-sidebar">
        <ul class="banner-full">
        	<?php
				$sql_banner_sidebar = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 8 ORDER BY rand()";
				$resultado_banner_sidebar = $conecta->selecionar($conecta->conn,$sql_banner_sidebar);
				while($rs_banner_sidebar = mysqli_fetch_array($resultado_banner_sidebar)){
			?>
            	<li style="margin-bottom: 15%;"><a href="<?php echo $rs_banner_sidebar['link']?>" target="_blank" style="float: left; width: 350px; text-align: center; height: auto;"><img class="banner" src="<?php echo $rs_banner_sidebar['arquivo']?>" border="0" alt="" style="margin: 15px 50px; float: left;"/></a></li>
            <?php }?>
        </ul>
    </div>

	<div style="width:100%; height:20px; float:left;"></div>

</div><!-- /.sidebar -->
<!-- /Sidebar -->
