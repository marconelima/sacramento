<ul class="pagination">
	<?php	
	$total = mysqli_num_rows($resultado_total);
		
	if($total > $maximo){
		$paginas = ceil($total/$maximo);
		$links = '5';
			
		if($paginas > $links){
			echo '<li><a href="home.php?pagina='.$_GET['pagina'].'&amp;tela='.$idtela.'&amp;pag=1&amp;sub='.@$_GET['sub'].'">&laquo;</a></li>';
		}
		
		for ($i = $pag-$links; $i <= $pag-1; $i++){
			if ($i <= 0){
			}else{
				echo '<li><a href="home.php?pagina='.$_GET['pagina'].'&amp;tela='.$idtela.'&amp;pag='.$i.'&amp;sub='.@$_GET['sub'].'">'.$i.'</a></li>';
			}
		}
		echo '<li class="active"><a>'.$pag.'<span class="sr-only">(current)</span></a></li>';
			
		for($i = $pag +1; $i <= $pag+$links; $i++){
			if($i > $paginas){
			}else{
				echo '<li><a href="home.php?pagina='.$_GET['pagina'].'&amp;tela='.$idtela.'&amp;pag='.$i.'&amp;sub='.@$_GET['sub'].'">'.$i.'</a></li>';
			}
		}
		if($paginas > $links){
			echo '<li><a href="home.php?pagina='.$_GET['pagina'].'&amp;tela='.$idtela.'&amp;pag='.$paginas.'&amp;sub='.@$_GET['sub'].'">&raquo;</a>';
		}
	}
	?>
</ul>