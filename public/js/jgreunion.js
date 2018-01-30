$(document).ready(function()
{	

	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});

	//Common Variables
	var windowHeight = window.innerHeight;
	var documentHeight = document.body.clientHeight;
	var screenHeight = screen.height;
		
	//Make the body min height the same size as the window height 	
	$(".container").css({minHeight:windowHeight+"px"});
	$("#show_profiles").css({maxHeight:(windowHeight -(windowHeight * .35))+"px"});
	
	//Make all modals max-height 80% of the window
	$("#confirmation_modal, #confirmed_modal, #registration_modal, #registered_modal, #all_registered_user, #phillyRegistrationForm, #errors_modal").css({maxHeight:(windowHeight * .80)+"px"});
	
	// Add new committee member row
	$('body').on('click', '.addCommitteeMember', function() {
		var newCommitteeRow = $('.committeeRow').clone();
		
		$(newCommitteeRow).removeClass('committeeRow')
			.removeAttr('hidden')
			.insertBefore('.committeeRow');
		$('.committeeRow').prev().find('select').focus();
	});
	
	// Button toggle switch
	$('body').on("click", "button", function(e) {
		if(!$(this).hasClass('btn-primary') || !$(this).hasClass('btn-danger')) {
			if($(this).children().val() == "Y") {
				$(this).addClass('active btn-success').children().attr("checked", true);
				$(this).siblings().addClass('btn-secondary').removeClass('active btn-danger').children().removeAttr("checked");
				
				// If this is the contacts page, toggle the addresses select div visibility
				if($('.tenantProp').length > 0) {
					$('.tenantProp').slideDown();
				}
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').children().attr("checked", true);
				$(this).siblings().addClass('btn-secondary').removeClass('active btn-success').children().removeAttr("checked");
				
				// If this is the contacts page, toggle the addresses select div visibility
				if($('.tenantProp').length > 0) {
					$('.tenantProp').slideUp();
				}
			}
		}	
	});
	
//Add button to users table
	addNewAdminBtn();
	removeMessages();	

//Bring up modal when page loads
	/*$("#overlay").fadeIn();
	$("#modal").show().animate({top:"3%"});*/

//Remove opening modal screen and give user option for music
	/*var openedByButton;
	$("body").on("click", "#takeLater_btn, #takeNow_btn", function(e)
	{	
		if($(this).attr("id") == "takeNow_btn")
		{
			window.open("philly2016.php", "Register");
			$("#modal").fadeOut(function(e){
				$("#survey_header").text("This website comes with music. Would you like for it to play?");
				$("#takeLater_btn").text("Yes").attr("id", "yes_music");
				$("#takeNow_btn").text("No").attr("id", "no_music");
				$("#yes_music").on("click", function()
				{
					$("<audio id='music_player' controls autoplay><source src='/music/blurred_lines.mp3' type='audio/mpeg'></audio>").appendTo("#reunion_descent");
					$("#modal").fadeOut();
					$("#overlay").fadeOut();
				});
				
				$("#no_music").on("click", function()
				{
					$("#modal").fadeOut();
					$("#overlay").fadeOut();
				});
				$("#modal").fadeIn();
			});
		}
		else
		{
			$("#modal").fadeOut(function(e){
				$("#survey_header").text("There is a recent family reunion news letter. Would you like to download it?");
				$("#takeLater_btn").text("Yes").attr("id", "yes_music");
				$("#takeNow_btn").text("No").attr("id", "no_music");
				$("#yes_music").on("click", function()
				{
					window.open("../files/Family_Reunion_Newsletter_2016.doc");
					$("#modal").fadeOut();
					$("#overlay").fadeOut();
				});
				
				$("#no_music").on("click", function()
				{
					$("#modal").fadeOut();
					$("#overlay").fadeOut();
				});
				$("#modal").fadeIn();
			});
		}
	});*/
	
//Gather home page pictures and create a slide show	
	current_pic = 0;
	var images = $(".image_div");
	var imagesHeader = $(".image_caption_header");
	$(".showing_image").show();	
	function slide_show()
	{
		if(current_pic >= images.length - 1)
		{
			current_pic = 0;
		}
		else
		{
			current_pic++;
		}
		
		$(".showing_image").fadeOut("slow", 
		function()
		{
			$(this).removeClass("showing_image");
			$(images[current_pic])
				.addClass("showing_image")
				.fadeIn("slow");
			$(imagesHeader[current_pic])
				.addClass("showing_image")
				.fadeIn("slow");	
		});
	}
	
	var start_show = setInterval(function()
	{
		slide_show();
	}, 7000);
	
//Make non-selected descent button disabled on form send
	$("body").on("click", "#submit_profile_update", function(e) {
		//e.preventDefault();
		$(".descentInput").attr("disabled", true);
		$(".descentInput.descentSelected").removeAttr("disabled");
	});

//Charlotte Coming Soon Page Animation
	var nextReunionElement = $(".nextReunion");
	$(nextReunionElement[0]).animate({top:"25%"}, 2000);
	$(nextReunionElement[1]).delay(1200).animate({top:"35%"}, 2000);
	$(nextReunionElement[2]).delay(1800).animate({top:"45%"}, 2000);
	$(nextReunionElement[3]).delay(2400).animate({top:"55%"}, 2000);
	$("#coming_soon_message p").delay(3100).animate({top:"5%"}, 2000);
	
//Show past family reunions links
	$("body").on("click", "#past_btn", function(e)
	{
		e.preventDefault();
		$("#past_reunions").slideToggle();
	});
		
//Search button background color
	$("#search_btn").focus(function()
	{
		$("#search_btn").css({"backgroundColor":"white"});
	});
//Adding and Editing users
	var $editUser_form = $("#editUser_form");
	var $newUser_form = $("#newUser_form");
	var $regMember_form = $("#editRegUser_form");
	var $newRegMember_form = $("#newRegUser_form");
//Add new user modal screen
	$("body").on("click", "#addNew_member", function()
	{	
		$editUser_form.detach();
		$regMember_form.detach();
		$newRegMember_form.detach();
		$newUser_form.detach();
		$(".modal_adminPage_header").show();
		$("#option1").text("Add New Family Member");
		$("#option2").text("Add New Philly Registration");
		$("#overlay_adminPage").fadeIn();
		$("#modal_adminPage").fadeIn();
		appendCloseBtn("addEdit_users");
	});
//Add new user modal screen
	$("body").on("click", "#add_new_admin_user_btn", function()
	{	
		$("#add_admin_user input, #delete_admin_user input").val("").removeClass("error_border good_border");
		$("#overlay_adminPage, #add_admin_user").fadeIn();
	});
//Bring up for to add new family member or a philly registration_modal
	$("body").on("click", "#option1, #option2", function(e){
		$(this).animate({margin:"-1% -1% 2%", padding:"3% 0%"});
		if($(this).attr("id") == "option1")
		{
			$("#option2").slideUp(function(){
				$($newUser_form).appendTo("#addEdit_users");
			});
		}
		else
		{
			$("#option1").slideUp(function(){
				$($newRegMember_form).appendTo("#addEdit_users");
			});
		}
	});
