// JavaScript Document
// initialise Superfish 

/*
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
*/
 
function logout(_document)
{
	alert('用戶成功登出系統!');
	window.location=_document + '?logoff=true';	
}
function notAuthorized(_document)
{
	alert('請先登入系統!');
	window.location=_document;
}
$(document).ready(function() { 

	$('ul.sf-menu').superfish({ 
		delay:       1000,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       'fast',                          // faster animation speed 
		autoArrows:  false,                           // disable generation of arrow mark-up 
		dropShadows: true                            // disable drop shadows 
	}); 
	
	// alert("body height: " + $("body").height());
	//alert ("common");
	
	
	if ($("body").height() < 450)
	{
		//alert("<768");		
		//alert ('RightDivHeight < LeftDivHeight');
		$("#editDiv").css("height", (450 - ($("#menuDiv").height() + $("#copyrightDiv").height()))+"px");
		//alert ("editDiv Height: " + (450 - ($("#menuDiv").height() + $("#copyrightDiv").height())+"px");
		//alert("body height: " + $("body").height());		
	}
	else
	{
		//alert(">768");	
	}

	
	/* code to trace external link */
	/*
	jQuery(".FreezeHeaderTable a").click(function(){
		pageTracker._trackEvent("links", "external", jQuery(this).attr("href"), 0);
	});
	*/	
	
}); 
