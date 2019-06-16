<!-- Menu -->
<?php 

$id_usuario = $_SESSION['inputID'];
$nome_usuario = $_SESSION['nome'];
$cargo = $_SESSION['cargo'];

?>
<header id="header" class="mb-5">
	<div class="row d-flex align-items-center text-center" id="header-container">

		<div class="col-2 p-0 text-left" id="logo">
			<a href="index.php">
				<img src="<?php echo BASEURL; ?>img/logo-white.svg">
			</a>
		</div>

		<div class="col-3 p-0 text-center" id="btn-user">
			<div class="row d-inline-flex flex-nowrap align-items-center text-white">
				<div class="col">
					<i class="fas fa-user fa-3x"></i>
				</div>
				<div class="col text-left">
					<p class="mb-0"><strong><?php echo $cargo ?></strong></p>
					<p class="mb-0"><?php echo $nome_usuario; ?></p>
				</div>
			</div>
		</div>		

		<div class="col-2 p-0">

			<?php if ($cargo == 'Professor(a)') : ?>
				<a data-toggle="modal" data-target="#modalSaldo" class="btn-menu" id="btn-1">
					<div class="row d-inline-flex flex-nowrap align-items-center">
						<div class="col p-0">
							<i  class="fas fa-hand-holding-usd fa-3x"></i>
						</div>
						<div class="col p-0">
							<p class="m-0"> Visualizar Saldo</p>
						</div>
					</div>
				</a>
			<?php endif; ?>

			<?php if ($cargo == 'Técnico(a)') : ?>
				<a href="index.php" class="btn-menu" id="btn-1">
					<div class="row d-inline-flex flex-nowrap align-items-center">
						<div class="col p-0">
							<i class="fas fa-clipboard-check fa-3x"></i>
						</div>
						<div class="col p-0">
							<p class="m-0"> Pedidos Recebidos</p>
						</div>
					</div>
				</a>
			<?php endif; ?>
		</div>

		<div class="col-2 p-0 border-left border-right" id="btn-2">
			<?php if ($cargo == 'Professor(a)') : ?>
				<a href="matriz.php" class="btn-menu" id="btn-3">
					<div class="row d-inline-flex flex-nowrap align-items-center">
						<div class="col p-0">
							<i class="fas fa-box-open fa-3x"></i>
						</div>
						<div class="col p-0">
							<p class="m-0"> Matriz Licitada</p>
						</div>
					</div>
				</a>
			<?php endif; ?>

			<?php if ($cargo == 'Coordenador(a)') : ?>
				<a class="btn btn-primary" href="<?php echo BASEURL; ?>cadastro">Cadastrar Usuários</a>
			<?php endif; ?>

			<?php if ($cargo == 'Técnico(a)') : ?>
				<a href="#" class="btn-menu">
					<div class="row d-inline-flex flex-nowrap align-items-center">
						<div class="col p-0">
							<i class="fas fa-clipboard-list fa-3x"></i>
						</div>
						<div class="col p-0">
							<p class="m-0"> Listas Geradas</p>
						</div>
					</div>
				</a>
			<?php endif; ?>
		</div>

		<div class="col-2 p-0">
			<?php if ($cargo == 'Técnico(a)') : ?>
				<a href="matriz.php" class="btn-menu" id="btn-3">
					<div class="row d-inline-flex flex-nowrap align-items-center">
						<div class="col p-0">
							<i class="fas fa-box-open fa-3x"></i>
						</div>
						<div class="col p-0">
							<p class="m-0"> Matriz Licitada</p>
						</div>
					</div>
				</a>
			<?php endif; ?>
		</div>

		<div class="col-1 text-right p-0">
			<a href="<?php echo BASEURL; ?>login/logout.php">
				<div class="row d-inline-flex flex-nowrap align-items-center">
					<div class="col p-2">
						<i class="fas fa-sign-out-alt fa-2x"></i>
					</div>
					<div class="col p-0">
						<p class="m-0"> Sair </p>
					</div>
				</div>
			</a>
		</div>

	</div>
</header>