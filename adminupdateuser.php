<?php

$email = $_SESSION['email'];
//includes configuration information
include "config.php";



 // is user logged in or not
if(!isset($_SESSION['email'])){
   header('Location: index.php?page=login');
}

// logout for user
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php?page=login');

}

// delete user data where email matches post data
if (isset($_POST['but_delete']))
{
    $query = "DELETE FROM users WHERE email = '" . $_POST['but_delete'] . "'";
    $result = mysqli_query($con, $query);
    session_destroy();
    header('Location: index.php?page=login');
}


//
if (isset($_POST['but_update']))
{
    //
    //$query = "UPDATE users SET name = '" . $_POST['name'] . "', lname = '" . $_POST['lname'] . "', email = '" . $_POST['email'] . "', password = '" . $_POST['password'] . "',   WHERE email = '" . $_POST['but_update'] . "'";
    //$hashed_password = password_hash($password,PASSWORD_DEFAULT);
  //  $result = mysqli_query($con, $query);


  if($_POST['password'] != null)
  {
      $insertSQL = "UPDATE admin SET name=?, surname=?, email=?, password=?";
      $stmt = $con->prepare($insertSQL);
      $hashed_password = password_hash($_POST['password'],PASSWORD_DEFAULT);
      $stmt->bind_param("ssss",$_POST['name'], $_POST['surname'],$_POST['email'],$hashed_password);
      $stmt->execute();
      $stmt->close();
  }
  else {
      $insertSQL = "UPDATE admin SET name=?, surname=?, email=?";
      $stmt = $con->prepare($insertSQL);
      //$hashed_password = password_hash($_POST['password'],PASSWORD_DEFAULT);
      $stmt->bind_param("sss",$_POST['name'], $_POST['surname'],$_POST['email']);
      $stmt->execute();
      $stmt->close();
  }

  //echo $hashed_password;

  $_SESSION['email'] = $_POST['email'];
    //header('Location: login.php');
}

?>




<?=template_header('requestdeletion')?>
<div class="userdetails">
  <div class="row">
    <div class="col-sm-12 text-center">
        <h1>Your details</h1>

<!-- form to post data to server -->
<form method= "post" action = "">
<?php
//sets variable email as current session email
$email = $_SESSION['email'];
// slects name and email from database where email is current user email
$query = "SELECT name, surname, email, password FROM admin WHERE email = '". $email ."' " ;
//execeutes above query and stores data in variables
$result = mysqli_query($con, $query);
//builds table with headers
echo "<table border = '1' class='detailstable'>
<tr>
  <th>Name</th>
  <th>Surname</th>
  <th>Email</th>
  <th>Password</th>
  <th>Select</th>

</tr>";
//while loop to return array of fetched data
//note read arrays and loops :-)😎
//also maybe add lname
  while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td><input type=\"text\" class=\"form-control\" name=\"name\" id=\"name\"  maxlength=\"80\" value=\"". $row['name'] ."\">  </td>";
    echo "<td><input type=\"text\" class=\"form-control\" name=\"surname\" id=\"surname\"  maxlength=\"80\" value=\"". $row['surname'] ."\"></td>";
    echo "<td><input type=\"text\" class=\"form-control\" name=\"email\" id=\"email\"  maxlength=\"80\" value=\"". $row['email'] ."\">  </td>";
    echo "<td><input type=\"password\" class=\"form-control\" name=\"password\" id=\"password\"  maxlength=\"80\" value=\"\"> </td>";
    echo "<td> <button onclick=\"return confirm('Are you sure you want to delete all of your data?')\" name=\"but_delete\" value=\"" . $row['email'] . "\">Delete Data </button>
     <button onclick=\"return confirm('Are you sure you want to update all of your data?')\" name=\"but_update\" value=\"" . $row['email'] . "\">Update Data </button></td>";
    echo "</tr>";

  }
  echo "</table>";


  ?>

  <button type="submit" value="Login" name="but_logout" id="but_logout" class="btn-primary btnSubmit logoutbut" > Logout </button>
</form>

<?php


//$sql = "SELECT * FROM users";
//$result = $con->query($sql);

//if ($result->num_rows > 0) {
  // output data of each row
//  while($row = $result->fetch_assoc()) {
  //  echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"]. "<br>";
//  }
//} else {
//  echo "0 results";
//}
?>
</div>
</div>
</div>
<?=template_footer()?>
