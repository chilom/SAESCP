
$(document).ready(function () {
//llenar contenido subsubtemas
    $('#tema_aprender').on('click', '.a_temario', function () {
        $('#links_contenido').children('li').remove();
        $('#contenido').children().remove();
        var cual = $(this).val();
        $.ajax({
            url: 'contenido_controller/muestra_contenido_subsubtema/' + cual,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $("#loader_c_s").show();
            },
            success: function (data) {
                $("#loader_c_s").fadeOut();
                if (data == null) { // $('#' + lista).append               
                    $('#links_contenido').append('<li class=" alert alert-warning text-center ">Sin contenido</li>');
                } else {
                    $.each(data, function (i, value) {
                        $('#links_contenido').append('<li  class="link_ss col-md-12 " value=' + value.url + '  >' + value.nombre + '</li>');
                    });
                }
            },
            error: function (xhr) {
                $("#loader_c_s").fadeOut();
                $('#links_contenido').append('<li class="subtemas">No se pueden obtener subtemas,  falta algun parametro.</li>');
            }
        }); // ajax() 
    });// fin llenar contenido subsubtema

//inicio llenar contenido subsubtema
    $('#ss_aprender').on('click', '.ssubtemas', function () {
        $('#links_contenido').children('li').remove();
        $('#contenido').children().remove();
        var subtema_id = $(this).val();  // alert(subtema_id);
        $.ajax({
            url: 'contenido_controller/muestra_contenido_subsubtema/' + subtema_id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $("#loader_cc").show();
            },
            success: function (data) {
                $("#loader_cc").fadeOut();
                if (data == null) { // $('#' + lista).append               
                    $('#links_contenido').append('<li data="' + value.id + '" class=" alert alert-warning text-center ">Sin contenido</li>');
                } else {
                    $.each(data, function (i, value) {
                        $('#links_contenido').append('<li  class="link_ss "  value="' + value.url + '"  > <i class="glyphicon glyphicon-book"></i> &nbsp;' + value.nombre + '</li>');
                    });
                }
            },
            error: function (xhr) {
                $("#loader_cc").fadeOut();
                $('#links_contenido').append('<li class="">No se pueden obtener subtemas,  falta algun parametro.</li>');
            }
        }); // ajax() 
    });//fin llenar contenido subtema



    
    
    

});// fin del document ready
/*
 * 
 * -----------------------------------------------------------------------------------------------
 * 
 * 
 */




function llena_subtemas(tema_id, contenedor) {
    var tema_id = $('#' + tema_id).val();
    $.ajax({
        url: 'curso_controller/llena_temario_subtemas/' + tema_id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data == null) { // $('#' + lista).append               
                $('#' + contenedor).append('<div class="subtemas ">Sin subtemas. <a style="color:white" href="javascript:history.back(1)">regresar</a></div>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<li style="margin-right:2%;" class="subtemas col-md-12 text-left "  value=" ' + value.ids + '  ">' + value.ntema + '.' + value.nsubtema + '. ' + value.snombre + '</li>');
                });
            }
        },
        error: function (xhr) {
            $('#' + contenedor).append('<li class="subtemas">No se pueden obtener subtemas,  falta algun parametro.</li>');
            // $('#subt').append('<div class="subtemas err_temario"> No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </div>');
        }
    }); // ajax() 
}
function llena_ssubtemas(subtema_id, contenedor, loader) {
    //  var subtema_id = $('#' + stema_id).val();
    $.ajax({
        url: 'curso_controller/llena_temario_subsubtemas/' + subtema_id,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) {
                $('#' + contenedor).append('<li class="ssubtemas ">No hay subsubtemas para este subtema. Elija otro subtema</li>');
                $('#hay_ss').val('0');
            } else {
                $('#hay_ss').val('1');
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<li value=' + value.idss + ' style="margin-right:2%;" class="ssubtemas col-md-12 text-left"  >' + value.ntema + '.' + value.nsubtema + '.' + value.ssnumero + ' ' + value.ssnombre + '</a>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut();
            $('#' + contenedor).append('<li class="ssubtemas "> No se pueden obtener subsubtemas, falta algun parametro</li>');
        }

    }); // ajax() 
    //  $('#subt').children('.subtemas').remove();
    //  $(this).children('a.cual').remove();

}
function verifica_si_hay_subsubtemas(subtema_id) {
    var res = false;
    $.ajax({
        url: 'curso_controller/llena_temario_subsubtemas/' + subtema_id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data != null) {
                res = true;
            }
            return res;
        },
        error: function (xhr) {
            // $('#' + contenedor).append('<li class="ssubtemas "> No se pueden obtener subsubtemas, falta algun parametro</li>');
        },
        finally: function () {

        }

    }); // ajax() 
}



function llena_contenido_subtemas(subtema_id, contenedor, loader) {
    var id = $(subtema_id).val();
    $.ajax({
        url: 'contenido_controller/muestra_contenido_subsubtema/' + id,
//    data: {subtema: subtema_id },
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) { // $('#' + lista).append               
                $('#' + contenedor).append('<li class="link_ss alert alert-warning text-center ">Sin contenido</li>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<li  class="link_ss col-md-12" value=' + value.url + '  >' + value.url + '</li>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut();
            $('#' + contenedor).append('<li class="subtemas">No se pueden obtener subtemas,  falta algun parametro.</li>');
        }
    }); // ajax() 

}