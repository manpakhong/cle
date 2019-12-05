// JavaScript Document
function goBack()
{
	history.go(-1);
	return true;
}


$(document).ready(function() { 
	/*
	$('#resourceTypeDropDownList').click(
			function() 
			{
				$('#typeSid').attr("value", $('#resourceTypeDropDownList').attr("value"));
				alert($('#resourceTypeDropDownList').attr("value"));
			}
	)
	*/
	// live char count
	// 	setTextAreaCounterMeter(length, textAreaId, countControlId, barControlId);
	// setTextAreaCountMeter(10000, "txtaTeachingAims", "teachingAimsLiveCount", "teachingAimsLiveBar"); 
	$("#webSiteReferenceEditForm").validationEngine();
		
})
