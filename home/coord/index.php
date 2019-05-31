<?php
include("../../login/check.php");

include(HEADER_TEMPLATE);
include(HEADER_MENU);
?>

<?php 
if ($cargo != 'Coordenador(a)') {
	header('location:'. BASEURL . 'login/redirect.php');
	echo $cargo;
}
?>