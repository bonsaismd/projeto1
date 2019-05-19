<?php

mysqli_report(MYSQLI_REPORT_STRICT);

/** Abrir o Banco de Dados **/
function open_database() {
	try {

		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
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

/** Pesquisa um Registro pelo ID em uma Tabela**/
function find($table = null, $matricula = null) {

	$database = open_database();
	$found = null;

	try {
		if ($matricula) {
			$sql = "SELECT * FROM " . $table . " WHERE matricula = " . $matricula;
			$result = $database->query($sql);

			if($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}

		} else {
			$sql = "SELECT * FROM " . $table;
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_all(MYSQLI_ASSOC);
			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';		

	}

  close_database($database);
  return $found;
}


/** Pesquisa todos os registros de uma tabela **/
function find_all($table) {
  return find($table);
}

?>