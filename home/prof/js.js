var tbl = '';
var ajax_data=[]; //array de fazer a receita
var ajax_data_e=[]; //array de fazer a  EDICAO da receita
var ajax_aula=[]; //array de fazer aula
var k=0; // funcao de append APP(v)
var total=0; //funcao GRID e guardar receitas em geral
var indR=0; //funcao GRIDAULA
var total_e=0;
var cTot=0; //funcao GRIDAULA

function mandar(){
	var cT=$("#custoT").val();
	var titulo=$("#tituloRec").val();
	$.ajax({
		url:"mandar.php",
		method:"POST",
		data:{ajax_data:ajax_data,custoT:cT,titulo:titulo},
		dataType:"text",
		success:function(msg){
			console.log(msg);
		window.location.reload();
		}
	});

}
function mandarEdicao(v){
	var cT=$("#custoTR").val();
	console.log(cT);
	var titulo=$("#tituloRecE").val();
	
	console.log(titulo);
	var id=v;

	console.log(id);
	$.ajax({
		url:"mandarEdicaoAula.php",
		method:"POST",
		data:{ajax_data_e:ajax_data_e,custoT:cT,titulo:titulo,id:id},
		dataType:"text",
		success:function(msg){
			console.log(msg);
			window.location.reload();
		}
	});
}

$(document).on('show.bs.modal','#modalAula', function (event) {
	var button = $(event.relatedTarget);
	var id = button.data('aula').id;
	var indA = button.data('aula').ind_Aula;
	$('#of_id').val(id);
	$('#indAula').val(indA);
	
});
$(document).on('show.bs.modal','#modalDiscEdit', function (event) {
	var button = $(event.relatedTarget);

	var dadosS = button.attr('data-disc');
	console.log(dadosS);
	$(document).find("#modalDiscEditCorpo").load('updateDisc.php?id='+dadosS);

});
$(document).on('show.bs.modal','#modalAulaExist', function (event) {
	var button = $(event.relatedTarget);

	var dadosS = button.attr('idAula');
	console.log(dadosS);
	$(document).find("#modalAulaExistCorpo").load('vieWAula.php?id='+dadosS);

});
$(document).on('show.bs.modal','#modalSaldo', function (event) {
	var div = $('#dadoSaldo');
	console.log(div);
	var saldo = div.attr("d");
	console.log(saldo);
	$('#saldoTotal').html('R$ <span id="saldo" >'+splitNumero(saldo)[0]+',</span>'+splitNumero(saldo)[1]+'')
	
	
});

$(document).on('hidden.bs.modal', '#modalReceita', function () {
	$("#custoT").val(0);
	ajax_data=[];
	tbl ='<table class="table table-hover">'
		tbl +='<thead>';
		tbl +='<tr>';
		tbl +='<th>ID</th>';
		tbl +='<th>Insumo</th>';
		tbl +='<th>Unidade de Medida</th>';
		tbl +='<th>Valor Unitário</th>';
		tbl +='<th>Quantidade</th>';
		tbl +='<th>Custo</th>';
		tbl +='<th>Opções</th>';
		tbl +='</tr>';
		tbl +='</thead>';
		tbl +='<tbody>';
	$(document).find('.tbl_user_data').html(tbl);

	});

