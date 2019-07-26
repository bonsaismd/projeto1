<?php
include("../../login/check.php");
require_once('functions.php');
carregarOfertas();

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

	
	<div class="board-header m-2 p-3 row align-items-center">
		<div class="board-titulo col-6 p-0">
			<h1 class="font-weight-bold">Pedidos Recebidos</h1>
		</div>
		<!-- PESQUISAR POR PERIODO -->
		<div class="col-6 p-0">
			<form class="float-right" style="width: 40vw;">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text font-weight-bold">Período:</span>
					</div>
					<input type="text" class="form-control" id="dataInicial" placeholder="Data Inicial" onfocus="(this.type='date')">
					<input type="text" class="form-control" id="dataFinal" placeholder="Data Final" onfocus="(this.type='date')">
					<div class="input-group-append">
						<button class="btn btn-primary" type="button" id="filterPedido"><i class="fa fa-search"></i></button> 
					</div>		
				</div>
			</form>
		</div>
	</div>

	<!-- PEDIDOS -->
	<div class="board-content">
		<div class="p-3" id="boardPedidos">
			<?php if ($ofertas) : ?>
				<?php foreach ($ofertas as $oferta) : ?>
					<?php if ($oferta['ENVIADO']) : ?>
						<?php $disciplina = pesquisar('disciplina', $oferta['disciplina_ID']); ?>

			<div class="pedido-coluna">
				<div class="pedido-conteudo">
					<div class="pedido-header text-center">
						<h2 class="nome-disciplina"><?php echo $disciplina['NOME']; ?></h2>
						<h3 class="nome-professor"><?php echo pesquisarProfessorNome($oferta['ID']); ?></h3>
					</div>
					<div class="pedido-body">

						<?php $aulas = pesquisarAulas($oferta['ID']); ?>
						<?php foreach ($aulas as $aula) : ?>

						<a href="javascript:void(0);"
						class="btn-aula"
						data-toggle="modal"
						data-target="#modalAulaT"
						data-info='{
						"id":"<?php echo $aula['ID']; ?>",
						"disciplina":"<?php echo $disciplina['NOME']; ?>",
						"professor":"<?php echo pesquisarProfessorNome($oferta['ID']); ?>",
						"aula":"<?php echo $aula['TITULO']; ?>",
						"dia":"<?php echo date_format(date_create($aula['DIA_ENTREGA']), 'd/m/Y'); ?>",
						"custo":"<?php echo $aula['CUSTO'] ?>" }'
						 data-aula="<?php echo $aula['DIA_ENTREGA']; ?>">
							<h4 class="nome-aula"><?php echo $aula['TITULO']; ?></h4>
							<h5 class="data-aula detalhe-aula"><?php echo date_format(date_create($aula['DIA_ENTREGA']), 'd/m/Y'); ?></h5>
							<h5 class="custo-aula detalhe-aula text-right">R$<?php echo $aula['CUSTO'] ?></h5>
							<div style="clear:both;"></div>
						</a>

						<?php endforeach; ?>
						
					</div>
					<div class="pedido-footer">
					</div>
				</div>
			</div>

					<?php endif; ?>
				<?php endforeach; ?>
			<?php else : ?>

				<h4>Nenhum pedido registrado.</h4>

			<?php endif; ?>
		</div>
	</div>
	
</div>


<!-- Visualizar Pedido -->
<?php include('modalAula.php'); ?>


<script type="text/javascript">
	$(document).ready(function(){

		$(".btn-aula").on('click', function() {

		});

		$("#btn-1").addClass('menu-active');

		$('#filterPedido').on('click', function() {
			var dataInicial = new Date($('#dataInicial').val());
			var dataFinal = new Date($('#dataFinal').val());


			$('.btn-aula').filter(function() {

				var d = new Date($(this).data('aula'));

				if (!((d >= dataInicial) && (d <= dataFinal))) {
					$(this).hide();
				} else {
					$(this).show();
					$(this).closest('.pedido-coluna').show();
				}

				if($(this).closest('.pedido-body').children(':visible').length === 0) {

					$(this).closest('.pedido-coluna').hide();

				}

			});
		});

	});
</script>


<?php 
include(FOOTER_TEMPLATE);
?>