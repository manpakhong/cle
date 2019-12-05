// JavaScript Document

function getXMLObject()  //XML OBJECT
{
   var xmlHttp = false;
   try {
     xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")  // For Old Microsoft Browsers
   }
   catch (e) {
     try {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")  // For Microsoft IE 6.0+
     }
     catch (e2) {
       xmlHttp = false   // No Browser accepts the XMLHTTP Object then false
     }
   }
   if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
     xmlHttp = new XMLHttpRequest();        //For Mozilla, Opera Browsers
   }
   return xmlHttp;  // Mandatory Statement returning the ajax object created
}

$(function() {	
	// --- Superfish Main Menu
	
	$.fn.superfish.defaults = {
		hoverClass:    'sfHover',          // the class applied to hovered list items
		pathClass:     'overideThisToUse', // the class you have applied to list items that lead to the current page
		pathLevels:    1,                  // the number of levels of submenus that remain open or are restored using pathClass
		delay:         800,                // the delay in milliseconds that the mouse can remain outside a submenu without it closing
		animation:     {opacity:'show'},   // an object equivalent to first parameter of jQuery&#8217;s .animate() method
		speed:         'normal',           // speed of the animation. Equivalent to second parameter of jQuery&#8217;s .animate() method
		autoArrows:    true,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
		dropShadows:   true,               // completely disable drop shadows by setting this to false
		disableHI:     false,              // set to true to disable hoverIntent detection
		onInit:        function(){},       // callback function fires once Superfish is initialised &#8211; 'this' is the containing ul
		onBeforeShow:  function(){},       // callback function fires just before reveal animation begins &#8211; 'this' is the ul about to open
		onShow:        function(){},       // callback function fires once reveal animation completed &#8211; 'this' is the opened ul
		onHide:        function(){}        // callback function fires after a sub-menu has closed &#8211; 'this' is the ul that just closed
	}; 
	$('ul.sf-menu').superfish();
	


});

function logout(_document, _msg)
{
	alert(_msg);
	window.location=_document + '?logoff=true';	
}

$(document).ready(function() { 
	
	
	//--- Interface adjustment
	// alert('mainMenuUl: ' + $("#mainMenuUl").height() + 'menuBarDiv: ' + $("#menuBarDiv").height());
	if ($("#editRegDiv").height() < $("#introLDiv").height())
	{
		// alert('mainMenuUl: ' + $("#mainMenuUl").height() + 'menuBarDiv: ' + $("#menuBarDiv").height());
		$("#editRegDiv").css("height", $("#introLDiv").height() + "px");
	}	
	
	
}); 