alertify.set('notifier', 'position', 'top-right');
return;
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

    $("#actualizar_password").click(function () {
        $("#ModalUser .modal-content").load(base_url() + 'Cusuario/ModalPassword', function () {
            $("#ModalUser").modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });

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

            $("#form").validate({
                rules: {
                    actual: {
                        required: true
                    },
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
                    sendDataPassword();
                    return false;
                }
            });
        });
    });

    $("#editar_perfil").click(function () {
        editDataUsuario($(this).attr('idusuario'));
    });
});

function sendDataPassword() {
    $.ajax({
        url: base_url() + 'Cusuario/newPassword',
        type: "POST",
        data: $("#form").serialize(),
        success: function (resultado) {
            var data = JSON.parse(resultado);
            if (data.success == true) {
                alertify.success(data.message);
                $('#ModalUser').modal('toggle');
            } else {
                alertify.error(data.message);
                return false;
            }
        },
        error: function (error) {
            alertify.error(error);
            return false;
        }
    });
}

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
        }
    });
    return dataC;
}

function cargarPerfilesUsuario() {
    $.ajax({
        url: base_url() + "Cusuario/consultarPerfiles",
        type: "POST",
        async: false,
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                if (data.length > 0) {
                    $.each(data, function () {
                        $('[name=perfil_idperfil]').append($('<option />', {
                            text: this.nombre,
                            value: this.idperfil,
                        }));
                    });
                }
            } catch (e) {
                alertify.error('¡Error! Los datos no han podido ser procesados(JSON.parse-Error)');
                console.log(e);
            }
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
}

function cargarTipoDocumentoUsuario() {
    $.ajax({
        url: base_url() + "Cusuario/consultarTipoIdentificacion",
        type: "POST",
        async: false,
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                if (data.length > 0) {
                    $.each(data, function () {
                        $('[name=tipo_identificacion_idtipo_identificacion]').append($('<option />', {
                            text: this.nombre,
                            value: this.idtipo_identificacion,
                        }));
                    });
                }
            } catch (e) {
                alertify.error('¡Error!los data no han podido ser procesados(JSON.parse-Error)');
                console.log(e);
            }
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
}

function editDataUsuario(id) {
    $("#ModalUser .modal-content").load(base_url() + 'Cusuario/ModificarPerfil', function () {
        $("#ModalUser").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });

        var title = 'Actualizar Usuario';
        var button = 'Editar';

        cargarPerfilesUsuario();
        cargarTipoDocumentoUsuario();

        $('#title').text(title);
        $("#guardar").html(button);

        consultarUsuario(id);

        $("form").on('submit', function (e) {
            e.preventDefault();
            sendDataPerfil();
        });
    });
}

function consultarUsuario(id) {
    $.ajax({
        type: "POST",
        url: base_url() + "Cusuario/consultar",
        data: {
            'id': id
        },
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                for (var key in data) {
                    valor = data[key];
                    if (key == 'tipo_identificacion_idtipo_identificacion' || key == 'perfil_idperfil') {
                        $('[name="' + key + '"] [value="' + valor + '"]').attr('selected', true);
                    } else {
                        $('[name="' + key + '"]').val(valor);
                    }                    
                }
            } catch (e) {
                alertify.error('¡Error! Los datos no han podido ser procesados (JSON.parse-Error)');
                console.log(e);
            }
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
}

function sendDataPerfil() {
    $.ajax({
        url: base_url() + 'Cusuario/guardar',
        type: "POST",
        data: $("#form").serialize(),
        success: function (resultado) {
            var data = JSON.parse(resultado);

            if (data.success == true) {
                alertify.success("Guardado!");
                $('#ModalUser').modal('toggle');
            } else {
                alertify.error('¡Error!, No se ha podido realizar la acción, comuniquese con el adminsitrador del sistema.');
            }
        },
        error: function (error) {
            alertify.error('Ocurrio un Error');
        }
    });
}