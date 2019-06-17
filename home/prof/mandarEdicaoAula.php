<?php
////////////PRECISO FAZER ISSO !!!
////////// dar update na receita botando o novo custo total e obs
/////////dropar tds os insumos e botar insumos novamente
include("../../login/check.php");
require_once('../../config.php');
require_once(DBAPI);
$id_usuario = $_SESSION['inputID'];
$custoT=$_POST['custoT'];
$titulo=$_POST['titulo'];
$id=$_POST['id'];
$obs="obsobs";
$db = open_database();
/////////////////////id, id prof, titulo, observacao, custo
$sql="UPDATE receita SET TITULO=".$titulo.", OBSERVACAO=".$obs.",CUSTO=".$custoT." WHERE ID=".$id.";";
mysqli_query($db,$sql) ;

$sq="DELETE FROM receita_insumo WHERE receita_ID=".$id.";";

foreach ($_POST['ajax_data_e'] as $insumo):
$sq = "INSERT INTO receita_insumo VALUES (".$id.", " . $insumo['id'] ."," . $insumo['qtde'] . ",'');";
$res = mysqli_query($db, $sq);
var_dump($res);
var_dump($sq);
endforeach;



close_database($db);

?>