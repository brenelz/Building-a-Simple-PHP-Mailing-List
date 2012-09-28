<?php
	require_once("../functions/functions.php");
		// get/clean values
	$username = mysql_real_escape_string(trim($_POST['username']));
	$password = mysql_real_escape_string(trim($_POST['password']));
		// something was entered
	if(strlen($username) == 0 || strlen($password) == 0){ // if no username of password was entered
		$_SESSION['message'] = "Please enter a username and a password"; // set a message
		header("Location: ". BASE_URL ."/admin");   // direct to the admin page 
		die(); // die/stop script
	}else{
		$password = md5($password); // hash the password
	}
	
	
	$sql = "
		SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1;
		"; // search for users with that username/password
	$qr = mysql_query($sql); // run query
	if( mysql_num_rows($qr) == 1 ){  // if the user was found
		$user = mysql_fetch_assoc($qr); // get values 
		$_SESSION['loggedIn'] = 1; // set logged in session
		$_SESSION['username'] = $user['username']; //  you may want their username
		
		$_SESSION['time'] =  $_SERVER['REQUEST_TIME']; // incase you want to time out a user
		$_SESSION['message'] = "You have been logged in"; // set message
		header("Location: ". BASE_URL ."/admin");   // redirect the user
		die();
	}else{
		$_SESSION['message'] = "Didn't find a username and password with that information.";
		header("Location: ". BASE_URL ."/admin");   
		die();
	}