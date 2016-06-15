<?php
		if ( !empty($_POST) ) {
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
			$month=date("m");
			$year=date("Y");
			$sales_type_id = mysqli_real_escape_string($conn,$_POST['salesType']);
			$selectTarget="SELECT sales_target,id FROM target WHERE user_id=$userId and MONTH(date) = $month and YEAR(date)=$year and sales_type_id =$sales_type_id";
			$selectTargetResult=mysqli_query($conn,$selectTarget);
			if ($selectTargetResult) {
				$targetObj = mysqli_fetch_object($selectTargetResult);
				$selectSales="SELECT EXTRACT(DAY FROM date) AS Day, sales FROM sales WHERE target_id=$targetObj->id order by Day";
				$selectSalesResult=mysqli_query($conn,$selectSales);
				if ($selectSalesResult) {
					while ($salesObj = mysqli_fetch_object($selectSalesResult)) {
						$data[] = $salesObj;
					}  
					$data[] = $targetObj;    
					echo json_encode($data);
				}else{
					$data = '"Error" : "Target is not set"';
					echo json_encode($data);
				}
			}else {
				$data = '"Error : Sales is Empty"';
				echo json_encode($data);
			die();
			}
			
			mysqli_close($conn);
		}
?>