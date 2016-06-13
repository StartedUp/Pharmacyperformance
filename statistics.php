<?php
	if(!$_SESSION['login']){
   header("location:login.php");
   die;
}
	$userId=$_SESSION['id'];
	echo $userId;
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		<?php
		$userId=100001;
		$host="localhost"; // Host name 
		$username="pharmape_dbadmin"; // Mysql username 
		$password="FDzFXlaHz5!3"; // Mysql password 
		$db_name="pharmape_perfdb"; // Database name 
		$tbl_name="user"; // Table name 

		// Connect to server and select databse.
		$conn =mysqli_connect("$host", "$username", "$password","$db_name");
		if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		}
		$sql="SELECT sales_target FROM `target` WHERE id=1";
		$result=mysqli_query($conn,$sql);
		$value = mysqli_fetch_object($result);
		echo "var salesTarget =".$value->sales_target.";";
		mysqli_close($conn);

		?>
		var achieved = 814;
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
	google.charts.setOnLoadCallback(drawBarChart);
      function drawBarChart() {
        var data = google.visualization.arrayToDataTable([
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
        ]);

        var options = {
          chart: {
            title: 'sales per day',
          },
          vAxis: {
            minValue: 0,
            ticks: [0, 50, 100, 150, 200, 250]
          }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
	</script>

</head>
  <body>
  	<div class="container-fluid">
  		<div class="dropdown">
  			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sales Type
  				<span class="caret"></span></button>
  				<ul class="dropdown-menu">
  					<li><a href="#">Prescriptions Issued</a></li>
  					<li><a href="#">Clinical income</a></li>
  					<li><a href="#">MUR</a></li>
  					<li><a href="#">NMS</a></li>
  					<li><a href="#">Retail</a></li>
  				</ul>
  			</div>
  		</div>
  		<h3>UserId 100001</h2>
  		<div id="donutchart" style="width: 630px; height: 350px;"></div>
  		<div id="chart_div" class="text-right" ></div>
  	</div>
  </body>
</html>