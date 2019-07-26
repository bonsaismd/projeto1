
/* Excluir Insumo */
$('#confirmExclusao').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var id = button.data('insumo');

	var modal = $(this);
	modal.find('.modal-title').text('Excluir Insumo #' + id);
	modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

/* Excluir Lista */
$('#excluirLista').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('lista');

    var modal = $(this);
    modal.find('#confirm').attr('href', 'deleteLista.php?id=' + id);
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



/* Visualizar Aula */
$('#modalAulaT').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var id = button.data('info').id;	
	var disciplina = button.data('info').disciplina;	
	var professor = button.data('info').professor;	
	var aula = button.data('info').aula;	
	var dia = button.data('info').dia;	
	var custo = button.data('info').custo;	


	var modal = $(this);
	modal.find('#aulaDisciplina').text(disciplina);
	modal.find('#aulaProfessor').text(professor);
	modal.find('#aulaTitulo').text(aula);
	modal.find('#aulaData').text(dia);
	modal.find('#aulaCustoTotal').text("R$ "+custo.replace(".", ","));

	$.ajaxSetup ({
        cache: false
    });

	modal.find('#aulaFichas').load('updateModal.php?id='+id);
	
});


/* Visualizar Lista Segmentada */
$('.btn-ls').on('click', function () {

    var button = $(this);
    var id = button.data('lista');

    $(document).find('.board').load('updateLS.php?id='+id);
    
});


/* Visualizar Lista Unificada */
$('#listaUnificada').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('lista');

    var modal = $(this);

    $.ajaxSetup ({
        cache: false
    });

    modal.load('updateLU.php?id='+id);
    
});

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