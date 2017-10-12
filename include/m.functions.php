<?php
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
	defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'jgreunion');
	date_default_timezone_set("America/New_York");
	$date = date("Y-m-d H:i:s");
		
	function mysql_prep($string) {
		global $connect;
		$escaped_string = mysqli_real_escape_string($connect, $string);
		return $escaped_string;
	}
	
	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}
	
	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
	function find_all_admins() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "ORDER BY username ASC";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		return $admin_set;
	}
	
	function find_admin_by_id($admin_id) {
		global $connect;
		
		$safe_admin_id = mysqli_real_escape_string($connect, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function find_admin_by_username($username) {
		global $connect;
		
		$safe_username = mysqli_real_escape_string($connect, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM users ";
		$query .= "WHERE username = '".$safe_username."' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function find_user_by_username($username) {
		global $connect;
		$safe_username = mysqli_real_escape_string($connect, $username);
		$query  = "SELECT * ";
		$query .= "FROM user_profile ";
		$query .= "WHERE username = '".$safe_username."' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function find_user_by_id($id) {
		global $connect;
		$query  = "SELECT * ";
		$query .= "FROM user_profile ";
		$query .= "WHERE user_id = '".$id."' ";
		$query .= "LIMIT 1;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function find_post_by_username($username) {
		global $connect;
		$query  = "SELECT * ";
		$query .= "FROM profile_post ";
		$query .= "WHERE username = '".$username."' ";
		$query .= "ORDER BY created_date DESC ";
		$query .= "LIMIT 15;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function find_post_by_id($id) {
		global $connect;
		$query  = "SELECT * ";
		$query .= "FROM profile_post ";
		$query .= "WHERE user_id = '".$id."' ";
		$query .= "ORDER BY created_date DESC ";
		$query .= "LIMIT 30;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function find_id_from_string($searchString) {
		$stringLen = strlen($searchString);
		$idLen = substr($searchString, $stringLen - 1);
		$userID = substr($searchString, ($stringLen - $idLen -1), $idLen);
		
		return $userID;
	}
	
	function find_all_post($exludedID) {
		global $connect;
		$query  = "SELECT * ";
		$query .= "FROM profile_post ";
		$query .= "WHERE user_id <> '".$exludedID."' ";
		$query .= "ORDER BY created_date DESC;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function find_all_states() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM states ";
		$query .= "ORDER BY state_id;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function find_all_profile_members() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM user_profile ";
		$query .= "ORDER BY date_of_birth DESC;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function find_last_inserted_id() {
		global $connect;
		
		$lastID = mysqli_insert_id($connect);
		return $lastID;
	}
	
	function find_descent_options() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM descent_options;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = password_verify($password, $existing_hash);
	  if ($hash === true) {
	    return true;
	  } else {
	    return false;
	  }
	}
	
	function attempt_admin_login($username, $password) {
		$admin = find_user_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["password"])) {
				// password matches
				$_SESSION["loggedIn"] = $admin["username"];
				log_action("Login", $_SESSION["loggedIn"] . " logged in");
				return true;
			} else {
				// password does not match
				log_action("Login", "Incorrect login information.");
				$_SESSION["errors"] = "Incorrect login information. Please try again.";
				return false;
			}
		} else {
			// admin not found
			log_action("Login", "Incorrect login information.");
			$_SESSION["errors"] = "Incorrect login information. Please try again.";
			return false;
		}
	}
	
	function attempt_profile_login($username, $password) {
		$admin = find_user_by_username($username);
	
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["password"])) {
				// password matches
				$_SESSION["loggedIn"] = $admin["username"];
				log_action("Login", $_SESSION["loggedIn"] . " logged in");
				return true;
			} else {
				// password does not match
				log_action("Login", "Incorrect login information1.");
				$_SESSION["errors"] = "Incorrect login information. Please try again.";
				return false;
			}
		} else {
			// admin not found
			log_action("Login", "Incorrect login information2.");
			$_SESSION["errors"] = "Incorrect login information. Please try again.";
			return false;
		}
	}
	
	function login_verification() {
		if(isset($_SESSION['loggedIn'])) {
			redirect_to("index.php");
		}
	}
	
	function noLogin_verification() {
		if(!isset($_SESSION['loggedIn'])) {
			redirect_to("index.php");
		}
	}
	
	function cleanValues($values) {
		global $connect;
		$returnValue = null;
		
		if(is_array($values)) {
			$returnValue = array();
			$arrayValues = $values;
			
			for($i=0; $i < count($arrayValues); $i++) {
				$newValue = mysqli_real_escape_string($connect, trim($arrayValues[$i]));
				array_push($returnValue, $newValue);
			}
		} else {
			$returnValue = "";
			$returnValue = mysqli_real_escape_string($connect, trim($values));
		}
		
		return $returnValue;
	}
	
	function getPastReunions() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM past_reunions ";
		$query .= "ORDER BY reunion_year DESC;";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function getImages() {
		global $connect;
		
		$query  = "SELECT * ";
		$query .= "FROM images ";
		$query .= "WHERE image_id > '5';";
		$admin_set = mysqli_query($connect, $query);
		confirm_query($admin_set);
		
		return $admin_set;
	}
	
	function createPassword($value) {
		$hash_password = password_hash($value, PASSWORD_DEFAULT);
		return $hash_password;
	}
	
	function checkNewUsername($value) {
		$username = cleanValues($value);
		$usernameDupe = find_user_by_username($username);
		$errors = 0;
		if($username == "")
		{
			$_SESSION['errors'] .= "<li class='error_item'>Username cannot be empty</li>";
			$errors++;
		} 
		if($username == $usernameDupe['username']) {
			$_SESSION['errors'] .= "<li class='error_item'>Username \"".strtolower($username)."\" already exist</li>";
			$errors++;
		}
		if(!preg_match("/[A-Za-z0-9']{7,50}/", $username) && $username != "")
		{
			$_SESSION['errors'] .= "<li class='error_item'>Username must be atleast 7 characters long and contain only letter's and numbers</li>";
			$errors++;
		}
		if($errors > 0) {
			return $errors;
		} else {
			return $username;
		}
	}
	
	function checkNewPassword($password) {
		$password = cleanValues($password);
		$errors = 0;
		if($password == "")
		{
			$_SESSION['errors'] .= "<li class='error_item'>Password cannot be empty</li>";
			$errors++;
		}
		if(!preg_match("/[A-Za-z0-9']{7,50}/", $password))
		{
			$_SESSION['errors'] .= "<li class='error_item'>Password must be atleast 7 characters long and must contain only letter's and numbers</li>";
			$errors++;
		}
		if($errors > 0) {
			return false;
		} else {
			return $password;
		}
	}
	
	function checkNewName($value1="", $value2="", $value3="") {
		$firstname = cleanValues(ucwords(strtolower($value1)));
		$lastname = cleanValues(ucwords(strtolower($value2)));
		$nickname = cleanValues($value3);
		$names = [$firstname, $lastname, $nickname];
		$errors = 0;
		
		if($firstname == "") {
			$_SESSION['errors'] .= "<li class='error_item'>Firstname cannot be empty</li>";
			$errors++;	
		}
		
		if(!preg_match("/^[A-Za-z' -]{1,50}$/", $firstname)) {
			$_SESSION['errors'] .= "<li class='error_item'>Firstname must contain only letter's, hyphens and apostrophe's</li>";
			$errors++;	
		}
		
		if($lastname == "")	{
			$_SESSION['errors'] .= "<li class='error_item'>Lastname cannot be empty</li>";
			$errors++;
		}
		
		if(!preg_match("/^[A-Za-z' -]{1,50}$/", $lastname)) {
			$_SESSION['errors'] .= "<li class='error_item'>Lastname must contain only letter's, hyphens and apostrophe's</li>";
			$errors++;
		}	
		
		if(($nickname != "") && (!preg_match("/^[A-Za-z0-9' -]{1,50}$/", $nickname))) {
			$_SESSION['errors'] .= "<li class='error_item'>Nickname can only contain letters, numbers hyphens and apostrophe's</li>";
			$errors++;
		}
		
		if($errors > 0) {
			return $errors;
		} else {
			return $names;
		}
	}
	
	function checkNewEmail($value) {
		
		$email = cleanValues(strtolower($value));
		$errors = 0;
		
		if($email == "") {
			$_SESSION['errors'] .= "<li class='error_item'>Email cannot be empty</li>";
			$errors++;
		}
		
		if(($email != "") && (!preg_match("/.+@.+\\..+$/", $email))) {
			$_SESSION['errors'] .= "<li class='error_item'>Wrong format for email</li>";
			$errors++;
		}
		
		if($errors > 0) {
			return $errors;
		} else {
			return $email;
		}
	}
	
	function checkNewPicture($filesArray) {
		// echo "<pre>";
		// print_r($filesArray);
		// echo "</pre>";
		
		$target_dir = "../../uploads/";
		$target_file = $target_dir . basename($filesArray["name"]);
		$uploadOk = 1;
		$addID = find_user_by_username($_SESSION["loggedIn"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if($filesArray["name"] != "") {
			$check = getimagesize($filesArray["tmp_name"]);
			if($check !== false) {
				$_SESSION["message"] .= "<li class='okItem'>File is an image - " . $check["mime"] . ".</li>";
				$uploadOk = 1;
			} else {
				$_SESSION["errors"] .= "<li class='errorItem'>File is not an image.</li>";
				$uploadOk = 0;
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$_SESSION["errors"] .= "<li class='errorItem'>Sorry, file already exists.</li>";
				$uploadOk = 0;
			}
			// Check file size
			if ($filesArray["size"] > 2000000) {
				$_SESSION["errors"] .= "<li class='errorItem'>Sorry, your file is too large.</li>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$_SESSION["errors"] .= "<li class='errorItem'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</li>";
				$uploadOk = 0;
			}
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$_SESSION["errors"] .= "<li class='errorItem'>Sorry, your file was not uploaded.</li>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($filesArray["tmp_name"], $target_file)) {
				return [true, $filesArray["name"]];
			} else {
				return $filesArray["error"];
			}
		}
	}
	
	function createPost($value, $fileValues) {
		global $connect;
		$images = $fileValues != "" ? reArrayFiles($fileValues) : $fileValues;
		$imagesCount = $fileValues != "" ? count($fileValues["upload_photo"]["name"]) : 0;
		$returnArray = [];
		if($imagesCount > 0) {
			for($i=0; $i < $imagesCount; $i++) {
				$thisImage = checkNewPicture($images["upload_photo"][$i]);
				if($thisImage[0] == true) {
					array_push($returnArray, $thisImage[1]);
				}
			}
		} else {
			$image = checkNewPicture($fileValues);
			$returnArray = $image[1];
		}
	
		$userInfo = find_user_by_username($_SESSION["loggedIn"]);
		$userID = $userInfo["user_id"];
		$cleanPost = mysqli_real_escape_string($connect, htmlentities($value));
		$query  = "INSERT INTO profile_post";
		$query .= "(user_id, post_comments, username) ";
		$query .= "VALUES('".$userID."', '".$cleanPost."', '".$userInfo["username"]."');";
		$admin_set = mysqli_query($connect, $query);
		$newID = find_last_inserted_id();
		$picturesString = isset($returnArray) ? implode("; ", $returnArray) : "";
		$picturesString = str_ireplace(".", $newID.".", $picturesString);
		$query2  = "UPDATE profile_post ";
		$query2 .= "SET post_photo = '".$picturesString."' ";
		$query2 .= "WHERE username = '".$userInfo["username"]."' AND post_id = '".$newID."';";
		$admin_set2 = mysqli_query($connect, $query2);
		if($admin_set) {
			if($admin_set2) {
				$_SESSION["message"] = "<li>New post added successfully</li>";
				for($i=0; $i < count($returnArray); $i++) {
					$newPictureName = str_ireplace(".", $newID.".", $returnArray[$i]);
					rename("../uploads/" . $returnArray[$i], "../uploads/" . $newPictureName);
				}
			}	
			return true;
		} else {
			$_SESSION["errors"] = "<li>New post not added</li>";
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function reArrayFiles($file_post) {
		$file_ary = array();
		$file_count = count($file_post["name"]);
		$file_keys = array_keys($file_post);
		
		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}
	
	function update_post($olderUsername, $newUsername) {
		
		global $connect;
		$olderUsername = $olderUsername;
		$newUsername = $newUsername;
		$query  = "UPDATE profile_post ";
		$query .= "SET username = '".$newUsername."' ";
		$query .= "WHERE username = '".$olderUsername."';";
		$admin_set = mysqli_query($connect, $query);
		if($admin_set) {
			return true;
		} else {
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function remove_post($id) {
		global $connect;
		$query  = "DELETE FROM profile_post ";
		$query .= "WHERE username = '".$_SESSION["loggedIn"]."' ";
		$query .= "AND post_id = '".$id."';";
		$admin_set = mysqli_query($connect, $query);
		if($admin_set) {
			$_SESSION["message"] = "<li class='okMessage'>Post deleted successfully</li>";
			return true;
		} else {
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function createUserAccount($arrayValue) {
		global $connect;
		
		$timestamp = date("Y-m-d H:i:s");
		$hash_password = createPassword($arrayValue[4]);
		$query  = "INSERT INTO user_profile";
		$query .= "(first_name, last_name, username, email, password, updated_date) ";
		$query .= "VALUES ('".$arrayValue[0]."', '".$arrayValue[1]."', '".$arrayValue[2]."', '".$arrayValue[3]."', '".$hash_password."', '".$timestamp."'); ";
		$admin_set = mysqli_query($connect, $query);
		if($admin_set) {
			$_SESSION["loggedIn"] = $arrayValue[2];
			echo "User account created successfully";
		} else {
			echo "User account failed to be created";
		}
	}
	
	function update_user_password($password) {
		global $connect;
		$username = $_SESSION["loggedIn"];
		$query  = "UPDATE user_profile ";
		$query .= "SET password = '".$password."' ";
		$query .= "WHERE username = '".$username."';";
		$admin_set = mysqli_query($connect, $query);
		if($admin_set) {
			return true;
		} else {
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function checkRegistration($value) {
		$names = checkNewName($value["first_name"], $value["last_name"]);
		$email = checkNewEmail($value["email"]);
		$password = checkNewPassword($value["password"]);
		$username = checkNewUsername($value["username"]);
		if(is_numeric($names) || is_numeric($email) || is_numeric($username) || $password == false) {
			return false;
		} else {
			$allValues = [$names[0], $names[1], $username, $email, $password];
			createUserAccount($allValues);
		 return true;
		}
	}
	
	function updateProfile($postValues, $imageValues="") {
		// echo "<pre>";
		// print_r($postValues);
		// echo "</pre>";
		
		// echo "<pre>";
		// print_r($imageValues);
		// echo "</pre>";
		
		global $connect;
		
		$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		
		$currentUsername = find_user_by_username($_SESSION["loggedIn"]);
		$newUsername = find_user_by_username($postValues["username"]) == null ? $postValues["username"] : $currentUsername["username"];
		
		if($newUsername != $currentUsername["username"]) {  
			$newUsername = checkNewUsername($newUsername);
			
			if($newUsername == 1 || $newUsername == 2) {
				$newUsername = $currentUsername["username"];
			}
		}
		
		$name = checkNewName($postValues["first_name"], $postValues["last_name"]);
		$mother = isset($postValues["mother"]) ? cleanValues($postValues["mother"]) : null;
		$father = isset($postValues["father"]) ? cleanValues($postValues["father"]) : null;
		$dob = $postValues["date_of_birth"];
		$spouse = isset($postValues["spouse"]) ? $postValues["spouse"] : null;
		//$photo = ($_FILES["upload_photo"]["size"] > 0) ? checkNewPicture($imageValues) : "";
		//$goodPhoto = $photo != "" ?  str_ireplace(".", $currentUsername["user_id"].".", $photo[1]) : "";
		$siblings = isset($postValues["siblings"]) ? $postValues["siblings"] : 0;
		$children = isset($postValues["children"]) ? $postValues["children"] : 0;
		$descent = $postValues["descent"];
		
		$query  = "UPDATE user_profile ";
		$query .= "SET username = '".$newUsername."', first_name = '".$name[0]."', last_name = '".$name[1]."', ";
		$query .= "date_of_birth = '".$dob."', mother = '".$mother."', father = '".$father."', ";
		$query .= "siblings = '".$siblings."', children = '".$children."', spouse = '".$spouse."', ";
		$query .= "descent = '".$descent."', user_updated = '".$newUsername."' ";
		$query .= "WHERE username = '".$currentUsername["username"]."'; ";
		$admin_set = mysqli_query($connect, $query);
		
		if(isset($photo[1])) {
			$query  = "UPDATE user_profile ";
			$query .= "SET upload_photo = '".$goodPhoto."' ";
			$query .= "WHERE username = '".$newUsername."'; ";
			$admin_set = mysqli_query($connect, $query);
			if($admin_set) {
				rename("../uploads/" . $photo[1], "../uploads/" . $goodPhoto);
			}
		}
		
		if($currentUsername["username"] != $newUsername) {
			$_SESSION["loggedIn"] = $newUsername;
			update_post($currentUsername["username"], $newUsername);
		}
	
		if($postValues["password"] != "value" && $postValues["password"] != "") {
			$password = checkNewPassword($postValues["password"]);
			$newPassword = createPassword($password);
			update_user_password($newPassword);
		}
		
		if($admin_set) {
			echo "Update successful";
			return true;
		} else {
			echo "Profile not updated";
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function updateSocial($postValues) {
		global $connect;
		
		$twitter = cleanValues($postValues["twitter"]);
		$instagram = cleanValues($postValues["instagram"]);
		$facebook = cleanValues($postValues["facebook"]);
		$socialInformation = $postValues["show_social"];
		
		$query  = "UPDATE user_profile ";
		$query .= "SET instagram = '".$instagram."', twitter = '".$twitter."', facebook = '".$facebook."', ";
		$query .= "show_social = '".$socialInformation."', user_updated = '".$_SESSION["loggedIn"]."' ";
		$query .= "WHERE username = '".$_SESSION["loggedIn"]."'; ";
		$admin_set = mysqli_query($connect, $query);
		
		if($admin_set) {
			echo "Update successful";
			return true;
		} else {
			echo "Social information not updated";
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function updateContact($postValues) {
		global $connect;
		
		$email = checkNewEmail($postValues["email"]);
		$phone = $postValues["phone"][0].$postValues["phone"][1].$postValues["phone"][2];
		$zip = cleanValues($postValues["zip"]);
		$city = cleanValues($postValues["city"]);
		$address = cleanValues($postValues["address"]);
		$contactInformation = $postValues["show_contact"];
		
		$query  = "UPDATE user_profile ";
		$query .= "SET email = '".$email."', phone = '".$phone."', ";
		$query .= "address = '".$address."', city = '".$city."', state = '".$postValues["state"]."', zip = '".$zip."', ";
		$query .= "show_contact = '".$contactInformation."', user_updated = '".$_SESSION["loggedIn"]."' ";
		$query .= "WHERE username = '".$_SESSION["loggedIn"]."'; ";
		$admin_set = mysqli_query($connect, $query);
		
		if($admin_set) {
			echo "Update successful";
			return true;
		} else {
			echo "Contact information not updated";
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
	
	function updatePost($values, $files) {
		global $connect;

		$images = $files["name"][0] != "" ? reArrayFiles($files) : $files;
		$imagesCount = $files["name"] != "" ? count($files["name"]) : 0;
		$returnArray = [];

		// echo "<pre>";
		// print_r($images);
		// echo "</pre>";
		
		if($imagesCount > 0) {
			for($i=0; $i < $imagesCount; $i++) {
				$thisImage = checkNewPicture($images[$i]);
				if($thisImage[0] == true) {
					array_push($returnArray, $thisImage[1]);
				}
			}
		} else {
			$images = checkNewPicture($files);
			$returnArray = $images[1];
		}
		
		//print_r($returnArray);
	
		$userInfo = find_user_by_username($_SESSION["loggedIn"]);
		$userID = $userInfo["user_id"];
		$cleanPost = mysqli_real_escape_string($connect, htmlentities($values["new_post"]));
		$query  = "INSERT INTO profile_post";
		$query .= "(user_id, post_comments, username) ";
		$query .= "VALUES('".$userID."', '".$cleanPost."', '".$userInfo["username"]."');";
		$admin_set = mysqli_query($connect, $query);
		$newID = find_last_inserted_id();
		$picturesString = isset($returnArray) ? implode("; ", $returnArray) : "";
		$picturesString = str_ireplace(".", $newID.".", $picturesString);
		$query2  = "UPDATE profile_post ";
		$query2 .= "SET post_photo = '".$picturesString."' ";
		$query2 .= "WHERE username = '".$userInfo["username"]."' AND post_id = '".$newID."';";
		$admin_set2 = mysqli_query($connect, $query2);
		if($admin_set) {
			if($admin_set2) {
				echo "Update successful";
				for($i=0; $i < count($returnArray); $i++) {
					$newPictureName = str_ireplace(".", $newID.".", $returnArray[$i]);
					rename("../../uploads/" . $returnArray[$i], "../../uploads/" . $newPictureName);
				}
			}	
			return true;
		} else {
			echo "New post not added";
			die("Database query failed: " . mysqli_error($connect));
			return false;
		}
	}
		
	function getAddtCount($arrayValues) {
		$returnCount = 0;
		for($i=0; $i < count($arrayValues); $i++) {
			$returnCount = $returnCount + $arrayValues[$i];
		}
		return $returnCount;
	}
	
	function getAddtSizes($arrayValues) {
		$returnArray = array();
			if($arrayValues[0] > 0) {
				for($i=0; $i < $arrayValues[0]; $i++) {
					array_push($returnArray, "Small");
				}
			}
			if($arrayValues[1] > 0) {
				for($i=0; $i < $arrayValues[1]; $i++) {
					array_push($returnArray, "Medium");
				}	
			}
			if($arrayValues[2] > 0) {
				for($i=0; $i < $arrayValues[2]; $i++) {
					array_push($returnArray, "Large");
				}	
			}
			if($arrayValues[3] > 0) {
				for($i=0; $i < $arrayValues[3]; $i++) {
					array_push($returnArray, "XL");
				}	
			}
			if($arrayValues[4] > 0) {
				for($i=0; $i < $arrayValues[4]; $i++) {
					array_push($returnArray, "XXL");
				}
			}
			if($arrayValues[5] > 0) {
				for($i=0; $i < $arrayValues[5]; $i++) {
					array_push($returnArray, "3XL");
				}
			}
			if($arrayValues[6] > 0) {
				for($i=0; $i < $arrayValues[6]; $i++) {
					array_push($returnArray, "4XL");
				}
			}
			if($arrayValues[7] > 0) {
				for($i=0; $i < $arrayValues[7]; $i++) {
					array_push($returnArray, "KSmall");
				}
			}
			if($arrayValues[8] > 0) {
				for($i=0; $i < $arrayValues[8]; $i++) {
					array_push($returnArray, "KMedium");
				}
			}
			if($arrayValues[9]> 0) {
				for($i=0; $i < $arrayValues[9]; $i++) {
					array_push($returnArray, "KLarge");	
				}
			}
		return $returnArray;
	}
	
	function log_action($action, $message="") {
		$logfile = '../../files/logs.txt';
		$new = file_exists($logfile) ? false : true;
		$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		if($handle = fopen($logfile, "a")) {
			$content = $timestamp . " | " . $action . ": " . $message . "\n";
			fwrite($handle, $content);
			fclose($handle);
			if($new) {
				$handle = fopen($logfile, "w");
				$content = $timestamp . " | " . $action . " | " . $message . "\n";
				fwrite($handle, $content);
				fclose($handle);
			}
		} else {
			echo "Unable to create file";
		}
	}
	
?>