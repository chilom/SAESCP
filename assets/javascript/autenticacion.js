/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 
 */

$(document).ready(function () {
    $('.alert-success').delay(4000).fadeOut(1500);

    $('[rel="tooltip"]').tooltip('show');
}); //-----------------fin document ready()----------------------------------------------------------

/*###########################################################################################
 *########################################################################################### 
 * Funciones 
 *###########################################################################################  
 *###########################################################################################  
 */
function verifica_si_sesion_expiro(modal) {

    $.ajax({
        url: 'auth/verifica_si_sesion_expiro/',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $("#loader_ex_ses").show();
        },
        success: function (data) {
            $("#loader_ex_ses").fadeOut("slow");
            if (data) { // $('#' + lista).append    
                //  alert('La sesion expiro, redireccionando...');
              // $(location).attr('href', 'auth/');  
 //$(location).attr('href', 'auth/');                     // $(this).append('<div class=" err_temario">No hay informacion en la BD.</div>');
            } else {              //   $('#' + modal).modal(); 

                                // $(this).append('<div class=" err_temario">No hay informacion en la BD.</div>');
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




function valida_entradas_tema() {
    $("#form_ajax_tema").submit(function () {
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            beforeSend: function () {
                $(".loader").show('slow');
            },
            success: function () {
                $(".loader").fadeOut("slow");
            }
        });
    });
}

function valida_entradas_subtema() {
    $("#form_ajax_subtema").submit(function () {
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            beforeSend: function () {
                $(".loader").show();
            },
            success: function () {
                $(".loader").fadeOut("slow");
            }
        });
    });
}

function valida_entradas_subsubtema() {
    $("#form_ajax_subsubtema").submit(function () {
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            beforeSend: function () {
                $(".loader").show();
            },
            success: function () {
                $(".loader").fadeOut("slow");
            }
        });
    });
}


function valida_entradas_contenido() {
    $("#form_ajax_contenido").submit(function () {
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            beforeSend: function () {
                $(".loader").show();
            },
            success: function () {// alert('TERMINE');
                $(".loader").fadeOut("slow");
            }
        });
    });
}

