$(document).on('hidden.bs.modal', '#modalReceitaExist', function () {
deseditavel();
	ajax_data_e=[];
});
$(document).on('show.bs.modal','#modalReceitaExist', function (event) {
	var button = $(event.relatedTarget);
	var titulo = button.data('receita').titulo;
	var insumosR = button.data('receita').insumosR;
	var idR= button.data('receita').idR;
	var vBot='<button type="button" id="botDataEdit" onclick="mandarEdicao('+idR+')" data-dismiss="modal" class="btn btn-primary">Salvar edições</button>';
	$('#botDataEdit').html(vBot);
	var total=parseFloat(0);
	var arrayLength = insumosR.length;
	$('#mD').html('<a onclick="editavel('+idR+')" data-disc='+idR+'><i class="conf fas fa-cog fa-2x"></i></a>');
	console.log($('#mD').html());
	$('#tituloRecE').val(titulo);
	var tb="";
	for(var i=0;i<arrayLength;i++){
		tb+='<tr row_id="'+i+'">';
		tb +='<td ><div class="row" col_name="id">'+ insumosR[i][0]+'</div></td>';
		tb +='<td ><div class="row" col_name="name">'+ insumosR[i][1]+'</div></td>';
		tb +='<td ><div class="row" col_name="unid">'+ insumosR[i][2]+'</div></td>';
		tb +='<td ><div class="row" col_name="precoU">'+ insumosR[i][3]+'</div></td>';
		tb +='<td ><div class="row" col_name="qtde">'+ insumosR[i][4]+'</div></td>';
		tb +='<td ><div class="row" col_name="preco">'+ (insumosR[i][4]*insumosR[i][3]).toFixed(2)+'</div></td>';
		tb+='</tr>';
		var result = {id:insumosR[i][0],nome:insumosR[i][1],unid:insumosR[i][2],precoU:insumosR[i][3],qtde:insumosR[i][4],preco:insumosR[i][4]*insumosR[i][3], row_id:i};
	ajax_data_e.push(result);	
		total+=(insumosR[i][4]*insumosR[i][3]);
		console.log(ajax_data_e);
	}
	$('#custoTR').val(total.toFixed(2));
	$(document).find('.bodyReceita').html(tb);
	
});


function grid() {
	insumo = document.getElementById("e_nome").value;
	qtde = document.getElementById("qtde").value;
	custo = (document.getElementById("custo").value);
	id= document.getElementById("e_id").value;
	unid= document.getElementById("unidMed").value;
	precoU= document.getElementById("precoUnit").value;

	var result = {id:id,nome:insumo,unid:unid,precoU:precoU,qtde:qtde,preco:custo};
	ajax_data.push(result);
	app(result,'.tbl_user_data');

	ajax_data.forEach(function(item, index){
		total+=parseFloat(item[index,'preco']);


	})	;
	$("#custoT").val(total);
	total=0;

}
function grid_e() {
	insumo = document.getElementById("e_nome_e").value;
	qtde = document.getElementById("qtde_e").value;
	custo = (document.getElementById("custo_e").value);
	id= document.getElementById("e_id_e").value;
	unid= document.getElementById("unidMed_e").value;
	precoU= document.getElementById("precoUnit_e").value;
total_e=0;
	var result = {id:id,nome:insumo,unid:unid,precoU:precoU,qtde:qtde,preco:custo};
	ajax_data_e.push(result);
	app(result,'.tbl_receita_data',ajax_data_e.length-1);

	ajax_data_e.forEach(function(item, index){
		total_e+=parseFloat(item[index,'preco']);
		console.log(item[index,'preco']);
		console.log(total_e);

	})	;
	$("#custoTR").val(total_e.toFixed(2));
	total_e=0;

}
$(".formatted-number-input").each(function() {
	var value = $(this).val(); 
	var roundedValue = value.toFixed(2);
	$(this).val(roundedValue);
});

