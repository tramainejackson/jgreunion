<?php require_once("../include/sessions.php"); ?>
<?php require_once("../include/court.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php noLogin_verification(); ?>

<!DOCTYPE html>
<html lang="en-US">
<?php require_once("../include/head.php"); ?>
<body>
	<div class="container" id="allMembersPage">
		<div id="overlay"></div>
		<div id="modal"></div>
		<div id="navi">
			<div class="page_header">
				<h1>Jackson &amp; Green Family Reunion</h1>
			</div>
			<div id="family_account">
				<?php
					if(!isset($_SESSION['loggedIn'])) {
						echo "<a href='register.php' class='profileLink'>Register</a>
						<a href='login.php' class='profileLink'>Login</a>";
					} else {
						echo "<a href='profile.php' class='profileLink active'>Profile</a>
						<a href='all_members.php' class='profileLink'>Family</a>";
					}
				?>
			</div>
			<div id="home_link">
				<?php
					if(!isset($_SESSION['loggedIn'])) {
						echo "<a href='index.php' class='homeLink'>Home</a>";
					} else {
						echo "<a href='index.php' class='homeLink profileLink'>Home</a>
							<a href='logout.php' class='profileLink'>Logout</a>";
					}
				?>
			</div>
		</div>	
			<div id="all_profiles_header_div">
				<h1 id="all_profiles_header">All Profiles</h1>
			</div>
			<div id="show_profiles">
				<?php $getProfiles = find_all_profile_members(); ?>
				<?php while($showProfile = mysqli_fetch_assoc($getProfiles)) { ?>
					<div class="profilePreview">
						<div class="profilePreviewHeader">
							<div class="profilePreviewPhoto">
								<img src="../uploads/<?php echo $showProfile["upload_photo"]; ?>" />
							</div>
							<div class="profilePreviewNameLink">
								<h2 class=""><a class="userProfileLink" href="indProfile.php?name=<?php echo $showProfile["first_name"] . "_" . $showProfile["last_name"] . $showProfile["user_id"] . strlen($showProfile["user_id"]); ?>"><?php echo $showProfile["first_name"] . " " .$showProfile["last_name"]; ?></a></h2>
							</div>
						</div>	
						<div class="profilePreviewInfo">
							<?php if($showProfile["descent"] != "") { ?>
								<p class="profilePreviewInfoP"><?php echo "Descent: " . $showProfile["descent"]; ?></p>
							<?php } if($showProfile["date_of_birth"] != "") { ?>
								<p class="profilePreviewInfoP"><?php echo "DOB: " . $showProfile["date_of_birth"]; ?></p>
							<?php } if($showProfile["spouse"] != "") { ?>
								<p class="profilePreviewInfoP"><?php echo "Spouse: " . $showProfile["spouse"]; ?></p>
							<?php } if($showProfile["mother"] != "") { ?>
								<p class="profilePreviewInfoP"><?php echo "Mother: " . $showProfile["mother"]; ?></p>
							<?php } if($showProfile["father"] != "") { ?>
								<p class="profilePreviewInfoP"><?php echo "Father: " . $showProfile["father"]; ?></p>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>	
	</div>		
	<script src="scripts/jgreunion.js"></script>	
</body>
</html>