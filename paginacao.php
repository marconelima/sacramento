<nav aria-label="Paginação">
  <ul class="pagination" style="float: right; margin-top: 3%;">
  <?php

	$total = mysqli_num_rows($resultado_total);

	if($total > $maximo){
		$numpaginas = ceil($total/$maximo);
		$links = '5';

		echo "<li class='page-item'><a class='page-link' href=\"".$siteUrl.$pagina."/".$tela."/1/".$vw."/".$categ."/".$aut."/".$emailcadastro."/".$palavra."/".$subcateg."/0/0/0/0/0/0/0/0/".@$search."\">«</a></li>";

		for ($i = $pag-$links; $i <= $pag-1; $i++){
		if ($i <= 0){
		}else{
		echo"<li class='page-item'><a class='page-link' href=\"".$siteUrl.$pagina."/".$tela."/".$i."/".$vw."/".$categ."/".$aut."/".$emailcadastro."/".$palavra."/".$subcateg."/0/0/0/0/0/0/0/0/".@$search."\">$i</a></li>";
		}
		}echo "<li  class='page-item active'><a class='page-link' href='#'>$pag<span class='sr-only'>(current)</span></a></li>";

		for($i = $pag +1; $i <= $pag+$links; $i++){
		if($i > $numpaginas){
		}else{
		echo "<li class='page-item'><a class='page-link' href=\"".$siteUrl.$pagina."/".$tela."/".$i."/".$vw."/".$categ."/".$aut."/".$emailcadastro."/".$palavra."/".$subcateg."/0/0/0/0/0/0/0/0/".@$search."\">$i</a></li>";
		}
		}
		echo "<li class='page-item'><a class='page-link' href=\"".$siteUrl.$pagina."/".$tela."/".$numpaginas."/".$vw."/".$categ."/".$aut."/".$emailcadastro."/".$palavra."/".$subcateg."/0/0/0/0/0/0/0/0/".@$search."\">»</a></li>";
	}
	?>

  </ul>
</nav>