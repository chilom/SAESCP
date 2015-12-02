//inicio codigo llenado temario
$(document).ready(function () {




    $('#temario').ready(function () {
        llena_temario_curso('temario', 'curso', 'loader_tt');
    });

    $('#temario').on('click', '.temas', function () {
        var tema_id = $(this).val();
        $.ajax({
            url: 'curso_controller/llena_temario_subtemas/' + tema_id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $("#loader_ts").show();
            },
            success: function (data) {
                $("#loader_ts").fadeOut();
                if (data === null) {
                    $('#subt').append('<div class="subtemas ">No hay subtemas para este tema. Elija otro tema</div>');
                } else {

                    $.each(data, function (i, value) {
                        $('#subt').append('<li style="margin-right:2%;" class="subtemas col-md-12 text-left "  value=" ' + value.ids + '  ">' + value.ntema + '.' + value.nsubtema + ' ' + value.snombre + '</li>');
                    });
                }
            },
            error: function (xhr) {
                $("#loader_ts").fadeOut();
                $('#subt').append('<span class="subtemas ">No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </span>');
            }
        }); // ajax() 
        if ($('.subtemas').length) {
            $('#subt').children('.subtemas').remove();
            // hacer algo aquí si el elemento existe
            $('#ssubt').children('.ssubtemas').remove();
        } else {
            $(this).children('a.cual').remove();
            var cual = $(this).val();
            if (cual > 0) {
                $(this).append('<a class="cual" href="tema_controller/muestra_tema/' + cual + '"> IR </a>');
            }
        }
        /*else {
         $(this).append('<a class="cual" href="auth/muestra_pantalla_estudiante/"> o vuelve a ver los cursos </a>');
         }*/
    });

    $('#subt').on('click', '.subtemas', function () {
        var subtema_id = $(this).val();
        $.ajax({
            url: 'curso_controller/llena_temario_subsubtemas/' + subtema_id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $("#loader_tss").show();
            },
            success: function (data) {
                $("#loader_tss").fadeOut("slow");
                if (data == null) {
                    $('#ssubt').append('<div class="ssubtemas ">No hay subsubtemas para este subtema. Elija otro subtema</div>');

                } else {
                    $.each(data, function (i, value) {
                        $('#ssubt').append('<a style="margin-right:2%;" class="ssubtemas col-md-12 text-left" href="contenido_controller/muestra_contenido_subsubtema/ ' + value.idss + '"  >' + value.ntema + '.' + value.nsubtema + '.' + value.ssnumero + ' ' + value.ssnombre + '</a>');
                    });
                }
            },
            error: function (xhr) {
                $("#loader_tss").fadeOut("slow");
                $('#ssubt').append('<div class="ssubtemas "> No se pueden obtener subsubtemas, falta algun parametro');
            }
        }); // ajax() 
        //alert($("a.ssubtemas").length);
        if ($(".ssubtemas").length) {
            $('#ssubt').children('.ssubtemas').remove();
            // hacer algo aquí si el elemento existe
        } else {
            $(this).children('a.cual').remove();
            var cual = $(this).val();
            if (cual > 0) {
                $(this).append('<a class="cual" href="tema_controller/muestra_subtemas/' + cual + '"> IR </a>');
            }
        }


    });
    /* $('#ssubt').on('click', '.ssubtemas', function () {
     $(this).children('a.cual').remove();
     var cual = $(this).val();
     if (cual > 0) {
     $(this).append('<a class="cual" href="tema_controller/muestra_subsubtemas/' + cual + '"> IR </a>');
     } /*else {
     $(this).append('<a class="cual" href="auth/muestra_pantalla_estudiante/">Volver a ver los cursos </a>');
     }
     });*/


//fin codigo llenado temario
});//fin docuemnt ready
/**
 * 
 * 
 */


function llena_temario_curso(contenedor, id, loader) {
    var curso_id = $('#' + id).val();
    $.ajax({
        url: 'curso_controller/llena_temario_curso/' + curso_id,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut();
            if (data == null) { // $('#' + lista).append               
                // alert('No hay cursos registrados. Primero crea un curso');
                $('#head_t_c').append('No hay temario');
                $('#' + contenedor).append('<a id="btn_regresar" href="auth/muestra_pantalla_estudiante">Regrese y seleccione otro curso</a>');


            } else {
                var curso = '';
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<li style="margin-right:2%;" class="temas col-md-12 text-left " value=" ' + value.idt + '  ">' + value.ntema + '. ' + value.nombret + ' </li> ');//[' + value.dtema + ' ]
//<a href="contenido/muestra_pantalla_contenido/' + value.idt + '">ver</a/>');
                    curso = value.nombrec;
                });
                $('#head_t_c').append('Temario de ' + curso);
            }
        },
        error: function (xhr) {
            $("#" + loader).fadeOut();
            $('#' + contenedor).append(' No se pueden obtener temario, respuesta del servidor no encontrada, intenta mas tarde.');
        }
    }); // ajax()
}
