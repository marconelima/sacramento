        <?php if($rs_configuracao['container_newsletter'] > 0) { ?>
        <?php include "newsletter.php";?>
        <?php } ?>

    </div><!-- /.content-area -->
    <!-- /Content area -->



<?php
    $sql_pra = "SELECT * FROM tbtela "
?>

<!-- Footer -->
    <footer class="footer">
    <?php if($rs_configuracao['container_rodape'] > 0) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12" data-animation="fadeInUp" data-animation-delay="100">
					<div class="widget">
                        <img class="footer-logo" src="<?php echo $rs_configuracao['logorodape'];?>"  alt="" />
                    </div>
                    <div class="widget">
                    	<?php if($rs_configuracao['facebook'] != ''){ ?><a href="<?php echo $rs_configuracao['facebook'];?>"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a><?php } ?>
                        <?php if($rs_configuracao['twitter'] != ''){ ?><a href="<?php echo $rs_configuracao['twitter'];?>"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a><?php } ?>
                        <?php if($rs_configuracao['googleplus'] != ''){ ?><a href="<?php echo $rs_configuracao['googleplus'];?>"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a><?php } ?>
                        <?php if($rs_configuracao['linkedin'] != ''){ ?><a href="<?php echo $rs_configuracao['linkedin'];?>"><i id="social-li" class="fa fa-linkedin-square fa-3x social"></i></a><?php } ?>
                        <?php if($rs_configuracao['instagram'] != ''){ ?><a href="<?php echo $rs_configuracao['instagram'];?>"><i id="social-in" class="fa fa-instagram fa-3x social"></i></a><?php } ?>
                        <?php if($rs_configuracao['pinterest'] != ''){ ?><a href="<?php echo $rs_configuracao['pinterest'];?>"><i id="social-pi" class="fa fa-pinterest-square fa-3x social"></i></a><?php } ?>
                    </div>

                </div>
                <div class="col-md-3 col-sm-6 col-xs-12" data-animation="fadeInUp" data-animation-delay="500">
                    <div class="widget">
                        <h4 class="title">Nossa Loja</h4>
                        <address>
                            <ul class="address-ul fa-ul">
                                <li>
                                   <i class="fa-li fa fa-home" style="color:#25a8ba !important;"></i>
                                    <p><?php echo $rs_configuracao['enderecoloja'];?></p>
                                </li>
                                <?php if($rs_configuracao['whatsapp'] != '') { ?>
                                <li style="color:#25a8ba !important;"><i class="fa-li fa fa-whatsapp" style="color:#25a8ba !important;"></i><?php echo $rs_configuracao['whatsapp']." | ".$rs_configuracao['whatsapp2'];?></li>
                                <?php } ?>
								<li style="color:#25a8ba !important;">
									<i class="fa-li fa fa-phone" style="color:#25a8ba !important;"></i>
                                    <?php echo $rs_configuracao['telefoneloja']." ".$rs_configuracao['telefoneloja2'];?>
								</li>
								<li style="color:#25a8ba !important;"><i class="fa-li fa fa-envelope" style="color:#25a8ba !important;"></i><?php echo $rs_configuracao['emailloja'];?></li>
                                <li style="color:#25a8ba !important;"><i class="fa-li fa fa-map-marker" style="color:#25a8ba !important;"></i><a href='<?php echo $siteUrl;?>fale-conosco/36#localization'>Ver no mapa</a></li>
                            </ul>
                        </address>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12" data-animation="fadeInUp" data-animation-delay="300">
                    <div class="widget mais-auto">
                        <h4 class="title">Mais <?php echo $rs_configuracao['nomeloja'];?></h4>

                        <ul class="tagcloud">
                        <li><a href="<?php echo $siteUrl;?>">home</a></li>
                        <li><a href="<?php echo $siteUrl;?>quem_somos/10">sobre nós</a></li>
                        <li><a href="<?php echo $siteUrl;?>fale-conosco/36">fale conosco</a></li>
                        <li><a href="<?php echo $siteUrl;?>parceiro/15">parceiros</a></li>
                        <li><a href="<?php echo $siteUrl;?>catalogo/21">catálogo</a></li>
                        <li><a href="<?php echo $siteUrl;?>trabalhe-conosco/38">trabalhe conosco</a></li>
                        </ul>


                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12" data-animation="fadeInUp" data-animation-delay="300">
                    <div class="widget latest-news">
                        <h4 class="title">NOSSO CATÁLOGO</h4>
                        <a href="http://industriasacramento.com.br/documentos/catalogo_sacramento.pdf" target="_blank">
                               <img src="<?php echo $siteUrl;?>imagens/banner-bfb538ba95222bb4fc748e602b9d8e28.jpg" style="width:100%;" border="0" />
                        </a>

                    </div>
                </div>
            </div>
        </div><!-- / widgets container -->

        <!-- copyrights -->
         <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6"><p style="color:#FFFFFF;"><?php echo $rs_configuracao['copyright'];?></p></div>
                    <div class="col-sm-6 text-right">
                        <p><a href="http://www.marconelima.com.br/" target="_blank" style="color:#FFFFFF;"><img src="<?php echo $siteUrl2?>/images/ml.png" height="18" style="height:18px;" /></a><p>
                    </div>
                </div>
            </div>
        </div><!-- /.copyrights -->
    <?php } ?>
    </footer>
    <!-- /Footer -->

    <div class="totop"><i class="fa fa-angle-up"></i></div>


    <!-- Modal Register and Login -->
    <div class="modal modal-log-reg fade" id="ModalLembrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="ModalLabelL">Por favor, informe seu e-mail</h4>
                </div>
                <div class="modal-body">
                    <p>  </p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Email</label>
                            <input id="txtEmail" class="form-control" name="email" required="required" type="email" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success pull-right" type="submit" name="enviar" value="Lembrar">Enviar</button>
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

    <!-- Modal Register and Login -->
    <div class="modal modal-log-reg fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="ModalLabelL">Por favor, entre na sua conta</h4>
                </div>
                <div class="modal-body">
                    <p>  </p>
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
                                <button class="btn btn-success pull-right" type="submit" name="entrar" value="Login">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Esqueceu a senha? <a href="#" data-toggle="modal" data-dismiss="modal" aria-hidden="true" data-target="#ModalLembrar">Clique aqui para recupera-la.</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-log-reg fade" id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="ModalLabelR">Meu Cadastro</h4>
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
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" required="required" id="regPassword" class="form-control" name="regpassword" placeholder="" onchange="form.regrepeatpassword.pattern = this.value;">
                        </div>
                        <div class="form-group">
                            <label>Repetir a Senha</label>
                            <input type="password" required="required" id="regRepeatPassword" class="form-control" name="regrepeatpassword" placeholder="">
                        </div>
						<div class="form-group">
                            <label>DDD + Telefone</label>
                            <input class="form-control" required="required" name="regphone" id="phone" placeholder="">
                        </div>
						<div class="form-group">
                            <label>DDD + Celular</label>
                            <input class="form-control" required="required" name="regcellphone" id="cellphone" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Whatsapp</label>
                            <input class="form-control" required="required" name="whatsapp" id="cellphone" placeholder="">
                        </div>
						<div class="form-group">
                            <label>Cidade/Estado</label>
                            <input type="text" id="regCity-Estate" required="required" class="form-control" name="regcidade" placeholder="">
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="fechar btn pull-right" data-dismiss="modal" aria-hidden="true">Fechar</button>
                                <button class="btn btn-warning pull-right" type="submit" name="cadastrar" value="cadastrar">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Chegou aqui por engano? <a href="<?php echo $siteUrl;?>">Home</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Register and Login -->

</div>






<?php if($tela != 20){ ?>

<?php } ?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- JS Page Level -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script src="<?php echo $siteUrl2;?>assets/js/galleryFilter.js"></script>

<script src="<?php echo $siteUrl2;?>assets/plugins/jquery.magnific-popup.js"></script>

<script type="text/javascript">
jQuery(document).ready(function () {

    $("#menumobile1").click(function(){
        if($("#menu_mobile").css('display') == 'block'){
            $("#menu_mobile").css('display','none');
        } else {
            $("#menu_mobile").css('display','block');
        }
    });

    $("#celular").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

	$("#cel").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

    $("#cel2").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

    $("#cel3").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

    $("#phone").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
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

        iframe:{
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: 'https://www.youtube.com/embed/%id%'
                },
                vimeo:{
                    index: 'vimeo.com/',
                    id: '/',
                    src: 'https://player.vimeo.com/video/%id%'
                }
            },
            srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
        },
        gallery: {
            enabled:true
        }
    });

});

$(window).load(function(){
    $('.gallery .gall_item').touchTouch();
});
</script>

</body>
</html>
<?php $conecta->desconectar();?>
