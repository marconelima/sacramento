<?php
	$sql_download = "SELECT * FROM tbdownload WHERE status = 1 ORDER BY titulo ASC";
	$resultado_download = $conecta->selecionar($conecta->conn, $sql_download);
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

	<!-- About Us -->
	<section class="page-section">
		<div class="container">
			<table id="download_table">
				<tr id="header" class="download_item odd_line">
					<td>Tipo</td>
					<td>Descrição</td>
					<td>Download</td>
				</tr>
				<?php $marcacao = "odd_line";
					while($rs_download = mysqli_fetch_array($resultado_download)){

					if(@$marcacao == ""){
						$marcacao = "odd_line";
					} else {
						$marcacao = "";
					}

					$var1 = explode('.', $rs_download['documento']);
					$var2 = end($var1);
					$extensao = strtolower($var2);

				?>
				<tr class="download_item <?php echo $marcacao;?>">
					<td><img src="<?php echo $siteUrl;?>assets/img/<?php echo $tipDoc[$extensao];?>" alt=""></td>
					<td><?php echo $rs_download['titulo'];?></td>
					<td>
					<?php
					$documento = $rs_download['documento'];
					$file = pathinfo($documento);
					$extensao = $file['extension'];
					$extensoes = array('jpg', 'jpeg', 'gif', 'png');

					$posicao = substr($file['dirname'],strlen($siteUrl));
					?>
					<a href="../download_geral.php?arquivo=<?php echo $posicao."/".$file['filename'].".".$file['extension']; ?>" target="_blank" >Baixar</a>

				</tr>
				<?php } ?>
			</table>
		</div>
	</section>
	<!-- /About Us -->
