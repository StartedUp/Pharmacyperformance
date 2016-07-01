<?php
	if(empty($_GET)){
  echo "Unauthorised";
   die;
}
	$userId=$_SESSION['id'];
	echo $userId;
?>
<html>
<head>
  <title>Statistics</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	google.charts.load('current', {packages: ['corechart', 'bar']});
	function drawChart(data) {
		if(validateData(data)){
			console.log(data);
			var salesTarget= Number(getTarget(data));
			var achieved = getTotalSales(data);
			var remaining = salesTarget-achieved;
			var data = google.visualization.arrayToDataTable([
				['Type', 'sale'],
				['Achieved',    achieved],
				['Remaining',    remaining]
				]);

			var options = {
				title: 'Target - Sales Percentage',
				pieHole: 0.4,
			};

			var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
			chart.draw(data, options);
		}
	}
      function drawBarChart(data) {
      	if (validateData(data)) {
        var data = google.visualization.arrayToDataTable(/*[
          ['Day', 'Sales'],
          ['1', 130],
          ['2', 225],
          ['3', 185],
          ['4', 115],
          ['5', 0],
          ['6', 159],
          ['7', 0],
          ['8', 0],
          ['9', 0],
          ['10', 0],
          ['11', 0],
          ['12', 0],
          ['13', 0],
          ['14', 0],
          ['15', 0],
          ['16', 0],
          ['17', 0],
          ['18', 0],
          ['19', 0],
          ['20', 0],
          ['21', 0],
          ['22', 0],
          ['23', 0],
          ['24', 0],
          ['25', 0],
          ['26', 0],
          ['27', 0],
          ['28', 0],
          ['29', 0],
          ['30',0 ]
        ]*/
        getDailySales(data));

        var options = {
          chart: {
            title: 'sales per day',
          },
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, options);
        };
      }
      function validateData (data) {
      	return true;
      }
      function getDailySales (data) {
      	var dailySales = [];
      	var heading=['Day', 'Sales'];
      	dailySales.push(heading);
      	for (var i = 0; i <data.length - 1; i++) {
      		var oneDaySales=[Number(data[i].Day),Number(data[i].sales)];
      		dailySales.push(oneDaySales);
      	};
      	return dailySales;
      }
      function getTarget (data) {
      	return data[data.length-1].sales_target;
      }
      function getTotalSales (data) {
      	var totalSales =0;
      	for (var i = 0; i < data.length-1; i++) {
      		totalSales+=Number(data[i].sales);
      	};
      	return totalSales;
      }
      function sendAjax () {
        var data = <?php echo json_encode($_GET) ?>;
        var formData = {
         'salesType' : data.salesType,
         'client'    : data.client,
         'password'  : data.password
       };
       $.ajax({
        type: 'POST',
        url: 'getStatistics.php',
        data: formData,
        success: function(data){
         data =JSON.parse(data);
         drawChart(data);
         drawBarChart(data);
       }
      });
       var type = data.salesType.replace("_"," ").toUpperCase();
       $('#salesType').html(type);
      }
      $(document).ready(function(){
      	window.setTimeout(sendAjax,2000);
     });
	</script>
</head>
<body>
	<div class="container-fluid">
      <div class='text-center'>
        <h1 id='salesType'></h1>
      </div>
			<div id="donutchart" style="width: 420px; height: 300px;"></div>
			<div id="chart_div" class="text-right" ></div>
		</div>
		<script type="text/javascript">
		
		</script>
	</body>
</html>