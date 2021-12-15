<?php
/**
 * Created by PhpStorm.
 * User: p054317
 * Date: 14/4/2016
 * Time: 12:54
 */

header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );

include "../uteis/bancodados.php";

$conecta = new Recordset;
$conecta->conexao();

$montadora = mysqli_real_escape_string($conecta->conn,$_GET['montadora']);

$modelos = array();

$sql = "SELECT id, titulo FROM tbmodelo WHERE montadora_id=$montadora ORDER BY titulo ASC";
$res = $conecta->selecionar($conecta->conn, $sql);
while ( $row = mysqli_fetch_assoc( $res ) ) {
    $modelos[] = array(
        'id'	=> $row['id'],
        'titulo'			=> $row['titulo'],
    );
}

echo(json_encode($modelos));