function chng(){
	console.log($('#dataPedidoA').val());
	var cInd=$('#r_id').find(":selected").data('srec').custo;
	console.log(cInd);
	var qtdP=$('#quantRP').val();
	$('#precoRecA').val((cInd*qtdP).toFixed(2));

}
function gridAula(){
	var gDiv=$(document).find('#corpoModal').html();
	var qtRA=$(document).find('#quantRP').val();
	var coment=$('#r_id').find(":selected").data('srec').coment;
	cTot+=$('#r_id').find(":selected").data('srec').custo*qtRA;

	$(document).find('#custoTA').val(cTot.toFixed(2));
	var insumosRS= $('#r_id').find(":selected").data('srec').insumosRS;
	
	gDiv+='<div class="card-header">';
	gDiv+='<div class="row">';
	gDiv+='<div class="col-4 pl-0 text-left">';
	gDiv+='<h5 class="tituloReceita mb-0">'+$('#r_id').find(":selected").data('srec').nomeReceita+'</h5>';
	gDiv+='</div>';
	gDiv+='<div class="col-3 text-right">';
	gDiv+='<h5 class="tituloReceita mb-0">Custo:<span id="custoFT">'+$('#r_id').find(":selected").data('srec').custo*qtRA +'</span>';
	gDiv+='</h5></div>';
	gDiv+='<div class="col-1 pr-0 text-right">';
	gDiv+='<button class="bnt btn-link p-0" data-toggle="collapse" data-target="#col'+indR+'" aria-expanded="false"';
	gDiv+='aria-controls="collapseOne">';
	gDiv+='<i class="fas fa-caret-down fa-2x"></i>';
	gDiv+='</button></div></div></div>';
	gDiv+='<div id="col'+indR+'" class="collapse">';
	gDiv+='<div class="card-body p-1">';
	gDiv+='<table class="table table-hover table-sm p-0 m-0">';
	gDiv+='<thead class="thead-dark">';
	gDiv+='<tr class="row text-center">';
	gDiv+='<th class="col-1">ID</th>';
	gDiv+='<th class="col-3">Insumo</th>';
	gDiv+='<th class="col-3">Unidade</th>';
	gDiv+='<th class="col-2">Preço Unitário</th>';
	gDiv+='<th class="col-2">Qtde</th>';
	gDiv+='<th class="col-1">Total</th>';
	gDiv+='</tr></thead>';
	gDiv+='<tbody id="tblInsumos'+indR+'">';
insR=[];
	insumosRS.forEach(function(item,index){

	
	
	var ajax_insumoR = {id:insumosRS[index][0],qtde:(insumosRS[index][4]*qtRA).toFixed(2)};
	insR.push(ajax_insumoR);
		gDiv+='<tr class="row text-center">';
		gDiv+='<td class="col-1">'+insumosRS[index][0]+'</td>';
		gDiv+='<td class="col-3">'+insumosRS[index][1]+'</td>';
		gDiv+='<td class="col-3">'+insumosRS[index][2]+'</td>';
		gDiv+='<td class="col-2">'+insumosRS[index][3]+'</td>';
		gDiv+='<td class="col-2">'+insumosRS[index][4]*qtRA+'</td>';
		gDiv+='<td class="col-1">'+insumosRS[index][4]*insumosRS[index][3]*qtRA+'</td>';
		gDiv+='</tr>';


	});
	gDiv+='<thead class="thead-dark">';
	gDiv+='<th class="col-12 text-center"> Modo de Preparo</th>';
	gDiv+='</thead><tr>';
	gDiv+='<td class="col-12">'+coment+'</td></tr>';
										
	var ajax_receita={receitaNome:$('#r_id').find(":selected").data('srec').nomeReceita,custoTotalR:cTot.toFixed(2),comentReceita:coment, insumos:insR};
	ajax_aula.push(ajax_receita);
	console.log(ajax_aula);
	gDiv+='</tbody></table></div>'
	indR+=1;
	var tit=$('#r_id').find(":selected").data('srec').nomeReceita;
	$(document).find('#corpoModal').html(gDiv);
	console.log($(document).find('.col-3'));
}
function salvarAula(){
var idOferta=$('#of_id').val();
var indAula=$('#indAula').val();
var tituloAula=$('#tituloAula').val();
var custoAula=$('#custoTA').val();
var dataAula=$('#dataPedidoA').val();
$.ajax({
			url:"salvarAula.php",
			method:"POST",
			data:{ajax_aula:ajax_aula,idOferta:idOferta,indAula:indAula,tituloAula:tituloAula,custoAula:custoAula,dataAula},
			success:function(data){
console.log(data);
			} 
		});
}
function app(v,tClass, row_id=k){
	
	var id=	"create";
	if(tClass==".tbl_receita_data"){
			id="edit";
	}
	tbl=$(document).find(tClass).html();
	tbl=tbl.substr(0,tbl.length-16);
	tbl +='<tr row_id="'+row_id+'">';
	tbl +='<td ><div class="row" col_name="id">'+v['id']+'</div></td>';
	tbl +='<td ><div class="row" col_name="name">'+v['nome']+'</div></td>';
	tbl +='<td ><div class="row" col_name="unid">'+v['unid']+'</div></td>';
	tbl +='<td ><div class="row" col_name="precoU">'+v['precoU']+'</div></td>';
	tbl +='<td ><div class="row" id="row_edit" edit_type="click" col_name="qtde">'+v['qtde']+'</div></td>';
	tbl +='<td ><div class="row" col_name="preco">'+v['preco']+'</div></td>';

					//--->edit options > start
					tbl +='<td>';

					tbl +='<span class="btn_edit '+id+'" > <a href="#" class="btn btn-success " row_id="'+row_id+'" > Edit</a> </span>';

						//only show this button if edit button is clicked
						tbl +='<span class="btn_save btn_save'+id+' "> <a href="#" class="btn btn-link '+id+'"  row_id="'+row_id+'"> Save</a> | </span>';
						tbl +='<span class="btn_delete btn_delete'+id+' "> <a href="#" class="btn btn-link '+id+'"  row_id="'+row_id+'"> Delete</a> | </span>';
						tbl +='<span class="btn_cancel btn_cancel'+id+' "> <a href="#" class="btn btn-link '+id+'" row_id="'+row_id+'"> Cancel</a> | </span>';

						tbl +='</td>';
					//--->edit options > end
					
					tbl +='</tr>';

					tbl +='</tbody>';
		//--->create table body > end

		tbl +='</table>'
		k+=1;
		$(document).find(tClass).html(tbl);

		$(document).find('.btn_cancel').hide(); 
		$(document).find('.btn_delete').hide(); 
		$(document).find('.btn_save').hide();
	}
	function mudar(){

		document.getElementById('custo').innerHTML= (document.getElementById('e_id')['PRECO'])*(document.getElementById('qtde').value);

	}
