<?php
//print_r($_POST);
//unset($_SESSION['pecas']);
if(isset($_POST['exclui'])){
	array_splice($_SESSION['pecas'],$_POST['exclui'],1);
} elseif($_POST){
	$arr = $_POST;
	if(@$_SESSION['pecas']){
		array_push($_SESSION['pecas'], $arr);
	} else {
		$_SESSION['pecas'] = array($arr);
	}
}



$tags = "Mercadão da Carne BH, Peças Avulsas";
?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Cotações Avulsas</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Produtos</li>
		</ul><!-- /.breadcrumb -->
		<!-- /Breadcrumbs -->
	</div>
</section>
<!-- /Header and Breadcrumbs  -->

<link href="<?php echo $siteUrl2;?>assets/plugins/gallery.css" rel="stylesheet">

</header><!-- /.header -->
<!-- /Header -->

<div class="content-area content content_corpo">

<section class="page-section with-sidebar sidebar-right no-top-padding" id="pecas_avulsas_section">
        <div class="container">
            <!-- Content -->
            <div class="col-sm-12 content shop">
					<div class="row">
					<p>Relacione as produtos para consulta <span>(Preencha os campos necessários, por favor)</span></p>
					<form class="af-form row" id="af-form" action="" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<th class="col-sm-4"></th>
								<th class="col-sm-1" style="font-size: 12px;">Quantidade</th>
								<th class="col-sm-1" style="font-size: 12px;">Unidade</th>
								<th class="col-sm-5" style="font-size: 12px;">Observações sobre o produto</th>
								<th class="col-sm-1"></th>
							</tr>
							<tr>
								<td class="col-sm-4 af-outer af-required">
									<div class="form-group af-inner">
										<input type="text" name="name" id="name" size="30" value="" placeholder="Descrição do produto *" class="form-control placeholder" />
										<label class="error" for="name" id="name_error">Campo Obrigatório.</label>
									</div>
								</td>
								<td class="col-sm-1 af-outer af-required" style="text-align: center;">
									<div class="form-group af-inner">
										<input type="text" name="quantity" class="quantity" value="1" size="3" style="text-align:center;"/>
										<label class="error" for="name" id="name_error">Campo Obrigatório.</label>
									</div>
								</td>
								<td class="col-sm-1 af-outer af-required" style="text-align: center;">
									<div class="form-group af-inner">
										<select name="kilo_grama"  >
											<option value="">Unidade</option>
											<option value="kilos">Kilos</option>
											<option value="gramas">Gramas</option>
										</select>
									</div>
								</div>
								<td class="col-sm-5 af-outer">
									<div class="form-group af-inner">
										<textarea name="message" id="input-message" rows="3" placeholder="Digite sua mensagem" class="placeholder"></textarea>
									</div>
								</td>

								<td class="col-sm-1 af-outer">
									<div class="form-group af-inner">
										<button type="submit" class="save-item">Salvar Item</button>
									</div>
								</td>
							</tr>
						</table>
					</form>
				</div>

                <?php if(isset($_SESSION['pecas'])){?>
				<div class="row">
					<table>
						<tr>
							<th class="col-sm-5" >Descrição do Produto Solicitado</th>
							<th class="col-sm-1">Quantidade</th>
							<th class="col-sm-1">Unidade</th>
							<th class="col-sm-4">Observações</th>
							<th class="col-sm-1">Excluir</th>
						</tr>
						<?php $i = 0; foreach(@$_SESSION['pecas'] as $peca){ ?>
						<tr>
							<td class="col-sm-5"><?php echo $peca['name'];?></td>
							<td class="col-sm-1"><?php echo $peca['quantity'];?></td>
							<td class="col-sm-1"><?php echo $peca['kilo_grama'];?></td>
							<td class="col-sm-4">
								<?php echo $peca['message'];?>
							</td>
							<td class="col-sm-1">
                            <form method="post" name="form_exclui" enctype="multipart/form-data" action="" >
								<button class="delete-iten">

                                    <input type="hidden" name="exclui" value="<?php echo $i;?>" />
									<input type="image" src="<?php echo $siteUrl."assets/img/x_mark_red.jpg";?>" onclick="document.form_exclui.submit()" name="btn_exclui"  alt="" style="width:20px !important;"/>

								</button>
                            </form>
							</td>
						</tr>
                        <?php $i++; } ?>

					</table>
				</div>

				<div class="row">
					<a class="send_request" href="<?php echo $siteUrl;?>finalizar_avulso/54">Enviar Orçamento</a>
				</div>
				<?php } ?>
            </div>
        </div>
</section>
        <!-- /Peças avulsas para consulta -->
