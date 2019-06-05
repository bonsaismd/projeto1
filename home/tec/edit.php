<div class="modal fade" id="editInsumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="editInsumoTitulo">Editar Insumo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<form action="editAPI.php?id=<?php echo $insumo['ID']; ?>" method="post" id="formEditInsumo" >

					<div class="form-row">
						<div class="col-sm-2">
							<label for="insumo['ID']">ID</label>
							<input type="number" min="0" max="9999" class="form-control insumo-ID" name="insumo['ID']">
						</div>
						<div class="col-sm-10">
							<label for="insumo['NOME']">Nome</label>
							<input type="text" class="form-control insumo-NOME" name="insumo['NOME']">
						</div>
					</div>
					<br>
					<div class="form-row">
						<div class="col-sm-12">
							<label for="insumo['DESCRICAO']">Descrição</label>
							<textarea class="form-control insumo-DESCRICAO" name="insumo['DESCRICAO']" rows="4" ></textarea>
						</div>
					</div>
					<br>
					<div class="form-row">
						<div class="col-sm-4">
							<label for="insumo['UNID_MEDIDA']">Unid. Medida</label>
							<input type="text" class="form-control insumo-UNID_MEDIDA" name="insumo['UNID_MEDIDA']">
						</div>
						<div class="col-sm-4">
							<label for="insumo['PRECO']">Preço</label>
							<input type="number" step="0.01" min="0" max="9999" class="form-control insumo-PRECO" name="insumo['PRECO']">
						</div>
						<div class="col-sm-4">
							<label for="insumo['QTDE_DISPONIVEL']">Saldo</label>
							<input type="number" min="0" max="9999" class="form-control insumo-QTDE_DISPONIVEL" name="insumo['QTDE_DISPONIVEL']">
						</div>
					</div>

				</form>
			</div>

			<div class="modal-footer">
				<button type="submit" form="formEditInsumo" class="btn btn-success">Salvar</button>
				<a href="#" class="btn brn-sm btn-danger align-items-left" data-toggle="modal" data-dismiss="modal" data-target="#confirmExclusao" data-insumo="<?php echo $insumo['ID']; ?>">Excluir</a>		
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>