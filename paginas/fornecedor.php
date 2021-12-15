<?php
	$sql_fornecedor = "SELECT * FROM tbgrupo_conteudo WHERE status = 1 AND tela_id = 42";
	$resultado_fornecedor = $conecta->selecionar($conecta->conn,$sql_fornecedor);
	$rs_fornecedor = mysqli_fetch_array($resultado_fornecedor);
?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
	<div class="container">
		<h2 class="section-title">Fornecedores</h2>
		<!-- Breadcrumbs 
		<ul class="breadcrumb">
			<li><a href="<?php echo $siteUrl;?>">Home</a></li>
			<li class="active">Empresa</li>
			<li class="active">Fornecedor</li>
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
				<div class="widget">
                    <blockquote><?php echo $rs_fornecedor['titulo'];?></blockquote>
                    <p><?php echo $rs_fornecedor['conteudo'];?></p>
                    <p>Campos marcados com asterisco (*) são obrigatórios</p>
                </div>

				<div id="form_fornecedores">
                    <form name="fornecedor-form" method="post" action="" class="af-form row" id="fornecedor-form">
                        <fieldset>
                           	<legend>Dados da Empresa</legend>
							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="nome" id="nome" size="30" value="" placeholder="Nome da Empresa *" class="form-control placeholder" required="required"  />

								</div>
							</div>

                            <?php
							//require_once('recaptchalib.php');

							if(isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar'){

								$responsible = $_POST['responsible'];
								$mail = $_POST['mail'];
								$phone = $_POST['phone'];
								$cellphone = $_POST['cellphone'];
								$whatsapp = $_POST['whatsapp'];
								$endereco = $_POST['endereco'];
								$bairro = $_POST['bairro'];
								$cidade = $_POST['cidade'];
								$estado = $_POST['estado'];
								$cep = $_POST['cep'];
								$message = $_POST['message'];
								/*
								$privatekey = "6LdXHwQTAAAAAA8a_Lr9NjogiKitHuRJsuA1VWEt";
								$resp = recaptcha_check_answer($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["recaptcha_challenge_field"],
								$_POST["recaptcha_response_field"]);

								if (!$resp->is_valid) {
									// What happens when the CAPTCHA was entered incorrectly
									echo '<div class="alert alert-danger">O código de verificação esta incorreto.</div>';
								}else {
									*/
									$date = date("d/m/Y h:i");

									// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
									$assunto =  "Fornecedor - Dados da empresa";
									$cabecalho_da_mensagem_original="From: $mail\n";
									$configuracao_da_mensagem_original="<strong>Campos do e-mail:</strong><br>
									<br>
									De: ".$responsible."<br>
									Responder para: ".$mail."<br>
									Assunto: Fornecedor - Dados da empresa <br>
									<br>
									<strong>Texto da mensagem:</strong><br>
									<br>
									Prezado(a) ".$rs_configuracao['nomeloja'].",<br>
									Foi enviada a seguinte mensagem pelo site:<br>
									<br>
									".$message."<br>
									<br>
									Enviada em $date por:<br>
									<br>
									<strong>Nome:</strong> $responsible<br>
									<strong>E-mail:</strong> $mail<br>
									<strong>DDD + Telefone:</strong> $phone<br>
									<strong>DDD + Celular:</strong> $cellphone<br>
									<strong>Whatsapp:</strong> $whatsapp<br>
									<strong>Endreço:</strong> $endereco<br>
									<strong>Bairro:</strong> $bairro<br>
									<strong>Cidade:</strong> $cidade<br>
									<strong>Estado:</strong> $estado<br>
									<strong>Cep:</strong> $cep<br>
									<br>
									Industria Sacramento
									
									";

									//ENVIO DE MENSAGEM ORIGINAL
									$headers = "$cabecalho_da_mensagem_original";
									$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

									if(mail($rs_configuracao['emailloja'],$assunto,$configuracao_da_mensagem_original,$headers)){

										echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';

										//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
										$assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Fornecedor";
										$cabecalho_da_mensagem_de_resposta = "From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
										$configuracao_da_mensagem_de_resposta="Prezado(a) ".$name.",<br>
										Obrigado por entrar em contato, sua mensagem foi enviada para ".$rs_configuracao['nomeloja'].".<br>
										<br>
										Atenciosamente,<br>
										".$rs_configuracao['nomeloja']."<br>
										<br>
										<a href='".$rs_configuracao['linkloja']."'>".$rs_configuracao['linkloja']."</a><br>
<br>
Recebido em: $date<br>
										Industria Sacramento
										
										";

										//ENVIO DE MENSAGEM RESPOSTA
										$headers = "$cabecalho_da_mensagem_de_resposta";
										$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

										mail($mail,$assunto_da_mensagem_de_resposta,$configuracao_da_mensagem_de_resposta,$headers);

									} else {
										echo '<div class="alert alert-danger">Problema ao enviar mensagem!</div>';
									}
								//}

							}

						?>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="responsible" id="responsible" size="30" value="<?php echo @$responsible;?>" placeholder="Responsável *" class="form-control placeholder" required="required"  />

								</div>
							</div>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="email" name="mail" id="mail" size="30" value="<?php echo @$mail;?>" placeholder="E-mail *" class="form-control placeholder" required="required" />

								</div>
							</div>


							<div class="col-sm-6 af-outer coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="phone" id="phone" size="30" value="<?php echo @$phone;?>" placeholder="DDD + Telefone *" class="form-control placeholder" required="required"  />


								</div>
							</div>

							<div class="col-sm-6 af-outer coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="cellphone" id="cellphone" size="30" value="<?php echo @$cellphone;?>" placeholder="DDD + Celular *" class="form-control placeholder" required="required"  />


								</div>
							</div>

							<div class="col-sm-6 af-outer coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="whatsapp" id="cellphone" size="30" value="<?php echo @$whatsapp;?>" placeholder="Whatsapp" class="form-control placeholder" required="required"  />


								</div>
							</div>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="endereco" id="endereco" size="30" value="<?php echo @$endereco;?>" placeholder="Endere&ccedil;o *" class="form-control placeholder" required="required"  />

								</div>
							</div>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="bairro" id="bairro" size="30" value="<?php echo @$bairro;?>" placeholder="Bairro *" class="form-control placeholder" required="required"  />

								</div>
							</div>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="cidade" id="cidade" size="30" value="<?php echo @$cidade;?>" placeholder="Cidade *" class="form-control placeholder" required="required"  />

								</div>
							</div>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="estado" id="estado" size="30" value="<?php echo @$estado;?>" placeholder="Estado *" class="form-control placeholder" required="required"  />

								</div>
							</div>

							<div class="col-sm-6 af-outer af-required coluna_campo">
								<div class="form-group af-inner">
									<input type="text" name="cep" id="cep" size="30" value="<?php echo @$cep;?>" placeholder="CEP *" class="form-control placeholder" required="required"  />

								</div>
							</div>

							<div class="col-sm-12 af-outer af-required">
								<div class="form-group af-inner">
									<textarea id="message" rows="10" placeholder="Digite sua mensagem..." class="form-control placeholder"><?php echo @$message;?></textarea>
								</div>
							</div>
							<!--
							<div class="col-sm-12 af-outer af-required">
                                <div class="form-group af-inner">
                                    <?php
                                    //$publickey = "6LdXHwQTAAAAAABjC0JUaa6ux2LqHYJbpjeIMvsd"; // you got this from the signup page
                                    //echo recaptcha_get_html($publickey);
                                    ?>

                                </div>
                            </div>
							-->
							<div class="col-sm-12 af-outer af-required">
								<div class="form-group af-inner">
									<input type="submit" name="cadastrar" class="form-button btn btn-default" id="cadastrar" value="Cadastrar" />
								</div>
							</div>
                        </fieldset>
                    </form>
                </div>
			</div>
		</div>
	</div>
</section>
