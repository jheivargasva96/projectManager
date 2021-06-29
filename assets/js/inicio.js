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
    var programs = getPrograms();
    var labels = [];
    var projects = [];
    var finished = [];
    var pendiente = [];
    var process = [];
    var vencido = [];
    var terminado = [];
    var i = 0;
    $.each(programs, function () {
        labels[i] = this.nombre;
        projects[i] = getProjects(this.idprograma);
        finished[i] = getProjects(this.idprograma, 'terminado');
        pendiente[i] = getProjects(this.idprograma, 'pendiente');
        process[i] = getProjects(this.idprograma, 'en proceso');
        vencido[i] = getProjects(this.idprograma, 'vencido');
        terminado[i] = getProjects(this.idprograma, 'terminado');
        i++;
    });

    var areaChartData = {
        labels  : labels,
        datasets: [
            {
                label: 'Total Proyectos',
                backgroundColor: 'rgba(63,127,191,1)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: projects
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
                data: finished
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
                data:  process
            },
            {
                label: 'Pendiente',
                backgroundColor: 'rgba(244, 208, 63, 0.7)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data:  pendiente
            },
            {
                label: 'Vencido',
                backgroundColor: 'rgba(192, 57, 43, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data:  vencido
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
                data:  terminado
            }
        ]
    }

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