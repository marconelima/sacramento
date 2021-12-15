<?php

$sql_depoimento = "SELECT * FROM tbdepoimento WHERE status = 1 ORDER BY data DESC, id DESC LIMIT $inicio, $maximo";
$resultado_depoimento = $conecta->selecionar($conecta->conn, $sql_depoimento);

$sql_depoimento_total = "SELECT * FROM tbdepoimento WHERE status = 1 ORDER BY data DESC";
$resultado_total = $conecta->selecionar($conecta->conn, $sql_depoimento_total);

?>

<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Depoimentos</h2>
        <!-- Breadcrumbs 
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl2;?>">Home</a></li>
            <li><a href="#">Informações Gerais</a></li>
            <li class="active">Depoimentos</li>
        </ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->
<span id="top_shadow"></span>

<!-- Content area-->
<div class="content-area" style="margin-top:240px;">

<section class="page-section">


    <div class="container">
        <div id="testimonial_form" class="form_section">
            <form name="af-form" method="post" action="" enctype="multipart/form-data">
                    <fieldset>
                    <legend>Deixe o seu depoimento</legend>

                    <?php
                    if(isset($_POST['enviar']) && $_POST['enviar'] == "Enviar"){

                        //PEGAR OS DADOS
                        $dados = $_POST["dados"];
                        $id = 		strip_tags(trim(@$dados['tbdepoimento']['id']));
                        $nome =    	strip_tags(trim($dados['tbdepoimento']['nome']));
                        $email =    	strip_tags(trim($dados['tbdepoimento']['email']));
                        $conteudo =  	$dados['tbdepoimento']['conteudo'];
                        $cidade = 	strip_tags(trim(@$dados['tbdepoimento']['cidade']));


                        if(empty($nome) || $nome == 'Nome *'){
                            $retorno = '<div class="alert alert-success">Informe o nome!</div>';
                        }elseif(empty($email) || $email == 'E-mail *'){
                            $retorno = '<div class="alert alert-success">Informe o email!</div>';
                        }elseif(empty($conteudo) || $conteudo == 'Digite seu Depoimento (200 caracteres)...'){
                            $retorno = '<div class="alert alert-success">Faça o depoimento!</div>';
                        }

                        if(empty($retorno)){

                            if($resultado = $conecta->inserir($dados)){

                                //echo $resultado;

                                $date = date("d/m/Y h:i");

                                //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
                                $assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Depoimento";
                                $cabecalho_da_mensagem_de_resposta = "From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
                                $configuracao_da_mensagem_de_resposta="Prezado(a) ".$nome.",<br>
                                Obrigado por enviar seu depoimento, sua mensagem foi enviada para ".$rs_configuracao['nomeloja'].".<br>
                                Em breve seu depoimento poderá estar no nosso site.<br>
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

                                if(mail($email,$assunto_da_mensagem_de_resposta,$configuracao_da_mensagem_de_resposta,$headers)){
                                    echo '<div class="alert alert-success">Depoimento enviado com sucesso!</div>';
                                    unset($nome, $email, $cidade, $conteudo);
                                } else {
                                    echo '<div class="alert alert-danger">Problema ao enviar depoimento!</div>';
                                }
                            }
                        } else {
                            echo $retorno;
                        }
                    }
                    ?>

                    <input type="hidden" name="dados[tbdepoimento][tela_id]" value="<?php echo $tela;?>" />
                    <input type="hidden" name="dados[tbdepoimento][data]" value="<?php echo date("Y-m-d");?>" />
                    <input type="hidden" name="dados[tbdepoimento][status]" value="0" />
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="dados[tbdepoimento][nome]" id="nome" size="30" value="<?php echo @$nome?>" placeholder="Nome *" class="form-control placeholder" />

                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="dados[tbdepoimento][email]" id="email" size="30"  value="<?php echo @$email?>" placeholder="E-mail *" class="form-control placeholder"/>

                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="dados[tbdepoimento][cidade]" id="cidade_estado" size="30"  value="<?php echo @$cidade?>" placeholder="Cidade *" class="form-control placeholder" />

                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <textarea id="message" name="dados[tbdepoimento][conteudo]" rows="10"  placeholder="Digite seu Depoimento (200 caracteres)..." class="form-control placeholder"><?php echo @$conteudo?></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="submit" name="enviar" class="form-button btn btn-default"  value="Enviar" />
                        </div>
                    </div>
                    </fieldset>
            </form>
        </div>

        <div id="all_testimonials">
            <?php while($rs_depoimento = mysqli_fetch_array($resultado_depoimento)){?>
            <div class="media testimonial text-center">
                <div class="testimonial-title">
                    <h4 class="media-heading"><?php echo $rs_depoimento['nome']?>,<small><?php echo $rs_depoimento['cidade']?></small><span><?php echo $mesesx[substr($rs_depoimento['data'],5,2)]." ".substr($rs_depoimento['data'],8,2).", ".substr($rs_depoimento['data'],0,4);?></span></h4>
                </div>
                <div class="clearfix"></div>
                <div class="media-body">
                    <p><?php echo str_replace("<p>","",str_replace("</p>","",$rs_depoimento['conteudo']))?></p>
                </div>
            </div>
            <?php } ?>

        </div>

        <?php include "paginacao.php"; ?>
    </div>
</section>
