<?php
$sql_banner = "select * from tbbanner where posicao = 0 and situacao = 1";
$resultado_banner = $conecta->selecionar($sql_banner);

$sql_rotulo = "SELECT titulo FROM tbrotulo ORDER BY id DESC";
$resultado_rotulo = $conecta->selecionar($sql_rotulo);
$rs_rotulo = mysql_fetch_array($resultado_rotulo);
$resultado_rotulo = $conecta->selecionar($sql_rotulo);
$qtde_banner = mysql_num_rows($resultado_rotulo);
$tamanho_banner = $qtde_banner*610;

$sql_banner_lateral = "select * from tbbanner where posicao = 1 and situacao = 1";
$resultado_banner_lateral = $conecta->selecionar($sql_banner_lateral);
$sql_banner_inferior = "select * from tbbanner where posicao = 2 and situacao = 1";
$resultado_banner_inferior = $conecta->selecionar($sql_banner_inferior);
$sql_destaque = "SELECT p.id, p.nome, p.marca, min(f.id) as idfoto, f.foto, min(s.preco) as preco,
						c.titulo as categoria, sc.titulo as subcategoria, s.codigo as codigo
				from tbproduto p
				inner join tbsubproduto s on p.id = s.produto_id
				inner join tbfotoproduto f on p.id = f.produto_id
				inner join tbsubcategoriaproduto sc on sc.id = p.subcategoria_id
				inner join tbcategoriaproduto c on c.id = sc.categoria_id
				inner join tbfornecedor fo on fo.id = p.fornecedor_id
				where p.destaque = 1
				group by p.id, p.nome
				order by rand()";

$resultado_destaque = $conecta->selecionar($sql_destaque);
$sql_vendido = "SELECT p.id, p.nome, p.marca, min(f.id) as idfoto, f.foto, min(s.preco) as preco,
						c.titulo as categoria, sc.titulo as subcategoria, s.codigo as codigo
				from tbproduto p
				inner join tbsubproduto s on p.id = s.produto_id
				inner join tbfotoproduto f on p.id = f.produto_id
				inner join tbsubcategoriaproduto sc on sc.id = p.subcategoria_id
				inner join tbcategoriaproduto c on c.id = sc.categoria_id
				inner join tbfornecedor fo on fo.id = p.fornecedor_id
				where p.vendido = 1
				group by p.id, p.nome
				order by rand() limit 0,3";

$resultado_vendido = $conecta->selecionar($sql_vendido);
?>
<script language="javascript">

</script>


        	<div id="corpo">

            	<?php include "busca.php"; ?>

            	<div id="propaganda">

                	<div id="propaganda_rolagem" style="width:<?php echo $tamanho_banner;?>px;">

                		<div id="slides2">

               			<ul>

                        	<?php while($rs_banner = mysql_fetch_array($resultado_banner)){ ?>

                			<li><a href="<?php echo $rs_banner['link'];?>"><img src="imagens/<?php echo $rs_banner['arquivo'];?>" title="<?php echo $rs_banner['link'];?>" alt="<?php echo $rs_banner['link'];?>" width="600" height="252" border="0" /></a></li>

                            <?php } ?>

                        </ul>

                        </div>

                	</div>

                </div>

                <div id="seta_esquerda"><img src="images/seta_esquerda.png" border="0"  /></div>

                <div id="seta_direita"><img src="images/seta_direita.png" border="0"  /></div>



                <div id="patrocinio_lateral">

                	<div id="box_titulo_destaque" style="margin-top:7px;"><span class="texto_box_destaque">Divulgação</span></div>

                    <div id="patrocinio_rolagem">

                		<div id="slides3">

               			<ul>

                        	<?php while($rs_patrocinio_lateral = mysql_fetch_array($resultado_banner_lateral)){ ?>

                			<li><a href="<?php echo $rs_patrocinio_lateral['link'];?>"><img src="imagens/<?php echo $rs_patrocinio_lateral['arquivo'];?>" width="170" border="0" title="<?php echo $rs_patrocinio_lateral['link'];?>" alt="<?php echo $rs_patrocinio_lateral['link'];?>" /></a></li>

                            <?php } ?>

                        </ul>

                        </div>

                	</div>

                </div>




				<?php
                	$qtde_destaque = mysql_num_rows($resultado_destaque);
				?>
           		<div id="box_destaque">
                <div id="box_titulo_destaque_2">Produtos em <br>Destaque</div>

                <div class="slideshow">
                        <ul class="slides">
                <script type="text/javascript">

