<?php
if(@$_GET['f'] != ''){
	$idApagar = $_GET['f'];

	$recupera = $conecta->selecionar($conecta->conn,"SELECT * FROM tbfoto WHERE id = $idApagar");
	$rsRecupera = mysqli_fetch_array($recupera);

	$id = $rsRecupera['galeria_id'];
	$fotoApagar = $rsRecupera['foto'];

	if($fotoApagar != '') {
		unlink($fotoApagar);
	}

	$resultado = $conecta->selecionar($conecta->conn,"DELETE FROM tbfoto WHERE id = $idApagar");
	if($resultado == 1){
		$resultado = "<span class=\"retorno\">Foto apagada!</span>";
	} else {
		$resultado = "<span class=\"retorno\">Problemas ao apagar foto!</span>";
	}
} else if(isset($_POST['acrescentar']) && $_POST['acrescentar'] == 'Salvar'){
	$dados2['tbfoto']['legenda'] = $_POST['legenda'];


	$string = "id = ".$_POST['legendaid'];
	$conecta->alterar($dados2, $string);
}

if(isset($_GET['id'])) { $id = $_GET["id"]; } else {$id = 0;}

$sql_gal = "SELECT titulo FROM tbgaleria WHERE id = $id";
$resultado = $conecta->selecionar($conecta->conn,$sql_gal);
$rs = mysqli_fetch_array($resultado);

$_SESSION['galeria_id'] = $id;

$titulo = $rs['titulo'];

?>
	<script type="text/javascript" src="../uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '../uploadify/uploadify.swf',
				'uploader' : '../uploadify/uploadify.php?id=<?php echo @$_GET['id'];?>',
				'cancelImg' : '../uploadify/cancel.png',
				'folder'    : '../imagens',
				'fileExt'     : '*.jpg;*.gif;*.png',
				'width' : '200',
				'height' : '30',
				'buttonText'  : 'Selecione Fotos',
				'multi'		: true,
				'onQueueComplete' : function(queueData) {
					window.location.reload(true);
				}

			});
		});
	</script>
	<form class="form-horizontal" role="form" name="formNoticia" method="post" enctype="multipart/form-data" action="">
    	<input type="hidden" name="galeria_id" value="<?php echo @$id; ?>" />

    	<div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Galeria</label>
            <div class="col-sm-10">
            	<input type="text" disabled value="<?php echo $titulo;?>" class="form-control" id="titulo">

            </div>
        </div>

        <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Fotos</label>
            <div class="col-sm-10">
              <input id="file_upload" type="file" name="file_upload"/>
            </div>
        </div>



	</form>

    <div class="row superior">

      	<?php
        $loopH = 5;
    	$resultadoFoto = $conecta->selecionar($conecta->conn,"SELECT * FROM tbfoto WHERE galeria_id = $id");
		$i = 1;
		while($rsFoto = mysqli_fetch_array($resultadoFoto)){
			$legenda = $rsFoto['legenda'];
		?>
        <form name="formFoto" method="post" enctype="multipart/form-data" action="">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="legendaid" value="<?php echo $rsFoto['id'];?>" />
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                <a href="#" class="thumbnail">
                  <img data-src="holder.js/100%" src="../source/Galeria/<?php echo $rsFoto['foto'];?>" alt="...">
                </a>
                <a href="home.php?pagina=foto&amp;f=<?php echo $rsFoto['id'];?>&amp;id=<?php echo $id;?>" class="centro"><div class="text-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Excluir Foto</div></a>
                <input type="text" name="legenda" value="<?php echo $legenda;?>" maxlength="125" class="form-control" />
                <input type="submit" value="Salvar" name="acrescentar" class="btn btn-default centro" />
            </div>
        </form>
	  	<?php $i++; } ?>
    </div>
