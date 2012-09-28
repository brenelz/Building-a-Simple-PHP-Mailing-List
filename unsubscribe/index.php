<?php
require_once('../functions/functions.php');
$hash = mysql_real_escape_string($_GET['hash']); // get the hash, you don't really need to make sure its clean unless you want to add this to a diffrent database table etc.
$email = mysql_real_escape_string($_GET['email']); // get the email
if(strlen($hash) < 1 || strlen($email) < 1 ){ // make sure they are set
	$_SESSION['message'] = "The code is not valid - please contact support";
	header("Location:  ".BASE_URL );
	die();
}
// make sure email is avlid
if (!preg_match('/^[a-z0-9]+([_\.-][a-z0-9]+)*@([a-z0-9]+([.-][a-z0-9]+)*)+\.[a-z]{2,}$/i', $email)) {
	$_SESSION['message'] = "The code is not valid - please contact support";
	header("Location:  ".BASE_URL );
	die();
}

$sql = "
		SELECT * FROM subscribers WHERE email = '$email' AND unsubscribeLink = '$hash' LIMIT 1;
	"; // search for that user
	$qr = mysql_query($sql); // run 
	$rows = mysql_num_rows($qr); // get the number or rows with that information 
	
	if($rows == 1){ // if it was found delete it
		$sql = "DELETE FROM `subscribers` WHERE `email` = '$email' AND `unsubscribeLink` = '$hash' LIMIT 1";
		mysql_query($sql);
		$_SESSION['message'] = "You have been unsubscribed successfully";
		header("Location:  ".BASE_URL );
		die();		
	}else{ // if not tell them to contact support for manual removal
		$_SESSION['message'] = "You where not found - please contact support";
		header("Location:  ".BASE_URL );
		die();		
	}