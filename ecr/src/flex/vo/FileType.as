package flex.vo
{
	import flash.utils.ByteArray;
	import flex.common.Misc;
	
	public class FileType
	{
		public var sid:Number;
		public var fileTypeEn:String;
		public var fileTypeTc:String;
		public var fileTypeIcon:ByteArray;
		public var remarks:String;
		public var lastUpdate:Date;
		
		public function obj2Me(_item:*):FileType
		{
			this.sid = _item.sid;
			this.fileTypeEn = _item.fileTypeEn;
			this.fileTypeTc = _item.fileTypeTc;
			this.fileTypeIcon = _item.fileTypeIcon;
			this.remarks = _item.remarks;
			this.lastUpdate = Misc.parseUTCDate(_item.lastUpdate);
			
			return this;
		}
		public function FileType()
		{
		}
	}
}