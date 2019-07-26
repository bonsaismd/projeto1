<?php
require_once('functions.php');

if (isset($_GET['id'])) {

} else {
	die("ERRO: ID não definido.");
}

?>

<div class="modal-dialog modal-lg modal-dialog-centered">
	<div class="modal-content">

		<div class="modal-header">
			<h5 class="modal-title font-weight-bold">Lista Unificada de Insumos</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<div class="modal-body lu-body">
			<table class="table table-hover p-0 m-0">

				<thead class="thead-dark">
					<tr class="row text-center">
						<th class="col-1">ID</th>
						<th class="col-3">Insumo</th>
						<th class="col-3">Descrição</th>
						<th class="col-2">Unidade</th>
						<th class="col-2">Preço</th>
						<th class="col-1">Qtd</th>
					</tr>
				</thead>

				<tbody id="tabelaInsumos">
					<?php $insumos = buscarListaInsumos($_GET['id']) ?>
					<?php foreach ($insumos as $ins) : ?>
						<?php $insumo = pesquisar('insumo', $ins['insumo_ID']); ?>
						<tr class="row text-center">
							<td class="col-1"><?php echo $insumo['ID']; ?></td>
							<td class="col-3 text-center"><?php echo $insumo['NOME']; ?></td>
							<td class="col-3 text-left overflow-hidden"><?php echo $insumo['DESCRICAO']; ?></td>
							<td class="col-2 text-center"><?php echo $insumo['UNID_MEDIDA']; ?></td>
							<td class="col-2">R$ <?php echo $insumo['PRECO']*$ins['QUANTIDADE']; ?></td>
							<td class="col-1"><?php echo $ins['QUANTIDADE']; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>

			</table>
		</div>

		<div class="modal-footer text-white">
			<a href="gerarPDF?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-primary">Baixar</a>
			<a class="btn btn-secondary" data-dismiss="modal">Fechar</a>
		</div>

	</div>
</div>