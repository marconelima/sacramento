<?php
	$sql_quem = "SELECT * FROM tbgrupo_conteudo WHERE status = 1 AND tela_id = 62";
	$resultado_quem = $conecta->selecionar($conecta->conn, $sql_quem);
	$rs_quem = mysqli_fetch_array($resultado_quem);

?>


<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs" >
	<div class="container">
		<h2 class="section-title"><?php echo $rs_quem['titulo'];?></h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Empresa</li>
			<li class="active">Infra-estrutura</li>
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

<section class="page-section">
	<div class="container">
		<p><?php echo stripslashes($rs_quem['conteudo']);?></p>
	</div>
</section>
