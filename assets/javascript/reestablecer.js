$(document).ready(function(){
        $('.alert-success').delay(4000).fadeOut(1500);
   $('#new_confirm').on('change',function(){ check_password(this);});

});

function check_password(input) {
    if (input.value != document.getElementById('new').value) {
        input.setCustomValidity('Las contraseñas deben coincidir en longitud y caracteres.');
    } else {
        // input is valid -- reset the error message
        input.setCustomValidity('');
    }
}

