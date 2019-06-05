<?php
include("../../login/check.php");
require_once('functions.php');
carregarPedidos();

include(HEADER_TEMPLATE);
include(HEADER_MENU);
?>

<?php
if ($cargo != 'Técnico(a)') {
	header('location: '. BASEURL . 'login/redirect.php');
}
?>

<!-- Se tiver dado algum erro exibe na tela -->
<?php if (!empty($_SESSION['mensagem'])) :?> 
	<div class="alert alert-<?php echo $_SESSION['tipo']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['mensagem']; ?>
	</div>
<?php endif; ?>






<!-- LISTAGEM DE PEDIDOS -->
<div class="board">


	<!-- PESQUISAR POR PERIODO -->
	<form style="width: 40vw;">
		<div class="input-group m-2 p-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Período:</span>
			</div>
			<input type="text" class="form-control" id="dataInicial" placeholder="Data Inicial" onfocus="(this.type='date')">
			<input type="text" class="form-control" id="dataFinal" placeholder="Data Final" onfocus="(this.type='date')">
			<div class="input-group-append">
				<button class="btn btn-success" type="button" id="filterPedido"><i class="fa fa-search"></i></button> 
			</div>		
		</div>
	</form>


	<div class="board-content">
		<div class="d-flex flex-wrap p-3 text-center text-white" id="boardPedidos">

			<?php if ($pedidos) : ?>

				<?php foreach ($pedidos as $pedido) : ?>

					<?php if ($pedido['ENVIADO']) : ?>


						<a class="shadow btn btn-primary p-3 m-2 text-center" data-toggle="modal" data-target="#verPedido"

						data-disciplina='{
						"id":"<?php echo $pedido['ID']; ?>",
						"titulo":"<?php echo $pedido['TITULO']; ?>",
						"data":"<?php echo date_format(date_create($pedido['DIA_ENTREGA']), 'Y-m-d'); ?>",
						"dataShow":"<?php echo date_format(date_create($pedido['DIA_ENTREGA']), 'd/m/Y'); ?>",
						"oferta":"<?php echo $pedido['oferta_ID']; ?>",
						"obs":"<?php echo $pedido['OBSERVACAO']; ?>",
						"custo":"<?php echo $pedido['CUSTO']; ?>",
						"prof":"<?php echo pesquisarProfessorNome($pedido['oferta_ID']); ?>",
						"discip":"<?php $disciplina = pesquisarDisciplina($pedido['oferta_ID']); echo $disciplina['NOME']; ?>"
					}' >

					<div class="row d-flex align-items-center">
						<div class="col text-center">
							<i class="fas fa-utensils fa-5x"></i>
						</div>
						<div class="col text-center">
							<p><strong><?php echo $pedido['TITULO'] ?></strong></p>
							<p><?php $disciplina = pesquisarDisciplina($pedido['oferta_ID']); echo $disciplina['NOME']; ?></p>
							<p><?php echo date_format(date_create($pedido['DIA_ENTREGA']), 'd/m/Y') ?></p>
						</div>
					</div>
				</a>
				
			<?php endif; ?>
			
		<?php endforeach; ?>

		<?php else : ?>

			<td colspan="6">Nenhum pedido registrado.</td>
			
		<?php endif; ?>

	</div>
</div>
</div>


<!-- Visualizar Pedido -->
<?php include('modalPedido.php'); ?>


<script type="text/javascript">
	$(document).ready(function(){

		$("#btn-1").addClass('menu-active');

		$('#filterPedido').on('click', function() {
			var dataInicial = new Date($('#dataInicial').val());
			var dataFinal = new Date($('#dataFinal').val());

			$('#boardPedidos > a').filter(function() {
				var d = new Date($(this).data('disciplina').data);

				console.log($(this).data('disciplina').id);
				if (!((d >= dataInicial) && (d <= dataFinal))) {
					$(this).hide();
				} else {
					$(this).show();
				}

			});
		});
		
	});
</script>


<?php 
include(FOOTER_TEMPLATE);
?>