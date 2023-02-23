<?php
class Carrinho{
	private $produto;
	public function Carrinho(){}
        //Adiciona um produto
	public function addProduto(Produto $m){
		$this->produto[] = $m;
	}
        // Recupera um produto pelo id
	public function getProduto(int $idProduto){
		foreach($this->produto as $pro){
			if($pro->getId() == $idProduto){
				return $pro;
			}
		}
	}
	
	public function getProdutos(){
		return $this->produto;
	}
	
	public function getProdutoID(){
		return $this->produto[0]->getId();
	}
	
        // Remove um produto pelo id
	public function removeProduto($idProduto){
		$j = 0;
		
		for($i=0;$i < count($this->produto);$i++){
			
			if($this->produto[$i]->getId() == $idProduto){
				
				
			}else {
				$this->produto[$j] = $this->produto[($i)];
				$j++;
			}
		}
		$z = count($this->produto)-1;
		unset($this->produto[$z]);
	}
        // lista todos os produtos
	public function listar(){
		$cor = "#eaeaea";
		
		/*
		<td width=\"100\" align=\"center\"><span class=\"titulo_orcamento\">PREÇO UNIT.</span></td>
        <td width=\"90\" align=\"center\"><span class=\"titulo_orcamento\">TOTAL</span></td>
                                    
		<td align=\"right\"><span class=\"texto_produto\">R$ ".str_replace('.',',',$pro->getPreco())."</span></td>
        <td align=\"right\"><span class=\"texto_produto\">R$ ".number_format($valor,2,',','.')."</span></td>                           
		*/
		echo "<br/>
		<table cellpadding=\"2\" cellspacing=\"3\" width=\"660\" border=\"0\" align=\"center\">
                                <tr bgcolor=\"#CCCCCC\">
                                    <td width=\"50\" height=\"40\" align=\"center\"><span class=\"titulo_orcamento\">IMAGEM</span></td>
                                    <td width=\"270\" align=\"center\"><span class=\"titulo_orcamento\">DESCRIÇÃO</span></td>
                                    <td width=\"70\" align=\"center\"><span class=\"titulo_orcamento\">QTDE.</span></td>
                                    <td></td>
                                </tr>
								
		";
		$i = 0;
		foreach($this->produto as $pro){
			$valor = ((integer)$pro->getQuantidade())*((float)$pro->getPreco());
			$valorTotal = $valorTotal + $valor;
			echo "<input type=\"hidden\" name=\"dados[nome][]\" value=\"{$pro->getCodigo} {$pro->getNome()} {$pro->getMarca()} {$pro->getCaracteristica()} \"  />
					<input type=\"hidden\" name=\"dados[subproduto][]\" value=\"{$pro->getId()}\" />";
					
					
						
			echo "<tr bgcolor=\"$cor\">	
                                	<td><a href=\"index.php?pagina=orcamento&amp;produto={$pro->getIdProduto()}\"><img src=\"imagens/".$pro->getFoto()."\" width=\"40\" border=\"0\" /></a></td>
                                    <td><span class=\"texto_produto\"><a href=\"index.php?pagina=orcamento&amp;produto={$pro->getIdProduto()}\">{$pro->getCodigo()} {$pro->getNome()} {$pro->getMarca()} {$pro->getCaracteristica()} </a></span></td>
                                    <td align=\"center\"><span class=\"texto_produto\"> <span class=\"mais\" onclick=\"menos({$i})\">-</span> <input id=\"qtde{$i}\" class=\"input_qtde\" size=\"1\" type=\"text\" name=\"dados[quantidade][]\" value=\"{$pro->getQuantidade()}\" /> <span class=\"mais\" onclick=\"mais({$i})\">+</span> </span></td>
                                    <td align=\"center\"><a href=\"index.php?pagina=carrinho&amp;id={$pro->getId()}&amp;acao=remover\"><img src=\"images/apagar.png\" width=\"12\" alt=\"\" border=\"0\" /></a></td>
                                </tr>";
			if($cor == '#eaeaea'){
				$cor = '#ffffff';
			}else{
				$cor = '#eaeaea';
			}
			$i++;
		}
		
		echo "</table>";
	}
}
?>