function editavel(idReceita){
$(document).find("#formEditRec").load('loadForm.php?id='+idReceita);
	var tblEdi='';
	tblEdi +='<table class="table table-hover">'

		//--->create table header > start
		tblEdi +='<thead>';
		tblEdi +='<tr>';
		tblEdi +='<th>ID</th>';
		tblEdi +='<th>Insumo</th>';
		tblEdi +='<th>Unidade de Medida</th>';
		tblEdi +='<th>Valor Unitário</th>';
		tblEdi +='<th>Quantidade</th>';
		tblEdi +='<th>Custo</th>';
		tblEdi +='<th>Opções</th>';
		tblEdi +='</tr>';
		tblEdi +='</thead>';
		//--->create table header > end
		//--->create table body > start
		tblEdi +='<tbody>';


			tblEdi +='</tbody>';
		//--->create table body > end

		tblEdi +='</table>'
		$('.tbl_receita_data').html(tblEdi);
ajax_data_e.forEach(function(item, index){
		total_e+=parseFloat(item[index,'preco']);
		console.log(total_e);
		var v= ajax_data_e[index];
		console.log(v);
app(v,'.tbl_receita_data');


	})	;

}
function deseditavel(){
	var tbll='';
	
tbll+='<table class="table table-hover">';
 tbll+='       <thead>';
  tbll+='      <tr> ';
    tbll+='           <th>ID</th>';
    tbll+=' <th>Insumo</th>';
    tbll+=' <th>Unidade de Medida</th>'; 
    tbll+='    <th>Valor Unitário</th> ';
    tbll+='       <th>Quantidade</th>';
    tbll+='          <th>Custo</th>  ';
  tbll+='           </tr>';
tbll+='            </thead>';
tbll+='      <tbody class="bodyReceita">';
tbll+='         </tbody>';
tbll+='          </table>';
	$('.tbl_receita_data').html(tbll);
	$('#formEditRec').html('');


}

