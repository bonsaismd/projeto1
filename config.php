<?php

define('DB_NAME', 'projectdb');

define('DB_USER', 'root');

define('DB_PASSWORD', '');

define('DB_HOST', 'localhost');

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

if ( !defined('BASEURL') )
	define('BASEURL', '/');

if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . 'inc/database.php');

/** Caminho dos templates de Cabeçalho e Rodapé **/
define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');

?>