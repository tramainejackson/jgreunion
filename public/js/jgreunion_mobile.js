$(document).on("pagecreate", "#reunion_site", function(event) {
    $("#mobile_login_form").submit(function(e) {
        e.preventDefault();
        var values = $("#mobile_login_form").serialize();

        $.post("login_verification.php", values, function(data) {
            returnedData = data;
            console.log(returnedData);
            if(returnedData == "Match") {
                window.open("mprofile.php", "_self");
            } else {
                var errorMsg = "<p>Username and password did not match. Please try again.</p>",
                    errorID = "errorMsg",
                    header = "<div data-role='header'><h2 class='errorHeader'>Error</h2></div>",
                    closeBtn = "<a href='#' data-rel='back' class='ui-btn ui-corner-all, ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Close</a>", 
                    popup = "<div data-role='popup' id='popup_" +errorID+ "' data-short='" +errorID+ "' data-theme='none' data-overlay-theme='b' data-corners='false'></div>";

                    //Create the popup
                    $(header).appendTo($(popup).appendTo($.mobile.activePage).popup())
                        .toolbar()
                        .before(closeBtn)
                        .after(errorMsg);
                    //Open the popup
                    $("#popup_" + errorID).popup("open");

                    //Removed the popup after it has been closed
                    $(document).on("popupafterclose", ".ui-popup", function() {
                       $(this).remove(); 
                    });
            }
        }); 
    });
});