<?php

require_once('../config.php');
require_once(DBAPI);

$usuarios = null;
$usuario = null;

/** Listagem de Usuarios **/
function index() {
  global $usuarios;
  $usuarios = find_all('users');
}

/** Cadastrar Usuario **/
function add() {

  if (!empty($_POST['users'])) {

    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
    $customer = $_POST['customer'];
    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
    save('customers', $customer);
    header('location: index.php');
 }
}

?>