//Check for missing information or errors on question form
	function checkErrors()
	{
		var firstname = $("input#first_name");
		var lastname = $("input#last_name");
		var email = $("input#email_address");
		var question =  $("textarea#question_text");
		var errorMsg = "";
		errors = 0;
		
		$("input").removeClass("errorBorder");
		$("textarea").removeClass("errorBorder");
		
		if((firstname.val() == "") || (firstname.val() == null)){
			errors++;
			$(firstname).addClass("errorBorder");
			errorMsg += errors + ". First name cannot be blank.<br/>";
		}
		if((lastname.val() == "") || (lastname.val() == null)){
			errors++;
			$(lastname).addClass("errorBorder");
			errorMsg += errors + ". Last name cannot be blank.<br/>";
		}
		if((email.val() == "") || (email.val() == null)){
			errors++;
			$(email).addClass("errorBorder");
			errorMsg += errors + ". Email address cannot be blank.<br/>";
		}
		if((question.val() == "") || (question.val() == null)){
			errors++;
			$(question).addClass("errorBorder");
			errorMsg += errors + ". Question cannot be blank.<br/>"; 
		}
		$(".error_modal_content").append(errorMsg);
	return errors;	
	}
	
//Check for errors on sign up form
	function checkRegistration()
	{
		var firstname = $("input.first_name_input");
		var lastname = $("input.last_name_input");
		var email = $("input.email_input");
		var errorMsg = "";
		errors = 0;
		
		$("input").removeClass("errorBorder");
		
		if((firstname.val() == "") || (firstname.val() == null)){
			errors++;
			$(firstname).addClass("errorBorder");
			errorMsg += "First name cannot be blank.<br/>";
		}
		if((lastname.val() == "") || (lastname.val() == null)){
			errors++;
			$(lastname).addClass("errorBorder");
			errorMsg += "Last name cannot be blank.<br/>";
		}
		if((email.val() == "") || (email.val() == null)){
			errors++;
			$(email).addClass("errorBorder");
			errorMsg += "Email address cannot be blank.<br/>";
		}
		$(".error_modal_content").append(errorMsg);
	return errors;	
	}

//Add pictures to the pictures modal
	function showPics(place)
	{
		var allPics = $("."+place+"_picture");
		$(allPics).each(function(){
			$(this).css({display:"none"}).appendTo(".picture_modal_content");
		});
		$(allPics[0]).show();
		$(".maine_overlay_pictures, .maine_modal_picture").fadeIn();	
	}
	
//Move pictures left and right	
	function scrollPics(direction)
	{
		var getAllPics = $(".maine_modal_picture img");
		var picsLength = $(".maine_modal_picture img").length;
		var currentPic = $(".maine_modal_picture img:visible");
		var currentPicLocation = $(".maine_modal_picture img:visible").attr("id");
		var scrollDirection = direction;
		currentPicLocation = Number(currentPicLocation);
		
		if(scrollDirection == "prevLeft")
		{
			if(currentPicLocation > 1)
			{
				$(currentPic).fadeOut(function(){
					$(currentPic).prev().fadeIn();
				});
			}
			else
			{
				$(currentPic).fadeOut(function(){
					$(getAllPics[picsLength-1]).fadeIn();
				});
			}
		}
		else
		{
			if(currentPicLocation < picsLength)
			{
				$(currentPic).fadeOut(function(){
					$(currentPic).next().fadeIn();
				});
			}
			else
			{
				$(currentPic).fadeOut(function(){
					$(getAllPics[0]).fadeIn();
				});
			}
		}
	}