<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

include "../uteis/bancodados.php";
$conecta = new Recordset;
$conecta->conexao();

$id_gal = $_GET['id'];

// Define a destination
$targetFolder = '../source/Galeria'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];

	$nomefoto = $_FILES['Filedata']['name'];

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);



	if (in_array($fileParts['extension'],$fileTypes)) {
		if(move_uploaded_file($tempFile,$targetFile)){
			echo '1';
			$sql_adicionar = "INSERT INTO tbfoto (galeria_id, foto) VALUES ($id_gal,'".$nomefoto."')";
			$adicionar = $conecta->selecionar($conecta->conn,$sql_adicionar);
		}
	} else {
		echo '<div class="alert alert-danger">Tipo de Arquivo Inválido.</div>';
	}
}
?>
