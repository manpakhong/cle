/**
 * 
 */
function treeNodeClick(_nodeId, _sid, _dropDownListId, _obj)
{
	if (_obj != null)
	{
		// insert
		$("#lvInsert").attr("value", _obj.lv + 1);
		$("#upLvSidInsert").attr("value", _obj.sid);
		$("#seqInsert").attr("value", _obj.uiNextSeq + 1);
		
		// alert(_obj.nextSid);
		
		var strUrlInsert = '/cle/pages/webSiteReferenceList.php?sid=' + _obj.nextSid + '&upLvSid=' + _obj.upLvSid;
		
		$("#urlInsert").attr("value", strUrlInsert);
		
		
		// update
		
		
		$("#sidUpdate").attr("value", _obj.sid);
		$("#seqUpdate").attr("value", _obj.seq);
		$("#lvUpdate").attr("value", _obj.lv);
		$("#lvTextUpdate").attr("value", _obj.lvText);
		$("#upLvSidUpdate").attr("value", _obj.upLvSid);
		
		// alert('uplvsid: ' + _obj.upLvSid);
		
		if (_obj.isShown == 1)
		{
			$("#isShownUpate_0").attr("checked", "checked");
		}
		else
		{
			$("#isShownUpdate_1").attr("checked", "checked");
		}
		
		if (_obj.isNetvigated == 1)
		{
			$("#isNetvigatedUpdate_0").attr("checked", "checked");
		}
		else
		{
			$("#isNetvigatedUpdate_1").attr("checked", "checked");		
		}
		
		$("#isShownUpdate").attr("value", _obj.isShown);
		$("#isNetvigatedUpdate").attr("value", _obj.isNetvigated);
		
		$("#urlUpdate").attr("value", _obj.url);
		$("#remarksUpdate").attr("value", _obj.remarks);
		$("#lastUpdateUpdate").attr("value", _obj.lastUpdate);	
		
		
		// delete
	
		$("#sidDelete").attr("value", _obj.sid);
		$("#seqDelete").attr("value", _obj.seq);
		$("#lvDelete").attr("value", _obj.lv);
		$("#lvTextDelete").attr("value", _obj.lvText);
		$("#upLvSidDelete").attr("value", _obj.upLvSid);
		
		if (_obj.isShown == 1)
		{
			$("#isShownDelete_0").attr("checked", "checked");
		}
		else
		{
			$("#isShownDelete_1").attr("checked", "checked");
		}
		
		if (_obj.isNetvigated == 1)
		{
			$("#isNetvigatedDelete_0").attr("checked", "checked");
		}
		else
		{
			$("#isNetvigatedDelete_1").attr("checked", "checked");		
		}
		
		$("#isShownDelete").attr("value", _obj.isShown);
		$("#isNetvigatedDelete").attr("value", _obj.isNetvigated);
		
		$("#urlDelete").attr("value", _obj.url);
		$("#remarksDelete").attr("value", _obj.remarks);
		$("#lastUpdateDelete").attr("value", _obj.lastUpdate);	
	}

	$("select[id=" + _dropDownListId + "] option[value=" + _sid + "]").attr("selected", "selected");
	//$('#resourceTypeDropDownList').attr('value', _sid);
}

