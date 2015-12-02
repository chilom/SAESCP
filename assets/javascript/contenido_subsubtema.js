$(document).ready(function () {
//links de contenido
    $('#links_contenido').on('click', '.link_ss', function () {
        var url = $(this).attr('value');
        $('#contenido').children().remove();
        $('#contenido').append('<object class="frame_contenido" frameborder="0" height="500" data="http://docs.google.com/gview?url=' + url + '&embedded=true"> </object>');
        if ($('#contenido').children().length > 0) {
            $('#termine_leer').show();
            $('.botones_contenido').hide();
            $('#termine_leer').removeClass('btn-default').addClass('btn-success');
            $('#termine_leer').attr('disabled', false);
            $('#termine_leer i').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
        } else {
            $('#termine_leer').attr('disabled', true);
        }
        var id_contenido = $(this).attr('data');
        $('#id_contenido').val(id_contenido);
        registra_inicio_lectura_contenido(id_contenido);
        $(this).siblings('.link_ss').hide();
        $('#resultado_evaluacion').children().remove();
        $('#resultado_evaluacion').append('<div>' + $(this).html() + ', obtuviste: </div>');
        $('#resultado_evaluacion').hide();
        $('#contenedor_actividades').children().remove();

    });

//ocultar todo los botones del area de trabajo 
    $('.botones_contenido').hide();
    $('#termine_leer').hide();
//boton temine leer
    $('#termine_leer').click(function () {
        $(this).removeClass('btn-success').addClass('btn-default');
        $(this).attr('disabled', true).hide();
        $('#termine_leer i').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
        $('#btn_actividad').show();
        $('#btn_actividad').attr('disabled', false);
        var id = $('#id_contenido').val(); //alert(id);
        registra_fin_lectura_contenido(id);
        $('#contenido').children().remove();
    });
//boton actividad
    $('#btn_actividad').click(function () {
        $('#termine_leer').hide();
        $('#contenedor_actividades').children().remove();
        obtiene_actividades_subsubtema('subsub_elegido', 'contenedor_actividades', 'loader_actividades');
    });

    $('#contenedor_actividades').on('click', '.actividades_ss', function () {
        $('#btn_verificar').show();
        $('#btn_verificar').attr('disabled', false);
        var id_actividad = $(this).attr('value');

        $(this).siblings('.actividades_ss').hide();
        $('#btn_actividad').hide().attr('disabled', true);
        $('#resultado_actividad').children('span').remove();
        $('#resultado_actividad').append('<span>' + $(this).html() + '</span>');
        // muestra_actividad(id_actividad);
        var url = $(this).attr('value');
        $('#contenido').children().remove();
        $('#contenido').append('<object name="frame_act" class="frame_contenido" frameborder="0" height="500" data="' + url + '"> </object>');//http://docs.google.com/gview?url=   &embedded=true
        registra_inicio_actividad(id_actividad);
    });

//boton verificar resultado actividades
    $('#btn_verificar').click(function () {
        $('#btn_evaluacion').show();
        $('#btn_evaluacion').attr('disabled', false);
        // registra_fin_actividad();
        $('#contenedor_actividades').children().show();
        $('#resultado_actividad').children('span#res').remove();
       // var resultado_a = $('object').contents().find("p#res_act");
         // var k = $("object.frame_contenido").contents().find('#res_act').innerHTML;
            alert('resultados enviados');
       // $('#resultado_actividad').show().append('<span id="res">,'+resultado_a.html()+'</span>');

    });
//boton evaluacion
    $('#btn_evaluacion').click(function () {
        $('#btn_calificar').show();
        $('#btn_calificar').attr('disabled', false);
        $('#contenedor_actividades').children().remove();
        $('#btn_actividad').hide().attr('disabled', true);
        $('#btn_verificar').hide().attr('disabled', true);
        $('#resultado_actividad').children().remove();

    });
//boton calificar
    $('#btn_calificar').click(function () {
        $('.botones_contenido').hide();
        $('#termine_leer').hide();
        $('#links_contenido').children('.link_ss').show();
        $('#resultado_evaluacion').show().append('<span>0 puntos</span>');
    });

});// fin document ready
/*
 * 
 * 
 * 
 */
