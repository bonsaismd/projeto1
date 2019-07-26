<!-- NOVA LISTA -->

<div class="modal fade" id="modalNovaLista" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<div class="modal-header-content">
					<h5 class="modal-title font-weight-bold">Nova Lista</h5>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body p-5">

				<form action="addLista.php" method="post" id="formNovaLista">


					<label><strong>Informe o perído da nova Lista de Pedidos:</strong></label>
					<div class="input-group">
						<input type="text" class="form-control" name="dataInicial" id="dataInicial" placeholder="Data Inicial" onfocus="(this.type='date')">
						<input type="text" class="form-control" name="dataFinal" id="dataFinal" placeholder="Data Final" onfocus="(this.type='date')">
					</div>

				</form>

			</div>

			<div class="modal-footer">
				<button type="submit" form="formNovaLista" class="btn btn-primary">Criar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>




<!-- EXCLUIR LISTA -->

 <div class="modal fade" id="excluirLista" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Excluir Lista</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Deseja realmente excluir essa Lista?</p>
			</div>

			<div class="modal-footer text-white">
				<a id="confirm" class="btn btn-success">Sim</a>
				<a id="cancel" class="btn btn-danger" data-dismiss="modal">Não</a>
			</div>

		</div>
	</div>
</div>




<!-- LISTA SEGMENTADA -->

 <div class="modal fade" id="listaSegmentada" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Lista Segmentada</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Deseja realmente excluir essa Lista?</p>
			</div>

			<div class="modal-footer text-white">
				<a id="confirm" class="btn btn-success">Sim</a>
				<a id="cancel" class="btn btn-danger" data-dismiss="modal">Não</a>
			</div>

		</div>
	</div>
</div>




<!-- LISTA UNIFICADA -->

 <div class="modal fade" id="listaUnificada" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Lista Unifificada</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Deseja realmente excluir essa Lista?</p>
			</div>

			<div class="modal-footer text-white">
				<a id="confirm" class="btn btn-success">Sim</a>
				<a id="cancel" class="btn btn-danger" data-dismiss="modal">Não</a>
			</div>

		</div>
	</div>
</div>