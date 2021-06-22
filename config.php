<?php
//session_start();
//database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "shoppingcart";
// connection created
$con = mysqli_connect($servername, $username, $password, $database);

// comment out this on final
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
}
  //echo "Connected successfully";
?>
