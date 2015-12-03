//general.js
// Codigo jQuery general (funciones utilizadas)
$(document).ready(function () {
    $('.alert-success').delay(4000).fadeOut(1500);
    $('[rel="tooltip"]').tooltip('show');
    $('.tablas').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        "oLanguage": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });

    $('#ocultar_informacion').on('click', function () {
        $('#informacion').toggle();
        $(this).html('');
        $(this).html('Ver información').attr('id', 'ver_info');
    });
    $('#ver_info').on('click', function () {
        $('#informacion').show();
        $(this).html('');
        $(this).html('Ocultar información').attr('id', 'ocultar_informacion');
    });



}); //-----------------fin document ready()----------------------------------------------------------