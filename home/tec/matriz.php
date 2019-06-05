<?php
include("../../login/check.php");
require_once('functions.php');

carregarInsumos();

$id_usuario = $_SESSION['inputID']; 
$nome_usuario = $_SESSION['nome'];

include(HEADER_TEMPLATE);
include(HEADER_MENU);
?>

<header id="header-matriz">
	<div class="row"> 
		<div class="col-sm-6 p-0">
			<h2>Matriz Licitada</h2>
		</div>
	</div>
</header>


<?php if (!empty($_SESSION['mensagem'])) : ?> 
	<div class="alert alert-<?php echo $_SESSION['tipo']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['mensagem']; ?>
	</div>
<?php endif; ?>

<div id="MatrizAnual">

	<div class="row mb-4 mt-4">
		<div class="col-sm-4 p-0">
			<div class="input-group" id="container-pesquisar">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fa fa-search"></i></span>
				</div>
				<input class="form-control pesquisar" id="procurar" type="text" placeholder="Pesquisar insumo...">
			</div> 
		</div>
		<div class="col-sm-6"></div>
		<div class="col-sm-2 p-0 text-right">
			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#novoInsumo"><i class="fa fa-plus"></i> Novo Insumo</button>
		</div>
	</div>



	<!-- Cabeçalho da tabela -->
	<table class="table table-hover mb-0">
		<thead class="thead-light" id="tabelaHead">
			<tr class="row">
				<th class="col-1">ID</th>
				<th class="col-3">Nome</th>
				<th class="col-3">Descrição</th>
				<th class="col-2">Unidade</th>
				<th class="col-1">Preço</th>
				<th class="col-1">Saldo</th>
				<th class="col-1">Opções</th>
			</tr>
		</thead>
	</table>

	<!-- Tabela de insumos -->
	<div class="table-responsive border">

		<table class="table table-hover" id="tabela" > 

			<tbody id="tabelaInsumos">

				<?php if ($insumos) : ?>

					<?php foreach ($insumos as $insumo) : ?> 

						<tr class="row text-center h-25">
							<td class="col-1"><?php echo $insumo['ID'] ?></td>
							<td class="col-3 text-left"><?php echo $insumo['NOME'] ?></td>
							<td class="col-3 text-left overflow-hidden"><?php echo $insumo['DESCRICAO'] ?></td>
							<td class="col-2"><?php echo $insumo['UNID_MEDIDA'] ?></td>
							<td class="col-1">R$<?php echo $insumo['PRECO'] ?></td>
							<td class="col-1"><?php echo $insumo['QTDE_DISPONIVEL'] ?></td>
							<td class="col-1 actions">
								<a href="#" class="btn brn-sm btn-success" data-toggle="modal" data-target="#editInsumo"
								data-insumo='{"id": "<?php echo $insumo['ID']; ?>",
								"nome":"<?php echo $insumo['NOME']; ?>",
								"desc":"<?php echo $insumo['DESCRICAO']; ?>",
								"unid":"<?php echo $insumo['UNID_MEDIDA']; ?>",
								"preco":"<?php echo $insumo['PRECO']; ?>",
								"qtde":"<?php echo $insumo['QTDE_DISPONIVEL']; ?>"}'>
								<i class="fa fa-edit"></i> Editar</a>
							</td>

						</tr>

						<?php endforeach; ?>

						<?php else : ?>
						<tr>
							<td colspan="6">Nenhum insumo encontrado.</td> 
						</tr>
						<?php endif; ?>

					</tbody>

				</table>
			</div>
		</div>

		<!-- Novo Insumo -->
		<?php include('novoInsumo.php'); ?>

		<!-- Editar Insumo -->
		<?php include('edit.php'); ?>

		<!-- Confirmação Exclusão -->
		<?php include('confirmExclusao.php'); ?>

		<!-- Script que faz a filtragem da tabela -->
		<script>
			$(document).ready(function(){

				$("#btn-3").addClass('menu-active');

				$("#procurar").on("keyup", function() { /* Sempre que uma tecla for levantada no campo de pesquisa */
					var value = $(this).val().toLowerCase();
					$('#tabelaInsumos > tr').filter(function() { /* Filtra na tabela com o valor do campo */
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
					});
				});

			});
		</script>

		<?php include(FOOTER_TEMPLATE); ?>