//Toggle registrations and member list views
	/*$("body").on("click", "#admin_nav_registrations, #admin_nav_members", function(e)
	{
		$("#search_btn").val("").keyup();
		if($(this).attr("id") == "admin_nav_registrations") {
			$("#demo_list").hide();
			$("#registered_members").show();
			$(this).addClass("active");
			$("#admin_nav_members").removeClass("active");
		}
		else {
			$("#demo_list").show();
			$("#registered_members").hide();
			$(this).addClass("active");
			$("#admin_nav_registrations").removeClass("active");
		}
	});*/
//Remove disabled options for additional_tees and fancy cut 
	$("body").on("change", "#additionalTeeOption, #fancyCutOption", function(e) {
		if($(this).val() == "Y") {
			$(this).parent().parent().find("input").removeAttr("disabled");
		}
		else {
			$(this).parent().parent().find("input").attr("disabled", true);
		}
	});

	// Toggle descent options
	$("body").on("click", ".descentInput", function(e) {
		e.preventDefault();
		$(this).addClass("active text-light").children().attr('checked', true);
		$(this).siblings().removeClass('active text-light').children().removeAttr('checked');
	});
	
	// Add Household Member Row
	$('body').on('click', '.addHHMember', function() {
		var hhMemberRow = $('.hhMemberRow').clone();
		$(hhMemberRow).addClass('d-flex').insertBefore($('.hhMemberRow')).removeClass('hidden hhMemberRow').find('select').focus();
	});
	
	// Add Child Member Row
	$('body').on('click', '.addChildrenRow', function() {
		var childrenRow = $('.childrenRow').clone();
		$(childrenRow).addClass('d-flex').insertBefore($('.childrenRow')).removeClass('hidden childrenRow').find('select').focus();
	});
	
	// Add Sibling Member Row
	$('body').on('click', '.addSiblingRow', function() {
		var siblingRow = $('.siblingRow').clone();
		$(siblingRow).addClass('d-flex').insertBefore($('.siblingRow')).removeClass('hidden siblingRow').find('select').focus();
	});
	
//Show current family member demographics for editing
	$("body").on("click", ".edit_user_btn", function(e)
	{				
		$newUser_form.detach();
		$newRegMember_form.detach();
		$regMember_form.detach();
		$("#addEdit_users").append($editUser_form);
		$("#option1, #option2").hide();
		var user_id = $(this).parents("tr").find(".editId input").val();
		var mr_first = $(this).parents("tr").find(".editMr").text();
		var ms_first = $(this).parents("tr").find(".editMs").text();
		var mrs_first = $(this).parents("tr").find(".editMrs").text();
		var user_lastname = $(this).parents("tr").find(".editLastname").text();
		var user_address = $(this).parents("tr").find(".editAddress").text();
		var user_city = $(this).parents("tr").find(".editCity").text();
		var user_state = $(this).parents("tr").find(".editState").text();
		var user_zip = $(this).parents("tr").find(".editZip").text();
		var user_phone = $(this).parents("tr").find(".editPhone").text();
		var user_notes = $(this).parents("tr").find(".editNotesData").text();
		var user_email = $(this).parents("tr").find(".editEmail").text();
		var mailPref = $(this).parents("tr").find(".mail_pref").text();
		function mailPref_check()
		{
			$("#mail_pref").attr({"disabled":false, "selected":false});
			$("#email_pref").attr({"disabled":false, "selected":false});
			if(mailPref == "Paper Mail")
			{
				$("#mail_pref").attr("selected", true);
				$("#email_pref").attr("selected", false);
			}
			else if(mailPref == "Email")
			{
				$("#email_pref").attr("selected", true);
				$("#mail_pref").attr("selected", false);
			}
			else
			{
				$("#email_pref").attr("selected", false);
				$("#mail_pref").attr("selected", false);
			}
		}		
		$("#eUser_id").val(user_id);
		$("#eMr_firstname").val(mr_first);
		$("#eMs_firstname").val(ms_first + mrs_first);		
		$("#eLastname").val(user_lastname);
		$("#eAddress").val(user_address);
		$("#eCity").val(user_city);
		$("#eState").val(user_state);
		$("#eZip").val(user_zip);
		$("#ePhone").val(user_phone);
		$("#eNotes").val(user_notes);
		$("#eEmail").val(user_email);
		mailPref_check();
		$("#option1").text("Edit Current Family Member").css({margin:"-1% -1% 5%", padding:"2% 0%"}).show();
		$("#overlay_adminPage").fadeIn();
		$("#modal_adminPage").fadeIn();
		appendCloseBtn("addEdit_users");
	});
	
//Show registered family members registration information for editing
	$("body").on("click", ".edit_RegMemData_btn", function(e)
	{
		$newUser_form.detach();
		$newRegMember_form.detach();
		$editUser_form.detach();
		$("#option1, #option2").hide();
		$("#addEdit_users").append($regMember_form);
		var reg_id = $(this).parents("tr").find(".editRegId input").val();
		var registree_name = $(this).parents("tr").find(".editRegistree").text();
		var attending_adults = $(this).parents("tr").find(".editRegAdults").text();
		var attending_youths = $(this).parents("tr").find(".editRegYouths").text();
		var attending_children = $(this).parents("tr").find(".editRegChildren").text();
		var shirt_sizes = $(this).parents("tr").find(".editRegSS").text();
		var additional_tees = $(this).parents("tr").find(".editRegAT").text();
		var girly_tees = $(this).parents("tr").find(".editRegGT").text();
		var total_adults = $(this).parents("tr").find(".editRegTA").text();
		var total_youth = $(this).parents("tr").find(".editRegTY").text();
		var total_children = $(this).parents("tr").find(".editRegTC").text();
		var reg_address = $(this).parents("tr").find(".editRegAdd").text();
		var reg_email = $(this).parents("tr").find(".editRegEmail").text();
		var reg_phone = $(this).parents("tr").find(".editRegPhone").text();
		var reg_date = $(this).parents("tr").find(".editRegDate").text();	
		var reg_due = $(this).parents("tr").find(".editRegDue").text();
			reg_due = reg_due.slice(1);
		var reg_paid = $(this).parents("tr").find(".editRegPaid").text();
			reg_paid = reg_paid.slice(1);
		var reg_notes = $(this).parents("tr").find(".editRegNotesData").text();
		$("#eRegUserID").val(reg_id);
		$("#eMemberName").val(registree_name);
		$("#eMemberAdult").val(attending_adults);
		$("#eMemberYouth").val(attending_youths);		
		$("#eMemberChildren").val(attending_children);		
		$("#eMemberShirt").val(shirt_sizes);
		$("#eAddtTees").val(additional_tees);
		$("#eGCTees").val(girly_tees);
		$("#eNumAdults").val(total_adults);
		$("#eNumYouth").val(total_youth);
		$("#eNumChildren").val(total_children);
		$("#eMemberAddress").val(reg_address);
		$("#eMemberEmail").val(reg_email);
		$("#eMemberPhone").val(reg_phone);
		$("#eMemberNotes").val(reg_notes);
		$("#eMemberAmountDue").val(reg_due);
		$("#eMemberAmountPaid").val(reg_paid);
		$("#option1").text("Edit Registration").css({margin:"-1% -1% 2%", padding:"3% 0%"}).show();
		$("#modal_adminPage, #overlay_adminPage").fadeIn();	
		appendCloseBtn("addEdit_users");
	});
	
