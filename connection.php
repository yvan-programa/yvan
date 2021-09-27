<?php

	//connection to server
	$connection = mysqli_connect("localhost","root","");
	if(!$connection) die("Database connection failed: ".mysqli_error($connection));
	//select db on server
	$select_db = mysqli_select_db($connection,"job_seeker_db");
	if(!$select_db) die("Database selection failed: ".mysqli_error($select_db));
	
?>