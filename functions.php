<?php

function pdo_connect_mysql() {
    // sql details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'shoppingcart';

    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}



function template_header($fishyfoods) {
//making sure the email is set in session
$EMAIL = isset($_SESSION['email']) ? $_SESSION['email'] : '';

//if its set true else false shows user email instead of log in
$loginVisible = isset($EMAIL) ? "inline" : "none";
$emailVisible = isset($_SESSION['email']) ? "inline" : "none";
//EOT below is used to display the navigation bar on each page
echo <<<EOT

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>$fishyfoods - $EMAIL </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="imgs/favicon.png"/>

	</head>
	<body>
        <header class="col-sm-12">
            <div class="col-sm-12 content-wrapper nav">
                <h1 class="navtitle">Fishy Foods</h1>

                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>

                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart"> <i class="fas fa-shopping-cart"></i> </a>
                    <a style ="display:$loginVisible" href="index.php?page=login">Log in</a>
                    <a style ="display:$emailVisible" href="index.php?page=userdash">$EMAIL</a>
                    <a href="index.php?page=register">Register</a>
                    <a href="index.php?page=logout">Log out</a>
                    <a href="https://www.smartsurvey.co.uk/s/DE33KA/" target="_blank" rel="noopener noreferrer">Questionnaire</a>

                </div>
            </div>
        </header>
        <main>
EOT;
}
// footer echo EOT is used to display footeer on each page
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer class="col-sm-12">
            <div class="content-wrapper col-sm-12">
                <p>&copy; $year Fishy Foods</p>
                <div class="container">
  <div class="row">
    <div class="col"><a href="index.php?page=adminlogin">Admin Log in</a></div>
    <div class="col"></div>
    <div class="w-100"></div>
    <div class="col"><a href="index.php?page=admindash">Admin Dash</a></div>
    <div class="col"></div>
  </div>
</div>
        </footer>
        <script src="script.js"></script>

    </body>
</html>
EOT;
}
?>
