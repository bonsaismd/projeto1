<?php

mysqli_report(MYSQLI_REPORT_STRICT);

/** Abrir o Banco de Dados **/
function open_database() {
	try {

		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$conn->set_charset('utf8');
		return $conn;

	} catch (Exception $e) {

		echo $e->getMessage();
		return null;

	}
}





/** Fechar o Banco de Dados**/
function close_database($conn) {
	try {

		mysqli_close($conn);

	} catch (Exception $e) {

		echo $e->getMessage();

	}
}



function pesquisar($tabela = null, $id = null) {

	$db = open_database();
	$encontrado = null;

	try {
		if ($id) { 

			$sql = "SELECT * FROM " . $tabela . " WHERE ID = '" . $id ."';";
			$resultado = mysqli_query($db, $sql);

			if ($resultado->num_rows > 0) {
				$encontrado = mysqli_fetch_array($resultado);
			}

		} else {

      $sql = "SELECT * FROM " . $tabela;
      $resultado = mysqli_query($db, $sql);

      if ($resultado->num_rows > 0) {
        $encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
      }

    }

	} catch (Exception $e) {
    $_SESSION['mensagem'] = $e->getMessage();
    $_SESSION['tipo'] = 'danger';
  }

  close_database($db);
  return $encontrado;
}


function pesquisar_todos( $tabela ) {
  return pesquisar( $tabela );
}


function salvar( $tabela = null, $dados = null) {

	$db = open_database();

	$colunas = null;
	$valores = null;

	foreach ($dados as $dado => $valor) {
		$colunas .= trim($dado, "'") . ",";
		$valores .= "'$valor',";
	}

	$colunas = rtrim($colunas, ',');
	$valores = rtrim($valores, ',');

	$sql = "INSERT INTO " . $tabela . "($colunas)" . " VALUES " . "($valores);";

	try {

		mysqli_query($db, $sql);

		$sql = 'SELECT LAST_INSERT_ID();';
		$resultado = mysqli_query($db, $sql) or die(mysql_error());
		$listaID = mysqli_fetch_array($resultado);
		
		$_SESSION['mensagem'] = 'Adicionado com sucesso!';
		$_SESSION['tipo'] = 'success';

		return $listaID[0];

	} catch (Exception $e) {

		$_SESSION['mensagem'] = 'Falha ao adicionar!';
		$_SESSION['tipo'] = 'danger';

		return null;

	}

	close_database($db);
}

function remove( $tabela = null, $id = null ) {

	$db = open_database();

	try {

		if ($id) {

			$sql = "DELETE FROM " . $tabela . " WHERE ID = " . $id;

			mysqli_query($db, $sql);

			$_SESSION['mensagem'] = 'Removido com Sucesso!';
			$_SESSION['tipo'] = 'success';

		}

	} catch (Exception $e) {

		$_SESSION['mensagem'] = $e->getMessage();
		$_SESSION['tipo'] = 'danger';
	}

	close_database($db);
}



function update($tabela = null, $id = 0, $dados = null) {

	$db = open_database();

	$items = null;

	foreach ($dados as $key => $value) {
		$items .= trim($key, "'") . "='$value',";
	}

	$items = rtrim($items, ',');

	$sql  = "UPDATE " . $tabela . " SET " . $items ." WHERE ID=" . $id;

	try {
		mysqli_query($db, $sql);

		$_SESSION['mensagem'] = 'Insumo Atualizado com Sucesso.';
		$_SESSION['tipo'] = 'success';

	} catch (Exception $e) {

		$_SESSION['mensagem'] = 'Nao foi possivel atualizar o Insmo.';
		$_SESSION['tipo'] = 'danger';

	}

	close_database($db);

}

?>