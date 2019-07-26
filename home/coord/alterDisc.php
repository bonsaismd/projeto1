<?php
include("../../login/check.php");
require_once('../../config.php');
require_once(DBAPI);
$db=open_database();

$semestre=1;
$saldoDisc=0;

$oProf=0;

$oProfAntigo=0;
$oProf+=($_POST['outro_prof_e']);
$query= "SELECT professor_autenticacao_ID FROM oferta_professor WHERE( oferta_ID=".$_POST['id_oferta_e']." AND professor_autenticacao_ID!=".$_SESSION['inputID'].");";
$oProfAntigo+= mysqli_fetch_array(mysqli_query($db,$query))[0];
var_dump('id do prof antigoh');
var_dump($oProfAntigo);
var_dump('id do prof novoh');
var_dump($oProf);
if($oProf!=$oProfAntigo){
	if($oProf>0){
		var_dump('tinha prof novoh');
//////////se tem um novo prof, insere o prof
		$query="INSERT INTO oferta_professor VALUES (".$_POST['id_oferta_e'].",".($_POST['outro_prof_e']).");";
		var_dump(mysqli_query($db,$query));

		if(($oProfAntigo!=0)){
////////e se antes tinha um prof antigo no lugar dele, tira o antigo
			var_dump('ja tinha otro prof akih');
			$query="DELETE FROM oferta_professor WHERE oferta_ID=".$_POST['id_oferta_e']." AND professor_autenticacao_ID=".$oProfAntigo.";";
			var_dump(mysqli_query($db,$query));
		}
	}else{
	////////ou seja, se não tem prof novo, mas tinha antigo, 
		if(($oProfAntigo)!=0){
			var_dump('n tinha prof novoh, mas tinha antigoh e foi excluidoh');

			$query="DELETE FROM oferta_professor WHERE oferta_ID=".$_POST['id_oferta_e']." AND professor_autenticacao_ID=".$oProfAntigo.";";
			var_dump(mysqli_query($db,$query));
		}
	}}
	date_default_timezone_set('America/Fortaleza');

	$query="SELECT SALDO from oferta WHERE ID=".$_POST['id_oferta_e'].";";
	$saldoDisc+=mysqli_fetch_array(mysqli_query($db,$query))[0];
	var_dump('o saldoh era');
	var_dump($saldoDisc);
	$qtdeAulasNova=(int)($_POST['qtdePraticas_e']);
	var_dump('agr tem tantas aulas praticas:');
	var_dump($qtdeAulasNova);
	$query="SELECT QTDE_AULAS FROM oferta WHERE ID=".$_POST['id_oferta_e'].";";
	$qtdeAulasAntiga=(int)mysqli_fetch_array(mysqli_query($db,$query))[0];
	var_dump('antes tinha:');
	var_dump($qtdeAulasAntiga);
	if($qtdeAulasNova<$qtdeAulasAntiga){
		for($i=$qtdeAulasAntiga;$i>=$qtdeAulasNova;$i--){
			$query="SELECT CUSTO FROM aula WHERE oferta_ID=".$_POST['id_oferta_e']." AND INDEX_AULA=".$i.";";
			if((mysqli_num_rows(mysqli_query($db,$query)))>0){
				var_dump('tinha aulah');
				$saldoDisc+=((mysqli_fetch_array(mysqli_query($db,$query)))[0]);
				$query="DELETE FROM aula WHERE oferta_ID=".$_POST['id_oferta_e']." AND INDEX_AULA=".$i.";";
				var_dump(mysqli_query($db,$query));
				var_dump('apagayh'		);}
			}
			$query="UPDATE oferta SET SALDO=".$saldoDisc." WHERE ID=".$_POST['id_oferta_e'].";";
			var_dump('o saldoh eh pra ser');
			var_dump($saldoDisc);
			var_dump(mysqli_query($db,$query));
		}

///update na oferta, tirar as aulas q tem q tirar, pegar o saldo da disciplina e subtrair o saldo das aulas que permaneceram cadastradas
		$query="UPDATE oferta SET disciplina_ID='".($_POST['d_nome_e'])."',COR=".(int)($_POST['etiquetas_e']).",QTDE_ALUNOS=". (int)($_POST['qtdeAlunos_e']).",QTDE_AULAS=". $qtdeAulasNova." WHERE ID=".$_POST['id_oferta_e'].";";
/////////////// id, id da disciplina, cor, ano, semestre, qde alunos, qd praticas, saldo, enviado
		var_dump($query);
		var_dump(mysqli_query($db,$query));
/////////se tinha outro professor e ele tirou, retirar o professor, caso contrario, colocar, se trocou colocar
		close_database($db);

		var_dump('oi amigohs');
		
header('location:'. BASEURL . 'home/prof/index.php');
		?>