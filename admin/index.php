<?php
	require_once('../functions/functions.php');
	$loggedIn = loggedIn(); // run login function
	if( isset($_SESSION['message']) ){ // if we have a message
		$message = $_SESSION['message']; // set a local varible 
		$_SESSION['message'] = ""; // clear the session
	}
	
	if( isset($_SESSION['subject']) ){ // if we have a recovered subject
		$subject = $_SESSION['subject'];
	}else{
		$subject = "";
	}
	if( isset($_SESSION['messageArea']) ){ // if we have a recovered message
		$messageArea = $_SESSION['messageArea'];
	}else{
		$messageArea = "";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Mailing List Web App || ADMIN</title>
		
		<!-- Start of CSS -->
 	<link rel="stylesheet" type="text/css" href="../css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
</head>

<div id="wrap">
<?php if(!$loggedIn){ //user is not logged in ?>
	<h1>Please, login</h1>
	<?php if($message) echo "<h3 class='message'>".$message."</h3>"; ?>
	<form action="login.php" method="POST" id="login">
		<label class="lable" for="username">Username</label>
		<input type="text" value="alex" size="20" id="username" name="username" />
		<br /><br />
		<label class="lable" for="password">Password</label>
		<input type="password" value="" size="20" id="password" name="password" />		
		<br /><br />
		<input type="submit" id="submit" value="Log me in!" />
	</form>
	<p class="message"></p>	
<?php }else{ // user is logged in ?>
	<h1>Send A Message</h1>
	<?php if($message) echo "<h3 class='message'>".$message."</h3>"; // display any messages ?>
	
	<form action="poster.php" method="POST" id="create">
		<label for="subject" class="label">Subject</label><br /><br />
		<input class="input" name="subject" id="subject" type="text" value="<?php echo $subject; // echo the varible ?>" />
		<br />
		<label for="messageArea" class="label">Message</label><br /><br />
		<textarea class="input" name="messageArea" id="messageArea" rows="15" cols="46" wrap="wrap"><?php echo $messageArea; ?></textarea>
		<br />
		<input type="submit" value="Send message" /><br />
		<small class="note">Note: Add [unsubscribe] in the email to add an unsubscribe link.</small>
	</form>
	<br /><br />
	<a class="log" href="<?php echo BASE_URL ?>/admin/logout.php">Logout</a>
<?php } ?>
</div>
</body>
</html>