<?php
require_once('functions.php');

if (isset($_POST['dataInicial']) and isset($_POST['dataInicial'])) {


	$dataInicial = $_POST['dataInicial'];
	$dataFinal = $_POST['dataFinal'];

	$lista['ID'] = 0;
	$lista['TITULO'] = date('d/m/Y', strtotime($dataInicial)) . " e " . date('d/m/Y', strtotime($dataFinal));
	$lista['OBSERVACAO'] = null;

	$listaID = salvar('lista', $lista);

	$listaAulas = buscarEntreDatas($dataInicial, $dataFinal);

	salvarListaAulas($listaID, $listaAulas);
	salvarListaInsumos($listaID, $listaAulas);

	// header("Refresh:10 ; url=listasGeradas.php");
	header('location: listasGeradas.php');

} else {

	die("ERRO: Data Inválida!");
}

?>