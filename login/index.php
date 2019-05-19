<?php 
require_once('../config.php');
require_once(DBAPI);
include(HEADER_TEMPLATE);
?>

<a class="btn btn-light" href="<?php echo BASEURL; ?>home/prof">Professor</a>
<a class="btn btn-light" href="<?php echo BASEURL; ?>home/coord">Coordenador</a>
<a class="btn btn-light" href="<?php echo BASEURL; ?>home/tec">Técnico</a>

<?php include(FOOTER_TEMPLATE); ?>