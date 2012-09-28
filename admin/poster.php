<?php
require_once('../functions/functions.php');
if($_SESSION['loggedIn'] != 1){ 
		// if the user is not logged in, redirect them and add the message to
		// tell them they must be logged in
		// helps with unwanted people running your script by posting to it.
		$_SESSION['message'] = "You must be logged in.";
		header("Location: ". BASE_URL ."/admin"); 
		die();
}
$message = $_POST['messageArea'];
$subject = $_POST['subject'];
if(strlen($message) == 0 || strlen($subject) == 0){
	// if no information was added in either fields, save what was intered in a session and redirect them
	$_SESSION['subject'] = $subject;
	$_SESSION['messageArea'] =  $message;	
	$_SESSION['message'] = "Please fill in both the subject and the message.";
	header("Location: " .BASE_URL."/admin");
	die();
	
}
// grab all the subscribers
$sql = "
	SELECT * FROM subscribers;
";

$qr = mysql_query($sql);
// if we don't have any
if(mysql_num_rows($qr) == 0){
	$_SESSION['message'] =  "You currently have no subscribers";	
	header("Location: " .BASE_URL."/admin"); 
	die();
}

// go through all the subscribers
while( $user = mysql_fetch_array($qr)){
	// set a message
	$_SESSION['message'] =  "Your emails are being sent...";	
	$newMessage = ""; // set a clear varible
	// search for the [unsubscribe] tag and replace it with a URL for the user to unsubscribe
	$newMessage = str_replace(	"[unsubscribe]", 
								BASE_URL."/unsubscribe/".$user['unsubscribeLink']."&email=".$user['email'], 
								$message);

	// replace all special characters
	$newMessage = htmlspecialchars($newMessage);
	// replace new lines with break tags
	$newMessage = str_replace( "\r\n",
								"<br />",
								$newMessage
							);
	// content type
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".REPLY_EMAIL."\r\n"; // who the reply is to
	mail($user['email'], $subject, $newMessage, $headers); // send the email to the user
}
	header("Location: " .BASE_URL."/admin"); 