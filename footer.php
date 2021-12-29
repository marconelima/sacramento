</main>

<footer class="footer_mobile">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <span class=""><strong>NOSSO CATÁLOGO</strong></span>
                <span><a href="http://industriasacramento.com.br/documentos/catalogo_sacramento.pdf" target="_blank"><img src="/imagens/catálogo Capa.png" alt="" /></a></span>
            </div>

            <div class="col-12 col-lg-4">
                <span class="icones_rodape_endereco"><i class="fas fa-home"></i></span>
                <span class="texto_rodape_endereco">
                    <strong>NOSSO ENDEREÇO</strong><br />
                    Rua General Mascarenhas, 441<br />
                    Novo Progresso<br />
                    32115-090, Contagem, MG <br />
                    <strong>HORÁRIO DE ATENDIMENTO</strong><br />
                    Segunda a Sexta<br />
                    07:00hs - 17:00hs
                </span>

                <span class="icones_rodape"><i class="fas fa-phone"></i></span>
                <span class="texto_rodape"> (31) 3354-8250 </span>

                <span class="icones_rodape"><i class="fas fa-envelope"></i></span>
                <span class="texto_rodape">vendas@industriasacramento.com.br</span>

                <span class="icones_rodape"><i class="fas fa-map-marker-alt"></i></span>
                <span class="texto_rodape"><a href='<?php echo $siteUrl; ?>fale-conosco/36#localization'>Ver no mapa</a></span>
            </div>

            <div class="col-12 col-lg-4">

                <span class="col-4 text-center"><?php if ($rs_configuracao['instagram'] != '') { ?><a href="<?php echo $rs_configuracao['instagram']; ?>" target="_blank"><i class="fab fa-instagram-square fonte-40"></i></a><?php } ?></span>
                <span class="col-4 text-center"><?php if ($rs_configuracao['facebook'] != '') { ?><a href="<?php echo $rs_configuracao['facebook']; ?>" target="_blank"><i class="fab fa-facebook-square fonte-40"></i></a><?php } ?></span>
                <span class="col-4 text-center"><?php if ($rs_configuracao['whatsapp'] != '') { ?><a href="https://api.whatsapp.com/send?phone=5531985848250&text=Ol%C3%A1,%20Ind%C3%BAstria%20Sacramento!%20Pode%20me%20ajudar%3F" target="_blank"><i class="fab fa-whatsapp-square fonte-40"></i></a><?php } ?></span>
            </div>

            <div class="col-12">
                <span class="text-center mt-4">&copy; 2020 - INDUSTRIA SACRAMENTO - TODOS OS DIREITOS RESERVADOS</span>
            </div>

        </div>
    </div>
</footer>

