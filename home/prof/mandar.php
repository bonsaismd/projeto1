<?php
require_once('../../config.php');
require_once(DBAPI);

if (isset($_POST['ajax_data'])) {

$db = open_database();
$sql = "INSERT INTO pedido VALUES (0, 0, 0, 'comprar carne ruim','miohos', '1999-12-29');";

mysqli_query($db,$sql) or die(mysql_error());

$sql = "SELECT LAST_INSERT_ID()";
$resultado = mysqli_query($db,$sql) or die(mysql_error());
$encontrado = mysqli_fetch_array($resultado);


foreach ($_POST['ajax_data'] as $insumo):
var_dump($insumo['qtde']);

$sq = "INSERT INTO lista_pedido VALUES (" . $insumo['qtde'] . "," . $insumo['id'] ."," . (int)$encontrado[0] . ");";
$res = mysqli_query($db, $sq);
endforeach;

	echo "Deu bom :)";

} else {

	echo "Deu ruim :(";

}


close_database($db);

/*$output='<input class="form-control" id="precoUnit" type="number" value='. .'  disabled="true" style="width: 100px;">';
echo $output;*/
?>


