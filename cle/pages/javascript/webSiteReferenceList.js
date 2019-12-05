// JavaScript Document
function changeDeleteResourceSidNSubmit(sid)
{
	// alert(sid);
	$("#deleteResourceSid").attr("value",sid);
	$("#frmResourceList").submit();
	// alert ($("#deleteResourceSid").attr("value"));
}

// jQuery onPageLoad
jQuery(document).ready(function(){
	// alert('RightDivHeight: ' + $("#rightTableDiv").css("height"));
	// alert('LeftDivHeight: ' + $("#sideDiv").css("height"));
		//alert ("websitereferencelist");
		

		
	if (jQuery("#rightTableDiv").height() < jQuery("#sideDiv").height())
	{
		//alert ('RightDivHeight < LeftDivHeight');
		jQuery("#rightTableDiv").css("height", jQuery("#sideDiv").css("height"));
	}

	jQuery("#floatingMenuUpDiv").css("height", (jQuery("#floatingMenuUpDiv").height() + 10) +"px");
	
	
});
