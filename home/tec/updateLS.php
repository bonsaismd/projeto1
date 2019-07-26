<?php
require_once('functions.php');

if (isset($_GET['id'])) {

	global $lista;
	$lista = pesquisar('lista', $_GET['id']);

} else {
	die("ERRO: ID não definido.");
}

?>
<div class="boardLS m-2 p-3">

	<div class="ls-header clearfix text-white">
		<a href="listasGeradas.php" class="btn btn-primary float-left">Voltar</a>
		<a href="gerarPDF?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-primary float-right">Baixar</a>
	</div>

	<div class="ls-body">

		<?php if($lista) : ?>
			<?php $aulas = buscarListaAulas($lista['ID']); ?>
			<?php foreach ($aulas as $key) : ?>
				<?php $aula = pesquisar('aula', $key['aula_ID']);?>

				<div class="aula mb-5 p-3 border">
					<div class="aula-header">
						<div class="aula-header-content text-center align-self-center">
							<h3 class="font-weight-bold mb-0"><?php echo $aula['TITULO']; ?></h3>
							<h4 class="font-weight-bold mb-0">(<?php echo date_format(date_create($aula['DIA_ENTREGA']), 'd/m/Y'); ?>)</h4>

						</div>
					</div>
					<hr>
					<div class="aula-body mt-3">
						<h5 class="labelAulaModal mb-1">Professor(a): <span id="aulaCustoTotal"><?php echo pesquisarProfessorNome($aula['oferta_ID']); ?></span></h5>
						<h5 class="labelAulaModal mb-3">Custo Total: <span id="aulaCustoTotal">R$ <?php echo $aula['CUSTO']; ?></span></h5>
						<h5 class="labelAulaModal mb-2">Fichas Técnicas desta aula:</h5>

						<div id="aulaFichas" class="pr-2">

							<?php $receitas = pesquisarAulaReceitas($aula['ID']); ?>
							<?php if($receitas) : ?>
								<?php foreach ($receitas as $key) : ?>
									<?php $receita = pesquisar('receita', $key['receita_ID']); ?>

									<div class="card mb-3">
										<div class="card-header" id="headingOne">
											<div class="row">
												<div class="col-8 pl-0 text-left">
													<h5 class="tituloReceita mb-0">
														<?php echo $receita['TITULO'];?> 
													</h5>
												</div>
												<!-- <div class="col-1 text-right text-white">
													<a class="btn btn-primary float-right">Novo Insumo</a>
												</div> -->
												<div class="col-3 text-right">
													<h5 class="tituloReceita mb-0">
														Custo: <span id="aulaCustoReceita">R$ <?php echo $receita['CUSTO'];?></span>
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


							</div>
						</div>
					</div>

				<?php endforeach; ?>
			<?php endif; ?>

		</div>
	</div>

	<script type="text/javascript">
		function mudarIcon(button) {
			$(button).find('i').toggleClass("fa-caret-up");
		}
	</script>