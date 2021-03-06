table = 'programa';
controlador = 'Cprograma';
fields = ['nombre', 'descripcion', 'estado'];
inactiveFields = [];
action = true;
title = 'Actualizar Programa';
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

            if (state == 'activo') {
                state = 'inactivo';
            } else {
                state = 'activo';
            }

            saveState(state, data[0]);
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

        loadUsers();

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
        url: base_url() + controlador + "/Mios",
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
                        if (this.estado == 'activo') {
                            stateEdit = '<button class="stateEdit btn btn-danger btn-xs" value="' + this.estado + '" title="Inactivar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-times"></span></button>';
                        } else {
                            stateEdit = '<button class="stateEdit btn btn-success btn-xs" value="' + this.estado + '" title="Activar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-check"></span></button>';
                        }
                    }

                    edit = '';

                    var fila = {};
                    fila[0] = this['id' + table];

                    for (i = 0; i < fields.length; i++) {
                        if (fields[i] == 'responsable') {
                            fila[i + 1] = consultarResponsable(this[fields[i]]);
                        } else {
                            fila[i + 1] = this[fields[i]];
                        }
                    }

                    if (action) {
                        fila[fields.length + 1] = '<center>' + stateEdit + ' ' + edit + '</center>';
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