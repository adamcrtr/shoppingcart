<?php
include "config.php";
?>
<?php
$error_message = "";
$success_message = "";

// Register user
if(isset($_POST['btnsignup'])){
   $firstname = trim($_POST['firstname']);
   $lname = trim($_POST['lname']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);
   $confirmpassword = trim($_POST['confirmpassword']);
   $addressline1 = trim($_POST['addressline1']);
   $addressline2 = trim($_POST['addressline2']);
   $postcode = trim($_POST['postcode']);

   $isValid = true;

   // Check fields are empty or not
   if($firstname == '' || $lname == '' || $email == '' || $password == '' || $confirmpassword == '' || $addressline1 == '' || $addressline2 == '' || $postcode == ''){
     $isValid = false;
     $error_message = "Please fill all fields.";
   }

   // Check if confirm password matching or not
   if($isValid && ($password != $confirmpassword) ){
     $isValid = false;
     $error_message = "Confirm password not matching";
   }

   // Check if Email-ID is valid or not
   if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $isValid = false;
     $error_message = "Invalid Email-ID.";
   }

   if($isValid){

     // Check if Email-ID already exists
     $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt->close();
     if($result->num_rows > 0){
       $isValid = false;
       $error_message = "Email already exists.";
     }

   }

   // Insert records
   if($isValid){
     $insertSQL = "INSERT INTO users(firstname,lname,email,password,addressline1,addressline2,postcode ) values(?,?,?,?,?,?,?)";
     $stmt = $con->prepare($insertSQL);
     $hashed_password = password_hash($password,PASSWORD_DEFAULT);
     echo $hashed_password;
     $stmt->bind_param("sssssss",$firstname,$lname,$email,$hashed_password,$addressline1,$addressline2,$postcode);
     $stmt->execute();
     $stmt->close();

     $success_message = "Account created successfully.";
     header('Location: index.php?page=login');

   }
}
?>

<?=template_header('Register')?>






    <?php
    //Display Error message
    if(!empty($error_message)){
    ?>
    <div class="alert alert-danger">
      <strong>Error!</strong> <?= $error_message ?>
    </div>



    <?php
    }
    ?>

    <?php
    // Display Success message
    if(!empty($success_message)){
    ?>
    <div class="alert alert-success">
      <strong>Success!</strong> <?= $success_message ?>
    </div>

    <?php
    }
    ?>






<!--below a form nested in divs which contains bootstrap-->
    <div class='container-fluid '>
      <div class='row'>
        <div class='col-sm-12  ' >
          <form method='post' action=''>
            <h1 class="signup">Sign Up</h1>
            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" class="form-control" name="firstname" id="firstname" required="required" maxlength="80">
            </div>
            <div class="form-group">
              <label for="lname">Last Name:</label>
              <input type="text" class="form-control" name="lname" id="lname" required="required" maxlength="80">
            </div>
            <div class="form-group">
              <label for="email">Email address:</label>
              <input type="email" class="form-control" name="email" id="email" required="required" maxlength="80">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" name="password" id="password" required="required" maxlength="80">
            </div>
            <div class="form-group">
              <label for="pwd">Confirm Password:</label>
              <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onkeyup='' required="required" maxlength="80">
            </div>
            <div class="form-group">
              <p>This section is used for shipping</p>
              <label for="addressline1">Address line 1</label>
              <input type="text" class="form-control" name="addressline1" id="addressline1" onkeyup='' required="required" maxlength="80">
            </div>
            <div class="form-group">
              <label for="addressline2">Address line 2</label>
              <input type="text" class="form-control" name="addressline2" id="addressline2" onkeyup='' required="required" maxlength="80">
            </div>
            <div class="form-group">
              <label for="Postcode">Postcode</label>
              <input type="text" class="form-control" name="postcode" id="postocde" onkeyup='' required="required" maxlength="80">
            </div>
            <button type="submit" name="btnsignup" class="btnreg btn-default">Submit</button>
          </form>
        </div>

     </div>
    </div>









<?=template_footer()?>
