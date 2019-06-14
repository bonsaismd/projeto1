
/* Excluir Insumo */
$('#confirmExclusao').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var id = button.data('insumo');

	var modal = $(this);
	modal.find('.modal-title').text('Excluir Insumo #' + id);
	modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

/* Editar Insumo */

$('#editInsumo').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var id = button.data('insumo').id;
	var nome = button.data('insumo').nome;
	var desc = button.data('insumo').desc;
	var unid = button.data('insumo').unid;
	var preco = button.data('insumo').preco;
	var qtde = button.data('insumo').qtde;

	var modal = $(this);
	modal.find('.modal-title').text('Editando Insumo #' + id);
	modal.find('.insumo-ID').val(id);
	modal.find('.insumo-NOME').val(nome);
	modal.find(".insumo-DESCRICAO").val(desc);
	modal.find(".insumo-UNID_MEDIDA").val(unid);
	modal.find(".insumo-PRECO").val(preco);
	modal.find(".insumo-SALDO").val(qtde);
	modal.find("#btn-delete").data('insumo', id);

	document.getElementById('formEditInsumo').action = 'editAPI.php?id='+id;
})



/* Visualizar Pedido */
$('#verPedido').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var id = button.data('disciplina').id;
	var data = button.data('disciplina').dataShow;
	var oferta = button.data('disciplina').oferta;
	var titulo = button.data('disciplina').titulo;
	var obs = button.data('disciplina').obs;
	var custo = button.data('disciplina').custo;
	var prof = button.data('disciplina').prof;
	var discip = button.data('disciplina').discip;	


	var modal = $(this);
	modal.find('.modal-title').text('Pedido #'+id+' | '+titulo);
	modal.find('#labelAula').text(titulo);
	modal.find('#labelProfessor').text(prof);
	modal.find('#labelDisciplina').text(discip);
	modal.find('#labelDataAula').text(data);
	modal.find('#labelCustoTotal').text(custo);
	modal.find('#labelObserv').text(obs);

	$.ajax({
		type: "POST",
		url: "gerarIns.php",
		data: {
			idPedido: id
		},
		dataType: "json",
		success: function(data){

			if (data.insumo.length > 0) {
				var updateTabela;

				for (var i = 0; i < data.insumo.length; i++) {
				

				updateTabela += '<tr style="text-align: center;">';
				updateTabela += '<td style="width: 5%;">'+data.insumo[i].insumo_ID+'</td>';
				updateTabela += '<td style="width: 10%;" class="thNome">'+data.insumoInfo[i].NOME+'</td>';
				updateTabela += '<td style="width: 10%;">'+data.insumoInfo[i].UNID_MEDIDA+'</td>';
				updateTabela += '<td style="width: 5%;">R$'+data.insumoInfo[i].PRECO+'</td>';
				updateTabela += '<td style="width: 5%;">'+data.insumo[i].QUANTIDADE+'</td>';
				updateTabela += '<td style="width: 5%;">R$'+data.insumo[i].QUANTIDADE*data.insumoInfo[i].PRECO+'</td>';
				updateTabela += '</tr>';

				}
			
			} else {
				var updateTabela = '<tr style="text-align: center;">';
				updateTabela += '<td colspan="6">Nenhum insumo encontrado.</td>';
				updateTabela += '</tr>';
			}

			$(document).find('#tabelaInsumosPedido').html(updateTabela);
        }
	});

})


$('.btn-aula').on('click', function(){

	var button = $(this);
	var id = button.data('id');
	console.log(id);
})





/* PDF */
function createPDF() {
    $('#renderPDF').createPdf({
        'fileName' : 'Pedido-'+ $('#verPedido').find('#labelAula').text()
    });
}

(function($){
    $.fn.createPdf = function(parametros) {
        
        var config = {              
            'fileName':'html-to-pdf'
        };
        
        if (parametros){
            $.extend(config, parametros);
        }                            

        var quotes = document.getElementById($(this).attr('id'));

        html2canvas(quotes, {
            onrendered: function(canvas) {
                var pdf = new jsPDF('p', 'pt', 'letter');

                for (var i = 0; i <= quotes.clientHeight/980; i++) {
                    var srcImg  = canvas;
                    var sX      = 0;
                    var sY      = 980*i;
                    var sWidth  = 900;
                    var sHeight = 980;
                    var dX      = 0;
                    var dY      = 0;
                    var dWidth  = 900;
                    var dHeight = 980;

                    window.onePageCanvas = document.createElement("canvas");
                    onePageCanvas.setAttribute('width', 900);
                    onePageCanvas.setAttribute('height', 980);
                    var ctx = onePageCanvas.getContext('2d');
                    ctx.drawImage(srcImg,sX,sY,sWidth,sHeight,dX,dY,dWidth,dHeight);

                    var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                    var width         = onePageCanvas.width;
                    var height        = onePageCanvas.clientHeight;

                    if (i > 0) {
                        pdf.addPage(612, 791);
                    }

                    pdf.setPage(i+1);
                    pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width*.7), (height*.7));
                }

                pdf.save(config.fileName);
            }
        });
    };
})(jQuery);