<?php
require_once("functions/functions.php"); // include the functions and the config file
$email = $_POST['email']; // get the email
if (!preg_match('/^[a-z0-9]+([_\.-][a-z0-9]+)*@([a-z0-9]+([.-][a-z0-9]+)*)+\.[a-z]{2,}$/i', $email)) { // make sure it valid
		$error = "Email not valid";	 // set a message
		reply(1, $error); // set an error
		die(); // die and stop running the script
}

if($email == "you@you.com"){ // if its you@you the user just clicked submit and although its valid it won't be a users email
	$error = "Thats not your email!";
	reply(1, $error);
	die();
}

if( add_email_to_database($email) ){ // if we added the user
	reply(0, "Thanks! You are now in the know."); // set no error 
}else{
	reply(1, "That email is already in the know."); // else, the user was found alreay
};