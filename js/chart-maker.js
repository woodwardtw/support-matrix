const ctx = document.getElementById('chart').getContext('2d');
const red = document.getElementById('total-one').dataset.total;
const yellow = document.getElementById('total-two').dataset.total;
const green = document.getElementById('total-three').dataset.total;
const noResponse = document.getElementById('total-unanswered').dataset.total;

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

