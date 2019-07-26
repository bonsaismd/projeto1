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
function saldoProfessor(){
$db = open_database();
$query="SELECT oferta.SALDO,disciplina.NOME FROM oferta_professor, oferta,disciplina WHERE oferta.ID=oferta_professor.oferta_ID AND professor_autenticacao_ID =".$_SESSION['inputID']." AND oferta.disciplina_ID=disciplina.ID;";

global $saldoProf;
$saldoProf=mysqli_fetch_all(mysqli_query($db,$query));
close_database($db);

global $saldoProfT;
$saldoProfT=0;
foreach($saldoProf as $s):
  $saldoProfT+=$s[0];
endforeach;

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

function pesquisarOutroProf($id){
	$db= open_database();
	$oProf=0;

	$query = "SELECT professor_autenticacao_ID FROM oferta_professor WHERE oferta_ID = " . $id."	AND professor_autenticacao_ID!=".$_SESSION['inputID']."	;";
	$res=mysqli_query($db,$query);
	if($res!=null){
		$oProf=$res;
	}
return $oProf;
}
function carregarReceitas(){
	global $receitasProf;
	$db=open_database();
	$query="SELECT * FROM receita WHERE professor_autenticacao_ID=".$_SESSION['inputID']." ;";
	$receitasProf=mysqli_query($db,$query);
	close_database($db);
}


function insumosReceita($id){
	$db=open_database();
	$query="SELECT insumo.ID, insumo.NOME, insumo.UNID_MEDIDA, insumo.PRECO, receita_insumo.QUANTIDADE FROM receita_insumo JOIN insumo ON receita_insumo.insumo_ID=insumo.ID WHERE receita_ID=".$id.";";
	$res=mysqli_fetch_all(mysqli_query($db,$query));
	
	close_database($db);
	return $res;

}

function carregarDisciplinas(){
	global $disciplinas;
	$disciplinas=pesquisar_todos('disciplina');
}
function carregarProfessores(){
	global $professores;
	$professores= pesquisar_todos('professor');
}
function carregarDiscProf(){
	global $discProf;
	$db=open_database();
	$query="SELECT oferta_ID FROM oferta_professor WHERE professor_autenticacao_ID=".$_SESSION['inputID']." ;";
	$discProf=(mysqli_query($db,$query));

	close_database($db);
}

function receitasAula($id){
	$db=open_database();
	$query="SELECT receita.ID, receita.TITULO, receita.OBSERVACAO, receita.CUSTO FROM aula_receita JOIN receita ON aula_receita.receita_ID=receita.ID WHERE aula_ID=".$id.";";
	
	$res=(mysqli_query($db,$query));

	close_database($db);
	return $res;
}
function dadosOferta($id){
	$db= open_database();
	$query="SELECT * FROM oferta WHERE ID='".$id['oferta_ID']."';";
	$result=mysqli_query($db,$query);
	close_database($db);
	return $result;
}
function dadosOfertaP($id){
	$db= open_database();
	$query="SELECT * FROM oferta WHERE ID='".$id."';";
	$result=mysqli_query($db,$query);
	close_database($db);
	return $result;
}
function pedidoOferta($id,$ind){
	$db=open_database();
	$query="SELECT * FROM aula WHERE (oferta_ID='".$id."' AND INDEX_AULA=".$ind.");";
	$result=mysqli_query($db,$query);

	close_database($db);
	return $result;
}
function nomeOferta($id){
	$dados=mysqli_fetch_array(dadosOferta($id));
	$db= open_database();
	$query="SELECT NOME FROM disciplina WHERE ID='".$dados['disciplina_ID']."';";
	$result=mysqli_query($db,$query);

	$result = $db->query($query)->fetch_object()->NOME;
	close_database($db);
	return $result;
}

?>
