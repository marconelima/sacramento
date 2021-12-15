<style type="text/css">

body {color:#000000;}

/* Geral */

.header-contact-info{
	width: 100%;
	background-color: <?php echo $rs_configuracao['barra_cabecalho'];?> !important; /*#474747*/
	color: white;
	top: 0;
	left: 0;
	z-index:101;
	height: 41px;
}
.header {background: <?php echo $rs_configuracao['fundo_cabecalho'];?> !important;}

.header-contact-info p{
	margin: 0;
}

.header-contact-info p span{
	margin: 10px 20px;
}

.header-contact-info p span i{
	margin: 15px 10px;
}

#sticky_logo{
	display: none;
	margin-top:7px;
}

@media (max-width: 640px) {
	#sticky_logo{margin-top:15px;}
}


.no-top-padding{
	padding-top: 0 !important;
}

/*finalizar */
.modal-body .secaoE {
  float: left;
  width:260px;
}
.modal-body .secaoD {
  float: right;
}
.titulo_cadastro{font-weight:bold;font-size:16px;}
.fechar{background-color:#999!important;}
/* /Geral */


/* Home */

#search_form{
	padding: 20px 10px 10px;
	margin: 0;
	max-width: 900px;
	width: 100%;
	background-color: #333333;
	overflow: hidden;
	position: fixed;
	top: -250px;
	right: 260px;
	z-index: 100;
	display: block;
}
#search_form .col-sm-2{margin-right:30px;}

@media (max-width: 1200px){
	#search_form {
		right: 0;
	}
}

#search_form .form-control ::-webkit-input-placeholder, #search_form .form-control :-moz-input-placeholder,  #search_form .form-control ::-moz-input-placeholder, #search_form .form-control :-ms-input-placeholder{
   color: #000 !important;
}

#manufacturers li img{
    max-width:100px;
	max-height: 45px;
}

.banner-full {
	padding: 0;
	margin: 0;
	width: 100%;
}

.banner-half {
	padding: 0;
	margin: 5px;
	width: 545px;
	max-width: 100%;
	min-height: 93px;
	float: left;
}

.banner {
	width: 100%;
	height: auto;
}

/* /Home */

/* Catalogo */

.pull-right p{
	margin-right: 10px;
	display: inline-block;
}

.filter_form{
	margin-bottom: 50px;
}

.product-item{
	padding: 0 !important;
}

.post-wrap{
	padding: 10px;
	border: 1px solid <?php echo $rs_configuracao['cor_linha_box'];?> !important;
	-webkit-transition: all .2s linear;
    -moz-transition: all .2s linear;
    -o-transition: all .2s linear;
    -ms-transition: all .2s linear;
    transition: all .2s linear;
	overflow:hidden;
	background-color:<?php echo $rs_configuracao['cor_box_produto'];?>;
}
.post-wrap:hover{border:2px solid <?php echo $rs_configuracao['cor_linha_box_hover'];?> !important;}

.shop .post-wrap{
	margin: 10px;
	/*height: 590px;*/
}

@media (max-width: 767px) {
	.shop .post-wrap{
		height: auto;
	}
}


#search_parts{
	margin-bottom: 20px;
	font-size: 12px;
	display: block;
	color: #cf4429;
	font-weight: bold;
}

#search_parts .fa-search{
	padding-left: 5px;
}

.banner-sidebar{
	margin: 30px auto;
	width: 250px;
	height: auto;
	overflow: hidden;

}

.no-border{
	border: 0 !important;
}

/* /Catalogo */

/* Produto */

.product-title{
	font-size: 30px !important;
}

.extra-info-iten{
	padding: 0;

	margin: 10px 0;
	width:270px;
}

.extra-info-iten h4{
	padding: 5px;
	margin-top: 0;
	border-bottom:1px solid #d1d1d1;
	color: #000;
}

.extra-info-iten p{
	padding-left: 10px;
	color:#cf4529;
	font-size:16px;
}

/* /Produto */

/* Inicio Página de Perguntas */
.faq_iten{
	padding: 5px 15px;
	border: 1px dotted #333333;
	margin: 15px 0;
	vertical-align: middle;
}

.buttons{
	margin-right: 10px;
	position: relative;
	width: 20px;
	height: 20px;
	display: inline-block;
	cursor: pointer;
}

.buttons img{
	position: absolute;
	top: 3px;
	left: 0;
	width: 100%;
	height: 100%;
}

.minus{
	display: none;
}

.faq_iten_title{
	display: inline-block;
	text-transform: uppercase;
	font-size: 22px;
	cursor: pointer;
}

.faq_iten_info{
	display: none;
	margin: 10px 0 0 35px;
}

/* Fim Página de Perguntas */


/* Links */

.link-iten{
	padding: 10px 0;
	font-size: 15pt;
}

/* /Links */

/* Downloads */

