<?php
/* Verifica se o usuario ta logado */
include("../../login/check.php");

/* Carrega as funções do usuario tecnico */
require_once('functions.php');

/* Função que carrega os insumos e armazena na variavel global $insumos (Veio do arquivo da linha anterior) */
carregarPedidos();

/* Armazena o Id e o Nome do usuario logado */ 
$id_usuario = $_SESSION['inputID']; 
$nome_usuario = $_SESSION['nome'];

include(HEADER_TEMPLATE);
?>

<!-- Cabeçalho -->
<header>

	<!-- Cria uma linha -->
	<div class="row"> 

		<!-- Coluna pro titulo -->
		<div class="col-sm-6">

			<!-- Titulo da página -->
			<h2>Lista de Pedidos</h2>

		</div>

		<!-- Coluna pros botões alinhado a direita -->
		<div class="col-sm-6 text-right"> 

			<a class="btn btn-warning" href="pedidos.php"><i class="fa fa-redo"></i> Atualizar</a>
			<a class="btn btn-danger" href="index.php"><i class="far fa-arrow-alt-circle-left"></i> Voltar</a>

		</div>
	</div>
</header>

<!-- Se tiver dado algum erro exibe na tela -->
<?php if (!empty($_SESSION['mensagem'])) :?> 
	<div class="alert alert-<?php echo $_SESSION['tipo']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['mensagem']; ?>
	</div>
<?php endif; ?>

<hr> <!-- Linha horizontal -->



<!-- PESQUISAR POR PERIODO -->
<form style="width: 40vw;">
	<div class="formTitle">
		<h5>Filtrar pedidos por período:</h5>
	</div>
	<div class="input-group mb-3">
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


<!-- LISTAGEM DE PEDIDOS -->
<div class="board" style="margin-top: 5%;">
	<div class="board-title">
		<h5>Todos os pedidos:</h5>
	</div>
	<div class="board-content">
		<div class="d-flex flex-wrap p-3 border text-center text-white" id="boardPedidos">

			<?php if ($pedidos) : ?>

				<?php foreach ($pedidos as $pedido) : ?> 

					<a class="btn btn-primary p-3 m-2 border text-center" data-toggle="modal" data-target="#verPedido"

					data-disciplina='{
					"id":"<?php echo $pedido['ID']; ?>",
					"titulo":"<?php echo $pedido['TITULO']; ?>",
					"data":"<?php echo date_format(date_create($pedido['DIA_ENTREGA']), 'Y-m-d'); ?>",
					"oferta":"<?php echo $pedido['oferta_ID']; ?>",
					"obs":"<?php echo $pedido['OBSERVACAO']; ?>",
					"custo":"<?php echo $pedido['CUSTO']; ?>"
					}'>
					
						<div class="row d-flex align-items-center">
							<div class="col text-center">
								<i class="fas fa-utensils fa-5x"></i>
							</div>
							<div class="col text-center">
								<p><strong><?php echo $pedido['TITULO'] ?></strong></p>
								<p><?php $disciplina = pesquisarDisciplina($pedido['oferta_ID']); ;echo $disciplina['NOME']; ?></p>
								<p><?php echo date_format(date_create($pedido['DIA_ENTREGA']), 'd/m/Y') ?></p>
							</div>
						</div>
					</a>

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

<?php include(FOOTER_TEMPLATE); ?>