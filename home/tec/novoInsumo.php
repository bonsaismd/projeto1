<div class="modal fade" id="novoInsumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="novoInsumoTitulo">Novo Insumo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<form action="add.php" method="post" id="formNovoInsumo" >

					<div class="form-row">
						<div class="col-sm-2">
							<label for="insumo['ID']">ID</label>
							<input type="number" min="0" max="9999" class="form-control" name="insumo['ID']" placeholder="ID">
						</div>
						<div class="col-sm-10">
							<label for="insumo['NOME']">Nome</label>
							<input type="text" class="form-control" name="insumo['NOME']" placeholder="Nome">
						</div>
					</div>
					<br>
					<div class="form-row">
						<div class="col-sm-12">
							<label for="insumo['DESCRICAO']">Descrição</label>
							<textarea class="form-control" name="insumo['DESCRICAO']" rows="4" placeholder="Descrição"></textarea>
						</div>
					</div>
					<br>
					<div class="form-row">
						<div class="col-sm-4">
							<label for="insumo['UNID_MEDIDA']">Unid. Medida</label>
							<input type="text" class="form-control" name="insumo['UNID_MEDIDA']" placeholder="Unid. Medida">
						</div>
						<div class="col-sm-4">
							<label for="insumo['PRECO']">Preço</label>
							<input type="number" step="0.01" min="0" max="9999" class="form-control" name="insumo['PRECO']" placeholder="Preço">
						</div>
						<div class="col-sm-4">
							<label for="insumo['SALDO']">Saldo</label>
							<input type="number" class="form-control" min="0" max="9999" name="insumo['SALDO']" placeholder="Saldo">
						</div>
					</div>

				</form>
			</div>

			<div class="modal-footer">
				<button type="submit" form="formNovoInsumo" class="btn btn-primary">Adicionar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>