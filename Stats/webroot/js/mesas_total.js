( function($) {
        
   google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();


      data.addColumn('string', 'Fecha');
      data.addColumn('number', 'Ingresos');
      data.addColumn('number', 'Egresos');
      data.addColumn('number', 'Zetas');


      var series = {
            0: { color: '#e2431e' },
            1: { color: '#e7711b' },
            2: { color: '#f1ca3a' },
            3: { color: '#6f9654' },
            4: { color: '#1c91c0' },
            5: { color: '#43459d' },
          }

      data.addRows(mesas);
    //  data.addColumn('number', 'Cubiertos');
/*
      var options = {
        title: 'Cuadro Resumen',
        curveType: 'none', // 'function' para que sean curvas
        legend: { position: 'bottom' },
        trendlines: {
          0: {type: 'exponential', color: '#333', opacity: 1},
          1: {type: 'linear', color: '#111', opacity: .3}
        }
      };
*/
      var options = {
        hAxis: {
         // title: 'Fecha'
        },
        vAxis: {
          format: 'currency'
        },
        colors: ['#007329', '#AB0D06', '#f1ca3a', 'yellow', 'blue'],
        trendlines: {
          0: {type: 'exponential', color: '#333', opacity: 1},
          1: {type: 'linear', color: '#111', opacity: .3}
        }
      };

     
      var chart = new google.visualization.LineChart(document.getElementById('line-chart'));

      chart.draw(data, options);
    }
    
})(jQuery); 