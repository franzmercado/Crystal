$(document).ready(function() {
console.log('Dashboard');
});

var ctx = document.getElementById('myChart').getContext('2d');
var data = [1000, 3400, 1200, 5000,0,500];
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Monthly Sales',
            backgroundColor: '',
            borderColor: '#050CFB',
            data: data
        }]
    },

    // Configuration options go here
    options: {}
});
