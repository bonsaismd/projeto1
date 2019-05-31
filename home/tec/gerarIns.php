<?php
include("../../login/check.php");
require_once('functions.php');

if (isset($_POST['idPedido'])) {
	$insumosPedido = pesquisarInsumosPedido($_POST['idPedido']);

	$arrayInsumos = array();

	if (sizeof($insumosPedido) > 0) {
		foreach ($insumosPedido as $insumo) {
			array_push($arrayInsumos, pesquisar('insumo', $insumo['ingrediente_ID']));
		}
	}

	print json_encode(array('insumo'=>$insumosPedido,'insumoInfo'=>$arrayInsumos));

} else {
	die("ERRO: ID não definido.");
}

?>