// JavaScript Document
$(function() {	
});
$(document).ready(function() { 
	//--- Interface adjustment
	// alert('mainMenuUl: ' + $("#mainMenuUl").height() + 'menuBarDiv: ' + $("#menuBarDiv").height());
	if ($("#mainMenuUl").height() > $("#menuBarDiv").height())
	{
		// alert('mainMenuUl: ' + $("#mainMenuUl").height() + 'menuBarDiv: ' + $("#menuBarDiv").height());
		$("#menuBarDiv").css("height", $("#mainMenuUl").height() + "px");
	}	
	
}); 