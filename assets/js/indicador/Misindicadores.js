table = 'indicador';
controlador = 'Cindicador';
fields = ['nombre', 'descripcion','responsable', 'proyecto_idproyecto', 'estado'];
inactiveFields = [];
action = true;
title = 'Actualizar indicador';
button = 'Editar'

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
    autoWidth: false,
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

            if (state == 'inactivo') {
                state = 'activo';
            } else {
                state = 'inactivo';
            }

            saveState(state, data[0]);
        });

        $(row).on("click", ".editData", function (e) {
            e.preventDefault();
            editData(data[0]);
        });
    }
});

dataLoad();


function dataLoad() {
    $.ajax({
        url: base_url() + controlador + "/consultarMisIndicadores",
        type: "POST",
        success: function (resultado) {

            try {
                var data = JSON.parse(resultado);
            } catch (e) {
                alertify.error('¡Error! Los datos no han podido ser procesados(JSON.parse-Error)');
                console.log(e);
            }

            if (data.length > 0) {
                var filas = [];
                $.each(data, function () {
                    var stateEdit = '';

                    if (fields.includes('estado')) {
                        if (this.estado == 'inactivo') {
                            stateEdit = '<button class="stateEdit btn btn-success btn-xs" value="' + this.estado + '" title="Activar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-check"></span></button>';
                        } else {
                            stateEdit = '<button class="stateEdit btn btn-danger btn-xs" value="' + this.estado + '" title="Inactivar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-times"></span></button>';
                        }
                    }

                    var fila = {};
                    fila[0] = this['id' + table];

                    for (i = 0; i < fields.length; i++) {
                        if (fields[i] == 'responsable') {
                            fila[i + 1] = consultarResponsable(this[fields[i]]);
                        } else if (fields[i] == 'proyecto_idproyecto') {
                            fila[i + 1] = consultarProyecto(this[fields[i]]) ? consultarProyecto(this[fields[i]]) : '';
                        }else{
                            fila[i + 1] = this[fields[i]];
                        }
                    }
                    

                    if (action) {
                        fila[fields.length + 1] = '<center>' + stateEdit + ' ' + '</center>';
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

function loadPro() {
    $.ajax({
        url: base_url() + controlador + "/consultarPro",
        type: "POST",
        async: false,
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                if (data.length > 0) {
                    $.each(data, function () {
                        $('[name=proyecto_idproyecto]').append($('<option />', {
                            text: this.nombre,
                            value: this.idproyecto,
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

function loadUsers() {
    $.ajax({
        url: base_url() + controlador + "/consultarUsuarios",
        type: "POST",
        async: false,
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                if (data.length > 0) {
                    $.each(data, function () {
                        $('[name=responsable]').append($('<option />', {
                            text: this.nombres + ' ' + this.apellidos,
                            value: this.idusuario,
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


function consultarResponsable(id) {
    nombre = '';
    $.ajax({
        async: false,
        type: "POST",
        url: base_url() + "Cusuario/consultar",
        data: {
            'id': id
        },
        success: function (resultado) {
            data = JSON.parse(resultado);
            nombre = data.nombres + ' ' + data.apellidos;
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
    return nombre;
}

function consultarProyecto(id) {
    nombrep = '';
    $.ajax({
        async: false,
        type: "POST",
        url: base_url() + "Cproyecto/consultar",
        data: {
            'id': id
        },
        success: function (resultado) {
            data = JSON.parse(resultado);
            nombrep = data.nombre;
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
    return nombrep;
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
                    if (key == 'responsable') {
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

function consultaPro(id) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/consultarpro",
        data: {
            'id': id
        },
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                for (var key in data) {
                    valor = data[key];
                    if (key == 'proyecto') {
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