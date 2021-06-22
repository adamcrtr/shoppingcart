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








?>







<?=template_header('admindash')?>

<div class="container-fluid">
  <div class ="col-sm-12 text-center">

        <h1>Admin Dashboard</h1>
        <?php $email = $_SESSION['email'];
        $query ="SELECT name, surname from admin WHERE email = '". $email. "'";
        $result = mysqli_query($con,$query);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "Welcome " . $row["name"]. " ". $row["surname"] . " use the sitemap in the footer to gain access to this dashboard when navigating away from the dashboard<br>";

          }
        } else {
          echo "0 results";
        }
        ?>

<p>Details button allows you to change your admin details</p>
<button><a href="index.php?page=adminupdateuser">Details</a></button>

<form method='post' action="">
    <input type="submit" value="Logout" name="but_logout" class="logoutbut">
</form>

    </div>

  </div>


</div>
<div class="col-12 text-center">
  <h3>Customer Orders</h3>
  <p>Where two order ID are the same and the date ordered are the same send this out as one order</p>
<?php


$sql = "SELECT * FROM orders INNER JOIN users ON orders.email = users.email
                             INNER JOIN order_items ON orders.order_id = order_items.order_id
                             INNER JOIN products ON order_items.product_id = products.id
                             ORDER BY date_of_order DESC";

$result = $con->query($sql);

if ($result->num_rows > 0) {

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
  //echo "Order ID: " . $row["order_id"]. " - EMAIL: " . $row["email"]. " Price " . $row["price"]. " Name: " . $row["firstname"]. " Product ID: " . $row["name"]. " Quantity: " . $row["quantity"]. " Date: " . $row["date_of_order"]. "<br><br>";
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
</div>


<?=template_footer()?>
