<div class="modal fade" id="modalAula" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="renderPDF">

			<div class="modal-header">
				<div class="modal-header-content text-center align-self-center">
					<h5 class="modal-title nome-disciplina" id="aulaDisciplina"><?php echo $disciplina['NOME']; ?></h5>
					<h6 class="modal-subtitle nome-professor" id="aulaProfessor">Professor</h6>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<div class="aulaInfo clearfix mb-5">
					<p class="labelAulaModal">Aula: <span id="aulaTitulo"><?php echo $aula['TITULO']; ?></span></p>
					<p class="labelAulaModal detalhe-aula">Data: <span id="aulaData">dd/mm/YYYY</span></p>
					<p class="labelAulaModal detalhe-aula text-right">Custo Total: <span id="aulaCustoTotal">R$999,99</span></p>
				</div>


				<h5 class="labelAulaModal mb-2">Fichas Técnicas desta aula:</h5>
				<div id="aulaFichas">
					<div class="card mb-3">

						<div class="card-header" id="headingOne">
							<div class="row">
								<div class="col-4 pl-0 text-left">
									<h5 class="tituloReceita mb-0">
										Titulo Receita 2
									</h5>
								</div>
								<div class="col-4 text-left">
									<h5 class="tituloReceita mb-0">
										Nº Preparações: <span id="aulaCustoReceita">9</span>
									</h5>
								</div>
								<div class="col-3 text-right">
									<h5 class="tituloReceita mb-0">
										Custo: <span id="aulaCustoReceita">R$999,99</span>
									</h5>
								</div>
								<div class="col-1 pr-0 text-right">
									<button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" onclick="mudarIcon(this)">
										<i class="fas fa-caret-down fa-2x"></i>
									</button>
								</div>
							</div>	
						</div>

						<div id="collapseOne" class="collapse">
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
										<tr class="row text-center">
											<td class="col-1">999</td>
											<td class="col-3 text-center">Nome do Insumo</td>
											<td class="col-3 text-left overflow-hidden">Descrição do Insumo</td>
											<td class="col-2 text-center">Pacote com 500g</td>
											<td class="col-2">R$99,99</td>
											<td class="col-1">9</td>
										</tr>
										<tr class="row text-center">
											<td class="col-1">999</td>
											<td class="col-3 text-center">Nome do Insumo</td>
											<td class="col-3 text-left overflow-hidden">Descrição do Insumo</td>
											<td class="col-2 text-center">Pacote com 500g</td>
											<td class="col-2">R$99,99</td>
											<td class="col-1">9</td>
										</tr>
										<thead class="thead-dark">
											<th class="col-12 text-center"> Modo de Preparo</th>
										</thead>
										<tr>
											<td class="col-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt cursus eleifend. Maecenas a sodales ex. In sit amet varius dui. Nam tellus tortor, dapibus non placerat dignissim, aliquam vitae massa. Nunc vel arcu turpis. Phasellus malesuada tortor nec metus tristique mattis. Sed pretium mi neque, tincidunt efficitur ligula elementum eu. Sed sagittis iaculis posuere. Integer vel dictum felis. Curabitur hendrerit nisi eu augue vulputate, quis pharetra justo maximus. Curabitur imperdiet turpis vitae tempor aliquam. Phasellus in scelerisque risus.</td>
										</tr>
									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="createPDF();">Gerar PDF</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	function mudarIcon(button) {
		$(button).find('i').toggleClass("fa-caret-up");
	}
</script>