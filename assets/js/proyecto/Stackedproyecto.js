function getPrograms() {
  var data = {};
  $.ajax({
    type: "POST",
    async: false,
    url: base_url() + "Cproyecto/consultarProyectos",
    success: function (resultado) {
      try {
        data = JSON.parse(resultado);
      } catch (e) {
        alertify.error(
          "¡Error! Los datos no han podido ser procesados (JSON.parse-Error)"
        );
        console.log(e);
      }
    },
  });
  return data;
}

function getCumplimiento() {
  $.ajax({
    type: "POST",
    async: false,
    url: base_url() + "Creportes/getCumplimiento",

    success: function (resultado) {
      try {
        data = JSON.parse(resultado);
      } catch (e) {
        alertify.error(
          "¡Error! Los datos no han podido ser procesados (JSON.parse-Error)"
        );

        console.log(e);
      }
    },
  });
  return data;
}

$(function () {
    var programs = getPrograms();
    var labels = [];
    var projects = getCumplimiento();
    var compli = [];
    var i = 0;
    $.each(programs, function () {
      labels[i] = this.nombre;
      compli[i] = this.cumplimiento;
      i++;
    });
  
    var areaChartData = {
      labels: labels,
      datasets: [
        {
            
        },
        {
          label: "Cumplimiento en %",
          backgroundColor: "rgba(63,1191,191,1)",
          borderColor: "rgba(60,141,188,0.8)",
          pointRadius: false,
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: compli,
        }        
      ],
    };
  
    
    var barChartData = $.extend(true, {}, areaChartData);
    var temp0 = areaChartData.datasets[0];
    var temp1 = areaChartData.datasets[1];
    barChartData.datasets[0] = temp1;
    barChartData.datasets[1] = temp0;
  
    var stackedBarChartCanvas = $("#stackedBarChart").get(0).getContext("2d");
    var stackedBarChartData = $.extend(true, {}, barChartData);
  
    var stackedBarChartOptions = {
      responsive: true,
      maintainAspectRatio: true,
      scales: {
        xAxes: [
          {
            stacked: true,
          },
        ],
        yAxes: [
          {
            stacked: true,
          },
        ],
      },
    };
  
    new Chart(stackedBarChartCanvas, {
      type: "bar",
      data: stackedBarChartData,
      options: stackedBarChartOptions,
    });
  });
  