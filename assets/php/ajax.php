<?php session_start();
ob_start();
date_default_timezone_set("Brazil/East");
set_time_limit(0);

include "../../uteis/bancodados.php";
include "../../parametros.php";
include "../../funcoes.php";

include_once("../../classes/produto.class.php");
include_once("../../classes/carrinho.class.php");

$conecta = new Recordset;
$conecta->conexao();

if (isset($_POST['acao']) && @$_POST['acao'] == 'getColocarCarrinho') 
{


    if (isset($_SESSION['criar'])) {
        $carrinhoSessao = unserialize($_SESSION["carrinho"]);
    }

    if (!isset($_SESSION['criar'])) 
    {
        $Carrinho = new Carrinho();
        //Joga na sessão
        $_SESSION["carrinho"] = serialize($Carrinho);
        $_SESSION['criar'] = 1;
        $carrinhoSessao = unserialize($_SESSION["carrinho"]);
        $_SESSION['qtde'] = 0;
    }


    if (isset($_POST['produto']) && $_POST['produto'] != '') 
    {
        $produto1 = $_POST['produto'];
        $quantidade = $_POST['qtde'];

        $sqlProduto = "SELECT p.nome, p.codigo, p.id, p.marca, p.referencia, p.modelo, p.preco_promocional, p.preco, p.data_promocional_inicio, p.data_promocional_fim, p.descricao, p.peso, p.altura, p.comprimento, p.largura, c.titulo as categoria, sc.titulo as subcategoria, f.foto, f.legenda
					FROM tbproduto p inner join tbprod_subcategoria sc on sc.id = p.subcategoria_id
					inner join tbprod_categoria c on c.id = sc.categoria_id
					inner JOIN tbprod_foto f ON f.produto_id = p.id
					where p.id = $produto1 AND f.destaque = 1";

        $resultadoProduto = $conecta->selecionar($conecta->conn, $sqlProduto);
        $rs_produto = mysqli_fetch_array($resultadoProduto);
        $nome = $rs_produto['nome'];

        if ($rs_produto['preco_promocional'] > 0 && $rs_produto['data_promocional_inicio'] <= date('Y-m-d') && $rs_produto['data_promocional_fim'] >= date('Y-m-d')) {
            $preco = $rs_produto['preco_promocional'];
        } else {
            $preco = $rs_produto['preco'];
        }

        $descricao = $rs_produto['descricao'];
        $complemento = "";

        $produto = new Produto($produto1, $nome, $rs_produto['referencia'], $rs_produto['marca'], $rs_produto['modelo'], $preco, $descricao, $rs_produto['foto'], $quantidade, $rs_produto['peso'], $rs_produto['altura'], $rs_produto['comprimento'], $rs_produto['largura'], $complemento, $rs_produto['peso'], $rs_produto['codigo']);
        //Adiciona produto 1

        var_dump($produto);

        $carrinhoSessao->addProduto($produto);
        $_SESSION['qtde'] = @$_SESSION['qtde'] + $quantidade;

        $_SESSION["carrinho"] = serialize($carrinhoSessao);
    }

    var_dump($_SESSION["carrinho"]);
     var_dump("teste");

}