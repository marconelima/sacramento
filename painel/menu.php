<?php
$sql_menu = "SELECT g.nome as grupo, t.nome, t.pagina, t.tabela, t.id
			FROM tbtela t inner join tbpermissao p on t.id = p.tela_id
			inner join tbperfil f on f.id = p.perfil_id
			inner join tbgrupo g on t.grupo_id = g.id
			where f.id = ".$_SESSION['perfil']." AND t.status = 1 order by g.ordem, t.grupo_id, t.ordem, t.nome asc";

$resultado_menu = $conecta->selecionar($conecta->conn,$sql_menu);
?>
<div id="my_menu" class="sdmenu"> 
<?php
	$grupo = '';
	$i = 0;
	$j = 0;
	while($rs_menu = mysqli_fetch_array($resultado_menu)){
		if($grupo != $rs_menu['grupo']){
			$j++;
			if($i > 0){
				echo "</div>";
				$i = 0;
			}
			$grupo = $rs_menu['grupo']; 
	?>
	<div>  	
        <span><strong><?php echo $grupo;?></strong></span>
        
        <?php
		$i++;
		}
		$nome_menu = $rs_menu['nome'];
		
	?>
                <a href="home.php?pagina=<?php echo $rs_menu['pagina']; ?>&amp;tela=<?php echo $rs_menu['id']; ?>" <?php if($rs_menu['id'] == @$_GET['tela']) { echo 'style="background:#fcf8e3'; echo ';'; echo '"'; } ?>>			
				<?php echo $nome_menu; ?>
				</a>
	<?php $i++; } ?>
    </div>
    
    
       
</div>