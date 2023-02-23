<?php
	$sql = "SELECT * FROM tbcatalogo WHERE status = 1 ORDER BY id DESC";
	$resultado = $conecta->selecionar($sql);
?>
<div id="corpo">
<?php include "busca.php"; ?>            
	<div id="titulo_principal" style="margin-left:15px;"><span class="titulo_principal">CATÁLOGO</span></div>
    <div id="separacao_principal"></div>
    <div id="box_item_grande">
    	<div style="margin:25px 10px 10px 10px; position:relative; float:left; height:100px;" >
            <table cellpadding="0" cellspacing="0" width="170" border="0"><tr><td height="100" valign="middle" align="center"><a href="documentos/catalogo_sacramento.pdf" ><img src="imagens/baixe_catalogo.jpg" width="150" alt="Catalogo Completo" border="0" /></a></td></tr><tr><td align="center"></td></tr></table>
        </div>
		<?php while($rs = mysql_fetch_array($resultado)){ ?>
        	<?php
			if($rs['documento'] != '') {
				$ext = strtolower(end(explode('.',$rs['documento'])));
				if($ext == 'jpg' || $ext == 'gif' || $ext == 'png') {
			?>
            	<div style="margin:10px; position:relative; float:left; height:100px;" >
				<?php if($rs['arquivo'] != '') { ?>
                <table cellpadding="0" cellspacing="0" width="170" border="0"><tr><td height="100" valign="middle" align="center"><a href="documentos/download_imagem.php?arquivo=<?php echo $rs['documento']; ?>" ><img src="imagens/<?php echo $rs['arquivo']; ?>" width="150" alt="<?php echo $rs['titulo'];?>" title="<?php echo $rs['titulo'];?>" border="0" /></a></td></tr><tr><td align="center"><span class="texto_produto"><?php echo $rs['titulo'];?></span></td></tr></table>
                <?php } ?>
                </div>
			<?php } else { ?>
            	<div style="margin:10px; position:relative; float:left; height:100px;" >
				<?php if($rs['arquivo'] != '') { ?>
                <table cellpadding="0" cellspacing="0" width="170" border="0"><tr><td height="100" valign="middle" align="center"><a href="documentos/<?php echo $rs['documento']; ?>" target="_blank" ><img src="imagens/<?php echo $rs['arquivo']; ?>" width="150" alt="<?php echo $rs['titulo'];?>" title="<?php echo $rs['titulo'];?>" border="0" /></a></td></tr><tr><td align="center""><span class="texto_produto"><?php echo $rs['titulo'];?></span></td></tr></table>
                <?php } ?>
                </div>
			<?php }
			}
			?>
		<?php } ?>
   </div>
</div>
