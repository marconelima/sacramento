<?php
    $sql_fornecedor = "SELECT * FROM tbgrupo_conteudo WHERE status = 1 AND tela_id = 21";
    $resultado_fornecedor = $conecta->selecionar($conecta->conn,$sql_fornecedor);
    $rs_fornecedor = mysqli_fetch_array($resultado_fornecedor);
?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Trabalhe Conosco</h2>
        <!-- Breadcrumbs 
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl2;?>">Home</a></li>
            <li class="active">Empresa</li>
            <li class="active">Trabalhe Conosco</li>
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
        <div class="row">
            <div class="col-sm-8 col-md-9 content">

                <div class="widget">

                    <div class="block-title"><h3><?php echo $rs_fornecedor['titulo'];?></h3></div>

                    <p><?php echo str_replace("<p>","",str_replace("</p>","",$rs_fornecedor['conteudo']));?> </p>

                    <p><a href="<?php echo $siteUrl;?>app/andflxpv.apk" target="_blank" style="color:#069; font-weight:bold;"><i class="fa fa-download"></i> Baixar o APP</a></p>


                    <p>Campos marcados com asterisco (*) são obrigatórios</p>
                </div>

                <div id="form_trabalhe_conosco">
                    <form name="af-form" method="post" action="" enctype="multipart/form-data" class="af-form row" id="af-form">

                        <fieldset>
                            <legend>Dados Pessoais</legend>

                            <?php


							if(isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar'){

								$nome = $_POST['nome'];
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$cellphone = $_POST['cellphone'];
                                $whatsapp = $_POST['whatsapp'];
								$cidade = $_POST['cidade'];
								$estado = $_POST['estado'];

                                if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] > 0) {
                                    $captcha_data = $_POST['g-recaptcha-response'];

                                    @$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld8tCsUAAAAAAvftgZrcfID-bwAyAKSKU-Evfmg&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);
                                }

                                // Se nenhum valor foi recebido, o usuário não realizou o captcha
                                if ($resposta.success != true) {
                                    $retorno = '<div class="alert alert-danger">Marque a opção "Não sou um robô"</div>';

                                } elseif(empty($nome) || $nome == 'Nome *'){
                                    $retorno = '<div class="alert alert-danger">Informe o nome!</div>';
                                } elseif(empty($email) || $nome == 'E-mail *'){
                                    $retorno = '<div class="alert alert-danger">Informe o e-mail!</div>';
                                } elseif(empty($phone) || $nome == 'DDD + Telefone *'){
                                    $retorno = '<div class="alert alert-danger">Informe o telefone!</div>';
                                } elseif(empty($cellphone) || $nome == 'DDD + Celular *'){
                                    $retorno = '<div class="alert alert-danger">Informe o celular!</div>';
                                } elseif(empty($cidade) || $nome == 'Cidade *'){
                                    $retorno = '<div class="alert alert-danger">Informe a cidade!</div>';
                                } elseif(empty($estado) || $nome == 'Estado *'){
                                    $retorno = '<div class="alert alert-danger">Informe o estado!</div>';
                                }


                                if(empty($retorno)){



									$anexado = @$_FILES['curriculum']['name'];
									$var1 = explode('.', $anexado);
									$var2 = end($var1);
									$extensao = strtolower($var2);
									$extensoes = array ('txt', 'doc', 'docx');
									$size = @$_FILES['curriculum']['size'];
									$maxsize = 1024 * 1024 * 4;

									$date = date("d/m/Y h:i");

									// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
									$assunto =  "Contato - Trabalhe conosco";
									$cabecalho_da_mensagem_original="From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
									$configuracao_da_mensagem_original="<strong>Campos do e-mail:</strong><br>
									<br>
									De: ".$nome."<br>
									Responder para: ".$mail."<br>
									Assunto: Contato - Trabalhe conosco: <br>
									<br>
									<strong>Texto da mensagem:</strong><br>
									<br>
									Prezado(a) ".$rs_configuracao['nomeloja'].",<br>
									Foi enviada a seguinte mensagem pelo site:<br>
									<br>
									Enviada em $date por:<br>
									<br>
									<strong>Nome:</strong> $nome<br>
									<strong>E-mail:</strong> $email<br>
									<strong>DDD + Telefone:</strong> $phone<br>
									<strong>DDD + Celular:</strong> $cellphone<br>
                                    <strong>Whatsapp:</strong> $whatsapp<br>
									<strong>Cidade:</strong> $cidade<br>
									<strong>Estado:</strong> $estado<br>
									<br>
                                    Indústria Sacramento<br>
                                    <a href='http://www.industriasacramento.com.br'>www.industriasacramento.com.br</a>";

									//ENVIO DE MENSAGEM ORIGINAL
									$arquivo = (isset($_FILES["curriculum"]) ? $_FILES["curriculum"] : FALSE);

									if(file_exists($arquivo["tmp_name"]) && !empty($arquivo)){

										$fp = fopen($_FILES["curriculum"]["tmp_name"],"rb");
										$anexo = fread($fp,filesize($_FILES["curriculum"]["tmp_name"]));
										$anexo = base64_encode($anexo);

										fclose($fp);

										$anexo = chunk_split($anexo);

										$boundary = "XYZ-" . date("dmYis") . "-ZYX";

										$mens = "--$boundary\n";
										$mens .= "Content-Transfer-Encoding: 8bits\n";
										$mens .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
										$mens .= "$configuracao_da_mensagem_original\n";
										$mens .= "--$boundary\n";
										$mens .= "Content-Type: ".$arquivo["type"]."\n";
										$mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";
										$mens .= "Content-Transfer-Encoding: base64\n\n";
										$mens .= "$anexo\n";
										$mens .= "--$boundary--\r\n";

										$headers  = "MIME-Version: 1.0\n";
										$headers .= "$cabecalho_da_mensagem_original";
										$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
										$headers .= "$boundary\n";
									}else{

										$mens = "$configuracao_da_mensagem_original\n";

										$headers  = "MIME-Version: 1.0\n";
										$headers .= "$cabecalho_da_mensagem_original";
										$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
									}

									if(mail($rs_configuracao['emailloja'],$assunto,$mens,$headers)){

										echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';

										//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
										$assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Trabalhe Conosco";
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
Indústria Sacramento<br>
<a href='http://www.industriasacramento.com.br'>www.industriasacramento.com.br</a>";

										//ENVIO DE MENSAGEM RESPOSTA
										$headers = "$cabecalho_da_mensagem_de_resposta";
										$headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

										mail($mail,$assunto_da_mensagem_de_resposta,$configuracao_da_mensagem_de_resposta,$headers);

									} else {
										echo '<div class="alert alert-danger">Problema ao enviar mensagem!</div>';
									}
                                } else {
                                    echo @$retorno;
                                }
                            }

						?>
                            <div class="col-sm-12 af-outer af-required coluna_campo">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="nome" id="nome" size="30" value="" class="form-control" />
                                    <span>Nome *</span>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer af-required coluna_campo">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="email" id="email" size="30" value="" class="form-control"/>
                                    <span>E-mail *</span>
                                </div>
                            </div>


                            <div class="col-sm-12 af-outer coluna_campo">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="phone" id="phone" size="30" value="" class="form-control" />
                                    <span>DDD + Telefone *</span>
                                    <script type="text/javascript">$("#phone").mask("(00) 9999-99999");</script>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer coluna_campo">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="cellphone" id="cel" size="30" value="" class="form-control" />
                                    <span>DDD + Celular *</span>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer coluna_campo whats">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="whatsapp" id="cel" size="30" value="" class="form-control " />
                                    <span>Whatsapp</span>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer af-required coluna_campo">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="cidade" id="cidade" size="30" value="" class="form-control" />
                                    <span>Cidade *</span>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer af-required coluna_campo">
                                <div class="form-group af-inner input-contact">
                                    <input type="text" name="estado" id="estado" size="30" value="" class="form-control" />
                                    <span>Estado *</span>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer af-required">
                                <div class="form-group af-inner">
                                    <input type="file" id="curriculum" name="curriculum" class="form-control placeholder custom-file-input"/>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer af-required">
                                <div class="form-group af-inner">
                                    <div class="g-recaptcha" data-sitekey="6Ld8tCsUAAAAALYEXV33ywL1HGAnFTE6xIsQY-Im" style="float:left; margin-bottom:1%; margin-right:3%; margin-left:0%;"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 af-outer af-required">
                                <div class="form-group af-inner">
                                    <input type="submit" name="enviar" class="form-button btn btn-default" id="enviar" value="Enviar" />
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
