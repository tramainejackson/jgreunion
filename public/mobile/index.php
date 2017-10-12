<?php require_once("../../include/sessions.php"); ?><?php require_once("../../include/court.php"); ?><?php require_once("../../include/functions.php"); ?><!DOCTYPE html><html lang="en-US"><?php require_once("../../include/m.head.php"); ?><body>	<div data-role="page" id="index">		<div id="bgrdOverlay"></div>		  <div data-role="header">			<h1 class="pageHeader">J/G Reunion</h1>		  </div>		  <div data-role="main" id="reunion_history" class="ui-content">			<div>				<h2>Our History</h2> 				<p>To The Jackson Green Family,<br/><br/>Earlean Jackson, Victoria Jackson Darby and Hattie Mae Jackson Green, started the Jackson-Green Family 				Reunion in the winter of 1982.<br/><br/>In beginning of forming the family reunion tradition, Earlean, Hattie Mae and Victoria knew that they 				wanted a family reunion but didn’t want to be partial to either side of the family. Therefore the decision was made to form the family reunion 				with both the Jackson (father’s line of decent) and Green (mother’s line of decent) families.</p>			</div>			<a href="#more_history" class="mobileHomeLink moreHistory ui-btn">More History</a>			<a href="#reunion_site" class="mobileHomeLink reunionSite ui-btn">Reunion Site</a>		  </div>	</div>	<div data-role="page" id="more_history">		<div id="bgrdOverlay"></div>	  <div data-role="header">		<h1 class="pageHeader">J/G Reunion</h1>	  </div>	  <div data-role="main" class="ui-content">		<h2>Lets take a trip down memory lane....</h2>		<p>			To The Jackson Green Family,<br/><br/>Earlean Jackson, Victoria Jackson Darby and Hattie Mae Jackson Green, started the Jackson-Green Family 			Reunion in the winter of 1982.<br/><br/>In beginning of forming the family reunion tradition, Earlean, Hattie Mae and Victoria knew that they 			wanted a family reunion but didn’t want to be partial to either side of the family. Therefore the decision was made to form the family reunion 			with both the Jackson (father’s line of decent) and Green (mother’s line of decent) families. <br/><br/>The first family reunion was held on the 			second weekend of August in 1982.  The reunion started with a barbeque on Friday in the backyard of Victoria's home in St. Matthew, South Carolina. 			On the following day, a program and dinner was held at the local middle school. Closing the family reunion weekend, on Sunday, a church services was 			held at Mount Salem Baptist Church in Fort Knox, South Carolina with Rev. Sandy Jackson presiding over the service.<br/><br/>Since the first reunion, 			Earlean, Victoria and Hattie Mae’s original vision to celebrate family has produced 16 more bi-annual reunions thus far.  Currently the average attendance 			at the Jackson-Green Family Reunions ranges between 150-200 people. Every two years the Jackson- Green reunion continues the family tradition of uplifting, 			celebrating, and honoring family.  The family legacy continues in 2016 as the Jackson-Green families come together in Philadelphia, PA.		</p>		  </div>	  <a href="#index" class="mobileLink homePage ui-btn">Back</a>	</div>		<div data-role="page" id="tree_history">	  <div data-role="header">		<h1 class="pageHeader">J/G Reunion</h1>	  </div>	  <div data-role="main" class="ui-content">		<div id="reunion_descent">			<div id="jackson_descent" class="reunion_descent_info">				<h2 id="jackson_descent_header" class="descent_info">Jackson Line of Descent</h2>				<p>Rev. Sandy Jackson II and his wife Venus, had nine children and forty grandchildren come from their union.</p>				<ol>					<li>Louis Jackson (six children)</li>					<li>Darryl Jackson (two children)</li>					<li>Willie &quot;HIT&quot; Jackson (two children)</li>					<li>Chair Jackson (one child)</li>					<li>Mary Magdalene Jackson (three children)</li>					<li>Cyrus &quot;Blump&quot; Jackson (eight children)</li>					<li>Sally Jackson</li>					<li>Sandy Jackson (nine children)</li>					<li>Hattie Jackson (nine children)</li>				</ol>			</div>			<div class="reunion_descent_info" id="green_descent">				<h2 id="green_descent_header" class="descent_info">Green Line of Descent</h2>				<p>From the union of Peter and Laura Green, there were eight children and fifty-six grandchildren.</p>				<ol>					<li>Davis Green</li>					<li>Richard Green (four children)</li>					<li>Louis Green (five children)</li>					<li>Senda Green</li>					<li>Nancy Green (six children)</li>					<li>Anna Green (eleven children)</li>					<li>Peggy Green (eleven children)</li>					<li>Victoria Angus Green (eleven children)</li>				</ol>				<p>It was from the union of Sandy Jackson (Rev. Sandy and Venus Jackson’s son) and Clander Green<br/>(Peter and Laura Green’s daughter) that brought the Jackson-Green families together.</p>			</div>								</div>		<a href="#index" class="mobileLink homePage ui-btn">Back</a>	  </div>	</div>		<div data-role="page" id="reunion_site">		<div id="bgrdOverlay"></div>	  <div data-role="header">		<h1 class="pageHeader">J/G Reunion</h1>	  </div>	  <div data-role="main" class="ui-content">		<div id="mobile_nav">			<a href="#" class="mobileLink loginBtn activeMobileSite ui-btn">Login</a>			<a href="#register_page" class="mobileLink registerBtn ui-btn">Register</a>			<a href="#next_reunion" class="mobileLink ui-btn">2018</a>		</div>		<div id="login_div">			<h2>Login</h2>			<form id="mobile_login_form" class="" name="loginForm" method="POST" action="login.php" data-ajax="false">				<input type="text" name="username" placeholder="Username" />				<input type="password" name="password" placeholder="Password" />				<input type="submit" name="submit" id="login_form_btn" value="Sign In" />			</form>			</div>		<a href="#index" class="mobileLink homePage ui-btn">Back</a>	  </div>	</div>		<div data-role="page" id="register_page">	<div id="bgrdOverlay"></div>	  <div data-role="header">		<h1 class="pageHeader">J/G Reunion</h1>	  </div>	  <div data-role="main" class="ui-content">		<div id="mobile_nav">			<a href="#reunion_site" class="mobileLink loginBtn ui-btn">Login</a>			<a href="#" class="mobileLink activeMobileSite registerBtn ui-btn">Register</a>			<a href="#next_reunion" class="mobileLink ui-btn">2018</a>		</div>		<div id="registration_div">			<h2>Register</h2>			<form id="" class="" name="regForm" method="POST" action="registration_verification.php" data-ajax="false">				<input type="text" name="first_name" class="regInput regFNInput" placeholder="First Name*" class="nameInput" id="" value="<?php echo(isset($_POST["first_name"]) ? $_POST["first_name"] : ""); ?>"/>				<input type="text" name="last_name" class="regInput regLNInput" placeholder="Last Name*" class="nameInput" id="" value="<?php echo(isset($_POST["last_name"]) ? $_POST["last_name"] : ""); ?>" />				<input type="text" name="email" class="regInput" placeholder="Email Address*" class="emailInput" id="" value="<?php echo(isset($_POST["email"]) ? $_POST["email"] : ""); ?>" />				<input type="text" name="username" class="regInput" placeholder="Username*" class="usernameInput" id="" value="<?php echo(isset($_POST["username"]) ? $_POST["username"] : ""); ?>" />				<input type="password" name="password" class="regInput" placeholder="Password*" class="passwordInput" id="" />				<input type="submit" name="submit" id="reg_submit_btn" value="Register" />			</form>		</div>		<a href="#reunion_site" class="mobileLink homePage ui-btn">Back</a>	  </div>	</div>		<div data-role="page" id="next_reunion">		<div id="bgrdOverlay"></div>	  <div data-role="header">		<h1 class="pageHeader">J/G Reunion</h1>	  </div>	  <div data-role="main" class="ui-content">		<div>			<h1 class="nextReunionMobile">Coming Soon</h1>		</div>		<div id="coming_soon_mobile_h2">			<h2 class="nextReunionMobile">Charlotte</h2>			<h2 class="nextReunionMobile">North Carolina</h2>			<h2 class="nextReunionMobile">2018</h2>		</div>		<div id="coming_soon_mobile">			<p>Desmun and his committee will be hosting the 2018 Jackson-Green Family Reunion in Charlotte, NC</p>		</div>		<a href="#reunion_site" class="mobileLink homePage ui-btn">Back</a>	  </div>	</div></body></html>