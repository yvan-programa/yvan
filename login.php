<?php
    include "init.php";
    include "security.php";

    if(isset($_POST["loginBtn"])){

        $email = $_POST["email"];
        $password = $_POST["password"];

        if(!empty($email) && !empty($password)){
            $email = $getFromU->checkInput($email);
            $password = $getFromU->checkInput($password);

            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $error = "* Invalid email address.";
            }
            else{
                if($getFromU->login($email,$password,$connection) == 1){
                    $error = "* Incorrect email address or password.";
                }
                else if($getFromU->login($email,$password,$connection) == 0){
                    $error = "* Please verify your email address before login.";
                }          
            }
        }
        else{
            $error = "* Please enter both your username and password.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Acccount Log In</title>
    

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="logo-div" ><a class="navbar-brand white" href="./">Logo</a></div>
    <div class="page-wrapper p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card-6">
                
                <div class="card-heading">
                    <h2 class="title">Ready to Login</h2>
                </div>
                <div class="card-body">
                    <form action="login.php" method="POST">
                        <!--<div class="form-row">
                            <div class="name">Full name</div>
                            <div class="value">
                                <input class="<ins> </ins>put--style-6" type="text" name="full_name">
                            </div>
                        </div>-->
                        <div class="form-row">
                            <div class="name">Email address</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="email" name="email" placeholder="example@email.com">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <?php
                            if (isset($error)) {
                                echo '<div class="span-fp-error">'.$error.'</div>';
                            }
                        ?>
                        <!-- <div class="form-row">
                            <div class="name">Message</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="message" placeholder="Message sent to the employer"></textarea>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="form-row">
                            <div class="name">Upload CV</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="file_cv" id="file">
                                    <label class="label--file" for="file">Choose file</label>
                                    <span class="input-file__info">No file chosen</span>
                                </div>
                                <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 50 MB</div>
                            </div>
                        </div> -->
                        <div class="card-footer">
                            <div class="row">
                                <button class=" btn btn--radius-2 btn--blue-2" name="loginBtn" type="submit">Log In</button>
                                <div style="width:80%" class="col justify-content-between">
                                    <span>&nbsp;</span>
                                    <span class=" text-right">Don't have an account?&nbsp;
                                        <span class="link" data-toggle="modal" data-target="#register-button"  onclick="setVisible()">Create one</span><br>
                                        <a id="personal_account" href="registration.php">Personal</a>
                                        <a id="business_account" href="company_registration.php">Business</a>
                                    </span>
                                </div>
                            </div><br>
                            <div style="clear: both;">
                                <a class="link forgot" href="forgotpassword.php">Forgot Your Password?</a>
                                <a class="link home" href="./"><< Back to home</a>
                            </div>                    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>


</body>

</html>
