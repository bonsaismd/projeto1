<?php
include("../../login/check.php");
require_once('../../config.php');
require_once(DBAPI);
$id_usuario = $_SESSION['inputID'];
$custoT=$_POST['custoT'];
$titulo=$_POST['titulo'];
$db = open_database();
/////////////////////id, id prof, titulo, observacao, custo
$sql = "INSERT INTO receita VALUES (0, ". $id_usuario.",'".$titulo."', 'obsobsobs'," . $_POST['custoT']. ");";
mysqli_query($db,$sql) ;

$sq = "SELECT LAST_INSERT_ID()";
$resultado = mysqli_query($db,$sq) or die(mysql_error());
$encontrado = mysqli_fetch_array($resultado);


foreach ($_POST['ajax_data'] as $insumo):
$sq = "INSERT INTO receita_insumo VALUES (".$encontrado[0].", " . $insumo['id'] ."," . $insumo['qtde'] . ",'');";
$res = mysqli_query($db, $sq);
var_dump($res);
var_dump($sq);
endforeach;



close_database($db);

?>