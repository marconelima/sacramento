<?php
$conecta = new Recordset;
$conecta->conexao();

$tela_id = $_GET['tela'];

$sql_tela = 'SELECT * FROM tbtela WHERE id = '.$tela_id;
$resultado_tela = $conecta->selecionar($sql_tela);
$rs_tela = mysql_fetch_array($resultado_tela);

$tabela = $rs_tela['tabela'];
$idtela = $rs_tela['id'];
$nometela = $rs_tela['nome'];


if(isset($_GET['vw'])) { $vw = $_GET["vw"]; }

if($_GET['f'] != ''){
	$idApagar = $_GET['f'];
	$pasta = '../imagens';
	
	$sql_apa = "SELECT * FROM tbfotoproduto WHERE id = $idApagar";
	$recupera = $conecta->selecionar($sql_apa);
	$rsRecupera = mysql_fetch_array($recupera);
	
	$fotoApagar = $rsRecupera['foto'];
	
	if($fotoApagar != '') {
		unlink($pasta."/".$fotoApagar);
	}
	
	$sql_del = "DELETE FROM tbfotoproduto WHERE id = $idApagar";
	$resultado = $conecta->selecionar($sql_del);
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Foto apagada!</span>";	
	} else {
		$resultado = "<span class=\"retorno\">Problemas ao apagar foto!</span>";
	}
}

