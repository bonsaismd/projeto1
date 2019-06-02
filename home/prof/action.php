<?php
include("../../login/check.php");
require_once('../../config.php');
require_once(DBAPI);

date_default_timezone_set('America/Fortaleza');
$db=open_database();
$query="INSERT INTO oferta VALUES(0,".$_POST['d_nome'].",". date("Y").",0,". (int)($_POST['qtdeAlunos']).",". (int)($_POST['qtdePraticas']).	",300);";
var_dump(mysqli_query($db,$query));
var_dump((int)($_POST['qtdeAlunos']));
var_dump($_POST['qtdePraticas']);
mysqli_query($db,$query);
$sq = "SELECT LAST_INSERT_ID()";
$resultado = mysqli_query($db,$sq) or die(mysql_error());
$encontrado = mysqli_fetch_array($resultado);
	$query="INSERT INTO oferta_professor VALUES (".$encontrado[0].",".$_SESSION['inputID']." );";
	mysqli_query($db,$query);

if (!is_null($_POST['outro_prof'])){
	$query="INSERT INTO oferta_professor VALUES (".$encontrado[0].",".($_POST['outro_prof']).");";
	mysqli_query($db,$query);
}
close_database($db);

?>