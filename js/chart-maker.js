var ctx = document.getElementById('chart').getContext('2d');
let red = document.getElementById('total-one').dataset.total;
console.log(red);
let yellow = document.getElementById('total-two').dataset.total;
let green = document.getElementById('total-three').dataset.total;
let noResponse = document.getElementById('total-unanswered').dataset.total;

				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ['Need Help', 'Some Concern', 'Confident', 'No Response'],
				        datasets: [{
				            label: 'Students',
				            data: [red, yellow, green, noResponse],
				            backgroundColor: [
				                '#fa8181',
				                '#fefe7f',
				                '#55eb55',
				                'rgba(75, 192, 192, 0.2)',
				                
				            ],
				            borderColor: [
				                '#fa8181',
				                '#fefe7f',
				                '#55eb55',
				                'rgba(75, 192, 192, 1)',
				               
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				    	legend: {
				            display: false
				         },
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});

