@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div class="container-fluid" id="profilePage">
		<div id="overlay"></div>
		<div id="modal"></div>
		<div id="navi">
			<div class="page_header">
				<h1>Jackson &amp; Green Family Reunion</h1>
			</div>
			<div id="family_account">
				@if(!Auth::check())
					<a href='/registration' class='profileLink'>Register</a>
					<a href='/login' class='profileLink'>Login</a>
				@else
					<a href='/profile' class='profileLink'>My Profile</a>
					<a href='/logout' class='profileLink'>Logout</a>
				@endif
			</div>
			<div id="home_link">
				@if(!Auth::check())
					<a href='/' class='homeLink'>Home</a>
				@else
					<a href='/' class='homeLink profileLink'>Home</a>
					<a href='/logout' class='profileLink'>Logout</a>
				@endif
			</div>
			@if($newReunionCheck->isNotEmpty())
				<div class="">
					<a id="profile_registration" href="profile.php?register=false">Register For Upcoming Reunion</a>
				</div>
			@endif
		</div>
		<div id="profile_information">
			<form name="profile_form" id="" method="POST" action="profile.php" enctype="multipart/form-data">
				<div id="profile_photo">
					<?php if($user["upload_photo"] == "") { ?>
						<img id="profile_photo" src="images/img_placeholder.jpg" />
					<?php } else { ?>
						<img id="profile_photo" src="../uploads/<?php echo $user["upload_photo"]; ?>" />
					<?php } ?>
					<input type="file" name="upload_photo" id="change_img_btn" />
				</div>
				<div id="profile_header" class="profile_info_div">
					<h2 id="profile_header_name"><?php echo $user["first_name"] . " " . $user["last_name"]; ?></h2>
					<span id="profile_header_username"><?php echo $user["username"]; ?></span>
				</div>
				<div id="general_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="general_header">Personal Information</h3>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Userame</span><input type="text" name="username" class="profileInput" value="<?php echo $user["username"]; ?>" />
						<?php if($user["password"]) { ?>
							<span class="inputTitle">Password</span><input type="password" name="password" class="profileInput" value="value" placeholder="Password" />
						<?php } else {	?>
							<span class="inputTitle">Password</span><input type="password" name="password" class="profileInput" value="" placeholder="Password" />
						<?php } ?>
					</div>	
					<div class="sectionDiv">
						<span class="inputTitle">Name</span>
							<input type="text" name="first_name" class="profileInput profileNameInput1" value="<?php echo $user["first_name"]; ?>" placeholder="Firstname" />
							<input type="text" name="last_name" id="" class="profileInput profileNameInput2" value="<?php echo $user["last_name"]; ?>" placeholder="Lastname" />
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">DOB</span>
							<input type="date" name="date_of_birth" class="profileInput profileInputDOB" value="<?php echo $user["date_of_birth"]; ?>" />
					</div>
				</div>
				<div id="family_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="family_header">Family Tree</h3>
					</div>	
					<span class="inputTitle descentTitle">Descent</span>
						<?php if($user["descent"] == "Green") { ?>
							<div class="descentDiv">
								<input type="text" name="descent" class="profileInput profileInputGreenBtn descentInput descentSelected" value="Green" readonly />
								<input type="text" name="descent" class="profileInput profileInputJacksonBtn descentInput" value="Jackson" readonly />
								<input type="text" name="descent" class="profileInput profileInputSpouseBtn descentInput" value="Spouse" readonly />
								<input type="text" name="descent" class="profileInput profileInputFriendBtn descentInput" value="Friend" readonly />
							</div>	
							<div class="sectionDiv">
								<span class="inputTitle">Parents</span>
									<input type="type" name="mother" class="profileInput profileInputMother" value="<?php echo $user["mother"]; ?>" placeholder="Mother"/>
								<span class="separator">&amp;</span>	
									<input type="type" name="father" class="profileInput profileInputFather" value="<?php echo $user["father"]; ?>" placeholder="Father"/>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Spouse</span>
									<input type="input" name="spouse" class="profileInput profileInputSpouse" value="<?php echo $user["spouse"]; ?>" placeholder="Spouse Name" />
							</div>
							<div class="sectionDiv">		
								<span class="inputTitle">Siblings</span>
								<input type="number" name="siblings" class="profileInput profileSiblingInput" value="<?php echo $user["siblings"]; ?>" />
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Children</span>
								<input type="number" name="children" class="profileInput profileInputChildren" value="<?php echo $user["children"]; ?>" />
							</div>
						<?php } elseif($user["descent"] == "Jackson") { ?>
							<div class="descentDiv">
								<input type="text" name="descent" class="profileInput profileInputGreenBtn descentInput" value="Green" readonly />
								<input type="text" name="descent" class="profileInput profileInputJacksonBtn descentInput descentSelected" value="Jackson" readonly />
								<input type="text" name="descent" class="profileInput profileInputSpouseBtn descentInput" value="Spouse" readonly />
								<input type="text" name="descent" class="profileInput profileInputFriendBtn descentInput" value="Friend" readonly />
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Parents</span>
									<input type="type" name="mother" class="profileInput profileInputMother" value="<?php echo $user["mother"]; ?>" placeholder="Mother"/>
								<span class="separator">&amp;</span>	
									<input type="type" name="father" class="profileInput profileInputFather" value="<?php echo $user["father"]; ?>" placeholder="Father"/>
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Spouse</span>
									<input type="input" name="spouse" class="profileInput profileInputSpouse" value="<?php echo $user["spouse"]; ?>" placeholder="Spouse Name" />
							</div>
							<div class="sectionDiv">		
								<span class="inputTitle">Siblings</span>
								<input type="number" name="siblings" class="profileInput profileSiblingInput" value="<?php echo $user["siblings"]; ?>" />
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Children</span>
								<input type="number" name="children" class="profileInput profileInputChildren" value="<?php echo $user["children"]; ?>" />
							</div>
						<?php } elseif($user["descent"] == "Spouse") { ?>
							<div class="descentDiv">
								<input type="text" name="descent" class="profileInput profileInputGreenBtn descentInput" value="Green" readonly />
								<input type="text" name="descent" class="profileInput profileInputJacksonBtn descentInput" value="Jackson" readonly />
								<input type="text" name="descent" class="profileInput profileInputSpouseBtn descentInput descentSelected" value="Spouse" readonly />
								<input type="text" name="descent" class="profileInput profileInputFriendBtn descentInput" value="Friend" readonly />
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Spouse</span>
									<input type="input" name="spouse" class="profileInput profileInputSpouse" value="<?php echo $user["spouse"]; ?>" placeholder="Spouse Name" />
							</div>
							<div class="sectionDiv">
								<span class="inputTitle">Children</span>
								<input type="number" name="children" class="profileInput profileInputChildren" value="<?php echo $user["children"]; ?>" />
							</div>
						<?php } else { ?>
							<div class="descentDiv">
								<input type="text" name="descent" class="profileInput profileInputGreenBtn descentInput" value="Green" readonly />
								<input type="text" name="descent" class="profileInput profileInputJacksonBtn descentInput" value="Jackson" readonly />
								<input type="text" name="descent" class="profileInput profileInputSpouseBtn descentInput" value="Spouse" readonly />
								<input type="text" name="descent" class="profileInput profileInputFriendBtn descentInput descentSelected" value="Friend" readonly />
							</div>
						<?php } ?>
				</div>
				<div id="contact_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="contact_header">Contact Information</h3>
						<?php if($user["show_contact"] == "Y") { ?>
							<span class="visibleHeaderSpan">Visible to all</span><input type="checkBox" class="visibleCheckBox" name="show_contact" value="Y" checked />
						<?php } else { ?>
							<span class="visibleHeaderSpan">Visible to all</span><input type="checkBox" class="visibleCheckBox" name="show_contact" value="Y" />
						<?php } ?>
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Email</span>
						<input type="text" name="email" class="profileInput" value="<?php echo $user["email"]; ?>" placeholder="Email" />
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Phone</span>
							<input type="text" name="phone[]" class="profileInput profileInputPhone1" placeholder="###" value="<?php echo $userPhone1; ?>" maxlength="3" />
						<span class="phone_par_span">-</span>
							<input type="text" name="phone[]" class="profileInput profileInputPhone2"  placeholder="###" value="<?php echo $userPhone2; ?>" maxlength="3" />
						<span class="phone_par_span">-</span>
							<input type="text" name="phone[]" class="profileInput profileInputPhone3"  placeholder="####" value="<?php echo $userPhone3; ?>" maxlength="4" />
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Address</span>
							<input type="text" name="address" class="profileInput profileInputAddress" placeholder="Address" value="<?php echo $user["address"]; ?>"/>
							<input type="text" name="city" class="profileInput profileInputCity" placeholder="City" value="<?php echo $user["city"]; ?>" />
							<select name="state" id="state_select" class="profileInput profileInputState" placeholder="State">
								@foreach($states as $state)
									@if($state->state_abb == $user->state)
										<option value="<?php echo $state->state_abb; ?>" selected ><?php echo $state->state_abb; ?></option>
									@else
										<option value="<?php echo $state->state_abb; ?>"><?php echo $state->state_abb; ?></option>
									@endif
								@endforeach
							</select>	
							<input type="text" name="zip" id="" class="profileInput profileInputZip" placeholder="Zip Code" value="<?php echo $user["zip"]; ?>" />
					</div>	
				</div>
				<div id="social_information" class="profile_info_div">
					<div class="header_div">
						<h3 id="social_header">Social Information</h3>
						<?php if($user["show_social"] == "Y") { ?>
							<span class="visibleHeaderSpan">Visible to all</span><input type="checkBox" class="visibleCheckBox" name="show_social" value="Y" checked />
						<?php } else { ?>
							<span class="visibleHeaderSpan">Visible to all</span><input type="checkBox" class="visibleCheckBox" name="show_social" value="Y" />
						<?php } ?>
					</div>	
					<div class="sectionDiv">
						<span class="inputTitle">Instagram</span>
						<input type="text" name="instagram" id="" class="profileInput" value="<?php echo $user["instagram"]; ?>" placeholder="Add Instagram Name" />
					</div>
					<div class="sectionDiv">
						<span class="inputTitle">Twitter</span>
						<input type="text" name="twitter" id="" class="profileInput" value="<?php echo $user["twitter"]; ?>" placeholder="Add Twitter Name" />
					</div>
					<div class="sectionDiv">					
						<span class="inputTitle">Facebook</span>
						<input type="text" name="facebook" id="" class="profileInput" value="<?php echo $user["facebook"]; ?>" placeholder="Add Facebook Name" />
					</div>	
				</div>
				<input type="submit" name="submit" id="submit_profile_update" value="Update" />
			</form>
		</div>
		<div id="post_information">
			<?php if(!isset($_GET["new_post"]) && !isset($_GET["all_post"])  && !isset($_GET["register"])) { ?>
				<div id="post_header_div">
					<h2 class="postHeader" id="my_post_header">My Recent Post</h2>
				</div>
				<?php if($rows >= 1) { 
					while($showPost = mysqli_fetch_array($userPost)) { ?>
						<div class="indPost">
							<?php if($showPost["post_photo"] != "") { ?>
								<?php $allPhotos = explode("; ", $showPost["post_photo"]); ?>
								<div class="postPhoto">
									<?php for($i=0; $i < count($allPhotos); $i++) { ?>
										<img class="postPicture" src="../uploads/<?php echo $allPhotos[$i]; ?>" />
									<?php } ?>	
								</div>
							<?php } ?>
							<div class="postComment">
								<p><?php echo $showPost["post_comments"]; ?></p>
							</div>
							<div class="postDate">
								<span class="deletePost"><a href="delete_post.php?remove_id=<?php echo $showPost["post_id"]; ?>" id="<?php echo $showPost["post_id"]; ?>">Delete Post</a></span>
								<span class="indPostDate"><?php echo $showPost["created_date"]; ?></span>
							</div>
						</div>
				<?php } } else {	?>
					<div class="indPost">
						<div class="postComment">
							<p class="noPostPlaceholder">No current post.</p>
						</div>
					</div>
				<?php } ?>
				<a id="add_new_post" class="postBtn" href="profile.php?new_post=true">New Post</a>
				<a id="see_all_post" class="allPostBtn" href="profile.php?all_post=true">All Post</a>
			<?php } elseif(isset($_GET["all_post"]) && !isset($_GET["register"]) && !isset($_GET["register"])) { ?>
				<?php $allPost = find_all_post($user["user_id"]); ?>
				<?php $allPostRows = mysqli_num_rows($allPost); ?>
				<div id="post_header_div">
					<h2 class="postHeader" id="all_post_header">Jackson-Green Family Post</h2>
				</div>
				<?php if($allPostRows > 0 || $rows > 0) { ?>
					<?php while($showAllPost = mysqli_fetch_array($allPost)) { ?>
						<?php $profilePic = find_user_by_username($showAllPost["username"]); ?>
						<div class="indPost">
							<div class="profilePhoto">
								<?php if($profilePic["upload_photo"] == "") { ?>
									<img class="profilePicture" src="images/img_placeholder.jpg" />
								<?php } else { ?>
									<img class="profilePicture" src="../uploads/<?php echo $profilePic["upload_photo"]; ?>" />
								<?php } ?>
							</div>
							<div class="profileHeader">
								<h3 class="profileHeaderName">
									<a class="userProfileLink" href="indProfile.php?name=<?php echo $profilePic["first_name"] . "_" . $profilePic["last_name"] . $profilePic["user_id"] . strlen($profilePic["user_id"]); ?>"><?php echo $profilePic["first_name"] . " " . $profilePic["last_name"]; ?></a>
								</h3>
							</div>
							<?php if($showAllPost["post_photo"] != "") { ?>
								<?php $allPhotos = explode("; ", $showAllPost["post_photo"]); ?>
								<div class="postPhoto">
									<?php for($i=0; $i < count($allPhotos); $i++) { ?>
										<img class="postPicture" src="../uploads/<?php echo $allPhotos[$i]; ?>" />
									<?php } ?>	
								</div>
							<?php } ?>	
							<div class="postComment">
								<p><?php echo $showAllPost["post_comments"]; ?></p>
							</div>
							<div class="postDate">
								<span class="indPostDate"><?php echo strftime($showAllPost["created_date"]); ?></span>
							</div>
						</div>
					<?php } ?>
				<?php } else { ?>
					<div class="indPost">
						<div class="postComment">
							<p>No family post yet. Click <a href="profile.php?new_post=true">here</a> and be the first!</p>
						</div>
					</div>
				<?php } ?>
				<a id="add_new_post" class="postBtn" href="profile.php?new_post=true">New Post</a>
				<a id="see_all_post" class="allPostBtn" href="profile.php?all_post=true">All Post</a>
			<?php } elseif(!isset($_GET["new_post"]) && !isset($_GET["all_post"])  && isset($_GET["register"])) { ?>
				<div class="indPost reunionRegistration">
					<form name="" class="" action="reunion_registration.php" method="POST">
						<?php $getNewReunions = getNewReunions(); ?>
						<?php if(mysqli_num_rows($getNewReunions) > 1) { ?>
							<div class="">
								<select class="" name="reunion_id">
									<option value="blank" selected disabled>----- Select A Reunion -----</option>
									<?php while($showReunion = mysqli_fetch_assoc($getNewReunions)) { ?>
										<option value="<?php echo $showReunion["reunion_id"]; ?>"><?php echo $showReunion["reunion_city"]; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="">
								<input type="text" name="" class="" value="<?php echo $user["first_name"]; ?>" placeholder="Firstname" />
								<input type="text" name="" class="" value="<?php echo $user["last_name"]; ?>" placeholder="Lastname" />
								<input type="email" name="" class="" value="<?php echo $user["email"]; ?>" placeholder="Email Address" />
								<input type="text" name="" class="" value="<?php echo $user["address"]; ?>" placeholder="Address" />
								<input type="text" name="" class="" value="<?php echo $user["city"]; ?>" placeholder="City" />
								<select name="state" id="state_select" class="profileInput profileInputState" placeholder="State">
									@foreach($states as $state)
										@if($state->state_abb == $user->state) { ?>
											<option value="<?php echo $state->state_abb; ?>" selected ><?php echo $state->state_abb; ?></option>
										@else
											<option value="<?php echo $state->state_abb; ?>"><?php echo $state->state_abb; ?></option>
										@endif
									@endforeach	
								</select>
								<input type="number" name="" class="" value="<?php echo $user["zip"]; ?>" placeholder="Zip Code" />
								<input type="text" name="" class="" value="<?php echo $user["phone"]; ?>" />
								<input type="number" name="" class="" value="" placeholder="Number Of Adults" />
								<input type="number" name="" class="" value="" placeholder="Number Of Youth" />
								<input type="number" name="" class="" value="" placeholder="Number Of Children" />
							</div>
						<?php } else { ?>
							<?php $checkRegistration = checkUserRegistration($user["user_id"]); ?>
							<?php if(mysqli_num_rows($checkRegistration) < 1) { ?>
								<?php while($showReunion = mysqli_fetch_assoc($getNewReunions)) { ?>
									<div class="">
										<h2 class=""><?php echo $showReunion["reunion_city"]; ?> Reunion Registration</h2>
									</div>
									<div class="">
										<table>
											<tr>
												<th>Adults (Ages 17+)</th>
												<th>Youth (Ages 7-16)</th>
												<th>Children (Ages 6-)</th>
												<th>Addt T-Shirts</th>
											</tr>
											<tr>
												<td><?php echo "$" . $showReunion["adult_price"]; ?></td>
												<td><?php echo "$" . $showReunion["youth_price"]; ?></td>
												<td><?php echo "$" . $showReunion["child_price"]; ?></td>
												<td><?php echo "$" . $showReunion["addt_tee_price"]; ?></td>
											</tr>
										</table>
									</div>
									<div class="">
										<div class="">
											<input type="text" name="first_name" class="" value="<?php echo $user["first_name"]; ?>" placeholder="Firstname" />
										</div>
										<div class="">
											<input type="text" name="last_name" class="" value="<?php echo $user["last_name"]; ?>" placeholder="Lastname" />
										</div>
										<div class="">
											<input type="email" name="email" class="" value="<?php echo $user["email"]; ?>" placeholder="Email Address" />
										</div>
										<div class="">
											<input type="text" name="address" class="" value="<?php echo $user["address"]; ?>" placeholder="Address" />
										</div>
										<div class="">
											<input type="text" name="city" class="" value="<?php echo $user["city"]; ?>" placeholder="City" />
										</div>
										<div class="">
											<select name="state" id="state_select" class="profileInput profileInputState" placeholder="State">
												@foreach($states as $state)
													@if($state->state_abb == $user->state) { ?>
														<option value="<?php echo $state->state_abb; ?>" selected ><?php echo $state->state_abb; ?></option>
													@else
														<option value="<?php echo $state->state_abb; ?>"><?php echo $state->state_abb; ?></option>
													@endif
												@endforeach	
											</select>
										</div>
										<div class="">
											<input type="number" name="zip" class="" value="<?php echo $user["zip"]; ?>" placeholder="Zip Code" />
										</div>
										<div class="">
											<input type="text" name="phone[]" class="phone3" placeholder="###" value="<?php echo $userPhone1; ?>" maxlength="3" />
												<span class="phone_span">-</span>
											<input type="text" name="phone[]" class="phone3"  placeholder="###" value="<?php echo $userPhone2; ?>" maxlength="3" />
												<span class="phone_span">-</span>
											<input type="text" name="phone[]" class="phone4"  placeholder="####" value="<?php echo $userPhone3; ?>" maxlength="4" />
										</div>
										<div class="">
											<input type="number" name="number_adults" class="" value="" placeholder="Number Of Adults" />
										</div>
										<div class="addSeparationComm">
											<input type="text" name="attending_adult_name" class="" value="" placeholder="Adult Names" />
										</div>
										<div class="">
											<input type="number" name="number_youth" class="" value="" placeholder="Number Of Youth" />
										</div>
										<div class="addSeparationComm">
											<input type="text" name="attending_youth_name" class="" value="" placeholder="Youth Names" />
										</div>
										<div class="">
											<input type="number" name="number_children" class="" value="" placeholder="Number Of Children" />
										</div>
										<div class="addSeparationComm">
											<input type="text" name="attending_children_name" class="" value="" placeholder="Children Names" />
										</div>
										<div class="">
											<input type="number" name="addtTee" class="" value="" placeholder="Number Of Additional T-Shirts" />
										</div>
										<div class="addSeparationComm">
											<input type="text" name="shirt_size" class="" value="" placeholder="Shirt Sizes" />
										</div>
										<div class="">
											<input type="hidden" name="user_id" class="" value="<?php echo $user["user_id"]; ?>" />
										</div>
										<div class="">
											<input type="hidden" name="reunion_id" class="" value="<?php echo $showReunion["reunion_id"]; ?>" />
										</div>
										<div class="">
											<input type="hidden" name="reunion_year" class="" value="<?php echo $showReunion["reunion_year"]; ?>" />
										</div>
										<div class="">
											<input type="hidden" name="reunion_city" class="" value="<?php echo $showReunion["reunion_city"]; ?>" />
										</div>
										<div class="">
											<input type="submit" name="submit" class="" value="Submit Registration" />
										</div>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="">
									<h2 class="">You have already registered for the reunion</h2>
								</div>
								<div class="">
									<?php $showRegistration = mysqli_fetch_assoc($checkRegistration); ?>
									<div class="">
										<p class="">Registered Date: <?php echo $showRegistration["reg_date"]; ?></p>
									</div>
									<div class="">
										<p class="">Adults: <?php echo $showRegistration["adult_names"] . "(".$showRegistration["total_adults"].")"; ?></p>
									</div>
									<div class="">
										<p class="">Youth: <?php echo $showRegistration["youth_names"] . "(".$showRegistration["total_youth"].")"; ?></p>
									</div>
									<div class="">
										<p class="">Children: <?php echo $showRegistration["children_names"] . "(".$showRegistration["total_children"].")"; ?></p>
									</div>
									<div class="">
										<p class="">Addtional T-Shirts: <?php echo $showRegistration["additional_tees"]; ?></p>
									</div>
									<div class="">
										<p class="">Total Due At Registration: <?php echo "$".$showRegistration["total_amount_due"]; ?></p>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</form>	
				</div>	
			<?php } else { ?>
				<div id="post_header_div">
					<h2 class="postHeader" id="new_post_header">New Post</h2>
				</div>
				<div class="newPost">
					<form name="new_post_form" method="POST" action="profile.php" enctype="multipart/form-data">
						<div id="post_photo">
							<span>Add Photos</span>
							<input type="file" class="" name="upload_photo[]" multiple />
							<div id="photo_preview">
							</div>
						</div>
						<div class="newComment">
							<span>Add Comment</span>
							<textarea name="new_post" class="newComment" placeholder="Add Post" cols="20" rows="10"></textarea>
						</div>
						<input type="submit" name="submit" id="post_new_post" class="postBtn" href="profile.php" value="Add Post" />
					</form>
				</div>
				<a id="see_all_post" class="allPostBtn" href="profile.php?all_post=true">All Post</a>
			<?php } ?>	
		</div>
	</div>		
@endsection