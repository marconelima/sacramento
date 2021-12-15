<?php
$sql = "SELECT * FROM tbgrupo_pergunta WHERE tela_id = $tela AND status = 1 ORDER BY titulo ASC";
$resultado = $conecta->selecionar($conecta->conn, $sql);
?>

<?php if($tela == 41){ ?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Perguntas Frequentes</h2>
        <!-- Breadcrumbs -->
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl;?>">Home</a></li>
            <li class="active">Informações Gerais</li>
            <li class="active">Perguntas Frequentes</li>
        </ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<?php } else { ?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Serviços</h2>
        <!-- Breadcrumbs 
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl;?>">Home</a></li>
            <li class="active">Serviços</li>
        </ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<?php } ?>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->
<span id="top_shadow"></span>

<!-- Content area-->
<div class="content-area content content_corpo">

<!-- Accordion/Progress bars -->
<section class="page-section">
    <div class="container">
        <?php if($tela == 41){ ?>
        <h2 class="titulo_secao">Dúvidas Frequentes</h2>
        <?php } else { ?>
        <h2 class="titulo_secao">Serviços</h2>
        <?php } ?>
        <div class="services_list" >
            <?php while($rs = mysqli_fetch_array($resultado)){ ?>
            <div class="service_iten">
                <div class="buttons">
                    <img class="plus" src="<?php echo $siteUrl2;?>assets/img/plus_buttom.jpg" alt=""/>
                    <img class="minus" src="<?php echo $siteUrl2;?>assets/img/minus_buttom.jpg" alt=""/>
                </div>
                <h4 class="service_iten_title"><?php echo $rs['titulo']; ?></h4>
                <p class="service_iten_info"><?php echo str_replace("<p>","",str_replace("</p>","",$rs['conteudo'])); ?></p>
            </div>
            <?php } ?>
        </div>

    </div><!-- /.container -->
</section>
<!-- /Accordion/Progress bars -->
