<?php
require_once('../../config.php');
require_once(DBAPI);

$insumos = null;
$insumo = null;

$aulas = null;
$aula = null;
$receitas = null;
$receita = null;
$listas = null;
$lista = null;

$insumosPedido = array();
$ofertas = null;
$oferta = null;
$disciplina = null;


function carregarInsumos(){
	global $insumos;

	$insumos = pesquisar_todos('insumo'); 
}

function carregarOfertas() {
	global $ofertas;
	$ofertas = pesquisar_todos('oferta');

}

function carregarListas() {
	global $listas;
	$listas = pesquisar_todos('lista');
}

function pesquisarAulas($id = null) {
	$encontrado = null;

	$db = open_database();

	$sql = "SELECT * FROM aula WHERE oferta_ID = '" . $id . "';";
	$resultado = mysqli_query($db, $sql);
	$encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	close_database($db);

	return $encontrado;
}

function pesquisarAulaReceitas($id = null) {

	$encontrado = null;

	$db = open_database();

	$sql = "SELECT * FROM aula_receita WHERE aula_ID = '" . $id . "';";
	$resultado = mysqli_query($db, $sql);
	$encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	close_database($db);

	return $encontrado;
}

function pesquisarInsumosReceita($id = null){
	
	$encontrado = null;

	$db = open_database();

	$sql = "SELECT * FROM receita_insumo WHERE receita_ID = '" . $id . "';";
	$resultado = mysqli_query($db, $sql);
	$encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	close_database($db);

	return $encontrado;
}

function pesquisarDisciplina($id = null) {

	$disciplina = null;
	$disciplina = pesquisar('disciplina', $id);

	return $disciplina;
}

function pesquisarProfessorID($id = null) {

	$db = open_database();
	$professor = array();

	$sql = "SELECT * FROM oferta_professor WHERE oferta_ID = " . $id;
	$resultado = mysqli_query($db, $sql);

	if ($resultado->num_rows > 0) { 
		foreach ($resultado as $prof) {
			$sql = "SELECT * FROM professor WHERE autenticacao_ID = " . $prof['professor_autenticacao_ID'];
			$resultado2 = mysqli_query($db, $sql);
			$encontrado = mysqli_fetch_array($resultado2);
			array_push($professor, $encontrado['autenticacao_ID']);
		}
	}

	close_database($db);

	return $professor;
}

function pesquisarProfessorNome($id = null) {

	$db = open_database();
	$professor = null;

	$sql = "SELECT * FROM oferta_professor WHERE oferta_ID = " . $id;
	$resultado = mysqli_query($db, $sql);

	if ($resultado->num_rows > 0) { 
		foreach ($resultado as $prof) {
			$sql = "SELECT * FROM professor WHERE autenticacao_ID = " . $prof['professor_autenticacao_ID'];
			$resultado2 = mysqli_query($db, $sql);
			$encontrado = mysqli_fetch_array($resultado2);
			$professor .= $encontrado['NOME'] . " e ";
		}
		$professor = substr($professor, 0, -3);
	}

	close_database($db);

	return $professor;
}

function excluir($id = null) {

	global $customer;
	$customer = remove('insumo', $id);

	header('location: matriz.php');

}

function edit() {

	if (isset($_GET['id'])) {
		
		$id = $_GET['id'];

		if (isset($_POST['insumo'])) {	

			$insumo = $_POST['insumo'];

			update('insumo', $id, $insumo);
			header('location: matriz.php');

		} else {

			global $insumo;
			$insumo = pesquisar('insumo', $id);

		}

	}

}

function buscarEntreDatas($d1 = null, $d2 = null){

	$db = open_database();

	$sql = "SELECT * FROM aula WHERE DIA_ENTREGA BETWEEN '$d1' and '$d2';";
	$resultado = mysqli_query($db, $sql);
	$encontrado = mysqli_fetch_all($resultado);

	close_database($db);

	return $encontrado;
}

function salvarListaAulas($listaID = null, $aulas = null){

	$db = open_database();


	foreach ($aulas as $aula) {

		$aulaID = $aula[0];

		$sql = "INSERT INTO lista_aula VALUES ('$listaID', '$aulaID');";
		$resultado = mysqli_query($db, $sql);

	}	

	close_database($db);
}

function salvarListaInsumos($listaID = null, $aulas = null){

	$db = open_database();

	foreach ($aulas as $aula) {
		$aulaID = $aula[0];
		$receitas = pesquisarAulaReceitas($aulaID);

		foreach ($receitas as $receita) {
			$insumos = pesquisarInsumosReceita($receita['receita_ID']);

			foreach ($insumos as $insumo) {

				$sql = "SELECT * FROM lista_insumo WHERE insumo_ID = '" . $insumo['insumo_ID'] ."' AND lista_ID = '". $listaID ."';";
				$resultado = mysqli_query($db, $sql);
				$insumoExiste = mysqli_fetch_array($resultado);

				if ($insumoExiste) {

					$sql = "UPDATE lista_insumo SET QUANTIDADE = ". ($insumoExiste['QUANTIDADE'] + $insumo['QUANTIDADE']) . " WHERE insumo_ID = " . $insumo['insumo_ID'] .";";

				} else {

					$sql = "INSERT INTO lista_insumo VALUES (". $insumo['insumo_ID'] .", ". $listaID .", ". $insumo['QUANTIDADE'] .");";
				}

				mysqli_query($db, $sql);
			}
		}

	}	

	close_database($db);
}

function buscarListaAulas($id = null){

	$encontrado = null;

	$db = open_database();

	$sql = "SELECT * FROM lista_aula WHERE lista_ID = '$id';";
	$resultado = mysqli_query($db, $sql);
	$encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	close_database($db);

	return $encontrado;

}

function buscarListaInsumos($id = null){
	
	$encontrado = null;

	$db = open_database();

	$sql = "SELECT * FROM lista_insumo WHERE lista_ID = '" . $id . "';";
	$resultado = mysqli_query($db, $sql);
	$encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	close_database($db);

	return $encontrado;
}

?>