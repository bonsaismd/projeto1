var tbl = '';
var ajax_data=[];
var dsc='';

function mandar(){
	console.log(ajax_data);
	console.log('oi');
	var cT=$("#custoT").val();
	var titulo=$("#tituloRec").val();
	console.log(titulo);
$.ajax({
				url:"mandar.php",
				method:"POST",
				data:{ajax_data:ajax_data,custoT:cT,titulo:titulo},
				dataType:"text",
				success:function(msg){
					console.log(msg);
				}
		});

}

$(document).on('show.bs.modal','#modalAula', function (event) {
    	var button = $(event.relatedTarget);
console.log(button);
	var id = button.data('aula').id;
	var indA = button.data('aula').ind_Aula;
$('#of_id').val(id);
$('#indAula').val(indA);
console.log(id);
console.log(indA);
});

$(document).on('show.bs.modal','#modalReceitaExist', function (event) {
var button = $(event.relatedTarget);
var titulo = button.data('receita').titulo;
var insumosR = button.data('receita').insumosR;
var idR= button.data('receita').idR;
console.log(typeof idR);
console.log(insumosR);
var total=0;
var arrayLength = insumosR.length;
$('#tituloRecE').val(titulo);
var tb="";
for(var i=0;i<arrayLength;i++){
	tb+='<tr row_id="'+i+'">';
tb +='<td ><div class="row" col_name="id">'+ insumosR[i][0]+'</div></td>';
	tb +='<td ><div class="row" col_name="name">'+ insumosR[i][1]+'</div></td>';
	tb +='<td ><div class="row" col_name="unid">'+ insumosR[i][2]+'</div></td>';
	tb +='<td ><div class="row" col_name="precoU">'+ insumosR[i][3]+'</div></td>';
	tb +='<td ><div class="row" col_name="qtde">'+ insumosR[i][4]+'</div></td>';
	tb +='<td ><div class="row" col_name="preco">'+ insumosR[i][4]*insumosR[i][3]+'</div></td>';
tb+='</tr>';
total+=insumosR[i][4]*insumosR[i][3];
}
$('#custoTR').val(total);
$(document).find('.bodyReceita').html(tb);
console.log(titulo);
});


var total=0;
function grid() {
insumo = document.getElementById("e_nome").value;
qtde = document.getElementById("qtde").value;
custo = (document.getElementById("custo").value);
id= document.getElementById("e_id").value;
unid= document.getElementById("unidMed").value;
precoU= document.getElementById("precoUnit").value;

var result = {id:id,nome:insumo,unid:unid,precoU:precoU,qtde:qtde,preco:custo};
ajax_data.push(result);
app(result);

			ajax_data.forEach(function(item, index){
				total+=parseFloat(item[index,'preco']);

				
			})	;
			$("#custoT").val(total);
		total=0;

}
$(".formatted-number-input").each(function() {
   var value = $(this).val(); 
   var roundedValue = value.toFixed(2);
   $(this).val(roundedValue);
});
var k=0;
function app(v){
	var row_id = k;
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
					 
						tbl +='<span class="btn_edit" > <a href="#" class="btn btn-success " row_id="'+row_id+'" > Edit</a> </span>';

						//only show this button if edit button is clicked
						tbl +='<span class="btn_save"> <a href="#" class="btn btn-link"  row_id="'+row_id+'"> Save</a> | </span>';
						tbl +='<span class="btn_cancel"> <a href="#" class="btn btn-link" row_id="'+row_id+'"> Cancel</a> | </span>';

					tbl +='</td>';
					//--->edit options > end
					
				tbl +='</tr>';

		tbl +='</tbody>';
		//--->create table body > end

	tbl +='</table>'
k+=1;
$(document).find('.tbl_user_data').html(tbl);

	$(document).find('.btn_cancel').hide(); 
	$(document).find('.btn_save').hide();
}
function mudar(){
	
document.getElementById('custo').innerHTML= (document.getElementById('e_id')['PRECO'])*(document.getElementById('qtde').value);

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

	
	//--->save whole row entery > start	
	$(document).on('click', '.btn_save', function(event) 
	{
		event.preventDefault();
		var tbl_row = $(this).closest('tr');

		var row_id = tbl_row.attr('row_id');

		
		//hide save and cacel buttons
		tbl_row.find('.btn_save').hide();
		tbl_row.find('.btn_cancel').hide();

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


});