function splitNumero(num){
	var num=num;

	var str=num.toString();
	var numarray=str.split('.');
	var a=new Array();
	a=numarray;
	return a;
}
	function och(v=$('#e_id')){
		var id=$(v).val();
		
		$.ajax({
			url:"fetch_state.php",
			method:"POST",
			data:{ID:id},
			dataType:"text",
			success:function(data){
				$('#precoUnit').val(data);
				$('#custo').val((document.getElementById("precoUnit").value)*(document.getElementById("qtde").value));
				var k=$("#custo").val();
				$("#custo").val(parseFloat(k).toFixed(2));

			} 
		});
		$.ajax({
			url:"fetch_state_2.php",
			method:"POST",
			data:{ID:id},
			dataType:"text",
			success:function(dat){
				$('#unidMed').val(dat);
			} 
		});

		var my_value=$(v).selectedIndex;
		var indx =-1;
		$('#e_nome option').each(function(){
    	var $this = $(this); // cache this jQuery object to avoid overhead
    	indx+=1;
    	var selectElement = document.getElementById('e_id');
    	if (indx == selectElement.selectedIndex) { // if this option's value is equal to our value
        	$this.prop('selected', true); // select this option
     		// select this option
        	return false; // break the loop, no need to look further
        }
    });
	}

	function och_e(v=$('#e_id_e')){
		var id=$(v).val();
		
		$.ajax({
			url:"fetch_state.php",
			method:"POST",
			data:{ID:id},
			dataType:"text",
			success:function(data){
				$('#precoUnit_e').val(data);
				$('#custo_e').val((document.getElementById("precoUnit_e").value)*(document.getElementById("qtde_e").value));
				var k=$("#custo_e").val();
				$("#custo_e").val(parseFloat(k).toFixed(2));

			} 
		});
		$.ajax({
			url:"fetch_state_2.php",
			method:"POST",
			data:{ID:id},
			dataType:"text",
			success:function(dat){
				$('#unidMed_e').val(dat);
			} 
		});

		var my_value=$(v).selectedIndex;
		var indx =-1;
		$('#e_nome_e option').each(function(){
    	var $this = $(this); // cache this jQuery object to avoid overhead
    	indx+=1;
    	var selectElement = document.getElementById('e_id_e');
    	if (indx == selectElement.selectedIndex) { // if this option's value is equal to our value
        	$this.prop('selected', true); // select this option
     		// select this option
        	return false; // break the loop, no need to look further
        }
    });
	}
	function ochNome(v){
		var my_value=$(v).selectedIndex;
		var indx =-1;
		$('#e_id option').each(function(){
    	var $this = $(this); // cache this jQuery object to avoid overhead
    	indx+=1;
    	var selectElement = document.getElementById('e_nome');
    	if (indx == selectElement.selectedIndex) { // if this option's value is equal to our value
        	$this.prop('selected', true); // select this option
     		// select this option
        	return false; // break the loop, no need to look further
        }
    });
		och();
	}
	function ochNome_e(v){
		var my_value=$(v).selectedIndex;
		var indx =-1;
		$('#e_id_e option').each(function(){
    	var $this = $(this); // cache this jQuery object to avoid overhead
    	indx+=1;
    	var selectElement = document.getElementById('e_nome_e');
    	if (indx == selectElement.selectedIndex) { // if this option's value is equal to our value
        	$this.prop('selected', true); // select this option
     		// select this option
        	return false; // break the loop, no need to look further
        }
    });
		och_e();
	}




	var random_id = function  () 
	{
		var id_num = Math.random().toString(9).substr(2,3);
		var id_str = Math.random().toString(36).substr(2);
		
		return id_num + id_str;
	}


