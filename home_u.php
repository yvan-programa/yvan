<?php
include "init.php";
include "security_user.php";
//email from session
$email = $_SESSION['user__email'];
$dir = "Home>Log in>$email";

//user details from db
$getFromU->loadUserDetailsFromDB($connection,$email);
$name =  $getFromU->name;
$surname =  $getFromU->surname;
$gender =  $getFromU->gender;
$dob =  $getFromU->dob;
$nationality =  $getFromU->nationality;
$country_code =  $getFromU->country_code;
$phone_number =  $getFromU->phone_number;
$languages =  $getFromU->languages;
$country =  $getFromU->country;
$city =  $getFromU->city;
$personal_details_completed =  $getFromU->personal_details_completed;
$educational_details_completed =  $getFromU->educational_details_completed;

if ($personal_details_completed == 'false') {
	$curr = 'personal_details';
}
else{
	//the GET variable to know the page to load
	if(isset($_GET['curr'])){
		//if the GET variable contains valide data -> load respective pages
		if ($_GET['curr']=='timeline' ||
			$_GET['curr']=='dashboard' ||
			$_GET['curr']=='settings' ||
			$_GET['curr']=='personal_details' ||
			$_GET['curr']=='educational_details') {
			$curr = $_GET['curr'];
		}else{
			//if the GET variable contains undefined data -> head to the timeline
			header('location:./home_u.php');
		}
	}else{
		$curr = 'timeline';
	}
}

//logout button
if (isset($_POST['logout'])) {
	$getFromU->logout();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Seek and Hire - <?php echo $email ?> Dashboard</title>
	<!-- link tags -->
	<?php include('includes/links.php'); ?>
</head>

<body>
	<!-- Top Bar -->
	
	<!-- End Top Bar -->

	<!-- Navigation -->
	<nav id="navbar" class="navbar fixed-top bg-light navbar-light navbar-expand-lg ">
		<div class="container ">

			<a id="" class="navbar-brand white" href="./">Logo</a>

			<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#mymenu">
				<span class="navbar-toggler-icon "></span>				
			</button>

			<div class="collapse navbar-collapse" id="mymenu">
				<ul id="nav" class="navbar-nav mx-auto">
					<li class="nav-item"><a href="./#" id="" class="nav-link white">Home</a></li>
					<li class="nav-item"><a href="#" class="nav-link white">Apply for a job</a></li>
					<li class="nav-item"><a href="#" class="nav-link white">Search</a></li>
					
				</ul>
				<ul id="nav" class="navbar-nav">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle white" id="userDropdown" role="button" data-toggle="dropdown"><?php echo $email ?></a>
						<div class="dropdown-menu col-3" aria-labelledby="userDropdown">
							<a class="dropdown-item " href="#">My jobs</a>
							<a class="dropdown-item " href="#">Manage Account</a>
							<a class="dropdown-item " href="#">Settings</a>
							<div class="dropdown-divider "></div>
							<form  method="post"><button class="dropdown-item" id="logout" name="logout">Log Out</button></form>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- directory -->
	<div class="dir">
		<!-- <?php echo $dir;?> -->
	</div>
	<div class="row mt-2">
		<!-- side bar -->
		<div class="side-bar col-4 col-lg-3">
			<center>
				<div class="prof-pic">
					<a href="img/profile/default.jpg"><img src="img/profile/default.jpg"></a>
				</div>
				<a href=""><i class="fas fa-pen"></i></a>
				<div class="names">
					<span><?php echo $name?></span>
					<span><?php echo $surname?></span>
				</div>
			</center>
			<div class="side-bar-content">
				<a <?php if($curr == 'timeline') echo "class='curr'";?> href="./home_u.php?curr=timeline"><i class="fas fa-stream"></i><span>Timeline</span></a>

				<a  <?php if($curr == 'dashboard') echo "class='curr'";?>  href="./home_u.php?curr=dashboard"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
				<a <?php if($curr == 'settings') echo "class='curr'";?>  href="./home_u.php?curr=settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>

				<a <?php if($curr == 'personal_details') echo "class='curr'";?>  href="./home_u.php?curr=personal_details"><i class="fa fa-user"></i><span>Personal Details</span><i <?php if($personal_details_completed == 'true') {echo "class ='fas fa-check-circle completed'";} else {echo "class ='fas fa-check-circle'";}?>></i></a>

				<a <?php if($curr == 'educational_details') echo "class='curr'";?>   href="./home_u.php?curr=educational_details"><i class="fas fa-graduation-cap "></i><span>Educational Details</span><i <?php if($educational_details_completed == 'true') {echo "class ='fas fa-check-circle completed'";} else {echo "class ='fas fa-check-circle'";}?>></i></a>
			</div>
		</div>
	<!--end of side bar -->
	<!-- right part Content -->
		<div class="right-part col-8 col-lg-9">
			<?php
				//load timeline
				if($curr == 'timeline') include('./includes/timeline.php');

				//load dashboard
				if($curr == 'dashboard')  include('./includes/dashboard.php');

				// load settings
				if($curr == 'settings') include('./includes/settings.php');

				// load personal_details
				if($curr == 'personal_details'){
					if($personal_details_completed == 'false')include('./includes/personal_details.php');
					if($personal_details_completed == 'true')include('./includes/personal_details_update.php');
				} 
				// load educational_details
				if($curr == 'educational_details') include('./includes/educational_details.php');
			?>
		</div>
	</div>
	<!--end of right part Content -->

	<!-- footer -->
	<?php include('includes/footer.php'); ?>
	<!-- end of footer -->
	
</body>
</html>
