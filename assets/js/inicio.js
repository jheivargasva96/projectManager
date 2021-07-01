function getPrograms() {
    var data = {};
    $.ajax({
        type: "POST",
        async: false,
        url: base_url() + "Cprograma/getActive",
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
            } catch (e) {
                alertify.error('¡Error! Los datos no han podido ser procesados (JSON.parse-Error)');
                console.log(e);
            }
        }
    });
    return data;
}

function getProjects(idprogram, state = '') {
    var cant = 0;
    $.ajax({
        type: "POST",
        async: false,
        url: base_url() + "Creportes/getCountProjects",
        data: {
            idprograma: idprogram,
            estado: state
        },
        success: function (resultado) {
            try {
                data = JSON.parse(resultado);
                cant = data.amount;
            } catch (e) {
                alertify.error('¡Error! Los datos no han podido ser procesados (JSON.parse-Error)');
                console.log(e);
            }
        }
    });
    return cant;
}

$(function () {
    // Obtener lista de programas de la db
    var ProgramList = getPrograms();
    // Los nombres de los programas van a ser los sectores del eje x
    var Programs = [];
    // La cantidad total de proyectos por programa será la primera barra de cada sector
    var TotalProjects = [];
    // Los proyectos terminados segunda barra
    var Finished = [];
    // Los proyectos pendientes tercera barra
    var Pending = [];
    // Proyectos en proceso cuarta barra
    var Process = [];
    // Proyectos vencidos quinta barra
    var Expire = [];
    // Proyectos con retraso sexta barra
    var Late = [];

    var i = 0;
    $.each(ProgramList, function () {
        // Nombre del programa
        Programs[i] = this.nombre;
        // Total de proyectos
        TotalProjects[i] = getProjects(this.idprograma);
        // Proyectos terminados
        Finished[i] = getProjects(this.idprograma, 'terminado');
        // Proyectos pendientes
        Pending[i] = getProjects(this.idprograma, 'pendiente');
        // Proyectos en proceso
        Process[i] = getProjects(this.idprograma, 'en proceso');
        // Proyectos vencidos
        Expire[i] = getProjects(this.idprograma, 'vencido');
        // Proyectos con retraso
        Late[i] = getProjects(this.idprograma, 'terminado con retraso');
        i++;
    });
    console.log();

    var areaChartData = {
        labels: Programs,
        datasets: [
            {
                label: 'Totales',
                backgroundColor: 'rgba(63,127,191,1)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: TotalProjects
            },
            {
                label: 'Terminados',
                backgroundColor: 'rgba(34, 153, 84, 0.7)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: Finished
            },
            {
                label: 'Pendientes',
                backgroundColor: 'rgba(244, 208, 63, 0.7)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: Pending
            },
            {
                label: 'En Proceso',
                backgroundColor: 'rgba(28, 160, 155, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: Process
            },
            {
                label: 'Vencidos',
                backgroundColor: 'rgba(192, 57, 43, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: Expire
            },
            {
                label: 'Terminado con retraso',
                backgroundColor: 'rgba(150, 37, 135, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: Late
            }
        ]
    }

    // Configuraciones libreria de graficos
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
})