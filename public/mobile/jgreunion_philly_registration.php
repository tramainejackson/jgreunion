<?php
	require_once("../include/sessions.php");
	require_once("../include/court.php");
	require_once("../include/functions.php");

	$memberName = mysqli_real_escape_string($connect, trim($_POST['name']));
	$memberAddress = mysqli_real_escape_string($connect, trim($_POST['address']));
	$memberPhone = mysqli_real_escape_string($connect, trim($_POST['phone']));
	$memberEmail = mysqli_real_escape_string($connect, trim($_POST['email']));
	$attendingAdults = $_POST['attending_adult'];
	$attendingYouth = $_POST['attending_youth'];
	$attendingChildren = $_POST['attending_children'];
	$addtTeeCount = $_POST['addtTee'] == "Y" ? array(
						$_POST['addtSmall'],
						$_POST['addtMedium'],
						$_POST['addtLarge'],
						$_POST['addtXL'],
						$_POST['addtXXL'],
						$_POST['addt3XL'],
						$_POST['addt4XL'],
						$_POST['addtKSmall'],
						$_POST['addtKMedium'],
						$_POST['addtKLarge']
					) : "";
	$addFancyCount = $_POST['fancyCut'] == "Y" ? array(
						$_POST['fancySmall'],
						$_POST['fancyMedium'],
						$_POST['fancyLarge'],
						$_POST['fancyXL'],
						$_POST['fancyXXL'],
						$_POST['fancy3XL'],
						$_POST['fancy4XL'],
						$_POST['fancyKSmall'],
						$_POST['fancyKMedium'],
						$_POST['fancyKLarge']
					) : "";			
	$addtTee = $_POST['addtTee'] == "Y" ? getAddtCount($addtTeeCount) : 0;
	$addtTeeGC = $_POST['fancyCut'] == "Y" ? getAddtCount($addFancyCount) : 0;
	$addtTeeSizes = $_POST['addtTee'] == "Y" ? implode(', ', getAddtSizes($addtTeeCount)) : "";
	$addtTeeGCSizes = $_POST['fancyCut'] == "Y" ? implode(', ', getAddtSizes($addFancyCount)) : "";
	$adultMembersName = cleanValues($_POST['attending_adult_name']);
	$youthMembersName = cleanValues($_POST['attending_youth_name']);
	$childrenMembersName = cleanValues($_POST['attending_children_name']);
	$shirtSize = empty($_POST['shirt_size']) ? "No shirts sizes entered" : cleanValues($_POST['shirt_size']);
	$adultMembersName = implode(', ', $adultMembersName);
	$youthMembersName = implode(', ', $youthMembersName);
	$childrenMembersName = implode(', ', $childrenMembersName);
	$shirtSize = implode(', ', $shirtSize);
	$totalAmountDue = $_POST['total_amount_due'];
	$logMsg = "Registree=".$memberName.", Address=".$memberAddress.", Email=".$memberEmail.", Phone=".$memberPhone.", Due=".$totalAmountDue;
	log_action("New System Registration", $logMsg);
	$admin = "administrator@jgreunion.com";
	$subject = "2016 Philadelphia Reunion Registration Confirmation";
	$message = "Thanks for registering for the 2016 Philadelphia Reunion. Here is what we have listed for you. <br/>Adults: ".$adultMembersName."(".$attendingAdults.") <br/>Youth: ".$youthMembersName."(".$attendingYouth.") <br/>Children: ".$childrenMembersName."(".$attendingChildren.") <br/>Additional Shirt: (".$addtTee.") <br/>Cut Design Tee: (".$addtTeeGC.")";
	$message .="<br/><br/>If you would like to pay for the registration electronically, you can transfer money directly to administrator@jgreunion.com via PayPal account.<br/><br/>Please feel free to email us anytime at <a href='mailto:administrator@jgreunion.com?subject=2016%20Jackson/Green%20Family%20Reunion(Philadelphia)'>administrator@jgreunion.com</a>.<br/><br/>Thank you and have a nice day.";
	$message2 = "A new user has just registered for the 2016 Philadelphia Reunion. Member information: <br/><strong>Name:</strong> ".$memberName."<br/><strong>Email:</strong> ".$memberEmail."<br/><strong>Address:</strong> ".$memberAddress."<br/><strong>Phone:</strong> ".$memberPhone;
	$message2 .= "<br/>The total amount due for their registration is $".$totalAmountDue.". Including <u>".$attendingAdults."</u> adult(s), <u>".$attendingYouth."</u> youth(s), <u>".$attendingChildren."</u> child(ren), <u>".$addtTee."</u> additional tee(s), and <u>".$addtTeeGC."</u> girly cut tee(s). Shirt sizes are ".$shirtSize.".";
	$email_message = wordwrap($message, 70, "\r\n");
	$email_message2 = wordwrap($message2, 70, "\r\n");
	$email_headers = "MIME-Version: 1.0" . "\r\n";
	$email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$email_headers .= 'From: Philly Reunion Admin<administrator@jgreunion.com>' . "\r\n";
	$date = date("Y/m/d");
	$insertQuery = "INSERT INTO `philly_registration`(`registree_name`, `address`, `phone`, `email`, `adult_names`, `total_adults`, `youth_names`, `total_youth`, `children_names`, `total_children`, `additional_tees`, `addt_sizes`, `girly_cut_tees`, `fancy_sizes`, `shirt_sizes`, `total_amount_due`, `total_amount_paid`, `reg_date`) 
					VALUES ('$memberName', '$memberAddress', '$memberPhone', '$memberEmail', '$adultMembersName', '$attendingAdults', '$youthMembersName', '$attendingYouth', '$childrenMembersName', '$attendingChildren', '$addtTee', '$addtTeeSizes', '$addtTeeGC', '$addtTeeGCSizes', '$shirtSize', '$totalAmountDue', '0', '$date')";
	mysqli_query($connect, $insertQuery) or die("Unable to complete insert query: ".mysqli_error($connect));
	mysqli_close($connect);
	mail($memberEmail, $subject, $email_message, $email_headers);
	mail($admin, $subject, $email_message2, $email_headers);
	echo "<p id='successMessage'>Registration Successfull! Please check your email account for additional payment instructions</p>";