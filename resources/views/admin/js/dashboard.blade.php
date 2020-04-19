{{-- <script> --}}
$(document).ready(function() {
$.ajax({
  url: "{{ route('admin.getSales')}}",
  method: 'GET',
  dataType: 'json',
  success:function(data){
    showChart(data.sales,data.names,data.score);
  }
});

});

function showChart(sales,names,scores){
var ctx = document.getElementById('lineChart').getContext('2d');
var data = sales;
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: (new Date).getFullYear()+' Monthly Sales',
            backgroundColor: '',
            borderColor: '#050CFB',
            data: data
        }]
    },

    // Configuration options go here
    options: {
      responsive: true,
      legend: {
        display: false
      },
      title: {
        display: true,
        text: (new Date).getFullYear()+' Monthly Sales'
      },
        animation: {
          animateScale: true
      },
      scales: {
        yAxes: [{
          color: "rgba(0, 0, 0, 0)",
          ticks: {
            beginAtZero: true,
            callback: function (value) { if (Number.isInteger(value)) { return value; } },
        }
    }]
  }
  }
});

var ctx = document.getElementById('barChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',
    data: {
      labels: names,
      datasets: [{
        data: scores,
        backgroundColor: ["#FFDF00", "#C0C0C0", "#cd7f32"],
      }],
  },
    // Configuration options go here
    options: {
      responsive: true,
      legend: {
        display: false
      },
      title: {
        display: true,
        text: 'Top 3 Products'
      },
        animation: {
          animateScale: true
      },
      scales: {
            yAxes: [{
                gridLines: {
                    {{-- color: "rgba(0, 0, 0, 0)", --}}
                    offsetGridLines: false,
                    offset: false
                },
                ticks: {
               beginAtZero: true
           }
         }],
         xAxes: [{
             gridLines: {
                 color: "rgba(0, 0, 0, 0)",
             }
         }]
        }
  }
});
}