//Add new admin user
	$("body").on("click", ".add_adminUser_btn", function(e) {
		e.preventDefault();
		var names = nameCheck($("form#add_adminUser_form input:nth-of-type(1)"), $("form#add_adminUser_form input:nth-of-type(2)"));
		var username = usernameCheck($("form#add_adminUser_form input:nth-of-type(3)"));
		var password = passwordCheck($("form#add_adminUser_form input:nth-of-type(4)"));
		var totalErrors = name + username + password;
		if(totalErrors > 0) {
			console.log("Errors showing");
		} else {
			$.post("addNew_user.php", $("#add_adminUser_form").serialize(), function(data, status) {
				getUpdatedUsersTable();
			});
		}
	});
//Add new admin user
	$("body").on("click", ".delete_adminUser_btn", function(e) {
		e.preventDefault();
		var names = nameCheck($("form#delete_adminUser_form input:nth-of-type(1)"), $("form#delete_adminUser_form input:nth-of-type(2)"));
		var username = usernameCheck($("form#delete_adminUser_form input:nth-of-type(3)"));
		var password = passwordCheck($("form#delete_adminUser_form input:nth-of-type(4)"));
		var totalErrors = name + username + password;
		if(totalErrors > 0) {
			console.log("Errors showing");
		} else {
			$.post("deleteNew_user.php", $("#delete_adminUser_form").serialize(), function(data, status) {
				getUpdatedUsersTable();
			});
		}
	});
//Edit admin user
	$("body").on("click", ".edit_adminUser_btn", function(e) {
		e.preventDefault();
		var names = nameCheck($("form#edit_adminUser_form input:nth-of-type(1)"), $("form#edit_adminUser_form input:nth-of-type(2)"));
		var username = usernameCheck($("form#edit_adminUser_form input:nth-of-type(3)"));
		var password = passwordCheck($("form#edit_adminUser_form input:nth-of-type(4)"));
		var totalErrors = name + username + password;
		if(totalErrors > 0) {
			console.log("Errors showing");
		} else {
			$.post("editNew_user.php", $("#edit_adminUser_form").serialize(), function(data, status) {
				getUpdatedUsersTable();
			});
		}
	});	
	
//Add new member
	$("body").on("click", ".submit_new", function(e)
	{
		e.preventDefault();
		$.post("addNew_member.php", $("#newUser_form").serialize(), function(data, status)
		{			
			$.ajax({url:"jg_admin.php", cache: false})
				.done(function(data) {
					var returnedData = data;
					var newRegMembersData = $(returnedData).find("#demo_list");
					$("#display_all_users").html(newRegMembersData);
				}
			);
			$("#modal_confirmation p").html(data);
			if($("#admin_nav_registrations").hasClass("active")) {
				window.open("jg_admin.php", "_self");
			}
		});
		
		$("#modal_adminPage").fadeOut(function() {
			$("#modal_confirmation").fadeIn();
		});
	});
	
//Add new member to database and clear form
	$("body").on("click", ".submit_another", function(e)
	{
		$.post("addNew_member.php", 
			$("#newUser_form").serialize(), 
			function(data)
			{			
				$("#modal_confirmation p").html(data);
				$.get("jg_admin.php", function(returnData){
						var newData = $(returnData).find("#demo_list_table");
						$("#demo_list").html(newData);	
					});
				setTimeout(function()
				{
					$("#modal_confirm_another").show().animate({top:"0.3%"});
				}, 0);
				setTimeout(function()
				{
					$("#modal_confirm_another").animate({top:"-20%"}).fadeOut();
				}, 2000);
			}
		);
		e.preventDefault();
		$("input[type='text'], input[type='email']").val("");
	});
	
//Edit current member information and add to database
	$("body").on("click", ".submit_edit", function(e)
	{	
		e.preventDefault();
		$.post("updateCurrent_user.php", 
			$("#editUser_form").serialize(), 
			function(data)
			{	
				$.ajax({url:"jg_admin.php", cache: false})
					.done(function(data) {
						var returnedData = data;
						var newRegMembersData = $(returnedData).find("#demo_list");
						$("#display_all_users").html(newRegMembersData);
					}
				);	
				
				$("#modal_adminPage").fadeOut(function() { 
					$("#modal_confirmation").fadeIn();
					appendCloseBtn("addEdit_users");
				});
				$(".updatedUser_data").html(data);			
			}
		);	
	});		
//Edit registered users information and add to the database
	$("body").on("click", ".submit_RegEdit", function(e)
	{		
		e.preventDefault();
		$.post("updateCurrent_regUser.php", 
			$("#editRegUser_form").serialize(), 
			function(data)
			{	
				$.ajax({url:"jg_admin_registrations.php", cache: false})
					.done(function(data) {
						var returnedData = data;
						var newRegMembersData = $(returnedData).find("#registered_members");
						$("#display_all_users").html(newRegMembersData);
					}
				);
				$("#modal_adminPage").fadeOut(function() { 
					$("#modal_confirmation").fadeIn();
					appendCloseBtn("addEdit_users");
				});
				$(".updatedUser_data").html(data);			
			}
		);					
	});
	
//Confirm completion of editing and upload new data to page
	$("body").on("click", ".close_modal", function(e)
	{
		$("#overlay_adminPage, #modal_confirmation").fadeOut(function(){
			$("#option1, #option2").css({margin:"5% 0%", padding:"5% 0%"});
		});
	});
	$("body").on("click", "#close_registered_users", function(e)
	{
		$("#overlay_PhillyPage, #registered_modal").fadeOut();
	});
	
//Edit admin user information
	$("body").on("click", ".editable, .deleteAdminUser", function(e) {
		var userNameValues = $(this).parents("tr").find(".adminUserName").val().split(" ");
		var userLogIn = $(this).parents("tr").find(".adminUserLogIn").val();	  
		var userID = $(this).parents("tr").find(".adminUserID").val();
		if($(this).attr("class") == "editable") {
			$("#edit_adminUser_form input:first-of-type").val(userNameValues[0]);
			$("#edit_adminUser_form input:nth-of-type(2)").val(userNameValues[1]);
			$("#edit_adminUser_form input:nth-of-type(3)").val(userLogIn);
			$("#edit_adminUser_form input:nth-of-type(5)").val(userID);
			$("#overlay_adminPage, #edit_admin_user").fadeIn();
		} else {
			$("#delete_adminUser_form input:first-of-type").val(userNameValues[0]);
			$("#delete_adminUser_form input:nth-of-type(2)").val(userNameValues[1]);
			$("#delete_adminUser_form input:nth-of-type(3)").val(userLogIn);
			$("#delete_adminUser_form input:nth-of-type(4)").val(userID);
			$("#overlay_adminPage, #delete_admin_user").fadeIn();
		}
	});
