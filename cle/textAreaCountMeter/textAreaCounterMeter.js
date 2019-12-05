// JavaScript Document
function setTextAreaCountMeter(_length, _textAreaId, _countControlId, _barControlId)
{

	var textAreaId = "#" + _textAreaId;
	var countControlId = "#" + _countControlId;
	var barControlId = "#" + _barControlId;
	
	/*
	alert (textAreaId);
	alert (countControlId);
	alert(barControlId);
	*/
	
	$(textAreaId).keyup(
		function()
		{
			// alert ('keyup');
			var box=$(this).val();
			var main = box.length *100;
			var value= (main / _length);
			var count= _length - box.length;
		
			if(box.length <= _length)
			{
				$(countControlId).html(count);
				$(barControlId).animate(
				{
					"width": value+'%',
				}, 1);
			}
			else
			{
				alert(' Full ');
			}
			return false;
		}
	);
}

/* usage

jQuery(document).ready(function(){
	setTextAreaCounterMeter(length, textAreaId, countControlId, barControlId);
});	

<div>
<div id="count">145</div>
<div id="barbox"><div id="bar"></div></div>
</div>
<textarea id="contentbox"></textarea>

*/