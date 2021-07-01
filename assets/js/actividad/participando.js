table = 'actividad';
controlador = 'Cactividad';
fields = ['nombre', 'descripcion','responsable','fecha', 'lugar','indicador_idindicador'];

inactiveFields = [];
action = true;
title = 'Actualizar actividad';
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
    // responsive: true,
    processing: true,
    scrollX:true,
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
            sendData(state);
        });

        $(row).on("click", ".stateEliminar", function (e) {
            e.preventDefault();
            deleteData(data[0]);
        });
    }
});

dataLoad();

function dataLoad() {
    $.ajax({
        url: base_url() + controlador + "/consultarParticipante",
        type: "POST",
        success: function (resultado) {
            try {
                var data = JSON.parse(resultado);
            } catch (e) {
                alertify.error('¡Error! Los datos no han podido ser procesados(JSON.parse-Error)');
                console.log(e);
            }
            var filas = [];
            if (data.length > 0) {
                $.each(data, function () {
                    var stateEliminar = '<button class="stateEliminar btn btn-danger btn-xs" title="Retirarse" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-times"></span></button>';
                   
                    var fila = {};
                    fila[0] = this['id' + table];

                    for (i = 0; i < fields.length; i++) {
                        if (fields[i] == 'responsable') {
                            fila[i + 1] = consultarResponsable(this[fields[i]]);
                        } else if (fields[i] == 'indicador_idindicador') {
                            fila[i + 1] = consultarIndicador(this[fields[i]]);
                        }else{
                            fila[i + 1] = this[fields[i]];
                        }
                    }
                    
                    if (action) {
                        fila[fields.length + 1] = '<center>' + stateEliminar + ' ' + '</center>';
                    }
                    filas.push(fila);
                });
            }
            DataTable.clear().draw();
            DataTable.rows.add(filas).draw();
            DataTable.order([1, 'asc']).draw();
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

function consultarIndicador(id) {
    nombrep = '';
    $.ajax({
        async: false,
        type: "POST",
        url: base_url() + "Cindicador/consultar",
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

function deleteData(id) {
    nombrep = '';
    $.ajax({
        async: false,
        type: "POST",
        url: base_url() + controlador + "/delete",
        data: {
            'id': id
        },
        success: function (resultado) {
            var data = JSON.parse(resultado);

            if (data.success == true) {
                alertify.success("Participante retirado!");
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
    return nombrep;
}