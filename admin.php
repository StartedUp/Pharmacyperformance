<?php
if(isset($_POST['submit'])) {
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
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$firstName = mysqli_real_escape_string($conn,$firstName);
$lastName = mysqli_real_escape_string($conn,$lastName);
$email = mysqli_real_escape_string($conn,$email);
$phone = mysqli_real_escape_string($conn,$phone);

function random_password( $length = 8 ) {
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
  $password = substr( str_shuffle( $chars ), 0, $length );
  return $password;
}
$userPassword=random_password(8);
$query = "INSERT INTO user (firstName, lastName, email, phone, password)
VALUES ('$firstName', '$lastName', '$email','$phone','$userPassword')";
if ( mysqli_query($conn, $query)) {
  echo "<h2>New record created successfully :User Id = ".mysqli_insert_id($conn)." password = ".$userPassword."</h2>";
   mysqli_close($conn);
}else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
    <div id="createUserForm">
      <h2>Create New Client</h2>
      <form class="form-horizontal" role="form" method="POST" action="">
        <div class="form-group">
          <label class="control-label col-sm-2" for="firstName">Firstname:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter FirstName">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="lastName">Lastname:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter Lastname">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-5">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="phone">Phone:</label>
          <div class="col-sm-5">          
            <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <input id="submit" type="submit" name="submit" class="btn btn-primary" value="Submit">
          </div>
        </div>
      </form>
    </div>
    <div id="formSubmitresponse" class ="text-center hidden">
      <button id="back" class="btn btn-primary">back</button>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#submit").click(function(){
        $("#createUserForm").hide();
        $("#back").show();
      });
      $("#back").click(function(){
        $("#createUserForm").show();
        $("#back").hide();
      });
    });
  </script>
</body>
</html>
