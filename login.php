<?php
session_start(); 
function SignIn() { 
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
//starting the session for user profile page 
if(!empty($_POST['username']))
{
// To protect MySQL injection (more detail about MySQL injection)
   $myusername = stripslashes($myusername);
   $mypassword = stripslashes($mypassword);
   $myusername = mysqli_real_escape_string($conn,$myusername);
   $mypassword = mysqli_real_escape_string($conn,$mypassword);
   $sql="SELECT * FROM $tbl_name WHERE id='$myusername' and password='$mypassword'";
   $result=mysqli_query($conn,$sql);
// Mysql_num_row is counting table row
   $count=mysqli_num_rows($result);
mysqli_close($conn);
// If result matched $myusername and $mypassword, table row must be 1 row
   if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
/*session_register("myusername");
session_register("mypassword"); */
/*$_SESSION['name']=$name;*/
$_SESSION['id']="$myusername";
/*header("location:dashboard_page.php");*/
/*echo "success";*/
header("location:dashboard.php");
}
else {
   echo "Wrong Username or Password";
}
}
}
if(isset($_POST['submit']))
{
   SignIn();
}
?>
<!Doctype HTML>
<html>
<head>
   <title>Login Page</title>

   <style type = "text/css">
   body {
      font-family:Arial, Helvetica, sans-serif;
      font-size:14px;
   }
   label {
      font-weight:bold;
      width:100px;
      font-size:14px;
   }
   .box {
      border:#666666 solid 1px;
   }
   </style>
</head>
<body bgcolor = "#FFFFFF">
   <div align = "center">
      <div style = "width:300px; border: solid 1px #333333; " align = "left">
         <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
         <div style = "margin:30px">
            <form method="POST" action=""> 
               <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
               <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
               <input type = "submit" name="submit" value = " Submit "/><br />
            </form>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
         </div>
      </div>
   </div>
</body>
</html>