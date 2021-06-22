<?php

include "config.php";

 // Check user login or not
if(!isset($_SESSION['email'])){
   header('Location: index.php?page=login');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php?page=login');
	echo "You have logged out";
}

//making email equals email user logged in with
$EMAIL = $_SESSION['email'];





?>






<!--template header is used to route each page through index-->
<?=template_header('userdash')?>

<div class="container-fluid">
  <div class ="col-sm-12 text-center">
<!--getting users name for welcome message-->
        <h1>Dashboard</h1>
        <?php $email = $_SESSION['email'];
        $query ="SELECT firstname, lname from users WHERE email = '". $email. "'";
        $result = mysqli_query($con,$query);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "Welcome " . $row["firstname"]. " ". $row["lname"] . "<br>";

          }
        } else {
          echo "0 results";
        }
        ?>
<!--sends the user to see all data the company has on them-->
<p>Use the button below to access your data</p>
<button><a href="index.php?page=requestdeletion">Details</a></button>



    </div>
</div>


</div>
<div class="col-12 text-center">
  <!--header for order-->
  <h3>Your Orders</h3>
  <p>Note: If two orders have the same ID this was one order but shown as each individual item</p>
<?php

// inner join sql to get all user order details
$sql = "SELECT * FROM orders INNER JOIN users ON orders.email = users.email
                             INNER JOIN order_items ON orders.order_id = order_items.order_id
                             INNER JOIN products ON order_items.product_id = products.id
                             WHERE (orders.email = '". $email. "')
                             ORDER BY date_of_order DESC";

$result = $con->query($sql);

if ($result->num_rows > 0) {
//table to show user order details
  echo "<table border = '1' class='detailstable'>
  <tr>
    <th>Order ID</th>
    <th>Product</th>
    <th>Quantity</th>
    <th>Price £</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Address Line 1</th>
    <th>Address Line 2</th>
    <th>Postcode</th>
    <th>Date Orderd</th>
  </tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
  $realprice =  $row["order_quantity"] * $row["price"];
//table data
   echo "<tr>";
   echo "<td>" . $row["order_id"]. "</td>";
   echo "<td>" . $row["name"]. "</td>";
   echo "<td>" . $row["order_quantity"]. "</td>";
   echo "<td>£" . $realprice . "</td>";
   echo "<td>" . $row["firstname"]. "</td>";
   echo "<td>" . $row["lname"]. "</td>";
   echo "<td>" . $row["email"]. "</td>";
   echo "<td>" . $row["addressline1"]. "</td>";
   echo "<td>" . $row["addressline2"]. "</td>";
   echo "<td>" . $row["postcode"]. "</td>";
   echo "<td>" . $row["date_of_order"]. "</td>";
   echo "</tr>";
  }
}echo "</table>"


?>

<form method='post' action="">
  <!--logout button-->
    <input type="submit" value="Logout" name="but_logout" class="logoutbut">
</form>
</div>




<?=template_footer()?>
