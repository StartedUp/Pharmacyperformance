<?php
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
	$date = $_POST['date'];
	$sales = $_POST['sales'];
	$target = $_POST['target'];
	$client = $_POST['client'];

	$date = mysqli_real_escape_string($conn,$date);
	$sales = mysqli_real_escape_string($conn,$sales);
	$target = mysqli_real_escape_string($conn,$target);
	$client = mysqli_real_escape_string($conn,$client);
	/*$sql = "INSERT INTO `target`(`date`, `sales_target`, `user_id`, `type`) VALUES ('$date','$target','$user_id','prescriptions_issued')"
	if ( mysqli_query($conn, $sql)) {
	}*/
		$target = 1;
	$query = "INSERT INTO prescription_issued (date, sales, target_id, user_id)
	VALUES ('$date', '$sales', '$target','$client')";
	if ( mysqli_query($conn, $query)) {
	  echo "New record created successfully ";
	   mysqli_close($conn);
	}else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
?>