function muestra_actividad(id) {
    var id = $('#' + subsub).attr('value');
    $.ajax({
        url: 'actividades_controller/obtiene_actividades_subsubtema/' + id,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) { // $('#' + lista).append               
                $('#' + contenedor).append('<li class="actividades_ss alert alert-warning ">Sin actividades.</li>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<li style="margin-right:0%;" class="actividades_ss col-md-12 text-left label label-warning col-md-12" data="' + value.id + '" value=" ' + value.url + '  ">' + value.nombre_actividad + ' </li>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut();

            $('#' + contenedor).append('<li class="actividades_ss">No se pueden obtener actividades,  falta algun parametro.</li>');
            // $('#subt').append('<div class="subtemas err_temario"> No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </div>');
        }
    }); // ajax() 
}

function obtiene_actividades_subsubtema(subsub, contenedor, loader) {
    var id = $('#' + subsub).attr('value');
    $.ajax({
        url: 'actividades_controller/obtiene_actividades_subsubtema/' + id,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) { // $('#' + lista).append               
                $('#' + contenedor).append('<li class="actividades_ss alert alert-warning ">Sin actividades.</li>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<li style="margin-right:0%;" class="actividades_ss col-md-12 text-left label label-warning col-md-12" data="' + value.id + '" value=" ' + value.url + '  ">' + value.nombre_actividad + ' </li>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut();

            $('#' + contenedor).append('<li class="actividades_ss">No se pueden obtener actividades,  falta algun parametro.</li>');
            // $('#subt').append('<div class="subtemas err_temario"> No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </div>');
        }
    }); // ajax() 
}

function registra_fin_lectura_contenido(id) {
    $.ajax({
        url: 'contenido_controller/registra_fin_lectura_contenido/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            //alert(data);
            if (data == null) { // $('#' + lista).append               
                //  $('#' + contenedor).append('<div class="subtemas ">Sin subtemas. <a style="color:white" href="javascript:history.back(1)">regresar</a></div>');
            } else {
                //   $.each(data, function (i, value) {
                //      $('#' + contenedor).append('<li style="margin-right:2%;" class="subtemas col-md-12 text-left "  value=" ' + value.ids + '  ">' + value.ntema + '.' + value.nsubtema + '. ' + value.snombre + '</li>');
                //  });
            }
        },
        error: function (xhr) {
            //$('#' + contenedor).append('<li class="subtemas">No se pueden obtener subtemas,  falta algun parametro.</li>');
            // $('#subt').append('<div class="subtemas err_temario"> No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </div>');
        }
    }); // ajax() 
}
function registra_inicio_lectura_contenido(id_contenido) {
    $.ajax({
        url: 'contenido_controller/registra_inicio_lectura_contenido/' + id_contenido,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            //alert(data);
            if (data == null) { // $('#' + lista).append               
                //  $('#' + contenedor).append('<div class="subtemas ">Sin subtemas. <a style="color:white" href="javascript:history.back(1)">regresar</a></div>');
            } else {
                //   $.each(data, function (i, value) {
                //      $('#' + contenedor).append('<li style="margin-right:2%;" class="subtemas col-md-12 text-left "  value=" ' + value.ids + '  ">' + value.ntema + '.' + value.nsubtema + '. ' + value.snombre + '</li>');
                //  });
            }
        },
        error: function (xhr) {
            //$('#' + contenedor).append('<li class="subtemas">No se pueden obtener subtemas,  falta algun parametro.</li>');
            // $('#subt').append('<div class="subtemas err_temario"> No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </div>');
        }
    }); // ajax() 
}