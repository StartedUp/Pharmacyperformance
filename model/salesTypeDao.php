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
	    case "getSalesTypes":
	         $client = $_POST['client'];
	         $client = mysqli_real_escape_string($conn,$client);
	         $selectSalesTypes = "SELECT st.name from sales_type st where st.id in (select sales_type_id from user_sales_types where user_id =$client)";
	         $salesTypesSelectResult=mysqli_query($conn,$selectSalesTypes);
	         if ($salesTypesSelectResult) {
	               while ($salesTypes = mysqli_fetch_object($salesTypesSelectResult)) {
	                  $data[] = $salesTypes;
	               }    
	               echo json_encode($data);
	         }else{
	               $data='"Error" : "salesTypes list is Empty"';
	               echo json_encode($data);
	         }
	         mysqli_close($conn);
	        break;
	    case "blue":
	        echo "Your favorite color is blue!";
	        break;
	    case "green":
	        echo "Your favorite color is green!";
	        break;
	    default:
	        echo "Your favorite color is neither red, blue, nor green!";
	}
}

 ?>