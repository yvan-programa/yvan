<?php
    include "init.php";
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        if(!empty($email)){
            $email = $getFromU->checkInput($email);
            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $email = "* Invalid email address.";
            }
            else{
                if (!($getFromU->resetPassword($email,$connection))) {
                    $error = "* Email address not found... Please enter the address you used to register.";
                }
                else{
                    $msg = "Please check your email and click on the link to reset your password.";
                }
            }
        }else{
            $error = "* Email field can't be empty.";
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
    <title>Forgot Password</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <?php if (isset($msg)) {
                    echo '<div class="msgdisp">'.$msg.'</div>';
                } ?>
                <div class="card-heading">
                    <h2 class="title">Forgot your Password?</h2>
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
                            <div class="name">New password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="email" name="email" placeholder="example@email.com">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email address</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="email" name="email" placeholder="example@email.com">
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
                                <button class="col btn btn--radius-2 btn--blue-2" name="submit" type="submit">Submit</button>
                                <div style="width:80%" class="col justify-content-between">
                                    <span>&nbsp;</span>
                                    <span class=" text-right">Back To &nbsp;<a class="link"  href="login.php">Log In</a></span>
                                </div>
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

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->