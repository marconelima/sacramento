<?php
	$sql_quem = "SELECT * FROM tbgrupo_conteudo WHERE status = 1 AND tela_id = 9";
	$resultado_quem = $conecta->selecionar($conecta->conn, $sql_quem);
	$rs_quem = mysqli_fetch_array($resultado_quem);

	$sql_linha = "SELECT * FROM tblinha WHERE status = 1";
	$resultado_linha = $conecta->selecionar($conecta->conn, $sql_linha);
	$qtde_linha = mysqli_num_rows($resultado_linha);
	$resultado_linha = $conecta->selecionar($conecta->conn, $sql_linha);

	$sql_depoimento = "SELECT * FROM tbdepoimento WHERE status = 1";
	$resultado_depoimento = $conecta->selecionar($conecta->conn, $sql_depoimento);
	$qtde_depoimento = mysqli_num_rows($resultado_depoimento);
	$resultado_depoimento = $conecta->selecionar($conecta->conn, $sql_depoimento);


?>

<style>
img {max-width:98%; margin:0 1%; height:auto;  }
</style>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title"><?php echo $rs_quem['titulo'];?></h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Empresa</li>
			<li class="active">Quem somos</li>
		</ul><!-- /.breadcrumb -->
		<!-- /Breadcrumbs -->
	</div>
</section>

<img src="/imagens/aempresa.png" border="0" style="width:100% !important; max-width:100% !important; margin:0;" />
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<!-- Content area-->
<div class="content-area content" style="margin-top:20px;">

	<section class="page-section">
		<div class="container">
			<p><?php echo stripslashes($rs_quem['conteudo']);?></p>
		</div>
	</section>

