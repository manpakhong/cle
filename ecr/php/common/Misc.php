<?php
	class Misc
	{
	    public static function convertFlexHtmlToStandard($string)
	    {

	        // Replace all textformat starting tags. Note that we replace "" by ""
	        $result = ereg_replace("]*&gt;", "", $string);
	
	        // Replace all ending textformat ending tags
	        $result = ereg_replace("", "", $result);
	
	        // Replace all size="XXXX" by the style='XXXXpx' expression
	        $result = ereg_replace('SIZE="([^"]*)"', "style='font-size:\\1px;'", $result);

        	return $result;
	    }

    }		

?>