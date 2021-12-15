<?php
include "../../uteis/bancodados.php";

$conecta = new Recordset;
$conecta->conexao();

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
// Verifica se existe a variável txtnome

if (isset($_GET["txtnome"])) {

    $nome = "%".$_GET["txtnome"];

    if (empty($nome)) {
        $sql = "SELECT c.titulo as categoria, sc.titulo as subcategoria, p.nome as produto, m.titulo as marca, p.modelo, p.preco, p.estoque, p.id, p.status
				FROM tbproduto p LEFT JOIN tbprod_subcategoria sc on subcategoria_id = sc.id
				LEFT JOIN tbprod_categoria c on c.id = sc.categoria_id
				 LEFT JOIN tbprod_marca m ON m.id = p.marca";
    } else {
        $nome .= "%";
        $sql = "SELECT c.titulo as categoria, sc.titulo as subcategoria, p.nome as produto, m.titulo as marca, p.modelo, p.preco, p.estoque, p.id, p.status
				FROM tbproduto p LEFT JOIN tbprod_subcategoria sc on subcategoria_id = sc.id
				LEFT JOIN tbprod_categoria c on c.id = sc.categoria_id
				 LEFT JOIN tbprod_marca m ON m.id = p.marca WHERE p.nome like '$nome'";

    }
    sleep(1);
    $result = $conecta->selecionar($conecta->conn,$sql);
    $cont = mysqli_num_rows($result);
    // Verifica se a consulta retornou linhas
    if ($cont > 0) {
        // Atribui o código HTML para montar uma tabela
        $tabela = "<div class='dado_tabela'><table border='0'>
                    <thead>
                        <tr class='titulo_grid'>
							<th>&nbsp;</th>
														<th>CATEGORIA</th>
                            <th>PRODUTO</th>
														<th>&nbsp;</th>
														<th>MARCA / MODELO</th>
                        </tr>
                    </thead>
                    <tbody>";
        $return = "$tabela";
        // Captura os dados da consulta e inseri na tabela HTML
		$i = 0;

        while ($linha = mysqli_fetch_array($result)) {
					$color = ($color == '#FAFAFA' ? '#FFFFFF' : ($color == '#FFFFFF' ? '#FAFAFA' : '#FFFFFF'));
			$return.= "<tr class='dados_grid' style='background:".$color.";'><td width='10%'><input type='button' value='Adicionar' id='re".$i."' onclick='adicionar(".$linha["id"].",\"".$linha["produto"]."\"),desabilitarCo(".$i.");'></td>";
            $return.= "<td width='20%'>" . $linha["categoria"] ."<br/>". $linha["subcategoria"] . "</td>";
						$return.= "<td width='50%'>" . $linha["produto"] . "</td>";
						$return.= "<td width='3%'></td><td width='17%'>" . $linha["marca"] . "<br/>" . $linha["modelo"] . "</td>";
            $return.= "</tr><tr><td>&nbsp;</td></tr>";
			$i++;
        }
        echo $return.="<tr><td>&nbsp;</td></tr></tbody></table></div>";
    } else {
        // Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
        echo "<span class='retorno' style='margin-left:0;'>Não foram encontrados produtos!</span><br/>";
    }
}
?>
