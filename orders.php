<?php
include "config.php";

$sql = "INSERT INTO orders (email, name)
VALUES ('John', 'Doe')";

if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);



echo "<p>hello</p>";
?>
