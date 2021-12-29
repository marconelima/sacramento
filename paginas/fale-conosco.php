<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Fale Conosco - Localização</h2>
        <!-- Breadcrumbs 
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl2; ?>">Home</a></li>
            <li class="active">Fale Conosco - Localização</li>
        </ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->

<span id="top_shadow"></span>


<!-- Content area-->
<div class="content-area content" style="padding-bottom: 0 !important; margim-bottom: 0 !important; margin-top:120px;">


    <section class="page-section" style="padding-bottom: 0 !important; margin-bottom: 0 !important;">
        <div id="contact_info_form" class="container">

            <!--<div id="info" class="contact_section">
            <ul style="float:left; width:100%; margin-bottom:2%;">
                <li style="width:30%; float:left;"><p><?php echo $rs_configuracao['emailloja'] ?></p></li>
                <li style="width:30%; float:left;"><p><?php echo $rs_configuracao['telefoneloja'] ?></p></li>
            </ul>
        </div>-->

            <div id="info" class="contact_section" style="margin-left:1%;">
                <h3><?php echo convertem($rs_configuracao['titulo_contato'], 1); ?></h3>
                <h5><?php echo $rs_configuracao['texto_contato']; ?></h5>
            </div>

            <div class="col-sm-12 col-md-7 contact_section" style="float: left;">
                <form name="af-form" method="post" action="" class="af-form row">
                    <h3 style="font-weight:lighter; font-size: 16pt; text-indent: 15px; margin-bottom:30px;">Mande sua mensagem</h3>

                    <?php
                    //require_once('recaptchalib.php');

                    if (isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar') {

                        $name = $_POST['name'];
                        $email = $_POST['mail'];
                        $phone = $_POST['phone'];
                        $cellphone = $_POST['cellphone'];
                        $whatsapp = $_POST['whatsapp'];
                        $city_estate = $_POST['city_estate'];
                        $assunto = $_POST['subject'];
                        $message = $_POST['message'];


                        if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] > 0) {
                            $captcha_data = $_POST['g-recaptcha-response'];

                            @$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld8tCsUAAAAAAvftgZrcfID-bwAyAKSKU-Evfmg&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                        }

                        // Se nenhum valor foi recebido, o usuário não realizou o captcha
                        if ($resposta . success != true) {
                            $retorno = '<div class="alert alert-danger" style="margin-bottom:30px;">Marque a opção "Não sou um robô"</div>';
                        } elseif (empty($name) || $name == 'Nome Completo *') {
                            $retorno = '<div class="alert alert-danger">Informe o nome!</div>';
                        } elseif (empty($email) || $email == 'E-mail *') {
                            $retorno = '<div class="alert alert-danger">Informe o e-mail!</div>';
                        } elseif (empty($phone) || $phone == 'DDD + Telefone *') {
                            $retorno = '<div class="alert alert-danger">Informe o telefone!</div>';
                        } elseif (empty($cellphone) || $cellphone == 'DDD + Celular *') {
                            $retorno = '<div class="alert alert-danger">Informe o celular!</div>';
                        } elseif (empty($city_estate) || $city_estate == 'Cidade *') {
                            $retorno = '<div class="alert alert-danger">Informe a cidade!</div>';
                        } elseif (empty($assunto) || $assunto == 'Estado *') {
                            $retorno = '<div class="alert alert-danger">Informe o Assunto!</div>';
                        }


                        if (empty($retorno)) {

                            $date = date("d/m/Y h:i");

                            // FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
                            $assunto =  "Contato - " . strip_tags(trim($_POST['subject']));
                            $cabecalho_da_mensagem_original = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
                            $configuracao_da_mensagem_original = "<strong>Campos do e-mail:</strong><br>
                            <br>
                            De: " . $name . "<br>
                            Responder para: " . $email . "<br>
                            Assunto: Contato pelo site: " . $assunto . "<br>
                            <br>
                            <strong>Texto da mensagem:</strong><br>
                            <br>
                            Prezado(a) " . $rs_configuracao['nomeloja'] . ",<br>
                            Foi enviada a seguinte mensagem pelo site:<br>
                            <br>
                            " . $message . "<br>
                            <br>
                            Enviada em $date por:<br>
                            <br>
                            <strong>Nome:</strong> $name<br>
                            <strong>E-mail:</strong> $email<br>
                            <strong>DDD + Telefone:</strong> $phone<br>
                            <strong>DDD + Celular:</strong> $cellphone<br>
                            <strong>Whatsapp:</strong> $whatsapp<br>
                            <strong>Cidade:</strong> $city_estate<br>
                            <br>
                            Indústria Sacramento<br>
                            <a href='http://www.industriasacramento.com.br'>www.industriasacramento.com.br</a>";

            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function
            

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            $emailcaixa = 'vendas@industriasacramento.com.br';

            try {
                //Server settings
                $mail->SMTPDebug = 2;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.uhserver.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'noreply@industriasacramento.com.br';                     //SMTP username
                $mail->Password   = 'G4p2f5D3@';                               //SMTP password
                $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));
                //$mail->addAddress($email, $name);     //Add a recipient
                $mail->addAddress($rs_configuracao['emailloja'], utf8_decode($rs_configuracao['nomeloja']));

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = utf8_decode("Contato - " . strip_tags(trim($_POST['subject'])));                
                $mail->Body    = utf8_decode($configuracao_da_mensagem_original);

                if($mail->send()){
                    echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';



                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>Problema ao enviar mensagem! Error: {$mail->ErrorInfo}</div>";
            }