<footer class="footer_computer">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-12 col-lg-4">
                <span><img src="/images/Sacramento Icon.png" class="logo_rodape" style="margin:0;" alt="" /></span>
                <span class="texto_rodape_endereco">A vassoura do momento</span>
                <span class="texto_rodape_endereco">Há mais de 25 anos oferecendo produtos de qualidade para o seu negócio.
                    Qualidade, durabilidade e preço justo são nossos valores.
                </span>
                <span class="texto_rodape_endereco">Solicite um orçamento via Whatsapp.</span>

                <span class="col-4 text-left" style="padding-left:0;"><?php if ($rs_configuracao['instagram'] != '') { ?><a href="<?php echo $rs_configuracao['instagram']; ?>" target="_blank"><img src="/images/instagram2.png"></a><?php } ?></span>
                <span class="col-4 text-left" style="padding-left:0;"><?php if ($rs_configuracao['facebook'] != '') { ?><a href="<?php echo $rs_configuracao['facebook']; ?>" target="_blank"><img src="/images/facebook2.png"></a><?php } ?></span>
                <span class="col-4 text-left" style="padding-left:0;"><?php if ($rs_configuracao['whatsapp'] != '') { ?><a href="https://api.whatsapp.com/send?phone=5531985848250&text=Ol%C3%A1,%20Ind%C3%BAstria%20Sacramento!%20Pode%20me%20ajudar%3F" target="_blank"><img src="/images/whatsapp.png"></a><?php } ?></span>
            </div>

            <div class="col-12 col-lg-4">
                <span class="icones_rodape_endereco"><i class="fas fa-home"></i></span>
                <span class="texto_rodape_endereco">
                    <strong>NOSSO ENDEREÇO</strong><br />
                    <?php echo $rs_configuracao['enderecoloja']; ?><br /><br />
                    <strong>HORÁRIOS DE ATENDIMENTO:</strong><br />
                    De Segunda à Sexta<br />
                    Das 07:00h às 17:00hs.
                </span>

                <span class="icones_rodape"><i class="fab fa-whatsapp"></i></span>
                <span class="texto_rodape"><?php echo $rs_configuracao['whatsapp'] . " | " . $rs_configuracao['whatsapp2']; ?></span>

                <span class="icones_rodape"><i class="fas fa-phone"></i></span>
                <span class="texto_rodape"><?php echo $rs_configuracao['telefoneloja'] . " " . $rs_configuracao['telefoneloja2']; ?></span>

                <span class="icones_rodape"><i class="fas fa-envelope"></i></span>
                <span class="texto_rodape"><?php echo $rs_configuracao['emailloja']; ?></span>

                <span class="icones_rodape"><i class="fas fa-map-marker-alt"></i></span>
                <span class="texto_rodape"><a href='<?php echo $siteUrl; ?>fale-conosco/36#localization'>Ver no mapa</a></span>
            </div>

            <div class="col-12 col-lg-3 catalogo">
                <span class=""><strong>NOSSO CATÁLOGO</strong></span>
                <span><a href="http://industriasacramento.com.br/documentos/catalogo_sacramento.pdf" target="_blank"><img src="/imagens/catálogo Capa.png" alt="Catálogo Industria Sacramento" /></a></span>
            </div>
            <div class="col-1"></div>

            <div class="col-12">
                <span class="text-center mt-4">&copy; 2020 - INDUSTRIA SACRAMENTO - TODOS OS DIREITOS RESERVADOS</span>
            </div>
        </div>
    </div>
</footer>

<!--  <div class="totop"><i class="fa fa-angle-up"></i></div> -->

<!-- Modal Register and Login -->
<div class="modal modal-log-reg fade" id="ModalLembrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabelL">Por favor, informe seu e-mail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p> </p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input id="txtEmail2" class="form-control" name="email" required="required" type="email" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; float:right;' type="submit" name="enviar" value="Lembrar">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Será enviada uma nova senha para o seu e-mail!</a></p>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-log-reg fade" id="ModalArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabelL">Dados do usuário</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p> </p>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="sair" id="sair" value="1" />
                    <div class="form-group">
                        <label>Nome</label>
                        <?php echo $_SESSION['nome_cliente']; ?><br />
                        <?php echo $_SESSION['cpf_cliente']; ?><br />
                        <?php echo $_SESSION['email_cliente']; ?><br />
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; float:right;' type="submit" name="enviar" value="Sair">Sair</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal Register and Login -->
<div class="modal modal-log-reg fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabelL">Por favor, entre na sua conta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <p> </p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input id="txtEmail" class="form-control" name="email" required="required" type="email" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input id="txtPassword" class="form-control" name="senha" required="required" type="password" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; float:right;' type="submit" name="entrar" value="Login">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Esqueceu a senha? <a href="#" data-toggle="modal" data-dismiss="modal" aria-hidden="true" data-target="#ModalLembrar">Clique aqui para recupera-la.</a></p>
                <p class="d-flex align-items-center">Não possui uma conta?<a href="#" data-toggle="modal" data-dismiss="modal" aria-hidden="true" data-target="#ModalRegister"> <button class="btn btn-secondary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; float: right; margin-left:5px;' type="button" name="cadastrar" value="Cadastrar">Cadastrar</button></a></p>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-log-reg fade" id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border: 0; padding-bottom: 0;">
                <h4 class="modal-title" id="ModalLabelR">Meu Cadastro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-header" style="padding-top: .5rem;">
                <small>Após se cadastrar você terá acesso a todas as ferramentas</small>
            </div>

            <div class="modal-body">
                <p></p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" required="required" id="regName" class="form-control" name="regname" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" required="required" id="regEmail" class="form-control" name="regemail" placeholder="">
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Senha</label>
                            <input type="password" required="required" id="regPassword" class="form-control" name="regpassword" placeholder="" onchange="form.regrepeatpassword.pattern = this.value;">
                        </div>
                        <div class="form-group col-6">
                            <label>Repetir a Senha</label>
                            <input type="password" required="required" id="regRepeatPassword" class="form-control" name="regrepeatpassword" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-4">
                            <label>CPF / CNPJ</label>
                            <input class="form-control" required="required" name="cnpj" id="nucnpj" placeholder="">
                        </div>
                        <div class="form-group  col-4">
                            <label>DDD + Telefone</label>
                            <input class="form-control" required="required" name="regphone" id="phone" placeholder="">
                        </div>

                        <div class="form-group  col-4">
                            <label>DDD + Celular</label>
                            <input class="form-control" required="required" name="regcellphone" id="cellphone" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-8">
                            <label>Logradouro</label>
                            <input type="text" id="estado" required="required" class="form-control" name="estado" placeholder="">
                        </div>

                        <div class="form-group  col-4">
                            <label>Número</label>
                            <input type="text" id="estado" required="required" class="form-control" name="estado" placeholder="">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group  col-6">
                            <label>Bairro</label>
                            <input type="text" id="estado" required="required" class="form-control" name="estado" placeholder="">
                        </div>

                        <div class="form-group  col-6">
                            <label>CEP</label>
                            <input type="text" id="cep" required="required" class="form-control" name="cep" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-6">
                            <label>Cidade</label>
                            <input type="text" id="regCity-Estate" required="required" class="form-control" name="regcidade" placeholder="">
                        </div>

                        <div class="form-group  col-6">
                            <label>Estado</label>
                            <input type="text" id="estado" required="required" class="form-control" name="estado" placeholder="">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="fechar btn btn-secondary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; float:right;' data-dismiss="modal" aria-hidden="true">Voltar para o login</button>
                            <button class="btn btn-primary pull-right" style='border-radius:9rem !important; padding: .175rem 1.75rem !important; margin-left:5px!important; float: right;' type="submit" name="cadastrar" value="cadastrar">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Chegou aqui por engano? <a href="<?php echo $siteUrl; ?>">Home</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Modal Register and Login -->

