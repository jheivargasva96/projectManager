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
    var i = 0;
    $.each(programs, function () {
        labels[i] = this.nombre;
        projects[i] = getProjects(this.idprograma);
        finished[i] = getProjects(this.idprograma, 'terminado');
        i++;
    });

    var areaChartData = {
        labels  : labels,
        datasets: [
            {
                label: 'Total Proyectos',
                backgroundColor: 'rgba(60,141,188,0.9)',
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
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: finished
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