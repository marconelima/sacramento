<div id="paginacao">
    <?php
		
		$total = mysql_num_rows($resultado_total);
		
		if($total > $maximo){
			$paginas = ceil($total/$maximo);
			$links = '5';
			
			if(isset($_GET['cat'])){
				$par_categoria = "&amp;cat=".$_GET['cat'];
			}
			
			if(isset($_GET['sub'])){
				$par_subcategoria = "&amp;sub=".$_GET['sub'];
			}
			
			if(isset($_GET['prod'])){
				$par_produto = "&amp;prod=".$_GET['prod'];
			}
			
			if(isset($_POST['busca'])){
				$par_busca = "&amp;busca=".$_POST['busca'];
			}elseif(isset($_GET['busca'])){
				$par_busca = "&amp;busca=".$_GET['busca'];
			}
			
			echo "<a href=\"index.php?pagina=$pagina$par_subcategoria$par_categoria$par_produto$par_busca&amp;pag=1\">Primeira Página</a>&nbsp;&nbsp;&nbsp;";
	
			for ($i = $pag-$links; $i <= $pag-1; $i++){
			if ($i <= 0){
			}else{
			echo"<a href=\"index.php?pagina=$pagina$par_subcategoria$par_categoria$par_produto$par_busca&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
			}
			}echo "$pag &nbsp;&nbsp;&nbsp;";
			
			for($i = $pag +1; $i <= $pag+$links; $i++){
			if($i > $paginas){
			}else{
			echo "<a href=\"index.php?pagina=$pagina$par_subcategoria$par_categoria$par_produto$par_busca&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
			}
			}
			echo "<a href=\"index.php?pagina=$pagina$par_subcategoria$par_categoria$par_produto$par_busca&amp;pag=$paginas\">Última página</a>&nbsp;&nbsp;&nbsp;";
		}
	?>
</div>