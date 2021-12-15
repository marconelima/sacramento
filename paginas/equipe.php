<?php
	$sql_funcionario = "SELECT * FROM tbgrupo_equipe WHERE status = 1";
	$resultado_funcionario = $conecta->selecionar($conecta->conn, $sql_funcionario);
?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Equipe</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Empresa</li>
			<li class="active">Equipe</li>
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
				<?php $i = 0; while($rs_funcionario = mysqli_fetch_array($resultado_funcionario)){
					if($i%4 == 0){
						echo "<div style='width:100%; float:left; height:1px;'></div>";
					}
					?>
				<div class="col-md-3 col-sm-4">
					<div class="thumbnail do-hover">
						<div class="overflowed">
							<img src="<?php echo $rs_funcionario['arquivo'];?>" class="img-responsive" alt="">
						</div>
						<div class="block-text" style="padding:70px 10px;">
							<h3 class="block-title text-center"><?php echo $rs_funcionario['titulo'];?> <small><?php echo $rs_funcionario['profissao'];?></small></h3>
						</div>
					</div>
				</div>
				<?php $i++; } ?>
			</div>
		</div>
	</div>
</section>
