<?php
	$filtro_vw = "";
	$tabela = "tbgrupo_noticia";
	if($vw != '' && $vw != 0){
		$filtro_vw = " AND t.id = $vw";
	}
	$sql_post = "SELECT t.*, a.titulo as autor, a.arquivo as fotoautor, a.conteudo as dadosautor, c.titulo as categoria, t.documento FROM $tabela t INNER JOIN tbautor a ON a.id = t.autor_id INNER JOIN tbcategoria c ON c.id = t.categoria_id WHERE t.status = 1 AND t.tela_id = $tela $filtro_vw";
	$resultado_post = $conecta->selecionar($conecta->conn,$sql_post);
	$rs_post = mysqli_fetch_array($resultado_post);

	$sql_comentario = "SELECT * FROM tbcomentario WHERE status = 1 AND tabela = '$tabela' AND pai_id = $vw AND comentario_pai = 0 ORDER BY data DESC";
	$resultado_comentario = $conecta->selecionar($conecta->conn, $sql_comentario);
	$qtde_comentarios = mysqli_num_rows($resultado_comentario);

	$tags = "";
	while($rs_tag = mysqli_fetch_array($resultado_post)){
		$tags .= $rs_tag['tag'].",";
	}
	$tags .= "Mercadão da Carne BH";
