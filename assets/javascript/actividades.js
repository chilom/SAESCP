
$(document).ready(function () {

// inicio codigo listas depslegables actividad
    $('#cursos_act').ready(function () {
        llena_lista_desplegable_cursos('cursos_act', 'error_act', 'loader_act'); //llena cursos de la pantalla temario seccion subsubtemas     
    });
    $('#cursos_act').on('click', function () {
        $('#error_act').html('');
        if ($(this).val() == '' || $(this).val() == 0) { // si no selecciono ningun curso    
        } else {  // si selecciono algun curso
            llena_lista_desplegable_temas('temas_act', 'cursos_act', 'loader_act');
            $('#temas_act').children('.temas').remove();
        }
    });
    $('#temas_act').on('click', function () {
        $('#error_act').html('');
        if ($(this).val() == '' || $(this).val() == 0) {
        } else {
            llena_lista_desplegable_subtemas('stemas_act', 'temas_act', 'loader_act');
            $('#stemas_act').children('.subtemas').remove();

        }
    });
    $('#stemas_act').on('click', function () {
        $('#error_act').html('');
        if ($(this).val() == '' || $(this).val() == 0) {
        } else {
            llena_lista_desplegable_subsubtemas('sstemas_act', 'stemas_act', 'loader_act');
            $('#sstemas_act').children('.subsubtemas').remove();

        }
    });
    /* $('#sstemas_act').on('click', function () {
     $('#error_act').html('');
     if ($(this).val() == '' || $(this).val() == 0) {
     } else {
     }
     }); */
// fin codigo listas depslegables actividad
});


