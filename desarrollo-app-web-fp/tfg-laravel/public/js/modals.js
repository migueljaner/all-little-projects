$(document).ready(function () {
    /*Ajustes de efecto para los "th" con botones de borrado o edición*/
    $('#myTable thead th').each(function() {
        if($(this).is(':empty')){
            $(this).removeClass('sorting');
            $(this).css({"border": "0","outline": "none", "background": "inherit","cursor": "context-menu", "display": "none"});
            $(this).click(function(){
                $(this).removeClass('sorting_asc');
                $(this).removeClass('sorting_desc');
            });
        }
    });
    /*Borrar celdas cuando estas no contengan los botones de editar y/o borrar*/
    $('#myTable tbody td').each(function() {
        if($(this).is(':empty')){
            $(this).css("display", "none");
        }
    });
    /*Activar input clicando en su contenedor "tr"*/
    $('#addTable tr').click(function(){
        $('#addTable tr').each(function(){
            $(this).find('input').removeClass('active');
        });
        $(this).find('input').focus();
        $(this).find('input').addClass('active');
    });
    /*Recorrer formulario pulsando enter*/
    $('#addTable tr').keypress(function(e) {
        if (e.which == 13) {
            var currentInput = $(this).find('input');
            var nextInput = $(this).next('tr').find('input');
            if(currentInput.is(':focus')) {
                $('#addTable tr').each(function(){
                    $(this).find('input').removeClass('active');
                });
                nextInput.focus();
                nextInput.addClass('active');
            }
        }
    });
    /*Hover para el botón de basura de reciclaje*/
    $('.top_page a').mouseenter(function(){
        $(this).siblings('div').css("box-shadow", "7px 6px 6px 1px rgba(0,0,0,0.2)");
    }).mouseleave(function(){
        $(this).siblings('div').css("box-shadow", "none");
    });
});
function toggleModal(modalID, dataModal = {}){
    if($('#' + modalID).hasClass('show')){
        $('#' + modalID).modal({
            blurring : true,
            inverted : true,
            closable : false,
            selector : {
                close : '.buttonClose',
            },
            onApprove : function(){
                if(dataModal.approve && dataModal.approve.constructor == Function){
                    return dataModal.approve(dataModal.parameters);
                }
            },
            onDeny: function(){
                if(dataModal.deny && dataModal.deny.constructor == Function){
                    return dataModal.deny(dataModal.parameters);
                }
            }
        }).modal('hide');
    }else{
        $('#' + modalID).modal({
        blurring : true,
        inverted : true,
        closable : false,
        selector : {
            close : '.buttonClose',
        },
        onApprove : function(){
            if(dataModal.approve && dataModal.approve.constructor == Function){
                return dataModal.approve(dataModal.parameters);
            }
        },
        onDeny: function(){
            if(dataModal.deny && dataModal.deny.constructor == Function){
                return dataModal.deny(dataModal.parameters);
            }
        }
        }).modal('show');
    }
}