</div>

<div class="modal modal-log-reg fade" id="ModalDetalhe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:1000px;">
        <div class="modal-content">
            <div class="modal-header" style="border: 0; padding-bottom: 0;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="modal-teste">


                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .whatsapp {
        position: fixed;
        bottom: 3%;
        right: 0.5%;
        padding: 10px;
        z-index: 10000000;
    }

    .subirtopo {
        position: fixed;
        bottom: 3%;
        right: 90px;
        z-index: 10000000;
        font-size: 1.5em;
        background: #2ab200;
        border-radius: 10px;
        padding: 8.5px;
        margin-bottom: 10px;
        color: #FFFFFF;
        display: none;
    }
</style>


<a href="#top"><i class="fas fa-chevron-up subirtopo"></i></a>

<?php if ($rs_configuracao['whatsapp'] != '') { ?><a href="https://api.whatsapp.com/send?phone=5531985848250&text=Ol%C3%A1,%20Ind%C3%BAstria%20Sacramento!%20Pode%20me%20ajudar%3F" target="_blank"><img src="/images/whatsapp_icon.png" class="whatsapp"></a><?php } ?>



<script>
    if (document.querySelector(".menubusca")) {
        let menulateral = document.querySelector(".menubusca");
        let corposite = document.querySelector(".content-area");

        if (corposite.scrollHeight < menulateral.scrollHeight) {
            corposite.style.height = menulateral.scrollHeight + "px";
        }
    }

    if (document.querySelector(".subirtopo")) {

        let btntopo = document.querySelector(".subirtopo");

        var alturaTela = document.body.clientHeight;
        var alteraSite = document.body.scrollHeight;

        let scrollcomparacao = 0;
        let i = 0;

        window.addEventListener("scroll", e => {

            let scroll = this.scrollY;

            if (scroll > alturaTela + 10) {

                if (scroll < scrollcomparacao) {
                    btntopo.style.display = 'block';
                } else {
                    btntopo.style.display = 'none';
                }
                scrollcomparacao = scroll;
            } else {
                btntopo.style.display = 'none';
            }
        });

    }
</script>

