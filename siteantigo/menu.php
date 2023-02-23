<?php
	$sql_menu = "SELECT distinct c.titulo as categoria, c.id as categoria_id, sc.titulo as sub, sc.id as subcategoria_id
		FROM tbsubcategoriaproduto sc inner join tbcategoriaproduto c on c.id = sc.categoria_id
		order by categoria_id, sub DESC";
	$resultado_menu = $conecta->selecionar($sql_menu);
?>
<div id="menu">
	<?php
		$categoria = '';
		$subcategoria = '';
		$i = 0;
		$j = 0;
    	while($rs_menu = mysql_fetch_array($resultado_menu)){
			if($categoria != $rs_menu['categoria']) {
				if($i > 0) {
					echo "<div id='menu_baixo'></div>";
					if($categoria_id == 1){
						echo "<div id='box_sacramomento'><img src='images/p_sacramomento1.png' border='0' /></div>";
					}
					$i = 0;
				}
				$categoria = $rs_menu['categoria'];
				$categoria_id = $rs_menu['categoria_id'];
	?>
    	<div id="menu_titulo_principal"><h1 class="titulo_menu_lateral"><a href="index.php?pagina=produto&amp;cat=<?php echo $categoria_id;?>"><?php echo $categoria; ?></a></h1></div>
    <?php
			}
			$subcategoria = $rs_menu['sub'];
			$subcategoria_id = $rs_menu['subcategoria_id'];
	?>
    	<div id="menu_item"><h2 class="menu_lateral"><a href="index.php?pagina=produto&amp;sub=<?php echo $subcategoria_id;?>"><?php echo $subcategoria; ?></a></h2></div>
    <?php
		$j++;
		$i++;
	}//fim while
	echo "<div id='menu_baixo'></div>";
	?>
	<div id="menu_titulo_principal"><h1 class="titulo_menu_lateral">Parceiros</h1></div>
    <div id="menu_item"><h2 class="menu_lateral"><a href="index.php?pagina=parceiro">Conheça-nos</a></h2></div>
    <div id='menu_baixo'></div>
	<!--
    <div id="menu_titulo_principal"><span class="titulo_menu_lateral">Catálogo de Produtos</span></div>
    <div id="menu_item"><span class="menu_lateral"><a href="index.php?pagina=catalogo">Catálogos</a></span></div>
    <div id='menu_baixo'></div>-->
</div>