//Change color of input text when changed
	$("body").on("change", "form#edit_adminUser_form input", function(e) {
		var names = nameCheck($("form#edit_adminUser_form input:nth-of-type(1)"), $("form#edit_adminUser_form input:nth-of-type(2)"));
		var username = usernameCheck($("form#edit_adminUser_form input:nth-of-type(3)"));
		var password = passwordCheck($("form#edit_adminUser_form input:nth-of-type(4)"));
		var totalErrors = names + username + password;
		switch(totalErrors) {
			case 1:
				
				break;
			case 2:
				
				break;
			case 3:
				
				break;
			case 4:
				
				break;
			default:
				
				break;
		}
	});
	$("body").on("change", "form#add_adminUser_form input", function(e) {
		var names = nameCheck($("form#add_adminUser_form input:nth-of-type(1)"), $("form#add_adminUser_form input:nth-of-type(2)"));
		var username = usernameCheck($("form#add_adminUser_form input:nth-of-type(3)"));
		var password = passwordCheck($("form#add_adminUser_form input:nth-of-type(4)"));
		var totalErrors = names + username + password;
		switch(totalErrors) {
			case 1:
				
				break;
			case 2:
				
				break;
			case 3:
				
				break;
			case 4:
				
				break;
			default:
				
				break;
		}
	});
		
//Remove registration from the database
	$("body").on("click", ".delete_RegMemData_btn", function(e)
	{
		$newUser_form.detach();
		$newRegMember_form.detach();
		$editUser_form.detach();
		$("#option1, #option2").hide();
		var reg_id = $(this).parents("tr").find(".editRegId input").val();
		var registree_name = $(this).parents("tr").find(".editRegistree").text();
		var attending_adults = $(this).parents("tr").find(".editRegAdults").text();
		var attending_youths = $(this).parents("tr").find(".editRegYouths").text();
		var attending_children = $(this).parents("tr").find(".editRegChildren").text();
		var shirt_sizes = $(this).parents("tr").find(".editRegSS").text();
		var additional_tees = $(this).parents("tr").find(".editRegAT").text();
		var girly_tees = $(this).parents("tr").find(".editRegGT").text();
		var total_adults = $(this).parents("tr").find(".editRegTA").text();
		var total_youth = $(this).parents("tr").find(".editRegTY").text();
		var total_children = $(this).parents("tr").find(".editRegTC").text();
		var reg_address = $(this).parents("tr").find(".editRegAdd").text();
		var reg_email = $(this).parents("tr").find(".editRegEmail").text();
		var reg_phone = $(this).parents("tr").find(".editRegPhone").text();
		var reg_date = $(this).parents("tr").find(".editRegDate").text();	
		var reg_due = $(this).parents("tr").find(".editRegDue").text();
			reg_due = reg_due.slice(1);
		var reg_paid = $(this).parents("tr").find(".editRegPaid").text();
			reg_paid = reg_paid.slice(1);
		var reg_notes = $(this).parents("tr").find(".editRegNotesData").text();	
		$("#dRegUserID").val(reg_id);
		$("#dMemberName").val(registree_name);
		$("#dMemberAddress").val(reg_address);
		$("#dMemberEmail").val(reg_email);
		$("#dMemberPhone").val(reg_phone);
		$("#dMemberNotes").val(reg_notes);
		$("#dMemberAdult").val(attending_adults);
		$("#dNumAdults").val(total_adults);
		$("#dMemberYouth").val(attending_youths);
		$("#dNumYouth").val(total_youth);
		$("#dMemberChildren").val(attending_children);
		$("#dNumChildren").val(total_children);
		$("#dMemberShirt").val(shirt_sizes);
		$("#dAddtTees").val(additional_tees);
		$("#dGCTees").val(girly_tees);
		$("#dMemberAmountDue").val(reg_due);
		$("#overlay_adminPage").fadeIn();
		$("#modal_confirm_reg_delete").fadeIn();
		$(".no_delete").on("click", function(e)
		{
			$("#overlay_adminPage").fadeOut();
			$("#modal_confirm_reg_delete").fadeOut();
		});
	});
	$("body").on("click", ".yes_delete", function(e)
	{
		if($("#registered_members:visible").length > 0) {
			$.post("deleteCurrent_registration.php", $("#deleteReg_form").serialize(), function(data)
			{	
				$("#modal_confirm_reg_delete").fadeOut(function() { 
					$("#modal_confirmation").fadeIn();
				});
				$("#modal_confirmation p").text(data);
				$.ajax({url:"jg_admin_registrations.php", cache: false})
					.done(function(data) {
						var returnedData = data;
						var newRegMembersData = $(returnedData).find("#registered_members");
						$("#display_all_users").html(newRegMembersData);
					}
				);	
			});	
		}
		else if($("#demo_list:visible").length > 0) {
			$(".yes_delete").on("click", function(e)
			{
				$.post("deleteCurrent_user.php", $("#deleteUser_form").serialize(), function(data)
				{	
					$("#modal_confirm_delete").fadeOut(function() {
						$("#modal_confirmation").fadeIn()
					});
					$("#modal_confirmation p").text(data);
					$.ajax({url:"jg_admin.php", cache: false})
						.done(function(data) {
							var returnedData = data;
							var newRegMembersData = $(returnedData).find("#demo_list");
							$("#display_all_users").html(newRegMembersData);
						}
					);			
				});			
			});
		}					
	});
	
//Remove user from the database
	$("body").on("click", ".delete_user_btn", function(e)
	{
		var user_id = $(this).parents("tr").find(".editId input").val();
		var mr_first = $(this).parents("tr").find(".editMr").text();
		var ms_first = $(this).parents("tr").find(".editMs").text();
		var mrs_first = $(this).parents("tr").find(".editMrs").text();
		var user_lastname = $(this).parents("tr").find(".editLastname").text();
		var user_address = $(this).parents("tr").find(".editAddress").text();
		var user_city = $(this).parents("tr").find(".editCity").text();
		var user_state = $(this).parents("tr").find(".editState").text();
		var user_zip = $(this).parents("tr").find(".editZip").text();
		var user_phone = $(this).parents("tr").find(".editPhone").text();
		var user_notes = $(this).parents("tr").find(".editNotesData").text();
		var user_email = $(this).parents("tr").find(".editEmail").text();
		var mailPref = $(this).parents("tr").find(".mail_pref").text();	
		$("#dUser_id").val(user_id);
		$("#dMr_firstname").val(mr_first);
		$("#dMs_firstname").val(ms_first + mrs_first);		
		$("#dLastname").val(user_lastname);
		$("#dAddress").val(user_address);
		$("#dCity").val(user_city);
		$("#dState").val(user_state);
		$("#dZip").val(user_zip);
		$("#dEmail").val(user_email);
		$("#dPhone").val(user_phone);
		$("#dNotes").val(user_notes);
		$("#overlay_adminPage").fadeIn();
		$("#modal_confirm_delete").fadeIn();
		$(".no_delete").on("click", function(e)
		{
			$("#overlay_adminPage").fadeOut();
			$("#modal_confirm_delete").fadeOut();
		});
	});
	
//Add scroll to the top button
	$(window).scroll(function()
	{
		var containerHeight = $("#container").innerHeight();
		var containerHeight90 = (Number(window.pageYOffset) + Number(window.innerHeight));
		if(window.pageYOffset >= 300) {
			if(containerHeight90 >= (containerHeight - 200)) {
				$("#scroll_to_top").fadeOut("slow");
			} else {
				$("#scroll_to_top").show("slow");
			}
		}	
		if(window.pageYOffset < 300){
			$("#scroll_to_top").hide("slow");
		}
	});
	
