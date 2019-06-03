<div class="modal fade" id="verPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="verPedidoTitulo">Pedido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body" id="renderPDF">

				<table class="table table-hover table-sm">
					<tbody>

						
						<tr class="d-flex">
							<th scope="row" class="col-2">Disciplina:</th>
							<td class="col-10"><span id="labelDisciplina"></span></td>
						</tr>
						<tr class="d-flex">
							<th scope="row" class="col-2">Aula:</th>
							<td class="col-10"><span id="labelAula"></span></td>
						</tr>
						<tr class="d-flex">
							<th scope="row" class="col-2">Professor(a):</th>
							<td class="col-10"><span id="labelProfessor"></span></td>
						</tr>
						<tr class="d-flex">
							<th scope="row" class="col-2">Data da Aula:</th>
							<td class="col-4"><span id="labelDataAula"></span></td>
							<th class="col-2">Custo Total:</th>
							<td class="col-4 table-primary">R$<span id="labelCustoTotal"></span></td>
						</tr>

					</tbody>					
				</table>


				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="tabela" > 

						<thead class="thead-dark" id="tabelaHead">
							<tr> 
								<th style="width: 5%;">ID</th>
								<th style="width: 10%;">Ingrediente</th>
								<th style="width: 10%;">Unidade</th>
								<th style="width: 5%;">Preço</th>
								<th style="width: 5%;">Quantidade</th>
								<th style="width: 5%;">Total</th>
							</tr>
						</thead>
						<tbody id="tabelaInsumosPedido">
						</tbody>

					</table>

					<table class="table table-bordered table-hover">

						<thead class="thead-dark" id="tabelaHead">
							<tr>
								<th>Observação</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><span id="labelObserv"></span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="createPDF();">Gerar PDF</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			</div>

		</div>
	</div>
</div>