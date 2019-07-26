<?php
require_once('functions.php');

$insumo = $_POST['insumo'];
salvar('insumo', $insumo);
header('location: matriz.php');
?>