//Scroll to the top of the page
	$("body").on("click", "#scroll_to_top", function(e)
	{
		var body = document.body;
		$(body).animate({scrollTop:$(body).offset().top}, "slow");
	});
	
//Show registration form
	$("body").on("click", "#registrationFormSpan, #registrationLink", function(e)
	{
		$("#registration_modal, #overlay_PhillyPage").show("fast", function(event)
		{
			$("#registration_modal").animate({top:"1%"});
			var tableInputWidth = $(".table_input").width();
			$("#registrationFormTable th:not(#registrationFormTable th:first-of-type)").css({"width":tableInputWidth+"px"});
			$("#name").focus();
		});
	});
//Show who has registered
	$("body").on("click", "#registeredUsersSpan", function(e)
	{
		$("#overlay_PhillyPage, #registered_modal").fadeIn();
	});	
//Bring up news letter
	$("body").on("click","#newsLetterSpan", function(){
		window.open("../files/Family_Reunion_Newsletter_2016.doc", "_blank");
	});
	
//Bring up directions to the hotel
	$("body").on("click", "#directions_link", function(e){
		$("#overlay_PhillyPage").fadeIn();
		$("#hotel_directions").appendTo("#modals_div").show(function(){
			addDirections();
		});
	});
	
//Add total amounts to pay for registration
	$("body").on("change", "#attending_adult, #attending_youth, #attending_children, #addt_tee_table input, #fancy_cut_table input", function(e)
	{
		var attendingNumA = $("#attending_adult").val();
		var attendingNumY = $("#attending_youth").val();
		var attendingNumC = $("#attending_children").val();
		var addtTee = getAddtTeeCount("#addt_tee_table input");
		var addtTeeGC = getAddtTeeCount("#fancy_cut_table input"); 
		var totalAmountA = Number(attendingNumA * 100);
		var totalAmountY = Number(attendingNumY * 75);
		var totalAmountC = Number(attendingNumC * 20);
		var totalAmountAddtTee = Number(addtTee * 15);
		var totalAmountFC = Number(addtTeeGC * 5);
		var totalDue = Number(totalAmountA + totalAmountY + totalAmountC + totalAmountAddtTee + totalAmountFC);
		$("#total_adult").val(totalAmountA);
		$("#total_youth").val(totalAmountY);
		$("#total_children").val(totalAmountC);
		$("#total_amount_due").val(totalDue);
	});
	
//Add name rows for adults
	$("body").on("change", "#attending_adult", function(e)
	{
		var attendingNumA = Number($("#attending_adult").val());
		$(".attending_adult_row").remove();
		var counter;
		
		for(counter = 0; counter < attendingNumA; counter++)
		{
			var tableInputWidth = $(".table_input").width();
			var addtRow  = "<tr class='attending_adult_row'><td></td><td></td>";
				addtRow += "<td><input type='text' name='attending_adult_name[]' class='attending_adult_name' placeholder='Adult Name' /></td>"
				addtRow += "<td><select name='shirt_size[]' class='shirt_size'>";
				addtRow += "<option value='none' name='shirt_size_option'>T-Shirt Size</option>";
				addtRow += "<option value='small' name='shirt_size_option'>Small</option>";
				addtRow += "<option value='medium' name='shirt_size_option'>Medium</option>";
				addtRow += "<option value='large' name='shirt_size_option'>Large</option>";
				addtRow += "<option value='xl' name='shirt_size_option'>XL</option>";
				addtRow += "<option value='xxl' name='shirt_size_option'>XXL</option>";
				addtRow += "<option value='3xl' name='shirt_size_option'>3XL</option>";
				addtRow += "<option value='4xl' name='shirt_size_option'>4XL</option>";
				addtRow += "</select></td></tr>";
			$(addtRow).insertAfter("#adult_row");
			$(".attending_adult_row").show();
			$(".attending_adult_name, .shirt_size").css({"width":tableInputWidth+"px"});
		}
	});
	
//Add name rows for youths
	$("body").on("change", "#attending_youth", function(e)
	{
		var attendingNumY = Number($("#attending_youth").val());
		var counter;
		$(".attending_youth_row").remove();
		
		if(attendingNumY == 0){
			var defaultRow = "<tr id='attending_youth_row_default' class='attending_youth_row'><td></td><td></td><td><input type='text' name='attending_youth_name[]' class='attending_youth_name' placeholder='Youth Name' value='Youth'/></td></tr>";
			$(defaultRow).insertAfter("#youth_row");
		}
		
		for(counter = 0; counter < attendingNumY; counter++)
		{
			var tableInputWidth = $(".table_input").width();
			var addtRow  = "<tr class='attending_youth_row'><td></td><td></td>";
				addtRow += "<td><input type='text' name='attending_youth_name[]' class='attending_youth_name' placeholder='Youth Name'/></td>";
				addtRow += "<td><select name='shirt_size[]' class='shirt_size'>";
				addtRow += "<option value='none' name='shirt_size_option'>T-Shirt Size</option>";
				addtRow += "<option value='small' name='shirt_size_option'>Small</option>";
				addtRow += "<option value='medium' name='shirt_size_option'>Medium</option>";
				addtRow += "<option value='large' name='shirt_size_option'>Large</option>";
				addtRow += "<option value='xl' name='shirt_size_option'>XL</option>";
				addtRow += "<option value='xxl' name='shirt_size_option'>XXL</option>";
				addtRow += "<option value='3xl' name='shirt_size_option'>3XL</option>";
				addtRow += "<option value='4xl' name='shirt_size_option'>4XL</option>";
				addtRow += "<option value='ksmall' name='shirt_size_option'>Kid - Small</option>";
				addtRow += "<option value='kmedium' name='shirt_size_option'>Kid - Medium</option>";
				addtRow += "<option value='klarge' name='shirt_size_option'>Kid - Large</option>";
				addtRow += "</select></td></tr>";
			$(addtRow).insertAfter("#youth_row");
			$(".attending_youth_row").show();
			$(".attending_youth_name, .shirt_size").css({"width":tableInputWidth+"px"});
		}
	});
	
//Add name rows for children
	$("body").on("change", "#attending_children", function(e)
	{
		var attendingNumC = Number($("#attending_children").val());
		var counter;
		$(".attending_children_row").remove();
		
		if(attendingNumC == 0){
			var defaultRow = "<tr id='attending_children_row_default' class='attending_children_row'><td></td><td></td><td><input type='text' name='attending_children_name[]' class='attending_children_name' placeholder='Child Name' value='Child' /></td></tr>";
			$(defaultRow).insertAfter("#children_row");
		}
		
		for(counter = 0; counter < attendingNumC; counter++)
		{
			var tableInputWidth = $(".table_input").width();
			var addtRow  = "<tr class='attending_children_row'><td></td><td></td>";
				addtRow += "<td><input type='text' name='attending_children_name[]' class='attending_children_name' placeholder='Child Name'/></td>";
				addtRow += "<td><select name='shirt_size[]' class='shirt_size'>";
				addtRow += "<option value='none' name='shirt_size_option'>T-Shirt Size</option>";
				addtRow += "<option value='ksmall' name='shirt_size_option'>Kid - Small</option>";
				addtRow += "<option value='kmedium' name='shirt_size_option'>Kid - Medium</option>";
				addtRow += "<option value='klarge' name='shirt_size_option'>Kid - Large</option>";
				addtRow += "</select></td></tr>";
			$(addtRow).insertAfter("#children_row");
			$(".attending_children_row").show();
			$(".attending_children_name, .shirt_size").css({"width":tableInputWidth+"px"});
		}
	});
	
