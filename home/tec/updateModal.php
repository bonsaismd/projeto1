<?php
require_once('functions.php');

if (isset($_GET['id'])) {

	global $receitas;
	$receitas = pesquisarAulaReceitas($_GET['id']);

	

} else {
	die("ERRO: ID não definido.");
}

?>

<?php if($receitas) : ?>
	<?php foreach ($receitas as $key) : ?>
		<?php $receita = pesquisar('receita', $key['receita_ID']); ?>

<div class="card mb-3">
	<div class="card-header" id="headingOne">
		<div class="row">
			<div class="col-8 pl-0 text-left">
				<h5 class="tituloReceita mb-0">
					<?php echo $receita['TITULO']; ?>
				</h5>
			</div>
			<div class="col-3 text-right">
				<h5 class="tituloReceita mb-0">
					Custo: <span id="aulaCustoReceita">R$ <?php echo $receita['CUSTO'] ?></span>
				</h5>
			</div>
			<div class="col-1 pr-0 text-right">
				<button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse<?php echo $receita['ID']?>" aria-expanded="false" aria-controls="collapse<?php echo $receita['ID']?>" onclick="mudarIcon(this)">
					<i class="fas fa-caret-down fa-2x"></i>
				</button>
			</div>
		</div>	
	</div>

	<div id="collapse<?php echo $receita['ID']?>" class="collapse">
		<div class="card-body p-1">
			<table class="table table-hover table-sm p-0 m-0">

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
					<?php $insumos = pesquisarInsumosReceita($receita['ID']) ?>
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

					<thead class="thead-dark">
						<th class="col-12 text-center"> Modo de Preparo</th>
					</thead>
					<tr>
						<td class="col-12"><?php echo $receita['OBSERVACAO']; ?></td>
					</tr>
				</tbody>

			</table>
		</div>
	</div>
</div>
	
	<?php endforeach; ?>
<?php else : ?>
	Nenhuma Receita Cadastrada!
<?php endif; ?>