function selectClick(_treeId, _obj)
{
	// alert('helo');

	// alert('treeId: ' + _treeId + ',obj.sid: ' + _obj.sid + ',obj.lv: ' + _obj.lv + ',obj.uiNextSeq: ' + _obj.uiNextSeq);

	if (_treeId != null && _obj != null )
	{
		collapseTree('tree');
		expandToItem(_treeId,"li" + _obj.sid);
		var strUlId = '#' + _treeId;
		$(strUlId + ' a').css("color", "blue");
		var strLiSid = '#li' + _obj.sid;
		$(strLiSid + '>a').css("color","red");
	}
	
	// insert
	$("#lvInsert").attr("value", _obj.lv + 1);
	$("#upLvSidInsert").attr("value", _obj.sid);
	$("#seqInsert").attr("value", _obj.uiNextSeq + 1);
	
	// alert(_obj.nextSid);
	
	var strUrlInsert = '/cle/pages/webSiteReferenceList.php?sid=' + _obj.nextSid + '&upLvSid=' + _obj.upLvSid;
	
	$("#urlInsert").attr("value", strUrlInsert);
	
	
	// update
	
	
	$("#sidUpdate").attr("value", _obj.sid);
	$("#seqUpdate").attr("value", _obj.seq);
	$("#lvUpdate").attr("value", _obj.lv);
	$("#lvTextUpdate").attr("value", _obj.lvText);
	$("#upLvSidUpdate").attr("value", _obj.upLvSid);
	
	// alert('uplvsid: ' + _obj.upLvSid);
	
	if (_obj.isShown == 1)
	{
		$("#isShownUpate_0").attr("checked", "checked");
	}
	else
	{
		$("#isShownUpdate_1").attr("checked", "checked");
	}
	
	if (_obj.isNetvigated == 1)
	{
		$("#isNetvigatedUpdate_0").attr("checked", "checked");
	}
	else
	{
		$("#isNetvigatedUpdate_1").attr("checked", "checked");		
	}
	
	$("#isShownUpdate").attr("value", _obj.isShown);
	$("#isNetvigatedUpdate").attr("value", _obj.isNetvigated);
	
	$("#urlUpdate").attr("value", _obj.url);
	$("#remarksUpdate").attr("value", _obj.remarks);
	$("#lastUpdateUpdate").attr("value", _obj.lastUpdate);	
	
	
	// delete

	$("#sidDelete").attr("value", _obj.sid);
	$("#seqDelete").attr("value", _obj.seq);
	$("#lvDelete").attr("value", _obj.lv);
	$("#lvTextDelete").attr("value", _obj.lvText);
	$("#upLvSidDelete").attr("value", _obj.upLvSid);
	
	if (_obj.isShown == 1)
	{
		$("#isShownDelete_0").attr("checked", "checked");
	}
	else
	{
		$("#isShownDelete_1").attr("checked", "checked");
	}
	
	if (_obj.isNetvigated == 1)
	{
		$("#isNetvigatedDelete_0").attr("checked", "checked");
	}
	else
	{
		$("#isNetvigatedDelete_1").attr("checked", "checked");		
	}
	
	$("#isShownDelete").attr("value", _obj.isShown);
	$("#isNetvigatedDelete").attr("value", _obj.isNetvigated);
	
	$("#urlDelete").attr("value", _obj.url);
	$("#remarksDelete").attr("value", _obj.remarks);
	$("#lastUpdateDelete").attr("value", _obj.lastUpdate);	
	
	/*
	var strAlert = "sid: " + _obj.sid + "\n" +
					"seq: " + _obj.seq + "\n" +
					"lv: " + _obj.lv + "\n" +
					"lvText: " + _obj.lvText + "\n" +
					"upLvSid: " + _obj.upLvSid + "\n" +
					"isShown: " + _obj.isShown + "\n" +
					"isNetvigated: " + _obj.isNetvigated + "\n" +
					"url: " + _obj.url + "\n" +
					"remarks: " + _obj.remarks + "\n" +
					"lastUpdate: " + _obj.lastUpdate + "\n";
	alert(strAlert);
	*/
}

$(document).ready(function(){
	
	// ---- resourceTypeTree
	$("#resourceTypeTree").change(
			function() 
			{
				//$("#divText").text("Hello world!");
     			// alert("obj" + $("#resourceTypeTree option:selected").attr("value"));
				selectClick("tree", eval("obj" +$("#resourceTypeTree option:selected").attr("value")) );			
   			}
	);				
		
	// expandable div
	$(".content").hide();
	
	$("#resourceTypeEdit").slideToggle(500);
	$("#resourceTypeEdit").slideToggle(500);
	
	//toggle the componenet with class msg_body
	$(".heading").click(function()
	{
		$(this).next(".content").slideToggle(500);
	});
	
	
	// accordion
	$(function() {
		$( "#accordion" ).accordion();
	});

	
	$('.accordion .head').click(function() {
		$(this).next().toggle('slow');
		return false;
	}).next().hide();	
	
	// accordion previous selection
	$(function() {
		/*		
		if (currentSelectNode == null)
		{
			alert('currentSelectNode null');
		}
		else
		{
			alert('currentSelectNode not null');
		}
		if (accordionSelect == null)
		{
			alert('accordionSelect null');
		}
		else
		{
			alert('accordionSelect not null');
		}
		*/		
		if (currentSelectNode != null && accordionSelect != null)
		{
		
            treeNodeClick('li' + currentSelectNode, currentSelectNode, 'resourceTypeTree', eval('obj'+currentSelectNode));

			switch (accordionSelect)
			{
				case 0:
					$( "#accordion" ).accordion( "option", "active", 0 );
				break;
				case 1:
					$( "#accordion" ).accordion( "option", "active", 1 );
				break;
				case 2:
					$( "#accordion" ).accordion( "option", "active", 2 );			
				break;
			}
		}
		
		

	});	
		
	
	// DropDownList
	$('#resourceTypeDropDownList').attr('value', '');
	
	$("#insertResourceTypeForm").validationEngine();	
	$("#updateResourceTypeForm").validationEngine();	
	$("#deleteResourceTypeForm").validationEngine();
	
				
});
