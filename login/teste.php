<?php
require_once('../config.php');
require_once(DBAPI);
include(HEADER_TEMPLATE);
?>

<section id="loadingSection">

<div id="loading-content">
	<h1 id="loading-title">Carregando...</h1>
	
</div>

<div class="spinner-grow text-success" role="status">
 		<span class="sr-only">Loading...</span>
</div>

</section>

<?php include(FOOTER_TEMPLATE);?>