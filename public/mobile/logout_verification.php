<?php require_once("../../include/sessions.php"); ?>
<?php require_once("../../include/m.functions.php"); ?>
<?php
	if(!empty($_SESSION["loggedIn"])) {
		log_action("Logout(Mobile)", $_SESSION["loggedIn"] . " logged out");		
		session_unset();
		session_destroy();
		redirect_to("index.php");
	} else {
		log_action("Logout(Mobile)", "Logged in session was empty when logged out");
		redirect_to("index.php");
	}
?>