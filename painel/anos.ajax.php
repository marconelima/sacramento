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

$modelo = mysqli_real_escape_string($conecta->conn,$_GET['modelo']);

$anos = array();

$sql = "SELECT id, ano FROM tbano WHERE modelo_id=$modelo ORDER BY ano ASC";
$res = $conecta->selecionar($conecta->conn, $sql);
while ( $row = mysqli_fetch_assoc( $res ) ) {
    $anos[] = array(
        'id'	=> $row['id'],
        'ano'			=> $row['ano'],
    );
}

echo(json_encode($anos));