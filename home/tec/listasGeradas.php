<?php
include("../../login/check.php");
require_once('functions.php');
carregarListas();

include(HEADER_TEMPLATE);
include(HEADER_MENU);
?>

<?php
if ($cargo != 'Técnico(a)') {
	header('location: '. BASEURL . 'login/redirect.php');
}
?>

<!-- Se tiver dado algum erro exibe na tela -->
<?php if (!empty($_SESSION['mensagem'])) :?> 
	<div class="alert alert-<?php echo $_SESSION['tipo']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['mensagem']; ?>
	</div>
<?php endif; ?>

<!-- LISTAGEM DE PEDIDOS -->
<div class="board">

	<div class="board-header m-2 p-3 row align-items-center">
		<div class="board-titulo col-12 p-0">
			<h1 class="font-weight-bold">Listas Geradas</h1>
		</div>
	</div>

	<div id="boardListas" class="p-3">

		<button class="fantasma-box ml-4 mb-4" data-toggle="modal"	data-target="#modalNovaLista">
			<div class="fantasma-conteudo">
				<div class="fantasma-header text-center">
					<div class="fantasma-icon"></div>
					<div class="fantasma-title">
						<h1>Nova Lista</h1>
					</div>
				</div>
				<div class="fantasma-body">
					<a class="btn-fantasma" disabled></a>
					<a class="btn-fantasma" disabled></a>
				</div>
			</div>
		</button>

		<?php if($listas) : ?>
		<?php foreach ($listas as $lista) : ?>
		<div class="lista-box ml-4 mb-4">
			<div class="lista-conteudo">
				<div class="lista-header text-center">
					<div class="lista-icon pt-2 pr-2">
						<a href="javascript:void(0);" data-toggle="modal" data-target="#excluirLista" data-lista="<?php echo $lista['ID']; ?>" class="pl-1 pr-1 float-right">
							<i class="fas fa-trash-alt"></i>
						</a>
					</div>
					<div class="lista-title">
						<h1>Pedidos entre<br><?php echo $lista['TITULO']; ?></h1>
					</div>
				</div>
				<div class="lista-body">
					<a href="#" data-lista="<?php echo $lista['ID']; ?>" class="btn-lista btn-ls">
						<span>Lista Segmentada</span>
					</a>
					<a href="#" data-toggle="modal" data-target="#listaUnificada" data-lista="<?php echo $lista['ID']; ?>" class="btn-lista">
						<span>Lista Unificada</span>
					</a>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
		<?php endif; ?>

	</div>
	
</div>


<?php include('modalLista.php'); ?>



<script type="text/javascript">
	$(document).ready(function(){

		$("#btn-2").addClass('menu-active');

	});
</script>


<?php 
include(FOOTER_TEMPLATE);
?>