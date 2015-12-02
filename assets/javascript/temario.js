
$(document).ready(function () {
    $('.alert-success').delay(4000).fadeOut(1500);
//inicio de codigo listas desplegables  registrar tema
    $('#cursos_temario').ready(function () {
        llena_lista_desplegable_cursos('cursos_temario', 'error', 'loader_t'); //llena cursos de la pantalla temario seccion temas     
    });//fin de codigo llena lista de cursos

//inicio de codigo 
    $('#cursos_s').ready(function () {
        llena_lista_desplegable_cursos('cursos_s', 'error_s', 'loader_st'); //llena cursos de la pantalla temario seccion subtemas     
    });
    $('#cursos_s').on('click', function () {
        if ($(this).val() == '' || $(this).val() == 0) {
            $('#temas').children('.temas').remove();
        } else {
            $('#temas').children('.temas').remove();
            llena_lista_desplegable_temas('temas', 'cursos_s', 'loader_st');

        }
    });

//fin de codigo listas desplegables resgitrar subtema


// inicio codigo listas desplegables registrar subsubtema
    $('#cursos_ss').ready(function () {
        llena_lista_desplegable_cursos('cursos_ss', 'error_ss', 'loader_sst'); //llena cursos de la pantalla temario seccion subsubtemas     
    });
    $('#cursos_ss').on('click', function () {
        $('#error_ss').html('');
        if ($(this).val() == '' || $(this).val() == 0) { // si no selecciono ningun curso
            $('#temas2').children('.temas').remove();
        } else {  // si selecciono algun curso
            llena_lista_desplegable_temas('temas2', 'cursos_ss', 'loader_sst');
            $('#temas2').children('.temas').remove();
        }
    });
    $('#temas2').on('click', function () {
        // $('#error_ss').html('');
        if ($(this).val() == '' || $(this).val() == 0) {
            //$('#error_ss').append('Elige un tema');
            $('#subtemas').children('.subtemas').remove();
        } else {
            // var txt = $('#temas2').children(':selected');
            // $('#error_ss').append('Tema: ' + '<label class="text-primary">' + txt.text() + '</label>');
            llena_lista_desplegable_subtemas('subtemas', 'temas2', 'loader_sst');
            $('#subtemas').children('.subtemas').remove();
        }
    });
    /*  $('#subtemas').on('click', function () {
     $('#error_ss').html('');
     if ($('#subtemas').val() == '') {
     $('#error_ss').append('Elige un subtema');
     } else {
     var txt = $('#subtemas').children(':selected');
     $('#error_ss').append('Agregando subsubtema a: ' + '<label class="text-primary">' + txt.text() + '</label>');
     }
     });*/
// fin de codigo listas desplegables agregar subsubtema

    $('#myTabs a:first').tab('show');
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
    lastTab = 0;
// var hash = window.location.hash;
//$('#tabs').find('a[href='+hash+']').click();

});
//**********************************************************************************
// fin del document ready 
/* @param {type} lista
 * @param {type} contenedor
 * @param {type} loader
 * @returns {undefined}
 */


function llena_lista_desplegable_cursos(lista, contenedor, loader) {
    $.ajax({
        url: 'temario_controller/llena_lista_desplegable_cursos',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) {
                $('#' + lista).append('<option class="opc alert alert-warning" value="">No hay cursos, no puedes continuar.</option>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + lista).append('<option style="" class="opc" value=' + value.id + '>' + value.nombre + '</option>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut("slow");

            $('#' + lista).append('<option class="opc alert alert-warning" value="">  No se pueden obtener los cursos, respuesta del servidor no encontrada, (' + xhr.status + ' - ' + xhr.statusText + ' )</option>');
        }
    }); // ajax()
}

function llena_lista_desplegable_temas(lista, id, loader) {
    var valor = $('#' + id).val();
    $.ajax({
        url: 'temario_controller/llena_lista_desplegable_temas/' + valor,
        //data: {id: id},
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut("slow");
            if (data == null) {
                $('#' + lista).append('<option class="temas " value>No hay temas.</option> ');
            } else {
                $.each(data, function (i, value) {
                    $('#' + lista).append('<option style="" class="temas" value=' + value.id + '>' + value.nombre + '</option>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut("slow");
            alert(' No se pueden obtener los temas, respuesta del servidor no encontrada, (' + xhr.status + ' - ' + xhr.statusText + ' ) ');
            // $('#' + contenedor_error).append(' No se pueden obtener los temas, respuesta del servidor no encontrada, (' + xhr.status + ' - ' + xhr.statusText + ' ) ');
        }
    }); // ajax()
}
function llena_lista_desplegable_subtemas(lista, id, loader) {
    var valor = $('#' + id).val();
    $.ajax({
        url: 'temario_controller/llena_lista_desplegable_subtemas/' + valor,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut("slow");
            if (data == null) {
                $('#' + lista).append('<option class="subtemas alert alert-warning" value>No hay subtemas.</option> ');
            } else {
                $.each(data, function (i, value) {
                    $('#' + lista).append('<option style="" class="subtemas" value=' + value.id + '>' + value.nombre + '</option>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut("slow");
            $('#' + lista).append(' <option class="subtemas alert alert-warning" value> No se pueden obtener los subtemas, respuesta del servidor no encontrada, (' + xhr.status + ' - ' + xhr.statusText + ' ) ]</option>');
        }
    }); // ajax()
}
function llena_lista_desplegable_subsubtemas(lista, id, loader) {
    var valor = $('#' + id).val();
    $.ajax({
        url: 'contenido_controller/llena_lista_desplegable_subsubtemas/' + valor,
        type: 'GET',
        dataType: 'json',
         beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) {
                $('#' + lista).append(' <option class="subsubtemas alert alert-warning" value>No hay subsubtemas.</option>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + lista).append('<option style="" class="subsubtemas" value=' + value.id + '>' + value.nombre + '</option>');
                });
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut();
            $('#' + lista).append('<option class="subsubtemas alert alert-warning" value>  No se pueden obtener los subsubtemas, respuesta del servidor no encontrada, (' + xhr.status + ' - ' + xhr.statusText + ') </option>');
        }
    }); // ajax()
}
