$(document).ready(function () {

    $('.alert-success').delay(5000).fadeOut(1500);

    $('#estudiante_checkbox').on('change', function () {
        es_estudiante();
    });

    $('#maestro_checkbox').on('change', function () {
        es_maestro();
    });

    // alert('reu');




    function es_estudiante() {
        if ($('#estudiante_checkbox').is(':checked')) {
            $('#maestro_checkbox').removeAttr('required');
            $('#username').attr({
                'pattern': '[sS0-9]{9}',
                'title': ' Ejemplo: s09011559. (9 caracteres.)'
            });
            $('#nota_estudiantes').removeAttr('hidden');
            $('.no-es-estudiante').attr('hidden', 'true');
        } else {
            $('#nota_estudiantes').attr('hidden', 'true');
            $('.no-es-estudiante').removeAttr('hidden');
        }
    }

    function es_maestro() {
        if ($('#maestro_checkbox').is(':checked')) {
            $('.si-es-estudiante').attr('hidden', 'true');
            $('#estudiante_checkbox').removeAttr('required');
            $('#username').attr({
                'pattern': '[a-z ]{9,30}',
                'title': 'Ejemplo: maestro de programacion. (9 a 30 caracteres.)',
                'required': 'true'
            });
        } else {
            $('.si-es-estudiante').removeAttr('hidden');
        }
    }
   
   $('#password_confirm').on('change',function(){ check_pass(this);});
});
/**
 * 
 * funciones  javascript
 * 
 * 
 */
function check_pass(input) {
    if (input.value != document.getElementById('password').value) {
        input.setCustomValidity('Las contraseñas deben coincidir en longitud y caracteres.');
    } else {
        // input is valid -- reset the error message
        input.setCustomValidity('');
    }
}


