<?php
require "verificar.php";

if(isset($_GET['cancelar']) && @$_GET['cancelar'] != ''){

	$sql_cancelar = "DELETE FROM tbeve_inscricao WHERE participante_id = ".$_SESSION['usuario_log']." AND evento_id = ".$_GET['cancelar'];
	$conecta->selecionar($sql_cancelar);

}

$tela_id = $_GET['tela'];

$sql_tela = 'SELECT * FROM tbeve_tela WHERE id = '.$tela_id;
$resultado_tela = $conecta->selecionar($sql_tela);
$rs_tela = mysql_fetch_array($resultado_tela);

$tabela = "tbeve_participante";
$idtela = $rs_tela['id'];
$nometela = $rs_tela['nome'];
$favorito = $rs_tela['favorito'];
$paginatela = $rs_tela['pagina'];


$sql_evento = "SELECT e.* FROM tbeve_evento e INNER JOIN tbeve_inscricao i ON i.evento_id = e.id WHERE i.participante_id = ".$_SESSION['usuario_log']." ORDER BY e.data_inicio ASC";
$resultado_evento = $conecta->selecionar($sql_evento);

$sql_evento_livre = "SELECT e.* FROM tbeve_evento e WHERE e.id not in (SELECT ev.id FROM tbeve_evento ev INNER JOIN tbeve_inscricao i ON i.evento_id = ev.id WHERE i.participante_id = ".$_SESSION['usuario_log'].") ORDER BY e.data_inicio ASC";
$resultado_evento_livre = $conecta->selecionar($sql_evento_livre);

$sql_part = "SELECT * FROM tbeve_participante WHERE id = ".$_SESSION['usuario_log'];
$resultado_part = $conecta->selecionar($sql_part);
$rs_part = mysql_fetch_array($resultado_part);

?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 corpo_principal_total limpa_pad">
    <h1>Eventos</h1>
    <div class="separador_titulo"></div>
    <?php include "breadcrumb.php"; ?>
		<div style="width:100%; float:left; height:10px;"></div>

		<?php include "identificacao.php"; ?>

		<div id="evento">
		<span class="titulo_minhaarea" style="text-align:left;">Eventos inscritos</span>
			<div class="evento_box_titulo">
				<span class="data_minhaarea_box">Data</span>
				<span class="nome_minhaarea_box">Nome</span>
				<span class="local_minhaarea_box">Local</span>
				<span class="status_minhaarea_box">Cancelar Inscrição</span>
			</div>
		<?php while($rs_eventos = mysql_fetch_array($resultado_evento)){ ?>
			<div class="evento_box">
				<span class="data_minhaarea"><?php echo substr($rs_eventos['data_inicio'],8,2)."/".substr($rs_eventos['data_inicio'],5,2)."/".substr($rs_eventos['data_inicio'],0,4);?></span>
				<span class="nome_minhaarea"><?php echo $rs_eventos['nome'];?></span>
				<span class="local_minhaarea"><?php echo $rs_eventos['endereco'];?></span>
				<span class="status_minhaarea"><a href="index.php?pagina=minhaarea&amp;tela=48&amp;cancelar=<?php echo $rs_eventos['id'];?>" ><img src="images/icone_excluir.png" border="0" /></a></span>
			</div>
		<?php } ?>

		<span class="titulo_minhaarea" style="text-align:left;">Próximos eventos</span>
			<div class="evento_box_titulo">
				<span class="data_minhaarea_box">Data</span>
				<span class="nome_minhaarea_box">Nome</span>
				<span class="local_minhaarea_box">Local</span>
				<span class="status_minhaarea_box">Fazer Inscrição</span>
			</div>
		<?php while($rs_eventos_livre = mysql_fetch_array($resultado_evento_livre)){ ?>
			<div class="evento_box">
				<span class="data_minhaarea"><?php echo substr($rs_eventos_livre['data_inicio'],8,2)."/".substr($rs_eventos_livre['data_inicio'],5,2)."/".substr($rs_eventos_livre['data_inicio'],0,4);?></span>
				<span class="nome_minhaarea"><?php echo $rs_eventos_livre['nome'];?></span>
				<span class="local_minhaarea"><?php echo $rs_eventos_livre['endereco'];?></span>
				<span class="status_minhaarea"><a href="index.php?pagina=inscricao&amp;tela=48&amp;eveins=<?php echo $rs_eventos_livre['id'];?>" ><img src="images/icone_incluir.png" border="0" /></a></span>
			</div>
		<?php } ?>
	</div>
	<div id="area_pergunta">
    <?php
      $sql_titulo_geral = "SELECT titulo_geral FROM tbeve_perguntas WHERE titulo_geral <> '' AND status = 1";
			$resultado_titulo_geral = $conecta->selecionar($sql_titulo_geral);
			$rs_titulo_geral = mysql_fetch_array($resultado_titulo_geral);
			$titulo_geral = $rs_titulo_geral['titulo_geral'];
			?>
		<span class="titulo_minhaarea" style="text-align:left;"><?php echo $titulo_geral;?></span>

<?php
	$sql_perguntas = "SELECT * FROM tbeve_perguntas WHERE status = 1 order by id asc";
	$resultado_perguntas = $conecta->selecionar($sql_perguntas);
	$contador = mysql_num_rows($resultado_perguntas);

if($contador > 0){
$i = 0;
while($rs_perguntas = mysql_fetch_array($resultado_perguntas)) {
?>
	<div id="box_item" class="box_item<?php echo $i;?>" style="border:0; height:auto;">
		<div id="texto_item">
			<span class="titulo_lateral_b" id="tlb<?php echo $i?>" style="margin-left:0; height:auto; width:100%;"><?php echo$rs_perguntas['pergunta']; ?></span>
			<span class="texto_b"><?php echo $rs_perguntas['resposta'];?></span>
		</div>
	</div>
<?php
			$i++;
}

} else {
echo "<img src='images/pixel.png' width='700' height='10' /><span class='favorito'>&nbsp; &nbsp; &nbsp;&nbsp;Em breve...</span>";
}
?>
	</div>
	<div style="width:100%; float:left; margin:30px 10px 0px 10px; height:1px; background:#ccc;"></div>
</div>
