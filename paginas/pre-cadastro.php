<?php
    include('mpdf/mpdf.php');

    $sql_fornecedor = "SELECT * FROM tbgrupo_conteudo WHERE status = 1 AND tela_id = 22";
    $resultado_fornecedor = $conecta->selecionar($conecta->conn,$sql_fornecedor);
    $rs_fornecedor = mysqli_fetch_array($resultado_fornecedor);
?>
<!-- Header and Breadcrumbs  -->
<section class="page-section breadcrumbs">
    <div class="container">
        <h2 class="section-title">Pré-Cadastro</h2>
        <!-- Breadcrumbs 
        <ul class="breadcrumb">
            <li><a href="<?php echo $siteUrl2;?>">Home</a></li>
            <li class="active">Pré-Cadastro</li>
        </ul><!-- /.breadcrumb -->
        <!-- /Breadcrumbs -->
    </div>
</section>
<!-- /Header and Breadcrumbs  -->
</header><!-- /.header -->
<!-- /Header -->
<span id="top_shadow"></span>

<!-- Content area-->
<div class="content-area">

<section class="page-section">


    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-9 content">

                <div class="widget">

                    <div class="block-title"><h3><?php echo $rs_fornecedor['titulo'];?></h3></div>

                    <?php echo $rs_fornecedor['conteudo'];?>
                </div>

                <div id="form_precadastro">
                    <form name="af-form" method="post" action="" class="af-form row" id="af-form">

                        <?php

                        if(isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar'){

                            include "uteis/bancodados2.php";
                            $conecta2 = new Recordset2;
                            $conecta2->conexao();

                            $dados['tbprecadastro']['nome'] = $nome = $_POST['nome'];
                            $dados['tbprecadastro']['cpf'] = $cpf = $_POST['cpf'];
                            $dados['tbprecadastro']['rg'] = $rg = $_POST['rg'];
                            $data_nasc = $_POST['data_nasc'];
                            $dados['tbprecadastro']['data_nasc'] = substr($_POST['data_nasc'],6,4)."-".substr($_POST['data_nasc'],3,2)."-".substr($_POST['data_nasc'],0,2);
                            $dados['tbprecadastro']['endereco'] = $endereco = $_POST['endereco'];
                            $dados['tbprecadastro']['numero'] = $numero = $_POST['numero'];
                            $dados['tbprecadastro']['complemento'] = $complemento = $_POST['complemento'];
                            $dados['tbprecadastro']['cep'] = $cep = $_POST['cep'];
                            $dados['tbprecadastro']['bairro'] = $bairro = $_POST['bairro'];
                            $dados['tbprecadastro']['cidade'] = $cidade = $_POST['cidade'];
                            $dados['tbprecadastro']['estado'] = $estado = $_POST['estado'];
                            $dados['tbprecadastro']['phone'] = $phone = $_POST['phone'];
                            $dados['tbprecadastro']['tel_recado'] = $tel_recado = $_POST['tel_recado'];
                            $dados['tbprecadastro']['cel'] = $cel = $_POST['cel'];
                            $dados['tbprecadastro']['email'] = $email = $_POST['email'];
                            $dados['tbprecadastro']['cartao'] = $cartao = $_POST['cartao'];
                            $dados['tbprecadastro']['cartao'] = ($cartao == 's' ? 'Sim' : 'Não');
                            $dados['tbprecadastro']['oquevende'] = $oquevende = $_POST['oquevende'];
                            $dados['tbprecadastro']['quantovende'] = $quantovende = $_POST['quantovende'];
                            $dados['tbprecadastro']['referencia1'] = $referencia1 = $_POST['referencia1'];
                            $dados['tbprecadastro']['parentesco_ref1'] = $parentesco_ref1 = $_POST['parentesco_ref1'];
                            $dados['tbprecadastro']['ref1_phone'] = $ref1_phone = $_POST['ref1_phone'];
                            $dados['tbprecadastro']['ref1_cel'] = $ref1_cel = $_POST['ref1_cel'];
                            $dados['tbprecadastro']['referencia2'] = $referencia2 = $_POST['referencia2'];
                            $dados['tbprecadastro']['parentesco_ref2'] = $parentesco_ref2 = $_POST['parentesco_ref2'];
                            $dados['tbprecadastro']['ref2_phone'] = $ref2_phone = $_POST['ref2_phone'];
                            $dados['tbprecadastro']['ref2_cel'] = $ref2_cel = $_POST['ref2_cel'];
                            $dados['tbprecadastro']['referencia3'] = $referencia3 = $_POST['referencia3'];
                            $dados['tbprecadastro']['parentesco_ref3'] = $parentesco_ref3 = $_POST['parentesco_ref3'];
                            $dados['tbprecadastro']['ref3_phone'] = $ref3_phone = $_POST['ref3_phone'];
                            $dados['tbprecadastro']['ref3_cel'] = $ref3_cel = $_POST['ref3_cel'];
                            $dados['tbprecadastro']['mensagem'] = $mensagem = $_POST['mensagem'];

                            $dados['tbprecadastro']['data'] = date("Y-m-d H:i:s");

                            $captcha_data = '';
                            if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] > 0) {


                                $captcha_data = $_POST['g-recaptcha-response'];

                                @$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Leu2QcUAAAAAKBjBCTP-wcHbkDXsBTXcWarrUP8&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);


                            }

                            // Se nenhum valor foi recebido, o usuário não realizou o captcha
                            if ($resposta.success != true) {
                                $retorno = '<div class="alert alert-danger">Marque a opção "Não sou um robô"</div>';

                            } elseif(empty($nome) || $nome == 'Nome Completo *'){
                                $retorno = '<div class="alert alert-danger">Informe o nome!</div>';
                            } elseif(empty($cpf) || $cpf == 'CPF *'){
                                $retorno = '<div class="alert alert-danger">Informe o cpf!</div>';
                            } elseif(empty($rg) || $rg == 'RG (alfa-numérico) *'){
                                $retorno = '<div class="alert alert-danger">Informe o rg!</div>';
                            } elseif(empty($data_nasc) || $data_nasc == 'Data de Nascimento *'){
                                $retorno = '<div class="alert alert-danger">Informe a data de nascimento!</div>';
                            } elseif(empty($endereco) || $endereco == 'Endereço (rua, avenida) *'){
                                $retorno = '<div class="alert alert-danger">Informe o endereço!</div>';
                            } elseif(empty($numero) || $numero == 'N° *'){
                                $retorno = '<div class="alert alert-danger">Informe o número!</div>';
                            } elseif(empty($cep) || $cep == 'CEP *'){
                                $retorno = '<div class="alert alert-danger">Informe o CEP!</div>';
                            } elseif(empty($bairro) || $bairro == 'Bairro *'){
                                $retorno = '<div class="alert alert-danger">Informe bairro!</div>';
                            } elseif(empty($cidade) || $cidade == 'Cidade *'){
                                $retorno = '<div class="alert alert-danger">Informe a cidade!</div>';
                            } elseif(empty($phone) || $phone == 'DDD + Telefone Fixo *'){
                                $retorno = '<div class="alert alert-danger">Informe o telefone!</div>';
                            } elseif(empty($cel) || $cel == 'DDD + Celular *'){
                                $retorno = '<div class="alert alert-danger">Informe o celular!</div>';
                            } elseif(empty($email) || $email == 'E-mail *'){
                                $retorno = '<div class="alert alert-danger">Informe o e-mail!</div>';
                            } elseif(empty($oquevende) || $oquevende == 'O que vende? *'){
                                $retorno = '<div class="alert alert-danger">Informe o que vende!</div>';
                            } elseif(empty($quantovende) || $quantovende == 'Quanto vende por mês? *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($referencia1) || $referencia1 == '1ª Referência - Nome Completo *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($parentesco_ref1) || $parentesco_ref1 == 'Parentesco *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($ref1_phone) || $ref1_phone == 'DDD + Telefone Fixo *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($ref1_cel) || $ref1_cel == 'DDD + Celular *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($referencia2) || $referencia2 == '2ª Referência - Nome Completo *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($parentesco_ref2) || $parentesco_ref2 == 'Parentesco *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($ref2_phone) || $ref2_phone == 'DDD + Telefone Fixo *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($ref2_cel) || $ref2_cel == 'DDD + Celular *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($referencia3) || $referencia3 == '3ª Referência - Nome Completo *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($parentesco_ref3) || $parentesco_ref3 == 'Parentesco *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($ref3_phone) || $ref3_phone == 'DDD + Telefone Fixo *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($ref3_cel) || $ref3_cel == 'DDD + Celular *'){
                                $retorno = '<div class="alert alert-danger">Informe o quanto vende!</div>';
                            } elseif(empty($mensagem) || $mensagem == 'Fale de forma breve sobre seu interesse e experiência com vendas *'){
                                $retorno = '<div class="alert alert-danger">Escreva sua mensagem!!</div>';
                            }

                            if(empty($retorno)){

                                $dados2['cliente_pre_cadastro']['codigo'] = $conecta->inserirID($dados);
                                $dados2['cliente_pre_cadastro']['nome'] = $nome = $_POST['nome'];
                                $dados2['cliente_pre_cadastro']['cpf'] = $cpf = $_POST['cpf'];
                                $dados2['cliente_pre_cadastro']['numero_rg'] = $rg = $_POST['rg'];
                                $data_nasc = $_POST['data_nasc'];
                                $data_nasc2 = substr($_POST['data_nasc'],6,4)."-".substr($_POST['data_nasc'],3,2)."-".substr($_POST['data_nasc'],0,2);

                                $dados2['cliente_pre_cadastro']['data_nascimento'] = "TO_DATE('$data_nasc2','YYYY-MM-DD')";
                                $dados2['cliente_pre_cadastro']['endereco'] =  $endereco = $_POST['endereco'];
                                $dados2['cliente_pre_cadastro']['numero'] =  $numero = $_POST['numero'];
                                $dados2['cliente_pre_cadastro']['compl_endereco'] = $complemento = $_POST['complemento'];
                                $dados2['cliente_pre_cadastro']['cep'] = $cep = $_POST['cep'];
                                $dados2['cliente_pre_cadastro']['bairro'] = $bairro = $_POST['bairro'];
                                $dados2['cliente_pre_cadastro']['cidade'] = $cidade = $_POST['cidade'];
                                $dados2['cliente_pre_cadastro']['estado'] = $estado = $_POST['estado'];
                                $dados2['cliente_pre_cadastro']['telefone_fixo'] = $phone = $_POST['phone'];
                                $dados2['cliente_pre_cadastro']['telefone_recado'] = $tel_recado = $_POST['tel_recado'];
                                $dados2['cliente_pre_cadastro']['telefone_celular'] = $cel = $_POST['cel'];
                                $dados2['cliente_pre_cadastro']['email'] = $email = $_POST['email'];
                                $dados2['cliente_pre_cadastro']['indicador_cartao'] = $cartao = $_POST['cartao'];
                                $dados2['cliente_pre_cadastro']['produtos_vende'] = $oquevende = str_replace(",","",$_POST['oquevende']);
                                $dados2['cliente_pre_cadastro']['valor_venda_mes'] = $quantovende = $_POST['quantovende'];
                                $dados2['cliente_pre_cadastro']['valor_venda_mes'] = str_replace(",",".",str_replace(".","",$dados2['cliente_pre_cadastro']['valor_venda_mes']));
                                $dados2['cliente_pre_cadastro']['nome_referencia_1'] = $referencia1 = $_POST['referencia1'];
                                $dados2['cliente_pre_cadastro']['parentesco_refer_1'] = $parentesco_ref1 = $_POST['parentesco_ref1'];
                                $dados2['cliente_pre_cadastro']['fone_fixo_refer_1'] = $ref1_phone = $_POST['ref1_phone'];
                                $dados2['cliente_pre_cadastro']['fone_celular_refer_1'] = $ref1_cel = $_POST['ref1_cel'];
                                $dados2['cliente_pre_cadastro']['nome_referencia_2'] = $referencia2 = $_POST['referencia2'];
                                $dados2['cliente_pre_cadastro']['parentesco_refer_2'] = $parentesco_ref2 = $_POST['parentesco_ref2'];
                                $dados2['cliente_pre_cadastro']['fone_fixo_refer_2'] = $ref2_phone = $_POST['ref2_phone'];
                                $dados2['cliente_pre_cadastro']['fone_celular_refer_2'] = $ref2_cel = $_POST['ref2_cel'];
                                $dados2['cliente_pre_cadastro']['nome_referencia_3'] = $referencia3 = $_POST['referencia3'];
                                $dados2['cliente_pre_cadastro']['parentesco_refer_3'] = $parentesco_ref3 = $_POST['parentesco_ref3'];
                                $dados2['cliente_pre_cadastro']['fone_fixo_refer_3'] = $ref3_phone = $_POST['ref3_phone'];
                                $dados2['cliente_pre_cadastro']['fone_celular_refer_3'] = $ref3_cel = $_POST['ref3_cel'];
                                $dados2['cliente_pre_cadastro']['observacoes'] = $mensagem = $_POST['mensagem'];


                                //$sql_oracle = "INSERT INTO cliente_pre_cadastro (codigo,nome,cpf,numero_rg,data_nascimento,endereco,compl_endereco,cep,bairro,cidade,estado,telefone_fixo,telefone_recado,telefone_celular,email,indicador_cartao,produtos_vende,valor_venda_mes,nome_referencia_1,parentesco_refer_1,fone_fixo_refer_1,fone_celular_refer_1,nome_referencia_2,parentesco_refer_2,fone_fixo_refer_2,fone_celular_refer_2,nome_referencia_3,parentesco_refer_3,fone_fixo_refer_3,fone_celular_refer_3,observacoes)                                VALUES (17,'Marcone Lima','333.333.333-33','MG-11.111.111',TO_DATE('1981-02-26','YYYY-MM-DD'),'Teste de rua - 100','Casa','33.600-000','Andyara','Pedro Leopoldo','MG','(31) 3333-3333','(31) 4444-4444','(31) 3333-33333','marcone.lima@gmail.com','s','tetse',12000.00,'Teste 1','teste','(33) 3333-3333','(33) 3333-3333','teste 2','tetse 2','(34) 4444-44444','(44) 4444-44444','teste 3','tetse 3','(33) 3333-33333','(33) 3333-33333','teste de teste de pre-cadastro.')";

                                //$conecta2->selecionar($conecta2->conn, $sql_oracle);
                                $conecta2->inserir($dados2);

                                $date = date("d/m/Y h:i");

                                // FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
                                $assunto =  "Pré-cadastro - ".$nome;
                                $cabecalho_da_mensagem_original="From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
                                $configuracao_da_mensagem_original="<strong>Campos do e-mail:</strong><br>
                                <br>
                                De: ".$nome."<br>
                                Responder para: ".$email."<br>
                                Assunto: Pré-cadastro: <br>
                                <br>
                                <strong>Texto da mensagem:</strong><br>
                                <br>
                                Prezado(a) ".$rs_configuracao['nomeloja'].",<br>
                                Foi enviada a seguinte mensagem pelo site:<br>
                                <br>
                                ".stripcslashes($mensagem)."<br>
                                <br>
                                Enviada em $date por:<br>
                                <br>
                                <strong>Nome:</strong> $nome<br>
                                <strong>CPF:</strong> $cpf<br>
                                <strong>RG:</strong> $rg<br>
                                <strong>Data Nascimento:</strong>".$data_nasc."<br>
                                <br>
                                <strong>Endereço:</strong> $endereco<br>
                                <strong>Número:</strong> $numero<br>
                                <strong>CEP:</strong> $cep<br>
                                <strong>Bairro:</strong> $bairro<br>
                                <strong>Cidade:</strong> $cidade<br>
                                <strong>Estado:</strong> $estado<br>
                                <br>
                                <strong>DDD + Telefone:</strong> $phone<br>
                                <strong>DDD + Celular:</strong> $cel<br>
                                <strong>E-mail:</strong> $email<br>
                                <br>
                                <strong>Possui cartão:</strong> ".($cartao == 's' ? 'Sim' : 'Não')."<br>
                                <strong>O que vende:</strong> $oquevende<br>
                                <strong>Quanto vende:</strong> $quantovende<br>
                                <br>
                                <strong>Referência 1:</strong> $referencia1<br>
                                <strong>Parentesco:</strong> $parentesco_ref1<br>
                                <strong>DDD + Telefone:</strong> $ref1_phone<br>
                                <strong>DDD + Celular:</strong> $ref1_cel<br>
                                <br>
                                <strong>Referência 2:</strong> $referencia2<br>
                                <strong>Parentesco:</strong> $parentesco_ref2<br>
                                <strong>DDD + Telefone:</strong> $ref2_phone<br>
                                <strong>DDD + Celular:</strong> $ref2_cel<br>
                                <br>
                                <strong>Referência 3:</strong> $referencia3<br>
                                <strong>Parentesco:</strong> $parentesco_ref3<br>
                                <strong>DDD + Telefone:</strong> $ref3_phone<br>
                                <strong>DDD + Celular:</strong> $ref3_cel<br>
                                ";

                                //CRIAÇÃO DE ARQUIVO PDF COM OS DADOS DO USUÁRIO QUE REALIZOU O PRE-CADASTRO
                                $html_pdf = "<span style='font-size:16px !important;'>".$configuracao_da_mensagem_original."</span>";
                                $mpdf=new mPDF('pt','A4',8,'',10,10,2,10,9,9,'P');
                                $mpdf->WriteHTML($html_pdf);
                                $mpdf->Output('arquivos/precadastro_'.$cpf.'.pdf');

                                $cartaoarq = ($cartao == 's' ? 'Sim' : 'Não');
                                $conteudoarquivo = $nome."\n".$cpf."\n".$rg."\n".$data_nasc."\n".$endereco."\n".$numero."\n".$cep."\n".$bairro."\n".$cidade."\n".$estado."\n".$phone."\n".$cel."\n".$email."\n".$cartaoarq."\n".$oquevende."\n".$quantovende."\n".$referencia1."\n".$parentesco_ref1."\n".$ref1_phone."\n".$ref1_cel."\n".$referencia2."\n".$parentesco_ref2."\n".$ref2_phone."\n".$ref2_cel."\n".$referencia3."\n".$parentesco_ref3."\n".$ref3_phone."\n".$ref3_cel."\n".stripcslashes($mensagem);



                                // Abre ou cria o arquivo bloco1.txt
                                // "a" representa que o arquivo é aberto para ser escrito
                                $fp = fopen("arquivos/precadastro_".$cpf.".txt", "w");

                                // Escreve "exemplo de escrita" no bloco1.txt
                                $escreve = fwrite($fp, $conteudoarquivo);

                                // Fecha o arquivo
                                fclose($fp);


                                $configuracao_da_mensagem_original .= "<br>
                                Industria Sacramento
                                
                                ";

                                //ENVIO DE MENSAGEM ORIGINAL
                                $arq = 'arquivos/precadastro_'.$cpf.'.txt';

                                $fp = fopen($arq,"r");
                                $anexo = fread($fp,filesize($arq));
                                $anexo = base64_encode($anexo);

                                fclose($fp);

                                $anexo = chunk_split($anexo);

                                $boundary = "XYZ-" . date("dmYis") . "-ZYX";

                                $mens = "--$boundary\n";
                                $mens .= "Content-Transfer-Encoding: 8bits\n";
                                $mens .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
                                $mens .= "$configuracao_da_mensagem_original\n";
                                $mens .= "--$boundary\n";
                                $mens .= "Content-Type: PDF\n";
                                $mens .= "Content-Disposition: attachment; filename=\"".$arq."\"\n";
                                $mens .= "Content-Transfer-Encoding: base64\n\n";
                                $mens .= "$anexo\n";
                                $mens .= "--$boundary--\r\n";

                                $headers  = "MIME-Version: 1.0\n";
                                $headers .= "$cabecalho_da_mensagem_original";
                                $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
                                $headers .= "$boundary\n";


                                //print_r($rs_configuracao['emailloja'].", ".$assunto.", ".$configuracao_da_mensagem_original.", ".$headers);
                                if(mail($rs_configuracao['emailloja'],$assunto,$mens,$headers)){

                                    echo "<script>alert('Dados enviados com sucesso. Aguarde nosso contato!!!');</script>";

                                    echo '<div class="alert alert-success">Dados enviados com sucesso. Aguarde nosso contato!!!</div>';

                                    //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
                                    $assunto_da_mensagem_de_resposta = "Recebemos sua mensagem - Pré-cadastro";
                                    $cabecalho_da_mensagem_de_resposta = "From: ".$rs_configuracao['nomeloja']." <".$rs_configuracao['emailloja'].">\n";
                                    $configuracao_da_mensagem_de_resposta="Prezado(a) ".$name.",<br>
                                    Obrigado por entrar em contato, sua mensagem foi enviada para ".$rs_configuracao['nomeloja'].".<br>
                                    Em breve lhe responderemos.<br>
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
                                    unset($nome,$cpf, $rg, $data_nasc, $endereco, $numero, $complemento, $cep, $bairro, $cidade, $estado, $phone, $cel, $tel_recado, $email, $cartao, $oquevende, $quantovende, $referencia1, $parentesco_ref1, $ref1_phone, $ref1_cel, $referencia2, $parentesco_ref2, $ref2_phone, $ref2_cel, $referencia3, $parentesco_ref3, $ref3_phone, $ref3_cel, $mensagem);

                                } else {
                                    echo '<div class="alert alert-danger">Problema ao enviar mensagem!</div>';
                                }
                            } else {
                                echo $retorno;
                            }

                        }


                        ?>

                        <fieldset>
                            <legend>Pré Cadastro</legend>
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Nome Completo *</span>
                                <input type="text" name="nome" id="nome" size="30" value="<?php echo @$nome;?>" placeholder="Nome Completo *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>CPF (somente números) *</span>
                                <input type="text" name="cpf" id="cpf" size="30" value="<?php echo @$cpf;?>" placeholder="CPF (somente números) *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>RG (alfa-numérico) *</span>
                                <input type="text" name="rg" id="rg" size="30" value="<?php echo @$rg;?>" placeholder="RG (alfa-numérico) *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Data de Nascimento *</span>
                                <input type="text" name="data_nasc" id="data_nasc" size="30" value="<?php echo @$data_nasc;?>" placeholder="Data de Nascimento *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Endereço (rua, avenida) *</span>
                                <input type="text" name="endereco" id="endereco" size="30" value="<?php echo @$endereco;?>" placeholder="Endereço (rua, avenida) *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-4 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>N° *</span>
                                <input type="text" name="numero" id="numero" size="10" value="<?php echo @$numero;?>" placeholder="N° *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-8 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Complemento</span>
                                <input type="text" name="complemento" id="complemento" size="30" value="<?php echo @$complemento;?>" placeholder="Complemento" class="form-control placeholder" />

                            </div>
                        </div>


                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>CEP *</span>
                                <input type="text" name="cep" id="cep" size="30" value="<?php echo @$cep;?>" placeholder="CEP *" class="form-control placeholder" />

                            </div>
                        </div>

                          <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Bairro *</span>
                                <input type="text" name="bairro" id="bairro" size="30" value="<?php echo @$bairro;?>" placeholder="Bairro *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Cidade *</span>
                                <input type="text" name="cidade" id="cidade" size="30" value="<?php echo @$cidade;?>" placeholder="Cidade *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Estado *</span>
                                <select name="estado" id="estado" class="form-control placeholder">
                                    <option selected value="MG" >Minas Gerais</option>
                                </select>

                            </div>
                        </div>


                        <div class="col-sm-12 af-outer ">
                            <div class="form-group af-inner">
                                <span>DDD + Telefone Fixo *</span>
                                <input type="text" name="phone" id="telefone" size="30" value="<?php echo @$phone;?>" placeholder="DDD + Telefone Fixo *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer ">
                            <div class="form-group af-inner">
                                <span>DDD + Celular *</span>
                                <input type="text" name="cel" id="celular" size="30" value="<?php echo @$cel;?>" placeholder="DDD + Celular *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer ">
                            <div class="form-group af-inner">
                                <span>DDD + Telefone de Recado</span>
                                <input type="text" name="tel_recado" id="phone" size="30" value="<?php echo @$tel_recado;?>" placeholder="DDD + Telefone de Recado" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>E-mail *</span>
                                <input type="email" name="email" id="email" size="30" value="<?php echo @$email;?>" placeholder="E-mail@dominio.com" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Possui cartão de crédito?</span>
                                <select name="cartao" id="cartao" class="form-control placeholder">
                                    <option selected value="Possui cartão de crédito?">Possui cartão de crédito?</option>
                                    <option value="s" <?php if(@$cartao == 's') { echo "selected"; }?>>Sim</option>
                                    <option value="n" <?php if(@$cartao == 'n') { echo "selected"; }?>>Não</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>O que vende? *</span>
                                <input type="text" name="oquevende" id="oquevende" size="30" value="<?php echo @$oquevende;?>" placeholder="O que vende? *" class="form-control placeholder" />

                            </div>
                        </div>
                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Quanto vende por mês? *</span>
                                <input type="text" name="quantovende" id="quantovende" size="30" value="<?php echo @$quantovende;?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" placeholder="Quanto vende por mês? *" class="form-control placeholder" />

                            </div>
                        </div>



                        <!-- referencia 1 -->
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>1ª - Referência Pessoal - Nome *</span>
                                <input type="text" name="referencia1" id="referencia1" size="30" value="<?php echo @$referencia1;?>" placeholder="1ª - Referência Pessoal - Nome *" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Parentesco *</span>
                                <input type="text" name="parentesco_ref1" id="parentesco_ref1" size="30" value="<?php echo @$parentesco_ref1;?>" placeholder="Parentesco *" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer coluna_campo">
                            <div class="form-group af-inner">
                                <span>DDD + Telefone Fixo *</span>
                                <input type="text" name="ref1_phone" id="tel" size="30" value="<?php echo @$ref1_phone;?>" placeholder="DDD + Telefone Fixo *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer coluna_campo">
                            <div class="form-group af-inner">
                                <span>DDD + Celular *</span>
                                <input type="text" name="ref1_cel" id="cel" size="30" value="<?php echo @$ref1_cel;?>" placeholder="DDD + Celular *" class="form-control placeholder" />

                            </div>
                        </div>

                        <!-- referencia 2 -->
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>2ª - Referência Pessoal - Nome *</span>
                                <input type="text" name="referencia2" id="referencia2" size="30" value="<?php echo @$referencia2;?>" placeholder="2ª - Referência Pessoal - Nome *" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Parentesco *</span>
                                <input type="text" name="parentesco_ref2" id="parentesco_ref2" size="30" value="<?php echo @$parentesco_ref2;?>" placeholder="Parentesco *" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer coluna_campo">
                            <div class="form-group af-inner">
                                <span>DDD + Telefone Fixo *</span>
                                <input type="text" name="ref2_phone" id="tel2" size="30" value="<?php echo @$ref2_phone;?>" placeholder="DDD + Telefone Fixo *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer coluna_campo">
                            <div class="form-group af-inner">
                                <span>DDD + Celular *</span>
                                <input type="text" name="ref2_cel" id="cel2" size="30" value="<?php echo @$ref2_cel;?>" placeholder="DDD + Celular *" class="form-control placeholder" />

                            </div>
                        </div>

                        <!-- referencia 3 -->
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>3ª - Referência Pessoal - Nome *</span>
                                <input type="text" name="referencia3" id="referencia3" size="30" value="<?php echo @$referencia3;?>" placeholder="3ª - Referência Pessoal - Nome *" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Parentesco *</span>
                                <input type="text" name="parentesco_ref3" id="parentesco_ref3" size="30" value="<?php echo @$parentesco_ref3;?>" placeholder="Parentesco *" class="form-control placeholder" />

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer coluna_campo">
                            <div class="form-group af-inner">
                                <span>DDD + Telefone Fixo *</span>
                                <input type="text" name="ref3_phone" id="tel3" size="30" value="<?php echo @$ref3_phone;?>" placeholder="DDD + Telefone Fixo *" class="form-control placeholder" />

                            </div>
                        </div>

                        <div class="col-sm-12 af-outer coluna_campo">
                            <div class="form-group af-inner">
                                <span>DDD + Celular *</span>
                                <input type="text" name="ref3_cel" id="cel3" size="30" value="<?php echo @$ref3_cel;?>" placeholder="DDD + Celular *" class="form-control placeholder" />

                            </div>
                        </div>

                         <div class="col-sm-12 af-outer af-required ">
                            <div class="form-group af-inner">
                                <span>Fale de forma breve sobre seu interesse e experiência com vendas *</span>
                                <textarea name="mensagem" id="mensagem" cols="" rows="6" placeholder="Fale de forma breve sobre seu interesse e experiência com vendas *" class="form-control placeholder" ><?php echo @$mensagem;?></textarea>

                            </div>
                        </div>
                        <div class="col-sm-12 af-outer af-required">
                            <div class="form-group af-inner">
                                <div class="g-recaptcha" data-sitekey="6Leu2QcUAAAAAOxgPZQJc3PkoLKE4LEJhNNgeRON" style="float:left; margin-bottom:1%; margin-right:3%; margin-left:0%;"></div>
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