/***********************************************
* Conveyor belt slideshow script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/


//Specify the slider's width (in pixels)
var sliderwidth="540px"
//Specify the slider's height
var sliderheight="140px"
//Specify the slider's slide speed (larger is faster 1-10)
var slidespeed=2
//configure background color:
slidebgcolor="#ffffff;"

//Specify the slider's images
var leftrightslide=new Array()
var finalslide=''
<?php $i = 1; while($rs_destaque = mysql_fetch_array($resultado_destaque)) { ?>
leftrightslide[<?php echo $i; ?>]='<img src="imagens/<?php echo $rs_destaque['foto'];?>" title="<?php echo $rs_destaque['nome'];?>" alt="<?php echo $rs_destaque['nome'];?>" class="img_esteira" width="140" border=0>'
<?php $i++; } ?>

//Specify gap between each image (use HTML):
var imagegap=""

//Specify pixels gap between each slideshow rotation (use integer):
var slideshowgap=1


////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=slidespeed
leftrightslide='<nobr>'+leftrightslide.join(imagegap)+'</nobr>'
var iedom=document.all||document.getElementById
if (iedom)
document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+leftrightslide+'</span>')
var actualwidth=''
var cross_slide, ns_slide

function fillup(){
if (iedom){
cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2
cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3
cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("temp").offsetWidth
cross_slide2.style.left=actualwidth+slideshowgap+"px"
}
else if (document.layers){
ns_slide=document.ns_slidemenu.document.ns_slidemenu2
ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
ns_slide.document.write(leftrightslide)
ns_slide.document.close()
actualwidth=ns_slide.document.width
ns_slide2.left=actualwidth+slideshowgap
ns_slide2.document.write(leftrightslide)
ns_slide2.document.close()
}
lefttime=setInterval("slideleft()",30)
}
window.onload=fillup

function slideleft(){
if (iedom){
if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+"px"
else
cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"

if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+"px"
else
cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"

}
else if (document.layers){
if (ns_slide.left>(actualwidth*(-1)+8))
ns_slide.left-=copyspeed
else
ns_slide.left=ns_slide2.left+actualwidth+slideshowgap

if (ns_slide2.left>(actualwidth*(-1)+8))
ns_slide2.left-=copyspeed
else
ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
}
}


if (iedom||document.layers){
with (document){
document.write('<table border="0" cellspacing="0" cellpadding="0" width="600px"><td>')
if (iedom){
write('<div style="position:relative;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden">')
write('<div style="position:absolute;width:'+sliderwidth+';height:'+sliderheight+';background-color:'+slidebgcolor+'" onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed">')
write('<div id="test2" style="position:absolute;left:0px;top:0px"></div>')
write('<div id="test3" style="position:absolute;left:-1000px;top:0px"></div>')
write('</div></div>')
}
else if (document.layers){
write('<ilayer width='+sliderwidth+' height='+sliderheight+' name="ns_slidemenu" bgColor='+slidebgcolor+'>')
write('<layer name="ns_slidemenu2" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
write('<layer name="ns_slidemenu3" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
write('</ilayer>')
}
document.write('</td></table>')
}
}
	</script>



                    </ul>
                    </div>

                </div>





                <!--<div id="box_produto_maisvendido">

                	<?php //while($rs_vendido = mysql_fetch_array($resultado_vendido)) {?>
                	<div id="box_maisvendido">
                    	<div id="box_imagem_produto"><a href="index.php?pagina=orcamento&amp;produto=<?php //echo $rs_vendido['id']; ?>"><img src="imagens/<?php //echo $rs_vendido['foto'];?>" height="140" border="0" alt="produto" /></a></div>
                    	<div id="box_texto_produto"><span class="texto_produto"><a href="index.php?pagina=orcamento&amp;produto=<?php //echo $rs_vendido['id']; ?>"><?php //echo $rs_vendido['nome']; ?></a></span></div>
                    </div>
                    <?php  //} ?>
                    </div>-->

                    <a href="index.php?pagina=catalogo"><img src="images/botao_catalogo.png" width="210" height="108" border="0" title="Catalogo" alt="catalogo"  title="" alt=""  class="btn_home mar_esquerda" /></a>
                    <a href="index.php?pagina=sugestao"><img src="images/botao_sugestao.png" width="210" height="108" border="0" title="Sugestão" alt="sugestão" class="btn_home mar_centro" /></a>
                    <a href="index.php?pagina=trabalhe"><img src="images/botao_trabalhe.png" width="210" height="108" border="0" title="trabalhe conosco" alt="trabalhe"  class="btn_home mar_direita" /></a>





                <div id="banner_inferior">

                	<div id="banner_inferior_rolagem">

                		<div id="slides4">

               			<ul>

                        	<?php while($rs_banner_inferior = mysql_fetch_array($resultado_banner_inferior)){ ?>

                			<li><a href="<?php echo $rs_banner_inferior['link'];?>"><img src="imagens/<?php echo $rs_banner_inferior['arquivo'];?>" title="<?php echo $rs_banner_inferior['link'];?>" alt="<?php echo $rs_banner_inferior['link'];?>" width="800" border="0" /></a></li>

                            <?php } ?>

                        </ul>

                        </div>

                	</div>

                </div>



            </div>