?>
<script>
$(document).ready(function() {


	<?php $i = 1; while($rs_comentario = mysqli_fetch_array($resultado_comentario)){?>
	$("#comentario_filho<?php echo $i;?>").click(function(){

		$("#status_comentario<?php echo $i;?>").html('<img src="<?php echo $siteUrl;?>assets/img/carregando.gif" id="loader" />').fadeIn(300);
//início ajax jquery
		var nome = $("#nome<?php echo $i;?>").val();
		var email = $("#email<?php echo $i;?>").val();
		var cidade = $("#cidade<?php echo $i;?>").val();
		var message = $("#message<?php echo $i;?>").val();
		var pai = $("#pai<?php echo $i;?>").val();
		var tabela = $("#tabela<?php echo $i;?>").val();
		var vw = $("#vw<?php echo $i;?>").val();

		if(nome == ""){
			$("#status_comentario<?php echo $i;?>").fadeOut('slow');
			$("#status_comentario<?php echo $i;?>").hide();
			$("#status_comentario<?php echo $i;?>").html("<div class='alert alert-danger'>Preencha o Nome!</div>").fadeIn(300);
		} else if(email == ""){
			$("#status_comentario<?php echo $i;?>").fadeOut('slow');
			$("#status_comentario<?php echo $i;?>").hide();
			$("#status_comentario<?php echo $i;?>").html("<div class='alert alert-danger'>Preencha o E-mail!</div>").fadeIn(300);
		} else if(cidade == ""){
			$("#status_comentario<?php echo $i;?>").fadeOut('slow');
			$("#status_comentario<?php echo $i;?>").hide();
			$("#status_comentario<?php echo $i;?>").html("<div class='alert alert-danger'>Preencha a Cidade!</div>").fadeIn(300);
		} else if(message == ""){
			$("#status_comentario<?php echo $i;?>").fadeOut('slow');
			$("#status_comentario<?php echo $i;?>").hide();
			$("#status_comentario<?php echo $i;?>").html("<div class='alert alert-danger'>Preencha o Comentário!</div>").fadeIn(300);
		} else {
			var dados = Array();

			dados.push(nome);
			dados.push(email);
			dados.push(cidade);
			dados.push(message);
			dados.push(pai);
			dados.push(vw);
			dados.push(tabela);


			$.ajax({
				type: 'POST',
				url: '<?php echo $siteUrl;?>paginas/comentar.php',
				cache: false,
				data: 'acao=getComenta&&dados='+dados,
				success: function(formulario) {
					$("#status_comentario<?php echo $i;?>").fadeOut('slow');
					$("#status_comentario<?php echo $i;?>").hide();
					$("#status_comentario<?php echo $i;?>").html(formulario).show().fadeIn('slow');

					$("#nome<?php echo $i;?>").val("");
					$("#email<?php echo $i;?>").val("");
					$("#cidade<?php echo $i;?>").val("");
					$("#message<?php echo $i;?>").val("");
				}
			});
		}
	});
	<?php $i++; } ?>
	$("#comentario_principal").click(function(){

		$("#status_comentario").html('<img src="<?php echo $siteUrl;?>assets/img/carregando.gif" id="loader" />').fadeIn(300);
//início ajax jquery
		var nome = $("#nome").val();
		var email = $("#email").val();
		var cidade = $("#cidade").val();
		var message = $("#message").val();
		var pai = $("#pai").val();
		var tabela = $("#tabela").val();
		var vw = $("#vw").val();

		if(nome == ""){
			$("#status_comentario").fadeOut('slow');
			$("#status_comentario").hide();
			$("#status_comentario").html("<div class='alert alert-danger'>Preencha o Nome!</div>").fadeIn(300);
		} else if(email == ""){
			$("#status_comentario").fadeOut('slow');
			$("#status_comentario").hide();
			$("#status_comentario").html("<div class='alert alert-danger'>Preencha o E-mail!</div>").fadeIn(300);
		} else if(cidade == ""){
			$("#status_comentario").fadeOut('slow');
			$("#status_comentario").hide();
			$("#status_comentario").html("<div class='alert alert-danger'>Preencha a Cidade!</div>").fadeIn(300);
		} else if(message == ""){
			$("#status_comentario").fadeOut('slow');
			$("#status_comentario").hide();
			$("#status_comentario").html("<div class='alert alert-danger'>Preencha o Comentário!</div>").fadeIn(300);
		} else {
			var dados = Array();

			dados.push(nome);
			dados.push(email);
			dados.push(cidade);
			dados.push(message);
			dados.push(pai);
			dados.push(vw);
			dados.push(tabela);


			$.ajax({
				type: 'POST',
				url: '<?php echo $siteUrl;?>paginas/comentar.php',
				cache: false,
				data: 'acao=getComenta&&dados='+dados,
				success: function(formulario) {
					$("#status_comentario").fadeOut('slow');
					$("#status_comentario").hide();
					$("#status_comentario").html(formulario).show().fadeIn('slow');

					$("#nome").val("");
					$("#email").val("");
					$("#cidade").val("");
					$("#message").val("");
				}
			});
		}
	});



	$('#deixarComentario').click(function(){
		$('#telaComentario').slideToggle();
	});



});
</script>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Blog</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Blog</li>
			<li class="active"><?php echo $rs_post['titulo'];?></li>
		</ul><!-- /.breadcrumb -->
		<!-- /Breadcrumbs -->
	</div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

	<div class="content-area content content_corpo">
		<section class="page-section with-sidebar sidebar-left no-top-padding">
            <div class="container">
                <div class="row">

					<?php include "sidebar.php";?>

                    <!-- Content -->
                    <div class="col-sm-8 content">

                        <article class="post-wrap no-border">
                            <div class="post-media">
                                <div class="thumbnail do-hover" style="padding:0;">
                                    <img  style="max-width:100%; margin:0; border-radius:0;" src="<?php echo $rs_post['arquivo'];?>" alt="<?php echo $rs_post['arquivo'];?>"/>
                                    <div class="caption">
                                        <div class="caption-wrapper div-table" style="height: 100% !important;">
                                            <div class="caption-inner div-cell">
                                                <p class="caption-buttons">
                                                    <a href="<?php echo $rs_post['arquivo'];?>" class="btn caption-zoom theone" data-gal="prettyPhoto"><i class="fa fa-link"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-header">
                                <div class="post-meta">
                                    <span class="post-date"><i class="fa fa-clock-o"></i> <span class="month"><?php echo $meses[(int)substr($rs_post['data'],5,2)];?></span> <span class="day"><?php echo (int)substr($rs_post['data'],8,2);?></span>, <span class="year"><?php echo substr($rs_post['data'],0,4);?></span></span> <span class="sep"></span> <span class="post-author"><i class="fa fa-user"></i> <a href="<?php echo $siteUrl?>/blog/<?php echo $tela;?>/<?php echo $pag;?>/0/<?php echo $categ;?>/<?php echo $rs_post['autor_id'];?>"><?php echo $rs_post['autor'];?></a></span> <span class="sep"></span> <span class="post-comment"><i class="fa fa-comment"></i> <a><?php echo $qtde_comentarios;?> comentários</a></span>
                                </div>
								<div class="post-meta">
									<span class="post-category"><a href="<?php echo $siteUrl?>/blog/<?php echo $tela;?>/<?php echo $pag;?>/0/<?php echo $rs_post['categoria_id'];?>/<?php echo $aut;?>"><?php echo $rs_post['categoria'];?></a></span>
								</div>
                                <h2 class="post-title" style="font-size:30px; text-transform:uppercase; color:<?php echo $rs_configuracao['cor_titulo_blog'];?> !important;"><?php echo $rs_post['titulo'];?></h2>
                            </div>
                            <div class="post-body">

                                <p><?php echo stripslashes($rs_post['conteudo']);?></p>

                            </div>

                            <?php if(@$rs_post['documento'] != '') {
								$documento = $rs_post['documento'];
								?>
                            <div class="post-body">
                                    <?php
                                        $file = pathinfo($documento);
                                        $extensao = $file['extension'];
                                        $extensoes = array('jpg', 'jpeg', 'gif', 'png');

                                        $posicao = substr($file['dirname'],strlen($dados['linkloja'])+1);

                                        if(array_search($extensao, $extensoes) === false){?>
                                            <a href="<?php echo $documento; ?>" target="_blank" ><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;<?php echo"Download Documento"; ?></button></a>
                                        <?php } else { ?>
                                            <a href="download_imagem.php?arquivo=<?php echo $posicao."/".$file['filename'].".".$file['extension']; ?>" target="_blank" ><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;<?php echo "Download Documento"; ?></button></a>
                                        <?php } ?>
                            </div>
                            <?php } ?>

                            <div class="post-footer clearfix">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <ul class="list-inline socical-line">
                                            <li><a class="bg-red" href="http://www.facebook.com/share.php?u=<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_post['id'];?>&t=<?php echo $rs_post['titulo'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li><li>
                                            <a class="bg-orange" href="http://twitter.com/share?text=<?php echo $rs_post['titulo'];?>&url=<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_post['id'];?>&counturl=<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_post['id'];?>&via=USUARIO" target="_blank"><i class="fa fa-twitter"></i></a></li><li>
                                            <a class="bg-yellow" href="https://plus.google.com/share?url=<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_post['id'];?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><li>
                                            <a class="bg-light-blue" href="http://pinterest.com/pin/create/button/?url=<?php echo $siteUrl?>post/<?php echo $tela;?>/<?php echo $pag;?>/<?php echo $rs_post['id'];?>&media=<?php $rs_post['arquivo'];?>&description=<?php echo $rs_post['titulo'];?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article><!-- /.post-wrap -->

                        <!-- About the author -->
                        <div class="about-the-author clearfix">
                            <div class="media">
                                <img class="media-object pull-left" src="<?php echo $rs_post['fotoautor'];?>" alt="">
                                <div class="media-body">
                                    <h4 class="media-heading">Postado por <a href="<?php echo $siteUrl?>/blog/<?php echo $tela;?>/<?php echo $pag;?>/0/<?php echo $categ;?>/<?php echo $rs_post['autor_id'];?>"><?php echo $rs_post['autor'];?></a></h4>
                                    <p><?php echo $rs_post['dadosautor'];?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /About the author -->


						<!-- /Product Description -->
						<div class="page-section" style="margin-top: 40px; padding-bottom: 0; background: #fff; padding: 10px;">
								<div class="container" style="padding:0;">
										<div class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="0">
												<h5 class="section-title home-title" style="margin-bottom:20px; color:#000000;">COMENTÁRIOS</h5>
										</div>
								</div>
								<?php if($qtde_comentarios > 0) { ?>
										<div id="comments" class="comments-area">
												<?php if($qtde_comentarios == 1){?>
														<h2 class="comments-title" style="color:black !important; font-size:30px; margin: 0;"><?php echo $qtde_comentarios;?> Comentário</h2>
												<?php } else { ?>
														<h2 class="comments-title" style="color:black !important; font-size:30px; margin: 0;"><?php echo $qtde_comentarios;?> Comentários</h2>
												<?php } ?>
												<?php $i = 1;
												$resultado_comentario = $conecta->selecionar($conecta->conn, $sql_comentario);
												while($rs_comentario = mysqli_fetch_array($resultado_comentario)){
												?>
														<ol class="comment-list">
															<li class="comment even thread-even depth-1">
																<div class="comment-body"  style="background:<?php echo $rs_configuracao['fundo_comentario'];?>">
																	<div class="comment-author vcard">
																		<img style="float:left; margin:5px 10px 0 0;" alt='' src='http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=74&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=148&amp;d=mm&amp;r=g 2x' class='avatar avatar-74 photo' />
																		<cite class="fn"><?php echo $rs_comentario['nome'];?> <b style="font-weight:normal;">(<?php echo $rs_comentario['cidade'];?>)</b></cite>
																		<span class="says">disse:</span>
																		<div class="comment-meta commentmetadata"><a href="#"><?php echo substr($rs_comentario['data'],8,2)." de ".$meses[(int)substr($rs_comentario['data'],5,2)].", ".substr($rs_comentario['data'],0,4);?></a></div>
																		<div class="row lead">
																			<div id="stars" class="starrr"></div><!-- Avaliou com <span id="count">0</span> estrela(s) -->
																		</div>
																	</div>
																	<p><?php echo $rs_comentario['comentario'];?></p>
																	<div class="reply-link"><a class='comment-reply-link' href='javascript:void(0)' aria-label='Responder para Teste'>Responder</a></div>
																	<div class="reply" style="padding: 10px 0;">
																		<div class="block-title"><span class="comment-date"><?php echo $rs_configuracao['nomeloja'];?> <?php echo str_replace("<p>","",str_replace("</p>","",$rs_configuracao['texto_comentario']));?></span></div>
																		<div class="block-title"><span class="comment-date">O seu endereço de e-mail não será publicado.</span></div>
																		<div id="status_comentario<?php echo $i;?>"></div>

																		<form method="post" action="#" name="comments-form" id="comments-form">
																			<input type="hidden" name="pai<?php echo $i;?>" id="pai<?php echo $i;?>" value="<?php echo $rs_comentario['id'];?>" />
																			<input type="hidden" name="tabela<?php echo $i;?>" id="tabela<?php echo $i;?>" value="<?php echo $tabela;?>" />
																			<input type="hidden" name="vw<?php echo $i;?>" id="vw<?php echo $i;?>" value="<?php echo $vw;?>" />
																			<div class="row">
																				<div class="form-group col-sm-6">
																					<input type="text" placeholder="Nome" class="form-control" title="comments-form-name" name="nome<?php echo $i;?>" id="nome<?php echo $i;?>" required="required" value="" >
																				</div>


																				<div class="form-group col-sm-6">
																					<input type="text" placeholder="E-mail (seu e-mail não será divulgado)" class="form-control" title="comments-form-email" name="email<?php echo $i;?>" id="email<?php echo $i;?>" required="required">
																				</div>

																				<div class="form-group col-sm-12">
																					<input type="text" placeholder="Cidade/Estado" class="form-control" title="comments-form-website" name="cidade<?php echo $i;?>" id="cidade<?php echo $i;?>" required="required">
																				</div>
																			</div>
																			<div class="form-group">
																				<textarea placeholder="Digite Sua Mensagem ..." class="form-control" title="comments-form-comments" name="message<?php echo $i;?>" id="message<?php echo $i;?>" rows="6" required="required"></textarea>
																			</div>

																			<div class="form-group">
																				<input type="button" class="btn btn-default" id="comentario_filho<?php echo $i;?>" value="Enviar Comentário">
																			</div>

																		</form>
																	</div>
																</div>

																<?php

																$sql_comentario_filho = "SELECT * FROM tbcomentario WHERE status = 1 AND tabela = '$tabela' AND pai_id = $vw AND comentario_pai = ".$rs_comentario['id']." ORDER BY data DESC";
																$resultado_comentario_filho = $conecta->selecionar($conecta->conn,$sql_comentario_filho);
																while($rs_comentario_filho = mysqli_fetch_array($resultado_comentario_filho)){
																	?>
																	<ol style=" margin-left: 50px; margin-top: 20px;">
																		<li>
																			<div class="comment-body" style="background:<?php echo $rs_configuracao['fundo_resposta'];?>">
																				<div class="comment-author vcard">
																					<img style="float:left; margin:5px 10px 0 0;" alt="" src="http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=74&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/621e722887afb6d4249f2153f1f71525?s=148&amp;d=mm&amp;r=g 2x" class="avatar avatar-74 photo">
																					<cite class="fn"><?php echo $rs_comentario_filho['nome'];?> <b style="font-weight:normal;">(<?php echo $rs_comentario_filho['cidade'];?>)</b></cite>
																					<span class="says">disse:</span>
																					<div class="comment-meta commentmetadata"><a href="#"><?php echo substr($rs_comentario_filho['data'],8,2)." de ".$meses[(int)substr($rs_comentario_filho['data'],5,2)].", ".substr($rs_comentario_filho['data'],0,4);?></a></div>
																				</div>
																				<p style="padding-bottom: 15px;"><?php echo $rs_comentario_filho['comentario'];?></p>
																				<!--<div class="reply"><a class="comment-reply-link" href="javascript:void(0)" aria-label="Responder para Teste">Responder</a></div>-->
																			</div>
																		</li>
																	</ol>
																<?php } ?>
															</li><!-- #comment-## -->
														</ol><!-- .comment-list -->
												<?php $i++; } ?>
										</div><!-- #comments -->
								<?php } else { ?>
										<div class="block-title"><h4>SEJA O PRIMEIRO A FAZER UM COMENTÁRIO!</h4></div>
								<?php }?>
						</div>

						<!-- Comments -->
						<div class="comments" style="padding-top:0;">
								<!-- /botao deixe aqui seu comentário -->
								<a class="btn btn-default btn-lg btn-product" id="deixarComentario">DEIXE AQUI SEU COMENTÁRIO</a>
						</div>
						<!-- /Comments -->

						<!-- Leave a Comment -->
						<div class="comments-form" id="telaComentario" style="background: #FFFFFF; padding: 5px;">
								<div id="status_comentario"></div>
								<div class="block-title"><span class="comment-date"><?php echo $rs_configuracao['nomeloja'];?> <?php echo str_replace("<p>","",str_replace("</p>","",$rs_configuracao['texto_comentario']));?></span></div>
								<div class="block-title"><span class="comment-date">O seu endereço de e-mail não será publicado.</span></div>
								<form method="post" action="" name="comments-form" id="comments-form">
										<input type="hidden" name="pai" id="pai" value="0" />
										<input type="hidden" name="tabela" id="tabela" value="<?php echo $tabela;?>" />
										<input type="hidden" name="vw" id="vw" value="<?php echo $vw;?>" />
										<div class="row">
												<div class="form-group col-sm-6">
														<select id="" name="avaliacao" class="form-control">
																<option selected="selected" value="avaliar">Como voc&ecirc; classifica esta postagem?</option>
																<option value="5 Estrelas (Otimo)">5 Estrelas(&Oacute;timo)</option>
																<option value="4 Estrelas">4 Estrelas</option>
																<option value="3 Estrelas(Bom)">3 Estrelas(Bom)</option>
																<option value="2 Estrelas">2 Estrelas</option>
																<option value="1 Estrela(Ruim)">1 Estrela(Ruim)</option>
														</select>
												</div>
												<div class="form-group col-sm-6">
														<input type="text" placeholder="T&iacute;tulo do coment&aacute;rio" class="form-control" title="comments-form-name" name="titulo" id="titulo" required="required" value="" >
												</div>
												<div class="form-group col-sm-6">
														<input type="text" placeholder="Nome" class="form-control" title="comments-form-name" name="nome" id="nome" required="required" value="" >
												</div>
												<div class="form-group col-sm-6">
														<input type="text" placeholder="E-mail (seu e-mail não será divulgado)" class="form-control" title="comments-form-email" name="email" id="email" required="required">
												</div>
												<div class="form-group col-sm-12">
														<input type="text" placeholder="Cidade/Estado" class="form-control" title="comments-form-website" name="cidade" id="cidade" required="required">
												</div>
										</div>
										<div class="form-group">
												<textarea placeholder="Digite Sua Mensagem ..." class="form-control" title="comments-form-comments" name="message" id="message" rows="6" required></textarea>
										</div>
										<div class="form-group">
												<input type="button" class="btn btn-default" id="comentario_principal" value="Enviar Comentário">
										</div>
								</form>
						</div>                <!-- /Leave a Comment -->



                    </div><!-- /.content -->
                    <!-- /Content -->

                </div>
            </div>
        </section>
