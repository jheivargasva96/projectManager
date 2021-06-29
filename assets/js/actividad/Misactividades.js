table = 'actividad';
controlador = 'Cactividad';
fields = ['nombre', 'descripcion','responsable','fecha', 'lugar','indicador_idindicador', 'estado'];
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

        $(row).on("click", ".modalAnexo", function (e) {
            e.preventDefault();
           
            modalAnexo(data[0],data[9],data[10],data[11]);
            console.log(data[0],data[9]);
        });
    }
});

dataLoad();


function modalAnexo(id,idevid,observaciones,estado) {
    
    $("#ModalAnexo").modal({
        backdrop: 'static',
        keyboard: true,
        show: true
    });
    obtenerAnexoActividad(idevid);
    idactividad = id;
    idevidencia = idevid;
    $('[name="actividad_idactividad"]').val(idactividad);
    $('[name="observaciones"]').val(observaciones);
    $('[name="estado"]').val(estado);
   
    $('[name="idevidencia"]').val(idevid);
    
    $("form").on('submit', function (e) {
        e.preventDefault();
        sendData();
    });
}

function sendData(id) {

    $.ajax({
        url: base_url() + controlador + '/guardarEvidencia',
        type: "POST",
        data: $("#form").serialize(),
        success: function (resultado) {
            var data = JSON.parse(resultado);
            console.log('data',data.message);

            if (data.success == true) {
               
                if(data.message != 'Dato actualizado!'){
                    idevidencia = data.message;
                    $('[name="idevidencia"]').val(data.message);
                }
                if(id  != 1){
                    alertify.success("Guardado!");
                    $('#ModalAnexo').modal('toggle');
                    dataLoad();
                }
                

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

                    let anexo = '<button class="modalAnexo btn btn-info btn-xs" value"'+this.idevidencia+'" title="Anexo"><span class="fas fa-upload"></span></button>';

                    var stateEdit = '';

                    if (fields.includes('estado')) {
                        if (this.estado == 'activo') {
                            stateEdit = '<button class="stateEdit btn btn-danger btn-xs" value="' + this.estado + '" title="Inactivar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-times"></span></button>';
                        } else {
                            stateEdit = '<button class="stateEdit btn btn-success btn-xs" value="' + this.estado + '" title="Activar" style="margin-bottom:3px;margin: 0px 0px 0px 6px;"><span class="fas fa-sm fa-check"></span></button>';
                        }
                    }

                   
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
                        fila[fields.length + 1] = '<center>' + stateEdit + ' ' + ' ' + anexo + '</center>';
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

var dtTblAnexoActividad = $('#TblAnexoActividad').DataTable({
    language: {
        url: base_url() + 'assets/js/español.json'
    },
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	columnDefs: [
	{ width: '1%', 
      targets: [0,2,3],
      className :"text-center"
        
    },
    
    
	//{visible: false, targets: [0, 1]}
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [0,1,2]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [0,1,2]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [0,1,2]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".eliminarAnexo", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(3) .eliminarAnexo').val();
			eliminarAnexo(id)
		});
	}
});
$("[id=TblAnexoActividad] thead").addClass("thTDocs");
$("[id=TblAnexoActividad]").DataTable();
$("[id=TblAnexoActividad] tbody").addClass("tdTDocs");

$("[id=CrearAnexoActividad]").on("click", function(e){
	e.preventDefault();

    if($('#observaciones').val() == ''){
        alertify.error('Campo Observacion no puede estar vacio');
        return;
    }
    sendData(1);

	var row = {
		0: '<input type="file"  name="Lista_Anexos[]" id="anexosDoc"  class="anexarArchivos" accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >',
		1: '',
		2: '',
		3: "<center><button type='button' class='btnGuardarAN btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='fas fa-save'></span></button><button type='button' class='btn btn-danger btn-xs LimpiarAN' title='Eliminar'><span class='fas fa-sm fa-times'></span></button></center>"
	}
	dtTblAnexoActividad.row.add(row).draw();
	$(this).attr('disabled', true);
});

$("[id=TblAnexoActividad]").on("click", ".LimpiarAN", function(e){
	e.preventDefault();
	dtTblAnexoActividad.row( $(this).closest('tr') ).remove().draw();
	$("#CrearAnexoActividad").attr('disabled', false);
});

$("[id=TblAnexoActividad]").on("click", ".btnGuardarAN", function(e){
	e.preventDefault();
	var tipo = $(this).closest("[id=TblAnexoActividad]").attr("data-tipo");
	var codigo = $('#idevidencia').val();
	if (typeof FormData !== 'undefined') {
		var form_data = new FormData();
		form_data.append('Lista_Anexos', $("[id=anexosDoc]")[0].files[0]);
		form_data.append('codigo', codigo);
		$.ajax({
            url: base_url() + controlador + "/guardarAnexosVehiculo",
			type: "POST",
			data: form_data,
			async	: false,
			cache	: false,
			contentType : false,
			processData : false,
			success: function(resultado){
				var resp = resultado;
				if (resultado == 3) {
					alertify.error("Archivo no valido, revisar el peso o caracteres especiales del archivo");
					return false;
				}else{
					if (resultado != 0) {
						alertify.success("Anexo Almacenado con éxito");
						obtenerAnexoActividad(codigo);
					}else{
						alertify.error("!Error, no se pudieron guardar los anexos; comuniquese con el administrador del sistema");
					}
				}
			},
			error: function(error){
				alertify.alert('Error', error.responseText);
				console.log(error);
			}
		});
	}
});

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
                filas  =[];
                $.each(datos, function(){
					var ruta = this.ruta.split('/');
					var tipoDoc = ruta[3].split('.');
					var nombre = tipoDoc[0];
					var enlace = "";
					var rutaDoc = base_url()+ruta[1]+'/'+ruta[2]+'/'+ruta[3];
					var eliminar = "";
					if (tipoDoc[1] == "doc") {
						enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-word-o"></i></a>';
					}else if(tipoDoc[1] == "xls" || tipoDoc[1] == "xlsx"){
						enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-success btn-xs"><i class="fas fa-file-excel"></i></a>';
					}else if(tipoDoc[1] == "pdf"){
						enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-danger btn-xs"><i class="fas fa-file-pdf"></i></a>';
					}else if(tipoDoc[1] == "txt"){
						enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-warning btn-xs"><i class="fas fa-file-alt"></i></a>';
					}else{
						enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>';
					}
                    eliminar = '<button class="btn eliminarAnexo btn-xs btn-danger" value="'+this.idanexo+'"><span class="fas fa-sm fa-times"></span></button>';
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
    nombre = '';
    $.ajax({
        async: false,
        type: "POST",
        url: base_url()  + controlador + "/eliminarAnexo",
        data: {
            'id': id
        },
        success: function (resultado) {
            if (resultado != 0) {
                alertify.success("Anexo Eliminado con éxito");
                obtenerAnexoActividad(idevidencia);
            }else{
                alertify.error("!Error, no se pudieron Eliminar los anexos; comuniquese con el administrador del sistema");
            }
        },
        error: function (error) {
            alertify.alert('Error', error.responseText);
        }
    });
    return nombre;
}