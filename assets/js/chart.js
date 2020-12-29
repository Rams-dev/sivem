google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function obtenerDatos(){
  $.get("dashboard/obtenerVentasPorMes", function(response){
    let res = JSON.parse(response);
    console.log(res);
  })

}

obtenerDatos();

function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['mes', 'Vallas fijas', 'Vallas Moviles' , 'espectaculares'],
      ['Ene',  1000,      400, 100],
      ['Feb',  1170,      460, 200],
      ['Mar',  660,       1120, 50],
      ['Jun',  1030,      540, 80],
      ['Jul',  1030,      540, 90],
      ['Ago',  1030,      540, 40],
      ['Set',  1030,      540, 100],
      ['Oct',  1030,      540, 200],
      ['Nov',  1030,      540, 300],
      ['Dic',  1030,      540, 400],
    ]);

    var options = {
      title: 'ventas',
      hAxis: {title: 'Mes',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.querySelector('.ventasPorMes'));
    chart.draw(data, options);
  } 