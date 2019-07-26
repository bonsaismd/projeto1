<?php
include("../../login/check.php");
require_once('../../config.php');
require_once(DBAPI);

$oProf=0;
$semestre=1;
$saldoDisc=300.0;
$oProf+=($_POST['outro_prof']);
date_default_timezone_set('America/Fortaleza');
$db=open_database();
/////////////// id, id da disciplina, cor, ano, semestre, qde alunos, qd praticas, saldo, enviado
$query="INSERT INTO oferta VALUES(0,'".$_POST['d_nome']."',".(int)($_POST['etiquetas']).",". date("Y").",".$semestre.",". (int)($_POST['qtdeAlunos']).",". (int)($_POST['qtdePraticas']).	",".$saldoDisc.",0);";
mysqli_query($db,$query);

$sq = "SELECT LAST_INSERT_ID()";
$resultado = mysqli_query($db,$sq) or die(mysql_error());
$encontrado = mysqli_fetch_array($resultado);

$query="INSERT INTO oferta_professor VALUES (".$encontrado[0].",".$_SESSION['inputID']." );";
	mysqli_query($db,$query);

if ($oProf!=0){
	$query="INSERT INTO oferta_professor VALUES (".$encontrado[0].",".($_POST['outro_prof']).");";
	mysqli_query($db,$query);
}
close_database($db);
header('location:'. BASEURL . 'home/prof/index.php');
?>