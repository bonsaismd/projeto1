<?php
require_once('../../config.php');
require_once(DBAPI);

$custoT=$_POST['custoT'];

$date='1999-12-29';
$k=0;
$db = open_database();
$sql = "INSERT INTO pedido VALUES (0, 0," . $_POST['custoT']. ", 'teste','miohs', '".$date."', ".$k.");";
mysqli_query($db,$sql) ;

$sq = "SELECT LAST_INSERT_ID()";
$resultado = mysqli_query($db,$sq) or die(mysql_error());
$encontrado = mysqli_fetch_array($resultado);


foreach ($_POST['ajax_data'] as $insumo):
$sq = "INSERT INTO lista_pedido VALUES (" . $insumo['qtde'] . "," . $insumo['id'] .",".$encontrado[0]." );";
$res = mysqli_query($db, $sq);
endforeach;



close_database($db);

?>


