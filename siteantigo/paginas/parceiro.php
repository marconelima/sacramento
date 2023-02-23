<?php

	
	$sql = "SELECT * FROM tbfornecedor WHERE status = 1 ORDER BY id DESC";
	
	$resultado = $conecta->selecionar($sql);
	

?>
<div id="corpo">
<?php include "busca.php"; ?>
                
	<div id="titulo_principal" style="margin-left:15px;"><span class="titulo_principal">PARCEIROS</span></div>
    <div id="separacao_principal"></div>
        
    <div id="box_item_grande">
		<?php 
											
			
			while($rs = mysql_fetch_array($resultado)){
		?>
			<div style="margin:10px; position:relative; float:left; height:100px;" >
			<?php if($rs['arquivo'] != '') { ?>
			<table cellpadding="0" cellspacing="0" width="170" border="0"><tr><td height="100" valign="middle" align="center"><a href="index.php?pagina=produto&amp;busca=<?php echo $rs['titulo'];?>"><img src="imagens/<?php echo $rs['arquivo']; ?>" width="150" alt="<?php echo $rs['titulo'];?>" border="0" /></a></td></tr></table>
			<?php } ?>
			</div>
		<?php 
			}
		
		?>
   </div>
</div>