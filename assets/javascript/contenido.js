// inicio codigo listas desplegables agregar contenido
$('#cursos_cont').ready(function () {
    llena_lista_desplegable_cursos('cursos_cont', 'error_cont', 'loader_cont'); //llena cursos de la pantalla temario seccion subsubtemas     
});
$('#cursos_cont').on('click', function () {
    $('#error_cont').html('');
    var txt = $('#cursos_cont').children(':selected');
    if ($(this).val() == '' || $(this).val() == 0) {       
    } else {  // si selecciono algun curso       
        $('#temas_cont').children('.temas').remove();
        llena_lista_desplegable_temas('temas_cont', 'cursos_cont', 'loader_cont');
    }
});
$('#temas_cont').on('click', function () {
    $('#error_cont').html('');
    if ($(this).val() == '' || $(this).val() == 0) {
    } else {
        llena_lista_desplegable_subtemas('stemas_cont', 'temas_cont', 'loader_cont');
        $('#stemas_cont').children('.subtemas').remove();
    }
});
$('#stemas_cont').on('click', function () {
    $('#error_cont').html('');
    if ($(this).val() == '' || $(this).val() == 0) {
    } else {
        llena_lista_desplegable_subsubtemas('sstemas_cont', 'stemas_cont', 'error_cont');
        $('#sstemas_cont').children('.subsubtemas').remove();
    }
});
/*$('#sstemas_cont').on('click', function () {
    $('#error_cont').html('');
    if ($('#sstemas_cont').val() == '') {
        $('#error_cont').append('Elige un subsubtema');
        //$('#sstemas_cont').children('.subsubtemas').remove();
    } else {
        var txt = $('#sstemas_cont').children(':selected');
        $('#error_cont').append('Agregar contenido al subsubtema: ' + '<label class="text-primary">' + txt.text() + '</label>');
        // $('#sstemas_cont').children('.subsubtemas').remove();
    }
});*/
// fin codigo listas desplegables agregar contenido






