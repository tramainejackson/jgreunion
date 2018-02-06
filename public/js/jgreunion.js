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
	
	// Remove error and success messages
	if($(".flashMessage").length > 0) {
		setTimeout(function() {
			$(".flashMessage").fadeOut();
		}, 6000);
	}else if($(".errorMessage").length > 0) {
		setTimeout(function() {
			$(".errorMessage").fadeOut();
		}, 6000);
	}
	
	// Initialize Datetimepicker
	$('.datetimepicker').datetimepicker({
		timepicker:false,
		format:'m/d/Y',
		startDate:'2018/01/01'
	});
	
	// Add new committee member row
	$('body').on('click', '.addCommitteeMember', function() {
		var newCommitteeRow = $('.committeeRow').clone();
		
		if($('.emptyCommittee').length > 0) {
			$('.emptyCommittee').slideUp();
		}
		
		$(newCommitteeRow).find('select').removeAttr('disabled');
		$(newCommitteeRow).removeClass('committeeRow')
			.removeAttr('hidden')
			.insertBefore('.committeeRow');
		$('.committeeRow').prev().find('select').focus();
	});
	
	// Add new reunion event row
	$('body').on('click', '.addReunionEvent', function() {
		var newEventRow = $('.reunionEventRow').clone();
		
		if($('.emptyEvents').length > 0) {
			$('.emptyEvents').slideUp();
		}
		
		$(newEventRow).find('input, textarea').removeAttr('disabled');
		$(newEventRow).removeClass('reunionEventRow')
			.removeAttr('hidden')
			.insertBefore('.reunionEventRow');
		$('.reunionEventRow').prev()
			.find('.datetimepicker')
			.datetimepicker({
				timepicker:false,
				format:'m/d/Y',
				value:'01/01/2018'
			});
	});

	// Remove new committee member row
	$('body').on('click', '.removeCommitteeMember', function(e) {
		var committeeMemberRow = $(this).parent().parent();
		$(committeeMemberRow).slideUp(function() {
			$(committeeMemberRow).remove();
		});
	});
	
	
	// Remove new event row
	$('body').on('click', '.removeReunionEventRow', function(e) {
		var eventRow = $(this).parent().parent();
		$(eventRow).slideUp(function() {
			$(eventRow).remove();
		});
	});
	
	// Remove new household member row
	$('body').on('click', '.removeHHMember', function(e) {
		var HHMemberRow = $(this).parent().parent();
		$(HHMemberRow).slideUp(function() {
			$(HHMemberRow).remove();
		});
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
	
	// Change href location when select option is changed
	// on registration create page
	$('body').on('change', '.createRegSelect', function(e) {
		// Get Selected Member ID
		var selectedMember = $(this).find('option:selected').val();
		
		// Change the link address
		$('.createRegSelectLink').attr('href', '/members/'+ selectedMember +'/edit')
	});
	
	// Change the default number of attending adults to 1
	$('#registration_modal').on('show.bs.modal', function() {
		$('input#attending_adult').val('1').change();
	});
	
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
	
//Search button background color
	$("#search_btn").focus(function()
	{
		$("#search_btn").css({"backgroundColor":"white"});
	});

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
	
	//Add total amounts to pay for registration
	$("body").on("change", "#attending_adult, #attending_youth, #attending_children", function(e) {
		var attendingNumA = $("#attending_adult").val();
		var attendingNumY = $("#attending_youth").val();
		var attendingNumC = $("#attending_children").val();
		var totalAmountA = Number(attendingNumA * $(".costPA").val());
		var totalAmountY = Number(attendingNumY * $(".costPY").val());
		var totalAmountC = Number(attendingNumC * $(".costPC").val());
		var totalDue = Number(totalAmountA + totalAmountY + totalAmountC);
		$("#total_adult").val(totalAmountA);
		$("#total_youth").val(totalAmountY);
		$("#total_children").val(totalAmountC);
		$("#total_amount_due").val(totalDue);
	});
	
	//Add name rows for adults
	$("body").on("change", "#attending_adult", function(e) {
		var count = $("#attending_adult").val();
		var totalNewRows = $('.attending_adult_row').not('#attending_adult_row_default');
		
		// Remove new rows if any exist
		$(totalNewRows).remove();
		
		// Adjust rows to amount entered
		for(var x=0; x < count; x++) {
			// Get hidden youth row and insert if before hidden default row
			var newAdultRow = $("#attending_adult_row_default").clone();
			$(newAdultRow).removeAttr('id').find('input, select').removeAttr('disabled');
			$(newAdultRow).insertBefore($("#attending_adult_row_default"));
		}
	});
	
	//Add name rows for youths
	$("body").on("change", "#attending_youth", function(e) {
		var count = $("#attending_youth").val();
		var totalNewRows = $('.attending_youth_row').not('#attending_youth_row_default');
		
		// Remove new rows if any exist
		$(totalNewRows).remove();
		
		// Adjust rows to amount entered
		for(var x=0; x < count; x++) {
			// Get hidden youth row and insert if before hidden default row
			var newAdultRow = $("#attending_youth_row_default").clone();
			$(newAdultRow).removeAttr('id').find('input, select').removeAttr('disabled');
			$(newAdultRow).insertBefore($("#attending_youth_row_default"));
		}
	});
	
	//Add name rows for children
	$("body").on("change", "#attending_children", function(e) {
		var count = $("#attending_children").val();
		var totalNewRows = $('.attending_children_row').not('#attending_children_row_default');
		
		// Remove new rows if any exist
		$(totalNewRows).remove();
		
		// Adjust rows to amount entered
		for(var x=0; x < count; x++) {
			// Get hidden youth row and insert if before hidden default row
			var newAdultRow = $("#attending_children_row_default").clone();
			$(newAdultRow).removeAttr('id').find('input, select').removeAttr('disabled');
			$(newAdultRow).insertBefore($("#attending_children_row_default"));
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
	
//Remove Error Border
	$("body").on("focus", "#registration_modal input", function(e)
	{
		$(this).removeClass("error_border");
		$("#errors_modal").fadeOut(function(){ $("errors_modal_contentP").empty(); });
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
});

// Check for empty boxes on registration form
function emptyInputCheck() {
	// event.preventDefault();
	var errors = true;
	
	if($('.attending_adult_row').not('#attending_adult_row_default').length > 0) {
		$('.attending_adult_row').not('#attending_adult_row_default').each(function(e) {
			var thisName = $(this).find('input');
			var thisShirt = $(this).find('select option:selected');
			var thisSelect = $(this).find('select');
			
			if($(thisName).val() == '') {
				$(thisName).addClass('error_border');
				errors = false;
			}
			
			if($(thisShirt).val() == 'blank') {
				$(thisSelect).addClass('error_border');
				errors = false;
			}
		});
	}
	
	if($('.attending_youth_row').not('#attending_youth_row_default').length > 0) {
		$('.attending_youth_row').not('#attending_youth_row_default').each(function(e) {
			var thisName = $(this).find('input');
			var thisShirt = $(this).find('select option:selected');
			var thisSelect = $(this).find('select');
			
			if($(thisName).val() == '') {
				$(thisName).addClass('error_border');
				errors = false;
			}
			
			if($(thisShirt).val() == 'blank') {
				$(thisSelect).addClass('error_border');
				errors = false;
			}
		});
	}
	
	if($('.attending_children_row').not('#attending_children_row_default').length > 0) {
		$('.attending_children_row').not('#attending_children_row_default').each(function(e) {
			var thisName = $(this).find('input');
			var thisShirt = $(this).find('select option:selected');
			var thisSelect = $(this).find('select');
			
			if($(thisName).val() == '') {
				$(thisName).addClass('error_border');
				errors = false;
			}
			
			if($(thisShirt).val() == 'blank') {
				$(thisSelect).addClass('error_border');
				errors = false;
			}
		});
	}
	
	if(errors === false) {
		return false;
	} else {
		$('input#total_adult, input#total_youth, input#total_children, input#total_amount_due').removeAttr('disabled');
	
		return true;
	}
}

// Add individual member to household
function addToHouseHold(dlID, memberID) {
	$.ajax({
	  method: "PUT",
	  url: "/members/" + memberID + "/add_house_hold",
	  data: {'houseMember':memberID, 'reunion_dl':dlID}
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
function removeFromHouseHold(dlID, memberID) {
	event.preventDefault();
	
	$.ajax({
	  method: "DELETE",
	  url: "/members/" + memberID + "/remove_house_hold",
	  data: {'remove_hh':memberID, 'reunion_dl':dlID}
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

// Remove event from reunion
function removeReunionEvent(reunion_event_id) {
	event.preventDefault();
	
	$.ajax({
	  method: "DELETE",
	  url: "/reunion_events/" + reunion_event_id,
	  data: {'reunion_event':reunion_event_id}
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var removeEventRow = $("input[name='event_id[]'][value='"+reunion_event_id+"']").parent().parent();
		
		$(removeEventRow).slideUp('slow', function() {
			$(removeEventRow).remove();
		});
	});
}

// Remove committee member from reunion
function removeCommitteeMember(reunion_committee_member_id) {
	event.preventDefault();
	
	$.ajax({
	  method: "DELETE",
	  url: "/reunion_committee_members/" + reunion_committee_member_id,
	  data: {'reunion_committee':reunion_committee_member_id}
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var removeCommitteeMemberRow = $("input[name='committee_member_id[]'][value='"+reunion_committee_member_id+"']").parent().parent();
		
		$(removeCommitteeMemberRow).slideUp('slow', function() {
			$(removeCommitteeMemberRow).remove();
		});
	});
}

// Add individual member to household
function removeRegistrationModal(regID) {
	$.ajax({
	  method: "GET",
	  url: "/delete_registration/" + regID,
	  data: {'registration':regID}
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var deleteModal = $(data);
		
		$(deleteModal).appendTo($('#profilePage')).ready(function() {
			$('.delete_registration').modal('show');
		});

		$('.delete_registration').on('hidden.bs.modal', function (e) {
			$(this).remove();
		});
	});
}

// Remove error and success messages function
function removeMessages() {
	if($(".flashMessage").length > 0) {
		setTimeout(function() {
			$(".flashMessage").fadeOut();
		}, 6000);
	}
	if($(".errorMessage").length > 0) {
		setTimeout(function() {
			$(".errorMessage").fadeOut();
		}, 6000);
	}
}