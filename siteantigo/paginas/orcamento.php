<script  language="javascript">
function alterarImagem(foto){
	fotopequena = foto;
		
	document.getElementById("FotoAmplia").href = foto;
	document.getElementById("FotoGrande").src = fotopequena;
	
	
}
</script>

<?php
$where = '';
if(isset($_GET['produto'])) {
	$produto_id = $_GET['produto'];
	$where = ' WHERE p.id = '.$produto_id;
} 
		
		$sql_produto = "SELECT p.id, p.nome, p.marca, p.destaque, p.descricao,p.especificacao,p.dados,p.inclusos,p.garantia,
					 min(f.id) as idfoto, f.foto, c.titulo as categoria, sc.titulo as subcategoria, sc.id as subcategoria_id, max(s.preco) as preco, 
						c.id as categ, s.id as subcat, fo.titulo as fornecedor
				from tbproduto p
				inner join tbfotoproduto f on p.id = f.produto_id
				inner join tbsubcategoriaproduto sc on sc.id = p.subcategoria_id
				inner join tbcategoriaproduto c on c.id = sc.categoria_id
				inner join tbsubproduto s on p.id = s.produto_id
				inner join tbfornecedor fo on fo.id = p.fornecedor_id
				$where group by c.id";
				
		
$resultado_produto = $conecta->selecionar($sql_produto);

$registros = mysql_num_rows($resultado_produto);
$rsProduto = mysql_fetch_array($resultado_produto);

$sqlFoto = "SELECT * FROM tbfotoproduto WHERE produto_id = ".$rsProduto['id'];
$resultadoFoto  = $conecta->selecionar($sqlFoto);

