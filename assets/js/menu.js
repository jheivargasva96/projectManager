$(document).ready(function () {
    $(".modulos").hide();
    $.ajax({
        async: false,
        url: base_url() + "Cpermiso/Consultar",
        type: "POST",
        success: function (resultado) {
            var datos = JSON.parse(resultado);
            if (datos.length > 0) {
                $.each(datos, function () {
                    string = '<li class="nav-item">';
                    string += '<a href="' + base_url() + this.controlador + '" class="nav-link" id="' + this.nombre + '">';
                    string += '<i class="nav-icon fas ' + this.icono + '"></i>';
                    string += '<p>' + this.etiqueta + '</p>';
                    string += '</a>';
                    string += '</li>';
                    $("#menu").append(string);
                });
            }
        },
        error: function (error) {
            return false;
        }
    });
});