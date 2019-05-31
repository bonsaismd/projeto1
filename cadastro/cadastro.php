<?php

require_once('../config.php');
require_once(DBAPI);

/** Abrindo banco de dados **/
$db = open_database();

/** Coletando informações do formulario **/
$nome = mysqli_real_escape_string($db, $_POST['nome']);
$permissao = mysqli_real_escape_string($db, $_POST['permissao']);
$id = mysqli_real_escape_string($db, $_POST['id']);
$hash = password_hash($_POST['senha'], PASSWORD_DEFAULT); /** Criptografando a senha **/
$senha = mysqli_real_escape_string($db, $hash);

/** Criando variaveis para verificar existencia no BD **/
$query_select = "SELECT ID FROM autenticacao WHERE ID = '$id'";
$select = mysqli_query($db, $query_select);
$array = mysqli_fetch_array($select);
$id_array = $array['ID'];

/** Verifica se ja existe cadastro com o ID digitado**/
if ($id_array == $id) {

  /** Alerta indicando que já existe cadastro com este ID **/
	echo "<script language='javascript' type='text/javascript'>
  alert('ID já existente!');window.location.href='../cadastro'
  </script>";

  /** Encerra processo **/
  die();

}else{

  /** Criando comandos para inserir nas tabelas **/
  $query1 = "INSERT INTO autenticacao (ID, SENHA, PERMISSAO) VALUES ('$id', '$senha', '$permissao')";
  if ($permissao == "1") {
    $query2 = "INSERT INTO professor (autenticacao_ID, NOME, PERMISSAO) VALUES ('$id', '$nome', '0')";
  }elseif ($permissao == "2") {
    $query2 = "INSERT INTO professor (autenticacao_ID, NOME, PERMISSAO) VALUES ('$id', '$nome', '1')";
  }elseif ($permissao == "3") {
    $query2 = "INSERT INTO tecnico (autenticacao_ID, NOME) VALUES ('$id', '$nome')";
  }
  
  /** Inserindo nas tabelas **/
  $insert1 = mysqli_query($db, $query1);
  $insert2 = mysqli_query($db, $query2);

  /** Exibe mensagem de sucesso caso tenha inserido **/
  if ($insert1 && $insert2) {

   echo"<script language='javascript' type='text/javascript'>
   alert('Usuário cadastrado com sucesso!');window.location.href='../'
   </script>";

  /** Exibe mensagem de erro caso não inserido **/
  }else{

   echo"<script language='javascript' type='text/javascript'>
   alert('Não foi possível cadastrar esse usuário!');window.location.href='../'
   </script>";

  }

}

/** Fechando BD **/
$db->close();
?>