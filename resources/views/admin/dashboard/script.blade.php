<script>

var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');

var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'blue',
        pointRadius          : 2,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 9],
        order:2,
        
        },
        {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40],
        order:1,
        },
    ]
}

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'line', 
      data: salesChartData, 
      options: salesChartOptions
    }
  )






  var visitorsData = {
    'us': 398, //USA
    'sa': 400, //Saudi Arabia
    'ca': 1000, //Canada
    'de': 500, //Germany
    'fr': 760, //France
    'cn': 300, //China
    'au': 700, //Australia
    'br': 600, //Brazil
    'in': 800, //India
    'gb': 320, //Great Britain
    'ru': 3000 //Russia
  }
  // World map by jvectormap
  $('#world-map').vectorMap({
    map              : 'world_en',
    backgroundColor  : 'transparent',
    regionStyle      : {
      initial: {
        fill            : 'rgba(255, 255, 255, 0.7)',
        'fill-opacity'  : 1,
        stroke          : 'rgba(0,0,0,.2)',
        'stroke-width'  : 1,
        'stroke-opacity': 1
      }
    },
    series           : {
      regions: [{
        values           : visitorsData,
        scale            : ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionTipShow: function (e, el, code) {
      if (typeof visitorsData[code] != 'undefined')
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors')
    },
  })


</script>