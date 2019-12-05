package flex.vo.system
{
	import flash.utils.ByteArray;
	
	import flex.common.Misc;
	import flex.vo.VoBase;
	
	import mx.controls.Alert;
	import mx.utils.Base64Decoder;

	public class ObjPage extends VoBase
	{
		
		// ObjPage
		public var sid:Number;
		public var page:String;
		public var url:String;
		public var remarks:String;
		public var lastUpdate:Date;
		
		public function obj2Me(_item:*):ObjPage
		{			
			// ObjPage
			this.sid = _item.sid;
			this.page = _item.page;
			this.url = _item.url;
			this.remarks = _item.remarks;
			this.lastUpdate = Misc.parseUTCDate(_item.lastUpdate);
			
			return this;
		}				
		public function ObjPage()
		{
			
		}
	} // end class
} // end package