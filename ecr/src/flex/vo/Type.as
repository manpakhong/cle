package flex.vo
{
	import flash.utils.ByteArray;
	import flex.common.Misc;	
	import mx.controls.Alert;
	
	public class Type
	{
		public var sid:Number;
		public var typeEn:String;
		public var typeTc:String;
		public var remarks:String;
		public var lastUpdate:Date;
		
		public function obj2Me(_item:*):Type
		{
			this.sid = _item.sid;
			this.typeEn = _item.typeEn;
			this.typeTc = _item.typeTc;
			this.remarks = _item.remarks;
			this.lastUpdate =Misc.parseUTCDate(_item.lastUpdate);
			
			return this;
		}		
		
		public function Type()
		{
		}
	}
}