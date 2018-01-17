<?php require_once("../../include/sessions.php"); ?>
<?php require_once("../../include/court.php"); ?>
<?php require_once("../../include/functions.php"); ?>
<?php $loginCheck = attempt_profile_login($_POST["username"], $_POST["password"]); ?>
<?php if($loginCheck) { echo "Match"; } else { echo "Error"; } ?>
