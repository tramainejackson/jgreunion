<h1 class="pageHeader"><a href="logout_verification.php" data-ajax="false">J/G Reunion</a></h1>
<div id="profile_photo">
	<?php if($user["upload_photo"] == "") { ?>
		<a href="mprofile.php" data-ajax="false"><img id="profile_photo" src="../images/img_placeholder.jpg" /></a>
	<?php } else { ?>
		<a href="mprofile.php" data-ajax="false"><img id="profile_photo" src="../../uploads/<?php echo $user["upload_photo"]; ?>" /></a>
	<?php } ?>
</div>