<?php
require_once('../../config.php');

/* Funções do banco de dados (Fica no arquivo inc/database.php)*/
require_once(DBAPI);

$r =pesquisar('insumo',$_POST['ID']);

echo $r['PRECO'];
/*$output='<input class="form-control" id="precoUnit" type="number" value='. .'  disabled="true" style="width: 100px;">';
echo $output;
*/

?>
