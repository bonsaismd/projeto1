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



/* Pesquisar no banco de dados */
/* Essa função serve pra pesquisar os dados de um ID especifico ou todos os dados de uma tabela*/
function pesquisar($tabela = null, $id = null) {

	$db = open_database(); /* Abrindo o banco de dados */
	$encontrado = null; /* Variavel para armazenar o resultado da pesquisa */

	try { /* Prevenção de erros */
		if ($id) { /* Se foi passado um ID no paramentro, pesquisar os dados de um ID especifico*/

			$sql = "SELECT * FROM " . $tabela . " WHERE ID = " . $id; /* Codigo SQL para a pesquisa*/
			$resultado = mysqli_query($db, $sql); /* Executa o codigo no banco de dados e armazena o resultado */

			if ($resultado->num_rows > 0) { /* Se for encontrado alguma coisa */
				$encontrado = mysqli_fetch_array($resultado); /* Cria um vetor que associa a coluna com o dado (Exemplo. pesquisar(tecnico, 1011) -> encontrado['nome'] = DekTec)*/
			}

		} else { /* Se não foi passado um ID no paramentro, pesquisar os dados da tabela*/

      $sql = "SELECT * FROM " . $tabela; /* Codigo SQL para a pesquisa*/
      $resultado = mysqli_query($db, $sql); /* Executa o codigo no banco de dados e armazena o resultado */

      if ($resultado->num_rows > 0) { /* Se for encontrado alguma coisa */
        $encontrado = mysqli_fetch_all($resultado, MYSQLI_ASSOC); /* Cria um vetor que associa a coluna com o dado */
      }

    }

	} catch (Exception $e) { /* Se der algum erro */
    $_SESSION['mensagem'] = $e->getMessage(); /* Armazena erro na sessão do usuario logado */
    $_SESSION['tipo'] = 'danger'; /* Tipo do erro (so pra deixar na cor vermelha kk) */

  }

  close_database($db); /* Fecha o banco */
  return $encontrado; /* Retorna o resultado */
}


/* Função genérica pra pesquisar todos os dados de uma tabela*/
function pesquisar_todos( $tabela ) {
  return pesquisar( $tabela );
}


/* Função inserir um registro no BD */
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

		$_SESSION['mensagem'] = 'Insumo adicionado com sucesso!';
		$_SESSION['tipo'] = 'success';

	} catch (Exception $e) {

		$_SESSION['mensagem'] = 'Falha ao adicionar insumo!';
		$_SESSION['tipo'] = 'danger';

	}

	close_database($db);
}

function remove( $tabela = null, $id = null ) {

	$db = open_database();

	try {

		if ($id) {

			$sql = "DELETE FROM " . $tabela . " WHERE ID = " . $id;

			mysqli_query($db, $sql);

			$_SESSION['mensagem'] = 'Insumo Removido com Sucesso!';
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