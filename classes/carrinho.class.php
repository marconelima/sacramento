<?php
session_start();
?>
<script language="javascript">
	function chamarfrete(){
		window.location = "index.php?pagina=carrinho&tela=26&acao=frete&cepdestino="+document.getElementById("cep").value;
	}

	function atualizaprecopac(){
		window.location = "index.php?pagina=carrinho&tela=26&acao=somarfrete&tipo=pac&manter=1&valor="+document.getElementById("precopac").value;
	}

	function atualizaprecosedex(){
		window.location = "index.php?pagina=carrinho&tela=26&acao=somarfrete&tipo=sedex&manter=1&valor="+document.getElementById("precosedex").value;
	}
</script>
<?php
class Carrinho{
	private $produto;

	//public function Carrinho(){}
        //Adiciona um produto
	public function addProduto(Produto $m){
		$this->produto[] = $m;
	}
        // Recupera um produto pelo id
	public function getProduto($idProduto){
		if(@$this->produto){
		foreach($this->produto as $pro){
			if($pro->getId() == $idProduto){
				return $pro;
			}
		}
		}
	}

	public function getQtdeProdutos(){
        if(isset($this->produto))
		    return count($this->produto);
        else
            return 0;
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
				$this->produto[$j] = $this->produto[$i];
				$j++;
			}
		}
		unset($idProduto);
		unset($this->produto[count($this->produto)-1]);
	}


	// lista todos os produtos
	public function listar(){
		/* CONEXÃO COM O BANCO DE DADOS*/
		$conecta = new Recordset;
		$conecta->conexao();

		$cor = "#eaeaea";
		echo '<div class="table-responsive">
        	<table class="table table-hover">
				<input type="hidden" value="'.$_SESSION['tela'].'" name="tela" id="tela" />';
		$i = 0;
		$total = 0;

		foreach($this->produto as $pro){
			$valor = ((integer)$pro->getQuantidade())*((float)$pro->getPreco());
			$valorTotal = @$valorTotal + $valor;

			/*$sql_estoque = "SELECT estoque FROM tbproduto WHERE id = ".substr($pro->getId(),0,(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_") : strlen($pro->getId())));*/
			$sql_estoque = "SELECT quantidade as estoque FROM tbprod_tamanhocor WHERE id = ".substr($pro->getId(),(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_")+1 : 0));
			$resultado_estoque = $conecta->selecionar($conecta->conn,$sql_estoque);
			$rs_estoque = mysqli_fetch_array($resultado_estoque);

			$sql_tamcor = "SELECT tamanho, cor FROM tbprod_tamanhocor WHERE id = ".substr($pro->getId(),(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_")+1 : 0 ) );
			$resultado_tamcor = $conecta->selecionar($conecta->conn,$sql_tamcor);

			$compemento_cortamanho = '';
			if($rs_tamcor = mysqli_fetch_array($resultado_tamcor)){
				$compemento_cortamanho = '<br/>Tamanho: '.$rs_tamcor['tamanho'].' | Cor: '.$rs_tamcor['cor'];
			}
			//{$pro->getCor()}
			echo '<tr>
					<td align="left" valign="middle" width="130"><img src="imagens/'.$pro->getFoto().'" border="0" class="img-thumbnail img_carrinho" /></td>
					<td align="left" valign="middle">'.$pro->getNome().$compemento_cortamanho.'</td>
					<td align="center" valign="middle" width="40">'.$pro->getQuantidade().'x</td>
					<td align="center" valign="middle" width="30">'.$pro->getMedida().'</td>
					<td align="right" valign="middle" width="80"><strong>R$ '.number_format($pro->getPreco(),2,",",".").'</strong></td>';
			if($pro->getQuantidade() < $rs_estoque['estoque']){
				echo '<td align="center" valign="middle" width="50"><input type="image" src="images/adicionar.png" id="acrescentar" value="'.$pro->getId().'" width="30" border="0" /></td>';
			} else {
				echo '<td align="center" valign="middle" width="50"><img src="images/adicionar_desabilitado.png" width="30" border="0" /></td>';
			}

			if($pro->getQuantidade() > 1){
				echo '<td align="center" valign="middle" width="50"><input type="image" src="images/remover.png" id="diminuir" value="'.$pro->getId().'"  width="30" border="0" /></td>';
			} else {
			echo '<td align="center" valign="middle" width="50"><img src="images/remover_desabilitado.png" width="30" border="0" /></td>';
			}
				echo '<td align="center" valign="middle" width="30"><image" src="images/apagar.png" id="remover" value="'.$pro->getId().'" width="15" border="0"/></td>
					<td align="right" valign="middle" width="100"><strong>R$ '.number_format($valor,2,",",".").'</strong></td>
				  </tr>';
			$i++;
			$total = $total + $valor;
		}
if($total < 201) {
	if(@$_SESSION['html_frete'] != ''){
		echo '<tr>
        <td colspan="5" rowspan="2" align="left" valign="middle"><span class="texto_frete">Digite o seu CEP para calular o valor do Frete</span> <input id="cep" type="text" class="input_frete" name="cep" value="'.$_SESSION['cep_destino'].'" /> <span class="btn_frete"><a id="frete" ><span class="btn btn-default">Calcular</span></a></span></td>';
		echo $_SESSION['html_frete'];

	} else {
		echo '<tr>
        <td colspan="7" align="left" valign="middle"><span class="texto_frete">Digite o seu CEP para calular o valor do Frete</span><input id="cep" type="text" name="cep" value="" class="input_frete" /> <span class="btn_frete"><a id="frete" ><span class="btn btn-default">Calcular</span></a></span></td>
        <td align="right" valign="middle" class="total_frete"></td>
      </tr>';
	}
}
      echo '<tr>
        <td colspan="5"></td>
		<td colspan="2" ><strong>TOTAL</strong></td>
        <td align="right" valign="middle" ><strong>R$ '.number_format(($total+@$_SESSION['frete']),2,",",".").'</strong></td>
      </tr>
    </table>
	</div>
	<div class="botoes_carrinho">
	    <a href="index.php?pagina=produto&amp;tela=21"><span class="btn btn-info">continuar comprando</span></a>
        <span class="btn btn-info" id="checkout" >fechar pedido</span>
	</div>';
	}


	// lista todos os produtos
	public function listar_cotacao(){
		/* CONEXÃO COM O BANCO DE DADOS*/
		$conecta = new Recordset;
		$conecta->conexao();

		$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
		$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
		$rs_configuracao = mysqli_fetch_array($resultado_configuracao);

		$siteUrl = $rs_configuracao['linkloja']."/";

		$i = 0;
		foreach($this->produto as $pro){

			$sql_tamcor = "SELECT tamanho, cor FROM tbprod_tamanhocor WHERE id = ".substr($pro->getId(),(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_")+1 : 0 ) );
			$resultado_tamcor = $conecta->selecionar($conecta->conn,$sql_tamcor);

			$compemento_cortamanho = '';
			if($rs_tamcor = mysqli_fetch_array($resultado_tamcor)){
				$compemento_cortamanho = '<br/>Tamanho: '.$rs_tamcor['tamanho'].' | Cor: '.$rs_tamcor['cor'];
			}

			if($pro->getMedida() == 'unidades') { $marcadoselg = "selected";}
			if($pro->getMedida() == 'duzias') { $marcadoselk = "selected";}

			echo '<input type="hidden" name="prodid'.$i.'" value="'.$pro->getId().'" />
				<div class="row kart-iten d-flex align-items-center" style="border: 1px solid #000;  padding: 10px; margin:5px 0;">
					<div class="col-sm-2">
						<img src="'.$siteUrl.'source/Produtos/'.$pro->getFoto().'" alt="" style="width:100%;"/>
					</div>
					<div class="col-sm-3">
						<h4>'.$pro->getNome().'</h4>
						<p>'.$compemento_cortamanho.'</p>
					</div>
					<div class="col-sm-2" style="text-align: center;">
						<h6>Quantidade</h6>
						<input type="text" name="qtde_prod'.$i.'" class="quantity" style="text-align:center; border-radius:10px;" value="'.$pro->getQuantidade(). '" size="3" />
					</div>
					<div class="col-sm-3 col-md-1 centrar-carrinho">
						<h5>Unidade</h5>
						<p>'. $pro->getMedida().'</p>
					</div>
					<div class="col-sm-3 dnone-descricao" style="padding-left: 2%;">
						<h5>Observações sobre o produto</h5>
						<textarea name="message'.$i.'" id="input-message" style="border-radius:10px;" rows="5" placeholder="Digite sua mensagem" class="placeholder">'.$pro->getComplemento(). '</textarea>
					</div>
					<div class="col-sm-2 col-md-1 centrar-carrinho">
						<h5>Excluir</h5>

						<a href="'.$siteUrl.'carrinho/48/0/0/0/0/0/0/0/0/0/'.$pro->getId().'"><img src="'.$siteUrl.'assets/img/x_mark_red.jpg" width="20" id="remover" style="width:20px !important; margin:20px 0 0 0px;" /></a>

					</div>
				</div>';

			$i++;
		}

      echo '<section class="page-section" style="padding-top: 30px;">
		<div class="container">
			<div class="row send-quotation">
				<a href="javascript:submitform()" class="btn btn-default btn-lg btn-product btn-empresa" style="padding: 1% 2%; margin: 0 2% 2% 0;">Enviar Orçamento</a>
				<a href="'.$siteUrl. 'catalogo/21" class="btn btn-default btn-lg btn-product btn-empresa" style="padding: 1% 2%; margin: 0 2% 2% 0;">Continuar Orçamento</a>
                <a href="' . $siteUrl . 'limpar/21" class="btn btn-default btn-lg btn-product btn-empresa" style="padding: 1% 2%; margin: 0 2% 2% 0;">Limpar Orçamento</a>
			</div>
		</div>
	</section>';
	}

    // lista todos os produtos
    public function listar_cotacao_logado()
    {
        /* CONEXÃO COM O BANCO DE DADOS*/
        $conecta = new Recordset;
        $conecta->conexao();

        $sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
        $resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
        $rs_configuracao = mysqli_fetch_array($resultado_configuracao);

        $siteUrl = $rs_configuracao['linkloja'] . "/";

        $API = new ComunicacaoAPI();

        if (empty($_SESSION['token_api']) || $_SESSION['token_api'] == 'erro') {

            $API->getToken('http://sistemas.spacearea.com.br/homologacao/ecommerceapi/v1/autenticacao/entrar');

            $_SESSION['token_api'] = $API->token;
        } else {
            $API->token = $_SESSION['token_api'];
        }

        $i = 0;
        
        $preco_total_carrinho = 0;
        foreach ($this->produto as $pro) {

            $preco_total_produto = 0;
            $produtos = $API->getProdutoEstoque($pro->getCodigo());

            echo "<pre>";
            print_r($produtos);
            echo "</pre>";

            $preco = 0;;
            $preco_promocional = 0;
            $estoque = 0;
            $ativo = 0;
            $unidade = '';

            $produto = json_decode($produtos);

            $i = 0;

            $preco = $produto->{'produtos'}[$i]->{'preco'};
            $preco_promocional = $produto->{'produtos'}[$i]->{'precoPromocional'};
            $estoque = $produto->{'produtos'}[$i]->{'estoque'};
            $ativo = $produto->{'produtos'}[$i]->{'ativo'};
            $unidade = $produto->{'produtos'}[$i]->{'unidade'};


            $preco = $preco > 0 ? $preco + $preco * 0.2 : 0;
            $preco_promocional = $preco_promocional > 0 ? $preco_promocional + $preco_promocional * 0.2 : 0;

            $preco = $preco_promocional > 0 ? $preco_promocional : $preco;
            
            $preco_total_produto = $preco_total_produto + ($preco * $pro->getQuantidade());
                     
            $preco_total_carrinho = $preco_total_carrinho + $preco_total_produto;

           
            $sql_tamcor = "SELECT tamanho, cor FROM tbprod_tamanhocor WHERE id = " . substr($pro->getId(), (stripos($pro->getId(), "_") > 0 ? stripos($pro->getId(), "_") + 1 : 0));
            $resultado_tamcor = $conecta->selecionar($conecta->conn, $sql_tamcor);

            $compemento_cortamanho = '';
            if ($rs_tamcor = mysqli_fetch_array($resultado_tamcor)) {
                $compemento_cortamanho = '<br/>Tamanho: ' . $rs_tamcor['tamanho'] . ' | Cor: ' . $rs_tamcor['cor'];
            }

            if ($pro->getMedida() == 'unidades' || $unidade == 'UN') {
                $marcadoselg = "selected";
            } else {
                $marcadoselg = '';
            }
            if ($pro->getMedida() == 'duzias' || $unidade == 'DZ') {
                $marcadoselk = "selected";
            } else {
                $marcadoselk = '';
            }

            echo '<input type="hidden" name="prodid' . $i . '" value="' . $pro->getId() . '" />
				<div class="row kart-iten d-flex align-items-top" style="border: 1px solid #EAEAEA;  padding: 10px; margin:5px 0;">
					<div class="col-sm-4 col-md-1">
						<img src="' . $siteUrl . 'source/Produtos/' . $pro->getFoto() . '" alt="" style="width:100%;"/>
					</div>
					<div class="col-sm-4 col-md-3">
						<h6>' . $pro->getNome() . '</h6>
						<p>' . $compemento_cortamanho . '</p>
					</div>
					<div class="col-sm-4 col-md-1" style="text-align: center;">
						<h6>Quant.</h6>
						<input type="text" name="qtde_prod' . $i . '" class="quantity" style="text-align:center; border-radius:5px; padding:2% 1%; height:30px;" value="' . $pro->getQuantidade() . '" size="3" />
					</div>
					<div class="col-sm-4 col-md-1 centrar-carrinho">
						<h6 style="text-align:center;">Unidade</h6>
						<p style="text-align:center;">'. $unidade.'</p>
					</div>
					<div class="col-sm-4 col-md-3 dnone-descricao" style="padding-left: 2%;">
						<h6>Observações sobre o produto</h6>
						<textarea name="message' . $i . '" rows="3" id="input-message" style="border-radius:5px; padding:2% 1%; max-width: 100%;" rows="5" placeholder="Digite sua mensagem" class="placeholder">' . $pro->getComplemento() . '</textarea>
					</div>
					<div class="col-sm-4 col-md-1 centrar-carrinho" style="text-align:center;">
						<h6 style="text-align:center;">Excluir</h6>

						<a href="' . $siteUrl . 'carrinho/48/0/0/0/0/0/0/0/0/0/' . $pro->getId() . '" style="text-align:center;"><img src="' . $siteUrl . 'assets/img/x_mark_red.jpg" width="20" id="remover" style="width:20px !important; margin:20px 0 0 0px;" /></a>

					</div>
                    <div class="col-sm-6 col-md-1 centrar-carrinho">
                        <h6>Preço</h6>
                        R$ ' . number_format($preco, 2, ",", ".") . '
                    </div>
                    <div class="col-sm-6 col-md-1 centrar-carrinho">
                        <h6>Total</h6>
                        R$ ' . number_format($preco_total_produto, 2, ",", ".") . '
                    </div>
				</div>';

            $i++;
        }

        echo '<section class="page-section" style="padding-top: 30px;">
		<div class="container">
			<div class="row send-quotation">
                <div style="width:50%; float:left; height:auto; text-align:left; font-weight:bold;">Total Carrinho</div>
                <div style="width:50%; float:left; height:auto; text-align:right; font-weight:bold;">R$ ' . number_format($preco_total_carrinho, 2, ",", ".") . '</div>
			</div>
		</div>
	</section>';

        echo '<section class="page-section" style="padding-top: 30px;">
		<div class="container">
			<div class="row send-quotation">
				<a href="javascript:submitform()" class="btn btn-default btn-lg btn-product btn-empresa" style="padding: 1% 2%; margin: 0 2% 2% 0;">Enviar Orçamento</a>
				<a href="' . $siteUrl . 'catalogo/21" class="btn btn-default btn-lg btn-product btn-empresa" style="padding: 1% 2%; margin: 0 2% 2% 0;">Continuar Orçamento</a>
                <a href="' . $siteUrl . 'limpar/21" class="btn btn-default btn-lg btn-product btn-empresa" style="padding: 1% 2%; margin: 0 2% 2% 0;">Limpar Orçamento</a>
			</div>
		</div>
	</section>';
    }


	// lista todos os produtos
	public function listar_cotacao_lateral(){
		/* CONEXÃO COM O BANCO DE DADOS*/
		$conecta = new Recordset;
		$conecta->conexao();

		$sql_configuracao = "SELECT * FROM tbconfiguracao WHERE id = 1";
		$resultado_configuracao = $conecta->selecionar($conecta->conn, $sql_configuracao);
		$rs_configuracao = mysqli_fetch_array($resultado_configuracao);

		$siteUrl = $rs_configuracao['linkloja']."/";

		$i = 0;
		foreach($this->produto as $pro){

			$sql_tamcor = "SELECT tamanho, cor FROM tbprod_tamanhocor WHERE id = ".substr($pro->getId(),(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_")+1 : 0 ) );
			$resultado_tamcor = $conecta->selecionar($conecta->conn,$sql_tamcor);

			$compemento_cortamanho = '';
			if($rs_tamcor = mysqli_fetch_array($resultado_tamcor)){
				$compemento_cortamanho = '<br/>Tamanho: '.$rs_tamcor['tamanho'].' | Cor: '.$rs_tamcor['cor'];
			}

				echo '<div class="media">
					<a class="pull-left" style="width:30%;" href="'.$siteUrl.'carrinho/48">
						<img class="media-object" style="max-width:100%;" src="'.$siteUrl.'source/Produtos/'.$pro->getFoto().'" alt=""/>
					</a>
					<div class="media-body">
						<h6 class="media-heading"><a href="'.$siteUrl.'carrinho/48">'.$pro->getNome().'</a></h6>
					</div>
				</div>';

			$i++;
		}

	}


    // lista todos os produtos
	public function listar_lateral(){

		/* CONEXÃO COM O BANCO DE DADOS*/
		$conecta = new Recordset;
		$conecta->conexao();



		$i = 0;
		$total = 0;

		foreach($this->produto as $pro){
			$valor = ((integer)$pro->getQuantidade())*((float)$pro->getPreco());
			$valorTotal = @$valorTotal + $valor;

			$sql_estoque = "SELECT quantidade as estoque FROM tbprod_tamanhocor WHERE id = ".substr($pro->getId(),(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_")+1 : 0));
			$resultado_estoque = $conecta->selecionar($sql_estoque);
			$rs_estoque = mysqli_fetch_array($conecta->conn,$resultado_estoque);

			$sql_tamcor = "SELECT tamanho, cor FROM tbprod_tamanhocor WHERE id = ".substr($pro->getId(),(stripos($pro->getId(),"_") > 0 ? stripos($pro->getId(),"_")+1 : 0 ) );
			$resultado_tamcor = $conecta->selecionar($conecta->conn,$sql_tamcor);

			$compemento_cortamanho = '';
			if($rs_tamcor = mysqli_fetch_array($resultado_tamcor)){
				$compemento_cortamanho = '<br/>Tamanho: '.$rs_tamcor['tamanho'].' | Cor: '.$rs_tamcor['cor'];
			}

			$car2 .= '<tr class="item">
				  <td><a href="#">'.$pro->getNome().$compemento_cortamanho.'</a></td>
				  <td>'.$pro->getQuantidade().'x</td>
				  <td class="price">R$ '.number_format($pro->getPreco(),2,",",".").'</td>
				</tr>';

			$i++;
			$total = $total + $valor;
		}

		$car = '
		<a class="btn btn-outlined-invert" href="index.php?pagina=carrinho&amp;tela=21"><i class="icon-shopping-cart-content"></i><span>'.$_SESSION["qtde"].'</span><b>'.number_format($total,2,",",".").'</b></a>
			<!--Cart Dropdown-->
			<div class="cart-dropdown">
			<span></span><!--Small rectangle to overlap Cart button-->
			<div class="body">
			  <table>
				<tr>
				  <th>Itens</th>
				  <th>Quantidade</th>
				  <th>Unidade</th>
				  <th>Preço</th>
				</tr>';

		$car .= $car2;

		$car .= '</table>
		</div>
		<div class="footer group">
		  <div class="buttons">
			<a class="btn btn-outlined-invert" href="'.$_SERVER['REQUEST_URI'].'&amp;limpar=1"><i class="icon-download"></i>Esvaziar</a>
			<a class="btn btn-outlined-invert" href="index.php?pagina=carrinho&amp;tela=21"><i class="icon-shopping-cart-content"></i>Carrinho</a>
		  </div>
		  <div class="total">R$ '.number_format($total,2,",",".").'</div>
		</div>
		</div><!--Cart Dropdown Close-->';

		echo $car;

	}

}
?>
