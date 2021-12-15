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

$ano = mysqli_real_escape_string($conecta->conn,$_GET['ano']);

$versoes = array();

$sql = "SELECT id, titulo FROM tbversao WHERE ano_id=$ano ORDER BY titulo ASC";
$res = $conecta->selecionar($conecta->conn, $sql);
while ( $row = mysqli_fetch_assoc( $res ) ) {
    $versoes[] = array(
        'id'	=> $row['id'],
        'titulo'			=> $row['titulo'],
    );
}

echo(json_encode($versoes));
