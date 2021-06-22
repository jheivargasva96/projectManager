alertify.set('notifier', 'position', 'top-right');

$("#continuar").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url() + "Clogin/SendRecovery",
        type: "POST",
        data: $("#form").serialize(),
        success: function (resultado) {
            var datos = JSON.parse(resultado);
            if (datos.success == true) {
                alertify.success(datos.message);
            } else {
                alertify.error(datos.message);
            }
        },
        error: function (error) {
            alertify.error(error);
        }
    });
});