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


?>