if(isset($_POST['gravar']) && $_POST['gravar'] == 'gravar'){
	
	$dados = $_POST["dados"];
	
	$id = $conecta->inserirID($dados);
	$idArray = array($id, $id, $id, $id);
		
	$dados2['tbsubproduto']['produto_id'] = $idArray;
	$dados2['tbsubproduto']['caracteristica'] = $_POST['caracteristica'];
	$dados2['tbsubproduto']['preco'] = $_POST['preco'];
	$dados2['tbsubproduto']['codigo'] = $_POST['codigo'];
	
	
		
	//PEGAR TABELA
	$arrTabela = array_keys($dados2);
	$tabela = $arrTabela[0];
	//PEGAR CAMPOS
	$arrCampos = array_keys($dados2[$tabela]);
	//PEGAR VALORES
	$arrValores = array_values($dados2[$tabela]);	
	//CONTAR CAMPOS
	$numCampos = count($arrCampos);
	//CONTAR VALORES
	$numValores = count($arrValores);
	//VALIDAÇÃO DOS CAMPOS
	if($numCampos == $numValores){
		$sql = "INSERT INTO ".$tabela." (";
		foreach($arrCampos as $campo){
			$sql .= "$campo,";
		}
		$sql = substr_replace($sql, ")", -1, 1);
		$sql .= " VALUES (";
		
	} else {
		$resultado = "Erro ao checar dados";	
	}
	
	$j = 0;
	foreach($dados2 as $val){
		foreach($val as $v){
			
			$numInternosSub = count($v);
			for($i=0; $i < $numInternosSub; $i++){
				if($j == 2 || $j == 3){
					$sql2[$i] .= "'".str_replace(",",".",str_replace(".","",$v[$i]))."',";
				} else {
					$sql2[$i] .= "'".$v[$i]."',";
				}
			} 
			$j++;
		}
	}
	$i = 0;
	for($i=0; $i < $numInternosSub; $i++){
		$sql2[$i] = substr_replace($sql2[$i], ")", -1, 1);
		$sqlInsert = $sql . $sql2[$i];
		
		$resultado = $conecta->selecionar($sqlInsert);
	}
	
	
	$pasta = '../imagens/';
 	foreach($_FILES["img"]["error"] as $key => $error){
 
 		if($error == UPLOAD_ERR_OK){
 			$tmp_name = $_FILES["img"]["tmp_name"][$key];
 			$cod = date('dmyhg') . '-produto-' . $_FILES["img"]["name"][$key];
 			$nome = $_FILES["img"]["name"][$key];
 			$uploadfile = $pasta . basename($cod);
 
 			if(move_uploaded_file($tmp_name, $uploadfile)){
 				$retornoFoto = "O Arquivo " . $nome . " foi enviado com sucesso!";
				$dadosFoto['tbfotoproduto']['produto_id'] = $id;
				$dadosFoto['tbfotoproduto']['foto'] = $cod;
 				$conecta->inserir($dadosFoto);
 			}else{
 				$retornoFoto = "Erro ao enviar o arquivo " . $nome . "! Por favor tente outra vez!";
 			} 
		} 
	} 	
	$vw = 0;
	
	echo "<span class='retorno'>".$retornoFoto."</span>";
} else if(isset($_POST['alterar']) && $_POST['alterar'] == "gravar"){
	$dados = $_POST["dados"];
	
	$id = $dados['tbproduto']['id'];
	$string = " id = $id";
	
	$resultado = $conecta->alterar($dados, $string);
		
	$idArray = array($id);
	
	$dados2['tbsubproduto']['produto_id'] = $idArray;
	$dados2['tbsubproduto']['caracteristica'] = $_POST['caracteristica'];
	$dados2['tbsubproduto']['preco'] = $_POST['preco'];
	$dados2['tbsubproduto']['codigo'] = $_POST['codigo'];
	
	$idSubproduto = $_POST['subproduto'];
	$string2 = "id = $idSubproduto";
	
	
	
	//PEGAR TABELA
		$arrTabela = array_keys($dados2);
		$tabela = $arrTabela[0];
		//PEGAR CAMPOS
		$arrCampos = array_keys($dados2[$tabela]);
		//PEGAR VALORES
		$arrValores = array_values($dados2[$tabela]);	
		//CONTAR CAMPOS
		$numCampos = count($arrCampos);
		//CONTAR VALORES
		$numValores = count($arrValores);
		//VALIDAÇÃO DOS CAMPOS
		if($numCampos == $numValores && $numValores > 0){
			$sql = "UPDATE ".$tabela." SET ";
			for($i = 0; $i < $numCampos; $i++){
				if($i == 2 || $i == 3) {
					$sql .= $arrCampos[$i]." = '".str_replace(",",".",str_replace(".","",$arrValores[$i][0]))."',";
				} else {
					$sql .= $arrCampos[$i]." = '".$arrValores[$i][0]."',";
				}
			}
			$sql = substr_replace($sql, " ", -1, 1);
			$sql .= "WHERE $string2";
		} else {
			$resultadoSub = "Erro ao checar dados";	
		}
	
	$resultadoSub = $conecta->selecionar($sql);
		
	$vw = 0;
	
	$pasta = '../imagens/';
 	foreach($_FILES["img"]["error"] as $key => $error){
 
 		if($error == UPLOAD_ERR_OK){
 			$tmp_name = $_FILES["img"]["tmp_name"][$key];
 			$cod = date('dmyhg') . '-produto-' . $_FILES["img"]["name"][$key];
 			$nome = $_FILES["img"]["name"][$key];
 			$uploadfile = $pasta . basename($cod);
 
 			if(move_uploaded_file($tmp_name, $uploadfile)){
 				$retornoFoto = "O Arquivo " . $nome . " foi enviado com sucesso!";
				$dadosFoto['tbfotoproduto']['produto_id'] = $id;
				$dadosFoto['tbfotoproduto']['foto'] = $cod;
 				$conecta->inserir($dadosFoto);
 			}else{
 				$retornoFoto = "Erro ao enviar o arquivo " . $nome . "! Por favor tente outra vez!";
 			} 
		} 
	} 
	
	if($resultadoSub) {
		echo "<span class='retorno'>Produto alterado com sucesso!</span>";
	}
	
	
} elseif(isset($_GET['apagar']) && $_GET['apagar'] != ""){
	$idsubproduto = $_GET['apagar'];
	$sqlDelete = "SELECT count(s.id)  as qtde, s.produto_id as produto
						  FROM tbsubproduto s WHERE s.produto_id = (SELECT s.produto_id FROM tbsubproduto s WHERE s.id = $idsubproduto) group by produto";
	//print_r($sqlDelete);
	$resultadoSubProduto = $conecta->selecionar($sqlDelete);
	$rsSubProduto = mysql_fetch_array($resultadoSubProduto);
	
	
	if($rsSubProduto['qtde'] > 1){
		$sql_delete2 = "DELETE FROM tbsubproduto WHERE id = $idsubproduto";
		//print_r($sql_delete2);
		$resultadoDelete = $conecta->selecionar($sql_delete2);
	} else {
		$pasta = "../imagens";
		$produto = $rsSubProduto['produto'];
		
		$sql_delete3 = "SELECT f.foto as foto FROM tbfotoproduto f WHERE f.produto_id = $produto";
		//print_r($sql_delete3);
		$resultadoFoto = $conecta->selecionar($sql_delete3);
		while($rsFoto = mysql_fetch_array($resultadoFoto)){
			unlink($pasta."/".$rsFoto['foto']);
		}
		
		$sql_delete4 = "DELETE FROM tbsubproduto WHERE id = $idsubproduto";
		$sql_delete5 = "DELETE FROM tbfotoproduto WHERE produto_id = $produto";
		$sql_delete6 = "DELETE FROM tbproduto WHERE id = $produto";
		
		//print_r($sql_delete4);
		//print_r($sql_delete5);
		//print_r($sql_delete6);
		$resultadoDeleteSub = $conecta->selecionar($sql_delete4);
		$resultadoDeleteFoto = $conecta->selecionar($sql_delete5);
		$resultadoDeleteProduto = $conecta->selecionar($sql_delete6);
	}
}else if(isset($_GET['alterar']) && $_GET['alterar'] != ""){
	$id = $_GET['alterar'];
	$sql = "
			SELECT sc.id as subcategoria, p.id as produto, p.nome as nome, p.marca as marca, p.descricao as descricao, p.destaque as destaque,
				   p.especificacao as especificacao, p.dados as dados, p.inclusos as inclusos, p.garantia as garantia,
				   s.caracteristica as caracteristica, s.preco as preco, s.id as subproduto, s.codigo as codigo, f.id as fornecedor			
				   FROM tbcategoriaproduto c INNER JOIN tbsubcategoriaproduto sc on c.id = sc.categoria_id
			INNER JOIN tbproduto p on sc.id = p.subcategoria_id
			INNER JOIN tbsubproduto s on p.id = s.produto_id
			INNER JOIN tbfornecedor f on p.fornecedor_id = f.id
			WHERE s.id = $id
		";
		
			
	$resultado = $conecta->selecionar($sql);
	$rs = mysql_fetch_array($resultado);
		
	$idSubCategoria = $rs['subcategoria'];
	$idFornecedor = $rs['fornecedor'];
	$nome = $rs['nome'];
	$marca = $rs['marca'];
	$destaque = $rs['destaque'];
	$descricao = $rs['descricao'];
	$especificacao = $rs['especificacao'];
	$dados = $rs['dados'];
	$inclusos = $rs['inclusos'];
	$garantia = $rs['garantia'];
	
	$produto = $rs['produto'];
		
	$caracteristica = $rs['caracteristica'];
	$preco = $rs['preco'];
	$subproduto = $rs['subproduto'];
	$codigo = $rs['codigo'];
	
	$sqlFoto = "SELECT f.id, f.foto FROM tbfotoproduto f WHERE f.produto_id = $produto";
	$resultadoFoto = $conecta->selecionar($sqlFoto);
	
	
	
} 
?>
<div id="conteudodireita">
<?php if($vw == 1) {?>

	<div id="formularioProduto">
    	<span class="legend">Cadastro de Produtos</span><br/>
        <form action="" method="post" enctype="multipart/form-data" name="formProduto" >
        <input type="hidden" name="dados[tbproduto][id]" value="<?php echo $produto; ?>"  />
        <input type="hidden" name="subproduto" value="<?php echo $subproduto; ?>"
        
        <label>
        <span class="titulo_form">Nome</span>
        <input class="input_painel" type="text" name="dados[tbproduto][nome]" value="<?php echo $nome;?>" />
        </label>
        <label>
        <span class="titulo_form" style="width:400px;">Categoria->SubCategoria</span>
        <select class="input_painel" name="dados[tbproduto][subcategoria_id]" >
            <option value="" class="inputCampo" >Selecione...</option>
            <?php
                $resultadoCategoria = $conecta->selecionar("SELECT c.titulo as categoria, s.titulo as sub, s.id as id FROM tbcategoriaproduto c, tbsubcategoriaproduto s where s.categoria_id = c.id");
                while($rsCategoria = mysql_fetch_array($resultadoCategoria)){
            ?>
            <option <?php if($idSubCategoria == $rsCategoria['id']) { echo "selected"; } ?> value="<?php echo $rsCategoria['id']; ?>" ><?php echo $rsCategoria['categoria']."->".$rsCategoria['sub']; ?></option>
            <?php }
            ?>
        </select>
        </label>
        <label>
        <span class="titulo_form">Marca</span>
        <input class="input_painel" type="text" name="dados[tbproduto][marca]" value="<?php echo $marca; ?>"  />
        </label>
        
        <label>
        <span class="titulo_form" style="width:400px;">Parceiro</span>
        <select class="input_painel" name="dados[tbproduto][fornecedor_id]" >
            <option value="" class="inputCampo" >Selecione...</option>
            <?php
                $resultadoFornecedor = $conecta->selecionar("SELECT f.id as id, f.titulo as nome FROM tbfornecedor f WHERE f.status = 1");
                while($rsFornecedor = mysql_fetch_array($resultadoFornecedor)){
            ?>
            <option <?php if($idFornecedor == $rsFornecedor['id']) { echo "selected"; } ?> value="<?php echo $rsFornecedor['id']; ?>" ><?php echo $rsFornecedor['nome']; ?></option>
            <?php }
            ?>
        </select>
        </label>
        
		
        <span class="titulo_form">Especificações</span>
        <span class="retorno">Clique em Adicionar campos para incluir nova linha.</span>
        <div id="formularioSubProduto" class="fieldset">
       <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                        	<td width="242"><span class="tamanho_titulo">Caracteristica</span></td>
                            <td width="90"><span class="tamanho_titulo" style="width:160px;">Código Referência</span></td>
                            <td width="97"><span class="tamanho_titulo">Preço</span></td>  
                            <td>&nbsp;</td>
                    </tr>
                    </table>
        <div class="dados">
        		
                     
                   <p class="campoDados">  
                        
                        <input class="campoSub" style="width:240px;" type="text" name="caracteristica[]" value="<?php echo $caracateristica; ?>" />
                        <input class="campoSub" type="text" name="codigo[]" value="<?php echo $codigo; ?>" />
                        <input class="campoSub" type="text" name="preco[]" value="<?php echo str_replace(".",",",$preco); ?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
                        <?php
                   if(!isset($_GET['alterar'])){
				   ?>
                    <a href="#" class="removerCampos" style="text-decoration:none;"><span class="linkCampos">Remover Campos</span></a>
                   <?php
				   }
				   ?>
                   
                </p>
                </div>
                <p>
                	<?php
                   	if(!isset($_GET['alterar'])){
				   	?>
                    <span class="linkCampos"><a href="#" class="adicionarCampos">Adicionar campos</a></span>
                    <?php
				   	}
				   	?>
                </p>
         </div><br />
        
        
        <span class="titulo_form">Fotos</span>
        <span class="retorno">São permitidas 5 fotos por produto!</span>
        
        <div id="formularioSubProduto" class="fieldset">
        <?php
			if(isset($_GET['alterar'])){
				while($rsFoto = mysql_fetch_array($resultadoFoto)){
		?>
        <div id="imagem_subproduto">
        <img src="../imagens/<?php echo $rsFoto['foto']; ?>" width="80" height="80" border="1" alt=""  /><br /><a href="home.php?pagina=produto&amp;vw=1&amp;tela=<?php echo $idtela; ?>&amp;alterar=<?php echo$id;?>&amp;f=<?php echo $rsFoto['id']; ?>" >Excluir Foto </a>
        </div>
		<?php
				}
			} 
		?>
        <label>
        <input type="file" name="img[]" class="multi" maxlength="5" accept="jpeg|jpg|png|gif" />
        </label>
        </div><br />
        
        <span class="titulo_form">Promoção</span>
        <label>
        <input type="radio" name="dados[tbproduto][destaque]" <?php if($destaque == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($destaque == 0 ) { echo "checked"; } ?> name="dados[tbproduto][destaque]" value="0" /><span class="dados_grid">Não</span>
        </label>
        
        <span class="titulo_form">Mais Vendidos</span>
        <label>
        <input type="radio" name="dados[tbproduto][vendido]" <?php if($vendido == 1 ) { echo "checked"; } ?> value="1" /><span class="dados_grid">Sim</span>&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($vendido == 0 ) { echo "checked"; } ?> name="dados[tbproduto][vendido]" value="0" /><span class="dados_grid">Não</span>
        </label>
        
        <label>
        <span class="titulo_form">Embalagem</span>
        <textarea class="input_painel" rows="10" cols="70" name="dados[tbproduto][descricao]" ><?php echo $descricao;?></textarea>
        </label>
        <label>
        <span class="titulo_form">Especificação</span>
        <textarea class="input_painel" rows="10" cols="70" name="dados[tbproduto][especificacao]" ><?php echo $especificacao;?></textarea>
        </label>
        <label>
        <span class="titulo_form">Dados Técnicos</span>
        <textarea class="input_painel" rows="10" cols="70" name="dados[tbproduto][dados]" ><?php echo $dados;?></textarea>
        </label>
        <label>
        <span class="titulo_form">Itens Inclusos</span>
        <textarea class="input_painel" rows="10" cols="70" name="dados[tbproduto][inclusos]" ><?php echo $inclusos;?></textarea>
        </label>
        <label>
        <span class="titulo_form">Garantia</span>
        <textarea class="input_painel" rows="10" cols="70" name="dados[tbproduto][garantia]" ><?php echo $garantia;?></textarea>
        </label>
        
        <input class="botao_form" type="submit" <?php if(isset($_GET['alterar']) && $_GET['alterar'] != ""){ echo 'name="alterar" id="alterar"'; } else{ echo 'name="gravar" id="gravar"'; } ?> value="gravar"  />
        
        </form>
	</div>
<?php } else {
?>		
	<?php
		$sql = "
			SELECT c.titulo as categoria, sc.titulo as subcategoria, p.nome as produto, p.marca as marca,
				   s.caracteristica as caracteristica, s.preco as preco, s.id as id, f.titulo as fornecedor
			FROM tbcategoriaproduto c INNER JOIN tbsubcategoriaproduto sc on c.id = sc.categoria_id
			INNER JOIN tbproduto p on sc.id = p.subcategoria_id
			INNER JOIN tbsubproduto s on p.id = s.produto_id
			INNER JOIN tbfornecedor f on p.fornecedor_id = f.id
			ORDER BY produto, categoria, subcategoria, produto ASC
		";
		$resultado = $conecta->selecionar($sql);
		?>
    	<div id="grid">
        <table cellpadding="0" cellspacing="3" width="100%">
        	<span class="legend">Produtos</span>
            <tr>
                <td colspan="9" align="right"><span class="link_interno"><a href="home.php?pagina=subcategoriaproduto&amp;tela=8"><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Nova Sub Categoria</a></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="link_interno"><a href="home.php?pagina=categoriaproduto&amp;tela=7"><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Nova Categoria</a></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="link_interno"><a href="home.php?pagina=produto&amp;vw=1&amp;tela=<?php echo $tela_id;?>" ><img src="../images/novo2.png" width="16" height="16" border="0" /> Inserir Produto</a></span></td>
            </tr>
            <tr>
                <td width="12%" class="titulo_grid">Categoria</td>
                <td width="14%" class="titulo_grid">SubCategoria</td>
                <td width="12%" class="titulo_grid">Produto</td>
                <td width="12%" class="titulo_grid">Marca</td>
                <td width="14%" class="titulo_grid">Caracteristica</td>
                <td width="10%" class="titulo_grid">Preço</td>
                <td width="10%" class="titulo_grid">Fornecedor</td>
                <td width="6%" class="titulo_grid">Alterar</td>
                <td width="6%" class="titulo_grid">Excluir</td>
            </tr>
            <?php 
			$corproduto = '#EFEFEF';
			while($rs = mysql_fetch_array($resultado)){ 
				if($corproduto == '#EFEFEF'){
					$corproduto = '#DEDEDE';
				}else{
					$corproduto = '#EFEFEF';
				}
			?>
            <tr bgcolor="<?php echo $corproduto;?>">
                <td class="dados_grid"><?php echo $rs['categoria']; ?></td>
                <td class="dados_grid"><?php echo $rs['subcategoria']; ?></td>
                <td class="dados_grid"><?php echo $rs['produto']; ?></td>
                <td class="dados_grid"><?php echo $rs['marca']; ?></td>
                <td class="dados_grid"><?php echo $rs['caracteristica']; ?></td>
                <td class="dados_grid" align="right"><?php echo str_replace(".",",",$rs['preco']); ?></td>
                <td class="dados_grid"><?php echo $rs['fornecedor']; ?></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=produto&amp;tela=<?php echo $tela_id;?>&amp;vw=1&amp;alterar=<?php echo$rs['id'] ?>" ><img src="../images/editar.png" width="16" height="16" border="0" /></a></td>
                <td class="dados_grid" align="center"><a href="home.php?pagina=produto&amp;tela=<?php echo $tela_id;?>&amp;apagar=<?php echo$rs['id']?>" ><img src="../images/apagar.png" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php } ?>
        </table>
        </div>
    <?php	
	}
	?>
</div>