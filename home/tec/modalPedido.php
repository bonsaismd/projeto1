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

				<table class="table table-bordered table-hover">
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
							<tr class="align-items-center"> 
								<th class="">ID</th>
								<th class="thNome">Ingrediente</th>
								<th class="">Unidade</th>
								<th class="">Preço</th>
								<th class="">Quantidade</th>
								<th class="">Total</th>
							</tr>
						</thead>
						<tbody id="tabelaInsumosPedido">

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