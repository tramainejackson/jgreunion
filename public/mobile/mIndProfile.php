<?php require_once("../../include/sessions.php"); ?>
<?php require_once("../../include/court.php"); ?>
<?php require_once("../../include/m.functions.php"); ?>
<?php noLogin_verification(); ?>
<!DOCTYPE html>
<html lang="en-US">
<?php require_once("../../include/m.head.php"); ?>
<body>
	<?php $id = find_id_from_string($_GET["name"]); ?>
	<?php $user = find_user_by_username($_SESSION["loggedIn"]); ?>
	<?php $myUser = find_user_by_id($id); ?>
	<?php $userPost = find_post_by_id($id); ?>
	<div data-role="page" id="ind_page" style="background-image: url('../../uploads/<?php echo $myUser["upload_photo"]; ?>');">
		<?php $rows = mysqli_num_rows($userPost); ?>
		<?php $userPhone1 = substr($myUser["phone"], 0, 3); ?>
		<?php $userPhone2 = substr($myUser["phone"], 3, 3); ?>
		<?php $userPhone3 = substr($myUser["phone"], 6, 4); ?>
		<div id="bgrdOverlay"></div>
		<div data-role="header">
			<?php include("../../include/m.profileHeader.php"); ?>
		</div>
		<div data-role="main" class="ui-content">
			<a href="#contact" class="mobileLink contactBtn ui-btn">Contact</a>
			<a href="#social" class="mobileLink socialBtn ui-btn">Social</a>
			<a href="#" class="mobileLink mobilePostBtn activeMobileSite ui-btn">Post</a>
			<div id="profile_information">
				<div id="profile_header" class="profile_info_div">
					<h2 id="profile_header_name"><?php echo $myUser["first_name"] . " " . $myUser["last_name"] . " Bio"; ?></h2>
				</div>
				<div id="family_information" class="profile_info_div">
						<?php if($myUser["descent"] == "Green" || $myUser["descent"] == "Jackson") { ?>
							<div class="sectionDiv">
								<span class="inputTitle">Descent</span>
								<p class="profileInfo"><?php echo $myUser["descent"]; ?></p>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Parents</span>
									<?php if($myUser["mother"] != "" && $myUser["father"] != "") { ?>
										<p class="profileInfo"><?php echo $myUser["mother"]; ?> &amp; <?php echo $myUser["father"]; ?></p>
									<?php } elseif($myUser["mother"] == "" && $myUser["father"] != "") { ?>
										<p class="profileInfo"><?php echo "Father: " . $myUser["father"]; ?></p>
									<?php } elseif($myUser["mother"] != "" && $myUser["father"] == "") { ?>
										<p class="profileInfo"><?php echo "Mother: " . $myUser["mother"]; ?></p>
									<?php } else { ?>
										<p class="profileInfo">Parents no listed</p>
									<?php } ?>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Spouse</span>
								<?php if($myUser["spouse"] != "") { ?>
									<p class="profileInfo"><?php echo $myUser["spouse"]; ?></p>
								<?php } else { ?>
									<p class="profileInfo">Not Listed</p>
								<?php } ?>
							</div>
							<div class="sectionDiv">		
								<span class="inputTitle">Siblings</span>
								<p class="profileInfo"><?php echo $myUser["siblings"]; ?></p>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Children</span>
								<p class="profileInfo"><?php echo $myUser["children"]; ?></p>
							</div>
						<?php }  elseif($myUser["descent"] == "Spouse") { ?>
							<div class="sectionDiv">
								<span class="inputTitle">Descent</span>
								<p class="profileInfo"><?php echo $myUser["descent"]; ?></p>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Spouse</span>
								<?php if($myUser["spouse"] != "") { ?>
									<p class="profileInfo"><?php echo $myUser["spouse"]; ?></p>
								<?php } else { ?>
									<p class="profileInfo">Not Listed</p>
								<?php } ?>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Children</span>
								<p class="profileInfo"><?php echo $myUser["children"]; ?></p>
							</div>
						<?php } else { ?>
							<div class="descentDiv">
								<span class="inputTitle">Descent</span>
								<p class="profileInfo"><?php echo $myUser["descent"]; ?></p>
							</div>
						<?php } ?>
					<div class="sectionDiv">
						<span class="inputTitle">DOB</span>
							<p class="profileInfo"><?php echo $myUser["date_of_birth"]; ?></p>
					</div>
				</div>
			<?php if($myUser["show_contact"] == "Y") { ?>	
				<div id="contact_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="contact_header">Contact Information</h3>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Email</span>
						<p class="profileInfo"><?php echo $myUser["email"]; ?></p>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Phone</span>
						<p class="profileInfo"><?php echo $userPhone1; ?>-<?php echo $userPhone2; ?>-<?php echo $userPhone3; ?></p>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Address</span>
						<?php if($myUser["city"] == "" && $myUser["state"] != "" && $myUser["address"] != "") { ?>
							<p class="profileInfo"><?php echo $myUser["address"]; ?>&comma;&nbsp;<?php echo $myUser["state"]; ?>&nbsp;<?php echo $myUser["zip"]; ?></p>
						<?php } elseif($myUser["city"] == "" && $myUser["state"] == "" && $myUser["address"] == "" && $myUser["zip"] == "") { ?>
							<p class="profileInfo">No address listed</p>
						<?php } else { ?>
							<p class="profileInfo"><?php echo $myUser["address"]; ?>&nbsp;&nbsp;<?php echo $myUser["city"]; ?>&comma;&nbsp;<?php echo $myUser["state"]; ?>&nbsp;<?php echo $myUser["zip"]; ?></p>
						<?php } ?>	
					</div>	
				</div>
			<?php } else { ?>
				<div id="contact_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="contact_header">Contact Information</h3>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Email</span>
						<p class="hiddenProfileInput profileInfo">***********</p>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Phone</span>
						<p class="hiddenProfileInput profileInfo">***********</p>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Address</span>
						<p class="hiddenProfileInput profileInfo">***********</p>
					</div>	
				</div>
			<?php } ?>
			<?php if($myUser["show_social"] == "Y") { ?>
				<div id="social_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="social_header">Social Information</h3>
					</div>	
					<div class="sectionDiv">
						<span class="inputTitle">Instagram</span>
						<p class="profileInfo"><?php echo $myUser["instagram"]; ?></p>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Twitter</span>
						<p class="profileInfo"><?php echo $myUser["twitter"]; ?></p>
					</div>
					<div class="sectionDiv">					
						<span class="inputTitle">Facebook</span>
						<p class="profileInfo"><?php echo $myUser["facebook"]; ?></p>
					</div>	
				</div>
			<?php } else { ?>
				<div id="social_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="social_header">Social Information</h3>
					</div>	
					<div class="sectionDiv">
						<span class="inputTitle">Instagram</span>
						<p class="hiddenProfileInput profileInfo">***********</p>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Twitter</span>
						<p class="hiddenProfileInput profileInfo">***********</p>
					</div>
					<div class="sectionDiv">					
						<span class="inputTitle">Facebook</span>
						<p class="hiddenProfileInput profileInfo">***********</p>
					</div>	
				</div>
			<?php } ?>
			</div>
		</div>
	</div>	
</body>
</html>