/*
                            //ENVIO DE MENSAGEM ORIGINAL
                            $headers = "$cabecalho_da_mensagem_original";
                            $headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";



                            if (mail($rs_configuracao['emailloja'], $assunto, $configuracao_da_mensagem_original, $headers)) {

                                echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';

                                //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
                                $assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Contato";
                                $cabecalho_da_mensagem_de_resposta = "From: " . $rs_configuracao['nomeloja'] . " <" . $rs_configuracao['emailloja'] . ">\n";
                                $configuracao_da_mensagem_de_resposta = "Prezado(a) " . $name . ",<br>
                                Obrigado por entrar em contato, sua mensagem foi enviada para " . $rs_configuracao['nomeloja'] . ".<br>
                                Em breve lhe responderemos.<br>
                                <br>
                                Atenciosamente,<br>
                                " . $rs_configuracao['nomeloja'] . "<br>
                                <br>
                                <a href='" . $rs_configuracao['linkloja'] . "'>" . $rs_configuracao['linkloja'] . "</a><br>
<br>
Recebido em: $date<br>
Indústria Sacramento<br>
<a href='http://www.industriasacramento.com.br'>www.industriasacramento.com.br</a>";

                                //ENVIO DE MENSAGEM RESPOSTA
                                $headers = "$cabecalho_da_mensagem_de_resposta";
                                $headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";

                                mail($mail, $assunto_da_mensagem_de_resposta, $configuracao_da_mensagem_de_resposta, $headers);
                                unset($name, $mail, $city_estate, $assunto, $message, $phone, $cellphone);
                            } else {
                                echo '<div class="alert alert-danger">Problema ao enviar mensagem!</div>';
                            }*/
                        } else {
                            echo $retorno;
                        }
                    }

                    ?>
                    <div class="col-sm-12 af-outer af-required ">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="name" id="nome" size="60" value="<?php echo @$name; ?>" class="form-control " />
                            <span>Nome Completo *</span>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required ">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="mail" id="email" size="60" value="<?php echo @$email; ?>" class="form-control " />
                            <span>E-mail *</span>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required ">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="phone" id="phone" size="60" value="<?php echo @$phone; ?>" class="form-control " />
                            <span>DDD + Telefone *</span>
                            <script type="text/javascript">
                                $("#phone").mask("(00) 9999-99999");
                            </script>

                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required ">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="cellphone" id="cel" size="60" value="<?php echo @$cellphone; ?>" class="form-control " />
                            <span>DDD + Celular *</span>

                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required whats">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="whatsapp" id="cel" size="60" value="<?php echo @$whatsapp; ?>" class="form-control " />
                            <span>Whatsapp</span>

                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required ">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="city_estate" id="city_estate" size="60" value="<?php echo @$city_estate; ?>" class="form-control " />
                            <span>Cidade/Estado *</span>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required ">
                        <div class="form-group af-inner input-contact">
                            <input type="text" name="subject" id="subject" size="60" value="<?php echo @$assunto; ?>" class="form-control " />
                            <span>Assunto *</span>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner textarea-contact">
                            <textarea id="message" name="message" rows="10" class="form-control "><?php echo @$message; ?></textarea>
                            <span>Digite sua mensagem...</span>
                        </div>
                    </div>

                    <div class="col-sm12 af-outer af-required">
                        <div class="form-group af-inner">
                            <div class="g-recaptcha" data-sitekey="6Ld8tCsUAAAAALYEXV33ywL1HGAnFTE6xIsQY-Im" style="float:left; margin-bottom:1%; margin-right:3%; margin-left:2.2%;"></div>
                        </div>
                    </div>


                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="submit" name="enviar" class="form-button btn btn-default" id="enviar" value="Enviar" />
                        </div>
                    </div>


                </form>
            </div>

            <div class="col-sm-12 col-md-5 sidebar" id="sidebar" style="margin-top:4.7%; background:<?php echo $rs_configuracao['fundo_nossa_loja']; ?>; padding-top:0; float:right;">

                <div class="widget" style="padding-bottom:0;">
                    <h3><?php echo $rs_configuracao['titulo_nossa_loja']; ?></h3>
                    <?php echo $rs_configuracao['nossa_loja']; ?>

                    <hr class="page-divider transparent small" />
                </div>

            </div>
            <div class="col-sm-12 col-md-5 sidebar" id="sidebar1" style=" background:<?php echo $rs_configuracao['fundo_sobre_loja']; ?>; padding-top:0; float:right; margin-top:2%;">

                <div class="widget" style="padding-bottom:0;">
                    <h3><?php echo $rs_configuracao['titulo_sobre_loja']; ?></h3>
                    <?php echo $rs_configuracao['sobre_loja']; ?>
                    <hr class="page-divider transparent small" />
                </div>

            </div>


        </div>

        
        <div id="localization" style="margin-top:2%; float:left; width:100%">
            <div class="google_maps" style="width:100%; margin-right:1% !important; float: left; overflow: hidden;">
                <div class="iframe-rwd"> 
                    <?php echo $rs_configuracao['linkmapa']; ?> 
                </div>
            </div>
                    <!--
        <div class="google_maps" style="width:49%; margin-left:1% !important; float: left; overflow: hidden;">
            <?php //echo $rs_configuracao['linkmapa2'];
            ?>
        </div>
    -->
                </div>




                <div class="clearfix"></div>
    </section>