#download_table{
	width: 100%;
	text-align: center;
	font-weight: bold;
	font-size: 10pt;
	color: #cf4429;
}

#header{
	line-height: 30pt;
	font-size: 13pt;
	background-color:#fff !important;
	border-bottom:solid 2px #333;
}

.odd_line{
	background-color: #eee;
}

.download_item td img{
	width: 50px;
	height: 50px;
	margin: 10px;
}

.download_item td a{
	color: #333;
}

.download_item td a:hover{
	text-decoration: underline;
}


/* /Downloads */


/* Blog */

.reply-link{
	display: block;
    text-align: right;
    padding-right: 15px;
    padding-bottom: 10px;

}

.reply{
	margin-top: 20px;
	display: none;
}

/* /Blog */

/* Carrinho */

.kart-iten{
	padding: 15px;
	border: 1px solid #333333;
	margin-bottom: 30px;
}

.kart-iten img{
	width: 100%;
}

.kart-iten h6{
	font-size: 11px;
}

.kart-iten h5{
	text-align: center;
}

.kart-iten .quantity{
	text-align: center;
}

.kart-iten textarea{
	width: 100%;
}

.kart-iten .delete-iten{
	background-color: transparent;
	border: 0;
	padding: 15px;
}

.send-quotation{
	text-align: center;
}

.send-quotation a, .subscribe{
	padding: 10px;
	margin: 0 10px;
	font-weight: bold;
	font-size: 15pt;
	text-transform: uppercase;
	color: white;
}

.subscribe{
	margin: 15px 0 0 0 !important;
}

.send-quotation a:hover, .subscribe:hover{
	color: #fff;
}
/* /cotacao */
#input-message, .quantity {
  border: 1px solid #999;
  padding: 5px;
}

/* /Carrinho */
#erro_box {width:100%; float:left; height:100px; margin:20px; display:block;}
.erro_titulo {font-size:24px; color:#000000; display:block; margin:20px 0; text-align:center;}
.erro_texto {font-size:20px; color:#000000; display:block; text-align:center;}


/* Peças Avulsas */

#pecas_avulsas_section textarea{
	width: 100%;
  background-color: #DBDBDB;
  -webkit-border-radius: 0px;
  border-radius: 0px;
  border: 1px solid #dbdbdb;
  font-size: 13px;
  -webkit-box-shadow: none;
  box-shadow: none;
  height: 40px;
  padding: 10px 12px;
}

#pecas_avulsas_section .quantity{
	background-color: #DBDBDB;
	-webkit-border-radius: 0px;
	border-radius: 0px;
	border: 1px solid #dbdbdb;
	font-size: 13px;
	-webkit-box-shadow: none;
	box-shadow: none;
	height: 40px;
	padding: 10px 12px;
	text-align: right;
}

#pecas_avulsas_section .save-item{
	padding: 5px;
	margin: 0;
	background-color: #333;
	border: 1px solid #333;
	color: #FFF;
	font-size: 13px;
	-webkit-box-shadow: none;
	box-shadow: none;
	height: 40px;
}

#pecas_avulsas_section table{
	margin-bottom: 30px;
	width: 100%;
	border-width: 0px 1px 1px;
	border-style:solid;
	border-color:#333;
}

#pecas_avulsas_section form table{
	border-width: 0px;
}

#pecas_avulsas_section table tr{
	border-top: 1px solid #333;
	width: 100%;
}

#pecas_avulsas_section form table tr{
	border-top: 0px;
}


#pecas_avulsas_section table tr th, #pecas_avulsas_section table tr td{
	padding: 15px;
	vertical-align: top;
}

#pecas_avulsas_section table tr th{
	background-color: #333;
	color: #FFF;
}

#pecas_avulsas_section form  table tr th{
	background-color: transparent;
	color: #333;
}


#pecas_avulsas_section form table tr th, #pecas_avulsas_section form table tr td{
	padding: 5px;
}

#pecas_avulsas_section table tr .col-sm-1{
	text-align: center;
}

#pecas_avulsas_section table .delete-iten{
	background-color: transparent;
	border: 0;
	padding: 15px;
}

#pecas_avulsas_section table .delete-iten img{
	width: 100%;
}

#pecas_avulsas_section .send_request{
	padding: 10px;
	border: 1px solid #333333;
	font-weight: bold;
	text-transform: uppercase;
	background-color: #4A4A4A;
	color: white;
}

#pecas_avulsas_section .save-item:hover, #pecas_avulsas_section .send_request:hover{
	color: #cf4429;
}

/* /Peças Avulsas */

input::-webkit-input-placeholder {
   color: #33333 !important;
}

input:-moz-placeholder {
   color: #33333 !important;
}

input::-moz-placeholder {
   color: #33333 !important;
}

input:-ms-input-placeholder {
   color: #33333 !important;
}


