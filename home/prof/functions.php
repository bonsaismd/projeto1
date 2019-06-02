<?php

/* Abrindo as configurações do banco de dados */
require_once('../../config.php');

/* Funções do banco de dados (Fica no arquivo inc/database.php)*/
require_once(DBAPI);

$insumos = null; /* Variavel global que armazena todos os insumos */
$insumo = null; /* Variavel global que armazena um único insumo */

/* Armazena todos os Insumos na variável global */
function carregarInsumos(){
	global $insumos;

	/* Função para pesquisar todos os dados da tabela 'insumo' do BD (Veio do arquivo database.php)*/
	$insumos = pesquisar_todos('insumo');
	


}

function carregarDisciplinas(){
	global $disciplinas;
	$disciplinas=pesquisar_todos('disciplina');
}
function carregarProfessores(){
	global $professores;
	$professores= pesquisar_todos('professor');
}

?>
