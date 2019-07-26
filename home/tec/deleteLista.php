<?php
require_once('functions.php');

if (isset($_GET['id'])) {
	remove('lista', $_GET['id']);

	$db = open_database();

	$sql = "DELETE FROM lista_aula WHERE lista_ID = " . $_GET['id'];
	$resultado = mysqli_query($db, $sql);

	$sql = "DELETE FROM lista_insumo WHERE lista_ID = " . $_GET['id'];
	$resultado = mysqli_query($db, $sql);

	close_database($db);

	header('location: listasGeradas.php');

} else {
	die("ERRO: ID não definido.");
}

?>