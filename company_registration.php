<?php
    include'init.php';

    $valideform = true;

    if (isset($_POST['register'])) {

        $company_name = $_POST['company_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
        $compsize = $_POST['compsize'];

        if (!empty($company_name) && !empty($email) && !empty($password) && !empty($confpassword)){
            $company_name = $getFromU->checkInput($company_name);
            $email = $getFromU->checkInput($email);
            $password = $getFromU->checkInput($password);
            $confpassword = $getFromU->checkInput($confpassword);
            $compsize = $getFromU->checkInput($compsize);
            if(!preg_match("/^[a-zA-Z ]*$/",$company_name)){
                $errorN = "* Company name should only contain letters and white spaces.";
                $valideform = false;
            }
            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $errorE = "* Invalid email address.";
                $valideform = false;

            }
            if(strlen($password) < 6){
                $errorP = "* Password must be at least 6 characters long."; 
                $valideform = false;               
            }else{
                if ($password != $confpassword) {
                    $errorC = "* Those passwords didn't match. Please try again.";
                    $valideform = false;
                }
            }
            if($compsize == 'Please select company size'){
                $errorS = "* You didn't select the company size.";
                $valideform = false;
            }

        }else{
            $errorA = "* Please fill in all the fields.";
            $valideform = false;
        }
        if ($valideform) {
            if($getFromU->registerCompany($company_name,$email,$password,$compsize,$connection) == 1){
                $msg = "Successfully registered your company. A verification email has been sent to you.";
            }
            else if($getFromU->registerCompany($company_name,$email,$password,$compsize,$connection) == 0){
                $error = "* Email already used to register. Please try with another one.";
            }
            else if($getFromU->registerCompany($company_name,$email,$password,$compsize,$connection) == 2){
                $error = "* Error occured while registering. Please try again.";
            }
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
    <title>Registration - Business Account</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <link rel="stylesheet" href="build/css/intlTelInput.css">

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
                <div class="">
                    <h2 class="title">Create your business account</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row">
                            <div class="name">Company Name</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="company_name" placeholder="Enter company Name">
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="name">Registration number</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="registration_number" placeholder="Enter registration number">
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="name">Email Address</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="email" name="email" placeholder="Enter email address">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="password" name="password" placeholder="Enter password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Confirm Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="password" name="confpassword" placeholder="Re-enter password">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="name">Country</div>
                            <div class="phoneNumber">
                                <div class="input-group">
                                    <input class="input--style-6" id="country" name="country" type="text" placeholder="Select your Country
                                    ">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Town</div>
                            <div class="phoneNumber">
                                <div class="input-group">
                                    <input class="input--style-6" id="town" name="town" type="text" placeholder="Enter your town">
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-row">
                            <div class="name">Phone number</div>
                            <div class="phoneNumber">
                                <div class="input-group">
                                    <input class="ccode" id ="ccode" name="ccode" disabled>
                                    <input class="input--style-6" id="phone" name="phone" type="tel">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Start Date</div>
                            <div class="phoneNumber">
                                <div class="input-group">
                                    <input class="input--style-6" id="phone" name="phone" type="date" placeholder="Select start date">
                                </div>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="name">Company Size</div>
                            <div class="phoneNumber">
                                <div class="input-group">
                                    <select name="compsize" class="input--style-6">
                                        <option>Please select company size</option>
                                        <option>Microentreprise: 1 - 9 employees</option>
                                        <option>Small entreprise: 10 - 49 employees</option>
                                        <option>Medium-sized entreprise: 50 - 249 employees</option>
                                        <option>Large entreprise: over 250 employees</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="name">Company Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="description" placeholder="A brief description of the company"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Website Url</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" id="web_url" name="web_url" type="url" placeholder="Enter your website url">
                                </div>
                            </div>
                        </div> -->
                        <div id="#error">
                            <?php
                                // if (isset($errorN)) {
                                //     echo '<div class="span-fp-error">'.$errorN.'</div><br>';
                                // }
                                // if (isset($errorE)) {
                                //     echo '<div class="span-fp-error">'.$errorE.'</div><br>';
                                // }
                                // if (isset($errorP)) {
                                //     echo '<div class="span-fp-error">'.$errorP.'</div><br>';
                                // }
                                // if (isset($errorC)) {
                                //     echo '<div class="span-fp-error">'.$errorC.'</div><br>';
                                // }
                                // if (isset($errorS)) {
                                //     echo '<div class="span-fp-error">'.$errorS.'</div><br>';
                                // }
                                // if (isset($errorA)) {
                                //     echo '<div class="span-fp-error">'.$errorA.'</div><br>';
                                // }
                                if ((isset($errorN)) || (isset($errorE)) || (isset($errorP)) || (isset($errorC)) || (isset($errorS)) || (isset($errorA))){
                                    echo '<div class="span-fp-error">';
                                    if (isset($errorN)) {
                                        echo $errorN . '<br>';
                                    }
                                    if (isset($errorE)) {
                                        echo $errorE . '<br>';
                                    }
                                    if (isset($errorP)) {
                                        echo $errorP . '<br>';
                                    }
                                    if (isset($errorC)) {
                                        echo $errorC . '<br>';
                                    }
                                    if (isset($errorS)) {
                                        echo $errorS . '<br>';
                                    }
                                    if (isset($errorA)) {
                                        echo $errorA ;
                                    }
                                    echo '</div>';
                                }
                                if (isset($error)) {
                                    echo '<div class="span-fp-error">'.$error.'</div>';
                                }
                            ?>
                        </div>
                        
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
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="build/js/intlTelInput.js"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
          // allowDropdown: false,
          // autoHideDialCode: false,
          // autoPlaceholder: "off",
          // dropdownContainer: document.body,
          // excludeCountries: ["us"],
          // formatOnDisplay: false,
          // geoIpLookup: function(callback) {
          //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          //     var countryCode = (resp && resp.country) ? resp.country : "";
          //     callback(countryCode);
          //   });
          // },
          // hiddenInput: "full_number",
          // initialCountry: "auto",
          // localizedCountries: { 'de': 'Deutschland' },
          // nationalMode: false,
          // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
          // placeholderNumberType: "MOBILE",
          // preferredCountries: ['cn', 'jp'],
          // separateDialCode: true,
          utilsScript: "build/js/utils.js",
        });
    </script>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->