.tab-content ul li{padding:0 0 0 5px;}
.tab-content ul li .post-wrap:hover{border:1px solid #FBBA0E;}
.tab-content .post-title{line-height:normal !important;}
.tab-content .post-title a{font-size:12px; line-height: 20px;}
.tab-content .post-title strong{font-size:12px;}

.nav-tabs>li>a{padding: 10px 7.49px !important; font-size:12px;}

.carousel-control{width:15px !important; color:black !important; font-size:25px !important; top:-45px !important;}
.carousel-control.right{right:-13px !important;}
.carousel-control.left{left:-15px !important;}

#banner_meio li a img{max-width:98%; margin-left: 20px; height:200px;}

.social:hover {
     -webkit-transform: scale(1.1);
     -moz-transform: scale(1.1);
     -o-transform: scale(1.1);
 }
 .social {
     -webkit-transform: scale(0.8);
     /* Browser Variations: */

     -moz-transform: scale(0.8);
     -o-transform: scale(0.8);
     -webkit-transition-duration: 0.5s;
     -moz-transition-duration: 0.5s;
     -o-transition-duration: 0.5s;
 }

/*
    Multicoloured Hover Variations
*/

 #social-fb:hover {
     color: #3B5998;
 }
 #social-tw:hover {
     color: #4099FF;
 }
 #social-gp:hover {
     color: #d34836;
 }
 #social-li:hover {
     color: #006fa6;
 }
 #social-in:hover {
     color: #9b6954;
 }
 #social-pi:hover {
     color: #e3262e;
 }


 .mais-auto a{padding: 2px 10px 2px 10px !important;
    position: relative;
    border: 1px solid white;
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;}

.prod-rel .post-footer a{}
.comment-body{padding: 0 50px 0 50px;     background-color: #d0d0d0;
    border-radius: 10px;}
.comment{}
.comments-area{/*background-color: #f7f7f7;*/}
.lead{       margin-left: 1px;
    margin-top: 10px;
    margin-bottom: 8px;}

/* Extra Small */
@media(min-width:0px) and (max-width:767px){
    .fade-search{display:none !important;}
	.header-contact-info{height: auto !important;}
	.resp-top{float:left; margin:0 !important;}
	.resp-top2{float:left; margin:10px !important;}
}

#fullResImage{height:550px !important;}

ul#banner_meio li {width: 100% !important; float: left;}


.produto_destaque {background:<?php echo $rs_configuracao['fundo_produtos_destaque'];?>;}
.produto_promocao {background:<?php echo $rs_configuracao['fundo_produtos_promocao'];?>;}
.produto_diversos {background:<?php echo $rs_configuracao['fundo_box_diversos'];?>;}
.produto_ultimos {background:<?php echo $rs_configuracao['fundo_ultimos_produtos'];?>;}
.produto_categoria {background:<?php echo $rs_configuracao['fundo_categoria'];?>;}
.produto_carrossel {background:<?php echo $rs_configuracao['fundo_carrocel'];?>;}


#rotacao {width:42px; margin:20px auto; height:auto;}
#rotacao a { width:14px; height:14px; padding:2px 2px; float:left; font-size:0.1em; color:#FFF; margin:0px; background:url(images/navegador.png) no-repeat center; text-decoration:none;}
#rotacao a.activeSlide { background:url(images/navegador2.png) no-repeat center; }

#rotacao2 {width:42px; margin:20px auto; height:auto;}
#rotacao2 a { width:14px; height:14px; padding:2px 2px; float:left; font-size:0.1em; color:#FFF; margin:0px; background:url(images/navegador.png) no-repeat center; text-decoration:none;}
#rotacao2 a.activeSlide { background:url(images/navegador2.png) no-repeat center; }

#rotacao3 {width:42px; margin:20px auto; height:auto;}
#rotacao3 a { width:14px; height:14px; padding:2px 2px; float:left; font-size:0.1em; color:#FFF; margin:0px; background:url(images/navegador.png) no-repeat center; text-decoration:none;}
#rotacao3 a.activeSlide { background:url(images/navegador2.png) no-repeat center; }

.thumbnail {background: <?php echo $rs_configuracao['cor_fundo_imagem'];?> !important;}
.thumbnail:hover {background: <?php echo $rs_configuracao['cor_fundo_imagem'];?> !important;}

@media (min-width: 200px) {
	.menu_home_barra {width:100%; float:left; height:100px; margin-bottom: 5%; text-align:center; color:#FFFFFF;}
	.menu_home_meio {font-size:1.5em; font-weight:bold; width:100%; margin-top:5%; float:left; text-align:center;}
	.menu_home_icone {font-size:4em;}
}

@media (min-width: 568px) {
	.menu_home_barra {width:33%; float:left; height:100px; text-align:center; color:#FFFFFF;}
	.menu_home_meio {font-size:1.5em; font-weight:bold; width:100%; margin-top:5%; float:left; text-align:center;}
	.menu_home_icone {font-size:4em;}
}

</style>
