
<?php
    include "init.php";
    if(isset($_POST["register"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confpassword = $_POST["confpassword"];

        if(!empty($email) && !empty($password) && !empty($confpassword)){
            $email = $getFromU->checkInput($email);
            $password = $getFromU->checkInput($password);
            $confpassword = $getFromU->checkInput($confpassword);

            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $error = "* Invalid email address.";

            }else if(strlen($password) < 6){
                $error = "* Password must be at least 6 characters long.";
                
            }else if ($password != $confpassword) {
                $error = "* Those passwords didn't match. Please try again.";
            }
            else{
                if($getFromU->registerUser($email,$password,$connection) == 1){
                    $msg = "Registration successful. A verification email has been sent to you.";
                }
                else if($getFromU->registerUser($email,$password,$connection) == 0){
                    $error = "* Email already used to register. Please try with another one.";
                }
                else if($getFromU->registerUser($email,$password,$connection) == 2){
                    $error = "* Error occured while registering. Please try again.";
                }
            }

        }else{
            $error = "* Please fill in all the fields.";
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
    <title>Registration - Personal Account</title>
     
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="logo-div" ><a class="navbar-brand white" href="./">Logo</a></div>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <?php if (isset($msg)) {
                echo '<div class="msgdisp">'.$msg.'</div>';
            } ?>
            <div class="card-6">
                <div class="card-heading">
                    <h2 class="title">Create your personal account</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <!--<div class="form-row">
                            <div class="name">Full name</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="full_name">
                            </div>
                        </div>-->

                        <div class="form-row">
                            <div class="name">Email Address</div>
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
                        <div class="form-row">
                            <div class="name">Confirm Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="password" name="confpassword" placeholder="Confirm Password">
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
                            <button class=" btn btn--radius-2 btn--blue-2" name="register" type="submit">Register</button>
                            <div style="width:80%" class="col justify-content-between">
                                <span>&nbsp;</span>
                                <span class=" text-right">Already have an account?&nbsp;<a class="link"  href="login.php">Log In</a></span>
                            </div> 
                        </div>  
                            <div style="clear: both;">
                            
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
<!-- end document-->