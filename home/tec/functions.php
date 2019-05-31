<?php

/* Abrindo as configurações do banco de dados */
require_once('../../config.php');

/* Funções do banco de dados (Fica no arquivo inc/database.php)*/
require_once(DBAPI);

$insumos = null; /* Variavel global que armazena todos os insumos */
$insumo = null; /* Variavel global que armazena um único insumo */

$insumosPedido = array();
$pedidos = null;
$pedido = null;
$oferta = null;
$disciplina = null;


/* Armazena todos os Insumos na variável global */
function carregarInsumos(){
	global $insumos;

	/* Função para pesquisar todos os dados da tabela 'insumo' do BD (Veio do arquivo database.php)*/
	$insumos = pesquisar_todos('insumo'); 
}

function pesquisarInsumosPedido($id = null){
	
	$encontrado = null;

	$db = open_database();

	$sql = "SELECT * FROM lista_pedido WHERE pedido_ID = " . $id; /* Codigo SQL para a pesquisa*/
	$resultado = mysqli_query($db, $sql); /* Executa o codigo no banco de dados e armazena o resultado */
	$encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	close_database($db);

	return $encontrado;
}

function carregarPedidos() {
	global $pedidos;
	$pedidos = pesquisar_todos('pedido');

}

function pesquisarDisciplina($id = null) {

	$oferta = null;
	$oferta = pesquisar('oferta', $id);

	$disciplina = null;
	$disciplina = pesquisar('disciplina', $oferta['disciplina_ID']);

	return $disciplina;
}

function pesquisarProfessorID($id = null) {

	$db = open_database();
	$professor = array();

	$sql = "SELECT * FROM oferta_professor WHERE oferta_ID = " . $id; /* Codigo SQL para a pesquisa*/
	$resultado = mysqli_query($db, $sql); /* Executa o codigo no banco de dados e armazena o resultado */

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

	$sql = "SELECT * FROM oferta_professor WHERE oferta_ID = " . $id; /* Codigo SQL para a pesquisa*/
	$resultado = mysqli_query($db, $sql); /* Executa o codigo no banco de dados e armazena o resultado */

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


/* Inserir novo insumo */
function add(){
	$insumo = $_POST['insumo'];
	salvar('insumo', $insumo);
	header('location: matriz.php');
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

?>