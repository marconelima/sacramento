<?php
	$sql_link = "SELECT * FROM tblink WHERE status = 1 ORDER BY titulo ASC";
	$resultado_link = $conecta->selecionar($conecta->conn, $sql_link);
?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Links</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Institucional</li>
			<li class="active">Links</li>
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

	<!-- Links -->
	<section class="page-section no-top-padding">
		<div class="container">
			<ul id="link-list" style="list-style: initial;">
				<?php while($rs_link = mysqli_fetch_array($resultado_link)){?>
				<li class="link-iten"><a href="<?php echo $rs_link['conteudo'];?>" target="_blank"><?php echo $rs_link['titulo'];?></a></li>
				<?php } ?>
			</ul>
		</div>
	</section>
	<!-- /Links -->
