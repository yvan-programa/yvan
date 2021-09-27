<?php
	if(isset($_SESSION["user__email"]))  {
		header("Location:home_u.php");
	}
	if(isset($_SESSION["company__email"]))  {
		header("Location:home_c.php");
	}
?>