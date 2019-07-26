<?php
require_once ('../../js/dompdf/autoload.inc.php');
require_once('functions.php');

if (isset($_GET['id'])) {
	$listaID = $_GET['id'];

} else {
	die("ERRO: ID não definido.");
}
?>

<?php ob_start();?>

<?php

$insumos = buscarListaInsumos($_GET['id']);
$lista = pesquisar('lista', $listaID);
$custoTotal = null;

?>

<?php foreach ($insumos as $ins) {
		$insumo = pesquisar('insumo', $ins['insumo_ID']);
		$custoTotal +=  $insumo['PRECO']*$ins['QUANTIDADE'];
}?>
<div style="text-align: center;">
	<img src="../../img/cellierLogo.png">
</div>
<h3 style="text-align: center;"><br /><br /><strong>Lista de Pedido de Insumos</strong><br /><br /></h3>

<p><strong>Período:</strong> <?php echo $lista['TITULO'];?><br /><strong>Custo Total: </strong>R$ <?php echo $custoTotal; ?><br /><br /><p>

<table border="2" style="width: 100vw; border-collapse: collapse;" class="table table-hover p-0 m-0">

	<thead>
		<tr style="background-color: #216B82; color: white;">
			<th style="text-align: center;">ID</th>
			<th style="text-align: center;">Insumo</th>
			<th style="text-align: center;">Unidade</th>
			<th style="text-align: center;">Preço</th>
			<th style="text-align: center;">Qtd</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($insumos as $ins) : ?>
			<?php $insumo = pesquisar('insumo', $ins['insumo_ID']); ?>
			<tr>
				<td style="text-align: center;"><?php echo $insumo['ID']; ?></td>
				<td><?php echo $insumo['NOME']; ?></td>
				<td><?php echo $insumo['UNID_MEDIDA']; ?></td>
				<td>R$ <?php echo $insumo['PRECO']*$ins['QUANTIDADE']; ?></td>
				<td style="text-align: center;"><?php echo $ins['QUANTIDADE']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<p style="text-align: center;"><br /><br /><span style="color: #999999;"><em>Lista gerada por Cellier&copy;</em></span></p>

<?php
$html = ob_get_clean();


use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('my.pdf',array('Attachment'=>0));


?>