//Show additional options on registration form
	$("body").on("click", "#addtionalOptionsBtn", function(e)
	{
		e.preventDefault();
		$(".addtionalOptionsRow").slideToggle("fast");
		$("table#addtionalOptionsTable").toggleClass("addPadding");
	});
	
//Cancel Registration Form
	$("body").on("click", "#close_registered_modal, #overlay_PhillyPage", function(e)
	{
		$("#overlay_PhillyPage, #registration_modal, #registered_modal, #confirmation_modal").fadeOut(function(e){ 
			$("#overlay_PhillyPage").css({"z-index":"5"});
			$("#errors_modal_contentP").empty();
			$("#errors_modal").hide();
			$("#registration_modal input").removeClass("error_border");
		});
	});
//Switch registration forms
	$("body").on("click", "#switchToMember, #switchToReg", function(e) {
		if($(this).attr("id") == "switchToReg") {
			$("#modal_adminPage").fadeOut(function() {
				$("#option1").hide();
				$("#option2").css({margin:"-1% -1% 2%", padding:"3% 0%"}).show();
				$newUser_form.detach();
				$("#addEdit_users").append($newRegMember_form);
			});
			setTimeout(function() {
				$("#modal_adminPage").fadeIn();
			}, 500);
		} else {
			$("#modal_adminPage").fadeOut(function() {
				$("#option2").hide();
				$("#option1").css({margin:"-1% -1% 2%", padding:"3% 0%"}).show();
				$newRegMember_form.detach();
				$("#addEdit_users").append($newUser_form);
			});
			setTimeout(function() {
				$("#modal_adminPage").fadeIn();
			}, 500);
		}
	});
	
//Submit registration form button
	$("body").on("click", "#submitRegistration", function(e)
	{
		e.preventDefault();
		var memberName = $("#name").val();
		var memberAddress = $("#address").val();
		var memberPhone = $("#phone").val();
		var memberEmail = $("#email").val();
		var attendingAdults = $("#attending_adult").val();
		var attendingYouth = $("#attending_youth").val();
		var attendingChildren = $("#attending_children").val();
		var addtTee = getAddtTeeCount("#addt_tee_table input");		
		var addtTeeGC = getAddtTeeCount("#fancy_cut_table input");
		var adultMembersRows = $(".attending_adult_row");
		var	youthMembersRows = $(".attending_youth_row");
		var	childrenMembersRows = $(".attending_children_row");
		var totalAmountDue = $("#total_amount_due").val();
		var $adultsNames = $(".attending_adult_name");
		var $youthsNames = $(".attending_youth_name");
		var $childsNames = $(".attending_children_name");
		$(".confirm_name").text(memberName);
		$(".confirm_address").text(memberAddress);
		$(".confirm_phone").text(memberPhone);
		$(".confirm_email").text(memberEmail);
		$(".confirm_adults").text(attendingAdults);
		$(".confirm_youth").text(attendingYouth);
		$(".confirm_children").text(attendingChildren);
		$(".confirm_addtTee").text(addtTee);
		$(".confirm_gcTee").text(addtTeeGC);
		$(".confirm_total").text("$"+totalAmountDue);
		
		errorCheck(memberName, memberAddress, memberPhone, memberEmail, attendingAdults, $adultsNames, $youthsNames, $childsNames);
		if(errors > 0)
		{
			$("#errors_modal").show();
		}
		else
		{
			$("#confirmation_modal").show(function(event)
			{
				$("#confirmation_modal").animate({top:"2%"}, function()
				{
					$(adultMembersRows).each(function(e)
					{
						$(this).appendTo(".confirm_attendees");
						$(this).find("input, option").attr("disabled", true);
					});
					$(youthMembersRows).each(function(e)
					{
						$(this).appendTo(".confirm_attendees");
						$(this).find("input, option").attr("disabled", true);
					});	
					$(childrenMembersRows).each(function(e)
					{
						$(this).appendTo(".confirm_attendees");
						$(this).find("input, option").attr("disabled", true);
					});
				}).css({"z-index":"8"});
				$("#overlay_PhillyPage").css({"z-index":"7"});
			});
			
			$(".editFormBtn").on("click", function(event)
			{
				var adultMembersRowsConfirm = $("div#confirmation_modal .attending_adult_row");
				var	youthMembersRowsConfirm = $("div#confirmation_modal .attending_youth_row");
				var	childrenMembersRowsConfirm = $("div#confirmation_modal .attending_children_row");
				$(adultMembersRowsConfirm).each(function(e)
				{
					$(this).insertBefore("#youth_row");
					$(this).find("input, option").removeAttr("disabled");
				});
				$(youthMembersRowsConfirm).each(function(e)
				{
					$(this).insertBefore("#children_row");
					$(this).find("input, option").removeAttr("disabled");
				});	
				$(childrenMembersRowsConfirm).each(function(e)
				{
					$(this).insertBefore("#totalDue_row");
					$(this).find("input, option").removeAttr("disabled");
				});
				$("#confirmation_modal").animate({top:"-20%"}, function(){ $("#confirmation_modal").hide(); }).css({"z-index":"1"});
				$("#overlay_PhillyPage").css({"z-index":"5"});
				$(".confirm_attendees *:not(caption)").remove();
			});
		}
	});
	
//Submit registration form
	$("body").on("click", "#confirmFormBtn, .submit_RegNew, .submit_RegAndNew", function(e)
	{
		e.preventDefault();
		if($(this).attr("id") == "confirmFormBtn") {
			var adultMembersRowsConfirm = $("div#confirmation_modal .attending_adult_row");
			var	youthMembersRowsConfirm = $("div#confirmation_modal .attending_youth_row");
			var	childrenMembersRowsConfirm = $("div#confirmation_modal .attending_children_row");
			$(this).attr("disabled", true);
			$("#total_amount_due").removeAttr("disabled");
			$(adultMembersRowsConfirm).each(function(e)
			{
				$(this).insertBefore("#youth_row");
				$(this).find("input, option").removeAttr("disabled");
			});
			$(youthMembersRowsConfirm).each(function(e)
			{
				$(this).insertBefore("#children_row");
				$(this).find("input, option").removeAttr("disabled");
			});	
			$(childrenMembersRowsConfirm).each(function(e)
			{
				$(this).insertBefore("#totalDue_row");
				$(this).find("input, option").removeAttr("disabled");
			});
			$("#confirmation_modal, #registration_modal").animate({top:"-25%"}, function(){
				$("#registration_modal .attending_children_row, #registration_modal .attending_adult_row, #registration_modal .attending_youth_row").remove();
				$("#overlay_PhillyPage").css({"z-index":"5"});
			});
			$.post("jgreunion_philly_registration.php", $("#registrationForm").serialize(), function(data)
			{
				$("#registration_modal input").val("");
				$("#total_amount_due").attr("disabled", true);
				$("#confirmed_modal").append(data);
				$("#confirmFormBtn").removeAttr("disabled");
				window.scrollTo(0, 0);
			});
		}
		else if($(this).attr("class") == "submit_RegNew") {
			$.post("jg_admin_philly_registration.php", 
				$("#newRegUser_form").serialize(), 
				function(data)
				{
					$("#newRegUser_form input, #newRegUser_form textarea").val("");
					$(".updatedUser_data").text(data);
					$("#modal_adminPage").fadeOut(function(){
						$("#modal_confirmation").fadeIn();
					});
					if($("#admin_nav_members").hasClass("active")) {
						window.open("jg_admin_registrations.php", "_self");
					}
				}
			);
		}
		else {
			$.post("jg_admin_philly_registration.php", 
				$("#newRegUser_form").serialize(), 
				function(data)
				{
					$("#newRegUser_form input, #newRegUser_form textarea").val("");
					$("#modal_confirmation p").html(data);
					$.get("jg_admin.php", function(returnData){
						var newData = $(returnData).find("#registered_members_table");
						$("#registered_members").html(newData);	
					});
					setTimeout(function()
					{
						$("#modal_confirm_another").show().animate({top:"0.3%"});
					}, 0);
					setTimeout(function()
					{
						$("#modal_confirm_another").animate({top:"-20%"}).fadeOut();
					}, 2000);
				}
			);
		}
	});	
