<?php
include "init.php";
if (isset($_GET['email']) && isset($_GET['hash'])) {
    $email = $_GET['email'];
    $hash = $_GET['hash'];
    
    if ($getFromU->verify($email,$hash,$connection) == 1) {
        $msg ="<p>Account verified Succesfully. Please click <a href='./login.php'>here</a> to log in.</p>";
    }

    else if ($getFromU->verify($email,$hash,$connection) == 0) {
        $msg ="<p>Your Account has already been verified. Click <a href='./login.php'>here</a> to log in.</p>";
    }

    else if ($getFromU->verify($email,$hash,$connection) == 2) {
        $error ="<p>Verification link is invalid.</p>
                <p><a href='./'>Back To Home</a></p>
            ";
    }
}
else{
    header('location:./');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->
    <title>Verify Account</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="logo-div" ><a class="navbar-brand white" href="./">Logo</a></div>
    <div class="verify-div">
        <?php if (isset($msg)) {
            echo '<div class="msgdisp">'.$msg.'</div>';
        } ?>

        <?php if (isset($error)) {
            echo '<div class="error-bg">'.$error.'</div>';
        } ?>
    </div>


    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->