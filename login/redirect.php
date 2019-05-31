<?php
require_once('../config.php');
require_once(DBAPI);

session_start();

if ($_SESSION['Perm'] == 1) {

	header('location:' . BASEURL . 'home/prof');

} elseif ($_SESSION['Perm'] == 2) {

	header('location:' . BASEURL . 'home/coord');
	
} elseif ($_SESSION['Perm'] == 3) {

	header('location:' . BASEURL . 'home/tec');

} else {

	header('location:' . BASEURL . 'login/logout.php');
}
?>