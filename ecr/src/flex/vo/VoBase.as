package flex.vo
{
	public class VoBase
	{
		protected var isWildCard:Boolean;
		
		public function checkNconvert2Boolean(_phpInput:String):Boolean
		{
			if (_phpInput == "1")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function VoBase()
		{
		}
	}
}