<?php
require_once('../functions/functions.php');
session_destroy(); // destroy all information
session_start(); // start a new session just for the message
$_SESSION['message'] = "You have been logged out"; // say we have been loggged out
header("Location: " .BASE_URL."/admin");  // relocate to the admin page