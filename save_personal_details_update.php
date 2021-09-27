<?php
include('./init.php');
$errorNM = $errorSM = $errorGD = $errorDB = $errorNT = $errorCC = $errorPN = $errorLG = $errorCT = $errorCY = $error = '';
if (isset($_POST['save'])) {
	//deferent values from the form
	$email = $_SESSION['user__email'];
	$country_code = $_POST['country-code'];
	$phone_number = $_POST['p-number'];
	$languages = $_POST['languages'];
	$country = $_POST['country'];
	$city = $_POST['city'];

	// check country code inout
	$country_code = $getFromU->checkInput($country_code);
	$country_code = str_replace(" ", "", $country_code);

	// check phone number input
	$phone_number = $getFromU->checkInput($phone_number);
	$phone_number = str_replace(" ", "", $phone_number);

	$languages = $getFromU->checkInput($languages);

	// check city input
	$city = $getFromU->checkInput($city);
	$city = strtolower($city);
	$city = ucfirst($city);

	if (empty($country_code)){
		$errorCC = "Country Code is required";
	}else{
		if (!is_numeric($country_code)){
			$errorCC = "Invalid country code. Only numbers are allowed";
		}
	}

	if (empty($phone_number)){
		$errorPN = "Phone number is required";
	}else{
		if (!is_numeric($phone_number)){
			$errorPN = "Invalid phone number. Only numbers are allowed";
		}
	}

	if (empty($languages)){
		$errorLG = "Must enter the languages you speak";
	}else{
		if (!preg_match("/^[a-zA-Z]+|[\n]{1,}$/",$languages)){
			$errorLG = "Invalid languages. Only letters are allowed";
		}
	}

	if ($country == "Select the country") {
		$errorCT = "Must select your residential country";
	}

	if (empty($city)){
		$errorCY = "City is required";
	}else{
		if (!preg_match("/^[a-zA-Z ]*$/",$city)){
			$errorCY = "Invalid city name. Only letters are allowed";
		}
	}

	if ($errorCC == '' &&
	  	$errorPN == '' &&
	  	$errorLG == '' &&
	  	$errorCT == '' &&
	  	$errorCY == '' ) {
	  	// combine country code and phone number
		if($country_code[0] != '+') $country_code = '+'.$country_code;
		if($phone_number[0] == '0') $phone_number = substr($phone_number, 1);

	  	if ($getFromU->saveUserDetailsUpdateOnDB($connection,$email,$country_code,$phone_number,$languages,$country,$city) == 1){
	  		$msg = "Details updated succesfully.";
	  	}
	  	if ($getFromU->saveUserDetailsUpdateOnDB($connection,$email,$country_code,$phone_number,$languages,$country,$city) == 2){
	  			$error = "Error occured. Please try again later...";
	  		}
	  	}else{
			header('location:./home_u.php?curr=personal_details&errorCC='.$errorCC.'&errorPN='.$errorPN.'&errorLG='.$errorLG.'&errorCT='.$errorCT.'&errorCY='.$errorCY);
	}

	if ($error != '') {
		header('location:./home_u.php?curr=personal_details&error='.$error.'');
	}
	if (isset($msg)) {
		header('location:./home_u.php?curr=personal_details&msg='.$msg.'');
	}
}		
else{	
	header('location:./home_u.php');
}	
?>