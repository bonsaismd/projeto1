<?php
include("../../login/check.php");
require_once('../../config.php');
require_once(DBAPI);
$profId=$_SESSION['inputID'];
$db=open_database();
$receitas=$_POST['ajax_aula'];
$query="INSERT INTO aula VALUES(0,".$_POST['idOferta'].",'".$_POST['tituloAula']."',".$_POST['custoAula'].",'".$_POST['dataAula']."',".$_POST['indAula'].");";

mysqli_query($db,$query);

$sq = "SELECT LAST_INSERT_ID();";
$resultado = mysqli_query($db,$sq) or die(mysql_error());
$encontrado = mysqli_fetch_array($resultado);
$aulaID=$encontrado[0];

foreach($receitas as $rec):
	$query="INSERT INTO receita VALUES(0,".$profId.",'".$rec['receitaNome']."','".$rec['comentReceita']."',".$rec['custoTotalR'].",0);";
	mysqli_query($db,$query);

	$sq = "SELECT LAST_INSERT_ID();";
	$resultado = mysqli_query($db,$sq) or die(mysql_error());
	$encontrado = mysqli_fetch_array($resultado);
	$receitaID=$encontrado[0];

	$query="INSERT INTO aula_receita VALUES(".$aulaID.",".$receitaID.",0);";
	var_dump(mysqli_query($db,$query));
	foreach($rec['insumos'] as $insR):
		$query="INSERT INTO receita_insumo VALUES(".$receitaID.",".$insR['id'].",".$insR['qtde'].");";
		var_dump(mysqli_query($db,$query));

	endforeach;
endforeach;
close_database($db);
?>
