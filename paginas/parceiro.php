<?php
	$sql_parceiro = "SELECT * FROM tbparceiro WHERE status = 1 AND tela_id = ".$tela;
	$resultado_parceiro = $conecta->selecionar($conecta->conn, $sql_parceiro);
?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Parceiros</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Empresa</li>
			<li class="active">Parceiros</li>
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
		<div class="col-md-12">
			<div class="row">
				<?php $i = 0; while($rs_parceiro = mysqli_fetch_array($resultado_parceiro)){ ?>
					<div class="col-md-3 col-sm-6 box_parceiros d-flex justify-content-center align-self-center" style="padding-bottom: 15px; padding-top: 15px;">			
						<a href="<?php echo $rs_parceiro['link'];?>" target="_blank"><img src="<?php echo $rs_parceiro['arquivo'];?>" class="img-responsive" alt=""></a>		
					</div>
				<?php $i++; } ?>
			</div>
		</div>
	</div>
</section>
