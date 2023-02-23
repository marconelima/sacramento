
<?php

$cor = "color:#069";

$p = $_GET['p'];

$sql_menu = "SELECT g.nome as grupo, t.nome, t.pagina, t.tabela, t.id
			FROM tbtela t inner join tbpermissao p on t.id = p.tela_id
			inner join tbperfil f on f.id = p.perfil_id
			inner join tbgrupo g on t.grupo_id = g.id
			where f.id = ".$_SESSION['perfil']." AND t.status = 1 order by t.grupo_id,t.ordem, t.nome asc";

$resultado_menu = $conecta->selecionar($sql_menu);
;
?>
<script>
	var posicao = $.QueryString("p");
	posicao = ( !posicao )? 0 :posicao;
	//alert(posicao);
	$(document).ready(function(){
		$("dd:not(."+posicao+")").hide();
		$("dt a").click(function(){
			$("dd:visible").slideUp("slow");
			$(this).parent().next().slideDown("slow");
			return false;
		});
	});
</script>

<div style="float: left" id="my_menu" class="sdmenu">
	<?php
	$grupo = '';
	$i = 0;
	while($rs_menu = mysql_fetch_array($resultado_menu)){
		if($grupo != $rs_menu['grupo']){
			if($i > 0){
				echo "</div>";
				$i = 0;
			}
			$grupo = $rs_menu['grupo'];
			
	?>
            <div>
                <span><?php echo $grupo;?></span>
    <?php
		$i++;
		}
		$link_menu = $rs_menu['link'];
		$nome_menu = $rs_menu['nome'];
		
	?>
                <a href="home.php?pagina=<?php echo $rs_menu['pagina']; ?>&amp;tela=<?php echo $rs_menu['id']; ?>">
				
				<?php echo $nome_menu; ?>
				</a>
	<?php } ?>
    </div>
</div>













    