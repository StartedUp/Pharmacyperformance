<?php
	//include("CONSTANTS.php");
	$sales_type_id_array = array("prescriptions_issued" => 1, "clinical_income" => 2, "MUR" => 3, "NMS" => 4, "retail" => 5);
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
	$sales_type = $_POST['salesType'];

	$date = mysqli_real_escape_string($conn,$date);
	$sales = mysqli_real_escape_string($conn,$sales);
	$target = mysqli_real_escape_string($conn,$target);
	$client = mysqli_real_escape_string($conn,$client);
	$sales_type = mysqli_real_escape_string($conn,$sales_type);
	$sales_type_id=$sales_type_id_array[$sales_type];
	$month=date_format(date_create($date),"m");
	$year = date_format(date_create($date),"Y");
	$getTarget = "SELECT * from target where user_id=$client and sales_type_id=$sales_type_id and MONTH(date) = $month AND YEAR(date) = $year";
	$result=mysqli_query($conn,$getTarget);
	$targetSearchValue = mysqli_fetch_object($result);
	if (is_null($targetSearchValue)) {
		$insertTarget = "INSERT INTO target (date, sales_target, user_id, sales_type_id) VALUES ('$date',$target,$client,$sales_type_id)";
		if ( mysqli_query($conn, $insertTarget)) {
			$target_id=mysqli_insert_id($conn);
		}else {
			echo "Failed to insert monthly_target : " . $insertTarget .  mysqli_error($conn);
			die();
		}
	}elseif ($targetSearchValue->sales_target!=$target) {
		$updateTarget = "UPDATE target SET sales_target=$target WHERE id=$targetSearchValue->id";
		$target_id =$targetSearchValue->id ;
		if(!mysqli_query($conn, $updateTarget)){
			echo "Failed to update monthly_target: " . $updateTarget . "<br>" . mysqli_error($conn);
			die();
		}
	}else{
		$thisMonthTarget = $targetSearchValue->sales_target;
		$target_id =$targetSearchValue->id ;
	}
	$getSales = "SELECT * FROM sales WHERE date='$date' and target_id=$target_id";
	$result=mysqli_query($conn,$getSales);
	$salesSearchValue = mysqli_fetch_object($result);
	if (is_null($salesSearchValue)) {
		$insertSales = "INSERT INTO sales (date, sales, target_id, user_id,sales_type_id) VALUES ('$date', $sales, $target_id,$client,$sales_type_id)";
		if ( mysqli_query($conn, $insertSales)) {
			echo "New record created successfully for ".$sales_type." on ".$date;
		}else {
			echo "Failed to insert sales: " . $insertSales .  mysqli_error($conn);
		}
	}else {
		$updateSales="UPDATE sales SET sales=$sales WHERE id =$salesSearchValue->id";
		if(mysqli_query($conn, $updateSales)){
			echo "Sales of ".$sales_type." on ".$date." is updated";
		}else {
			echo "Failed to update sales: " . $updateSales .  mysqli_error($conn);
		}
	}
	mysqli_close($conn);
	?>