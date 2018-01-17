<?php require_once("../../include/sessions.php"); ?>
<?php require_once("../../include/court.php"); ?>
<?php require_once("../../include/m.functions.php"); ?>
<?php	
	if(updatePost($_POST, $_FILES["upload_photo"]) == "Update Successful") {
		redirect_to("mprofile.php#post");
	}
?>