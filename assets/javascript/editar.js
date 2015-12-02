$(document).ready(function () {
    $('.alert-success').delay(4000).fadeOut(1500);
    $('#password_confirm').on('change', function () {
        check_pass(this);
    });


});

