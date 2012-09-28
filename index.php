<?php
	session_start();
	$message = $_SESSION['message'];
	$_SESSION['message'] = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Mailing List Web App</title>
		
		<!-- Start of CSS -->
 	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
		<!-- Start of JS -->
 	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>	
</head>

<div id="wrap">
	<h1>Join my list!</h1>
	
	<?php if(strlen($message) > 0){?><h2 class="stat"><?php echo '<br />'. $message ?></h2><?php }?>
	<br />
	<form action="./add.php" method="POST" id="subscribe">
		<label class="label" for="email">Email</label>
		<input type="text" value="you@you.com" size="20" id="email" name="email" />
		<input type="submit" id="submit" value="Sign Up!" />
	</form>
	<p class="message"></p>
	<br /><br />	
	<a class="small" href="admin">(admin)</a>
</div>
</body>
</html