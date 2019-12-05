// JavaScript Document
// jQuery onPageLoad
$(document).ready(function(){
	// alert('RightDivHeight: ' + $("#rightTableDiv").css("height"));
	// alert('LeftDivHeight: ' + $("#sideDiv").css("height"));	
	if ($("#rightTableDiv").height() < $("#sideDiv").height())
	{
		//alert ('RightDivHeight < LeftDivHeight');
		$("#rightTableDiv").css("height", $("#sideDiv").css("height"));
	}

});