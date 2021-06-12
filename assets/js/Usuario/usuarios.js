table = 'usuario';
controlador = 'Cusuario';
fields = ['identificacion', 'nombres', 'apellidos', 'correo', 'telefono', 'direccion', 'estado'];
inactiveFields = [];
action = true;
button = 'Actualizar Usuario';
title = 'Editar'

alertify.set('notifier', 'position', 'top-right');

var DataTable = $('#dataTable').DataTable({
    language: {
        url: base_url() + 'assets/js/español.json'
    },
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
    processing: true,
    pageLength: 10,
    columnDefs: [
        {
            "className": "text-center",
            "targets": "_all"
        },
        {
            targets: [0],
            visible: false
        }
    ],
    order: [1, 'asc'],
    dom: "<'row'<'col-md-6'B><'col-md-1'l><'col-md-5'f>r>t<'row'<'col-md-6'i><'col-md-6'p><'#colvis'>r>",
    createdRow: function (row, data, dataIndex) {
        $(row).on("click", ".stateEdit", function (e) {
            e.preventDefault();

            var state = $(this).closest("tr").find("td:last .stateEdit").attr("value");

            if (state == 'activo') {
                state = 'inactivo';
            } else {
                state = 'activo';
            }

            saveState(state, data[0]);
        });

        $(row).on("click", ".editData", function (e) {
            e.preventDefault();
            editData(data[0]);
        });

        $(row).on("click", ".ResetPassword", function (e) {
            e.preventDefault();
            var estado = $(this).closest("tr").find("td:last .eliminarUsuario").attr("value");
            ResetPassword(data[0], data[2] + ' ' + data[3] );
        });
    }
});

dataLoad();

$("#create").click(function () {
    $("#Modal .modal-content").load(base_url() + controlador + '/Modal', function () {
        $("#Modal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });

        cargarPerfiles();
        cargarTipoDocumento();

        $("form").on('submit', function (e) {
            e.preventDefault();
            sendData();
        });
    });
});

function sendData() {
    $.ajax({
        url: base_url() + controlador + '/guardar',
        type: "POST",
        data: $("#form").serialize(),
        success: function (resultado) {
            var data = JSON.parse(resultado);

            if (data.success == true) {
                alertify.success("Guardado!");
                $('#Modal').modal('toggle');
                dataLoad();
            } else {
                alertify.error('¡Error!, No se ha podido realizar la acción, comuniquese con el adminsitrador del sistema.');
                dataLoad();
                return false;
            }
        },
        error: function (error) {
            alertify.error('Ocurrio un Error');
            return false;
        }
    });
}

function dataLoad() {
    $.ajax({
        url: base_url() + controlador + "/consultarTodos",
        type: "POST",
        success: function (resultado) {

            try {
                var data = JSON.parse(resultado);
            } catch (e) {
                alertify.error('¡Error!los data no han podido ser procesados(JSON.parse-Error)');
                console.log(e);
            }

            if (data.length > 0) {
                var filas = [];
                $.each(data, function () {
                    var stateEdit = '';

                    if (fields.includes('estado')) {
                        if (this.estado == 'activo') {
                            stateEdit = '<button class="stateEdit btn btn-danger btn-xs" value="' + this.estado + '" title="Inactivar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-times"></span></button>';
                        } else {
                            stateEdit = '<button class="stateEdit btn btn-success btn-xs" value="' + this.estado + '" title="Activar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-check"></span></button>';
                        }
                    }

                    edit = '<button class="editData btn btn-info btn-xs" title="Editar"><span class="fas fa-sm fa-edit"></span></button>';
                    reset = '<button class="ResetPassword btn btn-warning btn-xs" title="Restaurar Contraseña"><span class="fa fa-lock" ></span></button>';

                    var fila = {};
                    fila[0] = this['id' + table];

                    for (i = 0; i < fields.length; i++) {
                        fila[i + 1] = this[fields[i]];
                    }

                    if (action) {
                        fila[fields.length + 1] = '<center>' + stateEdit + ' ' + edit + ' ' + reset + '</center>';
                    }

                    filas.push(fila);
                });

                DataTable.clear().draw();
                DataTable.rows.add(filas).draw();
                DataTable.order([1, 'asc']).draw();
            }
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
}

function cargarPerfiles() {
    $.ajax({
        url: base_url() + controlador + "/consultarPerfiles",
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

function cargarTipoDocumento() {
    $.ajax({
        url: base_url() + controlador + "/consultarTipoIdentificacion",
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

function saveState(state, id) {
    $.ajax({
        url: base_url() + controlador + "/Estado",
        type: "POST",
        data: {
            'estado': state,
            'id': id
        },
        success: function (resultado) {
            var data = JSON.parse(resultado);
            if (data.success == true) {
                alertify.success("Estado actualizado correctamente.");
                dataLoad();
            } else {
                alertify.error('¡Error!, No se pudo actualizar, comuniquese con el adminsitrador del sistema.');
                return false;
            }
        },
        error: function (error) {
            alertify.error('¡Error!, No se pudo actualizar, comuniquese con el adminsitrador del sistema.');
            return false;
        }
    });
}

function editData(id) {
    $("#Modal .modal-content").load(base_url() + controlador + '/Modal', function () {
        $("#Modal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });

        cargarPerfiles();
        cargarTipoDocumento();

        $('#title').text(title);
        $("#guardar").html(button);

        consultar(id);

        $("form").on('submit', function (e) {
            e.preventDefault();
            sendData();
        });
    });
}

function consultar(id) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/consultar",
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

                for (i = 0; i < inactiveFields.length; i++) {
                    $("[name='" + inactiveFields[i] + "']").attr('readonly', true);
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

function ResetPassword(id, nombres) {
    alertify.confirm('', 'Desea resetar la clave del usuario: ' + nombres,
        function () {
            $.ajax({
                url: base_url() + controlador + "/ResetPassword",
                type: "POST",
                data: {
                    'id': id
                },
                success: function (resultado) {
                    var data = JSON.parse(resultado);
                    if (data.success == true) {
                        alertify.success("Clave reseteada.");
                    } else {
                        alertify.error('¡Error!, la clave no ha podido ser reseteada, comuniquese con el adminsitrador del sistema.');
                        return false;
                    }
                },
                error: function (error) {
                    alertify.error('No se pudo resetar la clave');
                    return false;
                }
            });
        },
        function () {
            alertify.error('Cambio de clave cancelado');
        }
    );
}



