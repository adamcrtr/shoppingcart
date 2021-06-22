<?php



//database configuration
include "config.php";

// comment out this on final
if ($con->connect_error) {
 die("Connection failed: " . $con->connect_error);
}


// if submit button is pressed post these details to mysql
if(isset($_POST['but_submit'])){

    $email = mysqli_real_escape_string($con,$_POST['txt_email']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);


    if ($email != "" && $password != ""){

        $sql_query = "select email, password from users where email='$email'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_assoc($result);


	//hashed passowrd in the row
        $hashed_password = $row['password'];

        //user password and email input is equal to password in database else invalid
        if(password_verify($password,$hashed_password)){
            $_SESSION['email'] = $email;
            $_SESSION['user_level'] = $user_level;

	    header('Location: index.php?page=userdash');
        }else{
            echo "<p>Invalid username and password</p>";
        }

    }

}

?>

<?=template_header('Log in')?>




<div class="container-fluid text-center">
<div class = "col-12 login">
    <form method="post" action="">
        <div id="divlogin">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="txt_email" name="txt_email" placeholder="Email Address" />
            </div>
            <div>
                <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
        </div>
    </form>
</div>
</div>

<div class = "container-fluid">
  <div class = "col=12 registerbut text-center">

    <a href="index.php?page=register" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Register</a>
  </div>
</div>

<?=template_footer()?>
