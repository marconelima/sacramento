<?php
$sql_news = "SELECT * FROM tbgrupo_conteudo WHERE tela_id = 45";
$resultado_news = $conecta->selecionar($conecta->conn, $sql_news);
$rs_news = mysqli_fetch_array($resultado_news);

?>
	<!-- Call action -->
	<section class="page-section call-action" style="background-color:<?php echo $rs_configuracao['fundo_container_newsletter'];?> !important; padding:60px 0;">
		<div class="container">
			<div class="row">
				<div class="col-sm-12" data-animation="fadeInLeft" id="text_news" data-animation-delay="100" style="padding-left:0;">
					<h3 class="media-heading" id="news_pos" style="font-size:40px;"><?php echo $rs_news['titulo'];?></h3>
					<p style="font-size:20px;"><?php echo $rs_news['conteudo'];?></p>
				</div>
				<?php
				if(isset($_POST['submit']) && @$_POST['submit'] == 'CADASTRAR!'){

					 $email = $dados['tbnewsletter']['email'] = $_POST['email'];
					 $nome = $dados['tbnewsletter']['nome'] = $_POST['name'];

					 $verifica = $conecta->selecionar($conecta->conn,"SELECT * FROM tbnewsletter WHERE email = '$email'");
					 $contar = mysqli_num_rows($verifica);

					 if ($contar >= '1'){
						$retorno =  '<span class="alert alert-danger aviso_news">O email já foi cadastrado em nosso Site</span>';
					 } else {

						 $cadastra = $conecta->inserir($dados);

						 if ($cadastra <= '0'){
							$retorno =  '<span class="alert alert-danger aviso_news">Erro ao cadastrar, favor tentar novamente</span>';
						 }else{
							$retorno =  '<span class="alert alert-success aviso_news">Cadastro com sucesso!</span>';

							 $data = date('d/m/Y H:i');
							 $msn = "
							 Recebemos um pedido de cadastro do seu email em nosso Site!
							 <br />
							 Para confirmar seu cadastro, por favor clique no link abaixo.
							 <br />
							 <br />
							 <a href=\"".$rs_configuracao['linkloja']."/confirmar/46/-/-/-/-/$email\">Confirmar Cadastro</a>
							 <br />
							 <br />
							 Se você não cadastrou este pedido em nosso site, por favor ignore este email!
							 <br>
									Atenciosamente,<br>
									".$rs_configuracao['nomeloja']."<br>
									<br>
									<a href='".$rs_configuracao['linkloja']."'>".$rs_configuracao['linkloja']."</a><br>
<br>
Recebido em: $date<br>
									Industria Sacramento
									
									
							 ";

							 $para = $rs_configuracao['emailloja'];
							 $assunto = 'Cadastro Newsletter '.$rs_configuracao['nomeloja'];

							 $headers = "From: $para\n";
							 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

							 mail($email,$assunto,$msn,$headers);

							echo $retorno;
						 }
					 }


				}
				?>
				<div class="col-sm-12" data-animation="fadeInRight" data-animation-delay="300">
					<form name="newsletter-form" method="post" action="#news_pos" class="af-form row" id="newsletter-form" style="margin-top: 10px;">

							<div class="col-sm-4 af-outer af-required">
								<div class="form-group af-inner">
									<input type="text" name="name" id="name" size="30" value="" placeholder="Nome *" class="form-control placeholder" required="required" />
								</div>
							</div>

							<div class="col-sm-4 af-outer af-required">
								<div class="form-group af-inner">
									<input type="email" name="email" id="email" size="30" value="" placeholder="Email *" class="form-control placeholder" required="required" />
								</div>
							</div>

							<div class="col-sm-4 af-outer af-required">
								<div class="form-group af-inner">
									<input type="submit" name="submit" class="form-button btn btn-default" id="submit_btn" value="CADASTRAR" style="height:40px;"/>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
	</section>
	<!-- /Call action -->
