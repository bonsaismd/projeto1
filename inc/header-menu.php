<!-- Menu -->
<?php 

$id_usuario = $_SESSION['inputID'];
$nome_usuario = $_SESSION['nome'];
$cargo = $_SESSION['cargo'];

?>
<header id="header" class="mb-4">
	<div class="row d-flex align-items-center">

		<div class="col-3" id="logo">
			<a href="index.php">
				<img src="<?php echo BASEURL; ?>img/logo-white.svg">
			</a>
		</div>

		<div class="col-3  ">
			<div class="row d-inline-flex flex-nowrap align-items-center text-white">
					<div class="col">
						<i class="fas fa-user fa-3x"></i>
					</div>
					<div class="col">
						<p class="mb-0"><strong><?php echo $cargo ?></strong></p>
						<p><?php echo $nome_usuario; ?></p>
					</div>
				</div>
		</div>

		<div class="col-3">
		</div>

		<div class="col-3 text-right">

			<?php if ($cargo == 'Professor(a)') : ?>
			<a class="btn btn-primary" href="matriz.php">Teste</a>
			<?php endif; ?>

			<?php if ($cargo == 'Coordenador(a)') : ?>
			<a class="btn btn-primary" href="<?php echo BASEURL; ?>cadastro">Cadastrar Usuários</a>
			<?php endif; ?>

			<?php if ($cargo == 'Técnico(a)') : ?>
			<a class="btn btn-primary" href="matriz.php">Estoque de Insumos </a>
			<?php endif; ?>

			<a class="btn btn-danger" href="<?php echo BASEURL; ?>login/logout.php">Sair</a>
		</div>

	</div>
</header>