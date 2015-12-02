$(document).ready(function () {

    inicia_reloj_logico();
    $('#reloj_logico').click(function () {
        oculta_reloj();
        activa_opcion_ver_reloj();
    });
    $('#ver_reloj').click(function () {
        muestra_reloj_logico();
    });

    /*  $('#head_curso').ready(function () {
     var curso=''
     curso = $('#curso_temario').val();
     //alert(curso);
     $('#head_curso').children('span').remove();
     $('#head_curso').append('<span>Temario de ' + curso + '</span>');
     
     });*/

    /* $('#head_tema').ready(function () {
     var tema = $('#tema').val();
     //alert(curso);
     $('#head_tema').append(tema);
     });*/

    $("tr:odd").css("background-color", "rgba(0,113,185,.1)"); // filas impares
   // $("tr:even").css("background-color", "rgba(0,182,95,.1)"); // filas pares

});







function inicia_reloj_logico() {
    $.ajax({
        url: 'estudiante_controller/inicia_reloj_logico',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            //alert(response);
            //alert();
            if (response == 1) {
                empezarDetener();
                //  $('#reloj_logico').html('<div class="glyphicon glyphicon-time" style="text-align:center;">' + ' 9999' + '</div>');
            }
        } //success
        , error: function (result) {
            $('#reloj_logico').html(' result.status ' + result.statusText);
            //alert('Disculpe, existió un problema [ ' + result.status + ', ' + result.statusText + ' ]');
        }
    }); // ajax()
}


var inicio = 0;
var timeout = 0;
function empezarDetener() {//elemento)
    if (timeout == 0)
    {        // empezar el cronometro
        // elemento.value = "Detener";
        // Obtenemos el valor actual
        inicio = vuelta = new Date().getTime();
        // iniciamos el proceso
        funcionando();
    } else {
        // detemer el cronometro
        // elemento.value = "Empezar";
        clearTimeout(timeout);
        timeout = 0;
    }
}
function funcionando() {
    // obteneos la fecha actual
    var actual = new Date().getTime();
    // obtenemos la diferencia entre la fecha actual y la de inicio
    var diff = new Date(actual - inicio);
    // mostramos la diferencia entre la fecha actual y la inicial
    var result = LeadingZero(diff.getUTCHours()) + ":" + LeadingZero(diff.getUTCMinutes()) + ":" + LeadingZero(diff.getUTCSeconds());
    document.getElementById('reloj_logico').innerHTML = '<div class="reloj glyphicon glyphicon-time" style="text-align:center;font-size:1.2em;"></div><span>  &nbsp;&nbsp;&nbsp;' + result + '</span>';
    // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
    timeout = setTimeout("funcionando()", 1000);
}
/* Funcion que pone un 0 delante de un valor si es necesario */
function LeadingZero(Time) {
    return (Time < 10) ? "0" + Time : +Time;
}
function oculta_reloj() {
    $('#reloj_logico').hide();
    //$('#ver_reloj').show();
}
function activa_opcion_ver_reloj() {
    // $('#reloj_logico').show();
    $('#ver_reloj').show();
}
function muestra_reloj_logico() {
    $('#reloj_logico').show();
    $('#ver_reloj').hide();
}