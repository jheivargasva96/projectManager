alertify.set('notifier', 'position', 'top-right');

message = '<small>';
message += '<h6>La contraseña debería cumplir con los siguientes requerimientos:</h6>';
message += '<ul>';
message += '<li>Al menos debería tener <strong>una letra en minúsculas</strong></li>';
message += '<li>Al menos debería tener <strong>una letra en mayúsculas</strong></li>';
message += '<li>Al menos debería tener <strong>un caracter especial</strong></li>';
message += '<li>Al menos debería tener <strong>un número</strong></li>';
message += '<li>Debería tener entre <strong>8 y 16 carácteres</strong></li>';
message += '</ul>';
message += '</small>';

$.validator.addMethod("passwordcheck", function (value) {
    return /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/.test(value)
});

jQuery.extend(jQuery.validator.messages, {
    required: '<span style="color: red;">Campo obligatorio</span>',
    equalTo: '<span style="color: red;">Los campos no coinciden</span>',
    passwordcheck: message
});

$("#form_recovery").validate({
    rules: {
        nueva: {
            required: true,
            passwordcheck: true
        },
        confirmar: {
            required: true,
            equalTo: "#nueva",
            passwordcheck: true
        }
    },
    submitHandler: function (form) {
        sendDataRecovery();
        return false;
    }
});

function sendDataRecovery() {
    $.ajax({
        url: base_url() + 'Clogin/saveNewPassword',
        type: "POST",
        data: $("#form_recovery").serialize(),
        success: function (resultado) {
            var data = JSON.parse(resultado);
            if (data.success == true) {
                alertify.success(data.message);
                setTimeout(function(){
                    window.location.href = base_url() + 'Clogin';
                }, 1000);
            } else {
                alertify.error(data.message);
            }
        },
        error: function (error) {
            alertify.error(error);
        }
    });
}