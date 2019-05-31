<?php
/* Verifica se o usuario ta logado */
include("../../login/check.php");

 /* Carrega as funções do usuario tecnico */
require_once('functions.php');

/* Função que carrega os insumos e armazena na variavel global $insumos (Veio do arquivo da linha anterior) */
carregarInsumos();

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
			<h2>Matriz Anual</h2>

		</div>

		<!-- Coluna pros botões alinhado a direita -->
		<div class="col-sm-6 text-right"> 

			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#novoInsumo"><i class="fa fa-plus"></i> Novo Insumo</button>
			<a class="btn btn-danger" href="index.php"><i class="far fa-arrow-alt-circle-left"></i> Voltar</a>

		</div>
	</div>
</header>
<!-- Se tiver dado algum erro exibe na tela -->
<?php if (!empty($_SESSION['mensagem'])) : ?> 
	<div class="alert alert-<?php echo $_SESSION['tipo']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['mensagem']; ?>
	</div>
<?php endif; ?>

<hr> <!-- Linha horizontal -->

<div id="MatrizAnual">

<!-- Campo para pesquisar insumo (script ta no final do codigo) -->
<div class="input-group mb-3">
	<div class="input-group-prepend">
		<span class="input-group-text"><i class="fa fa-search"></i></span>
	</div>
	<input class="form-control" id="procurar" type="text" placeholder="Pesquisar insumo...">
</div> 


<!-- Cabeçalho da tabela Escuro -->
<table class="table table-hover">
<thead class="thead-dark" id="tabelaHead">

	<tr> <!-- Itens do cabeçalho -->
		<th style="width: 5%;">ID</th>
		<th style="width: 10%;" class="thNome">Nome</th>
		<th style="width: 30%;">Descrição</th>
		<th style="width: 10%;">Unidade</th>
		<th style="width: 5%;">Preço</th>
		<th style="width: 5%;">Saldo</th>
		<th style="width: 10%;">Opções</th>
	</tr>
</thead>
</table>
<!-- Tabela de insumos -->
<div class="table-responsive"> <!-- Tabela responsiva -->

<table class="table table-hover" id="tabela" > <!-- .table do Bootstrap4 .table-hover é pra animação do hover nas linhas da tabela-->

<!-- Corpo da tabela (O Id é usado na filtragem do espaço de busca) -->
<tbody id="tabelaInsumos">
	<!-- Verifica se possui insumos -->
	<?php if ($insumos) : ?>

	<!-- Pra cada $insumo da tabela armazenada na variavel $insumos cria uma nova linha na tabela html-->
	<?php foreach ($insumos as $insumo) : ?> 

		<tr style="text-align: center;"> <!-- Colocando os dados nas respectivas colunas -->
			<td style="width: 5%;"><?php echo $insumo['ID'] ?></td>
			<td style="width: 10%;" class="thNome"><?php echo $insumo['NOME'] ?></td>
			<td style="width: 30%;" class="thDesc"><?php echo $insumo['DESCRICAO'] ?></td>
			<td style="width: 10%;"><?php echo $insumo['UNID_MEDIDA'] ?></td>
			<td style="width: 5%;">R$<?php echo $insumo['PRECO'] ?></td>
			<td style="width: 5%;"><?php echo $insumo['QTDE_DISPONIVEL'] ?></td>

			<!-- Botões da coluna 'Opções' -->
			<td class="actions" style="width: 10%;">
				<a href="#" class="btn brn-sm btn-success" data-toggle="modal" data-target="#editInsumo"
				data-insumo='{"id": "<?php echo $insumo['ID']; ?>",
				"nome":"<?php echo $insumo['NOME']; ?>",
				"desc":"<?php echo $insumo['DESCRICAO']; ?>",
				"unid":"<?php echo $insumo['UNID_MEDIDA']; ?>",
				"preco":"<?php echo $insumo['PRECO']; ?>",
				"qtde":"<?php echo $insumo['QTDE_DISPONIVEL']; ?>"}'>
				<i class="fa fa-edit"></i> Editar</a>
				<a href="#" class="btn brn-sm btn-danger" data-toggle="modal" data-target="#confirmExclusao" data-insumo="<?php echo $insumo['ID']; ?>">
					<i class="fa fa-trash"></i> Excluir
				</a>
			</td>

		</tr>

	<?php endforeach; ?> <!-- Fim da inserção -->

<?php else : ?> <!-- Se não tiver insumos -->
	<tr>
		<td colspan="6">Nenhum insumo encontrado.</td>  <!-- Transforma todas as seis colunas em uma e exibe a mensagem-->
	</tr>
<?php endif; ?> <!-- Fim da verificação -->

</tbody>

</table>
</div>
</div>

<!-- Novo Insumo -->
<?php include('novoInsumo.php'); ?>

<!-- Editar Insumo -->
<?php include('edit.php'); ?>

<!-- Confirmação Exclusão -->
<?php include('confirmExclusao.php'); ?>

<!-- Script que faz a filtragem da tabela -->
<script>
$(document).ready(function(){
  
  $("#procurar").on("keyup", function() { /* Sempre que uma tecla for levantada no campo de pesquisa */
    var value = $(this).val().toLowerCase();
    $('#tabelaInsumos > tr').filter(function() { /* Filtra na tabela com o valor do campo */
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
</script>

<?php include(FOOTER_TEMPLATE); ?>