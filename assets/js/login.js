$("#continuar").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url() + "Clogin/Autenticar",
        type: "POST",
        data: $("#frmLogueo").serialize(),
        success: function (resultado) {
            var datos = JSON.parse(resultado);
            if (datos.exito == true) {
                alertify.set('notifier','position', 'top-right');
                alertify.success(datos.mensaje);
                window.location.href = base_url() + "Cinicio";
            } else {
                alertify.set('notifier','position', 'top-right');
                alertify.error(datos.mensaje);
                return false;
            }
        },
        error: function (error) {
            alertify.error('Ocurrio un Error');
            return false;
        }
    });
});