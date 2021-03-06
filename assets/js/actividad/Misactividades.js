table = 'actividad';
controlador = 'Cactividad';
fields = ['nombre', 'descripcion', 'responsable', 'fecha', 'lugar', 'indicador_idindicador', 'estado'];
inactiveFields = [];
action = true;
title = 'Actualizar actividad';
button = 'Editar'

Anexos = [];

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
    scrollX: true,
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

        $(row).on("click", ".modalAnexo", function (e) {
            e.preventDefault();
            modalAnexo(data[0], data[9], data[10], data[11]);
        });

        $(row).on("click", ".modalAprobar", function (e) {
            e.preventDefault();

            modalAprobacion(data[0]);
        });

        $(row).on("click", ".verEvidencias", function (e) {
            e.preventDefault();
            verEvidencias(data[0]);
        });
    }
});

function loadEvidences(idactividad) {
    $.ajax({
        url: base_url() + controlador + "/Evidencies",
        type: "POST",
        async: false,
        data: {
            idactividad: idactividad
        },
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                if (data.length > 0) {
                    var evidencia = '';
                    $.each(data, function () {
                        evidencia += '<button class="btn btn-primary evidencias" idevidencia=' + this.idevidencia + ' type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">';
                        evidencia += this.fecha;
                        evidencia += '</button>';
                        evidencia += '&nbsp;&nbsp;';
                    });
                    $('#listaEvidencias').append(evidencia);
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

function verEvidencias(idactividad) {
    $("#Modal .modal-content").load(base_url() + controlador + '/ModalListaEvidencias', function () {
        $("#Modal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });

        loadEvidences(idactividad);

        var TableAnexoEvidencia = $('#TableAnexoEvidencia').DataTable({
            language: {
                url: base_url() + 'assets/js/español.json'
            },
            processing: true,
            pageLength: 5,
            bLengthChange: false,
            columnDefs: [
                {
                    width: '1%',
                    targets: [0, 1, 2],
                    className: "text-center"

                },
            ],
            dom: '',
            createdRow: function (row, data, dataIndex) {
                $(row).on("click", ".eliminarAnexo", function (e) {
                    e.preventDefault();
                    var id = $(this).val();
                    eliminarAnexo(id);
                    Anexos.splice($(this).val(), 1);
                    getAnexosForList(dtTblAnexoActividad);
                });
            }
        });

        $(".evidencias").on("click", function (e) {
            e.preventDefault();
            var idevidencia = $(this).attr('idevidencia');
            loadDataEvidence(idevidencia);
            getAnexosEvidencie(TableAnexoEvidencia, idevidencia);
        });
    });
}

function loadDataEvidence(id) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/consultarDataEvidencie",
        data: {
            'id': id
        },
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                for (var key in data) {
                    valor = data[key];
                    $('[name="' + key + '"]').val(valor);
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

function getAnexosEvidencie(TableAnexoEvidencia, idevidencia) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/getAnexosEvidence",
        data: {
            idevidencia: idevidencia
        },
        success: function (resultado) {
            try {
                var datos = JSON.parse(resultado);
                filas = [];
                $.each(datos, function () {
                    var ruta = this.ruta.split('/');
                    var cant = ruta.length;
                    var tipoDoc = ruta[cant - 1].split('.');
                    var enlace = "";
                    var rutaDoc = base_url() + 'uploads/anexoActividad/' + ruta[cant - 1];
                    if (tipoDoc[1] == "doc") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-word-o"></i></a>';
                    } else if (tipoDoc[1] == "xls" || tipoDoc[1] == "xlsx") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-success btn-xs"><i class="fas fa-file-excel"></i></a>';
                    } else if (tipoDoc[1] == "pdf") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i></a>';
                    } else if (tipoDoc[1] == "txt") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-warning btn-xs"><i class="fas fa-file-alt"></i></a>';
                    } else {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>';
                    }

                    var fila = {
                        0: tipoDoc[1].toUpperCase(),
                        1: this.documento,
                        2: enlace,
                    }
                    filas.push(fila);
                });
                TableAnexoEvidencia.clear().draw();
                TableAnexoEvidencia.rows.add(filas).draw();
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

dataLoad();

// Funcion para obtener la fecha actual
function actualDate() {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

var dtTblAprobacion = $('#TblAprobacion').DataTable({
    language: {
        url: base_url() + 'assets/js/español.json'
    },
    processing: true,
    pageLength: 5,
    bLengthChange: false,
    columnDefs: [
        {
            width: '1%',
            targets: [0, 1, 2],
            className: "text-center"
        },


        //{visible: false, targets: [0, 1]}
    ],
    dom: 'Bfrtip',
    buttons: [
        { extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions: { columns: [0, 1, 2] } },
        { extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: { columns: [0, 1, 2] } },
        { extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: { columns: [0, 1, 2] } }
    ],
    createdRow: function (row, data, dataIndex) {
        $(row).on("click", ".eliminarParticipar", function (e) {
            e.preventDefault();
            deleteData(data[3], data[4]);
        });

        $(row).on("click", ".aprobarParticipar", function (e) {
            e.preventDefault();
            saveStateAprobar(data[3], data[4]);
        });
    }
});
$("[id=TblAprobacion] thead").addClass("thTDocs");
$("[id=TblAprobacion]").DataTable();
$("[id=TblAprobacion] tbody").addClass("tdTDocs");


function modalAprobacion(id) {
    $("#ModalAprobacion").modal({
        backdrop: 'static',
        keyboard: true,
        show: true
    });
    obtenerAprobaciones(id);
}

function modalAnexo(idactividad, idevid, observaciones, estado) {
    $("#Modal .modal-content").load(base_url() + controlador + '/ModalEvidencia', function () {
        $("#Modal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true
        });

        $("[name=fecha]").val(actualDate());
        $("#actividad_idactividad").val(idactividad);
        Anexos = [];

        // Inicializar la tabla
        var dtTblAnexoActividad = $('#TblAnexoActividad').DataTable({
            language: {
                url: base_url() + 'assets/js/español.json'
            },
            processing: true,
            pageLength: 5,
            bLengthChange: false,
            columnDefs: [
                {
                    width: '1%',
                    targets: [0, 2, 3],
                    className: "text-center"

                },
            ],
            dom: '',
            createdRow: function (row, data, dataIndex) {
                $(row).on("click", ".eliminarAnexo", function (e) {
                    e.preventDefault();
                    var id = $(this).val();
                    eliminarAnexo(id);
                    Anexos.splice($(this).val(), 1);
                    getAnexosForList(dtTblAnexoActividad);
                });
            }
        });

        // Funciones nuevos anexos
        $("[id=CrearAnexoActividad]").on("click", function (e) {
            e.preventDefault();
            $(this).attr('disabled', true);
            var row = {
                0: '<input type="file"  name="Lista_Anexos[]" id="anexosDoc"  class="anexarArchivos" accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">',
                1: '',
                2: '',
                3: "<center><button type='button' class='btnGuardarAN btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='fas fa-save'></span></button><button type='button' class='btn btn-danger btn-xs LimpiarAN' title='Eliminar'><span class='fas fa-sm fa-times'></span></button></center>"
            }
            dtTblAnexoActividad.row.add(row).draw();
        });

        $("[id=TblAnexoActividad]").on("click", ".LimpiarAN", function (e) {
            e.preventDefault();
            dtTblAnexoActividad.row($(this).closest('tr')).remove().draw();
            $("#CrearAnexoActividad").attr('disabled', false);
        });

        $("[id=TblAnexoActividad]").on("click", ".btnGuardarAN", function (e) {
            e.preventDefault();
            if (typeof FormData !== 'undefined') {
                var form_data = new FormData();
                form_data.append('Lista_Anexos', $("[id=anexosDoc]")[0].files[0]);
                $.ajax({
                    url: base_url() + controlador + "/guardarAnexos",
                    type: "POST",
                    data: form_data,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (resultado) {
                        var data = JSON.parse(resultado);
                        if (data.success) {
                            alertify.success('Anexo guardado');
                            Anexos.push(data.message);
                            getAnexosForList(dtTblAnexoActividad);
                        } else {
                            alertify.error(data.message);
                        }
                    },
                    error: function (error) {
                        alertify.alert('Error', error.responseText);
                        console.log(error);
                    }
                });
            }
        });

        $("form").on('submit', function (e) {
            e.preventDefault();
            sendData();
        });
    });
}

function sendData() {
    $.ajax({
        url: base_url() + controlador + '/guardarEvidencia',
        type: "POST",
        data: $("#form").serialize() + '&anexos=' + Anexos,
        success: function (resultado) {
            var data = JSON.parse(resultado);
            if (data.success == true) {
                alertify.success("Guardado!");
                $('#Modal').modal('toggle');
                dataLoad();
            } else {
                alertify.error('¡Error!, No se ha podido realizar la acción, comuniquese con el adminsitrador del sistema.');
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
        url: base_url() + controlador + "/consultarMisActividades",
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

                    let aprobacion = '<button class="modalAprobar btn btn-warning btn-xs"  title="Abrobar Participantes"><span class="fab fa-adn"></span></button>';
                    let anexo = '<button class="modalAnexo btn btn-info btn-xs" value"' + this.idactividad + '" title="Anexo"><span class="fas fa-upload"></span></button>';
                    let evidencias = '<button class="verEvidencias btn btn-info btn-xs" value"' + this.idactividad + '" title="Evidencias"><span class="fas fa-eye"></span></button>';

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
                        } else if (fields[i] == 'indicador_idindicador') {
                            fila[i + 1] = consultarIndicador(this[fields[i]]);
                        } else {
                            fila[i + 1] = this[fields[i]];
                        }
                    }


                    if (action) {
                        fila[fields.length + 1] = '<center>' + stateEdit + ' ' + ' ' + anexo + ' ' + evidencias + ' ' + aprobacion + '</center>';
                    }
                    fila[9] = this.idevidencia;
                    fila[10] = this.observaciones;
                    fila[11] = this.estado;

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
        url: base_url() + controlador + "/consultarIndic",
        type: "POST",
        async: false,
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                if (data.length > 0) {
                    $.each(data, function () {
                        $('[name=indicador_idindicador]').append($('<option />', {
                            text: this.nombre,
                            value: this.idindicador,
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

function consultarIndic(id) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/consultarIndic",
        data: {
            'id': id
        },
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                alert('llego');
                for (var key in data) {
                    valor = data[key];
                    if (key == 'idindicador') {
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

function getAnexosForList(dtTblAnexoActividad) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/getAnexosForList",
        data: {
            'anexos': Anexos
        },
        success: function (resultado) {
            try {
                var datos = JSON.parse(resultado);
                filas = [];
                $.each(datos, function () {
                    var ruta = this.ruta.split('/');
                    var cant = ruta.length;
                    var tipoDoc = ruta[cant - 1].split('.');
                    var enlace = "";
                    var rutaDoc = base_url() + 'uploads/anexoActividad/' + ruta[cant - 1];
                    var eliminar = "";
                    if (tipoDoc[1] == "doc") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-word-o"></i></a>';
                    } else if (tipoDoc[1] == "xls" || tipoDoc[1] == "xlsx") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-success btn-xs"><i class="fas fa-file-excel"></i></a>';
                    } else if (tipoDoc[1] == "pdf") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i></a>';
                    } else if (tipoDoc[1] == "txt") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-warning btn-xs"><i class="fas fa-file-alt"></i></a>';
                    } else {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>';
                    }
                    eliminar = '<button class="btn eliminarAnexo btn-xs btn-danger" value="' + this.idanexo + '"><span class="fas fa-sm fa-times"></span></button>';
                    var fila = {
                        0: tipoDoc[1].toUpperCase(),
                        1: this.documento,
                        2: enlace,
                        3: eliminar
                    }
                    filas.push(fila);
                });
                console.log(filas);
                dtTblAnexoActividad.clear().draw();
                dtTblAnexoActividad.rows.add(filas).draw();
                $("#CrearAnexoActividad").attr('disabled', false);
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

function obtenerAnexoActividad(id) {
    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/obtenerAnexoActividad",
        data: {
            'id': id
        },
        success: function (resultado) {
            try {
                var datos = JSON.parse(resultado);
                filas = [];
                $.each(datos, function () {
                    var ruta = this.ruta.split('/');
                    var tipoDoc = ruta[3].split('.');
                    var nombre = tipoDoc[0];
                    var enlace = "";
                    var rutaDoc = base_url() + ruta[1] + '/' + ruta[2] + '/' + ruta[3];
                    var eliminar = "";
                    if (tipoDoc[1] == "doc") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-word-o"></i></a>';
                    } else if (tipoDoc[1] == "xls" || tipoDoc[1] == "xlsx") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-success btn-xs"><i class="fas fa-file-excel"></i></a>';
                    } else if (tipoDoc[1] == "pdf") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i></a>';
                    } else if (tipoDoc[1] == "txt") {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-warning btn-xs"><i class="fas fa-file-alt"></i></a>';
                    } else {
                        enlace = '<a href="' + rutaDoc + '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>';
                    }
                    eliminar = '<button class="btn eliminarAnexo btn-xs btn-danger" value="' + this.idanexo + '"><span class="fas fa-sm fa-times"></span></button>';
                    var fila = {
                        0: tipoDoc[1].toUpperCase(),
                        1: this.documento,
                        2: enlace,
                        3: eliminar
                    }
                    filas.push(fila);
                });
                dtTblAnexoActividad.clear().draw();
                dtTblAnexoActividad.rows.add(filas).draw();
                $("#CrearAnexoActividad").attr('disabled', false);
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

function eliminarAnexo(id) {
    $.ajax({
        async: false,
        type: "POST",
        url: base_url() + controlador + "/eliminarAnexo",
        data: {
            'id': id
        },
        success: function (resultado) {
            if (resultado != 0) {
                alertify.success("Anexo Eliminado con éxito");
            } else {
                alertify.error("!Error, no se pudieron Eliminar los anexos; comuniquese con el administrador del sistema");
            }
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
}

function obtenerAprobaciones(id) {

    $.ajax({
        type: "POST",
        url: base_url() + controlador + "/obtenerInscritos",
        data: {
            'id': id
        },
        success: function (resultado) {
            try {
                var datos = JSON.parse(resultado);
                filas = [];
                $.each(datos, function () {
                    let aprobar = '';
                    eliminar = '<button class="btn eliminarParticipar btn-xs btn-danger"><span class="fas fa-sm fa-times"></span></button>';
                    if (this.estado != 'activo') {
                        aprobar = '<button class="btn aprobarParticipar btn-xs btn-success"><span class="fas fa-sm fa-check"></span></button>';
                    }

                    var fila = {
                        0: this.nombres + ' ' + this.apellidos,
                        1: this.estado,
                        2: eliminar + ' ' + aprobar,
                        3: this.idparticipante,
                        4: this.actividad_idactividad
                    }
                    filas.push(fila);
                });
                dtTblAprobacion.clear().draw();
                dtTblAprobacion.rows.add(filas).draw();
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

function deleteData(id, actividad_idactividad) {
    nombrep = '';
    $.ajax({
        async: false,
        type: "POST",
        url: base_url() + controlador + "/deleteParticipante",
        data: {
            'id': id
        },
        success: function (resultado) {
            var data = JSON.parse(resultado);

            if (data.success == true) {
                alertify.success("Participante retirado!");
                obtenerAprobaciones(actividad_idactividad);
            } else {
                alertify.error('¡Error!, No se ha podido realizar la acción, comuniquese con el adminsitrador del sistema.');
                obtenerAprobaciones(actividad_idactividad);
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

function saveStateAprobar(id, actividad_idactividad) {
    $.ajax({
        url: base_url() + controlador + "/EstadoAprobar",
        type: "POST",
        data: {
            'estado': 'activo',
            'id': id
        },
        success: function (resultado) {
            var data = JSON.parse(resultado);
            if (data.success == true) {
                alertify.success("Estado actualizado correctamente.");
                obtenerAprobaciones(actividad_idactividad);
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