//Remove Error Border
	$("body").on("focus", "#registration_modal input", function(e)
	{
		$(this).removeClass("error_border");
		$("#errors_modal").fadeOut(function(){ $("errors_modal_contentP").empty(); });
	});
	
//Remove Overlay
	$("body").on("click", "#overlay_adminPage, #overlay_PhillyPage, #close_directions, .cancel_edit, .closeBtn", function(){
		removeOverlay();
	});
//Search option box
	$("#search_btn").keyup(function(e){
		if($("#admin_nav_registrations").hasClass("active")) {
			startSearch("#registered_members_table");
		}
		else {
			startSearch("#demo_list_table");
		}
	});
//Slide show	
	/*$("#stop_slideshow").on("click", function()
	{
		clearInterval(start_show);
		$("#slideshow_left").fadeIn("fast");
		$("#slideshow_right").fadeIn("fast");
		$("#stop_slideshow").fadeOut("fast");
	});
	
	$("#slideshow_left").on("click", function()
	{
		if(current_pic <= 0)
		{
			current_pic = 4;
		}
		else
		{
			current_pic--;
		}
		
		$("#showing_image").fadeOut("slow", function(){$("#showing_image").attr("src", images[current_pic])});
		$("#showing_image").fadeIn("slow");	
	});
	
	$("#slideshow_right").on("click", function()
	{
		if(current_pic >= 4)
		{
			current_pic = 0;
		}
		else
		{
			current_pic++;
		}
		
		$("#showing_image").fadeOut("slow", function(){$("#showing_image").attr("src", images[current_pic])});
		$("#showing_image").fadeIn("slow");	
	});*/
	
});

// Add individual member to household
function addToHouseHold(dlID, memberID) {
	$.ajax({
	  method: "PUT",
	  url: "/members/" + memberID + "/add_house_hold",
	  data: {houseMember:memberID, reunion_dl:dlID}
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var newData = $(data).find('.houseHoldBlock');
		var currentHHBlock = $('.houseHoldBlock');
		
		$(currentHHBlock).fadeOut(function() {
			$(newData).addClass('hidden');
			$(newData).insertAfter('.familyTreeGroup').fadeIn(function() {
				$(currentHHBlock).remove();				
			});
		});
	});
}

// Remove individual member from household
function removeFromHouseHold() {
	event.preventDefault();
	
	$.ajax({
	  method: "POST",
	  url: "/contacts",
	  data: $('#contact_add').serialize()
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var newData = $(data);
		
		$("#welcome_modal .modal-content").fadeOut(function() {
			$("#welcome_modal .modal-content").html(newData);
			$("#welcome_modal").modal('hide');
			
			setTimeout(function() {
				$("#welcome_modal .modal-content").fadeIn(function() {
				$("#welcome_modal").modal('show');
					setTimeout(function() {
						$("#welcome_modal").modal('toggle');
						$(".modal-backdrop").remove();
					}, 5000);
				});
			}, 500);
		});
	});
}

//Check for errors function
	var errors;
	function errorCheck(regName, regAdd, regPhone, regEmail, numAdults, adultName, youthName, childName) {
		var errors = 0;
		$("#errors_modal_contentP").empty();
		$("#registration_modal input").removeClass("error_border");
		var phoneRegrex = /^([0-9]{3})?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		var errorMsg = "";
		if(regName == "" || regName == null){
			errors++;
			errorMsg += errors + ". Registers name cannot be blank.<br/>";
			$("#name").addClass("error_border");
		}
		if(regAdd == "" || regAdd == null){
			errors++;
			errorMsg += errors + ". Registers address cannot be blank.<br/>";
			$("#address").addClass("error_border");
		}
		if(regPhone == "" || regPhone == null){
			errors++;
			errorMsg += errors + ". Registers phone number cannot be blank.<br/>";
			$("#phone").addClass("error_border");
		}
		if(!regPhone.match(phoneRegrex) && regPhone != "") {
			errors++;
			errorMsg += errors + ". Please enter phone number in this format XXX-XXX-XXXX.<br/>";
			$("#phone").addClass("error_border");
		}
		if(regEmail == "" || regEmail == null){
			errors++;
			errorMsg += errors + ". Registers email cannot be blank.<br/>";
			$("#email").addClass("error_border");
		}
		for(var i = 0; i < adultName.length; i++) {
			if($(adultName[i]).val() == "") {
				errors++;
				errorMsg += errors + ". Adult name cannot be blank.<br/>";
				$(adultName[i]).addClass("error_border");
			}
		}
		
		for(var i = 0; i < youthName.length; i++) {
			if($(youthName[i]).val() == "") {
				errors++;
				errorMsg += errors + ". Youth's' cannot be blank.<br/>";
				$($(youthName[i])).addClass("error_border");
			}
		}
		for(var i = 0; i < childName.length; i++) {
			if($(childName[i]).val() == "") {
				errors++;
				errorMsg += errors + ". Childs name cannot be blank.<br/>";
				$($(childName[i])).addClass("error_border");
			}
		}
		
		if(numAdults < 1)
		{
			errors++;
			errorMsg += errors + ". At least 1 adult needs to be added.<br/>";
			$("#attending_adult").addClass("error_border");
		}
		$("#errors_modal_contentP").append(errorMsg);
	return errors;	
	}
	function nameCheck(firstname, lastname) {
		var errors = 0;
		var first_name = firstname.val();
		var last_name = lastname.val();
		if(first_name == "") {
			firstname.addClass("error_border");
			errors++;
		} 
		if(first_name != "") {
			firstname.addClass("good_border").removeClass("error_border");
			errors++;
		} 
		if(last_name == "") {
			lastname.addClass("error_border");
			errors++;
		}
		if(last_name != "") {
			lastname.addClass("good_border").removeClass("error_border");
			errors++;
		}
		return errors;
	}
	function usernameCheck(username) {
		var errors = 0;
		var username_check = username.val();
		if(username_check == "") {
			username.addClass("error_border");
			errors++;
		} 
		else if(username_check.length <= 5) {
			username.addClass("error_border").css({color:"red"});
			errors++;
		}
		else {
			username.css({color:"green"}).addClass("good_border").removeClass("error_border");
		}
		return errors;
	}
	function passwordCheck(password) {
		var errors = 0;
		var password_check = password.val();
		if(password_check.length < 7 || password_check.length > 15) {
			password.addClass("error_border");
		}
		else {
			password.css({color:"green"}).addClass("good_border").removeClass("error_border");
		}
		return errors;
	}