//////////////code with mark
$(document).ready(function($)
{

	//--->preencher o corpo com disciplinas > start

	//--->create data table > start

	tbl +='<table class="table table-hover">'

		//--->create table header > start
		tbl +='<thead>';
		tbl +='<tr>';
		tbl +='<th>ID</th>';
		tbl +='<th>Insumo</th>';
		tbl +='<th>Unidade de Medida</th>';
		tbl +='<th>Valor Unitário</th>';
		tbl +='<th>Quantidade</th>';
		tbl +='<th>Custo</th>';
		tbl +='<th>Opções</th>';
		tbl +='</tr>';
		tbl +='</thead>';
		//--->create table header > end
		//--->create table body > start
		tbl +='<tbody>';
		/* O CORPO DA TABELA (que nao existe quando é iniciado pois n tem nenhum insumo ainda)
 			//--->create table body rows > start
			$.each(ajax_data, function(index, val) 
			{
				//you can replace with your database row id
				var row_id = random_id();

				//loop through ajax row data
				tbl +='<tr row_id="'+row_id+'">';
					tbl +='<td ><div col_name="id">'+val['id']+'</div></td>';
					tbl +='<td ><div col_name="name">'+val['nome']+'</div></td>';
					tbl +='<td ><div col_name="unid">'+val['unid']+'</div></td>';
					tbl +='<td ><div col_name="precoU">'+val['precoU']+'</div></td>';
					tbl +='<td ><div class="row_edit" edit_type="click" col_name="qtde">'+val['qtd']+'</div></td>';
					tbl +='<td ><div  col_name="preco">'+val['preco']+'</div></td>';

					//--->edit options > start
					tbl +='<td>';
					 
						tbl +='<span class="btn_edit" > <a href="#" class="btn btn-link " row_id="'+row_id+'" > Edit</a> </span>';

						//only show this button if edit button is clicked
						tbl +='<span class="btn_save"> <a href="#" class="btn btn-link"  row_id="'+row_id+'"> Save</a> | </span>';
						tbl +='<span class="btn_cancel"> <a href="#" class="btn btn-link" row_id="'+row_id+'"> Cancel</a> | </span>';

					tbl +='</td>';
					//--->edit options > end
					
				tbl +='</tr>';
			});

			//--->create table body rows > end
			*/
			tbl +='</tbody>';
		//--->create table body > end

		tbl +='</table>'
	//--->create data table > end

	//out put table data
	$(document).find('.tbl_user_data').html(tbl);
	$(document).find('.btn_cancel').hide(); 
	$(document).find('.btn_save').hide(); 
	$(document).find('.btn_delete').hide(); 

	$("#row_edit").keypress(function(event) {
		if (isNaN(String.fromCharCode(event.which))){ event.preventDefault();
		}
	});
	//--->button > edit > start	
	$(document).on('click', '.btn_edit', function(event) 
	{
		event.preventDefault();
		var tbl_row = $(this).closest('tr');

		var row_id = tbl_row.attr('row_id');

		tbl_row.find('.btn_save').show();
		tbl_row.find('.btn_delete').show();
		tbl_row.find('.btn_cancel').show();

		//hide edit button
		tbl_row.find('.btn_edit').hide(); 

		//make the whole row editable
		tbl_row.find('#row_edit')
		.attr('contenteditable', 'true')
		.attr('edit_type', 'button')
		.addClass('bg-warning')
		.css('padding','3px')

		//--->add the original entry > start
		tbl_row.find('#row_edit').each(function(index, val) 
		{  
			//this will help in case user decided to click on cancel button
			$(this).attr('original_entry', $(this).html());
		}); 		
		//--->add the original entry > end

	});
	//--->button > edit > end


	//--->button > cancel > start	
	$(document).on('click', '.btn_cancel', function(event) 
	{
		event.preventDefault();

		var tbl_row = $(this).closest('tr');

		var row_id = tbl_row.attr('row_id');

		//hide save and cacel buttons
		tbl_row.find('.btn_save').hide();
		tbl_row.find('.btn_delete').hide();
		tbl_row.find('.btn_cancel').hide();

		//show edit button
		tbl_row.find('.btn_edit').show();

		//make the whole row editable
		tbl_row.find('#row_edit')
		.attr('contenteditable','false')
		.removeClass('bg-warning')
		.css('padding','') 

		tbl_row.find('#row_edit').each(function(index, val) 
		{   
			$(this).html( $(this).attr('original_entry') ); 
		});  
	});
	//--->button > cancel > end



	
	$(document).on('click', '.btn_deletecreate', function(event) 
	{

		var tbl_row = $(this).closest('tr');

		var row_id = tbl_row.attr('row_id');
		var ndx = $(this).parent().index() + 1;

    // Find all TD elements with the same index
    tbl_row.remove();
    var arr = {}; 
    ajax_data.splice(row_id,1);
		//--->get row data > end

//////////////erro do

		//use the "arr"	object for your ajax call
		$.extend(arr, {row_id:row_id});
		ajax_data.forEach(function(item, index){
			total+=parseFloat(item[index,'preco']);


		})	;
		$("#custoT").val(total);
		total=0;
		//out put to show
		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>')

		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(ajax_data, null, 2) +'</pre>')


		tbl_row.find('.btn_savecreate').hide();
		tbl_row.find('.btn_cancelcreate').hide();

		//show edit button
		tbl_row.find('.btn_edit').show();


	});
	
	//--->save whole row entery > start	
	$(document).on('click', '.btn_savecreate', function(event) 
	{
		event.preventDefault();
		var tbl_row = $(this).closest('tr');

		var row_id = tbl_row.attr('row_id');

		
		//hide save and cacel buttons
		tbl_row.find('.btn_savecreate').hide();
		tbl_row.find('.btn_deletecreate').hide();
		tbl_row.find('.btn_cancelcreate').hide();

		//show edit button
		tbl_row.find('.btn_edit').show();


		//make the whole row editable
		tbl_row.find('#row_edit')
		.attr('edit_type', 'click')
		.attr('contenteditable','false')
		.removeClass('bg-warning')
		.css('padding','') 

		//--->get row data > start
		var arr = {}; 

		tbl_row.find('.row').each(function(index, val) 
		{   
			var col_name = $(this).attr('col_name');
			
			var col_val  =  $(this).html();
			
			if(col_name=='preco'){
				col_val=arr['qtde']*arr['precoU'];
				arr[col_name]=col_val;

				ajax_data[row_id]=arr;
				$(this).html(arr[col_name]);
			}else{
				arr[col_name] = col_val;}

			});
		//--->get row data > end

//////////////erro do

		//use the "arr"	object for your ajax call
		$.extend(arr, {row_id:row_id});
		ajax_data.forEach(function(item, index){
			total+=parseFloat(item[index,'preco']);


		})	;
		$("#custoT").val(total);
		total=0;
		//out put to show
		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>')

		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(ajax_data, null, 2) +'</pre>')


	});
	//--->save whole row entery > end


