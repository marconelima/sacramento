</div>
        <div id="rodape">
        	<div id="rodape_informacoes">
            <span class="texto_rodape_informacoes">© Sacramento Industria e Comércio Ltda - ME<br />
            Rua General Clark, 1030 - Novo Progresso | Contagem | MG - <span class="texto_rodape_informacoes1"><strong>SAC (31) 3354.8250</strong></span>
            <br />
            <br /><a href="http://www.cianodigital.com.br" target="_blank"><img src="images/logo_ciano.png" border="0" /></a>
            </div>
<div id="rodape_twitter">
            	<div id="imagem_twitter"><a href="http://www.facebook.com/vassourassacramento" target="_blank"><img src="images/footer-face.png" border="0" alt="facebook" /></a></div>
                <div id="imagem_twitter"><a href="http://twitter.com/#!/indsacramento" target="_blank"><img src="images/footer-twitter.png" border="0" alt="twitter" /></a></div>
                <div id="texto_twitter">
                	<span class="titulo_rodape_twitter">Redes Sociais Sacramento</span>
                    <span class="texto_rodape_twitter">Venha nos seguir e saber de todas<br />as ofertas</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.imgr.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js" ></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script src="js/jqzoom.pack.1.0.1.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/validacoes.js"></script>
<script type="text/javascript" src="js/mascaras.js"></script>

<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript" src="js/jquery.jcarousellite.js"></script>
<script language="javascript">
$(function() {
	$('#cpf').mask('99.999.999/9999-99');
	$('#cpf2').mask('999.999.999-99');
	$("#slides2 ul").cycle({
		fx: 'fade',
		speed: 2400,
		timeout: 15000,
		prev : '#seta_esquerda',
		next : '#seta_direita'
	});
	$("#slides3 ul").cycle({
		fx: 'fade',
		speed: 2400,
		timeout: 6000
	});
	$("#slides4 ul").cycle({
		fx: 'fade',
		speed: 2400,
		timeout: 10000
	});
	$("#seta_esquerda").hide();
	$("#seta_direita").hide();
});

$(document).ready(function() {
	$("#box_imagem_destaque_base").jCarouselLite({
		btnNext: ".next",
		btnPrev: ".prev"
	});

	$('.jqzoom').jqzoom({
            zoomType: 'standard',
			zoomWidth: 400,
	    	zoomHeight: 400,
            lens:true,
            preloadImages: false,
            alwaysOn:false,
			position:'right'
        });

	$(".gallery a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
	$(".box_menu_produto_opcao a").click(function(){
		$('.box_menu_produto_opcao a.abamarcada').removeClass('abamarcada');
		$(this).addClass('abamarcada');
		$(".aba").hide();
		var div = $(this).attr('href');
		$(div).show();
		return false;
	});

	$("#propaganda").mouseover(function(){
		$("#seta_esquerda").show();
		$("#seta_direita").show();
	});

	$("#seta_esquerda").mouseover(function(){
		$("#seta_esquerda").show();
		$("#seta_direita").show();
	});

	$("#seta_direita").mouseover(function(){
		$("#seta_esquerda").show();
		$("#seta_direita").show();
	});

	$("#propaganda").mouseout(function(){
		$("#seta_esquerda").hide();
		$("#seta_direita").hide();
	});
});
</script>

<?php
$conecta->desconectar();
?>
