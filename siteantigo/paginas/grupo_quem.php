<?php


	$sql = "SELECT * FROM $tabela WHERE tela_id = $idtela AND status = 1 ";

	$resultado = $conecta->selecionar($sql);

?>

<div id="corpo">
	<?php include "busca.php"; ?>
    <div style="width:760px; height:auto; position:relative; float:left; margin:15px;">
        <div id="titulo_principal" style="width:760px;"><span class="titulo_principal"><?php echo convertem($nometela,1); ?></span></div>
        <div id="separacao_principal"></div>

            <?php
            if($rs = mysql_fetch_array($resultado)) { 
            ?>
            <div id="box_item_detalhe_titulo" style="width:760px;"><span class="nome_item_grande"><strong><?php echo $rs['titulo']; ?></strong></span></div>
            <div id="box_item_detalhe_texto" style="width:760px;">
                <span class="texto_detalhe_item" style="width:760px;">
                    <?php echo $rs['conteudo']; ?>
                </span>
            </div>
            <?php
            } else {
                echo "<span class='data_vermelha'>Não existem registros a serem apresentados!</span>";
            }
            ?>
        <div id="box_link_bottom" style="width:760px;"><span class="link_bottom"><a href="#">Topo</a> </span></div>
    </div>
</div>