$sqlSubProduto = "SELECT * FROM tbsubproduto WHERE produto_id = ".$rsProduto['id'];
$resultadoSubProduto = $conecta->selecionar($sqlSubProduto);	   
?>
        
        	
        	<div id="corpo">
            	<?php include "busca.php"; ?>
            	
                <span class="navegacao"><a href="index.php?pagina=home">Loja</a> >> <?php echo '<a href="index.php?pagina=produto&amp;cat='.$rsProduto['categ'].'">'.$rsProduto['categoria'].'</a> >> <a href="index.php?pagina=produto&amp;sub='.$rsProduto['subcategoria_id'].'">'.$rsProduto['subcategoria'].'</a> >> '.substr($rsProduto['nome'],0,64); ?></span>
                <div style="width:100%; height:5px; position:relative; float:left"></div>
                
                <div id="box_produto_detalhe">
                        	<div style="width:370px; height:20px; position:relative; float:left;"></div>
                            <div id="texto_titulo_produto" style="width:350px;"><?php echo $rsProduto['nome']; ?></div>
                    
                    		<div id="box_desmostracao_produto">
                            	<div id="box_demostracao_imagem">
                                   	<div id="box_imagem_produto_detalhe">
                                    	<a href="imagens/<?php echo $rsProduto['foto']; ?>" id="FotoAmplia" class="jqzoom" title="<?php echo $rsProduto['nome']; ?>" >
                                        <img id="FotoGrande" src="imagens/<?php echo $rsProduto['foto']; ?>" width="200" height="170" title="<?php echo $rsProduto['nome'];?>" border="0" >
                                        </a><span class="texto_instrucoes">Passe o mouse para ver detalhes</span>
                                    </div>
                                    <div id="box_menu_imagem_produto">
                                    	<ul class="gallery clearfix">
                                         <?php 
										 while($rsFoto = mysql_fetch_array($resultadoFoto)){
										 ?>
										<li><a href='imagens/<?php echo $rsFoto['foto'];?>' rel="prettyPhoto[gallery1]" title="<?php echo $rsFoto['titulo'];?>" ><img src="imagens/<?php echo $rsFoto['foto']; ?>" height="28" width="28" border="1" style="border-color:#999;" onMouseOver="alterarImagem('imagens/<?php echo $rsFoto['foto']; ?>')" /></a></li>
                                        
										<?php } ?></ul> 
                                        <span class="texto_instrucoes">Cique para ampliar!</span>      	
                                    </div>
                                </div>
                                <div id="box_demostracao_informacao">
                                	<div id="box_informacao_preco">
                                		<span class="label_informacao_interno_produto">Marca: </span>
                                        <span class="informacao_interno_produto"><?php echo $rsProduto['marca']; ?></span><br /><img src="images/pixel.png" height="8" width="100" border="0" /><br />
                                        <span class="label_informacao_interno_produto">Fornecedor: </span>
                                        <span class="informacao_interno_produto"><?php echo $rsProduto['fornecedor']; ?></span><br /><img src="images/pixel.png" height="8" width="100" border="0" /><br />
                                        
                                        <form name="formOrcamento" enctype="multipart/form-data" method="post" action="index.php?pagina=carrinho">
										<?php
										while($rsSubProduto = mysql_fetch_array($resultadoSubProduto)){
											if($corSub != '#dadada') {
												$corSub = '#dadada';
											} else {
												$corSub = '#eaeaea';
											}
										?>
                                        
										<div class="informacao_interno_subproduto" style="background:<?php echo $corSub; ?>;"><div class="informacao_interno_dados"><input type="radio" name="idsubproduto" checked value="<?php echo $rsSubProduto['id']; ?>" /> <?php echo $rsSubProduto['codigo']; ?> <?php echo $rsSubProduto['caracteristica']; ?> </div> </div>
										<? } ?><img src="images/pixel.png" height="8" width="100" border="0" /><br />
                                        <span class="label_informacao_interno_produto">Qtde.: </span><input type="text" name="quantidade" value="" class="orcamento_input" />&nbsp;<span class="informacao_interno_produto"></span><br />
                                    </div>
                                    <div id="box_informcao_botao">
                                    	<a href="#"><img src="images/adicionar_orcamento.png" onclick="document.formOrcamento.submit();" border="0" alt="Adicionar no Orçamento" /></a>
                                    </div>
                                    </form>
                                </div>
                                
                         	</div>
                                <span class="texto_menu">Informações do Produto</span>
                                <div id="box_menu_produto">
                                	<?php if($rsProduto['descricao'] != ''){ ?>
                                	<div id="box_menu_produto_opcao" class="box_menu_produto_opcao"><span class="texto_especificacao_produto"><a class="abamarcada" href="#box_descricao">Descrição</a></span></div>
                                    <?php } ?>
                                    <?php if($rsProduto['especificacao'] != ''){ ?>
                                    <div id="box_menu_produto_opcao" class="box_menu_produto_opcao"><span class="texto_especificacao_produto"><a href="#box_especificacao" >Especificações</a></span></div>
                                    <?php } ?>
                                    <?php if($rsProduto['dados'] != ''){ ?>
                                    <div id="box_menu_produto_opcao" class="box_menu_produto_opcao"><span class="texto_especificacao_produto"><a href="#box_dados">Dados Técnicos</a></span></div>
                                    <?php } ?>
                                    <?php if($rsProduto['inclusos'] != ''){ ?>
                                    <div id="box_menu_produto_opcao" class="box_menu_produto_opcao"><span class="texto_especificacao_produto"><a href="#box_inclusos">Itens Inclusos</a></span></div>
                                    <?php } ?>
                                    <?php if($rsProduto['garantia'] != ''){ ?>
                                    <div id="box_menu_produto_opcao" class="box_menu_produto_opcao"><span class="texto_especificacao_produto"><a href="#box_garantia">Garantia</a></span></div>
                                    <?php } ?>
                                </div>
                                <div id="box_caracteristica_produto">
                                <?php if($rsProduto['descricao'] != '') {?>
                                <div id="box_descricao" class="aba">
                                    <span class="titulo_especificacao"><a name="descricao" id="descricao"></a>Descrição</span>
                                    <span class="texto_especificacao"><?php echo $rsProduto['descricao']; ?></span>
                          		</div>
                                <?php } ?>
                                <?php if($rsProduto['especificacao'] != '') {?>
                               <div id="box_especificacao" class="aba">
                                    <span class="titulo_especificacao"><a name="descricao" id="descricao"></a>Especificação</span>
                                    <span class="texto_especificacao"><?php echo $rsProduto['especificacao']; ?></span>
                          		</div>
                                <?php } ?>
                                <?php if($rsProduto['dados'] != '') {?>
                                <div id="box_dados" class="aba">
                                    <span class="titulo_especificacao"><a name="descricao" id="descricao"></a>Dados Técnicos</span>
                                    <span class="texto_especificacao"><?php echo $rsProduto['dados']; ?></span>
                          		</div>
                                <?php } ?>
                                <?php if($rsProduto['inclusos'] != '') {?>
                                <div id="box_inclusos" class="aba">
                                    <span class="titulo_especificacao"><a name="descricao" id="descricao"></a>Itens Inclusos</span>
                                    <span class="texto_especificacao"><?php echo $rsProduto['inclusos']; ?></span>
                          		</div>
                                <?php } ?>
                                <?php if($rsProduto['garantia'] != '') {?>
                                <div id="box_garantia" class="aba">
                                    <span class="titulo_especificacao"><a name="descricao" id="descricao"></a>Garantia</span>
                                    <span class="texto_especificacao"><?php echo $rsProduto['garantia']; ?></span>
                          		</div>
                                <?php } ?>
                    	</div>
                    </div>
                
           
            </div>
        
        
