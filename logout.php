<?php
   session_start();

   if(session_destroy()) {
     $EMAIL = null;
      header("Location: index.php?page=login'");
   }
   $alert = "You have logged out";
   echo "<script type='text/javascript'>alert('$alert');</script>";

?>
