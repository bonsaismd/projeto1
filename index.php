<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>
<?php $db = open_database(); ?>

<h1>Dashboard</h1>

<hr />

<?php if ($db) : ?>

	<div class="row">
		<div class="col-sm-3 text-center">
			<a href="cadastro" class="btn btn-primary">
				<div class="row">
					<div class="col text-center">
						<i class="fa fa-plus fa-5x"></i>
					</div>
					<div class="col text-center">
						<p>Cadastrar</p>
					</div>
				</div>
			</a>
		</div>

		<div class="col-sm-3 text-center">
			<a href="login" class="btn btn-primary">
				<div class="row">
					<div class="col text-center">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col text-center">
						<p>Logar</p>
					</div>
				</div>
			</a>
		</div>

	</div>

<?php else : ?>

	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>