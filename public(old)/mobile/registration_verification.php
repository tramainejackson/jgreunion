<?php require_once("../../include/sessions.php"); ?>
<?php require_once("../../include/court.php"); ?>
<?php require_once("../../include/m.functions.php"); ?>
<?php
	$register = checkRegistration($_POST);
	if($register != false) {
		log_action("Register Profile(Mobile)", $_SESSION["loggedIn"] . " registered");		
		redirect_to("mprofile.php");
	} else {
		log_action("Register Profile(Mobile)", "Not all fields were correct");		
		redirect_to("index.php#register_page");
	}
?>