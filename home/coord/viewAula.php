<?php
include("../../login/check.php");
require_once('functions.php');
carregarInsumos(); 
carregarDisciplinas();
carregarProfessores();
carregarDiscProf();
carregarReceitas();
saldoProfessor();
$dados=0;
$dados+=(($_GET['id']));
$receitasContidas=receitasAula($dados);
?>


			<?php foreach($receitasContidas as $rec):
					$insumosReceita=insumosReceita($rec['ID']);
				?>

<div class="card-header">
	<div class="row">
		
		<div class="col-4 pl-0 text-left">
				<h5 class="tituloReceita mb-0"><?php echo $rec['TITULO']?></h5></div>
				<div class="col-3 text-right">
					<h5 class="tituloReceita mb-0">Custo:<span id="custoFT">R$<?php echo $rec['CUSTO']; ?></span></h5>
				</div>
				<div class="col-1 pr-0 text-right">
					<button class="bnt btn-link p-0" data-toggle="collapse" data-target="#col<?php echo $rec['ID'];?>" aria-expanded="false" aria-controls="collapseOne">
						<i class="fas fa-caret-down fa-2x"></i>
					</button></div></div></div>
					<div id="col<?php echo $rec['ID'];?>" class="collapse">
						<div class="card-body p-1">
							<table class="table table-hover table-sm p-0 m-0">
								<thead class="thead-dark">
									<tr class="row text-center">
										<th class="col-1">ID</th>
										<th class="col-3">Insumo</th>
										<th class="col-3">Unidade</th>
										<th class="col-2">Preço Unitário</th>
										<th class="col-2">Qtde</th>
										<th class="col-1">Total</th>
										</tr></thead>
										<tbody id="tblInsumos<?php echo $rec['ID'];?>">
											<?php foreach($insumosReceita as $insR):?>
												<tr class="row text-center">
												<td class="col-1"><?php echo $insR[0]?></td>
												<td class="col-3"><?php echo $insR[1]?></td>
												<td class="col-3"><?php echo $insR[2]?></td>
												<td class="col-2"><?php echo $insR[3]?></td>
												<td class="col-2"><?php echo $insR[4]?></td>
												<td class="col-1"><?php echo $insR[4]*$insR[3]?></td>
												</tr>
												<?php endforeach;?>		
												<thead class="thead-dark">
													<th class="col-12 text-center"> Modo de Preparo</th>

												</thead><tr>
													<td class="col-12"><?php echo $rec['OBSERVACAO'];?></td></tr>
													</tbody>
												</table>
											</div></div>
			<?php endforeach;?>



<?php
/*

function gridAula(){
	
	var insumosRS= $('#r_id').find(":selected").data('srec').insumosRS;
	

insR=[];

	gDiv+='<thead class="thead-dark">';
	gDiv+='<th class="col-12 text-center"> Modo de Preparo</th>';
	gDiv+='</thead><tr>';
	gDiv+='<td class="col-12"><?php echo $rec['OBSERVACAO'];?></td></tr>';
										
	var ajax_receita={receitaNome:$('#r_id').find(":selected").data('srec').nomeReceita,custoTotalR:cTot.toFixed(2),comentReceita:coment, insumos:insR};
	ajax_aula.push(ajax_receita);
	console.log(ajax_aula);
	gDiv+='</tbody></table></div>'
	indR+=1;
	var tit=$('#r_id').find(":selected").data('srec').nomeReceita;
	$(document).find('#corpoModal').html(gDiv);
	console.log($(document).find('.col-3'));
}*/

?>