//Remove overlay
	function removeOverlay() {
		event.preventDefault();
		$("#overlay_adminPage, #overlay_PhillyPage, #modal_adminPage, #modal_confirm_delete, #modal_confirm_reg_delete, .edit_admin_user_div").fadeOut();
		$(".modal_adminPage_header").animate({margin:"5% 0%", padding:"5% 0%"});
		$("#hotel_directions, #directions4, #directions3, #directions2, #directions1").fadeOut();
	}
//Add directions to the screen 
	function addDirections()
	{
		setTimeout(function()
		{
			$("#close_directions").fadeIn();
		}, 2500);
		setTimeout(function()
		{
			$("#directions4").fadeIn().css({display:"inline-block"});
		}, 2000);
		setTimeout(function()
		{
			$("#directions3").fadeIn().css({display:"inline-block"});
		}, 1500);
		setTimeout(function()
		{
			$("#directions2").fadeIn().css({display:"inline-block"});
		}, 1000);
		setTimeout(function()
		{
			$("#directions1").fadeIn().css({display:"inline-block"});
		}, 500);
	}
//Add close buttong to the top left of the modal div
	function appendCloseBtn(idPassed)
	{
		var modalElement = $("#" + idPassed);
		$(".closeBtn").appendTo(modalElement);	
	}
//Check fields for registration
	function checkRegistration(name, address, email, phone, adultsNames, numAdults, youthsNames, numYouth, childrenNames, numChildren, shirtSizes, girly_tees, totalDue)
	{
		$('input').removeClass('error_border');
		var errorCount = 0;
		var errorMsg = "";
		var email_regrex = /^[\w]{1,}(\.\w{1,})?@([\w]{1,}\.)?([\w]{1,}\.)([a-zA-Z]{1,})$/g;
		if(firstname == "")
		{
			errorCount++;
			errorMsg += errorCount+". First Name cannot be empty.<br/>";
			$('input#firstname').addClass('error_border');
		}
		if(firstname !== "")
		{
			if(!fname_regrex.test(firstname))
			{
				errorCount++;
				errorMsg += errorCount+". First Name can only contain letters and the following special characters (- and \').<br/>";
				$('input#firstname').addClass('error_border');
			}
		}
		if(lastname == "")
		{
			errorCount++;
			errorMsg += errorCount+". Last Name cannot be empty.<br/>";
			$('input#lastname').addClass('error_border');
		}
		if(lastname !== "")
		{
			if(!lname_regrex.test(lastname))
			{
				errorCount++;
				errorMsg += errorCount+". Last Name can only contain letters and the following special characters (- and \').<br/>";
				$('input#lastname').addClass('error_border');
			}
		}
		if(email == "")
		{
			errorCount++;
			errorMsg += errorCount+". Email address cannot be empty<br/>";
			$('input#email').addClass('error_border');
		}
		if((email != "") && (!email_regrex.test(email)))
		{
			errorCount++;
			errorMsg += errorCount+". Incorrect format for an email. Ex: john.doe@gmail.com or johndoe@school.college.edu<br/>";
			$('input#email').addClass('error_border');
		}
		if((college != "") && (!college_regrex.test(college)))
		{
			errorCount++;
			errorMsg += errorCount+". College cannot contain numbers or special characters.<br/>";
			$('input#college').addClass('error_border');
		}
		if((highschool != "") && (!highschool_regrex.test(highschool)))
		{
			errorCount++;
			errorMsg += errorCount+". Highschool cannot contain numbers or special characters.<br/>";
			$('input#highschool').addClass('error_border');
		}
		if(height != "")
		{
			if(!height_regrex.test(height_check))
			{
				errorCount++;
				errorMsg += errorCount+". Height should be in the format of #\'##.<br/>";
				$('input#height').addClass('error_border');
			}		
		}	
		if(weight != 0)
		{
			if(weight < 1)
			{
				errorCount++;
				errorMsg += errorCount+". Weight cannot be empty or less than zero.<br/>";
				$('input#weight').addClass('error_border');
			}
			if(weight > 799)
			{
				errorCount++;
				errorMsg += errorCount+". Weight max is 799.<br/>";
				$('input#weight').addClass('error_border');
			}
		}
		if((nickname != "") && (!nname_regrex.test(nickname)))
		{
			errorCount++;
			errorMsg += errorCount+". Nickname can only contain letters and the following special characters (- and \').<br/>";
			$('input#nickname').addClass('error_border');
		}
	$(".alert_modal_content").append(errorMsg);
	console.log(errorCount);
	return errorCount;
	}
//Check text to see if it matches the search criteria being entered
	function startSearch(searchTable) {
		var searchData = searchTable + " td:not(.editRegNotes, .edit_RegMemData, .delete_RegMemData)";
		var searchCriteria = $("#search_btn").val().toLowerCase();
		$(searchData).removeClass("matches");
		$(searchData).parent().removeClass("matched");
		$(searchData).parent().show();
		if(searchCriteria != "") {
			$(searchData).each(function(event){
				var dataString = $(this).text().toLowerCase();
				if(dataString.includes(searchCriteria)){
					$(this).addClass("matches");
					$(this).parent().addClass("matched");
				}
				else if(!dataString.includes(searchCriteria)) {
					if($(this).parent().hasClass("matched")){
						$(this).parent().show();	
					}
					else {
						$(this).parent().hide();
					}
				}
			});
		}
	}
	function getAddtTeeCount(input) {
		var elementsArray = $(input);
		var totalCount = 0;
		for(var i=0; i < $(elementsArray).length; i++) {
			totalCount =  Number(totalCount) + Number($(elementsArray[i]).val());
		}
	return totalCount;
	}
//Add button to users table
	function addNewAdminBtn() {
		$("#add_new_admin_user").append("<button id='add_new_admin_user_btn'></button>");	
	}
//Get updated users table
	function getUpdatedUsersTable() {
		$.ajax({url:"jg_admin_add_new_user.php", cache: false})
			.done(function(data) {
				var returnedData = data;
				var editUsersData = $(returnedData).find("#admin_users_table");
				$("#admin_users").html(editUsersData);
				$("#overlay_adminPage, .edit_admin_user_div").fadeOut();
				addNewAdminBtn();
			}
		);
	}
//Remove error and success messages
	function removeMessages() {
		if($(".errors").length > 0) {
			setTimeout(function() {
				$(".errors").fadeOut();
			}, 6000);
		}
		if($(".message").length > 0) {
			setTimeout(function() {
				$(".message").fadeOut();
			}, 6000);
		}
	}