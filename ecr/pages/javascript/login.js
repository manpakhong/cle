/**
 * 
 */
var xmlhttp = new getXMLObject();	//xmlhttp holds the ajax object

function submitLogin()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	  {
	    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
	  }
	}

	xmlhttp.open("POST","demo_get.asp",true);
	xmlhttp.send();
}

function ajaxLoginPost() 
{
	  var getdate = new Date();  //Used to prevent caching during ajax call
	  if(xmlhttp) 
	  { 
	  	var txtname = document.getElementById("txtname");
		xmlhttp.open("POST","../php/cmd/system/EcrUserCmd.php",true); //calling testing.php using POST method
		xmlhttp.onreadystatechange  = ajaxLoginPostResultHandler;
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		xmlhttp.send("userId=" + $("#userId").val() + "&password=" + $("#password").val() + "&CMD=" + "SELECT"); //Posting txtname to PHP File
	  }
}
	 
function ajaxLoginPostResultHandler() {
   if (xmlhttp.readyState == 4) {
     if(xmlhttp.status == 200) {
    	 
    	 var returnString = xmlhttp.responseText;
    	 var params = returnString.split("|");	 
    	 
    	 // params[0] - flag indicated success/ failed
    	 // params[1] - message in chinese or eng
    	 // params[2] - path for return
    	 // alert ('1:' + params[0] + '\n' + '2:' + params[1] + '\n' + '3:' + params[2]);
    	 
    	 // document.getElementById("ajaxLoginDiv").innerHTML=xmlhttp.responseText; //Update the HTML Form element 
    	 
    	 if (params[0] == 'SUCCESS')
		 {
    		 alert(params[1]);
    		 window.location=params[2];    		 
		 }
    	 else
		 {
    		 alert(params[1]);
    		 window.location=params[2];       		 
		 }

     }
     else {
        alert("Error during AJAX call. Please try again");
     }
   }
}	

$(document).ready(function() { 
	
}); 	