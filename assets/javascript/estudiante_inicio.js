/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {
 
    

 /*setInterval(function () {
        //alert('Sesionexpiro. Redierccionando...');
        verifica_si_sesion_expiro('myModal');
        //alert('bye');
    }, 60000);*/
    
    $('.alert-success').delay(4000).fadeOut(1500);

   /* $('#mis_cursos').ready(function () {
        llena_mis_cursos('mis_cursos', 'id', 'loader_mis_c');
    });
    $('#btn_act_mis_c').click(function(){
         $('#mis_cursos').children().remove();
                llena_mis_cursos('mis_cursos', 'id', 'loader_mis_c');
    });*/
    $('#curso_inscribir').ready(function(){
        llena_lista_desplegable_cursos('curso_inscribir','loader_insc');
    });
    
    
 /*/  setTimeout(function () {
        //alert('Sesionexpiro. Redierccionando...');
        verifica_si_sesion_expiro();
        $('#myModal').delay(5000).modal();
    }, 7200);*/
});
// fin de document ready
/*
 * 
 * @param {type} contenedor
 * @param {type} id
 * @param {type} loader
 * @returns {undefined}
 * 
 */                
function llena_mis_cursos(contenedor, id, loader) {
    var est = $('#' + id).val();
    $.ajax({
        url: 'curso_controller/llena_mis_cursos/' + est,
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#" + loader).show();
        },
        success: function (data) {
            $("#" + loader).fadeOut("slow");
            if (data == '0') {
                $('#' + contenedor).append('<div class="text-left  alert alert-success"> <a class="  close  " data-dismiss="alert" >X</a><i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;\n\
                                           No hay cursos disponibles.</div>');
            } else if (data == null) {
                $('#' + contenedor).append('<div class="text-left  alert alert-success"> <a class="  close  " data-dismiss="alert" >X</a><i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;\n\
                                            El maestro aun valida el acceso a tus cursos.</div>');
            } else {
                $.each(data, function (i, value) {
                    $('#' + contenedor).append('<a style="" class="btn btn-primary text-uppercase  col-md-3 micurso" href="curso_controller/llena_temario/' + value.curso_id + ' ">' + value.nombre + '</a>');
                });
            }
        },
        error: function (xhr) {
            $('#' + contenedor).append('  No se pueden obtener mis cursos, respuesta del servidor no encontrada, intenta mas tarde (' + xhr.status + ' - ' + xhr.statusText + ' )  ');
        }
    }); // ajax()
}




function llena_lista_desplegable_cursos(lista, loader) {
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