//PARTE DUPLICADA	//////   /////  parte duplicada pro ajax_data_e
	$(document).on('click', '.btn_deleteedit', function(event) 
	{

		var tbl_row = $(this).closest('tr');
total_e=0;
		var row_id = tbl_row.attr('row_id');
		var ndx = $(this).parent().index() + 1;

    // Find all TD elements with the same index
    tbl_row.remove();
    var arr = {}; 
    ajax_data_e.splice(row_id,1);
		//--->get row data > end

//////////////erro do

		//use the "arr"	object for your ajax call
		$.extend(arr, {row_id:row_id});
		ajax_data_e.forEach(function(item, index){
			total_e+=parseFloat(item[index,'preco']);
console.log(total_e);

		})	;
		ajax_data_e.forEach(function(item,index){
				item['row_id']=index;
		});
		$('#custoTR').val(total_e.toFixed(2));
		total_e=0;
		//out put to show
		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>')

		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(ajax_data_e, null, 2) +'</pre>')


		tbl_row.find('.btn_saveedit').hide();
		tbl_row.find('.btn_canceledit').hide();
		tbl_row.find('.btn_deleteedit').hide();

		//show edit button
		tbl_row.find('.btn_edit edit').show();


	});
	
	//--->save whole row entery > start	
	$(document).on('click', '.btn_saveedit', function(event) 
	{
		event.preventDefault();
		var tbl_row = $(this).closest('tr');

		var row_id = tbl_row.attr('row_id');

		
		//hide save and cacel buttons
		tbl_row.find('.btn_saveedit').hide();
		tbl_row.find('.btn_canceledit').hide();
		tbl_row.find('.btn_deleteedit').hide();

		//show edit button
		tbl_row.find('.btn_edit').show();


		//make the whole row editable
		tbl_row.find('#row_edit')
		.attr('edit_type', 'click')
		.attr('contenteditable','false')
		.removeClass('bg-warning')
		.css('padding','') 

		//--->get row data > start
		var arr = {}; 

		tbl_row.find('.row').each(function(index, val) 
		{   
			var col_name = $(this).attr('col_name');
			
			var col_val  =  $(this).html();
			
			if(col_name=='preco'){
				col_val=(arr['qtde']*arr['precoU']).toFixed(2);
				arr[col_name]=col_val;

				ajax_data_e[row_id]=arr;
				$(this).html(arr[col_name]);
			}else{
				arr[col_name] = col_val;}

			});
		//--->get row data > end

//////////////erro do

		//use the "arr"	object for your ajax call
		$.extend(arr, {row_id:row_id});
		ajax_data_e.forEach(function(item, index){
			total_e+=parseFloat(item[index,'preco']);
console.log(total_e);

		})	;
		$("#custoTR").val(total_e);
		total_e=0;
		//out put to show
		$('.post_msg').html( '<p>ajax_data_e</p><pre class="bg-success">'+JSON.stringify(arr, null, 2) +'</pre>')

		$('.post_msg').html( '<pre class="bg-success">'+JSON.stringify(ajax_data_e, null, 2) +'</pre>')


	});
	//--->save whole row entery > end


});

