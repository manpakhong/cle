// JavaScript Document

// jQuery onPageLoad
$(document).ready(function(){
	
	$("td").click(function(e){	
		window.location = "../pages/webSiteReferenceEdit.php";
	});
	
	$("td").mouseover(function(e){
//		var event = e || window.event;
//		var tg = event.target || event.srcElement;
		
//		alert("column " + $(this).parent().children().index(this) + " is clicked");
//		
//		

//		$("#divHover").css("position", "absolute");
//		$("#divHover").css("top", $(this).position().top + "px");
//		$("#divHover").css("left", $(this).position().left - 24 + "px");
		
//		$("#divHover").show();
	});
	$("td").mouseout(function(event){
//		$("#divHover").hide();
	});
});