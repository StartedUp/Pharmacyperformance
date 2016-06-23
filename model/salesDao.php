<?php 
include '../CONSTANTS.php';
	$host="localhost"; // Host name 
$username="pharmape_dbadmin"; // Mysql username 
$password="FDzFXlaHz5!3"; // Mysql password 
$db_name="pharmape_perfdb"; // Database name 
$tbl_name="user"; // Table name 

// Connect to server and select databse.
$conn = mysqli_connect($host, $username, $password, $db_name);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['label'])) {
	$label = $_POST['label'];
	execute($label);
}
function execute($label){
	global $conn;
	switch ($label) {
		case 'getSalesOfTheDay':
		$client = $_POST['client'];
		$date = $_POST['date'];
		$sales_type=$_POST['salesType'];
		$client = mysqli_real_escape_string($conn,$client);
		$date=mysqli_real_escape_string($conn,$date);
		$sales_type=mysqli_real_escape_string($conn,$sales_type);
		$selectSales="SELECT s.sales,st.name  FROM sales s inner join sales_type st on st.id =s.sales_type_id WHERE s.date='$date' and s.user_id=$client and st.name='$sales_type'";
		$selectSalesResult=mysqli_query($conn,$selectSales);
		if ($selectSalesResult) {
			$salesObj = mysqli_fetch_object($selectSalesResult);
			echo json_encode($salesObj);
		}else{
			$data='"Error" : "Sales is Empty"';
			echo json_encode($data);
		}
		mysqli_close($conn);
		break;

		default:
		   			# code...
		break;
	}
}
?>