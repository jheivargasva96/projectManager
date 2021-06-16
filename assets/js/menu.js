$(document).ready(function () {
    $(".modulos").hide();
    datos = modulosPrincipales();
    if (datos.length > 0) {
        $.each(datos, function () {
            children = '';
            string = '<li class="nav-item">';
            if (this.controlador == '') {
                string += '<a href="#" class="nav-link" id="' + this.nombre + '">';
                string += '<i class="nav-icon fas ' + this.icono + '"></i>';
                string += '<p>' + this.etiqueta + '<i class="fas fa-angle-left right"></i></p>';

                dataC = modulosSecundarios(this.idmodulo);
                if (dataC.length > 0) {
                    children += '<ul class="nav nav-treeview">';
                    $.each(dataC, function () {
                        children += '<li class="nav-item">';
                        children += '<a href="' + base_url() + this.controlador + '" class="nav-link" id="' + this.nombre + '">';
                        children += '<i class="nav-icon fas ' + this.icono + '"></i>';
                        children += '<p>' + this.etiqueta + '</p>';
                        children += '</a>';
                        children += '</li>';
                    });
                    children += '</ul>';
                }
            } else {
                string += '<a href="' + base_url() + this.controlador + '" class="nav-link" id="' + this.nombre + '">';
                string += '<i class="nav-icon fas ' + this.icono + '"></i>';
                string += '<p>' + this.etiqueta + '</p>';
            }
            string += '</a>';
            string += children;
            string += '</li>';
            $("#menu").append(string);
        });
    }

});

function modulosPrincipales() {
    var datos = {};
    $.ajax({
        async: false,
        url: base_url() + "Cpermiso/consultarModulosPrincipales",
        type: "POST",
        success: function (resultado) {
            datos = JSON.parse(resultado);
        },
        error: function (error) {
            return false;
        }
    });

    return datos;
}

function modulosSecundarios(cod_padre) {
    console.log(cod_padre);
    var dataC = {};
    $.ajax({
        async: false,
        url: base_url() + "Cpermiso/consultarModulosSecundarios",
        type: "POST",
        data: {
            cod_padre: cod_padre
        },
        success: function (result) {
            dataC = JSON.parse(result);
            console.log(dataC);
        }
    });
    return dataC;
}