<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-migrate-3.2.2.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>

<script>
    function getRandomIntInclusive(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    $(function() {
        let REF = this;
        //defina aqui o token gerado após clicar em  "Generate Token"
        const token = "IGQVJWTEtFZA3I4YkhuSTdtSDcwS093VTBzdXRLYjlPYlZAmSnVuVURYRzRDMjdiUDZA5YXlrVnRQT0JOLTNDZA2poYUJGT0dlM3pHczIwZAV9MaFhmTy16MU5pODgtandRNHJjLW9mV09WTkZAGNk5jSVFKNQZDZD";

        const url = 'https://graph.instagram.com/me/media?access_token=' + token + '&fields=media_url,media_type,caption,permalink,children{media_url,thumbnail_url}';
        //percorremos as imagens recebidas
        $.get(url).then(function(response) {

            let images = response.data;

            if (images[0].media_type == 'CAROUSEL_ALBUM' && images[0].children.data.length > 1) {
                console.log(images[0].children.data[1]);
            }

            let images_content = '<div class="row">';
            for (let c = 0; c < 1; c++) {

                let pic = images[c];

                let num = getRandomIntInclusive(0, 1);
                console.log(num);
                let img = '';

                if (images[0].media_type == 'CAROUSEL_ALBUM' && images[0].children.data.length > 1) {
                    if (num == 0) {
                        img = pic.media_url;
                    } else {
                        img = images[0].children.data[1].media_url;
                    }
                } else {
                    img = pic.media_url;
                }

                let caption = pic.caption !== null ? pic.caption : '';
                images_content += '<div class="col-12"><a target="_target" href="' + pic.permalink + '"><img title="' + caption + '" alt="' + caption + '" src="' + img + '"></a></div>';
            }
            images_content += '</div>';
            $('#insta').html(images_content);
        });

    });


    if (document.querySelector("#plus")) {

        let mais = document.querySelector("#plus");

        mais.addEventListener('click', function(e) {

            let qtde = document.querySelector("#qtde_prod");

            document.querySelector("#qtde_prod").value = parseInt(qtde.value) + 1;

        });
    }

    if (document.querySelector("#minus")) {

        let menos = document.querySelector("#minus");

        menos.addEventListener('click', function(e) {

            let qtde = document.querySelector("#qtde_prod");

            if (parseInt(qtde.value) > 0) {
                document.querySelector("#qtde_prod").value = parseInt(qtde.value) - 1;
            }

        });
    }



    $(document).ready(function() {


        <?php
        if (isset($resultado_comentario)) {



            $i = 1;
            while ($rs_comentario = mysqli_fetch_array($resultado_comentario)) { ?>
                $("#comentario_filho<?php echo $i; ?>").click(function() {

                    $("#status_comentario<?php echo $i; ?>").html('<img src="<?php echo $siteUrl; ?>assets/img/carregando.gif" id="loader" />').fadeIn(300);
                    //início ajax jquery
                    var nome = $("#nome<?php echo $i; ?>").val();
                    var email = $("#email<?php echo $i; ?>").val();
                    var cidade = $("#cidade<?php echo $i; ?>").val();
                    var message = $("#message<?php echo $i; ?>").val();
                    var pai = $("#pai<?php echo $i; ?>").val();
                    var tabela = $("#tabela<?php echo $i; ?>").val();
                    var vw = $("#vw<?php echo $i; ?>").val();

                    if (nome == "") {
                        $("#status_comentario<?php echo $i; ?>").fadeOut('slow');
                        $("#status_comentario<?php echo $i; ?>").hide();
                        $("#status_comentario<?php echo $i; ?>").html("<div class='alert alert-danger'>Preencha o Nome!</div>").fadeIn(300);
                    } else if (email == "") {
                        $("#status_comentario<?php echo $i; ?>").fadeOut('slow');
                        $("#status_comentario<?php echo $i; ?>").hide();
                        $("#status_comentario<?php echo $i; ?>").html("<div class='alert alert-danger'>Preencha o E-mail!</div>").fadeIn(300);
                    } else if (cidade == "") {
                        $("#status_comentario<?php echo $i; ?>").fadeOut('slow');
                        $("#status_comentario<?php echo $i; ?>").hide();
                        $("#status_comentario<?php echo $i; ?>").html("<div class='alert alert-danger'>Preencha a Cidade!</div>").fadeIn(300);
                    } else if (message == "") {
                        $("#status_comentario<?php echo $i; ?>").fadeOut('slow');
                        $("#status_comentario<?php echo $i; ?>").hide();
                        $("#status_comentario<?php echo $i; ?>").html("<div class='alert alert-danger'>Preencha o Comentário!</div>").fadeIn(300);
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
                            url: '<?php echo $siteUrl; ?>paginas/comentar.php',
                            cache: false,
                            data: 'acao=getComenta&&dados=' + dados,
                            success: function(formulario) {
                                $("#status_comentario<?php echo $i; ?>").fadeOut('slow');
                                $("#status_comentario<?php echo $i; ?>").hide();
                                $("#status_comentario<?php echo $i; ?>").html(formulario).show().fadeIn('slow');

                                $("#nome<?php echo $i; ?>").val("");
                                $("#email<?php echo $i; ?>").val("");
                                $("#cidade<?php echo $i; ?>").val("");
                                $("#message<?php echo $i; ?>").val("");
                            }
                        });
                    }
                });
        <?php $i++;
            }
        } ?>
        $("#comentario_principal").click(function() {

            $("#status_comentario").html('<img src="<?php echo $siteUrl; ?>assets/img/carregando.gif" id="loader" />').fadeIn(300);
            //início ajax jquery
            var nome = $("#nome").val();
            var email = $("#email").val();
            var cidade = $("#cidade").val();
            var message = $("#message").val();
            var pai = $("#pai").val();
            var tabela = $("#tabela").val();
            var vw = $("#vw").val();

            if (nome == "") {
                $("#status_comentario").fadeOut('slow');
                $("#status_comentario").hide();
                $("#status_comentario").html("<div class='alert alert-danger'>Preencha o Nome!</div>").fadeIn(300);
            } else if (email == "") {
                $("#status_comentario").fadeOut('slow');
                $("#status_comentario").hide();
                $("#status_comentario").html("<div class='alert alert-danger'>Preencha o E-mail!</div>").fadeIn(300);
            } else if (cidade == "") {
                $("#status_comentario").fadeOut('slow');
                $("#status_comentario").hide();
                $("#status_comentario").html("<div class='alert alert-danger'>Preencha a Cidade!</div>").fadeIn(300);
            } else if (message == "") {
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
                    url: '<?php echo $siteUrl; ?>paginas/comentar.php',
                    cache: false,
                    data: 'acao=getComenta&&dados=' + dados,
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



        $('#deixarComentario').click(function() {
            $('#telaComentario').slideToggle();
        });



    });
</script>
<script type="text/javascript">
    $(document).ready(function() {



        loadGallery(true, 'a.thumbnail');

        //This function disables buttons when needed
        function disableButtons(counter_max, counter_current) {
            $('#show-previous-image, #show-next-image').show();
            if (counter_max == counter_current) {
                $('#show-next-image').hide();
            } else if (counter_current == 1) {
                $('#show-previous-image').hide();
            }
        }

        /**
         *
         * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
         * @param setClickAttr  Sets the attribute for the click handler.
         */

        function loadGallery(setIDs, setClickAttr) {
            var current_image,
                selector,
                counter = 0;

            $('#show-next-image, #show-previous-image').click(function() {
                if ($(this).attr('id') == 'show-previous-image') {
                    current_image--;
                } else {
                    current_image++;
                }

                selector = $('[data-image-id="' + current_image + '"]');
                updateGallery(selector);
            });

            function updateGallery(selector) {
                var $sel = selector;
                current_image = $sel.data('image-id');
                $('#image-gallery-caption').text($sel.data('caption'));
                $('#image-gallery-title').text($sel.data('title'));
                $('#image-gallery-image').attr('src', $sel.data('image'));
                disableButtons(counter, $sel.data('image-id'));
            }

            if (setIDs == true) {
                $('[data-image-id]').each(function() {
                    counter++;
                    $(this).attr('data-image-id', counter);
                });
            }
            $(setClickAttr).on('click', function() {
                updateGallery($(this));
            });
        }
    });
</script>


<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- JS Page Level -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script src="<?php echo $siteUrl2; ?>assets/js/galleryFilter.js"></script>

<script src="<?php echo $siteUrl2; ?>assets/plugins/jquery.magnific-popup.js"></script>

<!-- JS Global -->

<!-- <script src="<?php echo $siteUrl2; ?>assets/plugins/jquery-migrate.min.js"></script>-->
<script src="<?php echo $siteUrl2; ?>assets/plugins/modernizr.custom.js"></script>
<!--<script src="<?php echo $siteUrl2; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>-->
<script src="<?php echo $siteUrl2; ?>assets/plugins/superfish/js/superfish.js"></script>
<script src="<?php echo $siteUrl2; ?>assets/plugins/prettyPhoto/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo $siteUrl2; ?>assets/plugins/placeholdem.min.js"></script>

<script type="text/javascript" src="<?php echo $siteUrl2; ?>js/jquery.maskedinput.min.js"></script>
<script src="<?php echo $siteUrl2; ?>assets/plugins/ajax-mail.js"></script>
<!--<script src="<?php echo $siteUrl2; ?>assets/plugins/flexslider/jquery.flexslider-min.js"></script>-->
<script src="<?php echo $siteUrl2; ?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo $siteUrl2; ?>assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo $siteUrl2; ?>assets/plugins/waypoints.min.js"></script>
<script src="<?php echo $siteUrl2; ?>assets/plugins/jquery.stellar.min.js"></script>


<!-- JS Page Level -->
<script src="<?php echo $siteUrl2; ?>assets/plugins/touchTouch.jquery.js"></script>
<script type="text/javascript" src="<?php echo $siteUrl2; ?>assets/js/theme.js"></script>
<script type="text/javascript" src="<?php echo $siteUrl2; ?>assets/js/pages/index.js"></script>
<script type="text/javascript" src="<?php echo $siteUrl2; ?>assets/plugins/jquery.flexisel.js"></script>

<script type="text/javascript" src="<?php echo $siteUrl2; ?>assets/js/custom.js"></script>

<script type="text/javascript" src="<?php echo $siteUrl2; ?>js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo $siteUrl2; ?>Inputmask5/dist/jquery.inputmask.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {

        $('.plus').click(function() {
            $("#qtde_prod").val($("#qtde_prod").val() + 1);
        });
        $('.minus').click(function() {
            if ($("#qtde_prod").val() > 0) {
                $("#qtde_prod").val($("#qtde_prod").val() - 1);
            }
        });

        $("#menumobile1").click(function() {
            if ($("#menu_mobile").css('display') == 'block') {
                $("#menu_mobile").css('display', 'none');
            } else {
                $("#menu_mobile").css('display', 'block');
            }
        });

        $("#celular").mask("(99) 9999-9999?9")
            .focusout(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });

        $("#cel").mask("(99) 9999-9999?9")
            .focusout(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });

        $("#cel2").mask("(99) 9999-9999?9")
            .focusout(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });

        $("#cel3").mask("(99) 9999-9999?9")
            .focusout(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });

        $("#phone").mask("(99) 9999-9999?9")
            .focusout(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });

        $("#telefone").mask("(99) 9999-9999");
        $("#tel").mask("(99) 9999-9999");
        $("#tel2").mask("(99) 9999-9999");
        $("#tel3").mask("(99) 9999-9999");

        $('#cpf').mask('999.999.999-99');
        $('#cnpj').mask('99.999.999/9999-99');

        $("input[id*='nucnpj']").inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true
        });

        $('#cep').mask('99.999-999');
        $('#data_nasc').mask('99/99/9999');

        theme.init();
        theme.initIsotope();
        theme.initTestimonials();
        theme.initLastTweet();
        theme.initFlexSlider();
        theme.initAnimation();
        theme.initLatestNews();
        theme.initPartnerSlider();
        theme.initGoogleMap();

        theme.initAccordion();
        theme.initParallax();


        $('.gall_item2').magnificPopup({
            type: 'iframe',

            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: 'https://player.vimeo.com/video/%id%'
                    }
                },
                srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            },
            gallery: {
                enabled: true
            }
        });

    });

    $(window).load(function() {
        $('.gallery .gall_item').touchTouch();
    });
</script>



</body>

</html>
<?php $conecta->desconectar(); ?>