package flex.common
{
	
	public class Misc
	{
		public function Misc()
		{
		}
		
		/*
		public static function parseUTCDate( str : String ) : Date {
			var matches : Array = str.match(/(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)/);
			
			var d : Date = new Date();
			
			d.setUTCFullYear(int(matches[1]), int(matches[2]) - 1, int(matches[3]));
			d.setUTCHours(int(matches[4]), int(matches[5]), int(matches[6]), 0);
			
			return d;
		}*/
		
		public static function parseUTCDate(dateString:String):Date {
			if ( dateString == null ) {
				return null;
			}
			
			var mainParts:Array = dateString.split(" ");
			var dateParts:Array = mainParts[0].split("-");
			
			if ( Number(dateParts[0])+Number(dateParts[1])+Number(dateParts[2]) == 0 ) {
				return null;
			}
			
			return new Date( Date.parse( dateParts.join("/")+(mainParts[1]?" "+mainParts[1]:" ") ) );
		}
		
		
		/*
		public static function parseDate( str : String ) : Date {
			var matches : Array = str.match(/(\d\d\d\d)-(\d\d)-(\d\d)/);
			
			var d : Date = new Date();
			
			d.setUTCFullYear(int(matches[1]), int(matches[2]) - 1, int(matches[3]));
			
			return d;
		}
		*/
			
	
	} // end class
} // end package