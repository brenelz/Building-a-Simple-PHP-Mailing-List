<?php
session_start();	// start session
require_once("config.php"); // require our config.php file

function reply($type, $message){ // function to reply to the javascript
		$replying = array("error"=>"{$type}", "message"=>"$message");
		echo(json_encode($replying)); // json encode the responce
}

function add_email_to_database($email){ // adding the email address to the datbase
	// 1. We need to make sure its not already in
	// 2. We need to make a unsubscribe hash
	// 3. We need to add the user

	$email = mysql_real_escape_string($email); // make sure it OK
	$sql = "SELECT * FROM `subscribers` WHERE email = '{$email}' LIMIT 1"; // select all subsribers that has the email and only return (if there is) one
	$qry = mysql_query($sql); // run the query
	if( mysql_num_rows($qry) != 0){ // if that user was found they are not new so return false
		return false;
	}else{ // user was not found
		$unsubLink = ""; // create empty varible
		$unsubLink .= rand(1111, 99999); // generate random number and add it to the empty varible
		$unsubLink .= rand(1111, 99999);
		$unsubLink .= $email; // attach the email address
		
		$unsubLink = md5($unsubLink); // md5 it
		$unsubLink .= rand(1111, 99999); // then attack a random number
		
		// insert the values
		$sql = "
				INSERT INTO `subscribers` (
					`id` ,
					`email` ,
					`unsubscribeLink`
				)
				VALUES (
					NULL , '$email', '$unsubLink'
				);
			";	
			
		mysql_query($sql); // run the query
		return true; // return true as we added the user
	}
}


function loggedIn(){ // check if we are logged in
	if($_SESSION['loggedIn'] != 1){ // if we are not
		return false;
	}else{ // if we are
		return true;
	}
}