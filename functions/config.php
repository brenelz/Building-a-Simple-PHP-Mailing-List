<?php
	$dbhost = 'localhost'; // database host
	$dbuser = 'USERNAME'; // database username
	$dbpass = 'PASSWORD'; // database password 
	$db		= 'DATABASE'; // the database
	$conn 	= mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect to the database"); // creat a connection or die
	mysql_select_db($db) or die("I couldn't find the database"); // select the database or die
	define("BASE_URL", "http://my-list-app.com"); // the URL to the file
	define("REPLY_EMAIL", "noreply@domain.com"); // the email address we want our mailing list to be 