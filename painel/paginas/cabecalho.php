<?php 

date_default_timezone_set("Brazil/East");
include("../parametros.php");
include "../uteis/bancodados.php";
require "verificar.php";

//VARIAVEIS DA PAGINAÇÃO
$pag = @$_GET['pag'];
if($pag >= '1'){
	$pag = $pag;
} else {
	$pag = '1';
}

//NUMERO MÁXIMO DE REGISTROS POR PÁGINA
$maximo = '24';
$inicio = ($pag * $maximo) - $maximo;

$conecta = new Recordset;
$conecta->conexao();

if(isset($_GET['tela'])){
	$tela_id = $_GET['tela'];
} else {
	$_GET['tela'] = 7;
	$tela_id = $_GET['tela'];
}



$sql_tela = 'SELECT t.*, g.nome as grupo FROM tbtela t INNER JOIN tbgrupo g ON g.id = t.grupo_id  WHERE t.id = '.$tela_id;
$resultado_tela = $conecta->selecionar($conecta->conn,$sql_tela);
$rs_tela = mysqli_fetch_array($resultado_tela);

$tabela = $rs_tela['tabela'];
$idtela = $rs_tela['id'];
$nometela = $rs_tela['nome'];
$grupotela = $rs_tela['grupo'];
$paginatela = $rs_tela['pagina'];

$sql = "SELECT * FROM tbconfiguracao where tela_id = 22";
$resultado = $conecta->selecionar($conecta->conn,$sql);
$dados = mysqli_fetch_array($resultado);

if($_GET['tela'] == 21){
	$nometela = "Cadastrar Produto";
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO -->
    
    <!-- CSS -->

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css"> 
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-tagsinput.css">  
    <link rel="stylesheet" type="text/css" href="../css/datepicker.css" media="screen"/>  
    <link rel="stylesheet" type="text/css" href="../css/sdmenu.css" />
    <link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css">
    <link rel="stylesheet" type="text/css" href="../css/fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="../css/painel.css">
    
    <title>Painel | <?php echo $dados['titulopagina'];?></title>
    
    <script language="javascript" src="../js/jquery.min.js"></script>
    <script language="javascript" src="../js/bootstrap.min.js"></script>
    <script language="javascript" src="../js/bootstrap-tagsinput.min.js"></script>
    <script language="javaScript" src="../js/validacoes.js"></script>
    <script language="javaScript" src="../js/mascaras.js"></script>
    <script language="javaScript" src="../js/jquery.maskedinput.min.js"></script>
    <script language="javaScript" src="../js/jquery-ui.min.js"></script>
    <script language="javaScript" src="../js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>
          
    <script src="../uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	
 	<script language="javascript" src="../js/jquery.1.9.0.min.js"></script>
 	<script language="javaScript" src="../js/jquery-migrate-1.2.1.min.js"></script>
	<script language="javaScript" src="../js/jquery.fancybox.min.js"></script>
	<script language="javaScript" src="../js/jquery.nicescroll.min.js"></script>
    
    <script language="javaScript" src="../js/jquery.InputDinamico.js"></script>
    <script language="javascript" src="../js/script.js"></script>   
    <script type="text/javascript" src="../js/sdmenu.js"></script> 
    
        
    <!-- Place inside the <head> of your HTML -->
	<script type="text/javascript">
	
		tinymce.init({
			selector: "textarea",theme: "modern",language: "pt_BR",	height: 350,
			plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
				 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				 "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
		   ],
		   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
		   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
		   image_advtab: true ,
		   
		   external_filemanager_path:"../js/tinymce/plugins/filemanager/",
		   filemanager_title:"Responsive Filemanager" ,
		   external_plugins: { "filemanager" : "http://www.stopautopecas.com.br/novosite/js/tinymce/plugins/filemanager/plugin.min.js"}
		});
	
		var myMenu;
		window.onload = function() {
			myMenu = new SDMenu("my_menu");
			myMenu.init();
		}
	
        function responsive_filemanager_callback(field_id){
            console.log(field_id);
            var url=jQuery('#'+field_id).val();
            //alert('update '+field_id+" with "+url);
            //your code
        }
        
        $(function(){
            var options = new Array();
            options['language'] = 'pt-BR';
        });
    
        jQuery(document).ready(function() {  
            jQuery("html").niceScroll({cursorcolor:"#282828"});
        });
    
 
		(function($) {
			$(function() {
				// O seu código com dolar aqui      
				$('.iframe-btn').fancybox({
					  'width'	: 880,
					  'height'	: 570,
					  'type'	: 'iframe',
					  'autoScale'   : false
				});			  
			 
				// Handles message from ResponsiveFilemanager
				function OnMessage(e){
					var event = e.originalEvent;
				    // Make sure the sender of the event is trusted
					if(event.data.sender === 'responsivefilemanager'){
						if(event.data.field_id){
							var fieldID=event.data.field_id;
							var url=event.data.url;
								$('#'+fieldID).val(url).trigger('change');
								$.fancybox.close();
				
								// Delete handler of the message from ResponsiveFilemanager
								$(window).off('message', OnMessage);
					  	}
				   	}
				}
				
				// Handler for a message from ResponsiveFilemanager
				$('.iframe-btn').on('click',function(){
					$(window).on('message', OnMessage);
				});
				
				$('#download-button').on('click', function() {
					ga('send', 'event', 'button', 'click', 'download-buttons');      
				});
				
				$('.toggle').click(function(){
					var _this=$(this);
					$('#'+_this.data('ref')).toggle(200);
					var i=_this.find('i');
					if (i.hasClass('icon-plus')) {
					  	i.removeClass('icon-plus');
					  	i.addClass('icon-minus');
					}else{
					  	i.removeClass('icon-minus');
					  	i.addClass('icon-plus');
					}
				});
			});
		})(jQuery);
		
		function open_popup(url){
			var w = 880;
			var h = 570;
			var l = Math.floor((screen.width-w)/2);
			var t = Math.floor((screen.height-h)/2);
			var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
		}
    
	</script>
    
 <style>
 	.table-responsive { clear:both !important;}
 </style>   
</head>

<body class="body_fundo">
	<div class="container">
    	<div class="row cabecalho">
        	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            	<h2 class="titulo_painel">Painel de Controle</h2>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            	<img src="<?php echo $dados['logomarca'];?>" class="logo_painel" height="50" />
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 texto_adireita">
                <h5><strong>Bem vindo(a),</strong> <?php echo $_SESSION["nome_usuario"];?></h5>
                <h5><?php echo $nomediadasemana.", ".$dia." de ".$nomemes." de ".$anox." | ".$horaacesso; ?></h5>
				<h4><a href="sair.php">Sair</a></h4>
            </div>
            </div>
            <div class="row">
            	<ol class="breadcrumb">
                  <li><a href="home.php?pagina=principal&amp;tela=7">Home</a></li>
                  <li><a href="home.php?pagina=<?php echo @$_GET['pagina'];?>&amp;tela=<?php echo @$_GET['tela'];?>"><?php echo $grupotela;?></a></li>
                  <li class="active"><?php echo $nometela?></li>
                </ol>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <?php include("menu.php");?>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                    <div class="borda">
                		<div class="alert alert-info alert_h">
                        	<h2 class="alert_h border_zero"><?php echo $grupotela." - ".$nometela;?></h2>
                        </div>