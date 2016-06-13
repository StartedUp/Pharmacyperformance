<?php
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

// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 

function SignIn() { 
session_start(); //starting the session for user profile page 
if(!empty($_POST['username']))
{

// To protect MySQL injection (more detail about MySQL injection)
   $myusername = stripslashes($myusername);
   $mypassword = stripslashes($mypassword);
   $myusername = mysql_real_escape_string($myusername);
   $mypassword = mysql_real_escape_string($mypassword);
   $sql="SELECT * FROM $tbl_name WHERE id='$myusername' and password='$mypassword'";
   $result=mysql_query($sql);

// Mysql_num_row is counting table row
   $count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
   if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
/*session_register("myusername");
session_register("mypassword"); */
/*$_SESSION['name']=$name;*/
$_SESSION['id']="$myusername";
/*header("location:dashboard_page.php");*/
echo "success";
}
else {
   echo "Wrong Username or Password";
}
}}

if(isset($_POST['submit']))
{
   SignIn();
}
?>