<?php
include("../../login/check.php");
require_once('functions.php');

if (isset($_POST['idAula'])) {

	global $receitas;
	$receitas = pesquisarReceitas($_POST['idAula']);

	

} else {
	die("ERRO: ID não definido.");
}

?>