<?php
	require_once('functions.php');
	index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
  <div class="row">
    <div class="col-sm-8">
      <h1>Clientes</h1>
    </div>
    <div class="col-sm-4 text-right">
      <div class="row">
        <div class="col-6">
          <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Cliente</a>
        </div>
        <div class="col-6">
          <a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
        </div>
      </div>
    </div>
  </div>
</header>

<?php include(FOOTER_TEMPLATE); ?>