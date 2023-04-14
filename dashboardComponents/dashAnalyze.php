<div class="home-content">
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div>
			  <canvas id="barChart"></canvas>
			</div>
		</div>
		<div class="col-md-6">
			<div>
			  <canvas id="lineChart"></canvas>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div>
			  <canvas id="lineChartProduct"></canvas>
			</div>
		</div>
		<div class="col-md-6">
			<div>
			  <canvas id="barChartProduct"></canvas>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	const ctx1 = document.getElementById('barChart');
	const ctx2 = document.getElementById('lineChart');
	const ctx3 = document.getElementById('barChartProduct');
	const ctx4 = document.getElementById('lineChartProduct');
	new Chart(ctx1, {
		type: 'bar',
		data: {
		  labels: <?php echo json_encode($labels) ?>,
		  datasets: [{
		    label: 'Le nombre de stock par catégorie',
		    data: <?php echo json_encode($data) ?>,
		    borderWidth: 1
		  }]
		},
		options: {
		  scales: {
		    y: {
		      beginAtZero: true
		    }
		  }
		}
	});

	new Chart(ctx2, {
		type: 'line',
		data: {
		  labels: <?php echo json_encode($labels) ?>,
		  datasets: [{
		    label: 'Le nombre de stock par catégorie',
		    data: <?php echo json_encode($data) ?>,
		    borderWidth: 1
		  }]
		},
		options: {
		  scales: {
		    y: {
		      beginAtZero: true
		    }
		  }
		}
	});

	new Chart(ctx3, {
		type: 'bar',
		data: {
		  labels: <?php echo json_encode($labelProducts) ?>,
		  datasets: [{
		    label: 'Les produits les plus vendus',
		    data: <?php echo json_encode($dataProduct_Qty) ?>,
		    borderWidth: 1
		  }]
		},
		options: {
		  scales: {
		    y: {
		      beginAtZero: true
		    }
		  }
		}
	});

	new Chart(ctx4, {
		type: 'line',
		data: {
		  labels: <?php echo json_encode($labelProducts) ?>,
		  datasets: [{
		    label: 'Les produits les plus chers',
		    data: <?php echo json_encode($dataProduct_Price) ?>,
		    borderWidth: 1
		  }]
		},
		options: {
		  scales: {
		    y: {
		      beginAtZero: true
		    }
		  }
		}
	});
</script>
</div>