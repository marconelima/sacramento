<?php
$sql_categoria = "SELECT DISTINCT c.* FROM tbprod_categoria c INNER JOIN tbprod_subcategoria sc ON sc.categoria_id = c.id
						INNER JOIN tbproduto p ON p.subcategoria_id = sc.id
						WHERE p.status = 1 ORDER BY c.ordem ASC, c.titulo ASC";
$resultado_categoria = $conecta->selecionar($conecta->conn, $sql_categoria);

$filtro_marcas_lateral = '';

if (count($arr_marcas) > 0) {
    $filtro_opcoes_marca = implode(",", $arr_marcas);

    $filtro_marcas_lateral = ' AND m.id in (' . $filtro_opcoes_marca . ')';
}
//" . $filtro_marcas_lateral . "
$sql_marca = "select DISTINCT m.* FROM tbprod_marca m INNER JOIN tbproduto p ON p.marca = m.id WHERE 1 = 1 ORDER BY m.titulo ASC";

$sql_tag = "";
?>
<!-- Sidebar -->
<div class="col-12 sidebar" id="sidebar">

    <div class="widget">
        <!--<div style="text-align:center; background-color: <?php echo $rs_configuracao['cor_barra_sidebar_prod']; ?> !important; height: 35px;"><h3 style="color:#FFFFFF; font-weight:bold; padding-top:5px; font-size: 24px;">CATEGORIAS</h3></div>-->
        <ul class="categories" style="margin-top:0px;">
            <?php while ($rs_categoria =  mysqli_fetch_array($resultado_categoria)) {
                $sql_subcategoria = "SELECT DISTINCT sc.* FROM tbprod_subcategoria sc INNER JOIN tbproduto p ON p.subcategoria_id = sc.id
															WHERE p.status = 1 AND sc.categoria_id = " . $rs_categoria['id'] . " ORDER BY sc.titulo ASC";

                //" . $filtro_marcas_lateral . "
                $sql_subcategoria = "select DISTINCT m.*, sc.titulo as titulosub, sc.id as subcategoria FROM tbprod_marca m INNER JOIN tbproduto p ON p.marca = m.id 
                INNER JOIN tbprod_subcategoria sc ON p.subcategoria_id = sc.id
                WHERE 1 = 1  AND sc.categoria_id = " . $rs_categoria['id'] . " GROUP BY id ORDER BY m.titulo ASC";

                $resultado_subcategoria = $conecta->selecionar($conecta->conn, $sql_subcategoria);
                $qtde_sub = mysqli_num_rows($resultado_subcategoria);




            ?>
                <form action="<?php echo $siteUrl; ?>catalogo/21" name="formFiltro" method="POST" enctype="multipart/form-data" id="formFiltro">
                    <li class="category" style="float: left; height: auto; width:100%;">
                        <?php if ($qtde_sub > 0) { ?>
                            <a style="background-color: <?php echo @$rs_configuracao['cor_barra_sidebar_prod']; ?> !important; color: #FFFFFF; width: 100%; float: left; padding: 2%; font-weight: bold; font-size: 18px; margin-bottom:10px; margin-top: 18px; text-align:center;">
                                <span class="glyphicon glyphicon-chevron-right" style=" background-color: <?php echo @$rs_configuracao['cor_barra_sidebar_prod']; ?> !important; color:#FFFFFF;  text-align:center; margin-top: 8px;" aria-hidden="true"><?php echo convertem($rs_categoria['titulo'], 1); ?></span>
                            </a>
                            <ul class="sub-categories" <?php if (@$categ == $rs_categoria['id']) {
                                                            echo "style='display:block'";
                                                        } ?>>
                                <?php while ($rs_subcategoria = mysqli_fetch_array($resultado_subcategoria)) {
                                    $sql_qtde = "select count(*) as qtde FROM tbproduto WHERE marca = " . $rs_subcategoria['id'];
                                    $resultado_qtde = $conecta->selecionar($conecta->conn, $sql_qtde);
                                    $rs_qtde = mysqli_fetch_array($resultado_qtde);

                                ?>

                                    <a style="float:left; width:100%; height:auto; margin-top:2%; white-space: nowrap;"><input type="checkbox" name="filtrox[]" class="btnfiltro" id="id<?php echo $rs_subcategoria['id']; ?>" value="<?php echo $rs_subcategoria['id']; ?>" data-marcado="<?php echo $rs_subcategoria['id'] . "_" . $rs_subcategoria['subcategoria']; ?>" <?php if (in_array($rs_subcategoria['id'], $fornecedores)) {
                                                                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                                                                        } ?>>&nbsp;<label style="cursor:pointer;" for="id<?php echo $rs_subcategoria['id']; ?>"><?php echo $rs_subcategoria['titulo']; ?>(<?php echo $rs_qtde['qtde']; ?>)</label> </a>
                                    <!--    <li class=" sub-category">
                                            <a <?php if ($subcateg == $rs_subcategoria['id']) {
                                                    echo "style='padding-left: 10px !important; background:" . @$rs_configuracao['cor_hover_menu_lateral'] . " !important; color: " . @$rs_configuracao['cor_subcategoria_sidebar_prod'] . " !important; text-decoration: none !important;'";
                                                } ?> href="<?php echo $siteUrl ?>catalogo/21/0/0/<?php echo $rs_categoria['id'] ?>/0/0/0/<?php echo $rs_subcategoria['id']; ?>">
                                                <?php echo $rs_subcategoria['titulo']; ?>
                                            </a>
                    </li>-->
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
                </form>
        </ul>
    </div><!-- /.widget -->

    <?php /* if((@$pagina == 'catalogo' || @$pagina == 'busca') && @$semmarcas != 1){?>

    <div class="side_busca" style="float: left; width: 100%;">
        <div class="widget">

            <form action="" name="formFiltro" method="POST" enctype="multipart/form-data" id="formFiltro">
            <ul class="categories" style="margin-top:10px;">
                <?php
                $resultado_marca = $conecta->selecionar($conecta->conn, $sql_marca);
               
                while ($rs_fornecedor = mysqli_fetch_array($resultado_marca)) {

                    $sql_qtde = "select count(*) as qtde FROM tbproduto WHERE marca = ".$rs_fornecedor['id'];
                    $resultado_qtde = $conecta->selecionar($conecta->conn, $sql_qtde);
                    $rs_qtde = mysqli_fetch_array($resultado_qtde);

                ?>
                    <li class="category">
                        <!--<a <?php if ($fornecedor == $rs_fornecedor['id']) {
                                    echo "style='padding-left: 10px !important; background-color: " . $rs_configuracao['cor_hover_menu_lateral'] . " !important; color: " . $rs_configuracao['cor_subcategoria_sidebar_prod'] . " !important; text-decoration: none !important;'";
                                } ?> href="<?php echo $siteUrl ?>catalogo/21/0/0/0/0/0/0/0/0/0/0/0/0/0/0/<?php echo $rs_fornecedor['id']; ?>">-->

                        <a style="float:left; width:100%; height:auto; margin-top:2%;"><input type="checkbox" name="filtro[]" class="btnfiltro" value="<?php echo $rs_fornecedor['id']; ?>" <?php if(in_array($rs_fornecedor['id'], $fornecedores)) { echo "checked"; } ?> >&nbsp;<?php echo $rs_fornecedor['titulo']; ?>(<?php echo $rs_qtde['qtde'];?>)</a>
                        <!--</a>-->
                    </li>
                <?php } ?>

            </ul>
            </form>
        </div>
        <!-- /.widget -->
    </div>
    <?php } */ ?>

    <!--
    <div class="widget">
        <div class="block-title" style="text-align: center;
    background-color: #cf4529;
    height: 35px;"><h4 style="font-size:20px !important; padding-top: 10px;
    padding-left: 10px;
    color: white;">Montadoras</h4></div>
        <ul class="categories">
            <?php
            /*$sql_montadora = "SELECT distinct m.* FROM tbmontadora m INNER JOIN tbproduto p ON p.montadora_id = m.id ORDER BY m.titulo ASC";
                $resultado_montadora = $conecta->selecionar($conecta->conn, $sql_montadora);
                while($rs_montadora = mysqli_fetch_array($resultado_montadora)){

                    $sql_modelo = "SELECT distinct mo.* FROM tbmodelo mo INNER JOIN tbproduto p ON p.modelo_id = mo.id WHERE mo.montadora_id = ".$rs_montadora['id']." ORDER BY mo.titulo ASC";
                    $resultado_modelo = $conecta->selecionar($conecta->conn, $sql_modelo);
                    $qtde_modelo = mysqli_num_rows($resultado_modelo);
            ?>
            <li class="category" >
                <?php if($qtde_modelo > 0){?>
                <a ><span class="glyphicon glyphicon-chevron-right" style="font-size: 10px; color: #cf4529;" aria-hidden="true"></span> <?php echo convertem($rs_montadora['titulo'],1);?></a>
                <ul class="sub-categories"  <?php if(@$montadora == $rs_montadora['id']) { echo "style='display:block'";}?>>
                    <?php
                    while($rs_modelo = mysqli_fetch_array($resultado_modelo)){

                        $sql_ano = "SELECT distinct a.* FROM tbano a INNER JOIN tbproduto p ON p.ano_id = a.id WHERE a.modelo_id = ".$rs_modelo['id']." ORDER BY a.ano ASC";
                        $resultado_ano = $conecta->selecionar($conecta->conn, $sql_ano);
                        $qtde_ano = mysqli_num_rows($resultado_ano);
                    ?>
                    <?php if($qtde_ano > 0){?>
                        <li class="sub-category1"><a><span class="glyphicon glyphicon-chevron-right" style="font-size: 10px; color: #cf4529;" aria-hidden="true"></span> <?php echo convertem($rs_modelo['titulo'],1);?></a>
                            <ul class="sub-categories2" <?php if(@$modelo == $rs_modelo['id']) { echo "style='display:block'";}?>>
                            <?php
                            while($rs_ano = mysqli_fetch_array($resultado_ano)){

                                $sql_versao = "SELECT distinct v.* FROM tbversao v INNER JOIN tbproduto p ON p.versao_id = v.id WHERE v.ano_id = ".$rs_ano['id']." ORDER BY v.titulo ASC";
                                $resultado_versao = $conecta->selecionar($conecta->conn, $sql_versao);
                                $qtde_versao = mysqli_num_rows($resultado_versao);
                                ?>
                                <?php if($qtde_ano > 0){?>
                                <li class="sub-category2"><a><span class="glyphicon glyphicon-chevron-right" style="font-size: 10px; color: #cf4529;" aria-hidden="true"></span> ano <?php echo $rs_ano['ano'];?></a>
                                    <ul class="sub-categories3" <?php if(@$ano == $rs_ano['id']) { echo "style='display:block'";}?>>
                                        <?php while($rs_versao = mysqli_fetch_array($resultado_versao)){?>
                                        <li class="sub-category3"><a <?php if($versao == $rs_versao['id']) { echo "style='padding-left: 10px !important; background-color: #FBBA0E; color: white !important; text-decoration: none !important;'";} ?> href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/0/0/0/<?php echo $rs_montadora['id'];?>/<?php echo $rs_modelo['id'];?>/<?php echo $rs_ano['id'];?>/<?php echo $rs_versao['id'];?>" ><?php echo convertem($rs_versao['titulo'],1);?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } else { ?>
                                <li class="sub-category2"><a <?php if($ano == $rs_ano['id']) { echo "style='padding-left: 10px !important; background-color: #FBBA0E; color: white !important; text-decoration: none !important;'";} ?> href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/0/0/0/<?php echo $rs_montadora['id'];?>/<?php echo $rs_modelo['id'];?>/<?php echo $rs_ano['id'];?>">ano <?php echo $rs_ano['ano'];?></a>
                                <?php } ?>
                            <?php } ?>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="sub-category"><a <?php if($modelo == $rs_modelo['id']) { echo "style='padding-left: 10px !important; background-color: #FBBA0E; color: white !important; text-decoration: none !important;'";} ?> href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/0/0/0/<?php echo $rs_montadora['id'];?>/<?php echo $rs_modelo['id'];?>" ><?php echo convertem($rs_modelo['titulo'],1);?></a></li>
                    <?php } ?>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <a <?php if($montadora == $rs_montadora['id']) { echo "style='padding-left: 10px !important; background-color: #FBBA0E; color: white !important; text-decoration: none !important;'";} ?> href="<?php echo $siteUrl?>catalogo/21/0/0/0/0/0/0/0/0/0/0/<?php echo $rs_montadora['id'];?>"><?php echo convertem($rs_montadora['titulo'],1);?></a>
                <?php } ?>
            </li>
            <?php } */ ?>
        </ul>
    </div><!-- /.widget -->


    <div class="side_busca">
        <!--
	<div class="widget">
        <a id="search_parts" href="<?php //echo $siteUrl
                                    ?>pecas_avulsas/54"><strong style="font-weight:bold !important;">NÃO ENCONTROU O QUE PROCURA?<br>Faça uma consulta avulsa!</strong> <i class="fa fa-search"></i></a>
    </div>-->


        <!--
    <div class="widget">
        <div class="block-title"><h4>Tags</h4></div>
        <ul class="tagcloud">
            <?php
            $arr_tags = explode(",", @$tags);
            $qtde_tag = count($arr_tags);
            $i = 0;
            while ($i < $qtde_tag) {
                if ($arr_tags[$i] != '') {
            ?><!--title="12 topics"
            <li><a href="<?php echo $siteUrl; ?>catalogo/<?php echo $tela ?>/0/0/0/0/0/<?php echo $arr_tags[$i] ?>" ><?php echo $arr_tags[$i] ?></a></li>
            <?php }
                $i++;
            } ?>
        </ul>
    </div><!-- /.widget -->
    </div>

    <?php if (isset($_SESSION['criar']) && @$_SESSION['qtde'] > 0) { ?>
        <div class="widget" style="float: left; width: 100%; height: auto; margin-top: 20px;">
            <div class="block-title">
                <h4>Lista Orçamento</h4>
            </div>
            <div class="products">
                <?php $carrinhoSessao->listar_cotacao_lateral(); ?>
            </div>
            <div class="text-right" style="margin-bottom: 10px;">
                <div class="btn btn-default viewcart"><a href="<?php echo $siteUrl; ?>carrinho/48">Ver Carrinho</a></div>
            </div>
        </div><!-- /.widget -->
    <?php } ?>

    <div class="side_busca">
        <div class="banner-sidebar">
            <ul class="banner-full">
                <?php
                $sql_banner_sidebar = "SELECT * FROM tbbanner WHERE status = 1 AND posicao = 7 ORDER BY rand()";
                $resultado_banner_sidebar = $conecta->selecionar($conecta->conn, $sql_banner_sidebar);
                while ($rs_banner_sidebar = mysqli_fetch_array($resultado_banner_sidebar)) {
                ?>
                    <li style="margin-bottom: 15%;"><a href="<?php echo $rs_banner_sidebar['link'] ?>" target="_blank" style="float: left; width: 250px; margin-left:5px; text-align: center; height: auto;"><img class="banner" src="<?php echo $rs_banner_sidebar['arquivo'] ?>" border="0" alt="" style="margin: 15px 0px; float: left;" /></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div style="width:100%; height:20px; float:left;"></div>

</div><!-- /.sidebar -->
<!-- /Sidebar -->