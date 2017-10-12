<?php require_once("../../include/sessions.php"); ?><?php require_once("../../include/court.php"); ?><?php require_once("../../include/functions.php"); ?><?php login_verification(); ?><?php	if(isset($_POST['submit'])) {		$register = checkRegistration($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $_POST['password']);		if($register != false) {			redirect_to("profile.php");		}	}?><!DOCTYPE html><html lang="en-US"><?php require_once("../../include/m.head.php"); ?><body>	<div class="container" id="registerPage">		<div id="overlay"></div>		<div id="modal"></div>		<?php showSessionMessage(); ?>		<div id="navi">			<div class="page_header">				<h1>Jackson &amp; Green Family Reunion</h1>			</div>			<div id="family_account">				<?php					if(!isset($_SESSION['loggedIn'])) {						echo "<a href='register.php' class='profileLink'>Register</a>						<a href='login.php' class='profileLink'>Login</a>";					} else {						echo "<a href='profile.php' class='profileLink'>My Profile</a>						<a href='logout.php' class='profileLink'>Logout</a>";					}				?>			</div>			<div id="home_link">				<a href="index.php" class="homeLink">Home</a>			</div>		</div>		<div id="registration_div_wrapper">			<div id="registration_div">				<h2 id="reg_form_header">Register</h2>				<div id="reg_form_input">					<form id="" class="" name="regForm" method="POST" action="register.php">						<input type="text" name="first_name" class="regInput regFNInput" placeholder="First Name*" class="nameInput" id="" value="<?php echo(isset($_POST["first_name"]) ? $_POST["first_name"] : ""); ?>"/>						<input type="text" name="last_name" class="regInput regLNInput" placeholder="Last Name*" class="nameInput" id="" value="<?php echo(isset($_POST["last_name"]) ? $_POST["last_name"] : ""); ?>" />						<input type="text" name="email" class="regInput" placeholder="Email Address*" class="emailInput" id="" value="<?php echo(isset($_POST["email"]) ? $_POST["email"] : ""); ?>" />						<input type="text" name="username" class="regInput" placeholder="Username*" class="usernameInput" id="" value="<?php echo(isset($_POST["username"]) ? $_POST["username"] : ""); ?>" />						<input type="password" name="password" class="regInput" placeholder="Password*" class="passwordInput" id="" />						<input type="submit" name="submit" id="reg_form_btn" value="Register" />					</form>				</div>				</div>		</div>	</div>		<script src="../scripts/jgreunion.js"></script>	</body></html>