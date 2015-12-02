$(document).ready(function(){





 /*setTimeout(function () {
        //alert('Sesionexpiro. Redierccionando...');
        verifica_si_sesion_expiro();
        //alert('bye');
        $('#myModal').modal();
    }, 3000);*/
});





function verifica_si_sesion_expiro() {
    $.ajax({
        url: 'auth/verifica_si_sesion_expiro/',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#loader_ex_ses").show();
        },
        success: function (data) {
            $("#loader_ex_ses").fadeOut("slow");
            if (data == false) { // $('#' + lista).append               
                $(location).attr('href', 'auth/');                     // $(this).append('<div class=" err_temario">No hay informacion en la BD.</div>');
            } else {
               // $(location).attr('href', 'auth/');                     // $(this).append('<div class=" err_temario">No hay informacion en la BD.</div>');
                // alert('tu sesion expiro');
                // $.each(data, function (i, value) {
                //$('#subtemas_trabajo').append('<li style="margin-right:2%;" class="subtemas col-md-12 text-left text-uppercase" data="contenido/muestra_pagina_contenido" value=" ' + value.ids + '  ">' + value.ntema + '.' + value.nsubtema + ' ' + value.snombre + '</li>');
                //   $('#avance_curso').append('<li style="margin-right:%;" class="avance_x_c col-md-12 text-left text-uppercase" data="" value=" ' + value.users_id + '  "> '+ value.avance + '</li>');
                // });
            }
        },
        error: function (xhr) {
            $("#loader_ex_ses").fadeOut("slow");
            // $('#subt').append('<div class="subtemas err_temario">[ No se pueden obtener subtemas,  falta algun parametro o no se encontro respuesta del servidor. </div>');
        }
    }); // ajax()
}
