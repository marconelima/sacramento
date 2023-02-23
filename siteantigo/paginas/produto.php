<?php
$sql_rotulo = "SELECT titulo FROM tbrotulo ORDER BY id DESC";
$resultado_rotulo = $conecta->selecionar($sql_rotulo);
$rs_rotulo = mysql_fetch_array($resultado_rotulo);

$buscaNav = '';
$categoriaNav = '';
$subcategoriaNav = '';
		if(isset($_POST['busca'])){
			$string_busca = $_POST['busca'];
			$where = " WHERE p.nome like '%".$string_busca."%' OR fo.titulo like '%".$string_busca."%' OR s.caracteristica like '%".$string_busca."%' OR c.titulo like '%".$string_busca."%' OR sc.titulo like '%".$string_busca."%'";
		} elseif(isset($_GET['busca'])){
			$string_busca = $_GET['busca'];
			$where = " WHERE p.nome like '%".$string_busca."%' OR fo.titulo like '%".$string_busca."%' OR s.caracteristica like '%".$string_busca."%' OR c.titulo like '%".$string_busca."%' OR sc.titulo like '%".$string_busca."%'";
		}elseif(isset($_GET['cat'])) {
			$categoria_id = $_GET['cat'];
			$where = ' WHERE c.id = '.$categoria_id;

			$sql_cat = "SELECT c.titulo FROM tbcategoriaproduto c WHERE c.id = ".$categoria_id;
			$resultado_cat = $conecta->selecionar($sql_cat);
			$rs_cat = mysql_fetch_array($resultado_cat);
			$categoriaNav = $rs_cat['titulo'];
		} elseif(isset($_GET['sub'])) {
			$subcategoria_id = $_GET['sub'];
			$where = ' WHERE sc.id = '.$subcategoria_id;

			$sql_cat = "SELECT c.titulo as ca, s.titulo as su, c.id as categoria_id FROM tbcategoriaproduto c, tbsubcategoriaproduto s WHERE s.categoria_id = c.id AND s.id = ".$subcategoria_id;
			$resultado_cat = $conecta->selecionar($sql_cat);
			$rs_cat = mysql_fetch_array($resultado_cat);
			$categoria_id = $rs_cat['categoria_id'];
			$categoriaNav = $rs_cat['ca'];
			$subcategoriaNav = " >> ".$rs_cat['su'];
		} elseif(isset($_GET['prod'])) {
			$produto_id = $_GET['prod'];
			$where = ' WHERE p.id = '.$produto_id;
		} else {
			$where = '';
		}

		$sql_produtos = "SELECT p.id, p.nome, p.marca, p.destaque, min(f.id) as idfoto, f.foto, min(s.preco) as preco,
						c.titulo as categoria, c.id as categoria_id, sc.titulo as subcategoria, s.codigo as codigo
				from tbproduto p
				inner join tbsubproduto s on p.id = s.produto_id
				inner join tbfotoproduto f on p.id = f.produto_id
				inner join tbsubcategoriaproduto sc on sc.id = p.subcategoria_id
				inner join tbcategoriaproduto c on c.id = sc.categoria_id
				inner join tbfornecedor fo on fo.id = p.fornecedor_id ".$where." group by p.id, p.nome
				order by nome limit $inicio,$maximo";


		$resultado_produtos = $conecta->selecionar($sql_produtos);
		$registros = mysql_num_rows($resultado_produtos);
		$resultado_produtos = $conecta->selecionar($sql_produtos);
		$rs_sub = mysql_fetch_array($resultado_produtos);
		$resultado_produtos = $conecta->selecionar($sql_produtos);
?>


        	<div id="corpo">
            	<?php include "busca.php"; ?>
                <span class="navegacao"><a href="index.php?pagina=home">Loja</a> >> <?php echo '<a href="index.php?pagina=produto&amp;cat='.$categoria_id.'">'.$categoriaNav.'</a>'.$subcategoriaNav;   ?></span>
                <div style="width:100%; height:5px; position:relative; float:left"></div>
                <h1 id="titulo_principal"><span class="titulo_principal"><?php echo convertem($rs_sub['subcategoria'],1); ?></span></h1>
    			<div id="separacao_principal"></div>


                <?php $i = 0; while($rs_produtos = mysql_fetch_array($resultado_produtos)){ ?>
                <div id="box_produto">
                	<?php if($rs_produtos['destaque'] == '1') { ?>
                	<div id="box_titulo_destaque_interno"><span class="texto_box_destaque"><?php echo $rs_rotulo['titulo'];?></span></div>
                    <?php } else { ?>
                    <div id="box_titulo_destaque"><span class="texto_box_destaque">&nbsp;</span></div>
                    <?php } ?>
                    <div id="box_texto_produto_interno"><h2 class="texto_produto"><a href="index.php?pagina=orcamento&amp;produto=<?php echo $rs_produtos['id']; ?>"><?php echo $rs_produtos['nome']; ?></a></h2></div>
                    <div id="box_imagem_produto_interno"><a href="index.php?pagina=orcamento&amp;produto=<?php echo $rs_produtos['id']; ?>"><img src="imagens/<?php echo $rs_produtos['foto'];?>" title="<?php echo $rs_produtos['nome']; ?>" alt="<?php echo $rs_produtos['nome']; ?>" height="120" border="0" alt="produto" /></a></div>
                    <div id="box_codigo_produto_interno"><span class="texto_produto"><a href="index.php?pagina=orcamento&amp;produto=<?php echo $rs_produtos['id']; ?>"><?php echo $rs_produtos['codigo']; ?></a></span></div>
                </div>
                <?php  $i++;
				if(($i%3) == 0) {

				} else {
				?>
				<div id="box_separacao_produto"></div>
				<?php
				}
				?>
                <?php  } ?>
                <?php
				$sql_tot = "SELECT p.id, p.nome, p.marca, p.destaque, min(f.id) as idfoto, f.foto, min(s.preco) as preco,
						c.titulo as categoria, sc.titulo as subcategoria, s.codigo as codigo
				from tbproduto p
				inner join tbsubproduto s on p.id = s.produto_id
				inner join tbfotoproduto f on p.id = f.produto_id
				inner join tbsubcategoriaproduto sc on sc.id = p.subcategoria_id
				inner join tbcategoriaproduto c on c.id = sc.categoria_id
				inner join tbfornecedor fo on fo.id = p.fornecedor_id ".$where." group by p.id, p.nome";
				$resultado_total = $conecta->selecionar($sql_tot);

				include "paginacao.php";
				?>

            </div>
